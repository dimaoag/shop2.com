<section class="content-header">
    <h1>Add new user</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/user"><i class="fa fa-dashboard"></i>Users</a></li>
        <li class="active">Add new user</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    <div class="register-main">
                        <div class="col-md-6 account-left">
                            <form method="post" action="/user/signup" id="signup" data-toggle="validator" role="form">
                                <div class="form-group has-feedback">
                                    <label for="login">Login</label>
                                    <input type="text" name="login" class="form-control" id="login" placeholder="Login"
                                           data-error="Minimum of 4 chars" data-minlength="4"
                                           value="<?= isset($_SESSION['form_data']['login']) ? htmlSpecialCharsWrapper($_SESSION['form_data']['login']) : ''?>"
                                           required>
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
                                           value="<?= isset($_SESSION['form_data']['address']) ? htmlSpecialCharsWrapper($_SESSION['form_data']['address']) : ''?>">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control" required>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save new user</button>
                            </form>
                            <?php if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
