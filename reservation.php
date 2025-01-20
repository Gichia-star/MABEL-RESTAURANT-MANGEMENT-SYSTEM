<?php
// Establish a MySQL Database Connection
$connection = mysqli_connect("localhost", "root", "", "reservation");

// Connection validation check
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve and sanitize user input
$name = mysqli_real_escape_string($connection, $_POST['name']);
$nic_number = mysqli_real_escape_string($connection, $_POST['nic_number']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$phone = mysqli_real_escape_string($connection, $_POST['phone']);
$reservation_date = mysqli_real_escape_string($connection, $_POST['reservation_date']);
$reservation_time = mysqli_real_escape_string($connection, $_POST['reservation_time']);
$number_of_persons = (int)$_POST['number_of_persons'];
$message = mysqli_real_escape_string($connection, $_POST['message']);

// Check if all required fields are filled
if (empty($name) || empty($nic_number) || empty($email) || empty($phone) || empty($reservation_date) || empty($reservation_time) || empty($number_of_persons)) {
    echo "All fields are required.";
    exit();
}

// Insert reservation data into the database
$query = "INSERT INTO reservations (name, nic_number, email, phone, reservation_date, reservation_time, number_of_persons, message) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $connection->prepare($query);
$stmt->bind_param("ssssssis", $name, $nic_number, $email, $phone, $reservation_date, $reservation_time, $number_of_persons, $message);

if ($stmt->execute()) {
    echo "Reservation made successfully!";
    echo '<meta http-equiv="refresh" content="1;url=reservation.html">';
} else {
    echo "Error: " . $stmt->error;
}

// Close the prepared statement and database connection
$stmt->close();
mysqli_close($connection);
?>
