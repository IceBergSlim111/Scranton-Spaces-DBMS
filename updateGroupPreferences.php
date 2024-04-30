<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Preferences</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
        }
        .header {
            background: #000000;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            display: flex; /* Use flexbox for alignment */
            align-items: center; /* Align items vertically */
            justify-content: center; /* Center items horizontally */
        }
        .header h1 {
            margin: 0; /* Remove margin for h1 to align correctly with the logo */
            padding-left: 15px; /* Add some space between the logo and the title */
        }
        .header img {
            height: 100px; /* Adjust the size of your logo as needed */
        }
        .nav {
            padding: 0;
            margin: 0;
            list-style-type: none;
            background-color: #444;
            overflow: hidden;
            display: flex;
            justify-content: center; /* Center the navigation items */
        }
        .nav li {
            float: none; /* Remove float as it's not needed with flexbox */
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
            display: block; /* Or display: flex; if you want to center it using flexbox */
            margin-left: auto;
            margin-right: auto;
            width: 100%; /* Ensures the image is responsive and doesn't overflow the screen width */
            height: auto; /* Keeps the image aspect ratio */
        }
        p {
            font-size: 18px;
        }

        input[type="number"], select, input[type="date"], input[type="radio"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            width: auto;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
    <h1>Update Rental Preferences</h1>
<p>Make your rental adjustments below:</p>

<?php
include 'connectdb.php';
// Extract Group ID from the URL
$group_id = $_GET['group_id'];
?>

<form action="updateForm.php" method="post"> 
    <p>Property Type:</p>
    <select name="property_type">
        <option value="House">House</option>
        <option value="Apartment">Apartment</option>
        <option value="Room">Room</option>
    </select> <br> <br>

    <p>Number of Bedrooms:</p>
    <input type="number" name="bedrooms" min="1"> <br> <br>

    <p>Number of Bathrooms:</p>
    <input type="number" name="bathrooms" min="1"> <br> <br>

    <p>Max Rent:</p>
    <input type="number" name="max_rent" step="0.01" min="0"> <br> <br>

    <p>Parking:</p>
    <label><input type="radio" name="parking" value="1"> Yes</label>
    <label><input type="radio" name="parking" value="0"> No</label> <br> <br>

    <p>Laundry:</p>
    <label><input type="radio" name="laundry" value="1"> Ensuite</label>
    <label><input type="radio" name="laundry" value="0"> Shared</label> <br> <br>

    <p>Accessibility:</p>
    <select name="accessibility">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select> <br> <br>

    <input type="hidden" name="group_id" value="<?php echo htmlspecialchars($group_id); ?>">
    <input type="submit" value="Update Preferences">
</form> 

</body>
</html>