
<!doctype html>
<html>
    <head>
         <?php
echo $objpage->meta;
?>
        <script src="js/jquery.js">
        </script>
        <script type="text/javascript">
        </script>
        <script src="js/bootstrap.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-theme.css" rel="stylesheet"/>
        <link href="css/style.css" rel="stylesheet">

    </head>
    <body>
        <div id="wrap" class="container-fluid">
            <?php
            require_once 'header.inc.php';
            
            ?>
            <div class="clearfix">

            </div>
            <div class='container'>
         <?php
echo $objpage->content;
?>
            </div>
        </div>
        <?php
        require_once 'footer.inc.php';
        ?>
    </body>
</html>
   
