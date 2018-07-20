<section class="content-header">
    <h1>Orders of <?=$user->login?></h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/user"><i class="fa fa-dashboard"></i>All Users</a></li>
        <li class="active">Orders of <?=$user->login?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <?php if ($orders):?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orders as $order):?>
                                    <?php $class = $order['status'] ? 'success' : '';?>
                                    <tr class="<?=$class?>">
                                        <td><?=$order['id']?></td>
                                        <td><?=$order['status'] ? 'Closed' : 'New';?></td>
                                        <td><?=$order['sum']?></td>
                                        <td><?=$order['date']?></td>
                                        <td><?=$order['update_at']?></td>
                                        <td>
                                            <a href="<?=ADMIN?>/order/view?id=<?=$order['id']?>">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>

                    <?php else: ?>
                        <h3 class="text-danger">Not any orders</h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
