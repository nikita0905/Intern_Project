<?php

set_include_path(get_include_path().PATH_SEPARATOR
        .'includes/'.PATH_SEPARATOR
        .'templates/'.PATH_SEPARATOR
        );
        require 'config.php';
        require_once 'page.class.php';
        $action =(isset($_GET['action']) && $_GET['action']!='')?filter_input(INPUT_GET,'action',FILTER_SANITIZE_SPECIAL_CHARS):'home';
        
        
        $objpage = new page($action);
        
        
        require_once $objpage->template_name.'.php';