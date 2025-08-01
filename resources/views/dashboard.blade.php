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

        <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data" class="upload-form">
            @csrf
            <input type="file" name="file" id="file" required>
            <button type="submit">Upload</button>
        </form>
    </div>

    <div class="hero-image">
        <img src="{{ asset('image/HERO.png') }}" alt="Lady using laptop">
    </div>
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
                @if(Str::startsWith($file->type, 'image/'))
                    <img src="{{ asset('storage/' . $file->path) }}" alt="{{ $file->filename }}" width="100">
                @else
                    {{ $file->filename }}
                @endif
            </h3>
            <p>Uploaded by: {{ $file->user->name }}</p>

            @if($file->downloaded)
                <a href="{{ asset('storage/' . $file->path) }}" target="_blank">View</a>
            @else
                <form method="POST" action="{{ route('files.download',$file->id) }}">
                    @csrf

                    <input type="hidden" name="file_id" value=" {{ old('key') }}" ">

                    <input type="text" name="encryption_key" placeholder="Enter encryption key" required>

                    @error('encryption_key')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
                    <button type="submit">Download</button>
                </form>
            @endif
        </div>
    @empty
        <p>No files available in this category.</p>
    @endforelse
</div>

@include('layouts.footer')

</div>
</div>


















   @include('layouts.footer')


</body>
</html>
