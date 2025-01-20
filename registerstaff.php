<?php
// Establish a MySQL Database Connection
$connection = new mysqli("localhost", "root", "", "movindu");

// Connection validation check
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Retrieve and sanitize the user input
$username = $connection->real_escape_string($_POST['Username']);
$password = $connection->real_escape_string($_POST['Password']);
$role = $connection->real_escape_string($_POST['Role']);

// Check if the input fields are not empty
if (empty($username) || empty($password) || empty($role)) {
    echo "All fields are required.";
    exit();
}

// Check if the role is 'staff'
if ($role === 'staff') {
    // Prepare an SQL statement to insert the new staff member
    $query = $connection->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");

    if ($query) {
        $query->bind_param("sss", $username, $password, $role);
        $query->execute();

        if ($query->affected_rows > 0) {
            // Registration successful, redirect to the registration form
            echo "<script>
                    alert('Staff member registered successfully!');
                    window.location.href = 'registerstaff.html';
                  </script>";
        } else {
            echo "Error registering staff member: " . $connection->error;
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
