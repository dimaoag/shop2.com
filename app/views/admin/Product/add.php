<section class="content-header">
    <h1>Add new product</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/product">Products</a></li>
        <li class="active">Add new product</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    <div class="register-main">
                        <div class="col-md-6 account-left">
                            <form method="post" action="<?=ADMIN?>/product/add" data-toggle="validator" role="form">
                                <div class="form-group has-feedback">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title"
                                           data-error="Minimum of 4 chars" data-minlength="4"
                                           value="<?= isset($_SESSION['form_data']['title']) ? htmlSpecialCharsWrapper($_SESSION['form_data']['title']) : ''?>"
                                           required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <?php new \app\widgets\menu\Menu([
                                        'tpl' => WWW . '/menu/menu_add.php',
                                        'container' => 'select',
                                        'cache' => 0,
                                        'cacheKey' => 'admin_add',
                                        'attributes' => [
                                            'name' => 'category_id',
                                            'id' => 'category_id',
                                        ],
                                        'class' => 'form-control',
                                        'prepend' => '<option>Choose category</option>',
                                    ]);?>
                                </div>
                                <div class="form-group">
                                    <label for="keywords">Keywords</label>
                                    <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Keywords"
                                           value="<?= isset($_SESSION['form_data']['keywords']) ? htmlSpecialCharsWrapper($_SESSION['form_data']['keywords']) : ''?>">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" class="form-control" id="description" placeholder="Description"
                                           value="<?= isset($_SESSION['form_data']['description']) ? htmlSpecialCharsWrapper($_SESSION['form_data']['description']) : ''?>">
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" class="form-control" id="price"
                                           pattern="^[0-9.]{1,}$"
                                           data-error="Only numbers and dot"
                                           value="<?= isset($_SESSION['form_data']['price']) ? htmlSpecialCharsWrapper($_SESSION['form_data']['price']) : ''?>"
                                           required>
                                           <!-- От начала до кокца строки принимаеи только цыфри и точка, и один и больше символов -->
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="old_price">Old price</label>
                                    <input type="text" name="old_price" class="form-control" id="old_price"
                                           pattern="^[0-9.]{1,}$"
                                           data-error="Only numbers and dot"
                                           value="<?= isset($_SESSION['form_data']['old_price']) ? htmlSpecialCharsWrapper($_SESSION['form_data']['old_price']) : ''?>">
                                    <!-- От начала до кокца строки принимаеи только цыфри и точка, и один и больше символов -->
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" rows="20" id="editor1" name="content"
                                              value="<?= isset($_SESSION['form_data']['content']) ? htmlSpecialCharsWrapper($_SESSION['form_data']['content']) : ''?>"></textarea>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="brand">Brand</label>
                                    <select class="form-control" id="brand" name="brand_id" required>
                                        <option value="">Choose brand</option>

                                        <?php if (!empty($brands)): ?>
                                            <?php foreach ($brands as $id => $title):?>
                                                <option value="<?=$id?>"><?=$title?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="status" checked> Status
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="hit"> New
                                    </label>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                            <?php if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
