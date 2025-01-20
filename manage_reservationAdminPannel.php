<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservation"; // Updated database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling cancellation
if (isset($_GET['action']) && $_GET['action'] == 'cancel' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $reservation_id = $_GET['id'];
    $sql = "UPDATE reservations SET confirmed = 0 WHERE id = $reservation_id"; // Updated query to mark reservation as not confirmed

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Reservation cancelled successfully.'); window.location.href='?';</script>";
    } else {
        echo "<script>alert('Error cancelling reservation: " . $conn->error . "');</script>";
    }
}

// Handling deletion
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $reservation_id = $_GET['id'];
    $sql = "DELETE FROM reservations WHERE id = $reservation_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Reservation deleted successfully.'); window.location.href='?';</script>";
    } else {
        echo "<script>alert('Error deleting reservation: " . $conn->error . "');</script>";
    }
}

// Handling edit form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reservation_id'])) {
    $reservation_id = $_POST['reservation_id'];
    $name = $_POST['name'];
    $nic_number = $_POST['nic_number'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $number_of_persons = $_POST['number_of_persons'];
    $message = $_POST['message'];

    $sql = "UPDATE reservations SET name='$name', nic_number='$nic_number', email='$email', phone='$phone', reservation_date='$reservation_date', reservation_time='$reservation_time', number_of_persons=$number_of_persons, message='$message' WHERE id=$reservation_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Reservation updated successfully.'); window.location.href='?';</script>";
    } else {
        echo "<script>alert('Error updating reservation: " . $conn->error . "');</script>";
    }
}

// Fetch reservations from the database
$sql = "SELECT id, name, nic_number, email, phone, reservation_date, reservation_time, number_of_persons, message, confirmed FROM reservations";
$result = $conn->query($sql);

// Start HTML output
echo "<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<title>Reservation Management</title>
<style>
  body { font-family: 'Arial', sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
  .container { width: 93%; margin: auto; overflow: hidden; }
  header { background: #333; color: #fff; padding: 10px 0; text-align: center; }
  table { width: 100%; border-collapse: collapse; margin: 30px 0; }
  th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
  th { background-color: #4CAF50; color: white; }
  tr:nth-child(even) { background-color: #f2f2f2; }
  .btn-edit, .btn-cancel, .btn-delete { border: none; padding: 8px 12px; cursor: pointer; border-radius: 5px; }
  .btn-edit { background-color: #007BFF; color: white; }
  .btn-edit:hover { background-color: #0056b3; }
  .btn-cancel { background-color: #dc3545; color: white; }
  .btn-cancel:hover { background-color: #c82333; }
  .btn-delete { background-color: #dc3545; color: white; }
  .btn-delete:hover { background-color: #c82333; }
  .form-container { background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
  form { display: flex; flex-direction: column; }
  label { margin-bottom: 5px; }
  input[type='text'], input[type='number'], input[type='datetime-local'], input[type='date'], input[type='time'] { padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px; }
  button[type='submit'] { background-color: #4CAF50; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; }
  button[type='submit']:hover { background-color: #45a049; }
  .alert { padding: 15px; margin: 20px 0; border-radius: 5px; }
  .alert-success { background-color: #d4edda; color: #155724; }
  .alert-danger { background-color: #f8d7da; color: #721c24; }
  .back-btn {
      display: inline-block;
      padding: 10px 20px;
      margin: 20px 0;
      color: white;
      background-color: #007BFF;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      transition: background-color 0.3s ease;
  }
  .back-btn:hover {
      background-color: #0056b3;
  }
</style>
</head>
<body>
<header>
    <h1>Reservation Management</h1>
</header>
<div class='container'>";

// Check if a reservation ID is provided for editing
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $sql = "SELECT * FROM reservations WHERE id = $edit_id";
    $reservation_result = $conn->query($sql);
    $reservation = $reservation_result->fetch_assoc();

    if ($reservation) {
        echo "<div class='form-container'>
        <h2>Edit Reservation</h2>
        <form method='POST'>
            <input type='hidden' name='reservation_id' value='{$reservation['id']}'>
            <label for='name'>Name:</label>
            <input type='text' id='name' name='name' value='".htmlspecialchars($reservation['name'])."' required>
            <label for='nic_number'>NIC Number:</label>
            <input type='text' id='nic_number' name='nic_number' value='".htmlspecialchars($reservation['nic_number'])."' required>
            <label for='email'>Email:</label>
            <input type='text' id='email' name='email' value='".htmlspecialchars($reservation['email'])."' required>
            <label for='phone'>Phone:</label>
            <input type='text' id='phone' name='phone' value='".htmlspecialchars($reservation['phone'])."' required>
            <label for='reservation_date'>Reservation Date:</label>
            <input type='date' id='reservation_date' name='reservation_date' value='".htmlspecialchars($reservation['reservation_date'])."' required>
            <label for='reservation_time'>Reservation Time:</label>
            <input type='time' id='reservation_time' name='reservation_time' value='".htmlspecialchars($reservation['reservation_time'])."' required>
            <label for='number_of_persons'>Number of Persons:</label>
            <input type='number' id='number_of_persons' name='number_of_persons' value='".htmlspecialchars($reservation['number_of_persons'])."' required>
            <label for='message'>Message:</label>
            <input type='text' id='message' name='message' value='".htmlspecialchars($reservation['message'])."' required>
            <button type='submit'>Update Reservation</button>
        </form>
        </div>";
    }
} else {
    // Display reservations table
    echo "<table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>NIC Number</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Reservation Date</th>
        <th>Reservation Time</th>
        <th>Number of Persons</th>
        <th>Message</th>
        <th>Confirmed</th>
        <th>Cancel</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>";

    if ($result->num_rows > 0) {
        echo "<!-- Debug: Found " . $result->num_rows . " reservations -->"; // Debug statement
        while($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>".$row["id"]."</td>
              <td>".$row["name"]."</td>
              <td>".$row["nic_number"]."</td>
              <td>".$row["email"]."</td>
              <td>".$row["phone"]."</td>
              <td>".$row["reservation_date"]."</td>
              <td>".$row["reservation_time"]."</td>
              <td>".$row["number_of_persons"]."</td>
              <td>".$row["message"]."</td>
              <td>".($row["confirmed"] ? "Yes" : "No")."</td>
              <td>".($row["confirmed"] ? "<button class='btn-cancel' onclick='cancelReservation(".$row["id"].")'>Cancel</button>" : "Cancelled")."</td>
              <td><button class='btn-edit' onclick='editReservation(".$row["id"].")'>Edit</button></td>
              <td><button class='btn-delete' onclick='deleteReservation(".$row["id"].")'>Delete</button></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='13'>No reservations found</td></tr>";
    }
    echo "</table>";
}

// Back button
echo "<a href='adminsystem.html' class='back-btn'>Back to Admin System</a>";

echo "</div>
<script>
function cancelReservation(id) {
    var confirmCancel = confirm('Are you sure you want to cancel this reservation?');
    if (confirmCancel) {
        window.location.href = '?action=cancel&id=' + id;
    }
}

function editReservation(id) {
    window.location.href = '?edit=' + id;
}

function deleteReservation(id) {
    var confirmDelete = confirm('Are you sure you want to delete this reservation?');
    if (confirmDelete) {
        window.location.href = '?action=delete&id=' + id;
    }
}
</script>
</body>
</html>";
$conn->close();
?>
