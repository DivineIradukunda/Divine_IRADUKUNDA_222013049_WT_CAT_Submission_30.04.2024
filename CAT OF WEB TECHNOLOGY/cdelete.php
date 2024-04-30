<?php
// Connection details
include('databaseconnection.php');

// if condition to check Id set
if(isset($_REQUEST['Command_id'])) {
    $commandid = $_REQUEST['Command_id'];
    
    // Delete statement
    $stmt = $connection->prepare("DELETE FROM command WHERE Command_id=?");
    $stmt->bind_param("i", $commandid);
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
            <input type="hidden" name="commandid" value="<?php echo $commandid; ?>">
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
    echo "Command_id is not set.";
}

$connection->close();
?>