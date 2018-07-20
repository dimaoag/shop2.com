<section class="content-header">
    <h1>Edit category > <?=htmlSpecialCharsWrapper($category->title);?></h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/category"><i class="fa fa-dashboard"></i>Categories</a></li>
        <li class="active"><?=htmlSpecialCharsWrapper($category->title);?></a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN?>/category/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Title category</label>
                            <input type="text" name="title" value="<?=htmlSpecialCharsWrapper($category->title);?>" class="form-control" id="title" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Parent category</label>
                            <?php new \app\widgets\menu\Menu([
                                'tpl' => WWW . '/menu/menu_add.php',
                                'container' => 'select',
                                'cache' => 0,
                                'cacheKey' => 'admin_add',
                                'attributes' => [
                                    'name' => 'parent_id',
                                    'id' => 'parent_id',
                                ],
                                'class' => 'form-control',
                                'prepend' => '<option value="0">Independent category</option>',
                            ]);?>
                        </div>
                        <div class="form-group">
                            <label for="keywords">Keywords</label>
                            <input type="text" name="keywords" value="<?=htmlSpecialCharsWrapper($category->keywords);?>" class="form-control">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="description">description</label>
                            <input type="text" name="description" value="<?=htmlSpecialCharsWrapper($category->description);?>" class="form-control">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$category->id?>">
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>