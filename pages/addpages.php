<?php
include '../config.php';
include '../includes/functions.php';
checkLogin();

$title='';
$page_title='';
$is_top_menu='1';
$parent_id=0;
$top_menu_name='';
$footer_menu_name='';
$is_footer_menu='1';
$template_name='';
$meta_title='';
$meta_keyword='';
$meta_desc='';
$desc='';
$formact='addpage';
$id=0;

if(isset($_GET['todo']) && $_GET['todo']=='edit'){
    
    $id = (isset($_GET['id']) && $_GET['id'] != '' ) ? $_GET['id'] : '';
    $rs = mysql_query("select * from `pages` where `id`=".$id);
    $row = mysql_fetch_array($rs);
    $title = $row['title'];
    $page_title = $row['page_title'];
    $parent_id = $row['parent_id'];
    $meta_title = $row['meta_title'];
    $meta_keyword = $row['meta_keyword'];
    $meta_desc =$row['meta_description'];
    $desc =$row['description'];
    $is_top_menu=$row['is_top_menu'];
    $top_menu_name=$row['top_menu_name'];
    $footer_menu_name=$row['footer_menu_name'];
    $is_footer_menu=$row['is_footer_menu'];
    $template_name=$row['template_name'];
    $formact= 'editpage';
}

if (isset($_POST['formact']) && $_POST['formact'] == 'addpage') {
    
    $title = (isset($_POST['title']) && $_POST['title'] != '' ) ? $_POST['title'] : '';
    $page_title = (isset($_POST['page_title']) && $_POST['page_title'] != '' ) ? $_POST['page_title'] : '';
    $meta_title = (isset($_POST['meta_title']) && $_POST['meta_title'] != '' ) ? $_POST['meta_title'] : '';
    $meta_keyword = (isset($_POST['meta_keyword']) && $_POST['meta_keyword'] != '' ) ? $_POST['meta_keyword'] : '';
    $meta_desc = (isset($_POST['meta_desc']) && $_POST['meta_desc'] != '' ) ? $_POST['meta_desc'] : '';
    $desc = (isset($_POST['desc']) && $_POST['desc'] != '' ) ? $_POST['desc'] : '';
    $template_name = (isset($_POST['template_name']) && $_POST['template_name'] != '' ) ? $_POST['template_name'] : '';
    $parent_id = (isset($_POST['parent_id']) && $_POST['parent_id'] != '' ) ? $_POST['parent_id'] : '';
    $is_top_menu = (isset($_POST['top']) && $_POST['top'] != '' ) ? $_POST['top'] : '';
    if($is_top_menu && isset($_POST['top_menu_name']))
    {
     $top_menu_name = $_POST['top_menu_name'] ;
    }
     else
     {
         $top_menu_name='';
         
     }
    $is_footer_menu = (isset($_POST['footer']) && $_POST['footer'] != '' ) ? $_POST['footer'] : '';
    
   if($is_footer_menu && isset($_POST['footer_menu_name']))
    {
     $footer_menu_name = $_POST['footer_menu_name'] ;
    }
     else
     {
         $footer_menu_name='';
         
     }
    
    if($title==''){
        $_SESSION['msg'] ='Title blank';
    }
    if(!isset($_SESSION['msg']) || $_SESSION['msg']==''){
   
    $rs = mysql_query("INSERT INTO `pages`(`title`,`page_title`, `meta_title`, `meta_keyword`,`meta_description`,`description`, `add_date`,`template_name`,`top_menu_name`,`footer_menu_name`, `is_top_menu`,`is_footer_menu`,`parent_id`,`ord`,`status`)"
            . " VALUES ('" . $title ."','".$page_title. "','" . $meta_title . "','" . $meta_keyword. "','" .$meta_desc . "','" .$desc. "'," . time() .",'".$template_name."','".$top_menu_name."','".$footer_menu_name."','".$is_top_menu."','".$is_footer_menu."',".$parent_id. ",'99999.00',1)");
    $_SESSION['msg']= "Page inserted successfully";
    header("Location:" . $base_path . "pages/index.php");
    exit();
    }   
}

if (isset($_POST['formact']) && $_POST['formact'] == 'editpage') {
    
    $title = (isset($_POST['title']) && $_POST['title'] != '' ) ? $_POST['title'] : '';
    $page_title = (isset($_POST['page_title']) && $_POST['page_title'] != '' ) ? $_POST['page_title'] : '';
    $meta_title = (isset($_POST['meta_title']) && $_POST['meta_title'] != '' ) ? $_POST['meta_title'] : '';
    $meta_keyword = (isset($_POST['meta_keyword']) && $_POST['meta_keyword'] != '' ) ? $_POST['meta_keyword'] : '';
    $meta_desc = (isset($_POST['meta_desc']) && $_POST['meta_desc'] != '' ) ? $_POST['meta_desc'] : '';
    $desc = (isset($_POST['desc']) && $_POST['desc'] != '' ) ? $_POST['desc'] : '';
    $template_name = (isset($_POST['template_name']) && $_POST['template_name'] != '' ) ? $_POST['template_name'] : '';
    $is_top_menu = (isset($_POST['top']) && $_POST['top'] != '' ) ? $_POST['top'] : '';
    $parent_id = (isset($_POST['parent_id']) && $_POST['parent_id'] != '' ) ? $_POST['parent_id'] : '';
    if($is_top_menu && isset($_POST['top_menu_name']))
    {
     $top_menu_name = $_POST['top_menu_name'] ;
    }
     else
     {
         $top_menu_name='';
         
     }
    $is_footer_menu = (isset($_POST['footer']) && $_POST['footer'] != '' ) ? $_POST['footer'] : '';
    
   if($is_footer_menu && isset($_POST['footer_menu_name']))
    {
     $footer_menu_name = $_POST['footer_menu_name'] ;
    }
     else
     {
         $footer_menu_name='';
         
     }
    $id = (isset($_POST['id']) && $_POST['id'] ) ? $_POST['id'] : '';
    
    $rs = mysql_query("UPDATE  `pages` set `title`='".$title."',`page_title`='".$page_title."',`meta_title`='".$meta_title."',`meta_keyword`='".$meta_keyword."', `meta_description`='".$meta_desc."',`description`='".$desc."', `template_name`='".$template_name."',`is_top_menu`='".$is_top_menu."', `top_menu_name`='".$top_menu_name."',`is_footer_menu`='".$is_footer_menu."', `parent_id`=".$parent_id.", `footer_menu_name`='".$footer_menu_name."' where `id`=".$id);
    $_SESSION['msg']= "Page updated successfully";
    header("Location:" . $base_path . "pages/index.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>PAGE LIST</title>
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
                                    <li><a href="#">Page Manager</a></li>
   <li><a href="index.php">View Page list</a></li>
   <li><a href="addpages.php">Add Page</a></li>
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
                                    <span class="glyphicon glyphicon-file">

                                    </span>
                                    &nbsp;
                                    &nbsp;
                                    ADD PAGE</h2>
                            </div>
                            <div class="panel-body">


                                <form class="form-horizontal" role="form" action="<?php echo $base_path; ?>pages/addpages.php" method="post">
                                    
                                    <div class="form-group">
                                        <label for="title" class="col-sm-20 control-label">Parent page</label>
                                        <div class="col-sm-80">
                                            <?php 
                                            $rsparent=  mysql_query("select * from `pages` where `status`='1' and `parent_id`='0' and `is_top_menu`='1'");
                                            if(mysql_num_rows($rsparent))
                                            {
                                                ?>
                                            <select name='parent_id' id="parent_id" class="form-control">
                                                <option value='0'> Select Parent Page</option>
                                            <?php
                                           while($rowparent=  mysql_fetch_array($rsparent))
                                           {
                                             ?>
                                                <option value="<?php echo $rowparent['id']; ?>" <?php if($parent_id == $rowparent['id']) { echo 'selected="selected"'; } ?>><?php echo $rowparent['title'] ;?></option>
                                                        <?php
                                           }
                                            
                                            ?>
                                            </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for=" page title" class="col-sm-20 control-label">Page Title</label>
                                        <div class="col-sm-80">
                                            <input type="textbox" class="form-control" id="page_title" placeholder="page title" name="page_title" value="<?php echo $page_title; ?>">
                                        </div>
                                    </div>
                                    
                                    
                                    

                                    <div class="form-group">
                                        <label for="title" class="col-sm-20 control-label">Title/Name</label>
                                        <div class="col-sm-80">
                                            <input type="textbox" class="form-control" id="title" placeholder="title" name="title" value="<?php echo $title;?>" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="template" class="col-sm-20 control-label">Template name</label>
                                        <div class="col-sm-80">
                                            <input type="textbox" class="form-control" id="temp" placeholder="template name" name="template_name" value="<?php echo $template_name;?>" >
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="title" class="col-sm-20 control-label">Is Top Menu</label>
                                        <div class="col-sm-80">
                                            
                                            <input type="radio" class="radio-inline istopmenu" id="tyes" name="top" <?php if($is_top_menu == 1){ ?> checked="checked"<?php } ?> value="1">YES &nbsp; &nbsp;
                                            <input type="radio" class="radio-inline istopmenu" id="tno" name="top" value="0" <?php if($is_top_menu == 0){ ?> checked='checked' <?php } ?> >NO
                                        </div>
                                    </div>
                                    
                                    <?php if($is_top_menu == 1){ ?>
                                 
                                   <div class="form-group" id="top_menu">
                                        <label for="top menu" class="col-sm-20 control-label">Top Menu Name</label>
                                        <div class="col-sm-80">
                                            <input type="textbox" class="form-control" id="top_menu_name" placeholder="top menu name" name="top_menu_name" value="<?php echo $top_menu_name;?>" >
                                        </div>
                                    </div> <?php } ?>
                                            
                                            <div class="form-group">
                                        <label for="title" class="col-sm-20 control-label">Is Footer Menu</label>
                                        <div class="col-sm-80">
                                            <input type="radio" class="radio-inline isfootermenu" id="fyes" name="footer" <?php if($is_footer_menu == 1){ ?> checked="checked" <?php } ?> value="1">YES &nbsp; &nbsp;
                                            <input type="radio" class="radio-inline isfootermenu" id="fno" name="footer" value="0" <?php if($is_footer_menu == 0){ ?> checked="checked" <?php } ?>>NO
                                        </div>
                                    </div>
                                    <?php if($is_footer_menu == 1){ ?>
                                    <div class="form-group" id='footer_menu'>
                                        <label for="footer menu" class="col-sm-20 control-label">Footer Menu Name</label>
                                        <div class="col-sm-80">
                                            <input type="textbox" class="form-control" id="footer_menu_name" placeholder="footer menu name" name="footer_menu_name" value="<?php echo $footer_menu_name;?>" >
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                    <div class="form-group">
                                        <label for="meta_title" class="col-sm-20 control-label">Meta Title</label>
                                        <div class="col-sm-80">
                                            <input type="textbox" class="form-control" id="meta_title" placeholder="meta title" name="meta_title" value="<?php echo $meta_title;?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keyword" class="col-sm-20 control-label">Meta Keyword</label>
                                        <div class="col-sm-80">
                                            <input type="text" class="form-control" id="meta_keyword" placeholder="meta keyword" name="meta_keyword" value="<?php echo $meta_keyword;?>" >
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="meta_description" class="col-sm-20 control-label">Meta Description</label>
                                        <div class="col-sm-80">
                                            <textarea class="form-control" id="meta_desc" placeholder="meta decription" name="meta_desc"><?php echo $meta_desc;?></textarea>
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