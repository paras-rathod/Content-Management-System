<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>


<!DOCTYPE html>
<html>
<head>
    <title>Blog Post</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/blogstyle.css">
    <style>
        .col-sm-8{
            background-color: #9acfea;
        }
        .col-sm-3{
            background-color: #eea236;
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
                        <li class="active"><a href="Blog.php">Blog</a></li>
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
           <!-- <h1>Suit Up. Ain't nobody got time for that.</h1>
            <p class="lead">Blog on Machine learning by Dr Clever Fox</p>-->
            <br>
            <br>
        </div>

        <div class="row">
            <div class="col-sm-8">

                <?php
                global $ConnectionDB;

                //Search button code

                if (isset($_GET["SearchButton"])){

                    $Search=$_GET["Search"];
                    $ViewQuery="SELECT * FROM admin_panel1 
                    WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%' ";

                }
                else{

                    $ViewQuery="SELECT * FROM admin_panel1 ORDER BY datetime desc";
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


                    <div class="blogpost thumbnail">
                        <img class="img-responsive img-rounded" src="Upload/<?php echo $Image; ?>" >
                        <div class="caption">
                            <h1 style="font-family: cursive; color: #d58512;"><?php echo htmlentities($Title); ?></h1>
                            <p style="font-family: cursive">Category: <?php echo htmlentities($Category); ?>
                                Published On <?php echo htmlentities($DateTime); ?>
                            </p>

                            <p>
                                <?php
                                if (strlen($Post)>150){
                                    $Post=substr($Post, 0, 150).'...';
                                }
                                echo $Post; ?>
                            </p>
                        </div>


                        <a href="FullPost.php?id=<?php echo $PostId; ?>"><span class="btn btn-info">
                                Read More &rsaquo;&rsaquo;
                            </span> </a>


                    </div>
                    <?php
                }
                ?>

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
    margin-top:100px;
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