<div>
<?php
if ($pageControl == 'list') {
  ?>
  <div class="row">
    <div class="col-sm-2 col-md-3 col-lg-4">
      <ul id="subCategoria" class="nav flex-column nav-pills">
        <?php
        foreach ($parentTags as $key => $value) {
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link searchProduto abortDT" id="navLinkID<?php echo $value['id']; ?>" data-id='<?php echo $value['id']; ?>' data-parent='<?php echo $value['parent_id']; ?>' data-nname='<?php echo $value['normal_name']; ?>'><?php echo $value['name']; ?></a>
          </li>
          <?php
        }
        ?>
      </ul>
    </div>
    <div id="exibeProdutos" class="col" data-spy="scroll" data-offset="0">
      <div class="row">
        <?php
        foreach ($produtosRelation['data'] as $key => $value) {
          if ($value['data']['thumbnail']) {
            $imageFile = "{$basePath}{$value['data']['thumbnail']}";
          } else {
            $imageFile = "{$basePath}{$imagePath}default_image.png";
          }
          ?>
          <div class="col-sm-3 imageSlot media<?php echo $value['data']['id']; ?>" id="gl_picture_<?php echo $value['data']['image_id']; ?>" data-picture="<?php echo $value['data']['image_id']; ?>" data-media="<?php echo $value['data']['id']; ?>">

            <a href="<?php echo "{$basePath}produtos/{$value['data']['normal_name']}"; ?>" class="imageDetails imgBox" data-gallery="<?php echo $value['data']['thumbnail']; ?>" data-related="<?php echo $value['data']['image_id']; ?>">
              <img id="gal_image_<?php echo $value['data']['image_id']; ?>" src="<?php echo $imageFile; ?>" class="img-thumbnail rounded" />

              <p class="text-truncateX" data-toggle="tooltip" data-placement="bottom" title="<?php echo $value['data']['name']; ?>"><?php echo $value['data']['name']; ?></p>
              <p class="price text-center"><?php echo $value['data']['translation']['price']; ?></p>
            </a>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>
<form id="searchProduto">
  <input type="hidden" name="theForm" value="searchProduto"  />
  <input type="hidden" name="tagID" id="tagID" />
  <input type="hidden" name="masterID" id="masterID" />
  <input type="hidden" name="normal_name" id="tagNormalName" />
</form>
  <?php
} else {
  ?>
  <div class="row">
    <div class="col-sm-12 col-lg-5">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php
        foreach ($produto['gallery']['pictures'] as $key => $value) {
          if ($key == 0) {
            $classCss = ' class="active"';
          } else {
            $classCss = "";
          }
          ?>
          <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $value['id']; ?>"<?php echo $classCss; ?> ></li>
          <?php
        }
        ?>
      </ol>
      <div class="carousel-inner">

        <?php
        foreach ($produto['gallery']['pictures'] as $key => $value) {
          if ($key == 0) {
            $classCss = ' active"';
          } else {
            $classCss = "";
          }
          if ($value['resizes']['w480h480']) {
            $imageFile = "{$basePath}{$value['resizes']['w480h480']}";
          } else {
            $imageFile = "{$basePath}{$imagePath}default_image.png";
          }
          ?>
          <div class="carousel-item<?php echo $classCss; ?>">
            <img src="<?php echo $imageFile; ?>" class="img-fluid img-thumbnail rounded" alt="...">
          </div>
          <?php
        }
        ?>

      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    </div>
    <div class="col-sm-12 col-lg-4">
      <h3><?php echo $produto['name']; ?></h3>
      <br />
      <?php echo $produto['translation']['standfirst']; ?>
    </div>
    <div class="col-sm-12 col-lg-3">
      <h4 id="viewerPrice" class="text-center price"><?php echo $produto['translation']['price']; ?></h4>
      <?php
      if ($produto['translation']['stock'] >= 1) {
        ?>
        <p class="text-center">
        <form id="addCartForm" method="POST" action="<?php echo $basePath; ?>carrinho">
          <input type="hidden" name="contentID" value="<?php echo $produto['id']; ?>" />
          <input type="hidden" name="price" value="<?php echo $produto['translation']['price']; ?>" />
          <input type="hidden" name="theForm" value="addCart" />
          <input type="hidden" name="image" value="<?php echo $produto['thumbnail']; ?>" />
          <input type="hidden" name="produto" value="<?php echo $produto['name']; ?>" />
          <input type="hidden" name="normal_name" value="<?php echo $produto['normal_name']; ?>" />

          <div class="form-group row">
            <label for="qtdPrd" class="col-4 col-form-label">Quantidade</label>
            <div class="col-4">
              <input type="text" id="qtdPrd" name="quantidade" value="1" class="form-control form-control-sm validate" maxlength="4" required />
            </div>
          </div>

          <button type="button" class="btn btn-warning btn-sm" id="addCartBtn" >
            <i class="fas fa-shopping-cart fa-fw"></i> Adcionar ao carrinho
          </button>
        </form>
        </p>
        <?php
      } else {
        ?>
        <p class="text-center">
          <strong class="text-danger">Produto esgotado</strong>
          <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            Avise-me quando chegar:
            <form id="aviseMe">
              <div class="form-group">
                <label for="userName">Nome</label>
                <input type="text" id="userName" name="nome" class="form-control form-control-sm validate" maxlength="15" required />
              </div>

              <div class="form-group">
                <label for="userMail">Email</label>
                <input type="email" id="userMail" name="email" class="form-control form-control-sm validate" maxlength="50" required />
              </div>

              <div class="form-group">
                <button type="button" class="btn btn-danger btn-sm" id="aviseMeBtn">
                  Avise-me
                </button>
              </div>
            </form>
          </nav>
        </p>
        <?php
      }
      ?>
    </div>
  </div>
  <br />
  <div class="row">
    <div class="col">
      <!-- <pre>
        <?php print_r($produto); ?>
      </pre> -->
      <?php echo $produto['translation']['description']; ?>
    </div>
  </div>
  <br />
  <div class="row">
    <div class="col">
      <?php echo $produto['translation']['specifications']; ?>
    </div>
  </div>
  <?php
}
?>
