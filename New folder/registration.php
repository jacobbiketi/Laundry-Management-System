<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required keys exist in the $_POST array
    if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['confirm-password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_no = $_POST['phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        // Connect to the database
        $link = mysqli_connect('localhost', 'root', '', 'lms');
        if ($link === false) {
            die("Error: Unable to connect " . mysqli_connect_error());
        }

        // Check if the email already exists in the database
        $check_email_query = "SELECT * FROM customers WHERE email = '$email'";
        $check_email_result = mysqli_query($link, $check_email_query);

        if (mysqli_num_rows($check_email_result) > 0) {
            // Email already registered
            echo "<script>alert('Email already registered. Please use a different email address.'); window.location.href = 'login.html';</script>";
        } else {
            // Proceed with registration
            // Check if password matches confirm password
            if ($password === $confirm_password) {
                // Passwords match, proceed with database insertion
                $stmt = $link->prepare("INSERT INTO customers (name, email, phone_no, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $email, $phone_no, $password);

                if ($stmt->execute()) {
                    echo "<script>alert('Registration successful!');</script>";
                    
                } else {
                    echo "<script>alert('Error: " . $stmt->error . "');</script>";
                }

                $stmt->close();
            } else {
                // Passwords do not match
                echo "<script>alert('Error: Passwords do not match.');</script>";
            }
        }

        // Close database connection
        mysqli_close($link);
    } else {
        echo "<script>alert('Error: Required fields are missing.');</script>";
    }
} else {
    echo "<script>alert('Error: Form not submitted.');</script>";
}
?>
