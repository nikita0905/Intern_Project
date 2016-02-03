<?php
class page{
    public $meta;
    public $content;
    public $template_name;
    public $menu=array();
    public $footer=array();
    function __construct($page){
        
       $this->getMeta($page);
       $this->getContent($page);
       $this->getTemplate($page);
       $this->getMenu();
       $this->getFooter();
}

function getMeta($page){
    $rs=  mysql_query("select `page_title`,`meta_keyword`,`meta_description` from `pages` where `status`='1' and `title`='".$page."'")or die(mysql_error());
    $row=  mysql_fetch_array($rs);
    $this->meta .="<title>".$row['page_title']."</title>";
    $this->meta .="<meta name=\"keywords\" content=\"".$row['meta_keyword']."\">";
    $this->meta .="<meta name=\"description\" content=\"".$row['meta_description']."\">";
    //return $this->meta;
}

function getContent($page){
    $rs=  mysql_query("select `description` from `pages` where `status`='1' and `title`='".$page."'");
    $row=  mysql_fetch_array($rs);
    $this->content .=$row['description'];
    
    //return $this->meta;
}

function getTemplate($page){
    $rs=  mysql_query("select `template_name` from `pages` where `status`='1' and `title`='".$page."'");
    $row=  mysql_fetch_array($rs);
    $this->template_name .=$row['template_name'];
    
    //return $this->meta;
}

function getMenu(){
    $rs=  mysql_query("select `id`,`top_menu_name`,`parent_id`,`title` from `pages` where `status`='1' and `is_top_menu`= '1' and `parent_id`=0");
    $i=0;
   
    while($row=  mysql_fetch_array($rs)){
        
        $this->menu[$i]['menu']=$row['top_menu_name'];
        $this->menu[$i]['link']=$row['title'];
        
        $rsSubMenu=  mysql_query("select `top_menu_name`,`title` from `pages` where `status`='1' and `is_top_menu`='1' and `parent_id`='".$row['id']."'");
        $j=0;
        while($rowSubMenu = mysql_fetch_array($rsSubMenu)){
           $this->menu[$i]['submenu'][$j]['menu']=$rowSubMenu['top_menu_name'];
        $this->menu[$i]['submenu'][$j]['link']=$rowSubMenu['title'];
        $j++; 
    }
    $i++;
    }
    
}

function getFooter(){
    $rs=  mysql_query("select `footer_menu_name`,`title` from `pages` where `status`='1' and `is_footer_menu`= '1'");
    $j=0;
    while($row =  mysql_fetch_array($rs)){
        $this->footer[$j]['footer']=$row['footer_menu_name'];
        $this->footer[$j]['link']=$row['title'];
        $j++;
    }
    
}
}