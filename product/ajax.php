<?php
require_once '../config.php';
include '../includes/functions.php';
checkLogin();

//echo '<pre>';
//print_r($_POST);
 if(isset($_POST['todo']) && $_POST['todo']=='delete')
 {
     mysql_query("delete from `product` where `id`=".$_POST['id'] );
     echo 'success';
 }

 
 if(isset($_POST['todo']) && $_POST['todo']=='view')
 {
     $rs= mysql_query("select * from `product` where `id`=".$_POST['id'] );
     $row=  mysql_fetch_array($rs);
     ?>

     <div class="row">
         <h4>
             &nbsp;
             &nbsp;
             <?php echo $row['name']; ?>
         </h4>
         <div class="col-md-50 alert-info">
            PRICE
            <BR>
            QUANTITY
            <BR>
            CAT ID
            <br>
            CATEGORY
            <br>
            IMAGE
             <br>
             DESCRIPTION
             
            
         </div>
         <div class="col-md-50">
             
             <?php echo $row['price']; ?>
             <br>
             <?php echo $row['quantity']; ?>
             <br>
             <?php echo $row['cat_id'];?>
             <br>
             <?php
             $rscat= mysql_query("select * from `category` where `id`=".$row['cat_id'] );
             $rowcat=  mysql_fetch_array($rscat);
             echo $rowcat['name'];
             ?>
             <br>
             <?php echo strip_tags($row['description']); ?>
             <br>
             <?php 
             $rsi= mysql_query("select * from `product_img` where `id`=".$_POST['id'] );
             $rowi=  mysql_fetch_array($rsi); ?>
            <img src="/p1/uploads/<?php echo sprintf($rowi['img_file'],"_50");?>" alt="image not added">
            
             
             
             
         </div>
         <div class="clearfix"></div>
     </div>         
         <?php
 }