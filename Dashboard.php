<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>

<?php confirm_Login(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">
</head>
<body>


<div style="height: 10px; background: #27aae1;"></div>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-tatget="#collapse">

                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>


            </button>

            <a class="navbar-brand" href="Blog.php">
                <h4 style="color: #ffffff; text-decoration: none; margin-top: -1px;
                    margin-right: 20px; font-family:cursive; font-weight: bold;">Paras Rathod</h4>

            </a>
        </div>

        <div class="collapse navbar-collapse" id="collapse">

            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li class="active"><a href="Blog.php" target="_blank">Blog</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Features</a></li>
            </ul>

            <form action="Blog.php" class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="Search">
                </div>
                <button class="btn btn-default" name="SearchButton">Go</button>
            </form>

        </div>
    </div>
</nav>
<div class="Line" style="height: 10px; background: #27aae1;"></div>





	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
                <br>
                <br>

				<ul id="Side_Menu" class="nav nav-pills nav-stacked">
					<li class="active"><a href="Dashboard.php">
					<span class="glyphicon glyphicon-th"></span> Dashboard</a></li>
					<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span> Add New Post</a></li>
					<li><a href="Categories.php"><span class="glyphicon glyphicon-tags"></span> Categories</a></li>
					
					<li><a href="Admins.php"><span class="glyphicon glyphicon-user"></span> Manage Admins</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-comment"></span> Comments</a></li>

					<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span> Live Blog</a></li>
					<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</ul>


			</div> <!-- Ending of side area-->
			
			<div class="col-sm-10">  <!-- Main Area-->

                <div><?php echo Message();
                    echo SuccessMessage();
                    ?></div>
				
				<h1>Admin Dashboard</h1>


                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>No</th>
                            <th>Post Title</th>
                            <th>Date & Time</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Banner</th>
                            <th>Comments</th>
                            <th>Action</th>
                            <th>Details</th>

                        </tr>
                        <?php
                        $ConnectingDB;
                        $ViewQuery="SELECT * FROM admin_panel1 ORDER BY datetime desc; ";
                        $Execute=mysql_query($ViewQuery);
                        $srNo=0;

                        while($DataRows=mysql_fetch_array($Execute)) {
                            $Id = $DataRows["id"];
                            $DateTime = $DataRows["datetime"];
                            $Title = $DataRows["title"];
                            $Category = $DataRows["category"];
                            $Admin = $DataRows["author"];
                            $Image = $DataRows["image"];
                            $Post = $DataRows["post"];
                            $srNo++;

                            ?>

                            <tr>
                                <td><?php echo $srNo; ?></td>
                                <td style="color:#5e5eff";><?php
                                    if (strlen($Title)>20){
                                         $Title=substr($Title, 0, 20).'..';
                                    }
                                    echo $Title;
                                    ?></td>

                                <td><?php

                                    if (strlen($DateTime)>16){
                                        $DateTime=substr($DateTime, 0, 16).'..';
                                    }


                                    echo $DateTime; ?></td>
                                <td><?php echo $Admin; ?></td>
                                <td><?php echo $Category; ?></td>
                                <td><img src="Upload/<?php echo $Image; ?>" width="170px"; height="50px" </td>
                                <td>Processing</td>
                                <td><a href="EditPost.php?Edit=<?php echo $Id; ?>">
                                        <span class="btn btn-warning">Edit</span>
                                    </a>

                                <a href="DeletePost.php?Delete=<?php echo $Id; ?>">
                                    <span class="btn btn-danger">Delete</span>
                                </a>

                                </td>
                                <td><a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank">
                                        <span class="btn btn-primary">Live Preview</span></a>
                                </td>

                            </tr>

                            <?php } ?>
                    </table>
                </div>



			</div> <!-- Ending of main area-->
 
		</div> <!-- Ending of Row-->
	</div> <!-- Ending of Container-->

	<div id="Footer" style="padding: 10px;
	margin-top:100px;
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