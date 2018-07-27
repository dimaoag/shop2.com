<section class="content-header">
    <h1>Edit <?=$attribute->value;?> attribute</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/filter/attribute-group"><i class="fa fa-dashboard"></i>Groups of filters</a></li>
        <li><a href="<?=ADMIN?>/filter/attribute"><i class="fa fa-dashboard"></i>Attributes</a></li>
        <li class="active"><?=$attribute->value;?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN?>/filter/attribute-edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="value">Title of attribute</label>
                            <input type="text" name="value" class="form-control" id="value" placeholder="Title"
                                   value="<?=$attribute->value;?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="attr_group_id">Group</label>
                            <select class="form-control" id="attr_group_id" name="attr_group_id" required>
                                <option value="">Choose group</option>

                                <?php if (!empty($groups)): ?>
                                    <?php foreach ($groups as $group):?>
                                        <?php if ($group->id == $attribute->attr_group_id):?>
                                            <option value="<?=$group->id;?>" selected><?=$group->title;?></option>
                                        <?php continue; ?>
                                        <?php endif; ?>
                                        <option value="<?=$group->id;?>"><?=$group->title;?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?=$attribute->id?>">
                        <div class="box-footer">
                            <button class="btn btn-success">Save</button>
                        </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>