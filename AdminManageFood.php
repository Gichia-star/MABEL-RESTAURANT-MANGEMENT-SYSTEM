<?php
// Include the database connection file
include 'db_connection.php';

// Check if the request method is POST (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle file upload for product image
    $image = $_FILES['image']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));

    // SQL query to insert the new product into the database
    $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$imgContent')";

    // Execute the query and check if it was successful
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Food added successfully!'); window.location.href = 'AdminManageFood.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href = 'AdminManageFood.php';</script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Food Dashboard</title>
    <link rel="stylesheet" href="food.css">
    <script>
        // JavaScript function to validate the product form
        function validateProductForm() {
            var name = document.getElementById('name').value;
            var description = document.getElementById('description').value;
            var price = document.getElementById('price').value;
            var image = document.getElementById('image').value;

            if (name == "") {
                alert("Product name must be filled out");
                return false;
            }
            if (description == "") {
                alert("Product description must be filled out");
                return false;
            }
            if (price == "" || isNaN(price) || price <= 0) {
                alert("Valid product price must be filled out");
                return false;
            }

            if (image == "") {
                alert("Product image must be selected");
                return false;
            }
            return true;
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            margin-top: 18px;
            color: #333;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            width: 100%;
            margin-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"],
        button {
            margin-top: 5px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .logout {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .logout a {
            text-decoration: none;
            color: white;
            background-color: #ff4b4b;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .logout a:hover {
            background-color: #ff0000;
        }

        a.view-products {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        a.view-products:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Admin Manage Food Dashboard</h2>
    <div class="container">
        <h3>Add New Food</h3>
        <form action="AdminManageFood.php" method="post" enctype="multipart/form-data" onsubmit="return validateProductForm()">
            <label for="name">Food Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="description">Food Description:</label>
            <textarea id="description" name="description" required></textarea>
            <label for="price">Food Price:</label>
            <input type="number" step="0.01" id="price" name="price" required>
            <label for="image">Food Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <button type="submit">Add Food</button>
        </form>
        <a class="view-products" href="adminsystem.html">Back</a>
        <a class="view-products" href="Viewfood.php">View Available Products</a>
    </div>
</body>
</html>
