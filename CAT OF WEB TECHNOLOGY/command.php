<!DOCTYPE html>
<html>
<head>
  <title>COMMAND TABLE</title>
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
<body style="background-color: red;">
  <ul style="list-style-type: none; padding: 0;">
     </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./furniture.php">FURNITURE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./customer.php">CUSTOMER</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./command.php">COMMAND</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./payment.php">PAYMENT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./stock.php">STOCK</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./user_account.php">USER_ACCOUNT</a>

  </li>
  
  </ul>
  <form method="post" action="command.php">
    <h1>Command Form</h1>
    <label for="commandid">Command Id:</label>
    <input type="number" id="commandid" name="commandid" required><br><br>
    <label for="cdate">Command Date:</label>
    <input type="date" id="cdate" name="cdate" required><br><br>
    <label for="status">Status:</label>
    <input type="text" id="status" name="status" required><br><br>
    <label for="furnid">Furniture Id:</label>
    <input type="number" id="furnid" name="furnid" required><br><br>
    <label for="custid">Customer Id:</label>
    <input type="number" id="custid" name="custid" required><br><br>
    <input type="submit" name="add" value="Insert"><br><br>
    <a href="./home.html">Go Back to Home</a>
  </form>

  <?php
  include('databaseconnection.php');
  // Handling POST request
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
      $cdate = mysqli_real_escape_string($connection, $_POST['cdate']);
      $status = mysqli_real_escape_string($connection, $_POST['status']);
      $furnid = intval($_POST['furnid']);
      $custid = intval($_POST['custid']);
      
      // Preparing SQL query
      $sql = "INSERT INTO command (Command_date, Status, Furniture_id, Customer_id) 
      VALUES ('$cdate', '$status', '$furnid', '$custid')";

      // Execute SQL query
      if ($connection->query($sql) === TRUE) {
          header("Location: command.php");
          exit();
      } else {
          // Displaying error message if query execution fails
          echo "Error: " . $sql . "<br>" . $connection->error;
      }
  }

  // Retrieve and display data for Command
  $sql = "SELECT * FROM command";
  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
      // Output data for all table
      echo "<h2>Data for Command</h2>";
      echo "<table border='5'>";
      echo "<tr>
                <th>Command id</th>
                <th>Command date</th>
                <th>Status</th>
                <th>Furniture id</th>
                <th>Customer id</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>";
            // Fetch the command_id
      while ($row = $result->fetch_assoc()) {
          $commandid = $row['Command_id'];
          echo "<tr>
                <td>" . $row['Command_id'] . "</td>
                <td>" . $row['Command_date'] . "</td>
                <td>" . $row['Status'] . "</td>
                <td>" . $row['Furniture_id'] . "</td>
                <td>" . $row['Customer_id'] . "</td>
                <td><a style='padding:4px' href='cdelete.php?Command_id=$commandid'>Delete</a></td> 
                <td><a style='padding:4px' href='commupdate.php?Command_id=$commandid'>Update</a></td> 
            </tr>";
      }
      echo "</table>";
  } else {
      echo "<p>No data found</p>";
  }
  // Close the database connection
  $connection->close();
  ?>

  <footer>
    <center> 
      <b><h2>UR CBE BIT &copy, 2024 &reg, Designed by: @Divine IRADUKUNDA</h2></b>
    </center>
  </footer>
</body>
</html>
