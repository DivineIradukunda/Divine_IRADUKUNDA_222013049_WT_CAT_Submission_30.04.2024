<?php
// Connection details
include('databaseconnection.php');

// Check if Customer_id is set and is a valid integer
if(isset($_POST['custid']) && is_numeric($_POST['custid'])) {
    $custid = $_POST['custid'];
    
    // execute and prepare connection details
    $stmt = $connection->prepare("DELETE FROM customer WHERE Customer_id=?");
    $stmt->bind_param("i", $custid);
    
    // Execute the DELETE statement
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid or missing Customer_id.";
}

$connection->close();
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
<?php if(isset($_POST['custid'])) { ?>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="custid" value="<?php echo htmlspecialchars($_POST['custid']); ?>">
        <input type="submit" value="Delete">
    </form>
<?php } ?>
</body>
</html>
