<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
</head>
<body>

   @include('layouts.navigation')


<div>
<div class="hero-upload">
    <div class="hero-message">
        <h1>Welcome to FileShare</h1>
        <p>Securely share your files with anyone, anywhere.</p>
        <p>Upload large projects, code files, or private documents and share them safely with a key.</p>
    </div>
<div class="hero-upload-box">
    <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Choose a file to upload</label>
        <input type="file" name="file" id="file" required>

        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" rows="3" placeholder="Write your comment here..."></textarea>

        <button type="submit">Upload</button>
    </form>
</div>

</div>


<div class="category-section">

<div class="category-tabs">
 <div class="category-tabs">
  <a href="{{ route('dashboard') }}" class="{{ request('category') == null ? 'active' : '' }}">All</a>
  <a href="{{ route('dashboard', ['category' => 'docs']) }}" class="{{ request('category') == 'docs' ? 'active' : '' }}">Doc Files</a>
  <a href="{{ route('dashboard', ['category' => 'images']) }}" class="{{ request('category') == 'images' ? 'active' : '' }}">Images</a>
</div>


</div>
<div class="document-list">
    @forelse($files as $file)
    <div class="document-card">
        <h3>
            @if(Str::startsWith($file->mime_type, 'image/'))
                <img src="{{ asset('storage/' . $file->path) }}" alt="{{ $file->filename }}" width="100">
            @else
                 {{ $file->filename }}
            @endif
         <p>Uploaded by: {{ $file->user->name }}</p>
        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">View</a>
        <a href="{{ asset('storage/' . $file->file_path) }}" download>Download</a>
    </div>
    @empty
    <p>No files available in this category.</p>
    @endforelse
</div>

</div>
</div>


















   @include('layouts.footer')


</body>
</html>
