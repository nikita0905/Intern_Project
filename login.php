<?php
include 'config.php';
$email='';
$password ='';
if (isset($_SESSION['ID']) && $_SESSION['ID'] != '') {
    header("Location:dashboard.php");
    exit();
}
if (isset($_POST['formact']) && $_POST['formact'] == 'login-user') {
    $email = (isset($_POST['email']) && $_POST['email'] != '' ) ? $_POST['email'] : '';
    $password = (isset($_POST['password']) && $_POST['password'] != '' ) ? $_POST['password'] : '';
    $rs = mysql_query("select * from user where EMAIL='" . $email . "'");
    $num = mysql_num_rows($rs);

    if ($num) {
        //perform login 
        $row = mysql_fetch_assoc($rs); //three types of arrays-mitched array,index array and named array
        if ($row['EMAIL'] == $email && $row['PASSWORD'] == $password) {
            $_SESSION['ID'] = $row['ID'];
            if(isset($_POST['rememberme']) && $_POST['rememberme']=='rememberme'){
   
                setcookie('email', $email,time()+3600);
                setcookie('password', $password,time()+3600);
                setcookie('ID', $row['ID'],time()+3600);
              
            }
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['msg'] = "wrong username and password";
            header("Location: login.php");
            exit();
        }
    } else {
        //errror message display
        $_SESSION['msg'] = "user does not exist";
        header("Location: login.php");
        exit();
    }
}
//print_r($_COOKIE);
if(isset($_COOKIE['email']) && $_COOKIE['email']!='' ){
   
   $email = $_COOKIE['email'];
   $password = $_COOKIE['password'];
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>my first web page</title>
        <script src="js/jquery.js">
        </script>
        <script src="js/bootstrap.js"></script>
        <script src="js/common.js"></script>
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
                                        <span class="glyphicon glyphicon-log-in">

                                        </span>
                                        &nbsp;
                                        &nbsp;
                                        LOGIN</h3>
                                </div>
                                <div class="panel-body">

                                    <form class="form-horizontal" role="form" method="post" action="login.php">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-20 control-label">Email</label>
                                            <div class="col-sm-80">
                                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $email; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-20 control-label">Password</label>
                                            <div class="col-sm-80">
                                                <input type="password" class="form-control" placeholder="Password" id="password" name="password" value="<?php echo $password; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-20 col-sm-80">
                                                <div class="row">
                                                    <div class="col-md-50">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" id="rememberme" name="rememberme" value="rememberme"> Remember me
                                                    </label>
                                                </div>
                                                    </div>
                                                    <div class="col-md-50">
                                                        <div class="checkbox">
                                                        <a href="<?php echo $base_path;?>forgetpassword.php">Forget password?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-20 col-sm-80">
                                                <input type="hidden" name="formact" id='formact' value='login-user'/>
                                                <button type="submit" value="submit" class="btn btn-primary" id="submit" name="submit">
                                                    <span class="glyphicon glyphicon-log-in"> </span>
                                                    &nbsp;
                                                    Sign in</button>
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