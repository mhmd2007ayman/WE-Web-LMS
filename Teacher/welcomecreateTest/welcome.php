<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      .borderRaduis{
    border-radius: 15px
}
.mmrde{
  left: 0rem;
}
    </style>
    <?php include('../../redundecyCode/linkBootstrap2.php')  ?>
    <link rel='stylesheet' href='welcome.css'> 
    <title>welcome</title>
</head>
<body>
<?php   include('../../redundecyCode/navbarTeacher.php') ?>
    <!-- Hero Section -->
  <section class="hero">
    <h1>Design Interactive Tests Like Never Before</h1>
    <p>Create. Share. Analyze. All in one place.</p>
    <div class="cta-buttons">
      <a href="../createTest/test.php">Get Started</a>
      <a href="../TestManagement/TestManagement.php">Test Management</a>
      <a href="#about">Learn How </a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features" id="features">
    <h2>Features</h2>
    <div class="feature-cards">
      <div class="feature-card">
        <h3>Easy Quiz Creation</h3>
        <p>Create quizzes in minutes with our intuitive drag-and-drop builder.</p>
      </div>
      <div class="feature-card">
        <h3>Real-Time Analytics</h3>
        <p>Track responses and analyze quiz performance in real-time.</p>
      </div>
      <div class="feature-card">
        <h3>Customizable Themes</h3>
        <p>Make your quizzes visually stunning with our theme editor.</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>
      <a href="#">WE Web</a>. All rights reserved.
    </p>
  </footer>

  <?php include('../../redundecyCode/linkBootstrapJs.php') ?>
</body>
</html>