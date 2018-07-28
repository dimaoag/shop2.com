<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/user/cabinet">Cabinet</a></li>
                <li>Orders</li>
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
                    <h2>Orders</h2>
                </div>
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
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orders as $order):?>
                                    <?php
                                    if ($order->status == 1){
                                        $class = 'success';
                                        $text = 'Closed';
                                    } elseif ($order->status == 2){
                                        $class = 'info';
                                        $text = 'Payment';
                                    } else {
                                        $class = '';
                                        $text = 'New';
                                    }
                                    ?>
                                    <tr class="<?=$class?>">
                                        <td><?=$order->id;?></td>
                                        <td><?=$text?></td>
                                        <td><?=$order->sum;?> <?=$order->currency;?></td>
                                        <td><?=$order->date;?></td>
                                        <td><?=$order->update_at;?></td>
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
</div>