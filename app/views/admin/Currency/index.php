<section class="content-header">
    <h1>Currencies</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Currencies</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="<?=ADMIN?>/currency/add" class="btn btn-success"><i class="fa fa-fw fa-plus"></i>Add currency</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Code</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($currencies)): ?>
                                <?php foreach ($currencies as $currency):?>
                                    <tr>
                                        <td><?=$currency->id;?></td>
                                        <td><?=$currency->title;?></td>
                                        <td><?=$currency->code;?></td>
                                        <td><?=$currency->value;?></td>
                                        <td>
                                            <a href="<?=ADMIN?>/currency/edit?id=<?=$currency->id;?>">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                            <a href="<?=ADMIN?>/currency/delete?id=<?=$currency->id;?>">
                                                <i class="fa fa-fw fa-trash-o delete text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>