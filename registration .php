<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required keys exist in the $_POST array
    if (isset($_POST['name'], $_POST['email'], $_POST['phone_no'], $_POST['password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_no = $_POST['phone_no'];
        $password = $_POST['password'];

        $link = mysqli_connect('localhost', 'root', '', 'lms');
        if ($link === false) {
            die("Error: Unable to connect " . mysqli_connect_error());
        } else {
            $stmt = $link->prepare("INSERT INTO customers (name, email, phone_no, password) VALUES ( ?,  ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $email, $phone_no, $password);

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
