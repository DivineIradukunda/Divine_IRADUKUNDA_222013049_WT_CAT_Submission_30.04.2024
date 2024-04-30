<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    
    <title>Our Furniture</title>
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
  

   <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  
</head>
<body bgcolor="pink">
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
     
   <h1>Furniture Form</h1>
<form method="post" action="furniture.php">

<label for="furnid">Furniture Id:</label>
<input type="number" id="furnid" name="furnid" required><br><br>

<label for="type">Type:</label>
<input type="text" id="type" name="type" required><br><br>

<label for="category">Category:</label>
<input type="text" id="category" name="category" required><br><br>

<label for="name">Name:</label>
<input type="text" id="name" name="name" required><br><br>

<label for="size">Size:</label>
<input type="text" id="size" name="size" required><br><b>

 <input type="submit" name="add" value="Insert"><br><br>
 <a href="./home.html">Go Back to Home</a>
</form>
<?php
// Connection
include('databaseconnection.php');

// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO furniture(Type, Category, Name, Size) VALUES (?,?,?,?)");

    // Bind parameters
    $stmt->bind_param("ssss",$type, $category, $name,$size);

    // Set parameters and execute
    $type = $_POST['type'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $size= $_POST['size'];
   
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
$sql_select = "SELECT * FROM furniture";
$result = $connection->query($sql_select);
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Data About Furniture</title>
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
    <center><h2>Data For Furniture</h2></center>
    <table border="5">
        <tr>
            <th>Furniture_id</th>
            <th>Type</th>
            <th>Category</th>
            <th>Name</th>
            <th>Size</th>
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
        $sql = "SELECT * FROM furniture";
        $result = $connection->query($sql);

        // Check if there are any products
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $furnid = $row['Furniture_id']; // Fetch the Product_Id
                echo "<tr>
                    <td>" . $row['Furniture_id'] . "</td>
                    <td>" . $row['Type'] . "</td>
                    <td>" . $row['Category'] . "</td>
                    <td>" . $row['Name'] . "</td>
                    <td>" . $row['Size'] . "</td>
                    <td><a style='padding:4px' href='fdelete.php?Furniture_id=$furnid'>Delete</a></td> 
                    <td><a style='padding:4px' href='fupdate.php?Furniture_id=$furnid'>Update</a></td> 
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