<?php

namespace App\Http\Controllers;
 use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;




class FileController extends Controller
{

    // file upload
   public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|file|max:20480', // 20MB
        'comment' => 'nullable|string|max:1000',
    ]);

    $uploadedFile = $request->file('file');
    $filePath = $uploadedFile->store('uploads', 'public');

    File::create([
        'user_id' => Auth::id(),
        'uploaded_by' => Auth::id(),
        'filename' => $uploadedFile->getClientOriginalName(),
        'path' => $filePath,
        'type' => $uploadedFile->getClientMimeType(),
        'comment' => $request->comment,
    ]);

    return redirect()->route('dashboard')->with('success', 'File uploaded!');
}
}

