 <footer id="f">
            <div class="container bgred footerinner">
                <div class="row">
                <div class="col-md-65"></div>
                <div class="col-md-35">
                    <div class="collapse navbar-collapse nikita1" id="nikita">
        <div>
      <ul class="nav navbar-nav">
          <?php foreach($objpage->footer as $key=>$val){ ?>
                <li>
          <a href="<?php echo $base_path;?>index.php?action=<?php echo $val['link']; ?>" class="black"> <?php echo $val['footer'] ?></a>
          </li>
          <?php } ?>
          </ul>
        
            
        </div>
    </div>
                </div>
            </div>
                </div>
        </footer>
