<section class="content-header">
    <h1>Edit profile for <?=$user->login?></h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/user"><i class="fa fa-dashboard"></i>All Users</a></li>
        <li class="active">Edit <?=$user->login?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN?>/user/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="login">Login</label>
                            <input type="text" class="form-control" name="login" id="login"
                                   value="<?=htmlSpecialCharsWrapper($user->login)?>"
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
                                   value="<?=htmlSpecialCharsWrapper($user->name)?>"
                                   data-error="Minimum of 4 chars" data-minlength="4"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   value="<?=htmlSpecialCharsWrapper($user->email)?>"
                                   data-error="Bruh, that email address is invalid"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address"
                                   value="<?=htmlSpecialCharsWrapper($user->address)?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="user" <?php if ($user->role == 'user') echo ' selected';?>>User</option>
                                <option value="admin" <?php if ($user->role == 'admin') echo ' selected';?>>Admin</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?=$user->id?>">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
