<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/login.css">
    <link rel="stylesheet" href="./assets/register.css">
</head>
<body>
    <div class="center">
        <h1>Login</h1>
        <?php
         if (isset($_POST["login"])) {
            $email_login = $_POST["email"];
            $password_login = $_POST["password"];

            require_once("database.php");
            $sql = "SELECT * FROM users WHERE email = '$email_login'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                
               $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
               if (password_verify($password_login, $user["password"])) {
                header("Location:index.php" );
                die();
               }else{
                echo "<div class='alert alert-danger'>Password doesn't match</div>";

               }
            }else{
                echo "<div class='alert alert-danger'>This email is not registered</div>" ;
            }
         }
        ?>

        <form class="form" action="login.php" method="post">
            <input type="text" name="email" class="textfiled" placeholder="Email">
            <input type="password" name="password" class="textfiled" placeholder="Password">

            <div class="forgotPassword"><a href="#" class="forgotLink" onclick="forgotmessage()">Forget Password</a></div>
            <input type="submit" name="login" value="Login" class="btn">
            <div class="signup">New Member? <a href="register.php">Sign Up Here</a></div>
        </form>

    </div>

    <script>
        function forgotmessage(){
            alert("Please check the email for password Rese t")
        }
    </script>
</body>
</html>
