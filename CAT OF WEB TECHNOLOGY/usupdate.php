<?php
// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$database = "onlinesalesfurniture";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if User_id is set
if(isset($_REQUEST['User_id'])) {
    $userid = $_REQUEST['User_id'];
    
    $stmt = $connection->prepare("SELECT * FROM user_account WHERE User_id=?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['User_name'];
        $c = $row['Password'];
        $d = $row['Email'];
        $e = $row['Phonenumber'];
    } else {
        echo "User account not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update products</title>
    
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="username">User name:</label>
        <input type="text" name="username" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="pword">Password:</label>
        <input type="text" name="pword" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="pnumber">Phonenumber:</label>
        <input type="number" name="pnumber" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $username= $_POST['username'];
    $pword= $_POST['pword'];
    $email= $_POST['email'];
    $pnumber= $_POST['pnumber'];
    
    // Update the user account in the database
    $stmt = $connection->prepare("UPDATE user_account SET User_name=?, Password=?, Email=?, Phonenumber=? WHERE User_id=?");
    $stmt->bind_param("ssssi", $username, $pword, $email, $pnumber, $userid);
    $stmt->execute();
    
    // Redirect to useraccount.php
    header('Location: useraccount.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
