<section class="content-header">
    <h1>All Users</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/user"><i class="fa fa-dashboard"></i>Users</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Login</th>
                                <th>Email</th>
                                <th>Orders</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user):?>
                                <tr>
                                    <td><?=$user->id?></td>
                                    <td><?=$user->name?></td>
                                    <td><?=$user->login?></td>
                                    <td><?=$user->email?></td>
                                    <td>
                                        <a href="<?=ADMIN?>/user/orders?id=<?=$user->id?>">
                                            Orders
                                        </a>
                                    </td>
                                    <td><?=$user->role?></td>
                                    <td>
                                        <a href="<?=ADMIN?>/user/edit?id=<?=$user->id?>">
                                            <i class="fa fa-fw fa-edit"></i>
                                        </a>
                                        <a href="<?=ADMIN?>/user/delete?id=<?=$user->id?>">
                                            <i class="fa fa-fw fa-user-times delete text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-content">
                        <p><?=count($users);?> user(s) of <?=$count?></p>
                        <?php if ($pagination->getCountPages() > 1):?>
                            <?=$pagination?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
