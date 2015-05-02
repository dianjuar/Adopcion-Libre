<div class="affix-top" id="Affix" data-spy="affix">
  <?php if($user_ID){ ?>

    <a id="btn-dar" href="<?php echo admin_url( 'edit.php?post_type=post&mode=list', 'http' ); ?>" class="btn">Dar en adopcion</a>
  <?php }
   ?>

  <?php 
    if (!function_exists('dynamic_sidebar') || 
          !dynamic_sidebar('servicio-002')) : ?>
  <?php endif; ?>
  <form class="form-inline BoxSearch">
    <h4>Buscar:</h4>
    <div class="form-group">
      <div class="radio">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
          Perros
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
          Gatos
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
          Otro
        </label>
      </div>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Raza">
    </div>
    <button type="submit" class="btn">Buscar <span class="glyphicon glyphicon-search"></span></button>
  </form>
</div>