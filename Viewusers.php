<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movindu";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Define the SQL query to fetch all products
$sql = "SELECT username, password, role  FROM users";

// Execute the query and store the result
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View staff</title>
    <link rel="stylesheet" href="food.css">
    <script>
        // Function to filter products based on search input
        function searchProducts() {
            var input = document.getElementById('searchInput'); // Get search input element
            var filter = input.value.toLowerCase(); // Convert input to lowercase for case-insensitive search
            var table = document.getElementById('usersTable'); // Get the table element
            var tr = table.getElementsByTagName('tr'); // Get all table rows

            // Loop through all table rows, starting from the second row (first row is the header)
            for (var i = 1; i < tr.length; i++) {
                tr[i].style.display = 'none'; // Hide row by default
                var td = tr[i].getElementsByTagName('td'); // Get all cells in the row
                
                // Loop through all cells in the row
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        // If the cell contains the search term, display the row
                        if (td[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = '';
                            break;
                        }
                    }
                }
            }
        }
    </script>
</head>
<body>
    <div class="view-products-container">
        <h2>Registered Staff</h2>
        <input type="text" id="searchInput" onkeyup="searchProducts()" placeholder="Search users..">
        <table id="usersTable">
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php
            // Check if there are results from the query
            if (mysqli_num_rows($result) > 0) {
                // Loop through each result and display in table rows
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo '<td>';
                 // Provide links for editing and deleting products
                    echo '<a href="Editusers.php?username=' . $row['username'] . '">Edit</a> | ';
                    echo '<a href="Deleteusers.php?username=' . $row['username'] . '" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</a>';
                    echo '</td>';
                    echo "</tr>";

                }
            } else {
                // If no results, display a message
                echo "<tr><td colspan='7'>No Users found</td></tr>";
            }
            // Close the database connection
            mysqli_close($conn);
            ?>
        </table>
        <a href="registerstaff.html">Back to Register Form</a>
    </div>
</body>
</html>
