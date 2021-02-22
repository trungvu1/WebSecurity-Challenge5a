<?php
ob_start();
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['usertype'])) {
    header('Location: logout.php');
    return;
}
require_once("DBHelper/connection.php");
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows == 1) {
    while ($row = $result->fetch_assoc()) {
        $fullname = $row["fullname"];
    }
} else {
    header('Location: logout.php');
    return;
}

$username = $_SESSION['username'];
if (isset($_GET["user"])) {
    $username = $_GET["user"];
}
if (($_SESSION['usertype'] == "1" && strcmp($_SESSION['username'], $username) == 0) || $_SESSION['usertype'] == "2") {
    $sql = "select * from user where username = '$username'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $fullname_edit = $row["fullname"];
            $email = $row["email"];
            $phonenumber = $row["phonenumber"];
        }
    } else {
        header("Location: view_user.php");
    }
} else {
    header("Location: edit_user.php?user=" . $_SESSION['username']);
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
        <title>Challenge 5a</title>
        <!-- Bootstrap -->
        <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="build/alertifyjs/css/alertify.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- alertify -->
        <script src="build/alertifyjs/alertify.min.js"></script>
        <!-- Custom Theme Style -->
        <link href="build/css/custom.min.css" rel="stylesheet">
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>Challenge 5a!</span></a>
                        </div>
                        <div class="clearfix"></div>
                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2>
                                    <?php echo $fullname; ?>
                                </h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->
                        <br />
                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <ul class="nav side-menu">
                                    <li><a href="index.php"><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a></li>
                                    <li><a><i class="fa fa-edit"></i> User Management <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="view_user.php">View User</a></li>
                                            <?php echo ($_SESSION['usertype'] == "2") ? '<li><a href="create_user.php">Create User</a></li>' : ''?>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-envelope-o"></i> Message Management <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="view_message.php?content=sent">View sent message</a></li>
                                            <li><a href="view_message.php?content=recv">View receive message</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-book"></i> Exercise Management <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <?php echo ($_SESSION['usertype'] == "2") ? '<li><a href="up_exercise.php">Create exercise</a></li>' : ''?>
                                            <li><a href="view_exercise.php">View exercise</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-gamepad"></i> Challenge Management <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <?php echo ($_SESSION['usertype'] == "2") ? '<li><a href="up_challenge.php">Create challenge</a></li>' : ''?>
                                            <li><a href="view_challenge.php">View challenge</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /sidebar menu -->
                    </div>
                </div>
                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <nav class="nav navbar-nav">
                            <ul class=" navbar-right">
                                <li class="nav-item dropdown open" style="padding-left: 15px;">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                        <img src="images/img.jpg" alt="">
                                        <?php echo $fullname; ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item"  href="edit_user.php"> Profile</a>
                                        <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->
                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 ">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Edit User</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <br />

                                        <?php
                                        if (isset($_POST["btn_cancel"])) {
                                            header("Location: view_user.php");
                                        }
                                        if (isset($_POST["btn_submit"])) {
                                            $username1 = $_POST["username"];
                                            $password1 = $_POST["password"];
                                            $fullname1 = $_POST["fullname"];
                                            $email1 = $_POST["email"];
                                            $phonenumber1 = $_POST["phonenumber"];

                                            $sql = "SELECT * FROM user WHERE username = '$username1'";
                                            $result = mysqli_query($conn, $sql);
                                            if ($result->num_rows == 1) {
                                                $sql = "UPDATE user SET ";
                                                $check = 0;
                                                if ($password1 != "") {
                                                    $sql .= "password = '$password1'";
                                                    $check = 1;
                                                }
                                                if ($_SESSION['usertype'] == "2" && $fullname1 != "") {
                                                    if ($check == 1) {
                                                        $sql .= ", ";
                                                    }
                                                    $check = 1;
                                                    $sql .= "fullname = '$fullname1'";
                                                }
                                                if ($email1 != "") {
                                                    if ($check == 1) {
                                                        $sql .= ", ";
                                                    }
                                                    $check = 1;
                                                    $sql .= "email = '$email1'";
                                                }
                                                if ($phonenumber1 != "") {
                                                    if ($check == 1) {
                                                        $sql .= ", ";
                                                    }
                                                    $sql .= "phonenumber = '$phonenumber1'";
                                                }
                                                $sql .= " WHERE username = '$username1'";
                                                if (mysqli_query($conn, $sql)) {
                                                    // echo "<div class=\"col-md-6 col-sm-6 offset-md-3\">Change infomation Successfully!</div><br />";
                                                    echo '<script type="text/javascript"> '
                                                    . 'alertify.success(\'Change infomation Successfully\', 2);'
                                                    . 'setTimeout(function() { window.location.href = "view_user.php"; }, 2200);'
                                                    . ' </script>';
                                                } else {
                                                    echo "<div class=\"col-md-6 col-sm-6 offset-md-3\">Could not able to execute!</div><br />";
                                                }
                                            } else {
                                                header("Refresh:0");
                                            }
                                        }
                                        ob_end_flush();
                                        ?>
                                        <form method="POST" action="edit_user.php?user=<?php echo $username; ?>" data-parsley-validate class="form-horizontal form-label-left">
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Username </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" name="username" value="<?php echo $username; ?>" required="required" class="form-control " readonly>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Password </label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="password" id="password1" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" />
                                                    <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
                                                        <i id="slash" class="fa fa-eye-slash"></i>
                                                        <i id="eye" class="fa fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Fullname </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" value="<?php
                                                    if ($_SESSION['usertype'] == "2" && isset($_POST['fullname'])) {
                                                        echo $_POST['fullname'];
                                                    } else {
                                                        echo $fullname_edit;
                                                    }
                                                    ?>" <?php if($_SESSION['usertype'] == "1") { echo 'readonly'; } ?> required="required" name="fullname" class="form-control">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Email </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $email; ?>" name="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Phone Number </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" value="<?php echo isset($_POST['phonenumber']) ? $_POST['phonenumber'] : $phonenumber; ?>" name="phonenumber" class="form-control">
                                                </div>
                                            </div>
                                            <div class="ln_solid"></div>
                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 offset-md-3">
                                                    <button class="btn btn-success" name="btn_submit">Update</button>
                                                    <button class="btn btn-primary" name="btn_cancel">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Developed by TrungVT12
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <script src="vendors/validator/validator.js"></script>
        <script>
                                                        function hideshow() {
                                                            var password = document.getElementById("password1");
                                                            var slash = document.getElementById("slash");
                                                            var eye = document.getElementById("eye");

                                                            if (password.type === 'password') {
                                                                password.type = "text";
                                                                slash.style.display = "block";
                                                                eye.style.display = "none";
                                                            }
                                                            else {
                                                                password.type = "password";
                                                                slash.style.display = "none";
                                                                eye.style.display = "block";
                                                            }

                                                        }
        </script>

        <script>
            // initialize a validator instance from the "FormValidator" constructor.
            // A "<form>" element is optionally passed as an argument, but is not a must
            var validator = new FormValidator({
                "events": ['blur', 'input', 'change']
            }, document.forms[0]);
            // on form "submit" event
            document.forms[0].onsubmit = function (e) {
                var submit = true,
                        validatorResult = validator.checkAll(this);
                console.log(validatorResult);
                return !!validatorResult.valid;
            };
        </script>
        <!-- jQuery -->
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="build/js/custom.min.js"></script>

    </body></html>
