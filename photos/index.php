<?php
require_once('../config.php');
checkLogin();
$cond = '1';
if (isset($_GET['formact']) && $_GET['formact'] == 'search') {
    $cond.= " and photos Like '%".$_GET['keyWord']."%'";
}
if (isset($_GET['todo']) && $_GET['todo'] == 'del') {
    $rs = mysql_query("select file_name from file where id=" . $_GET['user_id']);
    $row = mysql_fetch_array($rs);
    unlink($_SERVER['DOCUMENT_ROOT'] . $frntBasePath . '/uploads/' . $row['fileName']);
    mysql_query("delete from photos where id=" . $_GET['user_id']);
    $_SESSION['msg'] = "Your user has been deleted sucessfully";
    header("Location:index.php");
    exit();
}
if (isset($_GET['todo']) && $_GET['todo'] == 'setord') {
    $tid = (isset($_GET['tid']) ? $_GET['tid'] : '');
    $action = (isset($_GET['action']) ? $_GET['action'] : '');
   setord('photos',$action,$tid);
  re_arrange('photos');
    header("Location:index.php");
    exit();
}

if (isset($_GET['todo']) && $_GET['todo'] == 'activedeactive') {
    $tid = (isset($_GET['tid']) ? $_GET['tid'] : '');
    $row = mysql_fetch_array(mysql_query("select is_active from photos where id='" . $tid . "'"));
    $action = ($row['is_active'] == 1) ? '0' : '1';
    mysql_query("update photos set is_active='" . $action . "' where id='" . $tid . "'");
    $_SESSION['msg'] = "your status has been changed";
    header("Location:index.php");
    exit();
}

if (isset($_POST['formact']) && $_POST['formact'] == 'del') {
    $checkIndi = array();
    $checkIndi = (isset($_POST['checkIndi']) ? $_POST['checkIndi'] : '');
    foreach ($checkIndi as $key => $value) {

        if (isset($value) && $value != '') {

            mysql_query("delete from `user` where id='" . $value . "'") or ( mysql_error());
        }
    }
    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Landing page</title>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap.js"></script>
    <script src="../../js/check.js"></script>
    <link href="../../css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>

    <div class="wrapper container-fluid">

        <?php include_once('../header.php'); ?>
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <?php include_once('../menu.php') ?>
            </div><!--**row**-->
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4" style="float:right;">
                    <!--<div class="row">-->
                    <!--<div style="float:right;">-->
                <form class="navbar-form navbar-left" role="search">
                     <div class="form-group ">
                            <input type="text" name="keyWord" id="keyWord" class="form-control" placeholder="Search">
                        </div>
                        <input type="hidden" name="formact" id="formact" value="search" >
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-save"></span>Submit</button>
                </form>
                    <!--</div>-->
                    <!--</div>-->
                </div>
                
            </div>
        </div><!--**container**-->


        <div class="clearfix"></div>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo (isset($_SESSION['msg']) && $_SESSION['msg'] != '') ? '<div class="row"><div class="alert alert-warning"><div class="row"><div class="col-md-10 col-sm-10">' . $_SESSION['msg'] . '</div><div class="col-md-2 col-sm-2" style="text-align:right;"><span class="glyphicon glyphicon-remove" style="font-size:20px; cursor:pointer;" onclick="jQuery(\'.alert\').hide(\'fade\');"></span></div></div></div></div>' : '' ?>
                    </div>
                </div>
                <div class="row bg-primary">
                    <div class="col-md-11">
                        <h2><span class="glyphicon glyphicon-picture"></span>&nbsp;Photo Management</h2>
                    </div>
                    <div class="col-md-1 ">
                        <a class="btn btn-default addbutton"  href="addphotos.php"><span class="glyphicon glyphicon-plus-sign" style="font-size:25px;"></span></a>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <form method="post" action="index.php" id="frm">
                            <table class="table table-bordered table-hover">

                                <tr class="">
                                    <th class=""><input type="checkbox" class="chk" name="checkAll" id="checkAll" value="checkAll" onClick="checksAll();"/></th>
                                    <th>Photos</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>file Name</th>
                                    <th>Add Date</th>
                                    <th>ord</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                                $imageSize = 4;
                                $imageIndex = (isset($_GET['image']) && $_GET['image'] != 0) ? $_GET['image'] : 0;
                                $rsq = mysql_query("Select * from `photos` where $cond order by ord ASC");
                                $numRec = mysql_num_rows($rsq);
                                $totalNumPage = ceil($numRec / $imageSize);
                                $rs = mysql_query("Select * from `photos` where $cond order by ord ASC limit " . ($imageSize * $imageIndex) . "," . $imageSize);



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
                                        <tr class="<?php echo $className ?>">
                                            <td class="">
                                                <input type="checkbox" class="chk" name="checkIndi[]" id="checkIndi" value="<?php echo $rowUser['id'] ?>"/>
                                            </td>
                                            <td><img src="<?php echo $frntBasePath . "/uploads/" . $rowUser['fileName'] ?>" width="80px" height="80px"/></td>
                                            <td><?php echo $rowUser['photos']; ?></td>
                                            <td><?php echo $rowUser['description']; ?></td>
                                            <td><?php echo $rowUser['fileName']; ?></td>
                                            <td><?php echo date("d-m-Y h:i:s", $rowUser['add_Date']); ?></td>
                                             <td><a href="index.php?todo=setord&action=up&tid=<?php echo $rowUser['id'] ?>">&#9650</a> 
                                              <a href="index.php?todo=setord&action=down&tid=<?php echo $rowUser['id'] ?>">&#9660</a> </td>
                                            <td class="thaction"><a href="addphotos.php?todo=edit&photos_id=<?php echo $rowUser['id'] ?>"><span class="glyphicon glyphicon-edit" style="font-size:20px;"></span></a>&nbsp;&nbsp;<a href="index.php?todo=del&user_id=<?php echo $rowUser['id'] ?>"><span class="glyphicon glyphicon-trash" style="font-size:20px;"></span></a>&nbsp;&nbsp;
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
                                    <tr class="">
                                        <td>
                                            No result Found
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>



                            </table>
                            <div class="row">
                                <div class="col-md-2"><div style="text-align:left;"> <ul class="pager">
                                            <li> <?php
                                                if ($imageIndex > 0) {
                                                    ?><a href="index.php?image=<?php echo ($imageIndex - 1); ?>">Previous</a><?php
                                                }
                                                ?></li>
                                            <li><?php
                                                if ($totalNumPage > ($imageIndex + 1)) {
                                                    ?> <a href="index.php?image=<?php echo ($imageIndex + 1); ?>">Next</a>
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
                    </div>
                </div>
            </div><!--container-->
        </div><!--container-fluid-->
    </div><!--wrapper-->
    <?php
    require_once('../footer.php');
    ?>

</body>
</html>