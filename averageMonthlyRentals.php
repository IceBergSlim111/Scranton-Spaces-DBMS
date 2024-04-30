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
        .slider {
            width: 100%;
            margin: 20px auto;
            overflow: hidden;
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease;
        }
        .slide {
            width: 100%;
            flex-shrink: 0;
            text-align: center;
        }
        .slide img {
        width: 400px;
        height: 400px;
        object-fit: cover;
        }
        /* Navigation for the slider */
        .slider-nav {
            text-align: center;
            margin-top: 10px;
        }
        /* Button styling within the slider navigation */
        .slider-nav button {
            padding: 5px 10px;
            cursor: pointer;
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
    <h2>Average Rental Cost for Each Property Type</h2>
    <table>
        <tr>
        <!-- Table Headers -->
            <th>House</th>
            <th>Apartment</th>
            <th>Room</th>
        </tr>
        <?php
            include "connectdb.php";
            // Database queries and table row generation for average costs of property types
            // Houses
            $avg_cost_house = $connection->query("SELECT AVG(cost) as avg_cost from property as p RIGHT OUTER JOIN house as h ON h.houseID = p.propertyID;");
            $row_house = $avg_cost_house->fetch();
            echo "<td>$".round($row_house["avg_cost"], 2)."</td>";
            
            // Apartments
            $avg_cost_apart = $connection->query("SELECT AVG(cost) as avg_cost from property as p RIGHT OUTER JOIN apartment as apt ON apt.aptID = p.propertyID;");
            $row_apart = $avg_cost_apart->fetch();
            echo "<td>$".round($row_apart["avg_cost"], 2)."</td>";
            
            // Rooms
            $avg_cost_room = $connection->query("SELECT AVG(cost) as avg_cost from property as p RIGHT OUTER JOIN room as r ON r.roomID = p.propertyID;");
            $row_room = $avg_cost_room->fetch();
            echo "<td>$".round($row_room["avg_cost"], 2)."</td>";

            $connection = null; // Close the database connection
        ?>
    </table>

       <div class="slider" id="slider">
        <div class="slides">
            <!-- Slide contains house photo -->
            <div class="slide">
                <img src="houses.jpeg" alt="House">
            </div>
            <!-- Slide contains apartment photo -->
            <div class="slide">
                <img src="apartment.jpg" alt="Apartment">
            </div>
            <!-- Slide contains room photo -->
            <div class="slide">
                <img src="rooms.jpg" alt="Room">
            </div>
        </div>
    </div>
    <!-- Sliver navigation buttons -->
    <div class="slider-nav" id="slider-nav">
        <button onclick="prevSlide()">Previous</button>
        <button onclick="nextSlide()">Next</button>
    </div>

    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll(".slide");

        function showSlide(index) {
            const slider = document.getElementById("slider");
            if (index >= slides.length) index = 0;
            if (index < 0) index = slides.length - 1;
            slider.querySelector(".slides").style.transform = `translateX(${-100 * index}%)`;
            currentIndex = index;
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }
    </script>

</body>
</html>