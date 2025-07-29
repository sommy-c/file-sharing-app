<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile - ShareEasy</title>
  <link rel="stylesheet" href="{{ asset('css/profilestyle.css') }}" />
</head>
<body>

  <header class="top-nav">
    <div class="brand">ShareEasy</div>
    <nav class="nav-links">
      <a href="#">Dashboard</a>
      <a href="#">Inbox</a>
      <a href="#">Outbox</a>
    </nav>
  </header>

  <main class="profile-page">
    <!-- Sidebar -->
    <aside class="profile-sidebar">
      <img class="avatar" src="https://via.placeholder.com/100x100.png?text=User" alt="User Avatar" />
      <h3>{{ $user->name }}</h3>
      <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
      </form>
    </aside>

    <!-- Profile Content -->
    <section class="profile-content">
      <!-- Personal Info -->
      <div class="card">
        <h2>Personal Information</h2>
        <div class="info-grid">
          <div>
            <strong>Full Name</strong>
            <p>{{ $user->name }}</p>
          </div>
          <div>
            <strong>Username</strong>
            <p>{{ $user->username ?? 'N/A' }}</p>
          </div>
          <div>
            <strong>Email</strong>
            <p>{{ $user->email }}</p>
          </div>
          <div>
            <strong>Phone Number</strong>
            <p>{{ $user->phone ?? 'N/A' }}</p>
          </div>
          <div style="grid-column: 1 / -1;">
            <strong>Address</strong>
            <p>{{ $user->address ?? 'N/A' }}</p>
          </div>
        </div>
      </div>

      <!-- Account Settings -->
      <div class="card">
        <h2>Account Settings</h2>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <form class="settings-form" method="POST" action="{{ route('profile.update-password') }}">
          @csrf

          <label for="current">Current Password</label>
          <input type="password" id="current" name="current_password" placeholder="Enter current password" required />

          <label for="new">New Password</label>
          <input type="password" id="new" name="new_password" placeholder="Enter new password" required />

          <label for="confirm">Confirm New Password</label>
          <input type="password" id="confirm" name="new_password_confirmation" placeholder="Re-enter new password" required />

          <button type="submit">Update Password</button>
        </form>
      </div>
    </section>
  </main>

  <footer class="footer">
    <div>
      <a href="#">Help</a>
      <a href="#">Privacy Policy</a>
    </div>
    <div>
      <a href="#">Terms of Service</a>
    </div>
  </footer>

</body>
</html>
