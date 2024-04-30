<?php
// Connection details
 include('databaseconnection.php');

// if condition to check Id set
if(isset($_REQUEST['Furniture_id'])) {
    $furnid = $_REQUEST['Furniture_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM furniture WHERE Furniture_id=?");
    $stmt->bind_param("i", $furnid);
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
            <input type="hidden" name="furnid" value="<?php echo $furnid; ?>">
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
    echo "Furniture_id is not set.";
}

$connection->close();
?>