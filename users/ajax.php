<?php
require_once '../config.php';
include '../includes/functions.php';
checkLogin();

//echo '<pre>';
//print_r($_POST);
 if(isset($_POST['todo']) && $_POST['todo']=='delete')
 {
     mysql_query("delete from `user` where `ID`=".$_POST['id'] );
     echo 'success';
 }

 
 if(isset($_POST['todo']) && $_POST['todo']=='view')
 {
     $rs= mysql_query("select * from `user` where `ID`=".$_POST['id'] );
     $row=  mysql_fetch_array($rs);
     ?>

     <div class="row">
         <h4>
             &nbsp;
             &nbsp;
             <?php echo $row['USERNAME']; ?>
         </h4>
         <div class="col-md-50 alert-info">
             EMAIL
             <br>
             ADD DATE
             <br>
             GROUP
             <br>
             STATUS
         </div>
         <div class="col-md-50">
             
             <?php echo $row['EMAIL']; ?>
             <br>
             <?php echo $row['ADD_DATE']; ?>
             <br>
             <?php echo $row['GROUP']; ?>
             <br>
             <?php echo $row['STATUS']; ?>
         </div>
         <div class="clearfix"></div>
     </div>         
         <?php
 }