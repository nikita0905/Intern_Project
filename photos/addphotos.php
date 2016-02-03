<?php
require_once('../config.php');
checkLogin();
$photos_id = 0;
$photos = '';
$description = '';
$fileName = '';
$formact = 'addphotos';
$category_id = 0;

if (isset($_GET['todo']) && $_GET['todo'] == 'edit') {

    $photos_id = $_GET['photos_id'];
    $rs = mysql_query("select * from photos where id='" . $photos_id . "'");
    $row = mysql_fetch_array($rs);
    $photos = $row['photos'];
    $description = $row['description'];
    $fileName = $row['fileName'];
    $category_id = $row['category_id'];
    $formact = 'editphotos';
}
if (isset($_POST['formact']) && $_POST['formact'] == 'addphotos') {
    if (isset($_FILES['fileName']) && $_FILES['fileName']['name'] != '') {
        move_uploaded_file($_FILES['fileName']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $frntBasePath . "/uploads/" . $_FILES['fileName']['name']);
    }
    $photos = isset($_POST['photos']) ? $_POST['photos'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $fileName = isset($_FILES['fileName']['name']) ? $_FILES['fileName']['name'] : '';
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';


    mysql_query("Insert into photos set photos='" . $photos . "',
   description='" . $description . "',fileName='" . $fileName . "', add_date='" . time() . "',category_id='" . $category_id . "'") or die(mysql_error());
    $_SESSION['msg'] = 'Your new photo has been updated';
     re_arrange('photos');
    header("Location:index.php");
    exit();
}

if (isset($_POST['formact']) && $_POST['formact'] == 'editphotos') {
    if (isset($_FILES['fileName']) && $_FILES['fileName']['name'] != '') {
        move_uploaded_file($_FILES['fileName']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $frntBasePath . "/uploads/" . $_FILES['fileName']['name']);
    }
    $photos = isset($_POST['photos']) ? $_POST['photos'] : '';
    $editPhoto = isset($_POST['editPhoto']) ? $_POST['editPhoto'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $fileName = isset($_FILES['fileName']['name']) ? $_FILES['fileName']['name'] : '';
    $photoTobeDabase = ($fileName != '') ? $fileName : $editPhoto;
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : 0;


    mysql_query("update `photos` set photos ='" . $photos . "',
   description='" . $description . "', fileName='" . $photoTobeDabase . "', category_id='" . $category_id . "' where id='" . $_POST['photos_id'] . "'") or die(mysql_error());
    $_SESSION['msg'] = 'Your new photo has been created';
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <script src="../../js/jquery.js"></script>
        <script src="../../js/bootstrap.js"></script>
        <link href="../../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/style.css" rel="stylesheet" type="text/css"/>
        <script src="../../js/check.js"></script>
        <script src="<?php echo $frntBasePath; ?>/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" language="javascript">
            validate = function() {
                if (jQuery('#photos').val() == '' || jQuery('#photos').val() == undefined) {
                    jQuery('#photos').css('border', '1px solid #ff0000');
                    jQuery('#nameError').html('News Title is required');
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <div class="wrapper container-fluid">

            <header>
                <div class="container bgGray">
                    <div class="row">
                        <div class="col-md-5"><h1 class="siteTitle">Admin</h1></div>
                        <div class="col-md-7"></div>
                    </div><!--row-->
                </div><!--bgGray-->
            </header>
            <div class="clearfix"></div>
            <div class="container">
                <div class="row">
                    <?php include_once('../menu.php') ?>
                </div><!--**row**-->
            </div><!--**container**-->
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2><span class="glyphicon glyphicon-picture"></span>&nbsp;Add New Image</h2>
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" name="addphotos" id="addphotos" method="post" action="addphotos.php" enctype="multipart/form-data" onSubmit="return validate();">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">category</label>
                                            <div class="col-sm-10">
                                                <?php
                                                $rs_category = mysql_query("select * from categories where type='images'");
                                                $numRec_category = mysql_num_rows($rs_category);
                                                if ($numRec_category) {
                                                    ?>
                                                    <select name="category_id" id="category_id" class="form-control">
                                                        <?php
                                                        while ($row_category = mysql_fetch_assoc($rs_category)) {
                                                            ?>
                                                            <option value="<?php echo $row_category['id']; ?>"<?php
                                                            if ($category_id == $row_category['id']) {
                                                                echo 'selected="selected"';
                                                            }
                                                            ?>><?php echo $row_category['name'] ?> </option>
                                                                    <?php
                                                                }
                                                                ?>
                                                    </select>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photos" class="col-sm-2 control-label">photo</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="photos" id="photos" value="<?php echo $photos; ?>"/> <br><span id="nameError" style="color:#ff0000;"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fileName" class="col-sm-2 control-label">File Name</label>
                                            <div class="col-sm-10">
                                                <input type="file" id="fileName" name="fileName" value="<?php echo $fileName; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <?php
                                            if (isset($_GET['todo']) && $_GET['todo'] == 'edit') {
                                                ?> 
                                                <label for="imageShow" class="col-sm-2 control-label">Image show</label> 
                                                <div class="col-sm-10"> 
                                                    <img src="<?php echo $frntBasePath . "/uploads/" . $fileName ?>" width="80px" height="80px"> 

                                                </div><?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-sm-2 control-label">Discreption</label>
                                            <div class="col-sm-10"> 
                                                <textarea name="description" class="form-control" id="description"><?php echo $description; ?></textarea> <script>
                                                    CKEDITOR.replace('description', {width: '600', height: '200'});
                                                </script> 
                                            </div>

                                        </div>
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> &nbsp;Submit</button>
                                            <input type="hidden" name="formact" id="formact" value="<?php echo $formact; ?>"/>
                                            <input type="hidden" name="photos_id" id="photos_id" value="<?php echo $photos_id; ?>"/>
                                            <input type="hidden" name="editPhoto" id="editPhoto" value="<?php echo $fileName; ?>"/>

                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"> </div>

                    </div>  
                </div>
            </div>

        </div>


        <?php
        require_once('../footer.php');
        ?>


    </body>
</html>