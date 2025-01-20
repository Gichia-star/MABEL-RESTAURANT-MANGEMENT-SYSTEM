<?php
// Establish a MySQL Database Connection
$connection = new mysqli("localhost", "root", "", "movindu");

// Connection validation check
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Retrieve and sanitize the user input
$username = $connection->real_escape_string($_POST['Username']);
$password = $_POST['Password'];
$role = $connection->real_escape_string($_POST['Role']);

// Check if the input fields are not empty
if (empty($username) || empty($password) || empty($role)) {
    echo "All fields are required.";
    exit();
}

// Handling login based on role
if ($role === 'admin') {
    // For admin login, check against fixed admin credentials
    $fixedAdminUsername = 'admin';
    $fixedAdminPassword = 'admin123'; // Plaintext password for demonstration

    if ($username === $fixedAdminUsername && $password === $fixedAdminPassword) {
        echo "<script>
                alert('Login successful! Welcome, Admin.');
                window.location.href = 'adminsystem.html';
              </script>";
        exit();
    } else {
        echo "Invalid admin credentials.";
    }
} elseif ($role === 'staff') {
    // For staff role, proceed with database check
    $query = $connection->prepare("SELECT password FROM users WHERE username=? AND role='staff'");

    if ($query) {
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];
            
            // Debugging output
            // echo "DEBUG: Fetched stored password from DB: $stored_password <br>";

            if ($password === $stored_password) {
                echo "<script>
                        alert('Login successful! Welcome, " . htmlspecialchars($username) . ".');
                        window.location.href = 'staffsystem.php';
                      </script>";
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "No user found with that username.";
        }

        $query->close();
    } else {
        echo "Error preparing the statement: " . $connection->error;
    }
} else {
    echo "Invalid role selected.";
}

$connection->close();
?>
