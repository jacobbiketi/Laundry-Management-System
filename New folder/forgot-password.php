<?php

// Database connection parameters
$servername = "localhost";
$username = "username";
$password = "password";
$database = "database_name";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter a valid email address.";
  } else {
    // Check if email exists in the database
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
      // Generate a random password reset token
      $token = bin2hex(random_bytes(16));

      // Update user record with token and expiry time
      $sql = "UPDATE users SET reset_token = ?, reset_token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ss", $token, $email);
      mysqli_stmt_execute($stmt);

      // Send password reset email with link
      // You need to implement the email sending logic here
      // Replace 'your_website' with your actual website address
      $link = "http://your_website/reset-password.php?token=" . $token;
      $message = "Click the following link to reset your password:\n" . $link;
      // Use a library like PHPMailer to send the email securely
      // You can find tutorials on sending emails with PHP online
      mail($email, "Password Reset Request", $message);

      $success = "A password reset link has been sent to your email address.";
    } else {
      $error = "The email address you entered is not associated with any account.";
    }

    mysqli_stmt_close($stmt);
  }
}

mysqli_close($conn); // Close database connection

?>
