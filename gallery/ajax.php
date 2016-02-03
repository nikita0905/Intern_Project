<?php
require_once '../config.php';
include '../includes/functions.php';
checkLogin();

//echo '<pre>';
//print_r($_POST);
 if(isset($_POST['todo']) && $_POST['todo']=='delete')
 {
     mysql_query("delete from `gallery` where `id`=".$_POST['id'] );
     echo 'success';
 }

 
 if(isset($_POST['todo']) && $_POST['todo']=='view')
 {
     $rs= mysql_query("select * from `gallery` where `id`=".$_POST['id'] );
     $row=  mysql_fetch_array($rs);
     ?>

     <div class="row">
         <h4>
             &nbsp;
             &nbsp;
             <?php echo $row['img_name']; ?>
         </h4>
         <div class="col-md-50 alert-info">
             Image
            
         </div>
         <div class="col-md-50">
             
             <img src="/p1/uploads/<?php echo sprintf($row['img_file'],"_50");?>">
             
         </div>
         <div class="clearfix"></div>
     </div>         
         <?php
 }