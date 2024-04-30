<?php
// Connection details
include('databaseconnection.php');
// Check if Stock_id is set
if(isset($_REQUEST['stock_id'])) {
    $sid = $_REQUEST['stock_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM stock WHERE stock_id=?");
    $stmt->bind_param("i", $sid);
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
            <input type="hidden" name="sid" value="<?php echo $sid; ?>">
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
    echo "stock_id is not set.";
}

$connection->close();
?>