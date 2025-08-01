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
   
<div class="inbox-wrapper">
    @foreach ($messages as $message)
        <div class="message-block">
            <a href="{{ route('inbox.show', $message->id) }}">
                <div class="message-header">
                    @if($message->sender && $message->sender->profile_photo)
                        <img src="{{ asset('image/default-avatar.png') }}" alt="Sender Avatar" class="sender-avatar">
                    @else
                        <div class="avatar-placeholder">
                            {{ strtoupper(substr($message->sender->name ?? 'U', 0, 1)) }}
                        </div>
                    @endif

                    <div class="sender-info">
                        <h3>{{ $message->sender->name ?? 'Unknown Sender' }}</h3>
                        <p class="meta">Sent on {{ $message->created_at->format('F j, Y g:i A') }}</p>
                    </div>
                </div>

                <div class="message-subject">
                    <h2>{{ $message->subject }}</h2>
                </div>
            </a>
        </div>
    @endforeach
</div>

@include('layouts.footer')

</body>
</html>
