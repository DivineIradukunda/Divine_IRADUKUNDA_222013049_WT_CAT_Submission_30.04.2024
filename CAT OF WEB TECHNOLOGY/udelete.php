<?php
// Connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlinesalesfurniture";

// Create the connectiong
$connection= new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if ID is set
if(isset($_REQUEST['User_id'])) {
    $userid = $_REQUEST['User_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM user_account WHERE User_id=?");
    $stmt->bind_param("i", $userid);
    ?>
      <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="uid" value="<?php echo $uid; ?>">
            <input type="submit" value="Delete">
        </form>

    
        <?php
     if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "User_id is not set.";
}

$connection->close();
?>