<?php
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
        <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

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
                                        <h2>Exercise Management</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="table-responsive">
                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                    <tr class="headings">
                                                        <th class="column-title">No. </th>
                                                        <th class="column-title">Teacher </th>
                                                        <th class="column-title">Description </th>
                                                        <th class="column-title">Filename </th>
                                                        <th class="column-title">Created Time</th>
                                                        <?php echo ($_SESSION['usertype'] == 1) ? '<th class="column-title">File Result</th>' : '' ?>
                                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $username = $_SESSION['username'];
                                                    $role_id = $_SESSION['usertype'];
                                                    $sql = "SELECT * FROM exercise WHERE type_id = 1";
                                                    if ($role_id == 2) {
                                                        $sql .= " AND user_created = '$username'";
                                                    }
                                                    $result = mysqli_query($conn, $sql);
                                                    if ($result->num_rows > 0) {
                                                        $count = 1;
                                                        while ($row = $result->fetch_assoc()) {
                                                            if ($count % 2 == 1) {
                                                                echo '<tr class="odd pointer">';
                                                            } else {
                                                                echo '<tr class="even pointer">';
                                                            }
                                                            $id = $row["id"];
                                                            $user_created = $row["user_created"];
                                                            $content = $row["content"];
                                                            $file_name = $row["file_name"];
                                                            $createdtime = $row["createdtime"];

                                                            echo "<td class=\" \">$count</td>";
                                                            echo "<td class=\" \">$user_created</td>";
                                                            echo "<td class=\" \">$content</td>";
                                                            echo "<td class = \" \"><a href=\"uploads/teachers/$file_name\" download>$file_name</a></td>";
                                                            echo "<td class = \" \">$createdtime</td>";
                                                            if ($role_id == "1") {
                                                                $sql = "SELECT file_result FROM do_exercise WHERE exercise_id = $id AND user = '$username'";
                                                                $result_1 = mysqli_query($conn, $sql);
                                                                if ($result_1->num_rows == 1) {
                                                                    while ($row = $result_1->fetch_assoc()) {
                                                                        $file_result = $row["file_result"];
                                                                        echo "<td class = \" \"><a href=\"uploads/students/$file_result\" download>$file_result</a></td>";
                                                                        echo "<td class = \" \"></td>";
                                                                    }
                                                                } else {
                                                                    echo "<td class = \" \"></td>";
                                                                    echo "<td class=\" last\"><a href='do_exercise.php?id=$id'>Do Exercise</a></td>";
                                                                }
                                                            }
                                                            if ($role_id == "2") {
                                                                echo "<td class=\" last\"><a href='detail_exercise.php?id=$id'>View Detail</a></td>";
                                                            }
                                                            echo "</tr>";
                                                            $count += 1;
                                                        }
                                                    }
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
