<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Management Overview</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
        }
        /* Styling for the page header */
        .header {
            background: #000000;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .header h1 {
            margin: 0;
            padding-left: 15px;
        }
        .header img {
            height: 100px;
        }
        /* Styling for the navigation bar */
        .nav {
            padding: 0;
            margin: 0;
            list-style-type: none;
            background-color: #444;
            overflow: hidden;
            display: flex;
            justify-content: center;
        }
        .nav li {
            float: none; 
        }
        .nav li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .nav li a:hover {
            background-color: #111;
        }
        .main-content {
            padding: 20px;
            background: #fff;
            margin-top: 10px;
        }
        /* Styles for the footer */
        .footer {
            background: #000000;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .title-image {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            height: auto;
        }
        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        }
        th, td {
        text-align: left;
        padding: 8px;
        border: 1px solid black;
        }
        th {
        background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Header section with company logo and main heading -->
    <header class="header">
        <img src="CMPE_332_Logo.png" alt="Company Logo">
        <!-- reference link is added to return user back to homepage -->
        <h1><a href="rental.html" style="text-decoration: none; color: inherit;">Scranton Spaces</a></h1>
    </header>
    <!-- Navigation bar with link to different pages of website -->
    <ul class="nav">
        <li><a href="listProperties.php">View Properties</a></li>
        <li><a href="rentalGroupList.php">View Rental Groups</a></li>
        <li><a href="averageMonthlyRentals.php">View Average Rents</a></li>
    </ul>
    <h2>Scranton Spaces' Property Management Overview</h2>
    <table>
        <tr>
            <!-- Table headers -->
            <th>Property ID#</th>
            <th>Owner Full Name</th>
            <th>Manager Full Name</th>
        </tr>
        <?php
            include "connectdb.php";
            
            // Database query and table row generation for property IDs, owner & manager full names
            $query = "
            SELECT new_table.propertyID, new_table.fname AS owner_fname, new_table.lname AS owner_lname, p.fname as manager_fname, p.lname as manager_lname FROM (SELECT p.fname, p.lname, o.ownerID, o.propertyID, pr.manages FROM person AS p RIGHT OUTER JOIN owns AS o ON p.personID = o.ownerID NATURAL JOIN property AS pr ) AS new_table JOIN person AS p ON new_table.manages = p.personID";
            $properties = $connection->query($query);
            
            while ($row = $properties->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['propertyID']) . "</td>";
                // Concatenate to showcase owner's full name
                echo "<td>" . htmlspecialchars($row['owner_fname'] . ' ' . $row['owner_lname']) . "</td>";
                // Concatenate to showcase manager's full name
                echo "<td>" . htmlspecialchars($row['manager_fname'] . ' ' . $row['manager_lname'])  . "</td>";
                echo "</tr>";
            }
            
            $connection = null; // Close the database connection
        ?>
    </table>

</body>
</html>