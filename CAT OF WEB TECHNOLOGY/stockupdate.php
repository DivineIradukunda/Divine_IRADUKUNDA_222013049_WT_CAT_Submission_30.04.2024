<?php
// Connection details
include('databaseconnection.php');

// Check if stock_id is set
if(isset($_REQUEST['stock_id'])) {
    $stock_id = $_REQUEST['stock_id'];
    
    $stmt = $connection->prepare("SELECT * FROM stock WHERE stock_id=?");
    $stmt->bind_param("i", $stock_id); // Use "i" for integer type
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $address = $row['Address']; // Corrected column name
        $furnid = $row['Furniture_id']; // Corrected column name
        $quantity = $row['Quantity']; // Corrected column name
    } else {
        echo "Stock not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update stock</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="">Stock id:</label>
        <input type="number" name="sid" value="<?php echo isset($stock_id) ? $stock_id : ''; ?>">
        <br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
        <br><br>

        <label for="furnid">Furniture id:</label>
        <input type="number" name="furnid" value="<?php echo isset($furnid) ? $furnid : ''; ?>">
        <br><br>

        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" value="<?php echo isset($quantity) ? $quantity : ''; ?>">
        <br><br>

        <input type="hidden" name="stock_id" value="<?php echo isset($stock_id) ? $stock_id : ''; ?>">
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $address = $_POST['address'];
    $furnid = $_POST['furnid'];
    $quantity = $_POST['quantity'];
    $stock_id = $_POST['stock_id'];

    // Update the stock in the database
    $stmt = $connection->prepare("UPDATE stock SET Address=?, Furniture_id=?, Quantity=? WHERE stock_id=?");
    $stmt->bind_param("siii", $address, $furnid, $quantity, $stock_id); // Use "i" for integer type
    $stmt->execute();
    
    // Redirect to stock.php
    header('Location: stock.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

// Close the database connection
$connection->close();
?>
