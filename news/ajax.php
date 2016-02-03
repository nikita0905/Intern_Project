<?php
require_once '../config.php';
include '../includes/functions.php';
checkLogin();

//echo '<pre>';
//print_r($_POST);
 if(isset($_POST['todo']) && $_POST['todo']=='delete')
 {
     mysql_query("delete from `news` where `id`=".$_POST['id'] );
     echo 'success';
 }

 if(isset($_POST['todo']) && $_POST['todo']=='view')
 {
     $rs= mysql_query("select * from `news` where `id`=".$_POST['id'] );
     $row=  mysql_fetch_array($rs);
     ?>

     <div class="row">
         <h4>
             &nbsp;
             &nbsp;
             <?php echo $row['title']; ?>
         </h4>
         <div class="col-md-50 alert-info">
             
             ADD DATE
             <br>
             STATUS
             <br>
             DESCRIPTION
         </div>
         <div class="col-md-50">
             
             
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