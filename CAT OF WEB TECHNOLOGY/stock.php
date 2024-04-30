<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>STOCK</title>
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
  <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body style="background-color: yellow;">
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
   
  <h1>Stock Form</h1>
  <form method="post" action="stock.php">
    <label for="sid">Stock Id:</label>
    <input type="number" id="sid" name="sid" required><br><br>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required><br><br>
    <label for="furnid">Furniture Id:</label>
    <input type="number" id="furnid" name="furnid" required><br><br>
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" required><br><br>
    <input type="submit" name="add" value="Insert"><br><br>
    <a href="./home.html">Go Back to Home</a>
  </form>

  <?php
  // Connection details
include('databaseconnection.php');

  // Handling POST request
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieving form data
      $sid = $_POST['sid'];
      $address = $_POST['address'];
      $furnid = $_POST['furnid'];
      $quantity = $_POST['quantity'];
      $furnid = $_POST['furnid'];
      
      
      // Preparing SQL query
      $sql = "INSERT INTO stock(Stock_id, Address, Furniture_id, Quantity) 
      VALUES ('$sid', '$address', '$furnid', '$quantity')";

      // Executing SQL query
      if ($connection->query($sql) === TRUE) {
          // Redirecting to login page on successful registration
         echo "Data inserted successfully. <a href='stock.php'>RESULT</a>";
      } else {
          // Displaying error message if query execution fails
          echo "Error: " . $sql . "<br>" . $connection->error;
      }
  }

  // Closing database connection
  $connection->close();
  ?>

  <h2>Data for Stock</h2>
  <table border="2">
    <tr>
      <th>Stock id</th>
      <th>Address</th>
      <th>Furniture id</th>
      <th>Quantity</th>
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
    $sql = "SELECT * FROM stock";
    $result = $connection->query($sql);

    // Check if there are any payments
    if ($result->num_rows > 0) {
        // Fetch the payment_id
        while ($row = $result->fetch_assoc()) {
            $sid = $row['stock_id']; 
            // Output data for each row
            echo "<tr>
                <td>" . $row['stock_id'] . "</td>
                <td>" . $row['Address'] . "</td>
                <td>" . $row['Furniture_id'] . "</td>
                <td>" . $row['Quantity'] . "</td>
             
                <td><a style='padding:4px' href='sdelete.php?stock_id=$sid'>Delete</a></td> 
                <td><a style='padding:4px' href='stockupdate.php?stock_id=$sid'>Update</a></td> 
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
