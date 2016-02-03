<?php

include '../config.php';
include '../includes/functions.php';
checkLogin();

$cond='1';
if(isset($_GET['formact']) && $_GET['formact']=='search'){
    $cond.=" and `img_name` Like '%".$_GET['keyword']."%' ";
}
if (isset($_GET['todo']) && $_GET['todo'] == 'delete') {
    $id = $_GET['id'];
    mysql_query("delete from `user` where `ID`=" . $id);
    $_SESSION['msg'] = 'User deleted successfully';
    header("Location: index.php");
    exit();
}


if (isset($_POST['formact']) && $_POST['formact'] == 'del') {


    $checkrec = array();
    $checkrec = (isset($_POST['checkrec'])) ? $_POST['checkrec'] : '';
    foreach ($checkrec as $key => $val) {
        mysql_query("delete from `user` where `ID`=" . $val);
    }
    $_SESSION['msg'] = "Users deleted successfully";
    header("Location:index.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>GALLERY LIST</title>
        <script src="../js/jquery.js"></script>

        <script src="../js/bootstrap.js"></script>
        <script src="../js/common.js"></script>
        <link href="../css/bootstrap.css" rel="stylesheet"/>
        <link href="../css/bootstrap-theme.css" rel="stylesheet"/>
        <link href="../css/style.css" rel="stylesheet">

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
                    <div class="row">
                                <div class="col-md-65"></div>          
                                <div class="col-md-35">
                                    <div class="row">
                                    <div  style="float:right; margin-right: -15px;">
                                    <form class="navbar-form navbar-left" role="search">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Search" name="keyword" id="keyword">
                                        </div>
                                        <input type="hidden" name="formact" id="formact" value="search">
                                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-save"></span>Submit</button>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                                
                            </div>
                    <div class="clearfix"></div>
                    
                    
                    <?php
                    if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
                        ?>
                        <div class="row" id="error">
                            <div class="col-md-100">
                                <div class="alert alert-success"><div class="row"><div class="col-md-90"><?php echo $_SESSION['msg']; ?></div><div class="col-md-10">
                                            <span class="glyphicon glyphicon-remove" class="clkerror" style="cursor:pointer; font-size: 20px;" onclick="jQuery('#error').hide('fade')" ></span></div></div>

                                </div>       
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="table-responsive">
                            <div class="panel panel-primary">

                                <div class="panel-heading">
                                    <div class='row'>  <div class="col-md-90 col-sm-90 col-xs-90"><span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;Gallery</div>

                                        <div class="col-md-10 col-sm-10 col-xs-10">
                                            <a href="addimg.php" class="btn btn-default"> <span class="glyphicon glyphicon-plus"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" action="index.php" name="frm" id="frm">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="active">
                                                <TD><input type="checkbox" class="checkAll" name="checkAll"> </TD>
                                                <td><strong>IMAGE NAME</strong></td>
                                                <td><strong>IMAGE</strong></td>
                                                <td><strong>ORDER</strong></td>
                                                <td><strong>ACTIONS</strong></td>
                                            </tr>
                                            <?php
                                            $pagesize=PAGESIZE;
                                            $rs = mysql_query("select * from `gallery` where $cond");
                                            $num = mysql_num_rows($rs);
                                            $pageindex=isset($_GET['pageindex'])? $_GET['pageindex']:0;
                                            $totalpage=  ceil($num/$pagesize);
                                            
                                            if ($num) {
                                                $rspage = mysql_query("select * from `gallery` where $cond limit ".($pageindex*$pagesize).",".$pagesize);
                                                while ($row = mysql_fetch_array($rspage)) {
                                                    ?>

                                                    <tr id="rid<?php echo $row['id']; ?>">
                                                        <td><input type="checkbox" class="checkrec" name="checkrec[]" value="<?php echo $row['id']; ?>"></td>
                                                        <td><?php echo $row['img_name']; ?> &nbsp; &nbsp;

                                                            <small><a  href='#' onclick="getuserdetails(<?php echo $row['id']; ?>)"> 
                                                                     <!-- can also use onmouseover instead of onclick -->
                                                                View more &nbsp;
                                                                &nbsp;
                                                                <span id="ld<?php echo $row["id"];?>">
                                                                </span>
                                                                </a></small>

                                                           
                                                        </td>

                                                        <td><img src="/p1/uploads/<?php echo sprintf($row['img_file'],"_50");?>" ></td>
                                                        <td class="tdaction"><a>&#9660;</a>&nbsp;&nbsp;&nbsp; <a>&#9650;</a></td>
                                                        <td class="tdaction">
                                                            <a href="addimg.php?todo=edit&id=<?php echo $row['id'] ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                                           <a href="index.php?todo=delete&id=<?php echo $row['id'] ?>" onclick="return deleteRec();"><span class="glyphicon glyphicon-trash"></span></a> 
                                                           <!-- <a href="#" onclick="deleteAjx('<?php echo $row['id']; ?>')"><span class="glyphicon glyphicon-trash"></span></a>-->
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr><td colspan="5">
                                                        NO record found
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                                
                                        </tbody>
                                    </table>
                                    
                                    <div class='row'>
                            
                                        <div class="col-md-20" style="text-align:left;"> <ul class="pager" style="margin-top:0px;">
                                                            <li> <?php
                                                if ($pageindex > 0) {
                                                    ?><a href="index.php?pageindex=<?php echo ($pageindex - 1); ?>">Previous</a><?php
                                                }
                                                ?></li>
                                            <li><?php
                                                if ($totalpage > ($pageindex + 1)) {
                                                    ?> <a href="index.php?pageindex=<?php echo ($pageindex + 1); ?>">Next</a>
                                                    <?php
                                                }
                                                ?></li>
                                </ul></div>
                            <div class="col-md-offset-65 col-md-15" style="margin-bottom:10px;">
                                
                                  
                                                              
                                <input type="hidden" name="formact" id="formact" value="" />
                                                        <button type="button" id="deleteAll" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete All</button>
                                                        <div class="clearfix">
                                                            
                                                        </div>
                            </div>
                            </div>
                                    <div style="width:20px;"></div>
                                </form>
                                
                            </div>
                        </div>

                    </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Details </h4>
                                                                        </div>
                                                                        <div class="modal-body userdetailstext">
                                                                           
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
        <?php
        include '../footer.php';
        ?>

    </body>
</html>