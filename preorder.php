<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $nic = htmlspecialchars($_POST['nic']);
    $food = htmlspecialchars($_POST['food']);
    $quantity = intval($_POST['quantity']);
    
    // Define prices for each food item
    $prices = [
        'Chicken Kottu' => 1000,   
        'Cheese Kottu' => 1300,
        'Vegetable Kottu' => 800,
        'Chicken Fried Rice' => 1200,   
        'Vegetable Fried Rice' => 1000,
        'Sea Food Fried Rice' => 1500,
        'Chicken Pasta' => 1100,   
        'Cheese Pasta' => 1600,
        'Coke' => 150,
        'Pepsi' => 200,   
        'Sprite' => 150,
        'BBQ Chicken Salad' => 700,
        'Harvest Cobb Salad' => 500,
        'Bacon and Avocado Macaroni Salad' => 1000
    ];
    
    // Calculate total price
    $price_per_item = isset($prices[$food]) ? $prices[$food] : 0;
    $total_price = $price_per_item * $quantity;

    // Simple validation (optional)
    if (!empty($name) && !empty($nic) && !empty($food) && $quantity > 0) {
        // Connect to the database (replace with your connection details)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "preorder_system";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO orders (name, nic, food, quantity, total_price) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $name, $nic, $food, $quantity, $total_price);

        // Execute the query
        if ($stmt->execute()) {
            $message = "Order placed successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        // Close connection
        $stmt->close();
        $conn->close();
    } else {
        $message = "Please fill out all fields and select a valid quantity.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Order Food</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
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

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #333;
        }

        input, select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button, .back-btn {
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;  /* Removes underline from link */
            display: block;
            margin-top: 10px;
        }

        button:hover, .back-btn:hover {
            background-color: #218838;
        }

        .message {
            margin-top: 20px;
            font-weight: bold;
            color: #d9534f;
        }

        .message.success {
            color: #5bc0de;
        }

        .back-btn {
            background-color: #dc3545;
            text-align: center;
        }

        .back-btn:hover {
            background-color: #c82333;
        }

        #price {
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
    <script>
        function updatePrice() {
            var food = document.getElementById('food').value;
            var quantity = parseInt(document.getElementById('quantity').value) || 0;
            var pricePerItem = {
                'Chicken ': 1000,
                'Cheese burger': 1300,
                'Vegetable ': 800,
                'Chicken Fried Rice': 1200,
                'Vegetable Fried Rice': 1000,
                'Sea Food Fried Rice': 1500,
                'Chicken Pasta': 1100,
                'Cheese Pasta': 1600,
                'Coke': 150,
                'Pepsi': 200,
                'Sprite': 150,
                'BBQ Chicken Salad': 700,
                'Harvest Cobb Salad': 500,
                'Bacon and Avocado Macaroni Salad': 1000
            };
            var totalPrice = (pricePerItem[food] || 0) * quantity;
            document.getElementById('price').innerText = 'Total Price: Ksh ' + totalPrice;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Pre-Order Your Food</h1>
        <form action="preorder.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="nic">Contact:</label>
            <input type="text" id="nic" name="nic" required>

            <label for="food">Select Food:</label>
            <select id="food" name="food" required onchange="updatePrice()">
                <option value="Chicken ">Chicken </option>
                <option value="Cheese">Cheese </option>
                <option value="Vegetable salad ">Vegetables </option>
                <option value="Chicken Fried Rice">Chicken Fried Rice</option>
                <option value="Vegetable Fried Rice">Vegetable Fried Rice</option>
                <option value="Sea Food Fried Rice">Sea Food Fried Rice</option>
                <option value="Chicken Pasta">Chicken Pasta</option>
                <option value="Cheese Pasta">Cheese Pasta</option>
                <option value="Coke">Coke</option>
                <option value="Pepsi">Pepsi</option>
                <option value="Sprite">Sprite</option>
                <option value="BBQ Chicken Salad">BBQ Chicken Salad</option>
                <option value="Harvest Cobb Salad">Harvest Cobb Salad</option>
                <option value="Bacon and Avocado Macaroni Salad">Bacon and Avocado Macaroni Salad</option>
            </select>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" required onchange="updatePrice()">

            <div id="price">Total Price:Ksh 0</div>

            <button type="submit">Pre-Order</button>
            <a href="index.php" class="back-btn">Back</a>
        </form>

        <?php if (isset($message)): ?>
            <div class="message <?php echo strpos($message, 'Error') === false ? 'success' : ''; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
