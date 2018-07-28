<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/user/cabinet">Cabinet</a></li>
                <li>Edit profile</li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->

<div class="prdt">
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-12 prdt-left">
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
                    <h2>Edit profile</h2>
                </div>
                <form action="/user/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="login">Login</label>
                            <input type="text" class="form-control" name="login" id="login"
                                   value="<?=htmlSpecialCharsWrapper($_SESSION['user']['login']);?>"
                                   data-error="Minimum of 4 chars" data-minlength="4"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="If you want change password, enter new password">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   value="<?=htmlSpecialCharsWrapper($_SESSION['user']['name']);?>"
                                   data-error="Minimum of 4 chars" data-minlength="4"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   value="<?=htmlSpecialCharsWrapper($_SESSION['user']['email']);?>"
                                   data-error="Bruh, that email address is invalid"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address"
                                   value="<?=htmlSpecialCharsWrapper($_SESSION['user']['address']);?>"
                            >
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>