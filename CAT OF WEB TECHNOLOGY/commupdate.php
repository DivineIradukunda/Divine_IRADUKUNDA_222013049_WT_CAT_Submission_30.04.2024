<?php
// Connection details
include('databaseconnection.php');
// Check if command_id is set
if(isset($_REQUEST['Command_id'])) {
    $commandid = $_REQUEST['Command_id'];
    
    $stmt = $connection->prepare("SELECT * FROM command WHERE Command_id=?");
    $stmt->bind_param("i", $commandid); // Use "i" for integer parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['Command_date']; // corrected variable name
        $z = $row['Status']; // corrected variable name
        $k = $row['Furniture_id']; // corrected variable name
        $w = $row['Customer_id']; // corrected variable name
    } else {
        echo "Command not found.";
    }
}
?>

<html>
<head>
    <title>Update Command</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();"> <!-- Call confirmUpdate() function when form is submitted -->
        <label for="cdate">Command date:</label>
        <input type="date" name="cdate" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="furnid">Furniture id:</label>
        <input type="number" name="furnid" value="<?php echo isset($k) ? $k : ''; ?>">
        <br><br>

        <label for="custid">Customer id:</label>
        <input type="number" name="custid" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <!-- Corrected the hidden input name to match -->
        <input type="hidden" name="Command_id" value="<?php echo isset($commandid) ? $commandid : ''; ?>">
        
        <input type="submit" name="up" value="Update">
    </form>

    <?php
    if(isset($_POST['up'])) {
        // Retrieve updated values from form
        $cdate = $_POST['cdate'];
        $status = $_POST['status'];
        $furnid= $_POST['furnid'];
        $custid= $_POST['custid'];
        $commandid = $_POST['Command_id']; 
        
        // Update the command in the database
        $stmt = $connection->prepare("UPDATE command SET Command_date=?, Status=?, Furniture_id=?, Customer_id=? WHERE Command_id=?");
        $stmt->bind_param("ssiii", $cdate, $status, $furnid, $custid, $commandid); // corrected data types and parameter order
        $stmt->execute();
        
        // Redirect to command.php
        header('Location: command.php');
        exit(); 
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
