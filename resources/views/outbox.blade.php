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
    <div class="outbox-container">
   

    <div class="outbox-container">
    <h2>📤 Sent Messages (Outbox)</h2>

    @foreach($messages as $message)
        <div class="message-card {{ $message->sender_id == auth()->id() ? 'system-msg' : 'user-msg' }}">
            <div class="message-header">
                @if($message->receiver && $message->receiver->profile_photo)
                    <img src="{{ asset('storage/' . $message->receiver->profile_photo) }}" alt="Avatar" class="avatar-img">
                @else
                    <div class="avatar-placeholder">
                        {{ strtoupper(substr($message->receiver->name ?? 'U', 0, 1)) }}
                    </div>
                @endif

                <div class="message-info">
                    <h3>{{ $message->subject }}</h3>
                    <p><strong>To:</strong> {{ $message->receiver->name ?? 'Unknown' }}</p>
                    <p class="timestamp">{{ $message->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <div class="message-body">
                <p>{{ $message->body }}</p>
            </div>
        </div>
    @endforeach

    {{-- Pagination --}}
    <div class="pagination-links">
        {{ $messages->links() }}
    </div>
</div>

</div>

</body>
</html>
