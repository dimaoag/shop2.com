<!--start-breadcrumbs-->
<?php if ($breadcrumbs): ?>
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <?php  foreach ($breadcrumbs as $alias => $title):?>
                        <li><a href="/category/<?= $alias ?>"><?= $title ?></a></li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>
<?php endif; ?>
<!--end-breadcrumbs-->

<!--prdt-starts-->
<div class="prdt">
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-9 prdt-left">
                <?php if(!empty($products)): ?>
                    <div class="product-one">
                        <?php $currency = \shop2\App::$app->getProperty('currency'); ?>
                        <?php foreach($products as $product): ?>
                            <div class="col-md-4 product-left p-left">
                                <div class="product-main simpleCart_shelfItem">
                                    <a href="/product/<?=$product->alias;?>" class="mask"><img class="img-responsive zoom-img" src="/images/<?=$product->img;?>" alt="" /></a>
                                    <div class="product-bottom">
                                        <h3><?=$product->title;?></h3>
                                        <p>Explore Now</p>
                                        <h4>
                                            <a class="add-to-cart" href="/cart/add?id=<?= $product->id; ?>" data-id="<?= $product->id; ?>"><i></i></a>
                                            <span class=" item_price">
                                                <?= $currency['symbol_left']; ?>
                                                <?= round($product->price * $currency['value'], 0); ?>
                                                <?= $currency['symbol_right']; ?>
                                            </span>
                                            <?php if ($product->old_price): ?>
                                                <small>
                                                    <del>
                                                        <?= $currency['symbol_left']; ?>
                                                        <?= round($product->old_price * $currency['value'], 0); ?>
                                                        <?= $currency['symbol_right']; ?>
                                                    </del>
                                                </small>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                    <?php if ($product->old_price > $product->price): ?>
                                        <div class="srch srch1">
                                            <span>-<?php $sale = 100 - (($product->price/$product->old_price)*100); echo round($sale, 1); ?>%</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="clearfix"></div>
                        <?php if ($isPagination): ?>
                            <div class="text-center">
                                <?=$pagination;?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <h3>In this category products not found!</h3>
                <?php endif; ?>
            </div>
            <div class="col-md-3 prdt-right">
                <div class="w_sidebar">
                    <?php new \app\widgets\filter\Filter(); ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--product-end-->