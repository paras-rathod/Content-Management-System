<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php confirm_Login(); ?>

<?php
if (isset($_POST["Submit"])) {

    $Title=mysql_real_escape_string($_POST["Title"]);	               
    $Category=mysql_real_escape_string($_POST["Category"]);
    $Post=mysql_real_escape_string($_POST["Post"]);



    date_default_timezone_set("Asia/Kolkata");

    $CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H:%M:%S", $CurrentTime);

    $DateTime=strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
    $DateTime;
    $Admin="Paras Rathod";
    $Image=$_FILES['Image']['name'];
    $Target="Upload/".basename($_FILES['Image']['name']);




        global $ConnectionDB;
        $DeleteFromURL=$_GET['Delete'];

        $Query="DELETE FROM admin_panel1 WHERE id='$DeleteFromURL'";

        $Execute=mysql_query($Query);
        move_uploaded_file($_FILES['Image']['tmp_name'],$Target);


        if($Execute)
        {
            $_SESSION["SuccessMessage"]="Post Deleted successfully";
            Redirect_to("Dashboard.php");
        }
        else
        {
            $_SESSION["ErrorMessage"]="Something went wrong. Try again !";
            Redirect_to("Dashboard.php");
        }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Post</title>
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
                <li class="active"><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span> Add New Post</a></li>
                <li><a href="Categories.php"><span class="glyphicon glyphicon-tags"></span> Categories</a></li>

                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Manage Admins</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-comment"></span> Comments</a></li>

                <li><a href="#"><span class="glyphicon glyphicon-equalizer"></span> Live Blog</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>


        </div> <!-- Ending of side area-->

        <div class="col-sm-10">
            <h1>Delete post</h1>

            <?php echo Message();
            echo SuccessMessage();
            ?>

            <div>

                <?php
                $SearchQueryParameter=$_GET['Delete'];
                $ConnectingDB;
                $Query="SELECT * FROM admin_panel1 WHERE id='$SearchQueryParameter'";
                $ExecuteQuery=mysql_query($Query);

                while($DataRows=mysql_fetch_array($ExecuteQuery)){


                    $TitleToBeUpdated = $DataRows["title"];
                    $CategoryToBeUpdated = $DataRows["category"];
                    $ImageToBeUpdated = $DataRows["image"];
                    $PostToBeUpdated = $DataRows["post"];

                }

                ?>


                <form action="DeletePost.php?Delete=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Title:</span> </label>
                            <input disabled value="<?php echo $TitleToBeUpdated; ?>" class="form-control"
                                   type="text" name="Title" id="title" placeholder="Title">
                        </div>
                        <div class="form-group">

                            <span class="FieldInfo">Existing Category: </span>
                            <?php echo $CategoryToBeUpdated ?>
                            <br>
                            <label for="categoryselect"><span class="FieldInfo">Category:</span> </label>
                            <select disabled class="form-control" id="categoryselect" name="Category">

                                <?php
                                global $ConnectionDB;
                                $ViewQuery="SELECT * FROM category ORDER BY datetime desc";
                                $Execute=mysql_query($ViewQuery);


                                while ($DataRows=mysql_fetch_array($Execute)) {
                                    $Id = $DataRows["id"];

                                    $CategoryName = $DataRows["name"];




                                    ?>

                                    <option><?php echo $CategoryName; ?></option>
                                <?php } ?>  <!--Ending of while loop -->


                            </select>
                        </div>

                        <div class="form-group">

                            <span class="FieldInfo">Existing Image: </span>
                            <img src="Upload/<?php echo $ImageToBeUpdated ?>" width="170px" height="70px">
                            <br>


                            <label for="imageselect"><span class="FieldInfo">Select Image:</span> </label>
                            <input disabled type="File" class="form-control" name="Image" id="imageselect">
                        </div>

                        <div class="form-group">
                            <label for="postarea"><span class="FieldInfo">Post:</span> </label>
                            <textarea disabled class="form-control" name="Post" id="postarea">
                                <?php echo $PostToBeUpdated; ?>
                            </textarea>
                        </div>

                        <br>
                        <input class="btn btn-danger btn-block" type="Submit" name="Submit" value="Delete Post">
                        <br>
                    </fieldset>

                </form>
            </div>












        </div> <!-- Ending of main area-->

    </div> <!-- Ending of Row-->
</div> <!-- Ending of Container-->

<div id="Footer" style="padding: 10px;
	border-top: 1px solid black;
	color: #eeeeee;
	background-color: #211f22;
	text-align: center;">


    <hr>
    <p style="text-align: center; color: #ffffff;">Paras Rathod | &copy; 2017-2018</p>
    <hr>
</div>

<div style="height: 10px; background: #27aae1;"></div>

</body>
</html>
