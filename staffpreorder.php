<?php
// Database connection settings
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

// Handle order modifications and cancellations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = intval($_POST['order_id']);
    $action = $_POST['action'];

    if ($action === 'modify') {
        $quantity = intval($_POST['quantity']);
        $food = htmlspecialchars($_POST['food']);
        $prices = [
            'Kottu (L)' => 1000,
            'Fired Rice (L)' => 1200,
            'Pasta (L)' => 1100
        ];
        $price_per_item = isset($prices[$food]) ? $prices[$food] : 0;
        $total_price = $price_per_item * $quantity;

        $stmt = $conn->prepare("UPDATE orders SET food = ?, quantity = ?, total_price = ?, status = 'Modified' WHERE id = ?");
        $stmt->bind_param("siii", $food, $quantity, $total_price, $order_id);
        $stmt->execute();
        $stmt->close();
    } elseif ($action === 'cancel') {
        $stmt = $conn->prepare("UPDATE orders SET status = 'Cancelled' WHERE id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch orders
$result = $conn->query("SELECT * FROM orders");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Pre-Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-modify {
            background-color: #007bff;
            color: #fff;
        }

        .btn-modify:hover {
            background-color: #0056b3;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-cancel:hover {
            background-color: #c82333;
        }

        .form-inline {
            display: flex;
            align-items: center;
        }

        .form-inline input, .form-inline select {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Pre-Orders</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>NIC</th>
                    <th>Food</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['nic']; ?></td>
                        <td><?php echo $row['food']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['total_price']; ?></td>

                        <td>
                            <form action="manage_orders.php" method="post" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="modify">
                                <button type="submit" class="btn-modify">Modify</button>
                            </form>
                            <form action="manage_orders.php" method="post" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="cancel">
                                <button type="submit" class="btn-cancel">Cancel</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
