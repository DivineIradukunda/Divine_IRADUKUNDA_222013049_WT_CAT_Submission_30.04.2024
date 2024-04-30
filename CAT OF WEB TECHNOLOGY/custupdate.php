<?php
// Connection details
include('databaseconnection.php');

// Check if Customer_id is set
if(isset($_REQUEST['Customer_id'])) {
    $custid = $_REQUEST['Customer_id'];
    
    $stmt = $connection->prepare("SELECT * FROM customer WHERE Customer_id=?");
    $stmt->bind_param("i", $custid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $a = $row['Customer_id'];
        $b = $row['Name'];
        $c = $row['Email'];
        $d = $row['Phonenumber'];
        $e = $row['Address'];
    } else {
        echo "Customer not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Customers</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="custid">Customer id:</label>
        <input type="number" name="custid" value="<?php echo isset($a) ? $a : ''; ?>" readonly>
        <br><br>
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="pnumber">Phonenumber:</label>
        <input type="number" name="pnumber" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $custid = $_POST['custid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pnumber = $_POST['pnumber'];
    $address = $_POST['address'];
    
    // Update the customer in the database
    $stmt = $connection->prepare("UPDATE customer SET Name=?, Email=?, Phonenumber=?, Address=? WHERE Customer_id=?");
    $stmt->bind_param("ssssi", $name, $email, $pnumber, $address, $custid);
    $stmt->execute();
    
    // Redirect to customer.php
    header('Location: customer.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

// Close the database connection
$connection->close();
?>
