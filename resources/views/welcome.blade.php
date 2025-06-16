<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tour Freak</title>
  <style>
    
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
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f4f8;
      line-height: 1.6;
    }

    .content {
      flex: 1;
    }

    
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background: linear-gradient(to right, #2e8b57, #3cb371);
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-brand {
      font-weight: bold;
      font-size: 1.8rem;
      color: #fff;
    }

    .navbar ul {
      display: flex;
      list-style: none;
      gap: 1.5rem;
    }

    .navbar a {
      text-decoration: none;
      color: #f8f8f8;
      font-weight: 500;
    }

    .navbar-buttons button {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 4px;
      background-color: #fff;
      color: #2e8b57;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s;
    }

    .navbar-buttons button:hover {
      background-color: #e6f2ec;
    }

    .navbar-buttons {
      display: flex;
      gap: 0.5rem;
    }

    
    .hero img {
      width: 100%;
      height: auto;
      max-height: 400px;
      object-fit: cover;
      background-color: #ccc;
    }

    
    .booking-box {
      padding: 2rem;
      text-align: center;
      background: #ffffff;
      margin: 2rem auto;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      max-width: 600px;
    }

    .booking-box h2 {
      color: #2e8b57;
      margin-bottom: 1rem;
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
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .booking-form button {
      background-color: #2e8b57;
      color: #fff;
      font-weight: bold;
      border: none;
      cursor: pointer;
    }

    .booking-form button:hover {
      background-color: #276c4a;
    }

    
    .footer {
      background: #2e8b57;
      padding: 1.5rem 2rem;
      text-align: center;
      color: #f1f1f1;
    }

    .footer-container {
      max-width: 1200px;
      margin: auto;
    }

    .footer p {
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
      color: #f1f1f1;
      font-size: 0.95rem;
    }

    .footer-links a:hover {
      text-decoration: underline;
    }
  </style>
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
