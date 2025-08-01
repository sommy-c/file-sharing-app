<?php

namespace App\Http\Controllers;
 use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\Message;



class FileController extends Controller
{

    // file upload

public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar,csv,mp4,mov,avi|max:20480',
        'comment' => 'nullable|string|max:1000',
    ]);

    $uploadedFile = $request->file('file');
    $originalName = $uploadedFile->getClientOriginalName();

    // 1. Generate random encryption key
    $encryptionKey = Str::random(32);

    // 2. Encrypt file content
    $fileContent = file_get_contents($uploadedFile->getRealPath());
    $encryptedContent = openssl_encrypt($fileContent, 'AES-256-CBC', $encryptionKey, 0, substr($encryptionKey, 0, 16));

    // 3. Create unique filename
    $encryptedFileName = Str::random(20) . '.enc';

    // 4. Store encrypted content in private disk (storage/app/private)
    Storage::disk('local')->put("private/{$encryptedFileName}", $encryptedContent);

    // 5. Save file record
    File::create([
        'user_id' => Auth::id(),
        'uploaded_by' => Auth::id(),
        'filename' => $originalName,
        'path' => "private/{$encryptedFileName}",
        'type' => $uploadedFile->getClientMimeType(),
        'comment' => $request->comment,
        'encryption_key' => Crypt::encryptString($encryptionKey), // secure storage
    ]);

    // 6. Send inbox message to uploader with their decryption key
    Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => Auth::id(),
        'subject' => 'Decryption Key for Your Uploaded File',
        'body' => "Your encryption key for the file `{$originalName}` is:\n\n`{$encryptionKey}`\n\nKeep it safe. You'll need it to download and decrypt the file.",
    ]);

    return redirect()->route('dashboard')->with('success', 'File uploaded and encryption key sent to your inbox!');
}

public function download($id)
{
    $file = File::findOrFail($id);

    // Check if file exists
    if (!Storage::disk('public')->exists($file->path)) {
        abort(404, 'File not found.');
    }

    // Mark as downloaded
    if (!$file->downloaded) {
        $file->downloaded = true;
        $file->save();
    }

    return Storage::disk('public')->download($file->path, $file->filename);
}

}


public function showNotification()
{
    $messages = Message::where('receiver_id', auth()->id())
                ->latest()
                ->get();

    return view('notification', compact('messages'));
}
public function showInbox($id)
{
    $message = Message::where('id', $id)
                      ->where('receiver_id', auth()->id())
                      ->firstOrFail();

    // Mark as read
    if (!$message->is_read) {
        $message->is_read = true;
        $message->save();
    }

  $unreadcount = Message::where('receiver_id', auth()->id())
                      ->where('is_read', false)
                      ->count();

return view('inbox', compact('message', 'unreadcount'));

}


}
