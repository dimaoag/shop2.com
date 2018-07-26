<section class="content-header">
    <h1>All Products</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/product"><i class="fa fa-dashboard"></i>Products</a></li>
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
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($products as $product):?>
                                <tr>
                                    <td><?=$product['id']?></td>
                                    <td><?=$product['title']?></td>
                                    <td><?=$product['title_category']?></td>
                                    <td>$<?=$product['price']?></td>
                                    <td>
                                        <?= $product['status'] ? 'Active' :  'Disabled';?>
                                    </td>
                                    <td>
                                        <a href="<?=ADMIN?>/product/edit?id=<?=$product['id']?>">
                                            <i class="fa fa-fw fa-edit"></i>
                                        </a>
                                        <a href="<?=ADMIN?>/product/delete?id=<?=$product['id']?>">
                                            <i class="fa fa-fw fa-trash-o delete text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-content">
                        <p><?=count($products);?> product(s) of <?=$count?></p>
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
