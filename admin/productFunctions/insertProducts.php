<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

session_start(); // Start the session to access session variables

// Database configuration
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecoFarmingDB";

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get data from the registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $phoneno = test_input($_POST["phoneno"]);
    $category = test_input($_POST["category"]);
    $district = test_input($_POST["district"]);
    $address = test_input($_POST["address"]);
    $question = test_input($_POST["question"]);
}
    // Basic validation
    if (empty($name) || empty($username) || empty($email) || empty($phoneno) || empty($category) || empty($district) || empty($address) || empty($question)) {
        echo "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } else {
        // Insert the validated data into the database
        $sql = "INSERT INTO queries (name, username, email, phoneno, category, district, address, question)
                VALUES ('$name', '$username', '$email', '$phoneno', '$category', '$district', '$address', '$question')";

        if ($conn->query($sql) === TRUE) {
            echo "Query saved successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

// Close the database connection
mysqli_close($conn);

?>
