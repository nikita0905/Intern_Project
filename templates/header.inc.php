<header id="head">
    <div class="container bgred" >
        <div class="row">
            <div class="col-md-50" id="left">
                <h1> web page </h1>   
            </div>
            <div class="col-md-50">

            </div>
        </div>
    </div>
</header>

<div class="container margin">
    <div class="row margin">
        <nav class="navbar navbar-inverse margin" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nikita1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">
                        <span class="glyphicon glyphicon-home">

                        </span>
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse nikita1" id="nikita">
                    <div>
                        <ul class="nav navbar-nav">
                            <?php
                            foreach ($objpage->menu as $key => $val) {
                               
                                ?>
                            <li class="<?php echo isset($val['submenu'])? 'dropdown':''; ?>">
                                    <a href="<?php echo $base_path; ?>index.php?action=<?php echo $val['link']; ?>"   class="<?php echo isset($val['submenu'])? 'dropdown-toggle':''; ?>" data-toggle="<?php echo isset($val['submenu'])? 'dropdown':''; ?>"> <?php echo $val['menu'] ?>
                                        
                                    </a>
                                <?php if(isset($val['submenu'])){ ?>
                                <ul class="dropdown-menu">
                                    <li>
                                       <a href="<?php echo $base_path; ?>index.php?action=<?php echo $val['link']; ?>"> <?php echo $val['menu'] ?>
                                        
                                    </a> 
                                    </li>
                                    <?php foreach($val['submenu'] as $subkey=>$subvalue){ ?>
                                    <li>
                                       <a href="<?php echo $base_path; ?>index.php?action=<?php echo $subvalue['link']; ?>" > <?php echo $subvalue['menu'] ;?>
                                        
                                    </a> 
                                    </li>
                                    <?php } ?>
                                </ul>
                                <?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>