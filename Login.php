<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>


<?php
if (isset($_POST["Submit"])) {

    $Username=mysql_real_escape_string($_POST["Username"]);
    $Password=mysql_real_escape_string($_POST["Password"]);


    if (empty($Username) || empty($Password)) {
        $_SESSION["ErrorMessage"]="All fields must be filled out";
        Redirect_to("Login.php");
    }

    else
    {
        $Found_Account=Login_Attempt($Username, $Password);

        $_SESSION["User_Id"]=$Found_Account["id"];
        $_SESSION["Username"]=$Found_Account["username"];

        if($Found_Account){
            $_SESSION["SuccessMessage"]="Welcome {$_SESSION["Username"]}";
            Redirect_to("Dashboard.php");
        }
        else{
            $_SESSION["ErrorMessage"]="Invalid username / password";
            Redirect_to("Login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
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

        body{
            background-color: #ffffff;
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


    </div>
</nav>

<div class="Line" style="height: 10px; background: #27aae1;"></div>









<div class="container-fluid">
    <div class="row">

        <div class="col-sm-offset-4 col-sm-4">


            <br>  <br>  <br>  <br>
            <?php echo Message();
            echo SuccessMessage();
            ?>

           <h2>Welcome!</h2>



            <div>
                <form action="Login.php" method="post">
                    <fieldset>
                        <div class="form-group">

                            <label for="Username"><span class="FieldInfo">UserName:</span> </label>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope text-primary"></span>
                                </span>
                            <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                        </div>
                        </div>


                        <div class="form-group">
                            <label for="Password"><span class="FieldInfo">Password:</span> </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock text-primary"></span>
                                </span>
                            <input class="form-control" type="password" name="Password" id="Password" placeholder="Password">
                        </div>
                        </div>





                        <br>
                        <input class="btn btn-info btn-block" type="Submit" name="Submit" value="Login">
                        <br>
                    </fieldset>

                </form>
            </div>



        </div> <!-- Ending of main area-->

    </div> <!-- Ending of Row-->
</div> <!-- Ending of Container-->



</body>
</html>