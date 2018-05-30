<!--start-breadcrumbs-->
<?php if ($breadcrumbs): ?>
<div class="breadcrum/bs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <?php  foreach ($breadcrumbs as $alias => $title):?>
                <li><a href="/category/<?= $alias ?>"><?= $title ?></a></li>
                <?php endforeach; ?>
                <li><a href="/product/<?= $product->alias; ?>"><?= $product->title; ?></a></li>
            </ol>
        </div>
    </div>
</div>
<?php endif; ?>
<!--end-breadcrumbs-->

<!--start-single-->
<div class="single contact">
    <div class="container">
        <div class="single-main">
            <div class="col-md-9 single-main-left">
                <div class="sngl-top">
                    <div class="col-md-5 single-top-left">
                        <!-- FlexSlider -->
                        <?php if ($gallery): ?>
                        <div class="flexslider">
                            <ul class="slides">
                                <?php foreach($gallery as $item): ?>
                                <li data-thumb="/images/<?= $item->img; ?>">
                                    <div class="thumb-image"> <img src="/images/<?= $item->img; ?>" data-imagezoom="true" class="img-responsive" alt=""/> </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php else: ?>
                            <div class="flexslider">
                                <ul class="slides">
                                    <li data-thumb="/images/<?= $product->img; ?>">
                                        <div class="thumb-image"> <img src="/images/<?= $product->img; ?>" data-imagezoom="true" class="img-responsive" alt=""/> </div>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <!-- FlexSlider -->
                    </div>
                    <?php
                    $currentCurrency = \shop2\App::$app->getProperty('currency');
                    $categories = \shop2\App::$app->getProperty('categories');
                    ?>
                    <div class="col-md-7 single-top-right">
                        <div class="single-para simpleCart_shelfItem">
                            <h2><?= $product->title; ?></h2>
                            <div class="star-on"></div>
                            <h5 class="item_price" id="base-price" data-base="<?= round($product->price * $currentCurrency['value'], 0); ?>">
                                <?= $currentCurrency['symbol_left']; ?>
                                <span>
                                    <?= round($product->price * $currentCurrency['value'], 0); ?>
                                </span>
                                <?= $currentCurrency['symbol_right']; ?>
                                <?php if ($product->old_price): ?>
                                    <small>
                                        <del>
                                            <?= $currentCurrency['symbol_left']; ?>
                                            <?= round($product->old_price * $currentCurrency['value'], 0); ?>
                                            <?= $currentCurrency['symbol_right']; ?>
                                        </del>
                                    </small>
                                <?php endif; ?>
                            </h5>
                            <?= $product->content; ?>
                            <!-- Modification of color product start -->
                            <?php if ($modProductByColor): ?>
                            <div class="available">
                                <ul>
                                    <li>Color
                                        <select>
                                            <option>Choose color</option>

                                                <?php foreach ($modProductByColor as $item): ?>
                                                    <option data-title="<?=$item->title;?>"
                                                            data-price="<?=$item->price*$currentCurrency['value'];?>"
                                                            value="<?=$item->id;?>">
                                                        <?=$item->title;?>
                                                    </option>
                                                <?php endforeach; ?>

                                        </select></li>
                                    <div class="clearfix"> </div>
                                </ul>
                            </div>
                            <?php endif; ?>
                            <!-- Modification of color product end -->
                            <ul class="tag-men">
                                <li><span>CATEGORY: </span>
                                    <span>
                                        <a href="/category/<?= $categories[$product->category_id]['alias']; ?>">
                                            <?= $categories[$product->category_id]['title']; ?>
                                        </a>
                                    </span>
                                </li>
                            </ul>
                            <div class="nice-number quantity">
                                <label>Quantity: </label>
                                <input type="number" size="4" value="1" name="quantity" min="1" step="1">
                            </div>
                            <div class="clearfix"> </div>
                            <a id="productAdd" data-id="<?= $product->id; ?>" href="/cart/add?id=<?= $product->id; ?>" class="add-cart item_add add-to-cart">ADD TO CART</a>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="tabs">
                    <ul class="menu_drop">
                        <li class="item1"><a href="#"><img src="/images/arrow.png" alt="">Description</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item2"><a href="#"><img src="/images/arrow.png" alt="">Additional information</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item3"><a href="#"><img src="/images/arrow.png" alt="">Reviews (10)</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item4"><a href="#"><img src="/images/arrow.png" alt="">Helpful Links</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item5"><a href="#"><img src="/images/arrow.png" alt="">Make A Gift</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Related products start-->
                <?php if ($relatedProducts): ?>
                    <div class="latestproducts">
                    <div class="product-one">
                        <h4>Also buying with this product: </h4>
                        <?php foreach($relatedProducts as $relatedProduct): ?>
                            <div class="col-md-4 product-left p-left">
                                <div class="product-main simpleCart_shelfItem">
                                    <a href="/product/<?= $relatedProduct['alias']; ?>" class="mask"><img class="img-responsive zoom-img" src="/images/<?= $relatedProduct['img']; ?>" alt="<?= $relatedProduct['img']; ?>"/></a>
                                    <div class="product-bottom">
                                        <h3><?= $relatedProduct['title']; ?></h3>
                                        <p>Explore Now</p>
                                        <h4><a class="item_add add-to-cart" href="/cart/add?id=<?= $relatedProduct['id']; ?>" data-id="<?= $relatedProduct['id']; ?>"><i></i></a>
                                            <span class=" item_price">
                                            <?= $currentCurrency['symbol_left']; ?>
                                            <?= round($relatedProduct['price'] * $currentCurrency['value'], 0); ?>
                                            <?= $currentCurrency['symbol_right']; ?>
                                            </span>
                                            <?php if ($relatedProduct['old_price'] > $relatedProduct['price']): ?>
                                                <small>
                                                    <del>
                                                        <?= $currentCurrency['symbol_left']; ?>
                                                        <?= round($relatedProduct['old_price'] * $currentCurrency['value'], 0); ?>
                                                        <?= $currentCurrency['symbol_right']; ?>
                                                    </del>
                                                </small>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                    <?php if ($relatedProduct['old_price'] > $relatedProduct['price']): ?>
                                        <div class="srch">
                                            <span>-<?php $sale = 100 - (($relatedProduct['price']/$relatedProduct['old_price'])*100); echo round($sale, 1); ?>%</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php endif; ?>
                <!-- Related products end-->

                <!-- Recently viewed products start-->
                <?php if ($recentlyViewedProducts): ?>
                    <div class="latestproducts">
                        <div class="product-one">
                            <h4>Recently viewed products: </h4>
                            <?php foreach($recentlyViewedProducts as $recentlyViewedProduct): ?>
                                <div class="col-md-4 product-left p-left">
                                    <div class="product-main simpleCart_shelfItem">
                                        <a href="/product/<?= $recentlyViewedProduct->alias ?>" class="mask">
                                            <img class="img-responsive zoom-img" src="/images/<?= $recentlyViewedProduct->img; ?>" alt="<?= $recentlyViewedProduct->img; ?>"/></a>
                                        <div class="product-bottom">
                                            <h3><?= $recentlyViewedProduct->title; ?></h3>
                                            <p>Explore Now</p>
                                            <h4><a class="item_add add-to-cart" href="/cart/add?id=<?= $recentlyViewedProduct->id; ?>" data-id="<?= $recentlyViewedProduct->id; ?>"><i></i></a>
                                                <span class=" item_price">
                                            <?= $currentCurrency['symbol_left']; ?>
                                            <?= round($recentlyViewedProduct->price * $currentCurrency['value'], 0); ?>
                                            <?= $currentCurrency['symbol_right']; ?>
                                            </span>
                                                <?php if ($recentlyViewedProduct->old_price > $recentlyViewedProduct->price): ?>
                                                    <small>
                                                        <del>
                                                            <?= $currentCurrency['symbol_left']; ?>
                                                            <?= round($recentlyViewedProduct->old_price * $currentCurrency['value'], 0); ?>
                                                            <?= $currentCurrency['symbol_right']; ?>
                                                        </del>
                                                    </small>
                                                <?php endif; ?>
                                            </h4>
                                        </div>
                                        <?php if ($recentlyViewedProduct->old_price > $recentlyViewedProduct->price): ?>
                                            <div class="srch">
                                                <span>-<?php $sale = 100 - (($recentlyViewedProduct->price/$recentlyViewedProduct->old_price)*100); echo round($sale, 1); ?>%</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Recently viewed products end-->

            </div>

            <!-- Modification start-->
            <div class="col-md-3 single-right">
                <div class="w_sidebar">
                    <section  class="sky-form">
                        <h4>Catogories</h4>
                        <div class="row1 scroll-pane">
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>All Accessories</label>
                            </div>
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Women Watches</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Kids Watches</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Men Watches</label>
                            </div>
                        </div>
                    </section>
                    <section  class="sky-form">
                        <h4>Brand</h4>
                        <div class="row1 row2 scroll-pane">
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>kurtas</label>
                            </div>
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Sonata</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Titan</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Casio</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Omax</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox" ><i></i>shree</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Fastrack</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Sports</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Fossil</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Maxima</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Yepme</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Citizen</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Diesel</label>
                            </div>
                        </div>
                    </section>
                    <section class="sky-form">
                        <h4>Colour</h4>
                        <ul class="w_nav2">
                            <li><a class="color1" href="#"></a></li>
                            <li><a class="color2" href="#"></a></li>
                            <li><a class="color3" href="#"></a></li>
                            <li><a class="color4" href="#"></a></li>
                            <li><a class="color5" href="#"></a></li>
                            <li><a class="color6" href="#"></a></li>
                            <li><a class="color7" href="#"></a></li>
                            <li><a class="color8" href="#"></a></li>
                            <li><a class="color9" href="#"></a></li>
                            <li><a class="color10" href="#"></a></li>
                            <li><a class="color12" href="#"></a></li>
                            <li><a class="color13" href="#"></a></li>
                            <li><a class="color14" href="#"></a></li>
                            <li><a class="color15" href="#"></a></li>
                            <li><a class="color5" href="#"></a></li>
                            <li><a class="color6" href="#"></a></li>
                            <li><a class="color7" href="#"></a></li>
                            <li><a class="color8" href="#"></a></li>
                            <li><a class="color9" href="#"></a></li>
                            <li><a class="color10" href="#"></a></li>
                        </ul>
                    </section>
                    <section class="sky-form">
                        <h4>discount</h4>
                        <div class="row1 row2 scroll-pane">
                            <div class="col col-4">
                                <label class="radio"><input type="radio" name="radio" checked=""><i></i>60 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>50 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>40 % and above</label>
                            </div>
                            <div class="col col-4">
                                <label class="radio"><input type="radio" name="radio"><i></i>30 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>20 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>10 % and above</label>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="clearfix"> </div>
            <!-- Modification start-->
        </div>
    </div>
</div>
<!--end-single-->