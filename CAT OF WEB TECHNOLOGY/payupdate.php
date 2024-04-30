<?php
// Connection details
include('databaseconnection.php');

// Check if Payment_id is set
if(isset($_REQUEST['Payment_id'])) {
    $pid = $_REQUEST['Payment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM payment WHERE Payment_id=?");
    $stmt->bind_param("i", $pid); // Use "i" for integer type
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['Total_amount'];
        $z = $row['Payment_method'];
        $k = $row['Date'];
        $w = $row['Furniture_id'];
        $h = $row['Customer_id'];
    } else {
        echo "Payment not found.";
    }
}
?>

<html>
<head>
    <title>Update payment</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();"> <!-- Call confirmUpdate() function when form is submitted -->
        <label for="tamount">Total amount:</label>
        <input type="number" name="tamount" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="pmethod">Payment method:</label>
        <input type="text" name="pmethod" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo isset($k) ? $k : ''; ?>">
        <br><br>

        <label for="furnid">Furniture id:</label>
        <input type="number" name="furnid" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="custid">Customer id:</label>
        <input type="number" name="custid" value="<?php echo isset($h) ? $h : ''; ?>">
        <br><br>

        <!-- Corrected the name of the hidden input field -->
        <input type="hidden" name="Payment_id" value="<?php echo isset($pid) ? $pid : ''; ?>">
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $tamount = $_POST['tamount'];
    $pmethod = $_POST['pmethod'];
    $date = $_POST['date'];
    $furnid = $_POST['furnid'];
    $custid = $_POST['custid'];
    $pid = $_POST['Payment_id']; // Corrected variable name
    
    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payment SET Total_amount=?, Payment_method=?, Date=?, Furniture_id=?, Customer_id=? WHERE Payment_id=?");
    $stmt->bind_param("sssssi", $tamount, $pmethod, $date, $furnid, $custid, $pid);
    $stmt->execute();
    
    // Redirect to payment.php
    header('Location: payment.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

// Close the database connection
$connection->close();
?>
