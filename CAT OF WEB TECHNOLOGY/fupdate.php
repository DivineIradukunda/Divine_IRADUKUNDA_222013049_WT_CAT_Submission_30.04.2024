<?php
// Connection details
include('databaseconnection.php');

// Check if Furniture_id is set
if(isset($_REQUEST['Furniture_id'])) {
    $furnid = $_REQUEST['Furniture_id'];
    
    $stmt = $connection->prepare("SELECT * FROM furniture WHERE Furniture_id=?");
    $stmt->bind_param("i", $furnid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $a = $row['Furniture_id'];
        $b = $row['Type'];
        $c = $row['Category'];
        $d = $row['Name'];
        $e = $row['Size'];
    } else {
        echo "Furniture not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Furniture</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="furnid">Furniture id:</label>
        <input type="number" name="furnid" value="<?php echo isset($a) ? $a : ''; ?>" readonly>
        <br><br>
        <label for="type">Type:</label>
        <input type="text" name="type" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="category">Category:</label>
        <input type="text" name="category" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="size">Size:</label>
        <input type="text" name="size" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $furnid = $_POST['furnid'];
    $type= $_POST['type'];
    $category= $_POST['category'];
    $name= $_POST['name'];
    $size= $_POST['size'];
    
    // Update the furniture in the database
    $stmt = $connection->prepare("UPDATE furniture SET Type=?, Category=?, Name=?, Size=? WHERE Furniture_id=?");
    $stmt->bind_param("ssssi", $type, $category, $name, $size, $furnid);
    $stmt->execute();
    
    // Redirect to furniture.php
    header('Location: furniture.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
