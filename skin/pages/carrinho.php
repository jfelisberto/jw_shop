<?php
if ($currentUser['id']) {
  switch ($_POST['theForm']) {
    case 'addCart':
      if ($requestUser['status'] = 'success') {
        ?>

        <div class="row">
          <div class="col">
            <h4>Produto adcionado com sucesso ao carrinho</h4>
          </div>
        </div>

        <div class="row">
          <div class="col-2">
            <img src="<?php echo $imageFile; ?>" width="85px" class="img-fluid img-thumbnail rounded" alt="...">
          </div>
          <div class="col">
            <h6 class="align-middle text-left"><?php echo $name; ?></h6>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <a href="<?php echo $basePath; ?>" class="text-decoration-none">Continuar comprando</a>
          </div>
        </div>

        <?php
      } else {
        ?>
        <h5 class="text-danger"><?php echo $result['message']; ?></h5>
        <?php
      }
      break;

    case 'remCart':
      break;

    default:
      ?>
      <h2>Meu carrinho</h2>
      <div class="row">
        <div class="col-12">
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Produto</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Prazo</th>
            <th scope="col">Valor unitário</th>
            <th scope="col">Valor total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($requestUser['products'] as $key => $value) {
            ?>
            <tr>
              <td>
                <div class="row">
                  <div class="col-2">
                    <img src="<?php echo "{$basePath}{$value['image']}"; ?>" width="85px" class="img-fluid img-thumbnail rounded" alt="...">
                  </div>
                  <div class="col">
                    <p class="align-middle text-left"><?php echo $value['name']; ?></p>
                  </div>
                </div>
              </td>
              <td>
                <?php echo $value['quantidade']; ?>
              </td>
              <td>
              </td>
              <td>
                <input type="hidden" name="price" value="<?php echo $value['price']; ?>" />
                Pro: <?php echo pricetValue($value['price']); ?>
              </td>
              <td>
                <input type="hidden" name="amount" value="<?php echo $value['amount']; ?>" />
                <?php echo pricetValue($value['amount']); ?>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-8">&nbsp;</div>
        <div class="col-2 bg-light">
          Subtotal dos produtos
        </div>
        <div class="col-2 bg-light">
          <p class="text-right">
            <?php echo pricetValue($requestUser['payment_value']); ?>
          </p>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-8">&nbsp;</div>
        <div class="col-2 bg-light">
          Subtotal frete
        </div>
        <div class="col-2 bg-light">
          <p class="text-right">
            <?php echo pricetValue($requestUser['payment_freight']); ?>
          </p>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-8">&nbsp;</div>
        <div class="col-2 bg-secondary">
          <strong>Valor Total</strong>
        </div>
        <div class="col-2 bg-secondary">
          <p class="text-right">
            <strong><?php echo pricetValue($requestUser['payment_amount']); ?></strong>
          </p>
        </div>
      </div>

      <?php
      break;
  }
} else {
  ?>
  Não ha produtos em seu carrinho.<br />
  Faça o login para realizar suas compras.
  <?php
}
