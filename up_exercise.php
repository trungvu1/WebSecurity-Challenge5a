<?php
ob_start();
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['usertype'])) {
    header('Location: logout.php');
    return;
}
if ($_SESSION['usertype'] == "1") {
    header('Location: view_exercise.php');
    return;
}
require_once("DBHelper/connection.php");
$current_username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$current_username'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows == 1) {
    while ($row = $result->fetch_assoc()) {
        $fullname = $row["fullname"];
    }
} else {
    header('Location: logout.php');
    return;
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
                                            <?php echo ($_SESSION['usertype'] == "2") ? '<li><a href="create_user.php">Create User</a></li>' : '' ?>
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
                                        <h2>Create Exercise</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <br />

                                        <?php
                                        if (isset($_POST["btn_cancel"])) {
                                            header("Location: view_exercise.php");
                                        }
                                        if (isset($_POST["btn_submit"])) {
                                            $username = $_SESSION['username'];
                                            $sql = "SELECT * FROM user WHERE username = '$username'";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = $result->fetch_assoc()) {
                                                $role_id = $row["role_id"];
                                            }
                                            if ($result->num_rows == 1 && $role_id == "2") {
                                                $description = $_POST["description"];
                                                $time = date("Y-m-d h:i:sa");

                                                $column = "user_created, type_id, content, createdtime";
                                                $value = "'$username', 1, '$description', '$time'";

                                                $upload_result = 1;
                                                $target_file = "";
                                                if ($_FILES["file_upload"]["error"] != 4) {
                                                    $target_dir = "uploads/teachers/";
                                                    $file_name = basename($_FILES["file_upload"]["name"]);
                                                    $target_file = $target_dir . $file_name;
                                                    if (file_exists($target_file)) {
                                                        echo "Sorry, filename already exists.";
                                                        $upload_result = 0;
                                                    }
                                                    if ($_FILES["file_upload"]["size"] > 5000000) {
                                                        echo "Sorry, your file is too large. Limited < 5mb.";
                                                        $upload_result = 0;
                                                    }
                                                    if ($_FILES["file_upload"]["size"] == 0) {
                                                        echo "Sorry, your file is too low, need to greater than 0B.";
                                                        $upload_result = 0;
                                                    }
                                                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                                    $list_allow_extension = array("jpg", "png", "jpeg", "mp4", "mov", "doc", "docx", "xls", "xlsx", "pdf");
                                                    if (!in_array($imageFileType, $list_allow_extension)) {
                                                        echo "Sorry, only [" . implode(", ", $list_allow_extension) . "] files are allowed.";
                                                        $upload_result = 0;
                                                    }
                                                    $column .= ", file_name";
                                                    $value .= ", '$file_name'";
                                                }
                                                $sql = "INSERT INTO exercise ($column) VALUES ($value)";
                                                if ($upload_result == 1 && mysqli_query($conn, $sql)) {
                                                    if ($_FILES["file_upload"]["error"] != 4 &&
                                                            move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
                                                        echo '<script type="text/javascript"> '
                                                        . 'alertify.success(\'Upload file successfully\', 2);'
                                                        . ' </script>';
                                                    }
                                                    echo '<script type="text/javascript"> '
                                                    . 'alertify.success(\'Create exercise successfully\', 2);'
                                                    . 'setTimeout(function() { window.location.href = "view_exercise.php"; }, 2200);'
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
                                        <form method="POST" action="up_exercise.php" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Description </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <textarea class="form-control" name="description" required><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Upload File </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="x_panel">
                                                        <input type="file" name="file_upload" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>
                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 offset-md-3">
                                                    <button class="btn btn-success" name="btn_submit">Create</button>
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
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="build/js/custom.min.js"></script>

    </body></html>
