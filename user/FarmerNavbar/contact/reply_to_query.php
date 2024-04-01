

<?php


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


$sql = "SELECT * FROM queries";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display each question inside the .resourceBox3 container
        echo "<section class='blog-content margin1'>";
        echo "<div class='resourceBox3'>";
        echo "<h2>Question from: " . $row["name"] . "</h2><br>";
        echo "<h2>Category of issue: " . $row["category"] . "</h2><br>";
        echo "<p>" . $row["question"] . "</p>";
        echo "<a href='http://localhost/st20253489-ecofarming/Applyform/applicationForm.php' class='buttonClass4'>Click here to reply</a>";
        echo "</div>";
        echo "</section>";
    }
} else {
    echo "No queries found.";
}

mysqli_close($conn);
?>
