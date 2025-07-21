<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="./assets/register.css">
</head>

<body>
    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
            $fullname        = $_POST["fullname"];
            $email           = $_POST["email"];
            $address         = $_POST["address"];
            $contactno       = $_POST["contactno"];
            $dob             = $_POST["dob"];
            $password        = $_POST["password"];
            $repeatpassword  = $_POST["repeat_password"];

            $errors = array();

            // Simple validation
            if (
                empty($fullname) || empty($email) || empty($address) ||
                empty($contactno) || empty($dob) || empty($password) || empty($repeatpassword)
            ) {
                array_push($errors, "All values are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if ($password != $repeatpassword) {
                array_push($errors, "Password doesn't match");
            }
            if (strlen($password) < 6) {
                array_push($errors, "Password must be same and above then 6 letters");
            }

            // Connect to MySQL
            require_once 'database.php';

            // Check if email already exists
            if (empty($errors)) {
                $email_query = "SELECT * FROM users WHERE email = ?";
                $email_stmt = mysqli_prepare($conn, $email_query);
                mysqli_stmt_bind_param($email_stmt, "s", $email);
                mysqli_stmt_execute($email_stmt);
                mysqli_stmt_store_result($email_stmt);
                if (mysqli_stmt_num_rows($email_stmt) > 0) {
                    array_push($errors, "Email is already registered");
                }
                mysqli_stmt_close($email_stmt);
            }

            // Show errors or insert user
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $hashpassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (fullname, email, address, contactno, dob, password) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ssssss", $fullname, $email, $address, $contactno, $dob, $hashpassword);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<div class='alert alert-success'>Registration successful!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error: " . mysqli_stmt_error($stmt) . "</div>";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "<div class='alert alert-danger'>Database statement failed: " . mysqli_error($conn) . "</div>";
                }
                mysqli_close($conn);
            }
        }
        ?>
        <form method="post" action="register.php">
            <div class="form-group">
                <input type="text" name="fullname" class="textfiled" placeholder="Full Name">
            </div>
            <div class="form-group">
                <input type="text" name="email" class="textfiled" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" name="address" class="textfiled" placeholder="Address">
            </div>
            <div class="form-group">
                <input type="text" name="contactno" class="textfiled" placeholder="Contact No">
            </div>
            <div class="form-group">
                <input type="date" name="dob" class="textfiled" placeholder="Date of Birth">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="textfiled" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" name="repeat_password" class="textfiled" placeholder="Repeat-Password">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Register">
            </div>
        </form>
    </div>
</body>

</html>