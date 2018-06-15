<section class="content-header">
    <h1>All Orders</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/order"><i class="fa fa-dashboard"></i>Orders</a></li>
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
                                    <th>ID</th>
                                    <th>Customer</th>
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
                                    <td><?=$order['name']?></td>
                                    <td><?=$order['status'] ? 'Closed' : 'New';?></td>
                                    <td><?=$order['sum']?></td>
                                    <td><?=$order['date']?></td>
                                    <td><?=$order['update_at']?></td>
                                    <td>
                                        <a href="<?=ADMIN?>/order/view?id=<?=$order['id']?>">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                        <a href="<?=ADMIN?>/order/delete?id=<?=$order['id']?>">
                                            <i class="fa fa-fw fa-trash-o delete text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-content">
                        <p><?=count($orders);?> order(s) of <?=$count?></p>
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
