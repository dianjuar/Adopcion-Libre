jQuery(document).ready(function($) {
 
   var formfield = null;
 
   $('.img_boton3').click(function() {
      $('html').addClass('Image');
      formfield = $(this).prev('.em_mtbx_img').attr('name');
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
