<?php
include 'config.php';
$email='';
if(isset($_POST['formact']) and $_POST['formact']='forgetpassword')
{
    $email=$_POST['email'];
    $rs=  mysql_query("select * from `user` where `EMAIL`=".$email);
    $num = mysql_num_rows($rs);
    if($num)
    {
        $_SESSION['msg']="This email exists in the database.";
        header("Location: forgetpassword.php" );
        exit();
    }
    else
    {
        $_SESSION['msg']="This email does not exist in the database.";
        header("Location: forgetpassword.php" );
        exit();
    }
    
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>my first web page</title>
        <script src="js/jquery.js">
        </script>
        <script src="js/bootstrap.js"></script>

        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-theme.css" rel="stylesheet"/>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div id="wrap" class="container-fluid">

<?php
include 'header.php';
?>

            <div class="clearfix">

            </div>
            <div id="maincontent" class="container-fluid">
                <div class="container">
                    <div class="row marT20">
                        <div class="col-md-25">

                        </div>
                        <div class="col-md-50">
<?php
if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
    ?>
                                <div class="row" id="error">
                                    <div class="col-md-100">
                                        <div class="alert alert-danger"><div class="row"><div class="col-md-90"><?php echo $_SESSION['msg']; ?></div><div class="col-md-10">
                                                    <span class="glyphicon glyphicon-remove" class="clkerror" style="cursor:pointer; font-size: 20px;" onclick="jQuery('#error').hide('fade')" ></span></div></div>
 
                                        </div>       
                                    </div>
                                </div>
<?php } ?>
                            <div class="panel panel-primary">
                                <div class="panel-heading">

                                    <h3 class="panel-title">
                                        <span class="glyphicon glyphicon-question-sign">

                                        </span>
                                        &nbsp;
                                        &nbsp;
                                        FORGET PASSWORD</h3>
                                </div>
                                <div class="panel-body">

                                    <form class="form-horizontal" role="form" method="post" action="forgetpassword.php">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-20 control-label">Email</label>
                                            <div class="col-sm-80">
                                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-20 col-sm-80">
                                                <input type="hidden" name="formact" id='formact' value='forgetpassword'/>
                                                <button type="submit" value="submit" class="btn btn-primary" id="submit" name="submit">
                                                    <span class="glyphicon glyphicon-info-sign"> </span>
                                                    &nbsp;
                                                    Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-25">

                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include 'footer.php';
?>
    </body>
</html>