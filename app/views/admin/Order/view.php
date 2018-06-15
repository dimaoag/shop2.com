<section class="content-header">
    <h1>Order № <?=$order['id']?></h1>
    <?php if (!$order['status']):?>
        <a href="<?=ADMIN?>/order/change?id=<?=$order['id']?>&status=1"
           class="btn btn-success btn-xs">Check order</a>
    <?php else: ?>
        <a href="<?=ADMIN?>/order/change?id=<?=$order['id']?>&status=0"
           class="btn btn-default btn-xs">Return for revision</a>
    <?php endif; ?>
    <a href="<?=ADMIN?>/order/delete?id=<?=$order['id']?>"
       class="btn btn-danger btn-xs delete">Delete</a>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/order"><i class="fa fa-dashboard"></i>Orders</a></li>
        <li class="active">Order № <?=$order['id']?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>Number</td>
                                    <td><?=$order['id'];?></td>
                                </tr>
                                <tr>
                                    <td>Created</td>
                                    <td><?=$order['date'];?></td>
                                </tr>
                                <tr>
                                    <td>Date of change</td>
                                    <td><?=$order['update_at'];?></td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td><?=$quantity?></td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><?=$order['sum'];?> <?=$order['currency'];?></td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td><?=$order['name'];?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?=$order['status'] ? 'Closed' : 'New';?></td>
                                </tr>
                                <tr>
                                    <td>Comment</td>
                                    <td><?=$order['note'];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <h3>Details</h3>
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Title</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($order_products as $id => $product): ?>
                                <tr>
                                    <td><?=$product['product_id'];?></td>
                                    <td><?=$product['title'];?></td>
                                    <td><?=$product['qty'];?></td>
                                    <td><?=$product['price'];?></td>
                                    <td><?=$product['qty'] * $product['price'];?> <?=$order['currency'];?></td>
                                </tr>
                            <?php endforeach; ?>
                                <tr class="active">
                                    <td colspan="4">
                                        <b>Total:</b>
                                    </td>
                                    <td>
                                        <?=$order['sum'];?> <?=$order['currency'];?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
