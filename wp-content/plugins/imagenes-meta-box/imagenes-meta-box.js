jQuery(document).ready(function($) {
 
   
 
   $('.img_boton').click(function() {// cuando se hace click en el boton 
      $('html').addClass('Image');
      formfield = $(this).prev('.em_mtbx_img').attr('name');//a
      preview = jQuery(this).siblings('.custom_preview_image');
      tb_show('', 'media-upload.php?type=image&TB_iframe=true');
      return false;
    });
 
   window.original_send_to_editor = window.send_to_editor;
   window.send_to_editor = function(html){
      var fileurl;
      var imgurl
      if (formfield != null) {
        fileurl = $('img',html).attr('src');
        $('#'+formfield).val(fileurl);
        imgurl = jQuery('img',html).attr('src');
        preview.attr('src', imgurl);
        tb_remove();
        $('html').removeClass('Image');
        formfield = null;
       } else {
        window.original_send_to_editor(html);
       }
    };
});

jQuery(document).ready(function($) {
 
   
   $('.img_boton2').click(function() {
      $('html').addClass('Image');
      formfield = $(this).prev('.em_mtbx_img2').attr('name');
      preview = jQuery(this).siblings('.custom_preview_image2');
      tb_show('', 'media-upload.php?type=image&TB_iframe=true');
      return false;
    });
 
   window.original_send_to_editor = window.send_to_editor;
   window.send_to_editor = function(html){
      var fileurl;
      var imgurl
      if (formfield != null) {
        fileurl = $('img',html).attr('src');
        $('#'+formfield).val(fileurl);
        imgurl = jQuery('img',html).attr('src');
        preview.attr('src', imgurl);
        tb_remove();
        $('html').removeClass('Image');
        formfield = null;
       } else {
        window.original_send_to_editor(html);
       }
    };
});

jQuery(document).ready(function($) {
 
   
   $('.img_boton3').click(function() {
      $('html').addClass('Image');
      formfield = $(this).prev('.em_mtbx_img3').attr('name');
      preview = jQuery(this).siblings('.custom_preview_image3');
      tb_show('', 'media-upload.php?type=image&TB_iframe=true');
      return false;
    });
 
   window.original_send_to_editor = window.send_to_editor;
   window.send_to_editor = function(html){
      var fileurl;
      var imgurl
      if (formfield != null) {
        fileurl = $('img',html).attr('src');
        $('#'+formfield).val(fileurl);
        imgurl = jQuery('img',html).attr('src');
        preview.attr('src', imgurl);
        tb_remove();
        $('html').removeClass('Image');
        formfield = null;
       } else {
        window.original_send_to_editor(html);
       }
    };
});

jQuery(document).ready(function($) {
 
   
   $('.img_boton4').click(function() {
      $('html').addClass('Image');
      formfield = $(this).prev('.em_mtbx_img4').attr('name');
      preview = jQuery(this).siblings('.custom_preview_image4');
      tb_show('', 'media-upload.php?type=image&TB_iframe=true');
      return false;
    });
 
   window.original_send_to_editor = window.send_to_editor;
   window.send_to_editor = function(html){
      var fileurl;
      var imgurl
      if (formfield != null) {
        fileurl = $('img',html).attr('src');
        $('#'+formfield).val(fileurl);
        imgurl = jQuery('img',html).attr('src');
        preview.attr('src', imgurl);
        tb_remove();
        $('html').removeClass('Image');
        formfield = null;
       } else {
        window.original_send_to_editor(html);
       }
    };
});

jQuery(document).ready(function($) {
 
   
   $('.img_boton5').click(function() {
      $('html').addClass('Image');
      formfield = $(this).prev('.em_mtbx_img5').attr('name');
      preview = jQuery(this).siblings('.custom_preview_image5');
      tb_show('', 'media-upload.php?type=image&TB_iframe=true');
      return false;
    });
 
   window.original_send_to_editor = window.send_to_editor;
   window.send_to_editor = function(html){
      var fileurl;
      var imgurl
      if (formfield != null) {
        fileurl = $('img',html).attr('src');
        $('#'+formfield).val(fileurl);
        imgurl = jQuery('img',html).attr('src');
        preview.attr('src', imgurl);
        tb_remove();
        $('html').removeClass('Image');
        formfield = null;
       } else {
        window.original_send_to_editor(html);
       }
    };
});

