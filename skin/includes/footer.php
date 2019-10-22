
    <!-- Java Script -->
    <script>
      var doLogin = <?php if ($currentUser.id >= 1) {echo 1;} else {echo 0;} ?>;
      var basePath = <?php echo "'{$basePath}'"; ?>;
      var translate = [];
      var currencyPrefix = <?php echo "'{$settings['currency']['prefix']}'"; ?>;
      var currencyThousands = <?php echo "'{$settings['currency']['thousands']}'"; ?>;
      var currencyDecimal = <?php echo "'{$settings['currency']['decimal']}'"; ?>;
      var currencyPrecision = <?php echo "'{$settings['currency']['precision']}'"; ?>;
      var currencyNegative = <?php echo "'{$settings['currency']['negative']}'"; ?>;
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo $basePath; ?>js/jquery.min.js"></script>
    <script src="<?php echo $basePath; ?>js/jquery-ui.min.js"></script>
    <script src="<?php echo $basePath; ?>js/popper.min.js"></script>
    <script src="<?php echo $basePath; ?>js/bootstrap.min.js"></script>
    <script defer src=<?php echo "'{$basePath}{$pluginPath}fontawesome/js/all.js'"; ?>></script>
    <script src="<?php echo $basePath; ?>js/sweetalert2.min.js"></script>

    <script src="<?php echo $basePath; ?>js/messages.min.js"></script>
    <script src="<?php echo $basePath; ?>js/main.min.js"></script>
    <script src="<?php echo $basePath; ?>js/plugins.js"></script>

    <div id="toTop" class="float-right" style="display: none;">
      <i class="far fa-arrow-alt-circle-up fa-fw fa-2x"></i>
    </div>

    <?php
    if (empty($currentUser['id'])) {
      ?>
    <div class="modal fade" id="recruitModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <a href="#" class="dismissModal closeIcon" data-dismiss="modal">&times;</a>
        <div class="modal-content">
          <div class="modal-body">
            <div class="modal-text">
              <p class="text-center"><img src="<?php echo $basePath; ?>img/logo.png" height="85" /></p>
              <form id="loginForm" role="form" action="{$basePath}takelogin" method="post" class="form form-horizontal">
                <input type="hidden" name="method" value="login" />
                <input type="hidden" id="goBackLogin" name="goBack" value="<?php echo HTTP_PROTOCOL . "{$_SERVER[HTTP_HOST]}{$_SERVER[REQUEST_URI]}"; ?>" />
                <div class="row">
                  <div class="col-md-3 col-md-offset-1">
                  </div>
                  <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                      <!-- <input class="form-control input-sm" type="email" name="user" id="user" size="20" placeholder="Digite seu email" autocomplete="off" value="julianoeloi1@gmail.com" /> -->
                      <select class="form-control" id="userLogin" name="user">
                        <option selected>Selecione um usuario</option>
                        <option value="julianoeloi1@gmail.com" data-pwd="260478">julianoeloi1@gmail.com</option>
                        <option value="julianoeloi@hotmail.com" data-pwd="20080208">julianoeloi@hotmail.com</option>
                        <option value="julianoeloi@yahoo.com.br" data-pwd="19740617">julianoeloi@yahoo.com.br</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input class="form-control input-sm" type="password" name="password" id="password" size="20" placeholder="Senha" autocomplete="off" value="" />
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-block btn-sm btn-secondary pull-right btn-js" id="doLogin" data-form="loginForm">Logar</button>
                    </div>
                  </div>
                  <div class="col-md-3 col-md-offset-1">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center" id="jsReturn" style="font-size:12px;"></p>
                  </div>
                </div>
              </form>
              <?php
                if ($userRegistration) {
                  ?>
                  <p id="signUpLink" style="font-size:14px; text-align: center">Não tem uma conta? <a href="#" class="abortDT readmore">Inscrever-se</a></p>
                  <?php
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
      <?php
    }
    ?>

  </body>
</html>
