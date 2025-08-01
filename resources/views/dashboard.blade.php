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

<div class="hero-upload">
    <div class="hero-message">
        <h1>Welcome to FileShare</h1>
        <p>Securely share your files with anyone, anywhere.</p>
        <p>Upload large projects, code files, or private documents and share them safely with a key.</p>

        <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="file" name="file" required>

    {{-- Optional message --}}
    <textarea name="comment" placeholder="Add a message (optional)" rows="3"></textarea>

    {{-- Receiver by email or name --}}
    <input type="text" name="receiver_identifier" placeholder="Receiver email or username" required>

    <button type="submit">Upload and Send</button>
</form>

    </div>

    <div class="hero-image">
        <img src="{{ asset('image/HERO.png') }}" alt="Lady using laptop">
    </div>
</div>

<div class="category-section">
    <div class="category-tabs">
        <a href="{{ route('dashboard') }}" class="{{ request('category') == null ? 'active' : '' }}">All</a>
        <a href="{{ route('dashboard', ['category' => 'docs']) }}" class="{{ request('category') == 'docs' ? 'active' : '' }}">Doc Files</a>
        <a href="{{ route('dashboard', ['category' => 'images']) }}" class="{{ request('category') == 'images' ? 'active' : '' }}">Images</a>
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
@if ($file->uploaded_by == auth()->id())
    {{-- You uploaded it, no key required --}}
    <a href="{{ route('files.download', $file->id) }}">View )</a>

@elseif (!$file->downloaded)
    {{-- File sent to you, not yet downloaded --}}
    <form method="POST" action="{{ route('files.download', $file->id) }}">
        @csrf
        <input type="text" name="encryption_key" placeholder="Enter encryption key" required>
        <button type="submit">Download</button>
    </form>

@else
    {{-- Already downloaded, show view link --}}
    <a href="{{ route('files.download', $file->id) }}">View</a>
@endif
                <p>Type: {{ $file->type }}</p>
                <p>Uploaded: {{ $file->created_at->format('F j, Y, g:i a') }}</p>
                @if ($file->comment)
                    <p>Comment: {{ $file->comment }}</p>
                @endif
            </div>
        @empty
            <p>No files available.</p>
        @endforelse
    </div>
</div>

@include('layouts.footer')

</body>
</html>
