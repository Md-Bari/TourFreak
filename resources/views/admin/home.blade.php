<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin.css"/>
</head>
<body>
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
      <li onclick="showSection('dashboard')">Dashboard</li>
      <li onclick="showSection('addTour')">Add Tour Package</li>
      <li onclick="showSection('updateImages')">Update Photos</li>
      <li onclick="showSection('updatePricing')">Change Pricing</li>
      <li onclick="showSection('viewBookings')">View Bookings</li>
      <li onclick="showSection('dailyOrders')">Daily Orders</li>
    </ul>
  </div>

  <div class="main-content">
    <section id="dashboard" class="content-section">
      <h1>Welcome, Admin</h1>
      <p>Manage your tour website content from this panel.</p>
    </section>

    <section id="addTour" class="content-section hidden">
      <h2>Add Tour Package</h2>
      <form>
        <input type="text" placeholder="Tour Title" required />
        <textarea placeholder="Description" required></textarea>
        <input type="number" placeholder="Price" required />
        <input type="file" />
        <button type="submit">Add Package</button>
      </form>
    </section>

    <section id="updateImages" class="content-section hidden">
      <h2>Update Main Section Photos</h2>
      <form>
        <input type="file" required />
        <button type="submit">Upload Photo</button>
      </form>
    </section>

    <section id="updatePricing" class="content-section hidden">
      <h2>Change Tour Pricing</h2>
      <form>
        <select>
          <option>Select Tour</option>
          <option>Hill Districts</option>
          <option>Sundarbans</option>
          <option>Sea Beach</option>
        </select>
        <input type="number" placeholder="New Price" required />
        <button type="submit">Update Price</button>
      </form>
    </section>

    <section id="viewBookings" class="content-section hidden">
      <h2>User Bookings</h2>
      <p>Display user tour bookings here (connect with Laravel backend).</p>
    </section>

    <section id="dailyOrders" class="content-section hidden">
      <h2>Daily Orders Summary</h2>
      <p>Show daily sales/order graph or summary here (use Laravel data).</p>
    </section>
  </div>

  <script src="admin.js"></script>
</body>
</html>
