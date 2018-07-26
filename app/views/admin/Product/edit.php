<section class="content-header">
    <h1>Edit product <?=$product->title?></h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/product">Products</a></li>
        <li class="active"><?=$product->title?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="register-main">
                        <div class="col-md-6 account-left">
                            <form method="post" action="<?=ADMIN?>/product/edit" data-toggle="validator" role="form">
                                <div class="form-group has-feedback">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title"
                                           data-error="Minimum of 4 chars" data-minlength="4"
                                           value="<?= htmlSpecialCharsWrapper($product->title); ?>"
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
                                    ]);?>
                                </div>
                                <div class="form-group">
                                    <label for="keywords">Keywords</label>
                                    <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Keywords"
                                           value="<?= htmlSpecialCharsWrapper($product->keywords); ?>"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" class="form-control" id="description" placeholder="Description"
                                           value="<?= htmlSpecialCharsWrapper($product->description); ?>"
                                    >
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" class="form-control" id="price"
                                           pattern="^[0-9.]{1,}$"
                                           data-error="Only numbers and dot"
                                           value="<?= $product->price; ?>"
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
                                           value="<?= $product->old_price; ?>"
                                    >
                                    <!-- От начала до кокца строки принимаеи только цыфри и точка, и один и больше символов -->
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" rows="20" id="editor1" name="content">
                                        <?= $product->content; ?>
                                    </textarea>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="brand">Brand</label>
                                    <select class="form-control" id="brand" name="brand_id" required>
                                        <option value="">Choose brand</option>

                                        <?php if (!empty($brands)): ?>
                                            <?php foreach ($brands as $id => $title):?>
                                                <?php if ($product->brand_id == $id):?>
                                                    <option value="<?=$id?>" selected><?=$title?></option>
                                                    <?php  continue; ?>
                                                <?php endif; ?>
                                                <option value="<?=$id?>"><?=$title?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="status" <?= $product->status ? ' checked' : null; ?>> Status
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="hit" <?= $product->hit ? ' checked' : null; ?>> New
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="related">Related products</label>
                                    <select name="related[]" id="related" class="form-control select2" multiple>
                                        <?php if (!empty($related_products)): ?>
                                            <?php foreach ($related_products as $item):?>
                                                <option value="<?= $item['related_id']; ?>" selected><?= $item['title']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <?php new \app\widgets\filter\Filter($filter, WWW . '/filter/admin_filter_tpl.php'); ?>

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
                                                <div class="single">
                                                    <img src="/images/<?= $product->img; ?>" alt="image" class="img-single del-img"
                                                         data-type="single" data-id="<?= $product->id; ?>" data-src="<?= $product->img; ?>">
                                                </div>
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
                                                <div class="multi">
                                                    <?php if (!empty($gallery)):?>
                                                        <?php foreach ($gallery as $item): ?>
                                                            <img src="/images/<?=$item;?>" alt="image" class="img-multi del-img"
                                                                 data-id="<?= $product->id; ?>" data-src="<?=$item;?>" data-type="multi">
                                                        <?php  endforeach;?>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                            <div class="overlay">
                                                <i class="fa fa-refresh fa-spin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
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
                                    <div class="out_mod">
                                        <?php if (!empty($modProducts)): ?>
                                        <?php $i = 77; ?>
                                            <?php foreach ($modProducts as $key => $value):?>
                                                <input type="checkbox" class="form-check-input"
                                                       checked name="mod[<?=$i?>]" value="<?=$value['title']?>_<?=$value['price']?>" id="mod_<?=$i?>">
                                                <label class="form-check-label" for="mod_<?=$i?>"><?=$value['title']?> - $<?=$value['price']?></label><br>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="out"></div>
                                </div>
                                <div class="clearfix"></div>
                                <input type="hidden" name="id" value="<?=$product->id;?>">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success">Save</button>
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
