<?php

function checkLogin(){
    
if(!isset($_SESSION['ID']) || $_SESSION['ID']==''){
    header("Location:".BASEPATH."login.php");
    exit();
}
}


function getCount($tableName, $cond){
    
    if($cond=='all'){
        $rs = mysql_query("select * from ".$tableName);
        return mysql_num_rows($rs);
    }else if($cond == 'active'){
        $rs = mysql_query("select * from ".$tableName." where STATUS = 1");
        return mysql_num_rows($rs);
    }else{
         $rs = mysql_query("select * from ".$tableName." where STATUS = 0");
        return mysql_num_rows($rs);
        //deactive user
    }
    
//    switch($cond){
//        case 'all':
//            break;
//        case 'active':
//            break;
//        default :
//            
//    }
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