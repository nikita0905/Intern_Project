<?php

function checkLogin(){
    global $admBasePath;
if(!isset($_SESSION['user_id']) || $_SESSION['user_id']=='' )
{
 header("Location:".$admBasePath."/login.php");
   exit();
}
}

function insertRecord($tablename,$arrValue){

$query ='';
$columnName ='';
$columnValue ='';
if(is_array($arrValue) && !empty($arrValue)){
$query .="INSERT INTO `".$tablename."`";
foreach($arrValue as $key => $value){
$columnName.= '`'.$key.'`,';
$columnValue.= "'".$value."',";
}
$query .=" (".substr($columnName,0,-1).") VALUES (".substr($columnValue,0,-1).")";
}
mysql_query($query)or die(mysql_error());
}



function deleteRecord($tablename,$Value){
$query ='';
$columnName ='';
$columnValue='';
if(is_array($Value) && !empty($Value)){
$query.="DELETE FROM `".$tablename."`";
$columnName.='`'.$key.'`,';
$columnValue.= "'".$value."',";
$query.="(".substr($columnName,0,-1).")";
}echo $query;
//mysql_query($query) or die(mysql_error());
}



function updateRecord($tablename,$arrValue){
$query ='';
$columnName ='';
$columnValue='';
if(is_array($arrValue) && !empty($arrValue)){
$query.="UPDATE `".$tablename."` set";
foreach($arrValue as $key => $value){
$columnName.='`'.$key.'`,';
$columnValue.= "'".$value."',";
}
$query.="(".substr($columnName,0,-1).") VALUES (".substr($columnValue,0,-1).")";
}
echo $query;
//mysql_query($query) or die(mysql_error());
}


function getCount($tableName,$param){
  
  $rs = mysql_query("select * from ".$tableName." where ".$param); 
  return mysql_num_rows($rs);
}



function setord($tablename,$updown,$tid)
{
	//$row = mysql_fetch_array(selectdynamic($tablename,array("ord"),array("id"),array("="),array($id),array("0","1"),0,"rs","ex"));
  
	$row = mysql_fetch_array(mysql_query("select ord from ".$tablename." where id='".$tid."' limit 0, 1"));
	if ($updown == 'down')
	{
		$down_rs = mysql_query("select ord from ".$tablename." where id='".$tid."' limit 0, 1");
		if (mysql_num_rows($down_rs))
		{
			$down_row = mysql_fetch_array($down_rs);
			mysql_query("update ".$tablename." set ord='".((float)$down_row['ord']+1.5)."' where id='".$tid."'");
			
		}	
 	}
	else if ($updown == 'up')
	{
               $up_rs = mysql_query("select ord from ".$tablename." where id='".$tid."' limit 0, 1");
		if (mysql_num_rows($up_rs))
		{
			$up_row = mysql_fetch_array($up_rs);
                      	mysql_query("update ".$tablename." set ord='".((float)$up_row['ord']-1.5)."' where id='".$tid."'");
			
		}
 	}
} 
 
function re_arrange($tablename,$mst=NULL,$mstval=NULL)
{
	if($mst)
	{
		 $cond=" where $mst='".$mstval."'";
	}
	$select=mysql_query("select * from .$tablename".$cond." order by ord");
	$num=mysql_num_rows($select);
	if($num)
	{
			$i=1;
			while($row=mysql_fetch_array($select))
			{
				mysql_query("update $tablename set ord='".$i++."' where id='".$row['id']."'");
			}
	}
} 
 
function resizeImage($sourcefile,$destination,$new_width,$new_height){

         define ('MAX_WIDTH', 1500);//max image width               
         define ('MAX_HEIGHT', 1500);//max image height 
         define ('MAX_FILE_SIZE', 10485760);

         //iamge save path
         $path = $destination;  
         $file = $sourcefile;
     
        //name of the new image           
        $nameOfFile = 'resize_'.$new_width.'x'.$new_height.'_'.basename($file['name']);       

        $image_type = $file['type'];
        $image_size = $file['size'];
        $image_error = $file['error'];
        $image_file = $file['tmp_name'];
        $image_name = $file['name'];        

        $image_info = getimagesize($image_file);

        //check image type 
        if ($image_info['mime'] == 'image/jpeg' or $image_info['mime'] == 'image/jpg'){    
        }
        else if ($image_info['mime'] == 'image/png'){    
        }
        else if ($image_info['mime'] == 'image/gif'){    
        }
        else{            
            //set error invalid file type
        }

        if ($image_error){
            //set error image upload error
        }

        if ( $image_size > MAX_FILE_SIZE ){
            //set error image size invalid
        }

        switch ($image_info['mime']) {
            case 'image/jpg': //This isn't a valid mime type so we should probably remove it
            case 'image/jpeg':
            $image = imagecreatefromjpeg ($image_file);
            break;
            case 'image/png':
            $image = imagecreatefrompng ($image_file);
            break;
            case 'image/gif':
            $image = imagecreatefromgif ($image_file);
            break;
        }    

        if ($new_width == 0 && $new_height == 0) {
            $new_width = 100;
            $new_height = 100;
        }

        // ensure size limits can not be abused
        $new_width = min ($new_width, MAX_WIDTH);
        $new_height = min ($new_height, MAX_HEIGHT);

        //get original image h/w
        $width = imagesx ($image);
        $height = imagesy ($image);

        //$align = 'b';
        $zoom_crop = 1;
        $origin_x = 0;
        $origin_y = 0;
        //TODO setting Memory

        // generate new w/h if not provided
        if ($new_width && !$new_height) {
            $new_height = floor ($height * ($new_width / $width));
        } else if ($new_height && !$new_width) {
            $new_width = floor ($width * ($new_height / $height));
        }

        // scale down and add borders
    if ($zoom_crop == 3) {

         $final_height = $height * ($new_width / $width);

         if ($final_height > $new_height) {
            $new_width = $width * ($new_height / $height);
         } else {
            $new_height = $final_height;
         }

    }

        // create a new true color image
        $canvas = imagecreatetruecolor ($new_width, $new_height);
        imagealphablending ($canvas, false);


        if (strlen ($canvas_color) < 6) {
            $canvas_color = 'ffffff';       
        }

        $canvas_color_R = hexdec (substr ($canvas_color, 0, 2));
        $canvas_color_G = hexdec (substr ($canvas_color, 2, 2));
        $canvas_color_B = hexdec (substr ($canvas_color, 2, 2));

        // Create a new transparent color for image
        $color = imagecolorallocatealpha ($canvas, $canvas_color_R, $canvas_color_G, $canvas_color_B, 127);

        // Completely fill the background of the new image with allocated color.
        imagefill ($canvas, 0, 0, $color);

        // scale down and add borders
    if ($zoom_crop == 2) {

            $final_height = $height * ($new_width / $width);

        if ($final_height > $new_height) {
            $origin_x = $new_width / 2;
            $new_width = $width * ($new_height / $height);
            $origin_x = round ($origin_x - ($new_width / 2));
            } else {

            $origin_y = $new_height / 2;
            $new_height = $final_height;
            $origin_y = round ($origin_y - ($new_height / 2));

        }

    }

        // Restore transparency blending
        imagesavealpha ($canvas, true);

        if ($zoom_crop > 0) {

            $src_x = $src_y = 0;
            $src_w = $width;
            $src_h = $height;

            $cmp_x = $width / $new_width;
            $cmp_y = $height / $new_height;

            // calculate x or y coordinate and width or height of source
            if ($cmp_x > $cmp_y) {
        $src_w = round ($width / $cmp_x * $cmp_y);
        $src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);
            } else if ($cmp_y > $cmp_x) {
        $src_h = round ($height / $cmp_y * $cmp_x);
        $src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);
            }

            // positional cropping!
        if ($align) {
            if (strpos ($align, 't') !== false) {
                $src_y = 0;
            }
                        if (strpos ($align, 'b') !== false) {
                                $src_y = $height - $src_h;
                        }
                        if (strpos ($align, 'l') !== false) {
                $src_x = 0;
            }
            if (strpos ($align, 'r') !== false) {
                $src_x = $width - $src_w;
            }
        }

            // positional cropping!
            imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

         } else {       
        imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    }
        //Straight from Wordpress core code. Reduces filesize by up to 70% for PNG's
        if ( (IMAGETYPE_PNG == $image_info[2] || IMAGETYPE_GIF == $image_info[2]) && function_exists('imageistruecolor') && !imageistruecolor( $image ) && imagecolortransparent( $image ) > 0 ){
            imagetruecolortopalette( $canvas, false, imagecolorstotal( $image ) );
    }
        $quality = 100;            
        $nameOfFile = 'resize_'.$new_width.'x'.$new_height.'_'.basename($file['name']);       

    if (preg_match('/^image\/(?:jpg|jpeg)$/i', $image_info['mime'])){                       
        imagejpeg($canvas, $path.$nameOfFile, $quality);  

    } else if (preg_match('/^image\/png$/i', $image_info['mime'])){                         
        imagepng($canvas, $path.$nameOfFile, floor($quality * 0.09)); 

    } else if (preg_match('/^image\/gif$/i', $image_info['mime'])){               
        imagegif($canvas, $path.$nameOfFile); 

    }
}
?>