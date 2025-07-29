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

                    <a href="{{url('register')}}"><button class="get-started">Get Started</button></a>

                    @endauth

    @endif

  </header>

  <main class="hero">
    <div class="hero-content">
      <h1>Share Files Easily &amp; Securely</h1>
      <p>Upload, manage, and share your files seamlessly</p>
      <button class="join-btn">Join Now</button>
    </div>
    <div class="hero-image">
      <img src="{{asset('images/users-sharing-files-online-using-a-smartphone-app-vector-id1280291919.jpg')}}" alt="File Cloud Illustration" />
    </div>
  </main>

  <section class="testimonial">
    <p>🚀 FileShareHub transformed our file sharing process! 🚀</p>
    <span>— Aguma-Ibrahim Ezedinim, Project Work</span>
  </section>

  <footer class="footer">
    <div class="footer-left">
      <h3>FILESHAREHUB</h3>
      <p>Secure file sharing platform</p>
      <div class="socials">
        <a href="#">🌐</a>
        <a href="#">📧</a>
      </div>
    </div>
    <div class="footer-links">
      <div>
        <h4>Product</h4>
        <ul>
          <li>Dashboard</li>
          <li>Features</li>
          <li>Integrations</li>
        </ul>
      </div>
      <div>
        <h4>Pricing</h4>
        <ul>
          <li>Free version</li>
          <li>Comparison</li>
          <li>Enterprise</li>
        </ul>
      </div>
      <div>
        <h4>Company</h4>
        <ul>
          <li>About us</li>
          <li>Careers</li>
          <li>Updates</li>
        </ul>
      </div>
      <div>
        <h4>Resources</h4>
        <ul>
          <li>Blog</li>
          <li>Help Center</li>
          <li>Support</li>
        </ul>
      </div>
    </div>
  </footer>
</body>
</html>
