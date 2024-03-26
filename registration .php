<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required keys exist in the $_POST array
    if (isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        $link = mysqli_connect('localhost', 'root', '', 'graduation');
        if ($link === false) {
            die("Error: Unable to connect " . mysqli_connect_error());
        } else {
            $stmt = $link->prepare("INSERT INTO customers (first_name, last_name, email,phone, password) VALUES (?, ?,  ?, ?, ?)");
            $stmt->bind_param("sssss", $first_name, $last_name, $email,$phone, $password);

            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $link->close();
        }
    } else {
        echo "Error: Required fields are missing.";
    }
} else {
    echo "Error: Form not submitted.";
}
?>
