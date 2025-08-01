<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/inboxstyle.css') }}">
    <title>Document</title>
</head>
<body>
@include('layouts.navigation')
<div class="message-container fade-in">
    <div class="message-header">
        @if($message->sender && $message->sender->profile_photo)
            <img src="{{ asset('storage/' . $message->sender->profile_photo) }}" alt="Avatar" class="avatar">
        @else
            <div class="avatar-placeholder">
                {{ strtoupper(substr($message->sender->name ?? 'U', 0, 1)) }}
            </div>
        @endif

        <div class="sender-info">
            <h2>{{ $message->subject }}</h2>
            <p><strong>From:</strong> {{ $message->sender->name ?? 'Unknown' }}</p>
            <p><strong>Sent:</strong> {{ $message->created_at->format('F j, Y g:i A') }}</p>
        </div>
    </div>

    <div class="message-body">
        <p>{{ $message->body }}</p>
    </div>


</div>


</div>
@include('layouts.footer')

</body>
</html>
