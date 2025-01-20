<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff System Interface</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <style>
        /* Reset and box-sizing */
        * {
            margin: 5;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            color: #333;
        }

        /* Container styling */
        .container {
            width: 90%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header styling */
        header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #6200ea;
            color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 2.5em;
            font-weight: 300;
        }

        /* Navigation styling */
        nav {
            background-color: #6200ea;
            color: #fff;
            padding: 15px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        nav ul li {
            margin: 10px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #3700b3;
        }

        /* Main content styling */
        main {
            margin-top: 20px;
        }

        main section {
            display: none;
            padding: 30px;
            background-color: #fff;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        main section:target {
            display: block;
            transform: scale(1.05);
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #6200ea;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Footer styling */
        footer {
            text-align: center;
            margin-top: 20px;
            padding: 15px 0;
            background-color: #6200ea;
            color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
                /* Back Button Styles */
                .back-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: blue;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .back-btn:hover {
            background-color: #c82333;
        }

        .back-btn:active {
            background-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Staff System Interface</h1>
        </header>
        <nav>
            <ul>
                <li><a href="#view-reservations">View Reservations</a></li>
                <li><a href="#confirm-reservations">Confirm Reservations</a></li>
                <li><a href="manage_reservation.php">Manage Reservation</a></li>
                <li><a href="#view-pre-orders">View Pre-orders</a></li>
                <li><a href="manage_preorder.php">Manage Pre-orders</a></li>
                <li><a href="#confirm-pre-orders">Confirm Pre-orders</a></li>
            </ul>
        </nav>
        <main>
            <section id="view-reservations">
                <h2>View Reservations</h2>
                <div id="reservation-data">
                    <?php
                    $servername = "localhost";
                    $username = "root"; // Your database username
                    $password = ""; // Your database password
                    $dbname = "reservation"; // Your database name

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM reservations";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
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
                                </tr>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["id"]. "</td>
                                    <td>" . $row["name"]. "</td>
                                    <td>" . $row["nic_number"]. "</td>
                                    <td>" . $row["email"]. "</td>
                                    <td>" . $row["phone"]. "</td>
                                    <td>" . $row["reservation_date"]. "</td>
                                    <td>" . $row["reservation_time"]. "</td>
                                    <td>" . $row["number_of_persons"]. "</td>
                                    <td>" . $row["message"]. "</td>
                                    <td>" . ($row["confirmed"] ? 'Yes' : 'No') . "</td>
                                </tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                </div>
            </section>
            <section id="confirm-reservations">
                <h2>Confirm Reservations</h2>
                <div id="confirm-reservation-data">
                    <?php
                    $servername = "localhost";
                    $username = "root"; // Your database username
                    $password = ""; // Your database password
                    $dbname = "reservation"; // Your database name

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
                        $id = $_POST['id'];
                        $sql = "UPDATE reservations SET confirmed=1 WHERE id=$id";
                        if ($conn->query($sql) === TRUE) {
                            echo "Reservation confirmed successfully.";
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }
                    }

                    $sql = "SELECT * FROM reservations WHERE confirmed=0";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
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
                                    <th>Action</th>
                                </tr>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["id"]. "</td>
                                    <td>" . $row["name"]. "</td>
                                    <td>" . $row["nic_number"]. "</td>
                                    <td>" . $row["email"]. "</td>
                                    <td>" . $row["phone"]. "</td>
                                    <td>" . $row["reservation_date"]. "</td>
                                    <td>" . $row["reservation_time"]. "</td>
                                    <td>" . $row["number_of_persons"]. "</td>
                                    <td>" . $row["message"]. "</td>
                                    <td>
                                        <form method='post' action=''>
                                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                                            <button type='submit' name='confirm'>Confirm</button>
                                        </form>
                                    </td>
                                </tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No pending reservations.";
                    }
                    $conn->close();
                    ?>
                </div>
            </section>
            <section id="view-pre-orders">
                <h2>View Pre-orders</h2>
                <div id="preorder-data">
                    <?php
                    $servername = "localhost";
                    $username = "root"; // Your database username
                    $password = ""; // Your database password
                    $dbname = "preorder_system"; // Your database name

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM orders";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>contact</th>
                                    <th>Food Name</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Cancellation_Reason</th>
                                    <th>Confirmed</th>
                                </tr>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["id"]. "</td>
                                    <td>" . $row["name"]. "</td>
                                    <td>" . $row["nic"]. "</td>
                                    <td>" . $row["food"]. "</td>
                                    <td>" . $row["quantity"]. "</td>
                                    <td>" . $row["total_price"]. "</td>
                                    <td>" . $row["cancellation_reason"]. "</td>
                                    <td>" . ($row["confirmed"] ? 'Yes' : 'No')."</td>
                                </tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "0 pre-orders";
                    }
                    $conn->close();
                    ?>
                </div>
            </section>
            <section id="confirm-pre-orders">
    <h2>Confirm Pre-orders</h2>
    <div id="confirm-preorder-data">
        <?php
        $servername = "localhost";
        $username = "root"; // Your database username
        $password = ""; // Your database password
        $dbname = "preorder_system"; // Your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
            $order_id = intval($_POST['id']); // Ensure the ID is an integer
            // Assuming there's no status column, updating the pre-order record
            $sql = "UPDATE orders SET confirmed=1 WHERE id=$order_id";
            if ($conn->query($sql) === TRUE) {
                echo "Pre-order confirmed successfully.";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        $sql = "SELECT * FROM orders WHERE confirmed=0"; // Assuming confirmed column exists
        $result = $conn->query($sql);

        if ($result === FALSE) {
            echo "Error fetching records: " . $conn->error;
        } else {
            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>contact</th>
                            <th>Food Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Cancellation Reason</th>
                            <th>Action</th>
                            
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                           <td>" . htmlspecialchars($row["id"]) . "</td>
                            <td>" . htmlspecialchars($row["name"]) . "</td>
                            <td>" . htmlspecialchars($row["nic"]) . "</td>
                            <td>" . htmlspecialchars($row["food"]) . "</td>
                            <td>" . htmlspecialchars($row["quantity"]) . "</td>
                            <td>" . htmlspecialchars($row["total_price"]) . "</td>
                            <td>" . htmlspecialchars($row["cancellation_reason"]) . "</td>
                            <td>
                                <form method='post' action=''>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                                    <button type='submit' name='confirm'>Confirm</button>
                                </form>
                            </td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "No pending pre-orders.";
            }
        }
        $conn->close();
        ?>
    </div>
</section>

        </main>
        <a href='login.html' class='back-btn'>Back to Login</a>
        <footer>
            <p>&copy; 2024 Staff System Interface</p>
        </footer>

    </div>
</body>
</html>
