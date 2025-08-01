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



{{-- <h2>{{ $file->filename }}</h2>

@if (Str::startsWith($file->type, 'image/'))
    <img src="{{ asset('storage/' . $file->path) }}" class="max-w-full">

@elseif (Str::contains($file->type, 'pdf'))
    <iframe src="{{ asset('storage/' . $file->path) }}" width="100%" height="600px"></iframe>

@elseif (Str::contains($file->type, 'officedocument') || Str::contains($file->type, ['msword', 'vnd.ms-excel', 'vnd.ms-powerpoint']))
    @php
        $url = urlencode(asset('storage/' . $file->path));
    @endphp
    <iframe src="https://view.officeapps.live.com/op/view.aspx?src={{ $url }}" width="100%" height="600px"></iframe>

@else
    <p>Preview not supported. <a href="{{ asset('storage/' . $file->path) }}" download>Download again</a></p>
@endif --}}

<div class="file-container">
    <h2>{{ $file->filename }}</h2>

    <div class="file-preview">
        @if (Str::startsWith($file->type, 'image/'))
            <img src="{{ asset('storage/' . $file->path) }}" alt="Image Preview">
        @elseif (Str::contains($file->type, 'pdf'))
            <iframe src="{{ asset('storage/' . $file->path) }}" width="100%" height="600px"></iframe>
            @elseif (Str::contains($file->type, 'officedocument') || Str::contains($file->type, ['msword', 'vnd.ms-excel', 'vnd.ms-powerpoint']))
    @php
        $url = urlencode(asset('storage/' . $file->path));
    @endphp
    <iframe src="https://view.officeapps.live.com/op/view.aspx?src={{ $url }}" width="100%" height="600px"></iframe>

        @elseif (Str::contains($file->type, 'video'))
            <video controls>
                <source src="{{ asset('storage/' . $file->path) }}" type="{{ $file->type }}">
                Your browser does not support video playback.
            </video>
        @else
            <p class="no-preview">Preview not supported for this file type.</p>
            <a href="{{ asset('storage/' . $file->path) }}" class="download-btn" download>Download File</a>
        @endif
    </div>

    <div class="file-meta">
        <p><strong>Uploaded By:</strong> {{ $file->uploader->name ?? 'Unknown' }}</p>
        <p><strong>Type:</strong> {{ $file->type }}</p>
        <p><strong>Uploaded:</strong> {{ $file->created_at->format('F j, Y, g:i a') }}</p>
        @if ($file->comment)
            <p><strong>Comment:</strong> {{ $file->comment }}</p>
        @endif
    </div>
</div>
<div class="pagination">
    {{ $messages->links() }}
</div>
