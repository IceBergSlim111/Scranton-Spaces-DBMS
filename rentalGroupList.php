<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Rental Groups</title>
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
        .description {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e8e8e8;
        }
        .detail-view {
            border: 1px solid #ddd;
            padding: 15px;
            background-color: white;
        }
        .navigation-link {
            padding: 10px 15px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
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
    
<h1>Rental Groups</h1>
    <p class="description">Click on one of the rental groups to view more details about their respective preferences.</p>

    <?php
        include 'connectdb.php';

        try {
            // SQL query to select the "code" column from the "rentalGroup" table
            $query = "SELECT CODE FROM rentalgroup;";
            $stmt = $connection->prepare($query);
            $stmt->execute();
            $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // staring list of groups
            echo "<ul>";
            foreach ($groups as $group) {
                echo "<li><a href='displayPreferences.php?group_id=" . urlencode($group['CODE']) . "'>Group " . htmlspecialchars($group['CODE']) . "</a></li>";
            }
            // ending list of groups
            echo "</ul>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $connection = null; // Close the database connection
    ?>

</body>
</html>