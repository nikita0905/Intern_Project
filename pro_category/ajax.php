<?php
require_once '../config.php';
include '../includes/functions.php';
checkLogin();

//echo '<pre>';
//print_r($_POST);
 if(isset($_POST['todo']) && $_POST['todo']=='delete')
 {
     mysql_query("delete from `category` where `id`=".$_POST['id'] );
     echo 'success';
 }

 
 if(isset($_POST['todo']) && $_POST['todo']=='view')
 {
     $rs= mysql_query("select * from `category` where `id`=".$_POST['id'] );
     $row=  mysql_fetch_array($rs);
     ?>

     <div class="row">
         <h4>
             &nbsp;
             &nbsp;
             <?php echo $row['name']; ?>
         </h4>
         <div class="col-md-50 alert-info">
            TYPE
             <br>
             DESCRIPTION
             <br>
             ADD DATE
            
         </div>
         <div class="col-md-50">
             
             <?php echo $row['type']; ?>
             <br>
             <?php echo strip_tags($row['description']); ?>
             <br>
             <?php echo strip_tags($row['add_date']); ?>
             
         </div>
         <div class="clearfix"></div>
     </div>         
         <?php
 }