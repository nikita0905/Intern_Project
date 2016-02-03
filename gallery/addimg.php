<?php
include '../config.php';
include '../includes/functions.php';
require_once '../includes/resize.class.php';
checkLogin();
$name='';
$file='';
$formact ='addimg';
$id=0;

if(isset($_GET['todo']) && $_GET['todo']=='edit'){
    
    $id = (isset($_GET['id']) && $_GET['id'] != '' ) ? $_GET['id'] : '';
    $rs = mysql_query("select * from `gallery` where `id`=".$id);
    $row = mysql_fetch_array($rs);
    $name = $row['img_name'];
    $file = $row['img_file'];
    $formact= 'editimg';
}

if (isset($_POST['formact']) && $_POST['formact'] == 'addimg') {
   // echo '<pre>';
//print_r($_FILES['img_file']);
//die();
    $name = (isset($_POST['img_name']) && $_POST['img_name'] != '' ) ? $_POST['img_name'] : '';
    
    
        $imgarray=array();
        $imgarray=explode(".",$_FILES['img_file']['name']);
        $imgname=time().'%s.'.end($imgarray);
        if(isset($_FILES['img_file']['name']) && $_FILES['img_file']['name'] != ''){
            
            move_uploaded_file($_FILES['img_file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/p1/uploads/'.sprintf($imgname,''));
            $imgsize=new SimpleImage();
            $imgsize->load($_SERVER['DOCUMENT_ROOT'].'/p1/uploads/'.sprintf($imgname,''));
            $imgsize->resizeToWidth(50);
            $imgsize->save($_SERVER['DOCUMENT_ROOT'].'/p1/uploads/'.sprintf($imgname,'_50'));
            
    $rs = mysql_query("INSERT INTO `gallery`(`img_name`, `img_file`)"
            . " VALUES ('" . $name . "','" . $imgname . "')" );
    $_SESSION['msg']= "Image inserted successfully";
    header("Location:" . $base_path . "gallery/index.php");
    exit();
        }
    }


if (isset($_POST['formact']) && $_POST['formact'] == 'editimg') {
    $name = (isset($_POST['img_name']) && $_POST['img_name'] != '' ) ? $_POST['img_name'] : '';
    $file = (isset($_FILES['img_file']) && $_FILES['img_file'] != '' ) ? $_FILES['img_file'] : '';
    $id = (isset($_POST['id']) && $_POST['id'] ) ? $_POST['id'] : '';
    $rs = mysql_query("UPDATE  `gallery` set `img_name`='".$name."',`img_file`='".$file."' where `id`=".$id);
    $_SESSION['msg']= "Image updated successfully";
    header("Location:" . $base_path . "gallery/index.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>gallery</title>
        <script src="../js/jquery.js">
        </script>
        <script type="text/javascript">
//            $j=jQuery.noConflict();
//            $j(function(){
//               alert($j("#wrap"));
//            })
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
                                    <li><a href="#">Gallery Manager</a></li>
   <li><a href="index.php">View Image list</a></li>
   <li><a href="addimg.php">Add Image</a></li>
   
</ol>
                </div>
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
                                        <span class="glyphicon glyphicon-camera">

                                        </span>
                                        &nbsp;
                                        &nbsp;
                                        ADD IMAGE</h3>
                                </div>
                                <div class="panel-body">

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="<?php echo $base_path; ?>gallery/addimg.php">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-20 control-label">Image Name</label>
                                            <div class="col-sm-80">
                                                <input type="text" class="form-control" id="img_name" placeholder="Image Name" name="img_name" value="<?php echo $name; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-20 control-label">Image</label>
                                            <div class="col-sm-80">
                                                <input type="file"   id="img_file" name="img_file" value='<?php echo $file; ?>' >
                                            </div>
                                        </div>
                    
                                        <div class="form-group">
                                            <div class="col-sm-offset-20 col-sm-80">
                                                 <input type="hidden" name="id" id='id' value='<?php echo $id; ?>'>
                                            </input>
                                            <input type="hidden" name="formact" id='formact' value='<?php echo $formact; ?>'>
                                            </input>
                                                <button type="submit" value="submit" class="btn btn-primary" id="submit" name="submit">
                                                    
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
            </div>
        </div>

<?php
include '../footer.php';
?>
    </body>
</html>