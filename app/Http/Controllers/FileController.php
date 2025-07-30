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
        'file' => 'required|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar,csv,mp4,mov,avi|max:20480',
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

