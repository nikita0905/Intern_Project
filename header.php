<?php
//echo $_SERVER['SCRIPT_NAME'];
$arr=explode('/',$_SERVER['SCRIPT_NAME']);
//echo '<pre>';
//print_r($arr);
//echo'</pre>';
//echo '<br>';
if(in_array('users',$arr))
{
  //  echo 'hi';
}
//echo '<br>';
//echo strpos($_SERVER['SCRIPT_NAME'],'users');
?>

<header id="head">
    <div class="container" style="position:relative; margin:0px auto;">
                <div class="container bgblue" >
                    <div class="row">
                        <div id="left" class="col-md-75">
                            <h1> web page </h1>  
                        </div>
                       <!--<div class="col-md-25">
                            <?php if(isset($_SESSION['ID']) && $_SESSION['ID']!=''){ ?>
<div class="hidden-xs logoutInner" style="float: right; margin-top: 20px;">
                    <a href="<?php echo $base_path; ?>logout.php" style="font-size: 15px;" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span></a></div>
                            <?php } ?>
                        </div>-->
                    </div>
                </div>
    </div>
            </header>
<?php if(isset($_SESSION['ID']) && $_SESSION['ID']!=''){ ?>
<div class="container">
    <div class="row">
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nikita1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="<?php echo $base_path;?>dashboard.php">
            <span class="glyphicon glyphicon-home">
                
            </span>
        </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse nikita1" id="nikita">
        
     <!-- <ul class="nav navbar-nav">
          
                <li class="dropdown <?php if(strpos($_SERVER['SCRIPT_NAME'],'pages'))
{ echo 'active'; } ?>" >
          <a href="<?php echo $base_path;?>#" class="dropdown-toggle" data-toggle="dropdown" >page manager<b class="caret" ></b></a>
          <ul class="dropdown-menu">
              <li><a href="<?php echo $base_path;?>pages/index.php">view all</a></li>
              <li><a href="<?php echo $base_path;?>pages/addpages.php">add pages</a></li>
              <li><a href="<?php echo $base_path;?>pages/index.php?todo=active">active pages</a></li>
              <li><a href="<?php echo $base_path;?>pages/index.php?todo=inactive">inactive pages</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo $base_path;?>">Separated link</a></li>
          </ul>
        </li>
        <li class="dropdown <?php if(strpos($_SERVER['SCRIPT_NAME'],'users'))
{ echo 'active'; } ?>">
          <a href="<?php echo $base_path;?>#" class="dropdown-toggle" data-toggle="dropdown">user manager<b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="<?php echo $base_path;?>users/index.php">view all</a></li>
              <li><a href="<?php echo $base_path;?>users/addusers.php">add users</a></li>
              <li><a href="<?php echo $base_path;?>users/index.php?todo=active">active users</a></li>
              <li><a href="<?php echo $base_path;?>users/index.php?todo=inactive">inactive users</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo $base_path;?>">Separated link</a></li>
          </ul>
        </li>
        <li class="dropdown <?php if(strpos($_SERVER['SCRIPT_NAME'],'news'))
{ echo 'active'; } ?>">
          <a href="<?php echo $base_path;?>#" class="dropdown-toggle" data-toggle="dropdown">news manager<b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="<?php echo $base_path;?>news/index.php">view all</a></li>
              <li><a href="<?php echo $base_path;?>news/addnews.php">add news</a></li>
              <li><a href="<?php echo $base_path;?>news/index.php?todo=active">active news</a></li>
              <li><a href="<?php echo $base_path;?>news/index.php?todo=inactive">inactive news</a></li>
            <li class="divider"></li>
            
          </ul>
        </li>
        <li class="dropdown <?php if(strpos($_SERVER['SCRIPT_NAME'],'gallery'))
{ echo 'active'; } ?>">
          <a href="<?php echo $base_path;?>#" class="dropdown-toggle" data-toggle="dropdown">gallery manager<b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="<?php echo $base_path;?>gallery/index.php">view all</a></li>
              <li><a href="<?php echo $base_path;?>gallery/addimg.php">add photos</a></li>
             
            <li class="divider"></li>
            
          </ul>
        </li>
        
        <li class="dropdown <?php if(strpos($_SERVER['SCRIPT_NAME'],'img_category'))
{ echo 'active'; } ?>">
          <a href="<?php echo $base_path;?>#" class="dropdown-toggle" data-toggle="dropdown"> image category manager<b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="<?php echo $base_path;?>img_category/index.php">view all</a></li>
              <li><a href="<?php echo $base_path;?>img_category/addcat.php">add category</a></li>
              
            <li class="divider"></li>
            
          </ul>
        </li>
        
        <li class="dropdown <?php if(strpos($_SERVER['SCRIPT_NAME'],'pro_category'))
{ echo 'active'; } ?>">
          <a href="<?php echo $base_path;?>#" class="dropdown-toggle" data-toggle="dropdown"> product category manager<b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="<?php echo $base_path;?>pro_category/index.php">view all</a></li>
              <li><a href="<?php echo $base_path;?>pro_category/addcat.php">add category</a></li>
              
            <li class="divider"></li>
            
          </ul>
        </li>
        
        <li class="dropdown <?php if(strpos($_SERVER['SCRIPT_NAME'],'product'))
{ echo 'active'; } ?>">
          <a href="<?php echo $base_path;?>#" class="dropdown-toggle" data-toggle="dropdown">product manager<b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="<?php echo $base_path;?>product/index.php">view all</a></li>
              <li><a href="<?php echo $base_path;?>product/addproduct.php">add product</a></li>
              
            <li class="divider"></li>
            
          </ul>
        </li>
      </ul>-->

<div class="col-md-33" style="float: right;">
                 <form class="navbar-form navbar-left" role="search" >
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Search" name="keyword" id="keyword">
                                        </div>
                                        <input type="hidden" name="formact" id="formact" value="search">
                                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-save"></span>Submit</button>
                                    </form>
               <div class="hidden-xs logoutInner" style="float: right; margin-top: 5px;">
                   <a href="<?php echo $base_path; ?>logout.php" style="font-size: 15px;" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span></a></div></div>
                   
            
      
    <!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
</div>
<?php  } ?>