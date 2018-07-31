<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php confirm_Login(); ?>

<?php
if (isset($_POST["Submit"])) {

    $Username=mysql_real_escape_string($_POST["Username"]);
    $Password=mysql_real_escape_string($_POST["Password"]);
    $ConfirmPassword=mysql_real_escape_string($_POST["ConfirmPassword"]);

    date_default_timezone_set("Asia/Kolkata");

    $CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H:%M:%S", $CurrentTime);

    $DateTime=strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
//$DateTime;
    $Admin="Paras Rathod";

    if (empty($Username) || empty($Password) || empty($ConfirmPassword)) {
        $_SESSION["ErrorMessage"]="All fields must be filled out";
        Redirect_to("Admins.php");
    }
    elseif (strlen($Password)<4) {
        $_SESSION["ErrorMessage"]="At least 4 characters for password are required";
        Redirect_to("Admins.php");

    }

    elseif ($Password != $ConfirmPassword) {
        $_SESSION["ErrorMessage"]="Password / ConfirmPassword does not match";
        Redirect_to("Admins.php");

    }



    else
    {
        global $ConnectionDB;
        $Query="INSERT INTO registration(datetime, username, password, addedby)
	VALUES('$DateTime', '$Username','$Password', '$Admin')";
        $Execute=mysql_query($Query);

        if($Execute)
        {
            $_SESSION["SuccessMessage"]="Admin added successfully";
            Redirect_to("Admins.php");
        }
        else
        {
            $_SESSION["ErrorMessage"]="Admin failed to add";
            Redirect_to("Admins.php");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Admins</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/adminstyles.css">
    <style type="text/css">
        .FieldInfo
        {
            color: rgb(251, 174, 44);
            font-family: Bitter, Georgia, "Times New Roman", Times, serif;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">

            <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                <li><a href="Dashboard.php">
                        <span class="glyphicon glyphicon-th"></span> Dashboard</a></li>
                <li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span> Add New Post</a></li>
                <li><a href="Categories.php"><span class="glyphicon glyphicon-tags"></span> Categories</a></li>

                <li class="active"><a href="Admins.php"><span class="glyphicon glyphicon-user"></span> Manage Admins</a></li>
                <li><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span> Comments</a></li>

                <li><a href="#"><span class="glyphicon glyphicon-equalizer"></span> Live Blog</a></li>
                <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>


        </div> <!-- Ending of side area-->

        <div class="col-sm-10">
            <h1>Manage Admin Access</h1>

            <?php echo Message();
            echo SuccessMessage();
            ?>

            <div>
                <form action="Admins.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="Username"><span class="FieldInfo">UserName:</span> </label>
                            <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                        </div>


                        <div class="form-group">
                            <label for="Password"><span class="FieldInfo">Password:</span> </label>
                            <input class="form-control" type="password" name="Password" id="Password" placeholder="Password">
                        </div>


                        <div class="form-group">
                            <label for="ConfirmPassword"><span class="FieldInfo">Confirm Password:</span> </label>
                            <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Retype same password">
                        </div>


                        <br>
                        <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Admin">
                        <br>
                    </fieldset>

                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Sr No.</th>
                        <th>Date & Time</th>
                        <th>Admin Name</th>
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    global $ConnectionDB;
                    $ViewQuery="SELECT * FROM registration ORDER BY datetime desc";
                    $Execute=mysql_query($ViewQuery);
                    $SrNo=0;  //for proper serial numbers

                    while ($DataRows=mysql_fetch_array($Execute)) {
                        $Id=$DataRows["id"];
                        $DateTime=$DataRows["datetime"];
                        $Username=$DataRows["username"];
                        $Admin=$DataRows["addedby"];
                        $SrNo++;

                        ?>
                        <!--//Fetch and print-->

                        <tr>
                            <td><?php echo $SrNo; ?></td>
                            <td><?php echo $DateTime; ?></td>
                            <td><?php echo $Username; ?></td>
                            <td><?php echo $Admin; ?></td>
                            <td><a href="DeleteAdmin.php?id=<?php echo $Id ?>"><span class="btn btn-danger">Delete</span></a> </td>
                        </tr>

                    <?php } ?>
                </table>
            </div>


        </div> <!-- Ending of main area-->

    </div> <!-- Ending of Row-->
</div> <!-- Ending of Container-->

<div id="Footer" style="padding: 10px;
	margin-top: 70px;
	border-top: 1px solid black;
	color: #eeeeee;
	background-color: #211f22;
	text-align: center;">


    <hr>
    <p style="text-align: center; color: #ffffff;">Paras Rathod | &copy; 2017-2018</p>
    <p style="text-align: center; color: #ffffff;">Brain Beats Everything.</p>
    <hr>
</div>

<div style="height: 10px; background: #27aae1;"></div>

</body>
</html>