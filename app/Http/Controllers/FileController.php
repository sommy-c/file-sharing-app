<?php

namespace App\Http\Controllers;
use App\Models\User;
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
        'receiver' => 'required|string',
        'file' => 'required|file|max:20480',
        'message' => 'nullable|string|max:1000',
    ]);

    // Find user by username or email
    $receiver = User::where('email', $request->receiver)
                    ->orWhere('username', $request->receiver)
                    ->first();

    if (!$receiver) {
        return back()->withErrors(['receiver' => 'User not found.']);
    }

    $uploadedFile = $request->file('file');
    $originalName = $uploadedFile->getClientOriginalName();

    // Generate encryption key
    $encryptionKey = Str::random(32);
    $iv = substr($encryptionKey, 0, 16);

    $encryptedContent = openssl_encrypt(
        file_get_contents($uploadedFile->getRealPath()),
        'AES-256-CBC',
        $encryptionKey,
        0,
        $iv
    );

    $encryptedFileName = Str::random(20) . '.enc';
    Storage::disk('local')->put("private/{$encryptedFileName}", $encryptedContent);

    // Save to DB
    $file = File::create([
        'user_id' => Auth::id(),
        'uploaded_by' => Auth::id(),
        'filename' => $originalName,
        'path' => "private/{$encryptedFileName}",
        'type' => $uploadedFile->getMimeType(),
        'encryption_key' => Crypt::encryptString($encryptionKey),
        'comment' => $request->message,
    ]);

    // Send Message with Key
    Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $receiver->id,
        'subject' => 'You received a file',
        'body' => "File: `{$originalName}`\n\nEncryption Key: `{$encryptionKey}`\n\nNote: " . ($request->message ?? 'No additional message.'),
    ]);

    return redirect()->back()->with('success', 'File sent and uploaded successfully.');
}


    //  Download Encrypted File



public function download(Request $request, $id)
{
    $file = File::findOrFail($id);
    $user = Auth::user();

    // If user is the uploader, skip key validation
    if ($file->uploaded_by === $user->id) {
        // Mark as downloaded if needed
        if (!$file->downloaded) {
            $file->downloaded = true;
            $file->save();
        }

        return Storage::download($file->path, $file->filename);
    }

    // If receiver, require key
    $request->validate([
        'encryption_key' => 'required|string',
    ]);

    $providedKey = $request->input('encryption_key');

    // Check file exists
    if (!Storage::disk('local')->exists($file->path)) {
        abort(404, 'File not found.');
    }

    // Decrypt key and validate
    if ($providedKey !== Crypt::decryptString($file->encryption_key)) {
        return back()->withErrors(['key' => 'Incorrect encryption key.'])->withInput();
    }

    // Mark as downloaded
    if (!$file->downloaded) {
        $file->downloaded = true;
        $file->save();
    }

    return Storage::download($file->path, $file->filename);
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
public function showFile($id)
{
    $file = File::findOrFail($id);

    if (!$file->downloaded) {
        abort(403, 'You must download this file first.');
    }



    return view('viewfile', compact('file'));
}
public function outbox()
{
    $messages = Message::where('sender_id', Auth::id())
                ->latest()
                ->with('receiver') // eager-load receiver user info
                 ->paginate(10);

    return view('outbox', compact('messages'));
}


}
