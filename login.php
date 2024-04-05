<?php
session_start();

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'lms');

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Check if the user exists and the password is correct
    $sql = "SELECT * FROM customers WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) === 1) {
        // User found, log them in
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email;
        header('Location: landingpage.html ');
    } else {
        // Invalid credentials
        echo '<p class="message">Invalid school Email or password ! </p>';
    }
}

mysqli_close($db);