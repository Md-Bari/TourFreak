<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tour Freak</title>
  <link rel="stylesheet" href="style.css">

</head>

<body>

  <div class="content">

    <nav class="navbar">
      <div class="navbar-brand">TourFreak</div>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Rooms</a></li>
        <li><a href="#">Facilities</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">About</a></li>
      </ul>
      <div class="navbar-buttons">
        <button>Login</button>
        <button>Register</button>
      </div>
    </nav>


    <section class="hero">
      <div>
        <img src="" alt="Hero image placeholder">
      </div>
    </section>


    <div class="booking-box">
      <h2>Tour Plan</h2>
      <form class="booking-form" action="{{ route('booking.store') }}" method="POST">
        @csrf
        <input type="date" name="check_in" required />
        <input type="date" name="check_out" required />

        <select name="adults" required>
          <option value="1">One Adult</option>
          <option value="2">Two Adults</option>
          <option value="3">Three Adults</option>
        </select>

        <select name="children" required>
          <option value="1">One Child</option>
          <option value="2">Two Children</option>
          <option value="3">Three Children</option>
        </select>

        <button type="submit">Submit</button>
      </form>

    </div>
  </div>


  <footer class="footer">
    <div class="footer-container">
      <p>&copy; 2025 Tour Freak. All rights reserved.</p>
      <ul class="footer-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">Support</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Service</a></li>
      </ul>
    </div>
  </footer>

</body>

</html>