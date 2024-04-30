<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Cost for Each Property Type</title>
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
    <?php
    include 'connectdb.php';

    $id = $_GET['group_id'];

    // SQL Queries to retrieve full name and group preference
    $full_name = $connection->query("SELECT fname, lname from renter as r JOIN person as p on r.renterID = p.personID WHERE rentalGroup = $id");
    $preferences = $connection->query("SELECT * from rentalGroup WHERE CODE = $id");

    // loop through each row and return their full names (fname + lname)
    echo "<h2>Member(s) of Rental Group $id</h2>";   
    while ($row = $full_name->fetch()) {
        echo "<p>".$row["fname"]." ".$row["lname"]."</p>";
    } 

    echo "<h2>Preferences for Rental Group $id</h2>";

    // loop that goes through each row and returns the group's preference details
    while ($row = $preferences->fetch()) {
        echo "<p>Preferred Accomdation Type: ".$row["prefType"]."</p>";
        echo "<p>Number of Bedrooms: ".$row["prefNumBeds"]."</p>";
        echo "<p>Number of Bathrooms: ".$row["prefNumBath"]."</p>";
        echo "<p>Maximum Rent: $".$row["cost"]."</p>";
        echo "<p>Accessible: ".$row["prefAccessibility"]."</p>";

        // Check if the preference for laundry is set to shared (1) or ensuite (0)
        if ($row["prefLaundry"] == 1) {
            echo "<p>Laundry: Shared</p>";
        } else {
            echo "<p>Laundry: Ensuite</p>";
        }

        // Check if the preference for parking is set to yes (1) or no (0)
        if ($row["prefParking"] == 1) {
            echo "<p>Parking: Yes</p>";
        } else {
            echo "<p>Parking: No</p>";
        }
    }
    $connection = NULL;

    ?>

    <!-- link that allows for preference editting -->
    <div class="button-container">
            <a href="updateGroupPreferences.php?group_id=<?php echo $id; ?>" class="preferences-button">Edit Preferences</a>
        </div>
</body>
</html>