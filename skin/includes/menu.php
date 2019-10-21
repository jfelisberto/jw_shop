<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <a href="<?php echo $basePath; ?>">
    <img src="<?php echo "{$basePath}img/logo.png"; ?>" class="rounded float-left" height="75" />
  </a>
  <a class="navbar-brand abortDT" href="#">&nbsp;</a>
  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu" aria-expanded="false" aria-controls="navbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div id="navbarMenu" class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <?php
      foreach ($tags as $key => $value) {
        ?>
        <li class="nav-item">
          <div class="btn-group form-login text-center">
            <a class="btn btn-sm btn-default" href=<?php echo "{$basePath}produtos?search={$value['normal_name']}"; ?>>
              <i class="fas <?php echo $value['thumbnail']; ?> fa-fw fa-2x"></i><br />
              <?php echo $value['name']; ?>
            </a>
          </div>
        </li>
        <?php
      }
      ?>

      <li class="nav-item">
      <form class="form-inline">
        <div class="input-group mb-3">
          <input id="searchPrd" name="term" class="form-control" type="search" placeholder="Busca" aria-label="Busca">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="button-search">Buscar</button>
          </div>
        </div>
      </form>
      </li>

      <li class="nav-item">
        <?php
        if ($currentUser['id'] >= 1) {
          if ($currentUser['gender'] == 'F') {
            $imageFile = "{$basePath}{$imagePath}default-female.jpg";
          } else {
            $imageFile = "{$basePath}{$imagePath}default-male.jpg";
          }
          ?>
          <ul class="nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $imageFile; ?>" width="40px" class="img-fluid img-thumnail rounded" /></a>
              <div class="dropdown-menu">
                <a class="dropdown-item abortDT" href="#">Meu perfil</a>
                <a class="dropdown-item abortDT" href="#">Meus pedidos</a>
                <a class="dropdown-item abortDT" href="#">Meus favoritos</a>
                <a class="dropdown-item" href="<?php echo "{$basePath}logout"; ?>">Logout
                </div>
              </a>
            </li>
          </ul>
          <?php
        } else {
          ?>
          <a id="openLogin" class="btn btn-sm btn-default openLogIn abortDT" href="#">
            <i class="far fa-user-circle fa-fw fa-2x"></i><br />Login
          </a>
          <?php
        }
        ?>
      </li>

      <li class="nav-item">
        <a class="btn btn-sm btn-default" href="<?php echo "{$basePath}carrinho"; ?>">
          <i class="fab fa-opencart fa-fw fa-2x"></i><br />Carrinho
        </a>
      </li>
    </ul>

    </span>
  </div>
</nav>
