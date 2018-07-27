<section class="content-header">
    <h1>Edit <?=$group->title;?> group</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/filter/attribute-group"><i class="fa fa-dashboard"></i>Groups of filters</a></li>
        <li class="active"></a><?=$group->title;?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN?>/filter/group-edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Title group</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title"
                                   value="<?=$group->title;?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <input type="hidden" name="id" value="<?=$group->id;?>">
                        <div class="box-footer">
                            <button class="btn btn-success">Save</button>
                        </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>