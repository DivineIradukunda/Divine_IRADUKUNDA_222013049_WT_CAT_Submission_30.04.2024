<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>PAYMENT</title>
  <style>
    .dropdown {
      position: relative;
      display: inline-block;
      margin-right: 10px;
    }
    .dropdown-contents {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      left: 0;
    }
    .dropdown:hover .dropdown-contents {
      display: block;
    }
    .dropdown-contents a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    .dropdown-contents a:hover {
      background-color: #f1f1f1;
    }
  </style>
  
   <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body style="background-color: grey;">
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./furniture.php">FURNITURE</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./customer.php">CUSTOMER</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./command.php">COMMAND</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./payment.php">PAYMENT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./stock.php">STOCK</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./user_account.php">USER_ACCOUNT</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: darkblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
     <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <h1>Payment Form</h1>
<form method="post" action="payment.php">
    <label for="pid">Payment Id:</label>
    <input type="number" id="pid" name="pid" required><br><br>
    <label for="tamount">Total Amount:</label>
    <input type="number" id="tamount" name="tamount" required><br><br>
    <label for="pmethod">Payment Method:</label>
    <input type="text" id="pmethod" name="pmethod" required><br><br>
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required><br><br>
    <label for="furnid">Furniture Id:</label>
    <input type="number" id="furnid" name="furnid" required><br><br>
    <label for="custid">Customer Id:</label>
    <input type="number" id="custid" name="custid" required><br><br>
    <input type="submit" name="add" value="Insert"><br><br>
    <a href="./home.html">Go Back to Home</a>
</form>

<?php
// Connection details
include('databaseconnection.php');

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $pid = $_POST['pid'];
    $tamount = $_POST['tamount'];
    $pmethod = $_POST['pmethod'];
    $date = $_POST['date'];
    $furnid = $_POST['furnid'];
    $custid = $_POST['custid'];

    // Preparing SQL query
    $sql = "INSERT INTO payment (Payment_id, Total_amount, Payment_method, Date, Furniture_id, Customer_id) 
            VALUES ('$pid', '$tamount', '$pmethod', '$date', '$furnid', '$custid')";

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        // Redirecting to payment.php on successful insertion
        header('Location: payment.php');
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Closing database connection
$connection->close();
?>

  <h2>Data for Payment</h2>
  <table border="5">
    <tr>
      <th>Payment id</th>
      <th>Total amount</th>
      <th>Payment method</th>
      <th>Date</th>
      <th>Furniture id</th>
      <th>Customer id</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    // Establish a new connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check if connection was successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare SQL query to retrieve all payments
    $sql = "SELECT * FROM payment";
    $result = $connection->query($sql);

    // Check if there are any payments
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            $pid = $row['Payment_id']; // Fetch the payment_id
            echo "<tr>
                <td>" . $row['Payment_id'] . "</td>
                <td>" . $row['Total_amount'] . "</td>
                <td>" . $row['Payment_method'] . "</td>
                <td>" . $row['Date'] . "</td>
                <td>" . $row['Furniture_id'] . "</td>
                <td>" . $row['Customer_id'] . "</td>
                <td><a style='padding:4px' href='pdelete.php?Payment_id=$pid'>Delete</a></td> 
                <td><a style='padding:4px' href='payupdate.php?Payment_id=$pid'>Update</a></td> 
            </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No data found</td></tr>";
    }
    // Close the database connection
    $connection->close();
    ?>
  </table>

  <footer>
    <center> 
      <b><h2>UR CBE BIT &copy, 2024 &reg, Designed by: @Divine IRADUKUNDA</h2></b>
    </center>
  </footer>
</body>
</html>
