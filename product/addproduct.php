<?php
include '../config.php';
include '../includes/functions.php';
checkLogin();

$name='';
$price='';
$quantity='';
$desc='';
$formact='addpro';
$cat_id=0;
$id=0;

if(isset($_GET['todo']) && $_GET['todo']=='edit'){
    
    $id = (isset($_GET['id']) && $_GET['id'] != '' ) ? $_GET['id'] : '';
    $rs = mysql_query("select * from `product` where `id`=".$id);
    $row = mysql_fetch_array($rs);
    $name = $row['name'];
    $price = $row['price'];
    $quantity = $row['quantity'];
    $desc = $row['description'];
    $cat_id=$row['cat_id'];
    $formact= 'editpro';
}

if (isset($_POST['formact']) && $_POST['formact'] == 'addpro') {
    
    $name = (isset($_POST['name']) && $_POST['name'] != '' ) ? $_POST['name'] : '';
    $price = (isset($_POST['price']) && $_POST['price'] != '' ) ? $_POST['price'] : '';
    $quantity= (isset($_POST['quantity']) && $_POST['quantity'] != '' ) ? $_POST['quantity'] : '';
    $desc = (isset($_POST['desc']) && $_POST['desc'] != '' ) ? $_POST['desc'] : '';
    $cat_id = (isset($_POST['cat_id']) && $_POST['cat_id'] != '' ) ? $_POST['cat_id'] : '';
    if($name==''){
        $_SESSION['msg'] ='Name blank';
    }
    if(!isset($_SESSION['msg']) || $_SESSION['msg']==''){
   
    $rs = mysql_query("INSERT INTO `product`(`name`,`price`, `quantity`,`description`,`cat_id`)"
            . " VALUES ('" . $name ."',".$price. "," . $quantity . ",'" .$desc. "',".$cat_id.")");
    $_SESSION['msg']= "Product inserted successfully";
    header("Location:" . $base_path . "product/index.php");
    exit();
    }   
}

if (isset($_POST['formact']) && $_POST['formact'] == 'editpro') {
    
    $name = (isset($_POST['name']) && $_POST['name'] != '' ) ? $_POST['name'] : '';
    $price = (isset($_POST['price']) && $_POST['price'] != '' ) ? $_POST['price'] : '';
    $quantity= (isset($_POST['quantity']) && $_POST['quantity'] != '' ) ? $_POST['quantity'] : '';
    $desc = (isset($_POST['desc']) && $_POST['desc'] != '' ) ? $_POST['desc'] : '';
    $cat_id = (isset($_POST['cat_id']) && $_POST['cat_id'] != '' ) ? $_POST['cat_id'] : '';
    $id = (isset($_POST['id']) && $_POST['id'] ) ? $_POST['id'] : '';
    
    $rs = mysql_query("UPDATE  `product` set `name`='".$name."',`price`=".$price.",`quantity`=".$quantity.",`description`='".$desc."',`cat_id`=".$cat_id." where `id`=".$id);
    $_SESSION['msg']= "Product updated successfully";
    header("Location:" . $base_path . "product/index.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>PRODUCT LIST</title>
        <script src="../js/jquery.js">
        </script>
        <script type="text/javascript">
        </script>
        
        <script src="<?php echo $base_path; ?>/ckeditor/ckeditor.js"></script>
        <script src="<?php echo $base_path; ?>js/common.js"></script>
        <script src="<?php echo $base_path; ?>js/bootstrap.js"></script>
        <link href="<?php echo $base_path; ?>css/bootstrap.css" rel="stylesheet"/>
        <link href="<?php echo $base_path; ?>css/bootstrap-theme.css" rel="stylesheet"/>
        <link href="<?php echo $base_path; ?>css/style.css" rel="stylesheet">

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
                                    <li><a href="#">Product Manager</a></li>
   <li><a href="index.php">View Product list</a></li>
   <li><a href="addproduct.php">Add Product</a></li>
   <li><a href="prod_img.php">Add Product Image</a></li>
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
                                    <span class="glyphicon glyphicon-credit-card">

                                    </span>
                                    &nbsp;
                                    &nbsp;
                                    ADD PRODUCT</h2>
                            </div>
                            <div class="panel-body">


                                <form class="form-horizontal" role="form" action="<?php echo $base_path; ?>product/addproduct.php" method="post">
                                    
                                     <div class="form-group">
                                        <label for=" page title" class="col-sm-20 control-label">Name</label>
                                        <div class="col-sm-80">
                                            <input type="textbox" class="form-control" id="name" placeholder="name" name="name" value="<?php echo $name; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="title" class="col-sm-20 control-label">Category</label>
                                        <div class="col-sm-80">
                                            <?php 
                                            $rscat=  mysql_query("select * from `category`");
                                            if(mysql_num_rows($rscat))
                                            {
                                                ?>
                                            <select name='cat_id' id="cat_id" class="form-control">
                                                <option value='0'> Select Category</option>
                                            <?php
                                           while($rowcat =  mysql_fetch_array($rscat))
                                           {
                                             ?>
                                                <option value="<?php echo $rowcat['id']; ?>" <?php if($cat_id == $rowcat['id']) { echo 'selected="selected"'; } ?>><?php echo $rowcat['name'] ;?></option>
                                                        <?php
                                           }
                                            
                                            ?>
                                            </select>
                                            <?php } ?>
                                        </div>
                                    </div>                                  
                                   <div class="form-group">
                                        <label for="title" class="col-sm-20 control-label">Price</label>
                                        <div class="col-sm-80">
                                            <input type="textbox" class="form-control" id="price" placeholder="price" name="price" value="<?php echo $price;?>" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="template" class="col-sm-20 control-label">Quantity</label>
                                        <div class="col-sm-80">
                                            <input type="textbox" class="form-control" id="quantity" placeholder="quantity" name="quantity" value="<?php echo $quantity;?>" >
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="desc" class="col-sm-20 control-label">Description</label>
                                        <div class="col-sm-80">
                                            <textarea class="form-control" id="desc" placeholder="description" name="desc"><?php echo $desc;?>
                                            </textarea>
                                            <script>
                                                CKEDITOR.replace('desc',{width:'600',height:'200',toolbar:'basic'});
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-20 col-sm-80">
                                            <input type="hidden" name="id" id='id' value="<?php echo $id; ?>">
                                            </input>
                                            <input type="hidden" name="formact" id='formact' value='<?php echo $formact; ?>'>
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