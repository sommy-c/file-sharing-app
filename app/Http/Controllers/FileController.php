<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class FileController extends Controller
{
    // ✅ Upload Encrypted File
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar,csv,mp4,mov,avi|max:20480',
            'comment' => 'nullable|string|max:1000',
        ]);

        $uploadedFile = $request->file('file');
        $originalName = $uploadedFile->getClientOriginalName();

        // 1. Generate 32-character encryption key
        $encryptionKey = Str::random(32);

        // 2. Encrypt file contents
        $fileContent = file_get_contents($uploadedFile->getRealPath());
        $iv = substr($encryptionKey, 0, 16); // 16 bytes IV
        $encryptedContent = openssl_encrypt($fileContent, 'AES-256-CBC', $encryptionKey, 0, $iv);

        // 3. Generate encrypted filename
        $encryptedFileName = Str::random(20) . '.enc';

        // 4. Store encrypted file
        Storage::disk('local')->put("private/{$encryptedFileName}", $encryptedContent);

        // 5. Save to DB
        File::create([
            'user_id' => Auth::id(),
            'uploaded_by' => Auth::id(),
            'filename' => $originalName,
            'path' => "private/{$encryptedFileName}",
            'type' => $uploadedFile->getClientMimeType(),
            'comment' => $request->comment,
            //  'encryption_key' => $encryptionKey
           'encryption_key' => Crypt::encryptString($encryptionKey),
        ]);

        // 6. Send Message with Key
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => Auth::id(),
            'subject' => 'Decryption Key for Your Uploaded File',
            'body' => "Your encryption key for the file `{$originalName}` is:\n\n`{$encryptionKey}`\n\nKeep it safe.",
        ]);

        return redirect()->route('dashboard')->with('success', 'File uploaded and key sent to your inbox!');
    }



    //  Download Encrypted File

public function download(Request $request, $id)
{
     $request->validate([
        'encryption_key' => 'required|string',
    ]);
    $file = File::findOrFail($id);

    // Get the encryption key submitted from the form
    $providedKey = $request->input('encryption_key');

    // Check if file exists
    if (!Storage::disk('local')->exists($file->path)) {
        abort(404, 'File not found.');
    }

    // Compare provided key with stored (decrypted) key
    if ($providedKey !== Crypt::decryptString($file->encryption_key)) {
       return back()->withErrors(['encryption_key' => 'Incorrect encryption key.'])->withInput();

    }

    // Mark as downloaded if not already
    if (!$file->downloaded) {
        $file->downloaded = true;
        $file->save();
    }

    // Stream the encrypted file

}



    //  Show Notification Messages
    public function showNotification()
    {
        $messages = Message::where('receiver_id', Auth::id())
            ->latest()
            ->get();

        return view('notification', compact('messages'));
    }

    // Show Inbox Message by ID
    public function showInbox($id)
{
    $message = Message::where('id', $id)
        ->where('receiver_id', Auth::id())
        ->firstOrFail();

    if (!$message->is_read) {
        $message->is_read = true;
        $message->save();
    }

    $unreadcount = Message::where('receiver_id', Auth::id())
        ->where('is_read', false)
        ->count();

    return view('inbox', compact('message', 'unreadcount'));
}
}
