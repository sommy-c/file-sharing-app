<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>file share</title>

</head>
<body>
    <nav>
    <header>
        <h1>FILESHARE</h1>
    </header>

    <div>
        <input type="text" name="search" placeholder="Search..." required>
    </div>

    <ul>
        <li>
            <a href="{{ route('notify') }}">
                <i class="fas fa-inbox"></i>
                @php
                    $unreadCount = \App\Models\Message::where('receiver_id', auth()->id())
                                    ->where('is_read', false)
                                    ->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="notification-badge">{{ $unreadCount }}</span>
                @endif
            </a>
        </li>

        <li><a href="{{ route('messages.outbox') }}"><i class="fas fa-paper-plane"></i></a></li>
        <li><a href="#"><i class="fas fa-user-circle"></i></a></li>
    </ul>
</nav>

</body>
</html>
