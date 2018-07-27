<section class="content-header">
    <h1>Attributes</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/attribute-group"><i class="fa fa-dashboard"></i>Group filters</a></li>
        <li class="active">Attributes</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="<?=ADMIN?>/filter/attribute-add" class="btn btn-success"><i class="fa fa-fw fa-plus"></i>Add attribute</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Group</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($attrs)): ?>
                                <?php foreach ($attrs as $id => $item):?>
                                    <tr>
                                        <td><?=$item['value'];?></td>
                                        <td><?=$item['title'];?></td>
                                        <td>
                                            <a href="<?=ADMIN?>/filter/attribute-edit?id=<?=$id;?>">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                            <a href="<?=ADMIN?>/filter/attribute-delete?id=<?=$id;?>">
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
