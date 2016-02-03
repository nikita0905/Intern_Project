<?php
require_once '../config.php';
include '../includes/functions.php';
checkLogin();

//echo '<pre>';
//print_r($_POST);
 if(isset($_POST['todo']) && $_POST['todo']=='delete')
 {
     mysql_query("delete from `pages` where `id`=".$_POST['id'] );
     echo 'success';
 }

 
 if(isset($_POST['todo']) && $_POST['todo']=='view')
 {
     $rs= mysql_query("select * from `pages` where `id`=".$_POST['id'] );
     $row=  mysql_fetch_array($rs);
     ?>

     <div class="row">
         <h4>&nbsp;
             &nbsp;
             <?php echo $row['title']; ?>
         </h4>
         <div class="col-md-50 alert-info">
             PAGE TITLE
             <BR>
             META TITLE
             <br>
             META KEYWORD
             <br>
             META DESCRIPTION
             <br>
             PARENT ID
             <br>
             
             TEMPLATE NAME
             <BR>
             <?php if ($row['is_top_menu'] == '1'){?>
             TOP MENU NAME
             <BR>
             <?php } ?>
             <?php if ($row['is_footer_menu'] == '1'){?>
             FOOTER MENU NAME
             <BR>
             <?php } ?>
             ADD DATE
             <br>
             STATUS
             <br>
             DESCRIPTION
             
         </div>
         
         <div class="col-md-50">
             
             <?php echo $row['page_title']; ?>
             <br>
             <?php echo $row['meta_title']; ?>
             <br>
             <?php echo $row['meta_keyword']; ?>
             <br>
             <?php echo strip_tags($row['meta_description']); ?>
             <br>
             <?php echo strip_tags($row['parent_id']); ?>
             <br>
             <?php echo $row['template_name']; ?>
             <br>
             <?php if ($row['is_top_menu'] == '1'){
                 echo $row['top_menu_name'];
                 echo '<br>';
             }
             ?>
            <?php if ($row['is_footer_menu'] == '1'){
                 echo $row['footer_menu_name'];
                 echo '<br>';
             }
             ?>
             <?php echo $row['add_date']; ?>
             <br>
             <?php echo $row['status']; ?>
             <br>
             <?php echo strip_tags($row['description']); ?>
         </div>
         <div class="clearfix"></div>
     </div>         
         <?php
 }