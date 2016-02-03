<?php
require_once('../config.php');
checkLogin();
$cond = '1';
if (isset($_GET['formact']) && $_GET['formact'] == 'search') {
    $cond.= " and username Like '%".$_GET['keyWord']."%'";
}
if (isset($_POST['formact']) && $_POST['formact'] == 'del') {
    $checkIndi = array();
    $checkIndi = isset($_POST['checkIndi']) ? $_POST['checkIndi'] : '';
    foreach ($checkIndi as $key => $value) {


        if (isset($value) && $value != '') {

            mysql_query("delete from user where id=" . $value) or ( mysql_error());
        }
    }
    header("location:index.php");
    exit();
}

if (isset($_GET['todo']) && $_GET['todo'] == 'activedeactive') {
    $tid = (isset($_GET['tid']) ? $_GET['tid'] : '');
    $row = mysql_fetch_array(mysql_query("select is_active from user where id='" . $tid . "'"));
    $action = ($row['is_active']==1) ? '0' : '1';
    mysql_query("update user set is_active='" . $action . "' where id='" . $tid . "'");
    $_SESSION['msg'] = "your status has been changed";
    header("Location:index.php");
    exit();
}
if (isset($_GET['todo']) && $_GET['todo'] == 'setord') {
    $tid = (isset($_GET['tid']) ? $_GET['tid'] : '');
    $action = (isset($_GET['action']) ? $_GET['action'] : '');
   setord('user',$action,$tid);
  re_arrange('user');
    header("Location:index.php");
    exit();
}

if (isset($_GET['todo']) && $_GET['todo'] == 'del') {
    mysql_query("delete from user where id=" . $_GET['user_id']);
    $_SESSION['msg'] = "Your user has been deleted sucessfully";
    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <script src="../../js/jquery.js"></script>
        <script src="../../js/bootstrap.js"></script>
        <script src="../../js/check.js"></script>
        <link href="../../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/style.css" rel="stylesheet" type="text/css"/>
    <script>
    function getUserdetails(obj){
        jQuery("#ld"+obj).html('<img src="ajax-loader.gif"/>');
      jQuery.ajax(
            {
                type: "POST",
                url: "ajax.php",
                data: {id: obj,todo:'view'},
                dataType:'html',
                success: function(data) {
                        jQuery("#ld"+obj).html('');
                        jQuery('.userdetailsText').html('');
                        jQuery('.userdetailsText').html(data);
                        jQuery('#myModal').modal('toggle');

                    

   
                },
                error:function(){
                    alert('error occured');
                }
            }
    );
 }
    </script>
    </head>
    <body>

        <div class="wrapper container-fluid">

          <?php include_once('../header.php'); ?>
            <div class="clearfix"></div>
            <div class="container">
                <div class="row">
                    <?php include_once('../menu.php'); ?>
                </div><!--**row**-->
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">            
                        <form class="navbar-form navbar-left" method="GET" role="search">
                         <div class="form-group">
        <input type="text" name="keyWord" id="keyWord" class="form-control" placeholder="Search">
                        </div>
        <input type="hidden" name="formact" id="formact" value="search" >
<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-save"></span>Submit</button>
                        </form>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div><!--**container**-->

            <div class="clearfix"></div>
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-100">
                            <?php echo (isset($_SESSION['msg']) && $_SESSION['msg'] != '') ? '<div class="row"><div class="alert alert-warning"><div class="row"><div class="col-md-10 col-sm-10">' . $_SESSION['msg'] . '</div><div class="col-md-2 col-sm-2" style="text-align:right;"><span class="glyphicon glyphicon-remove" style="font-size:20px; cursor:pointer;" onclick="jQuery(\'.alert\').hide(\'fade\');"></span></div></div></div></div>' : '' ?>
                        </div>
                    </div>
                    <div class="row bg-primary">
                        <div class="col-md-90">
                            <h2><span class="glyphicon glyphicon-user"></span> User Management</h2>
                        </div>
                        <div class="col-md-1 ">
                            <a class="btn btn-default addbutton"  href="adduser.php"><span class="glyphicon glyphicon-plus-sign" style="font-size:25px;"></span></a>
                        </div>
                    </div>


                    <div class="row">
                        <div class="table-responsive">
                            <form method="post" action="index.php" id="frm">
                                <table class="table table-bordered table-hover">


                                    <tr class="">
                                        <th class="check"><input type="checkbox" name="checkAll" id="checkAll" class="chk" value="checkAll" onClick="checksAll();"/></th>
                                        <th>User Name</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Address</th>
                                        <th>ord</th>
                                        <th class="thaction">Action</th>
                                    </tr>
                                     <?php
                                $userSize = 4;
                                $userIndex = (isset($_GET['user']) && $_GET['user'] != 0) ? $_GET['user'] : 0;
                                $rsq = mysql_query("Select * from `user` where $cond ");
                                $numRec =mysql_num_rows($rsq);
                                $totalNumPage = ceil($numRec / $userSize);
                               
                                $rs = mysql_query("Select * from `user` where $cond order by ord ASC limit " . ($userSize * $userIndex) . "," . $userSize);
                                   if ($numRec) {
                                    $i = 0;
                                    $className = '';
                                    while ($rowUser = mysql_fetch_assoc($rs)) {
                                        if ($i % 2 == 0) {
                                            $className = 'greenCol';
                                        } else {
                                            $className = 'whiteCol';
                                        }
                                        ?>
                                            <tr id="rid<?php echo $rowUser['id'] ?>" class=" <?php echo $className ?>">
                                                <th class="check">
                                                    <input type="checkbox" name="checkIndi[]" id="checkIndi" value="<?php echo $rowUser['id']; ?>" class="chk" />
                                                </th>
                                                <td><?php echo $rowUser['username']; ?>
                                                    &nbsp;&nbsp;
                                                    <small><a href="#" onmouseover=" getUserdetails(<?php echo $rowUser['id'] ?>)">view details</a></small><span id="ld<?php echo $rowUser['id']?>"></span>
                                                
                                                
                                                
                                                
                                                </td>
                                                <td><?php echo $rowUser['first_name']; ?></td>
                                                <td><?php echo $rowUser['last_name']; ?></td>
                                                <td><?php echo $rowUser['address']; ?></td>
                                                <td><a href="index.php?todo=setord&action=up&tid=<?php echo $rowUser['id'] ?>">&#9650</a> 
                                                    <a href="index.php?todo=setord&action=down&tid=<?php echo $rowUser['id'] ?>">&#9660</a> </td>
                                                <td class="thaction">
                                                    <a href="adduser.php?todo=edit&user_id=<?php echo $rowUser['id'] ?>"><span class="glyphicon glyphicon-edit" style="font-size:20px;"></span></a>&nbsp;&nbsp;
<!--                                                    <a href="index.php?todo=del&user_id=<?php echo $rowUser['id'] ?>"><span class="glyphicon glyphicon-trash" style="font-size:20px;"></span></a>&nbsp;&nbsp;-->
                                                    <a href="#" onclick="deleteAjx('<?php echo $rowUser['id'];?>')" title="delete"><span class="glyphicon glyphicon-trash" style="font-size:20px;"></span></a>
                                                <?php if ($rowUser['is_active'] == '1') { ?>
                                                        <a href="index.php?todo=activedeactive&tid=<?php echo $rowUser['id'] ?>"><span class=" glyphicon glyphicon-star" style="font-size:20px;color:#00ff00;"></span></a>
                                                    <?php } else { ?>
                                                        <a href="index.php?todo=activedeactive&tid=<?php echo $rowUser['id'] ?>"><span class=" glyphicon glyphicon-star" style="font-size:20px; color:#ff0000;"></span></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    } else {
                                        ?>
                                        <tr class="errorClass">
                                            <td>
                                                No result Found
                                            </td>
                                        </tr>
                                        <a href="index.php"></a>
                                        <?php
                                    }
                                    ?>

                                </table>
                                     <div class="row">
                        <div class="col-md-2"><div style="text-align:left;"> <ul class="pager">
                                                            <li> <?php
                                                if ($userIndex > 0) {
                                                    ?><a href="index.php?user=<?php echo ($userIndex - 1); ?>">Previous</a><?php
                                                }
                                                ?></li>
                                            <li><?php
                                                if ($totalNumPage > ($userIndex + 1)) {
                                                    ?> <a href="index.php?user=<?php echo ($userIndex + 1); ?>">Next</a>
                                                    <?php
                                                }
                                                ?></li>
                                </ul></div></div>
                        <div class="col-md-10"><div  style="text-align:right;"><button type="button" class="btn btn-primary" name="select All"  onClick="selectAll();"><span class="glyphicon glyphicon-ok"></span> &nbsp; select All</button>

                                                        <button type="button" class="btn btn-danger" name="remove All"  onClick="removesAll();"><span class="glyphicon glyphicon-remove"></span> &nbsp; Remove all</button>
                                                        <input type="hidden" name="formact" id="formact" value=""/> 
                                                        <button type="button" class="btn btn-warning" name="deletesAll"  onClick="delAll();"><span class="glyphicon glyphicon-remove-circle"></span> &nbsp;Delete All</button></div></div>
                    </div>
                       <div class="clearfix" style="height:10px;"></div>
                            </form>
                        </div><!--container-->
                    </div><!--container-fluid-->
                </div>
            </div>
        </div><!--wrapper-->
        
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body userdetailsText">
       
      </div>
    
    </div>
  </div>
</div>
        <?php
        require_once('../footer.php');
        ?>

    </body>
</html>