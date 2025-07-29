<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FileShareHub</title>
  <link rel="stylesheet" href="{{asset('css/indexstyle.css')}}" />
</head>
<body>
  <header class="header">
    <div class="logo">FILESHAREHUB</div>
   {{-- <a href="{{url('register')}}"><button class="get-started">Get Started</button></a> --}}

    @if (Route::has('login'))

                    @auth

                    <form style="padding: 15px" method="POST" action="{{route('logout')}}">
                        @csrf
                        <input class="btn btn-success" type="submit" value="Logout">
                    </form>

                    @else

                    <a href="{{url('/register')}}"><button class="get-started">Get Started</button></a>

                    @endauth

    @endif

  </header>

  <main class="hero">
    <div class="hero-content">
      <h1>Share Files Easily &amp; Securely</h1>
      <p>Upload, manage, and share your files seamlessly</p>
        <a href="{{ Auth::check() ? route('dashboard') : route('login') }}">
            <button class="join-btn">Join Now</button>
        </a>
    </div>
    <div class="hero-image">
      <img src="{{asset('images/users-sharing-files-online-using-a-smartphone-app-vector-id1280291919.jpg')}}" alt="File Cloud Illustration" />
    </div>
  </main>

  <section class="testimonial">
    <p>🚀 FileShareHub transformed our file sharing process! 🚀</p>
    <span>— Aguma-Ibrahim Ezedinim, Project Work</span>
  </section>

  {{-- footer --}}
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
