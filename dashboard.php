<?php
include 'config.php';
include 'includes/functions.php';
checkLogin();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Welcome </title>
        <script src="js/jquery.js">
        </script>
        <script type="text/javascript">
//            $j=jQuery.noConflict();
//            $j(function(){
//               alert($j("#wrap"));
//            })
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
                    <div class="row">
                        <div class="col-md-100 col-sm-100">
                            <div class="row">
                                <ol class="breadcrumb">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li><a href="users/index.php">Users</a></li>
                                    <li><a href="pages/index.php">Pages</a></li>
                                    <li><a href="news/index.php">News</a></li>
                                    <li><a href="gallery/index.php">Gallery</a></li>
                                    <li><a href="pro_category/index.php">Product Categories</a></li>
                                    <li><a href="img_category/index.php">Image Categories</a></li>
                                    <li><a href="product/index.php">Products</a></li>
                                    
  
</ol>

                                
                            </div>
                        </div>
                        <div class="clearfix" style="margin-bottom: 10px;"></div>
                        <div class="col-md-25 col-sm-50 noleftpadding">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3><span class="glyphicon glyphicon-user"></span> &nbsp;User Manager</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <li class="list-group-item"><span class="badge"><?php echo getCount('user', 'all'); ?></span>All Users</li>
                                        <li class="list-group-item">Active Users <span class="badge"><?php echo getCount('user', 'active'); ?></span></li>
                                        <li class="list-group-item">Inactive Users <span class="badge"><?php echo getCount('user', 'deactive'); ?></span></li>

                                    </ul>


                                </div>
                            </div>

                        </div>
                        <div class="col-md-25 col-sm-50">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3><span class="glyphicon glyphicon-book"></span>&nbsp;News Manager</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <li class="list-group-item"><span class="badge"><?php echo getCount('news', 'all'); ?></span>All News</li>
                                        <li class="list-group-item">Active News<span class="badge"><?php echo getCount('news', 'active'); ?></span></li>
                                        <li class="list-group-item">Inactive News<span class="badge"><?php echo getCount('news', 'deactive'); ?></span></li>

                                    </ul>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-25 col-sm-50">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3><span class="glyphicon glyphicon-file"></span>&nbsp;Page Manager</h3>
                                </div>
                                <div class="panel-body">

                                    <ul class="list-group">
                                        <li class="list-group-item"><span class="badge"><?php echo getCount('pages', 'all'); ?></span>All Pages</li>
                                        <li class="list-group-item">Active Pages <span class="badge"><?php echo getCount('pages', 'active'); ?></span></li>
                                        <li class="list-group-item">Inactive Pages <span class="badge"><?php echo getCount('pages', 'deactive'); ?></span></li>

                                    </ul> 
                                </div>
                            </div>

                        </div>  
                        <div class="col-md-25 col-sm-50 norightpadding">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3><span class="glyphicon glyphicon-camera"></span>&nbsp;Gallery Manager</h3>
                                </div>
                                <div class="panel-body height1">
                                    <ul class="list-group">
                                        <li class="list-group-item"><span class="badge"><?php echo getCount('gallery', 'all'); ?></span>All Images</li>
                                    </ul>

                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>                        
                        <div class="col-md-25 col-sm-50 noleftpadding">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Category Manager</h3>
                                </div>
                                <div class="panel-body height1">
                                    <ul class="list-group">
                                        <li class="list-group-item"><span class="badge"><?php echo getCount('category', 'all'); ?></span>All Categories</li>
                                    </ul>

                                </div>
                            </div>

                        </div>
                             <div class="col-md-25 col-sm-50">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3><span class="glyphicon glyphicon-credit-card"></span>&nbsp;Product Manager</h3>
                                </div>
                                <div class="panel-body height1">
                                    <ul class="list-group">
                                        <li class="list-group-item"><span class="badge"><?php echo getCount('product', 'all'); ?></span>All Products</li>
                                    </ul>

                                </div>
                            </div>

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