<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php confirm_Login(); ?>

<?php
if (isset($_POST["Submit"])) {

$Title=mysql_real_escape_string($_POST["Title"]);	                //sql injection proof
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



if (empty($Title)) {
	$_SESSION["ErrorMessage"]="Title can't be empty";
	Redirect_to("AddNewPost.php");
}
elseif (strlen($Title)<2) {
	$_SESSION["ErrorMessage"]="Title should be at least 2 characters";
	Redirect_to("AddNewPost.php");

}
else
{
	global $ConnectionDB;
	$Query="INSERT INTO admin_panel1(datetime, title, category, author, image, post)
	VALUES('$DateTime','$Title','$Category','$Admin','$Image','$Post')";

	$Execute=mysql_query($Query);
	move_uploaded_file($_FILES['Image']['tmp_name'],$Target);


	if($Execute)
	{
		$_SESSION["SuccessMessage"]="Post added successfully";
	Redirect_to("AddNewPost.php");
	}
	else
	{
		$_SESSION["ErrorMessage"]="Something went wrong. Try again !";
	Redirect_to("AddNewPost.php");
	}
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add New Post</title>
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
				<h1>Add New post</h1>

				<?php echo Message();
					  echo SuccessMessage();
				 ?>

				<div>
					<form action="AddNewPost.php" method="post" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Title:</span> </label>
								<input class="form-control" type="text" name="Title" id="title" placeholder="Title">
							</div>
                            <div class="form-group">
                                <label for="categoryselect"><span class="FieldInfo">Category:</span> </label>
                                <select class="form-control" id="categoryselect" name="Category">

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
                                <label for="imageselect"><span class="FieldInfo">Select Image:</span> </label>
                                <input type="File" class="form-control" name="Image" id="imageselect">
                            </div>

                            <div class="form-group">
                                <label for="postarea"><span class="FieldInfo">Post:</span> </label>
                                <textarea class="form-control" name="Post" id="postarea"></textarea>
                            </div>

							<br>
							<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Post">
							<br>
						</fieldset>

					</form>
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