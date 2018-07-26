<section class="content-header">
    <h1>Groups of attributes</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Groups of attributes</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="<?=ADMIN?>/filter/group-add" class="btn btn-success"><i class="fa fa-fw fa-plus"></i>Add filters group</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($attr_groups)): ?>
                                <?php foreach ($attr_groups as $attr_group):?>
                                    <tr>
                                        <td><?=$attr_group['title']?></td>
                                        <td>
                                            <a href="<?=ADMIN?>/filter/group-edit?id=<?=$attr_group['id']?>">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                            <a href="<?=ADMIN?>/filter/group-delete?id=<?=$attr_group['id']?>">
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
