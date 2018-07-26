<section class="content-header">
    <h1>Add group</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/filter/attribute-group"><i class="fa fa-dashboard"></i>Groups of filters</a></li>
        <li class="active">New group filters</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN?>/filter/group-add" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Title group</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    <div class="box-footer">
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>