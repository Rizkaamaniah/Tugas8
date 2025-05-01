<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = ""; 
$dbname = "contact_form_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $success = "Thank you, $name! Your message has been saved.";
    } else {
        $success = "Sorry, there was an error: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>UIFry - Launch Your Software Website</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { padding: 2rem; }
    .hero-img { max-width: 100%; height: auto; border-radius: 10px; }
    .rounded-btn { border-radius: 10px; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
  <div class="container">
    <a class="navbar-brand" href="#"><strong>uifry</strong></a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
      </ul>
      <a class="btn btn-outline-dark ms-3" href="#contact">Contact Now</a>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="container">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h1 class="fw-bold">Launch a software businesses website today with us!</h1>
      <p class="mt-3">Launch a business today with our help and get it done with amazing launch features, websites and more with uifry. We help businesses like yours thrive every day and beyond.</p>
      <a href="#contact" class="btn btn-danger rounded-btn me-2">Contact Now</a>
      <a href="#contact" class="btn btn-outline-dark rounded-btn">Book a Demo Today</a>
      </br>
       </br>
      <a href="#contact" class="btn btn-danger rounded-btn me-2"><span class="text-warning">&#9733;</span>  Rated 4.9 out of 1200 reviews</a> 
    </div>
    <div class="col-md-6 text-center">
      <img src="1.jpg" alt="Image" class="hero-img">
    </div>
  </div>
</div>


<div class="container mt-5" id="contact">
  <h2>Contact Us</h2>
  <?php if ($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
  <?php endif; ?>
  <form method="post" action="">
    <div class="mb-3">
      <label for="name" class="form-label">Your Name</label>
      <input type="text" class="form-control" name="name" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Your Email</label>
      <input type="email" class="form-control" name="email" required>
    </div>
    <div class="mb-3">
      <label for="message" class="form-label">Your Message</label>
      <textarea class="form-control" name="message" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-danger rounded-btn me-2">Send Message</button>
  </form>
</div>

</body>
</html>
