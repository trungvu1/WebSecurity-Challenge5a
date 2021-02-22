<?php
ob_start();
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['typeuser'])) {
    header('Location: view_user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Challenge 5a!</title>

        <!-- Bootstrap -->
        <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="build/css/custom.min.css" rel="stylesheet">
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form method="POST" action="login.php">
                            <h1>Login Form</h1>
                            <div>
                                <input type="text" class="form-control" name="username" placeholder="Username" required="" />
                            </div>
                            <div>
                                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                            </div>
                            <?php
                            require_once("DBHelper/connection.php");
                            if (isset($_POST["btn_login"])) {
                                $username = $_POST["username"];
                                $password = $_POST["password"];
                                if ($username == "" || $password == "") {
                                    echo "Please fill data to username and password!";
                                } else {
                                    $sql = "SELECT role_id, fullname FROM user where username = '$username' and password = '$password' ";
                                    $result = mysqli_query($conn, $sql);
                                    $num_rows = mysqli_num_rows($result);
                                    if ($num_rows != 1) {
                                        echo "Wrong username or password!";
                                    } else {
                                        $_SESSION['username'] = $username;
                                        while($row = $result->fetch_assoc()) {
                                            $_SESSION['usertype'] = $row["role_id"];
                                        }
                                        header('Location: view_user.php');
                                        ob_end_flush();
                                    }
                                }
                            }
                            ?>
                            <div class="clearfix"></div>
                            <div>
                                <button class="btn btn-default submit" name="btn_login" href="index.html">Log in</button>
                                <button class="btn btn-default submit" href="#">Lost your password?</button>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">New to site?
                                    <a href="#" class="to_register"> Create Account </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
