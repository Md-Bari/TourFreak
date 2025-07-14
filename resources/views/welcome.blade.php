<!DOCTYPE html>
<html lang="en">
<head>


  <meta charset="UTF-8">
  <title>Gozayaan Clone</title>
  <link rel="stylesheet" href="style.css">
<style>
  body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: #f1f5f9;
}

header {
  background: #ffffff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.logo {
  font-size: 24px;
  font-weight: bold;
  color: #003580;
}

nav ul {
  display: flex;
  gap: 20px;
  list-style: none;
}

nav a {
  text-decoration: none;
  color: #003580;
  font-weight: 500;
}

.signin button {
  background: #000080;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  cursor: pointer;
  border-radius: 4px;
}

.search-section {
  background: url('https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1') no-repeat center center/cover;
  padding: 3rem;
  text-align: center;
  color: white;
}

.search-section form {
  background: rgba(255, 255, 255, 0.9);
  padding: 1rem;
  border-radius: 8px;
  display: inline-block;
}

.search-section input, .search-section button {
  margin: 0.5rem;
  padding: 0.5rem;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.search-section button {
  background: #ffc107;
  color: black;
  font-weight: bold;
}

.how-to, .deals, .special {
  padding: 2rem;
  text-align: center;
}

.card, .deal, .offer {
  background: white;
  padding: 1rem;
  margin: 1rem;
  display: inline-block;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  width: 200px;
}

footer {
  background: #001f3f;
  color: white;
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  text-align: center;
}

.footer-links a {
  color: white;
  margin: 0 10px;
  text-decoration: none;
}
</style>

</head>
<body>
  <header>
    <div class="logo">Gozayaan</div>
    <nav>
      <ul>
        <li><a href="#">Flight</a></li>
        <li><a href="#">Hotel</a></li>
        <li><a href="#">Tour</a></li>
        <li><a href="#">Visa</a></li>
        <li><a href="#">Gift Card</a></li>
      </ul>
    </nav>
    <div class="signin">
      <button>Sign In</button>
    </div>
  </header>

  <section class="search-section">
    <form action="search.php" method="GET">
      <div class="trip-type">
        <label><input type="radio" name="trip" checked> One Way</label>
        <label><input type="radio" name="trip"> Round Way</label>
      </div>
      <input type="text" name="from" placeholder="From: Dhaka">
      <input type="text" name="to" placeholder="To: Cox's Bazar">
      <input type="date" name="date">
      <input type="number" name="travelers" placeholder="Travelers">
      <button type="submit">Search</button>
    </form>
  </section>

  <section class="how-to">
    <div class="card">কিভাবে ফ্লাইট বুক করবেন?</div>
    <div class="card">কিভাবে হোটেল বুক করবেন?</div>
    <div class="card">কিভাবে ডিসকাউন্ট পাবেন?</div>
  </section>

  <section class="deals">
    <h2>Hot Deals</h2>
    <div class="deal">18% Discount - City Bank</div>
    <div class="deal">10% Discount - bKash</div>
    <div class="deal">11% Discount - bKash</div>
  </section>

  <section class="special">
    <h2>Special Offers</h2>
    <div class="offer">Free Hotel in Istanbul</div>
    <div class="offer">Fly to Bangkok</div>
    <div class="offer">Fly to Kathmandu</div>
  </section>

  <footer>
    <div class="footer-links">
      <a href="#">Home</a>
      <a href="#">Refund Policy</a>
      <a href="#">Privacy Policy</a>
    </div>
    <div class="contact">
      Email: info@gozayaan.com | Phone: 09678 332211
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>
