<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    
    <title>CUSTOMER TABLE</title>
     <style>
  
    a {
      padding: 10px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

  
    a:visited {
      color: purple;
    }
  
    a:link {
      color: brown; 
    }
    
    a:hover {
      background-color: white;
    }

    a:active {
      background-color: red;
    }

    button.btn {
      margin-left: 15px; 
      margin-top: 4px;
    }
    
    input.form-control {
      margin-left: 1300px; 

      padding: 8px;
     
    }
    section{
    padding:32px;
    }
  </style>
  <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body bgcolor="skyblue">
         <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/bedroom.jpg" width="90" height="60" alt="Logo">
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
         
    <h1>Customer Form</h1>
<form method="post" action="customer.php">

<label for="custid">Customer Id:</label>
<input type="number" id="custid" name="custid" required><br><br>

<label for="name">Name:</label>
<input type="text" id="name" name="name" required><br><br>

<label for="email">Email:</label>
<input type="email" id="email" name="email" required><br><br>

<label for="phonenumber">Phonenumber:</label>
<input type="text" id="phonenumber" name="phonenumber" required><br><br>

<label for="address">Address:</label>
<input type="text" id="address" name="address" required><br><b>

<input type="submit" name="add" value="Insert"><br><br>
<a href="./home.html">Go Back to Home</a>
<?php
// Connection
include('databaseconnection.php');
// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO customer(Name, Email, Phonenumber, Address) VALUES (?,?,?,?)");

    // Bind parameters
    $stmt->bind_param("ssss",$name, $email, $phonenumber,$address);

    // Set parameters and execute
    $name= $_POST['name'];
    $email= $_POST['email'];
    $phonenumber= $_POST['phonenumber'];
    $address= $_POST['address'];
   

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
    ?>

<?php
// Connection
include('databaseconnection.php');
// Selecting data from the database
$sql_select = "SELECT * FROM customer";
$result = $connection->query($sql_select);
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Data About Customers</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Customer Table</h2></center>
    <table border="5">
        <tr>
            <th>Customer_id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phonenumber</th>
            <th>Address</th>
        </tr>
        <?php
        // Define connection parameters
        $host = "localhost";
        $user = "root";
        $pass = "";
        $database = "onlinesalesfurniture";

        // Establish a new connection
        $connection = new mysqli($host, $user, $pass, $database);

        // Check if connection was successful
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Prepare SQL query to retrieve all products
        $sql = "SELECT * FROM customer";
        $result = $connection->query($sql);

        // Check if there are any products
        if ($result->num_rows > 0) {
            // Fetch the Product_Id
            while ($row = $result->fetch_assoc()) {
                $custid = $row['Customer_id']; 
                // Output data for each row
                echo "<tr>
                    <td>" . $row['Customer_id'] . "</td>
                    <td>" . $row['Name'] . "</td>
                    <td>" . $row['Email'] . "</td>
                    <td>" . $row['Phonenumber'] . "</td>
                    <td>" . $row['Address'] . "</td>
                    <td><a style='padding:4px' href='custdelete.php?Customer_id=$custid'>Delete</a></td> 
                    <td><a style='padding:4px' href='custupdate.php?Customer_id=$custid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Divine IRADUKUNDA</h2></b>
  </center>
</footer>
</body>
</html>