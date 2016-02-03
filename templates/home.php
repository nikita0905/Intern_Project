
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
            <!--<div class='container' style="margin-bottom: 50px;">
         <?php
echo $objpage->content;
?>
            </div>-->
            
            <div class="container" >
                <h4>Products</h4>
                <?php
                                            
                                            $rs = mysql_query("select * from `product_img`");
                                            $num = mysql_num_rows($rs);
                                            
                                            while ($row = mysql_fetch_array($rs)) {
                                            
                                                $rspic = mysql_query("select * from `product` where `id`=".$row['product_id']."");
                                                
                                                    ?>

                <div class="col-md-25 description" >
                    <div class="img-responsive">
                        <img src="/p1/uploads/<?php echo sprintf($row['img_file'],"_50");?>" >
                    </div>
                    <div class="alert-info">
                        
                    </div>
                </div>
                 
                    <?php 
                                            }
                    ?>
                    
                
               
            </div>
        </div>
        <?php
        require_once 'footer.inc.php';
        ?>
    </body>
</html>
   
