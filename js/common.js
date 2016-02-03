/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function deleteRec(){
    if(confirm("Are you sure you want to delete")){
        return true;
    }else{
        return false;
    }
}

jQuery(document).ready(function(){
    jQuery('.checkAll').on('click',function(){
        if(jQuery(this).prop('checked')){
            jQuery('.checkrec').prop('checked',true);
        }else{
            jQuery('.checkrec').prop('checked',false);
        }
    });
    
    jQuery('#deleteAll').on('click',function(){
 var checkedAtLeastOne = false;
jQuery('.checkrec').each(function(){
    if (jQuery(this).is(":checked")){
        checkedAtLeastOne = true;
    }
});

if(checkedAtLeastOne){
    if(confirm('Are you sure you want to delete record!?')){
  

    jQuery('#formact').val('del');
    jQuery('#frm').submit();
    }
}else{
    alert('please select atleast one record');
}
    });
    jQuery('.istopmenu').on('click',function(){
        if(jQuery(this).val() == '1')
        {
            jQuery("#top_menu").show();
        }
        else
        {
            jQuery("#top_menu").hide();
        }
    });
    
    jQuery('.isfootermenu').on('click',function(){
        if(jQuery(this).val() == '1')
        {
            jQuery("#footer_menu").show();
        }
        else
        {
            jQuery("#footer_menu").hide();
        }
    });
    
 

$('#cssmenu ul ul li:odd').addClass('odd');
$('#cssmenu ul ul li:even').addClass('even');

$('#cssmenu > ul > li > a').click(function() {

  var checkElement = $(this).next();

  $('#cssmenu li').removeClass('active');
  $(this).closest('li').addClass('active'); 

  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    $(this).closest('li').removeClass('active');
    checkElement.slideUp('normal');
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    $('#cssmenu ul ul:visible').slideUp('normal');
    checkElement.slideDown('normal');
  }

  if($(this).closest('li').find('ul').children().length == 0) {
    return true;
  } else {
    return false; 
  }

});
    
    
});

function deleteAjx(obj)
{
    jQuery.ajax({
        type:"POST",
        url:"ajax.php",
        data: {id:obj, todo:'delete'},
        dataType: 'html',
        success:function(data){
           // alert(data);
           if(data === 'success'){   //triple === checks the type of the text too
               jQuery('#rid'+obj).remove();
           }
        },
        error:function(){
            alert("error occured");
        }
    });
}

function getuserdetails(obj)
{
    jQuery("#ld"+obj).html('<img src="xampp.gif"/>');
    
    jQuery.ajax({
        type:"POST",
        url:"ajax.php",
        data: {id:obj, todo:'view'},
        dataType: 'html',
        success:function(data){
               jQuery("#ld"+obj).html('');
               jQuery('.userdetailstext').html('');
               jQuery('.userdetailstext').html(data);
                jQuery('#myModal').modal('toggle');
           
        },
        error:function(){
            alert("error occured");
        }
    });
}

