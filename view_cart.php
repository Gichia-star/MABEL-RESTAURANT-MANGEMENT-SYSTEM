<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "preorder_system"; // Replace with your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the cart exists and initialize it as an array if it doesn't
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Initialize as an empty array
}

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty. <a href='menu.php'>Go back to Menu</a></p>";
    exit();
}

// Handle item removal
if (isset($_POST['remove_from_cart'])) {
    $productId = $_POST['product_id'];

    // Remove item from the cart if it exists
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }

    // Redirect to avoid form resubmission
    header("Location: view_cart.php");
    exit();
}

// Handle order submission
if (isset($_POST['make_order'])) {
    $orderDetails = json_encode($_SESSION['cart']); // Convert cart to JSON for storage
    $totalAmount = 0;

    foreach ($_SESSION['cart'] as $item) {
        if (is_array($item)) {
            $totalAmount += $item['price'] * $item['quantity'];
        }
    }

    $stmt = $conn->prepare("INSERT INTO orders (name, nic, food, quantity, total_price) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $name, $nic, $food, $quantity, $total_price);

    if ($stmt->execute()) {
        echo "<p>Order successfully placed! <a href='menu.php'>Continue Shopping</a></p>";
        $_SESSION['cart'] = []; // Clear the cart
        exit();
    } else {
        echo "<p>Failed to place order. Please try again later.</p>";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f39c12;
            color: white;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            padding: 10px 20px;
            text-align: center;
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 1em;
            text-transform: uppercase;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: linear-gradient(45deg, #0056b3, #003f7f);
        }
        .btn-remove {
            background: linear-gradient(45deg, #dc3545, #a71d2a);
        }
        .btn-remove:hover {
            background: linear-gradient(45deg, #a71d2a, #7a101f);
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
        }
        .back-btn {
            text-decoration: none;
            padding: 10px 20px;
            background: linear-gradient(45deg, #6c757d, #494e52);
            color: white;
            border-radius: 4px;
            font-size: 1em;
            text-align: center;
            transition: background 0.3s ease;
        }
        .back-btn:hover {
            background: linear-gradient(45deg, #494e52, #33373b);
        }
    </style>
</head>
<body>
    <h1>Your Cart</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php
        $grandTotal = 0;
        foreach ($_SESSION['cart'] as $id => $item) {
            // Ensure $item is an array
            if (!is_array($item)) {
                continue;
            }

            $total = $item['price'] * $item['quantity'];
            $grandTotal += $total;

            echo "<tr>
                    <td>{$item['name']}</td>
                    <td>Ksh {$item['price']}</td>
                    <td>{$item['quantity']}</td>
                    <td>Ksh {$total}</td>
                    <td>
                        <form method='POST' action='view_cart.php'>
                            <input type='hidden' name='product_id' value='{$id}'>
                            <button type='submit' name='remove_from_cart' class='btn btn-remove'>Remove</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
        <tr>
            <td colspan="3"><strong>Grand Total</strong></td>
            <td colspan="2"><strong>Ksh <?php echo $grandTotal; ?></strong></td>
        </tr>
    </table>

    <div class="btn-container">
        <form method="POST" action="view_cart.php">
            <button type="submit" name="make_order" class="btn">Make Order</button>
        </form>
        <a href="payment.php" class="btn">Make Payment</a>
        <a href="menu.php" class="back-btn">Back to Menu</a>
    </div>
</body>
</html>
