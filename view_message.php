<?php
ob_start();
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['usertype'])) {
    header('Location: logout.php');
    return;
}
require_once("DBHelper/connection.php");
$username = $_SESSION['username'];
$sql = "SELECT fullname FROM user WHERE username = '$username'";
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
                                    <?php
                                    echo $fullname;
                                    ?>
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
                                        <?php
                                        echo $fullname;
                                        ?>
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
                        <div class="row" style="display: block;">
                            <div class="col-md-12 col-sm-12  ">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>User Management</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="table-responsive">
                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                    <tr class="headings">
                                                        <th class="column-title">No. </th>
                                                        <th class="column-title">Sent </th>
                                                        <th class="column-title">Receive </th>
                                                        <th class="column-title">Subject </th>
                                                        <th class="column-title">Content </th>
                                                        <th class="column-title">Created Time </th>
                                                        <th class="column-title">Modified Time </th>
                                                        <?php
                                                        if (isset($_GET["content"]) && $_GET["content"] == "sent") {
                                                            echo '<th class="column-title no-link last"><span class="nobr">Action</span></th>';
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($_GET["content"])) {
                                                        if ($_GET["content"] == "sent") {
                                                            $sql_condition = "WHERE sent_user = '$username'";
                                                            if (isset($_GET["delete"]) && $_GET["delete"] = "true" && isset($_GET["id"])) {
                                                                $id = $_GET["id"];
                                                                $sql = "SELECT * FROM message WHERE id = $id AND sent_user = '$username' AND enable = 1";
                                                                $result = mysqli_query($conn, $sql);
                                                                if ($result->num_rows == 1) {
                                                                    $sql = "UPDATE message SET enable = 0 WHERE id = $id AND sent_user = '$username' AND enable = 1";
                                                                    if (mysqli_query($conn, $sql)) {
                                                                        echo '<script type="text/javascript"> '
                                                                        . 'alertify.success(\'Delete message successfully\', 2);'
                                                                        . 'setTimeout(function() { window.location.href = "view_message.php?content=sent";}, 2200);'
                                                                        . ' </script>';
                                                                    } else {
                                                                        echo "<div class=\"col-md-6 col-sm-6 offset-md-3\">Could not able to execute!</div><br />";
                                                                    }
                                                                } else {
                                                                    //header("Location: view_message.php?content=sent");
                                                                    return;
                                                                }
                                                            }
                                                        } else if ($_GET["content"] == "recv") {
                                                            $sql_condition = "WHERE recv_user = '$username'";
                                                        } else {
                                                            header('Location: view_message.php?content=sent');
                                                            return;
                                                        }
                                                        $sql = "SELECT * FROM message $sql_condition AND enable=1";
                                                        $result = mysqli_query($conn, $sql);
                                                        if ($result->num_rows > 0) {
                                                            $count = 1;
                                                            while ($row = $result->fetch_assoc()) {
                                                                $id = $row["id"];
                                                                $sent_user = $row["sent_user"];
                                                                $recv_user = $row["recv_user"];
                                                                $subject = $row["subject"];
                                                                $content = $row["content"];
                                                                $created_time = $row["createdtime"];
                                                                $modified_time = $row["modifiedtime"];

                                                                if ($count % 2 == 1) {
                                                                    echo '<tr class="odd pointer">';
                                                                } else {
                                                                    echo '<tr class="even pointer">';
                                                                }
                                                                echo "<td class=\" \">$count</td>";
                                                                echo "<td class=\" \">$sent_user</td>";
                                                                echo "<td class=\" \">$recv_user</td>";
                                                                echo "<td class = \" \">$subject</td>";
                                                                echo "<td class = \" \">$content</td>";
                                                                echo "<td class = \" \">$created_time</td>";
                                                                echo "<td class = \" \">$modified_time</td>";
                                                                if ($_GET["content"] == "sent") {
                                                                    echo '<td class=" last">';
                                                                    echo "<a href='edit_message.php?id=$id'>Edit</a> | <a href='view_message.php?content=sent&id=$id&delete=true'>Delete</a></td>";
                                                                }
                                                                echo "</tr>";
                                                                $count += 1;
                                                            }
                                                        }
                                                    } else {
                                                        header('Location: view_message.php?content=sent');
                                                        return;
                                                    }
                                                    ob_end_flush();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
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

        <!-- jQuery -->
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="build/js/custom.min.js"></script>
    </body>
</html>
