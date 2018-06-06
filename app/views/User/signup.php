<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li>Registration</li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->

<div class="prdt">
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-12">
                <div class="product-one signup">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['errors']; unset($_SESSION['errors']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="register-top heading">
                        <h2>REGISTRATION</h2>
                    </div>
                    <div class="register-main">
                        <div class="col-md-6 account-left">
                            <form method="post" action="/user/signup" id="signup" data-toggle="validator" role="form">
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
                                <button type="submit" class="btn btn-default">Registration</button>
                            </form>
                            <?php if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>