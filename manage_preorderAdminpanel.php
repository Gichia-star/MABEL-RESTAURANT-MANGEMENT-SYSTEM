<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "preorder_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling cancellation
if (isset($_GET['action']) && $_GET['action'] == 'cancel' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $order_id = $_GET['id'];
    $sql = "UPDATE orders SET cancellation_reason = 'Cancelled' WHERE id = $order_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Order cancelled successfully.'); window.location.href='?';</script>";
    } else {
        echo "<script>alert('Error cancelling order: " . $conn->error . "');</script>";
    }
}

// Handling deletion
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $order_id = $_GET['id'];
    $sql = "DELETE FROM orders WHERE id = $order_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Order deleted successfully.'); window.location.href='?';</script>";
    } else {
        echo "<script>alert('Error deleting order: " . $conn->error . "');</script>";
    }
}

// Handling edit form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $food = $_POST['food'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];

    $sql = "UPDATE orders SET name='$name', nic='$nic', food='$food', quantity=$quantity, total_price=$total_price WHERE id=$order_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Order updated successfully.'); window.location.href='?';</script>";
    } else {
        echo "<script>alert('Error updating order: " . $conn->error . "');</script>";
    }
}

// Fetch orders from the database
$sql = "SELECT id, name, nic, food, quantity, total_price, cancellation_reason FROM orders";
$result = $conn->query($sql);

// Start HTML output
echo "<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<title>Preorder Management</title>
<style>
  body { font-family: 'Arial', sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
  .container { width: 80%; margin: auto; overflow: hidden; }
  header { background: #333; color: #fff; padding: 10px 0; text-align: center; }
  table { width: 100%; border-collapse: collapse; margin: 20px 0; }
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
  input[type='text'], input[type='number'] { padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px; }
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
    <h1>Preorder Management</h1>
</header>
<div class='container'>";

// Check if an order ID is provided for editing
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $sql = "SELECT * FROM orders WHERE id = $edit_id";
    $order_result = $conn->query($sql);
    $order = $order_result->fetch_assoc();

    if ($order) {
        echo "<div class='form-container'>
        <h2>Edit Order</h2>
        <form method='POST'>
            <input type='hidden' name='order_id' value='{$order['id']}'>
            <label for='name'>Name:</label>
            <input type='text' id='name' name='name' value='".htmlspecialchars($order['name'])."' required>
            <label for='nic'>NIC:</label>
            <input type='text' id='nic' name='nic' value='".htmlspecialchars($order['nic'])."' required>
            <label for='food'>Food:</label>
            <input type='text' id='food' name='food' value='".htmlspecialchars($order['food'])."' required>
            <label for='quantity'>Quantity:</label>
            <input type='number' id='quantity' name='quantity' value='".htmlspecialchars($order['quantity'])."' required>
            <label for='total_price'>Total Price:</label>
            <input type='number' id='total_price' name='total_price' value='".htmlspecialchars($order['total_price'])."' required>
            <button type='submit'>Update Order</button>
        </form>
        </div>";
    }
} else {
    // Display orders table
    echo "<table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>NIC</th>
        <th>Food</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Cancel</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>";

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $cancellationStatus = $row["cancellation_reason"] ? $row["cancellation_reason"] : "Not Cancelled";
            echo "<tr>
              <td>".$row["id"]."</td>
              <td>".$row["name"]."</td>
              <td>".$row["nic"]."</td>
              <td>".$row["food"]."</td>
              <td>".$row["quantity"]."</td>
              <td>".$row["total_price"]."</td>
              <td>".($cancellationStatus !== "Cancelled" ? "<button class='btn-cancel' onclick='cancelOrder(".$row["id"].")'>Cancel</button>" : $cancellationStatus)."</td>
              <td><button class='btn-edit' onclick='editOrder(".$row["id"].")'>Edit</button></td>
              <td><button class='btn-delete' onclick='deleteOrder(".$row["id"].")'>Delete</button></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No orders found</td></tr>";
    }
}

// Back button
echo "<a href='adminsystem.html' class='back-btn'>Back to Admin System</a>";

echo "</div>
<script>
function cancelOrder(id) {
    var confirmCancel = confirm('Are you sure you want to cancel this order?');
    if (confirmCancel) {
        window.location.href = '?action=cancel&id=' + id;
    }
}

function editOrder(id) {
    window.location.href = '?edit=' + id;
}

function deleteOrder(id) {
    var confirmDelete = confirm('Are you sure you want to delete this order?');
    if (confirmDelete) {
        window.location.href = '?action=delete&id=' + id;
    }
}
</script>
</body>
</html>";
$conn->close();
?>
