<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/auth.style.css') }}">
    <title>sign | fileshare</title>
</head>
<body>

        <div class="signup-wrapper">
    <div class="signup-box">
         <h3>FILESHARE</h3>
        <p><h1>Create Account</h1></p>
        <p>Sign up to start sharing files</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="signup-input-group">
                <label for="name">Fullname</label>
                <input type="text" name="name" id="name" required placeholder="Your name">
            </div>

            <div class="signup-input-group">
                <label for="name">Username</label>
                <input type="text" name="username" id="name" required placeholder="Your username">
            </div>

            <div class="signup-input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="you@example.com">
            </div>

            <div class="signup-input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="••••••••">
            </div>

            <div class="signup-input-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="••••••••">
            </div>

            <a href="{{ route('profile.complete') }}"><button type="submit">Next</button></a>
            <p class="signup-link">Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </form>
    </div>
</div>



</body>
</html>
