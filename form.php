<?php
// Getting all values from the HTML form
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['Password'];

    // Database details
    $host = "localhost";
    $username = "root";
    $dbpassword = ""; 
    $dbname = "Login";

    // Creating a connection
    $con = mysqli_connect($host, $username, $dbpassword, $dbname);

    // Ensure that the connection is successful
    if (!$con) {
        die("Connection failed!" . mysqli_connect_error());
    }

    
    $query = "SELECT * FROM form WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "Email ID already exists";
    } else {
       
        $hashedPassword = md5($password);

        // Query to insert the new record
        $insertQuery = "INSERT INTO form (id, email, Password) VALUES ('0', '$email', '$hashedPassword')";
        $insertResult = mysqli_query($con, $insertQuery);

        if ($insertResult) {
            echo "Entries added!";
        } else {
            echo "Error: " . mysqli_error($con); // Display error message if query fails
        }
    }

    // Close connection
    mysqli_close($con);
}
?>




