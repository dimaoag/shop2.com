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
                                <div class="form-group">
                                    <label for="related">Related products</label>
                                    <select name="related[]" id="related" class="form-control select2" multiple>

                                    </select>
                                </div>

                                <?php new \app\widgets\filter\Filter(null, WWW . '/filter/admin_filter_tpl.php'); ?>

                                <div class="form-group">
                                    <div class="col-md-4">
                                        <div class="box box-danger box-solid file-upload">
                                            <div class="box-header">
                                                <h3 class="box-title">Base image</h3>
                                            </div>
                                            <div class="box-body">
                                                 <div id="single" class="btn btn-success" data-url="/product/add-image" data-name="single">
                                                     Choose image
                                                 </div>
                                                <p>
                                                    <small>
                                                    Recommended size:
                                                    <?=\shop2\App::$app->getProperty('img_width'); ?>
                                                     x
                                                    <?=\shop2\App::$app->getProperty('img_height'); ?>
                                                    </small>
                                                </p>
                                                <div class="single"></div>
                                            </div>
                                            <div class="overlay">
                                                <i class="fa fa-refresh fa-spin"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="box box-primary box-solid file-upload">
                                            <div class="box-header">
                                                <h3 class="box-title">Gallery for product</h3>
                                            </div>
                                            <div class="box-body">
                                                <div id="multi" class="btn btn-success" data-url="product/add-image" data-name="multi">
                                                    Choose images
                                                </div>
                                                <p>
                                                    <small>
                                                        Recommended size:
                                                        <?=\shop2\App::$app->getProperty('gallery_with'); ?>
                                                        x
                                                        <?=\shop2\App::$app->getProperty('gallery_height'); ?>
                                                    </small>
                                                </p>
                                                <div class="multi"></div>
                                            </div>
                                            <div class="overlay">
                                                <i class="fa fa-refresh fa-spin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label>Modification product</label>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label for="in_color">Color</label>
                                        <input type="text" class="form-control" id="in_color" placeholder="Color">
                                    </div>
                                    <div class="form-group col-md-3 has-feedback">
                                        <label for="in_price">Price</label>
                                        <input type="text" class="form-control" id="in_price"
                                               pattern="^[0-9.]{1,}$"
                                               data-error="Only numbers and dot"
                                               placeholder="Price">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true" style="margin-right: 20px"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail4">Active</label>
                                        <button class="btn btn-success" id="add">Add</button>
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <hr>
                                      <div class="out">

                                      </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
<!--                                    <div class="box-footer">-->
                                        <button type="submit" class="btn btn-block btn-success">Save</button>
<!--                                    </div>-->
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
