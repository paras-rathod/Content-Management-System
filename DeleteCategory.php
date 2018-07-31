<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php confirm_Login(); ?>
<?php
if(isset($_GET["id"])){
    $IdFromURL=$_GET["id"];
    $ConnectingDB;

    $Query="DELETE FROM category WHERE id='$IdFromURL'";
    $Execute=mysql_query($Query);

    if($Execute)
    {
        $_SESSION["SuccessMessage"]="Category deleted successfully";
        Redirect_to("Categories.php");
    }
    else
    {
        $_SESSION["ErrorMessage"]="Something went wrong. Try again !";
        Redirect_to("Categories.php");
    }



}


?>
