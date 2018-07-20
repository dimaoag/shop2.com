<section class="content-header">
    <h1>Clear cache</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Clear cache</li>
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
                                <th>Name cache</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cache category</td>
                                    <td>Menu categories on site. Time cache 1 hour</td>
                                    <td>
                                        <a href="<?=ADMIN?>/cache/delete?key=category">
                                            <i class="fa fa-fw fa-trash-o delete text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cache filter</td>
                                    <td>Filters on site. Time cache 1 hour</td>
                                    <td>
                                        <a href="<?=ADMIN?>/cache/delete?key=filter">
                                            <i class="fa fa-fw fa-trash-o delete text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
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
