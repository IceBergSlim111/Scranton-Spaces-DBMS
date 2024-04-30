<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Preference Form</title>
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
    </style>
</head>
<body>
    <header class="header">
        <img src="CMPE_332_Logo.png" alt="Company Logo">
        <h1>Scranton Spaces</h1>
    </header>

    <ul class="nav">
        <li><a href="listProperties.php">View Properties</a></li>
        <li><a href="rentalGroupList.php">View Rental Groups</a></li>
        <li><a href="averageMonthlyRentals.php">View Average Rentals</a></li>
    </ul>
<h2>Add New Rental Group Preferences</h2>
<?php
include 'connectdb.php'; // Include your database connection script

$code = $_POST["group_id"];
$prefType = $_POST["property_type"];
$prefNumBeds = intval($_POST["bedrooms"]);
$prefNumBath = intval($_POST["bathrooms"]);
$prefParking = $_POST["parking"] == '1' ? 1 : 0; // database column is BOOLEAN: yes (1), no (0)
$prefLaundry = $_POST["laundry"] == '1' ? 1 : 0; // database column is BOOLEAN, shared (1), ensuite (0)
$cost = ($_POST["max_rent"]);
$prefAccessibility = $_POST["accessibility"];

// SQL Query that will update the preference table
$updateQuery = "UPDATE rentalGroup SET 
                prefType = :prefType, 
                prefNumBeds = :prefNumBeds, 
                prefNumBath = :prefNumBath, 
                cost = :cost,
                prefParking = :prefParking, 
                prefLaundry = :prefLaundry,
                prefAccessibility = :prefAccessibility
                WHERE code = :code";

$updateStmt = $connection->prepare($updateQuery);

// Bind parameters to the prepared statement
$updateStmt->bindParam(':code', $code);
$updateStmt->bindParam(':prefType', $prefType);
$updateStmt->bindParam(':prefNumBeds', $prefNumBeds);
$updateStmt->bindParam(':prefNumBath', $prefNumBath);
$updateStmt->bindParam(':prefParking', $prefParking);
$updateStmt->bindParam(':prefLaundry', $prefLaundry);
$updateStmt->bindParam(':cost', $cost);
$updateStmt->bindParam(':prefAccessibility', $prefAccessibility);

// Execute the statement and check if the update was successful
if ($updateStmt->execute()) {
    echo "Update Successful";
} else {
    echo "Failed to update";
}

$connection = null;
?>
</body>
</html>