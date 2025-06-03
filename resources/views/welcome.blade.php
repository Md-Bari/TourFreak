<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tour Freak</title>
  <style>
    /* Reset */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html, body {
      height: 100%;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      font-family: Arial, sans-serif;
      background: #fff;
      line-height: 1.6;
    }

    .content {
      flex: 1;
    }

    /* Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-brand {
      font-weight: bold;
      font-size: 1.8rem;
    }

    .navbar ul {
      display: flex;
      list-style: none;
      gap: 1.5rem;
    }

    .navbar a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    .navbar-buttons {
      display: flex;
      gap: 0.5rem;
    }

    /* Booking Box */
    .booking-box {
      padding: 2rem;
      text-align: center;
    }

    .booking-form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      max-width: 300px;
      margin: auto;
    }

    .booking-form input,
    .booking-form select,
    .booking-form button {
      padding: 0.5rem;
      font-size: 1rem;
    }

    /* Footer */
    .footer {
      background: #f8f8f8;
      padding: 1.5rem 2rem;
      text-align: center;
      border-top: 1px solid #ddd;
    }

    .footer-container {
      max-width: 1200px;
      margin: auto;
    }

    .footer p {
      color: #555;
      margin-bottom: 0.5rem;
    }

    .footer-links {
      list-style: none;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
      padding: 0;
      margin: 0.5rem 0 0;
    }

    .footer-links a {
      text-decoration: none;
      color: #333;
      font-size: 0.95rem;
    }

    .footer-links a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="content">
    <!-- Navbar -->
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

    <!-- Hero Image -->
    <section class="hero">
      <div>
        <img src="" alt="">
      </div>
    </section>

    <!-- Booking Box -->
    <div class="booking-box">
      <h2>Tour Plan</h2>
      <form class="booking-form">
        <input type="date" placeholder="Check-In" />
        <input type="date" placeholder="Check-Out" />
        <select>
          <option>One Adult</option>
          <option>Two Adults</option>
          <option>Three Adults</option>
        </select>
        <select>
          <option>One Child</option>
          <option>Two Children</option>
          <option>Three Children</option>
        </select>
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>

  <!-- Footer -->
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
