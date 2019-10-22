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
      <h2 class="text-left">Meu carrinho</h2>
      <table class="table table-borderless">
        <tbody>
          <td>
            <a href="<?php echo $basePath; ?>" class="btn btn-info btn-sm float-left" role="button">Continuar comprando</a>
          </td>
          <td>
            <a href="<?php echo $basePath; ?>" class="btn btn-danger btn-sm float-right abortDT" role="button">Concluir a compra</a>
          </td>
        </tbody>
      </table>
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

      <table class="table table-borderless">
        <tbody>
          <tr>
            <td colspan="3" width="65%"></td>
            <td class="table-info">
              <p class="text-right">
                Subtotal dos produtos
              </p>
            </td>
            <td class="table-info">
              <p class="text-right">
                <?php echo pricetValue($requestUser['payment_value']); ?>
              </p>
            </td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td class="table-info">
              <p class="text-right">
                Subtotal frete
              </p>
            </td>
            <td class="table-info">
              <p class="text-right">
                <?php echo pricetValue($requestUser['payment_freight']); ?>
              </p>
            </td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td class="table-secondary">
              <p class="text-right">
                <strong>Valor Total</strong>
              </p>
            </td>
            <td class="table-secondary">
              <p class="text-right">
                <strong><?php echo pricetValue($requestUser['payment_amount']); ?></strong>
              </p>
            </td>
          </tr>
        </tbody>
      </table>

      <table class="table table-borderless">
        <tbody>
          <tr>
            <td>
              <a href="<?php echo $basePath; ?>" class="btn btn-info btn-sm float-left" role="button">Continuar comprando</a>
            </td>
            <td>
              <a href="<?php echo $basePath; ?>" class="btn btn-danger btn-sm float-right abortDT" role="button">Concluir a compra</a>
            </td>
          </tr>
        </tbody>
      </table>

      <?php
      break;
  }
} else {
  ?>
  Não ha produtos em seu carrinho.<br />
  Faça o login para realizar suas compras.
  <?php
}
