<?php
include '../config.php';
include '../includes/functions.php';
checkLogin();
$name='';
$desc='';
$formact='addcat';
$id=0;

if(isset($_GET['todo']) && $_GET['todo']=='edit'){
    
    $id = (isset($_GET['id']) && $_GET['id'] != '' ) ? $_GET['id'] : '';
    $rs = mysql_query("select * from `category` where `id`=".$id);
    $row = mysql_fetch_array($rs);
    $name = $row['name'];
    $desc = $row['description'];
    $formact= 'editcat';
}


if (isset($_POST['formact']) && $_POST['formact'] == 'addcat') {
    $name = (isset($_POST['name']) && $_POST['name'] != '' ) ? $_POST['name'] : '';
    $desc = (isset($_POST['desc']) && $_POST['desc'] != '' ) ? $_POST['desc'] : '';
    if($name ==''){
        $_SESSION['msg'] ='name blank';
        
    }
    if($_SESSION['msg']==''){
    $rs = mysql_query("INSERT INTO `category`(`name`,`description`, `add_date`, `ord`,`type`,`status`)"
            . " VALUES ('" . $name . "','" .$desc. "'," . time() . ",'99999.00','image',1)");
    $_SESSION['msg']= "Category inserted successfully";
    header("Location:" . $base_path . "img_category/index.php");
    exit();
    }
}   

if (isset($_POST['formact']) && $_POST['formact'] == 'editcat') {
    $name = (isset($_POST['name']) && $_POST['name'] != '' ) ? $_POST['name'] : '';
    $desc = (isset($_POST['desc']) && $_POST['desc'] != '' ) ? $_POST['desc'] : '';
    $id = (isset($_POST['id']) && $_POST['id'] ) ? $_POST['id'] : '';
    $rs = mysql_query("UPDATE  `category` set `name`='".$name."',`description`='".$desc."' where `id`=".$id);
    $_SESSION['msg']= "Category updated successfully";
    header("Location:" . $base_path . "img_category/index.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>CATEGORY LIST</title>
        <script src="../js/jquery.js">
        </script>
        <script type="text/javascript">
        </script>
        <script src="<?php echo $base_path; ?>/ckeditor/ckeditor.js"></script>
        <script src="<?php echo $base_path; ?>js/bootstrap.js"></script>
        <link href="<?php echo $base_path; ?>css/bootstrap.css" rel="stylesheet"/>
        <link href="<?php echo $base_path; ?>css/bootstrap-theme.css" rel="stylesheet"/>
        <link href="<?php echo $base_path; ?>css/style.css" rel="stylesheet">
        <script src="<?php echo $base_path; ?>js/common.js"></script>

    </head>
    <body>
        <div id="wrap" class="container-fluid">
            <?php
            include '../header.php';
            ?>
            <div class="clearfix">

            </div>
            <div id="maincontent" class="container-fluid">
                <div class="container">
                                     <div class="row">
                        <div class="col-md-20" style="margin-left: 0px; padding-left: 0px; ">
                            
                            
                               <div id='cssmenu'>
<ul style="list-style: none; margin-left: 0px; padding-left: 0px; ">
   <li class="<?php if(strpos($_SERVER['SCRIPT_NAME'],'users'))
{ echo 'active'; } ?>"><a href='#'><span>USER MANAGER</span></a>
       
   <ul style="list-style: none; ">
         <li><a href='<?php echo $base_path;?>users/index.php'><span>VIEW ALL</span></a></li>
         <li><a href='<?php echo $base_path;?>users/addusers.php'><span>ADD USER</span></a></li>
      </ul>
   </li>
   <li class="<?php if(strpos($_SERVER['SCRIPT_NAME'],'pages'))
{ echo 'active'; } ?>"><a href='#'><span>PAGE MANAGER</span></a>
      <ul style="list-style: none; ">
         <li><a href='<?php echo $base_path;?>pages/index.php'><span>VIEW ALL</span></a></li>
         <li><a href='<?php echo $base_path;?>pages/addpages.php'><span>ADD PAGE</span></a></li>
      </ul>
   </li>
   <li class="<?php if(strpos($_SERVER['SCRIPT_NAME'],'news'))
{ echo 'active'; } ?>"><a href='#'><span>NEWS MANAGER</span></a>
      <ul style="list-style: none; ">
         <li><a href='<?php echo $base_path;?>news/index.php'><span>VIEW ALL</span></a></li>
         <li><a href='<?php echo $base_path;?>news/addnews.php'><span>ADD NEWS</span></a></li>
      </ul>
   </li>
   <li class="<?php if(strpos($_SERVER['SCRIPT_NAME'],'gallery'))
{ echo 'active'; } ?>"><a href='#'><span>GALLERY MANAGER</span></a>
      <ul style="list-style: none; ">
         <li><a href='<?php echo $base_path;?>gallery/index.php'><span>VIEW ALL</span></a></li>
         <li><a href='<?php echo $base_path;?>gallery/addimg.php'><span>ADD IMAGE</span></a></li>
      </ul>
   </li>
   <li class="<?php if(strpos($_SERVER['SCRIPT_NAME'],'pro_category'))
{ echo 'active'; } ?>"><a href='#'><span>PRODUCT CATEGORY MANAGER</span></a>
      <ul style="list-style: none; ">
         <li><a href='<?php echo $base_path;?>pro_category/index.php'><span>VIEW ALL</span></a></li>
         <li><a href='<?php echo $base_path;?>pro_category/addcat.php'><span>ADD PRODUCT CATEGORY</span></a></li>
      </ul>
   </li>
   <li class="<?php if(strpos($_SERVER['SCRIPT_NAME'],'product'))
{ echo 'active'; } ?>"><a href='#'><span>PRODUCT MANAGER</span></a>
      <ul style="list-style: none; ">
         <li><a href='<?php echo $base_path;?>product/index.php'><span>VIEW ALL</span></a></li>
         <li><a href='<?php echo $base_path;?>product/addproduct.php'><span>ADD PRODUCT</span></a></li>
      </ul>
   </li>
   <li class="<?php if(strpos($_SERVER['SCRIPT_NAME'],'img_category'))
{ echo 'active'; } ?>"><a href='#'><span>IMAGE CATEGORY MANAGER</span></a>
      <ul style="list-style: none; ">
         <li><a href='<?php echo $base_path;?>img_category/index.php'><span>VIEW ALL</span></a></li>
         <li><a href='<?php echo $base_path;?>img_category/addcat.php'><span>ADD IMAGE CATEGORY</span></a></li>
      </ul>
   </li>
</ul>
</div>
                                
                                
                        </div>
                        <div class="col-md-80">
                <div class="row">
                    <ol class="breadcrumb">
                                    <li><a href="#">Image Category Manager</a></li>
   <li><a href="index.php">View Image Categories list</a></li>
   <li><a href="addcat.php">Add Image Category</a></li>
   
</ol>
                </div>
                    <div class="row">
                         <?php
                            if(isset($_SESSION['msg']) && $_SESSION['msg']!=''){
                            ?>
                       <div class="row" id="error">
                                <div class="col-md-100">
                                    <div class="alert alert-success"><div class="row"><div class="col-md-90"> <?php echo $_SESSION['msg']; ?></div><div class="col-md-10">
                                                <span class="glyphicon glyphicon-remove" class="clkerror" style="cursor:pointer; font-size: 20px;" onclick="jQuery('#error').hide('fade')" ></span></div></div>

                             </div>       
                                </div>
                            </div>
                            <?php } ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">

                                <h2 class="panel-title">
                                    <span class="glyphicon glyphicon-shopping-cart">

                                    </span>
                                    &nbsp;
                                    &nbsp;
                                    ADD CATEGORY</h2>
                            </div>
                            <div class="panel-body">


                                <form class="form-horizontal" role="form" action="<?php echo $base_path; ?>img_category/addcat.php" method="post">

                                    <div class="form-group">
                                        <label for="title" class="col-sm-20 control-label">Name</label>
                                        <div class="col-sm-80">
                                            <input type="textbox" class="form-control" id="name" placeholder="name" name="name" value="<?php echo $name; ?>" required>
                                            
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="desc" class="col-sm-20 control-label">Description</label>
                                        <div class="col-sm-80">
                                            <textarea class="form-control" id="desc" placeholder="description" name="desc"><?php echo $desc; ?>
                                            </textarea>
                                            <script>
                                                CKEDITOR.replace('desc',{width:'600',height:'200'});
                                            </script>
                                                
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-20 col-sm-80">
                                            <input type="hidden" name="id" id='id' value='<?php echo $id; ?>'>
                                            </input>
                                            <input type="hidden" name="formact" id='formact' value='<?php echo $formact;?>'>
                                            </input>
                                            <button type="submit" class="btn btn-default">Add</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </form>

                    </div>
                        </div>
                                     </div>

                </div>

            </div>
        </div>
        <?php
        include '../footer.php';
        ?>

    </body>
</html>