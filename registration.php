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

        // Check if password matches confirm password
        if ($password === $confirm_password) {
            // Passwords match, proceed with database insertion
            $link = mysqli_connect('localhost', 'root', '', 'lms');
            if ($link === false) {
                die("Error: Unable to connect " . mysqli_connect_error());
            } else {
                $stmt = $link->prepare("INSERT INTO customers (name, email, phone_no, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $email, $phone_no, $password);

                if ($stmt->execute()) {
                    echo "Registration successful!";
                    
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
                $link->close();
            }
        } else {
            // Passwords do not match
            echo "Error: Passwords do not match.";
        }
    } else {
        echo "Error: Required fields are missing.";
    }
} else {
    echo "Error: Form not submitted.";
}
?>
