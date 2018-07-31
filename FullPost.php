<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php confirm_Login(); ?>


<?php
if (isset($_POST["Submit"])) {

    $Name=mysql_real_escape_string($_POST["Name"]);
    $Email=mysql_real_escape_string($_POST["Email"]);
    $Comment=mysql_real_escape_string($_POST["Comment"]);



    date_default_timezone_set("Asia/Kolkata");

    $CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H:%M:%S", $CurrentTime);

    $DateTime=strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
    $DateTime;
    $PostId=$_GET["id"];




    if (empty($Name) || empty($Email) || empty($Comment)) {
        $_SESSION["ErrorMessage"]="All Fields Are Required";

    }
    elseif (strlen($Comment)>500) {
        $_SESSION["ErrorMessage"]="No more than 500 characters are allowed in comment.";


    }
    else
    {
        global $ConnectionDB;
        $PostIDFromURL=$_GET['id'];

        $Query="INSERT INTO comments(datetime,name, email, comment, status, admin_panel_id)
                VALUES('$DateTime','$Name','$Email','$Comment','OFF','$PostIDFromURL')";

        $Execute=mysql_query($Query);



        if($Execute)
        {
            $_SESSION["SuccessMessage"]="Comment Submitted successfully";
            Redirect_to("FullPost.php?id={$PostId}");
        }
        else
        {
            $_SESSION["ErrorMessage"]="Something went wrong. Try again !";
            Redirect_to("FullPost.php?id={$PostId}");
        }
    }
}
?>









<!DOCTYPE html>
<html>
<head>
    <title>Full Blog Post</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/blogstyle.css">
    <style>
        .col-sm-8{
            background-color: #ffffff;
        }
        .col-sm-3{
            background-color: #eea236;
        }

        .FieldInfo
        {
            color: rgb(251, 174, 44);
            font-family: Bitter, Georgia, "Times New Roman", Times, serif;
            font-size: 1.2em;
        }

        .CommentBlock{
            background-color: #f6f7f9;
        }

        .Comment-info{
            color: #365899;
            font-family: sans-serif;
            font-size: 1.1em;
            font-weight: bold;
            padding-top: 10px;
        }

        .comment{
            margin-top: -2px;
            padding-bottom: 10px;
            font-size: 1.1em;
        }


    </style>

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
                <li class="active"><a href="#">Blog</a></li>
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


<div class="container">
    <div class="blog-header">
        <h1>Suit Up. Ain't nobody got time for that.</h1>
        <p class="lead">Blog on Machine learning by Dr Clever Fox</p>
    </div>

    <div class="row">
        <div class="col-sm-8">


            <?php echo Message();
            echo SuccessMessage();
            ?>


            <?php
            global $ConnectionDB;

            //Search button code

            if (isset($_GET["SearchButton"])){

                $Search=$_GET["Search"];
                $ViewQuery="SELECT * FROM admin_panel1 
                    WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%' ";

            }
            else{

                $PostIdFromURL=$_GET["id"];

                $ViewQuery="SELECT * FROM admin_panel1 WHERE id='$PostIdFromURL'
                 ORDER BY datetime desc";
            }

            $Execute=mysql_query($ViewQuery);



            while($DataRows=mysql_fetch_array($Execute)) {
                $PostId = $DataRows["id"];
                $DateTime = $DataRows["datetime"];
                $Title = $DataRows["title"];
                $Category = $DataRows["category"];
                $Admin = $DataRows["author"];
                $Image = $DataRows["image"];
                $Post = $DataRows["post"];


                ?>

                <div class="blogpost thumbnail" style="background-color: #ffffff">
                    <img class="img-responsive img-rounded" src="Upload/<?php echo $Image; ?>" >
                    <div class="caption">
                        <h1 style="font-family: cursive"><?php echo htmlentities($Title); ?></h1>
                        <p style="font-family: cursive">Category: <?php echo htmlentities($Category); ?>
                            Published On <?php echo htmlentities($DateTime); ?>
                        </p>

                        <p>
                            <?php echo $Post; ?>
                        </p>
                    </div>




                </div>
                <?php
            }
            ?>




            <br>
            <br>
            <span class="FieldInfo">Comments:</span>
            <br>
            <br>


            <?php
            $ConnectingDB;
            $PostIdForComments=$_GET["id"];
            $ExtractingCommentsQuery="SELECT * FROM comments WHERE admin_panel_id=$PostIdForComments AND status='ON'";
            $Execute=mysql_query($ExtractingCommentsQuery);

            while($DataRows=mysql_fetch_array($Execute)) {

            $CommentDate = $DataRows["datetime"];
            $CommenterName = $DataRows["name"];
            $Comments = $DataRows["comment"];

            ?>

            <div class="CommentBlock">
                <img style="margin-left: 10px; margin-top: 10px;" class="pull-left" src="images/fox.jpg" width="80px"; height="70px";>
                <p style="margin-left: 100px;" class="Comment-info"><?php echo $CommenterName; ?></p>
                <p style="font-weight: bold; margin-left: 100px;"><?php echo $CommentDate; ?></p>
                <p style="margin-left: 100px;" class="comment"><?php echo $Comments; ?></p>
            </div>

                <hr>

            <?php } ?>

            <span class="FieldInfo">Share your thoughts about this post</span>
            <br>

            <div>
                <form action="FullPost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="Name"><span class="FieldInfo">Name:</span> </label>
                            <input class="form-control" type="text" name="Name" id="Name" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="Email"><span class="FieldInfo">Email:</span> </label>
                            <input class="form-control" type="email" name="Email" id="Email" placeholder="Email">
                        </div>


                        <div class="form-group">
                            <label for="commentarea"><span class="FieldInfo">Comment:</span> </label>
                            <textarea class="form-control" name="Comment" id="commentarea"></textarea>
                        </div>

                        <br>
                        <input class="btn btn-primary" type="Submit" name="Submit" value="Submit">
                        <br>
                    </fieldset>

                </form>
            </div>


        </div>  <!--Main blog area ending-->





        <div class="col-sm-offset-1 col-sm-3">
            <h2>side bar</h2>
            <p>“Be crumbled.
                So wild flowers will come up where you are.
                You have been stony for too many years.
                Try something different. Surrender.”
                “Be crumbled.
                So wild flowers will come up where you are.
                You have been stony for too many years.
                Try something different. Surrender.”
                Be crumbled.
                So wild flowers will come up where you are.
                You have been stony for too many years.
                Try something different. Surrender.”
                “Be crumbled.
                So wild flowers will come up where you are.
                You have been stony for too many years.
                Try something different. Surrender.”
                Be crumbled.
                So wild flowers will come up where you are.
                You have been stony for too many years.
                Try something different. Surrender.”
                “Be crumbled.
                So wild flowers will come up where you are.
                You have been stony for too many years.
                Try something different. Surrender.”
            </p>
        </div> <!--Side bar area ending-->
    </div>  <!--Row area ending-->
</div>  <!--Container area ending-->

<br>
<br>
<div id="Footer" style="padding: 10px;
    margin-top: 70px;
	border-top: 1px solid black;
	color: #eeeeee;
	background-color: #211f22;
	text-align: center;
	width: 100%;
	margin-bottom: 0px;
   ">


    <hr>
    <p style="text-align: center; color: #ffffff;">Paras Rathod | &copy; 2017-2018</p>
    <p style="text-align: center; color: #ffffff;">Brain Beats Everything.</p>
    <hr>
</div>

<div style="height: 10px; background: #27aae1;"></div>

</body>
</html>