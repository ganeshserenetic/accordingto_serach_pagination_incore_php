<?php
include_once 'db.php';



try {
    // Get the email from the POST data
    $email = $_POST['email'];
    // error_log("Received email: " . $email); // Log the received email
    

    // Prepare the query using a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT email FROM company WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Count the number of rows returned
    $count = $stmt->rowCount();

    // Check if there are any rows returned
    if ($count > 0) {
        echo json_encode(FALSE); // Email exists
    } else {
        echo json_encode(TRUE); // Email does not exist
    }
} catch(PDOException $e) {
    // Handle any errors
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>
