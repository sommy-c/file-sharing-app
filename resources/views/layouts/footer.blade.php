<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <footer class="footer">
    <div class="footer-container">
        <!-- Branding and short intro -->
        <div class="footer-section">
            <h2 class="footer-title">FileShare</h2>
            <p class="footer-description">
                A secure and collaborative platform for sharing large files, codebases, and projects. Built with developers, designers, and teams in mind.
            </p>
        </div>

        <!-- Navigation links -->
        <div class="footer-section">
            <h3 class="footer-heading">Quick Links</h3>
            <ul class="footer-links">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="#">Upload Files</a></li>
                <li><a href="#">Inbox</a></li>
                <li><a href="#">Outbox</a></li>
                <li><a href="#">My Profile</a></li>
            </ul>
        </div>

        <!-- Resources or support -->
        <div class="footer-section">
            <h3 class="footer-heading">Help & Support</h3>
            <ul class="footer-links">
                <li><a href="#">FAQs</a></li>
                <li><a href="#">Contact Support</a></li>
                <li><a href="#">Community</a></li>
                <li><a href="#">Report a Bug</a></li>
            </ul>
        </div>

        <!-- Social media or credits -->
        <div class="footer-section">
            <h3 class="footer-heading">Connect</h3>
            <div class="social-icons">
                <a href="#"><i class="fab fa-github"></i></a>
                <a href="#"><i class="fab fa-slack"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} FileShare. All rights reserved.</p>
        <p>Designed & Built by Your Team.</p>
    </div>
</footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

</body>
</html>
