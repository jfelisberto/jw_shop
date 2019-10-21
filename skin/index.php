<div>
  <div id="exibeProdutos" class="col" data-spy="scroll" data-offset="0">
    <div class="row">
      <?php
      foreach ($listaProdutos as $key => $value) {
        if ($value['thumbnail']) {
          $imageFile = "{$basePath}{$value['thumbnail']}";
        } else {
          $imageFile = "{$basePath}{$imagePath}default_image.png";
        }
        ?>
        <div class="col-sm-3 imageSlot media<?php echo $value['id']; ?>" id="gl_picture_<?php echo $value['image_id']; ?>" data-picture="<?php echo $value['image_id']; ?>" data-media="<?php echo $value['id']; ?>">

          <a href="<?php echo "{$basePath}produtos/{$value['normal_name']}"; ?>" class="imageDetails imgBox" data-gallery="<?php echo $value['thumbnail']; ?>" data-related="<?php echo $value['image_id']; ?>">
            <img id="gal_image_<?php echo $value['image_id']; ?>" src="<?php echo $imageFile; ?>" class="img-thumbnail rounded" />

            <p class="text-truncateX" data-toggle="tooltip" data-placement="bottom" title="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></p>
            <p class="price text-center"><?php echo $value['translation']['price']; ?></p>
          </a>
        </div>
        <?php
      }
      ?>
    </div>
  </div>

</div>
