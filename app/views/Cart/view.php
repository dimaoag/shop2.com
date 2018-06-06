<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?= PATH ?>">Home</a></li>
                <li>Cart</li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->

<!--prdt-starts-->
<div class="prdt">
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-12">
                <div class="product-one cart">
                    <div class="register-top heading">
                        <h2>Ordering</h2>
                    </div>
                    <br><br>
                    <?php if(!empty($_SESSION['cart'])):?>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Picture</th>
                                    <th>Title</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($_SESSION['cart'] as $id => $item): ?>
                                    <tr>
                                        <td>
                                            <a href="/product/<?=$item['alias'] ?>">
                                                <img src="/images/<?= $item['img'] ?>" alt="<?=$item['title'] ?>">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/product/<?=$item['alias'] ?>"><?=$item['title'] ?></a>
                                        </td>
                                        <td><?=$item['qty'] ?></td>
                                        <td><?= $_SESSION['cart_currency']['symbol_left'] . $item['price'] . $_SESSION['cart_currency']['symbol_right']?></td>
                                        <td><a href="/cart/delete/?id=<?=$id ?>"><span data-id="<?=$id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></a></td>
                                    </tr>
                                <?php endforeach;?>
                                <tr>
                                    <td>Total quantity: </td>
                                    <td colspan="4" class="text-right cart-qty"><?=$_SESSION['cart_qty']?></td>
                                </tr>
                                <tr>
                                    <td>Total sum: </td>
                                    <td colspan="4" class="text-right cart-sum"><?=$_SESSION['cart_currency']['symbol_left'] . $_SESSION['cart_sum'] . $_SESSION['cart_currency']['symbol_right']?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 account-left">
                            <form method="post" action="/cart/checkout" role="form" data-toggle="validator">
                                <?php if(!isset($_SESSION['user'])): ?>
                                    <div class="form-group has-feedback">
                                        <label for="login">Login</label>
                                        <input type="text" name="login" class="form-control" id="login" placeholder="Login"
                                               data-error="Minimum of 4 chars" data-minlength="4"
                                               value="<?= isset($_SESSION['form_data']['login']) ? htmlSpecialCharsWrapper($_SESSION['form_data']['login']) : ''?>" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" data-error="Minimum of 6 chars" data-minlength="6" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                                               data-error="Minimum of 4 chars" data-minlength="4"
                                               value="<?= isset($_SESSION['form_data']['name']) ? htmlSpecialCharsWrapper($_SESSION['form_data']['name']) : ''?>" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email" class="control-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                                               data-error="Bruh, that email address is invalid"
                                               value="<?= isset($_SESSION['form_data']['email']) ? htmlSpecialCharsWrapper($_SESSION['form_data']['email']) : ''?>" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="address" class="control-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="address" placeholder="Address"
                                               value="<?= isset($_SESSION['form_data']['address']) ? htmlSpecialCharsWrapper($_SESSION['form_data']['address']) : ''?>" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="address">Note</label>
                                    <textarea name="note" class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn btn-default">Order</button>
                            </form>
                            <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
                        </div>
                    <?php else: ?>
                        <h3>Cart is empty</h3>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product-end-->