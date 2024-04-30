<?php
include('db_connection.php');
if(isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'Attendance' => "SELECT Attendance_Id FROM Attendance WHERE Attendance_Id LIKE '%$searchTerm%'",
        'Benefits' => "SELECT Health_Insurance FROM Benefits WHERE Health_Insurance LIKE '%$searchTerm%'",
        'Employee' => "SELECT First_Name FROM Employee WHERE First_Name LIKE '%$searchTerm%'",
        'Leave_Request' => "SELECT Request_Id FROM Leave_Request WHERE Request_Id LIKE '%$searchTerm%'",
        'Payroll' => "SELECT Salary FROM Payroll WHERE Salary LIKE '%$searchTerm%'",
        'Performance' => "SELECT Performance_Id FROM Performance WHERE Performance_Id LIKE '%$searchTerm%'",
        'Training' => "SELECT Training_Id FROM Training WHERE Training_Id LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<style>
                h2 {
                    color: blue;
                    text-decoration: underline;
                }
                h3 {
                    color: green;
                }
                p {
                    color: black;
                }
          </style>";
    echo "<h2>Search Results:</h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>


