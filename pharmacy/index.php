<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Maintanance</title>
    <link rel="stylesheet" href="assets/index.css">

</head>

<body>
    <?php
    include("database.php");
    ?>
    <h2>Orders</h2>
    <?php
    require_once("database.php");

    $query = "SELECT id,fullname, email, note FROM userimages";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Name</th><th>Email</th><th>Note</th><th>Preview</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['note']) . "</td>";
            echo "<td><a href='view.php?email=" . $row['fullname'] . "' class='preview-btn'>Preview</a></td>";

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No users found.</p>";
    }

    mysqli_close($conn);
    ?>
</body>

</html>