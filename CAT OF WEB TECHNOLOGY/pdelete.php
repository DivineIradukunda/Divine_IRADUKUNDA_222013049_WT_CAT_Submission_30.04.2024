<?php
// Connection details
include('databaseconnection.php');

// Check if ID is set
if(isset($_REQUEST['Payment_id'])) {
    $pid = $_REQUEST['Payment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM payment WHERE Payment_id=?");
    $stmt->bind_param("i", $pid);
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
            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
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
    echo "Payment_id is not set.";
}

$connection->close();
?>