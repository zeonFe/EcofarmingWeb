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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get the form data
    $eventName = $_POST['eventName'];
    $eventDescription = $_POST['eventDescription'];
    $eventDate = $_POST['eventDate'];

    // Process the image upload
    $targetDir = "event_images/"; // Create a directory to store event images
    $targetFile = $targetDir . basename($_FILES["eventImage"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the image file is valid
    if (getimagesize($_FILES["eventImage"]["tmp_name"]) === false) {
        echo "Invalid image file.";
    } else {

        // Upload the image
        if (move_uploaded_file($_FILES["eventImage"]["tmp_name"], $targetFile)) {
            // Insert event details into the database
            $imagePath = $targetFile; // Store the file path in a variable
            $sql = "INSERT INTO events (eventName, eventDescription, eventDate, eventImage) 
                    VALUES ('$eventName', '$eventDescription', '$eventDate', '$imagePath')";

            if (mysqli_query($conn, $sql)) {
                echo "Event added successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading the image.";
        }
    }
}
// Close the database connection
mysqli_close($conn);

?>
