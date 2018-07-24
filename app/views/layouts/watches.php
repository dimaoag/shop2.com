<!DOCTYPE html>
<html>
<head>
<!--    <base href="/">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?= $this->getMeta(); ?>
    <link rel="shortcut icon" href="/images/star.png" type="image/png" />
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/megamenu/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/megamenu/css/ionicons.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/number_Input_Spinner/jquery.nice-number.min.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="/css/flexslider.css" type="text/css" media="screen" />
</head>
<body>
<!--top-header-->
<div class="top-header">
    <div class="container">
        <div class="top-header-main">
            <div class="col-md-6 top-header-left">
                <div class="drop">
                    <div class="box">
                        <select tabindex="4" class="dropdown drop" id="currency">
                            <?php new \app\widgets\currency\Currency(); ?>
                        </select>
                    </div>
                    <div class="btn-group">
                        <?php if (!empty($_SESSION['user'])): ?>
                            <a class="dropdown-toggle auth" data-toggle="dropdown"><?= htmlSpecialCharsWrapper($_SESSION['user']['name']); ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/user/cabinet" class="auth">Cabinet</a></li>
                                <li><a href="/user/logout" class="auth">Log out</a></li>
                            </ul>
                        <?php else: ?>
                            <a href="/user/login" class="auth">Log in</a>
                            <a href="/user/signup" class="auth">Sign up</a>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!--cart-->
            <div class="col-md-6 top-header-left">
                <div class="cart box_1">
                    <a href="/cart/show" onclick="getCart(); return false;">
                        <div class="total">
                            <?php if (!empty($_SESSION['cart'])): ?>
                                <span class="simpleCart_total">
                                    <?=$_SESSION['cart_currency']['symbol_left'] . $_SESSION['cart_sum'] . $_SESSION['cart_currency']['symbol_right']?>
                                </span>
                            <?php else: ?>
                                <span class="simpleCart_total">Empty Cart</span>
                            <?php endif; ?>
                            <img src="/images/cart-1.png" alt="" />
                        </div>
                    </a>
                </div>
            </div>
            <!--cart-->
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--top-header-->
<!--start-logo-->
<div class="logo">
    <a href="/"><h1>Luxury Watches</h1></a>
    <br>
    <a href="/admin/"><h1>Admin</h1></a>
</div>
<!--start-logo-->
<!--bottom-header-->
<div class="header-bottom">
    <div class="container">
        <div class="header">
            <div class="col-md-9 header-left">
                <div class="menu-container">
                    <div class="menu">
                        <?php new \app\widgets\menu\Menu([
                            'tpl' => WWW . '/menu/menu.php',
    //                        'attributes' => [
    //                                'style' => 'border: 2px solid red',
    //                        ],

                        ]); ?>
                    </div>
                </div>

                <div class="clearfix"> </div>
            </div>
            <div class="col-md-3 header-right">
                <div class="search-bar">
                    <form action="/search" method="get" autocomplete="off">
                        <input type="text" class="typeahead" id="typeahead" name="s" placeholder="Search...">
                        <input type="submit" value="">
                    </form>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--bottom-header-->

<div class="content">
<!--    --><?php // debug($_SESSION); ?>
    <?= $content; ?>
</div>

<!--information-starts-->
<div class="information">
    <div class="container">
        <div class="infor-top">
            <div class="col-md-3 infor-left">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="#"><span class="fb"></span><h6>Facebook</h6></a></li>
                    <li><a href="#"><span class="twit"></span><h6>Twitter</h6></a></li>
                    <li><a href="#"><span class="google"></span><h6>Google+</h6></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Information</h3>
                <ul>
                    <li><a href="#"><p>Specials</p></a></li>
                    <li><a href="#"><p>New Products</p></a></li>
                    <li><a href="#"><p>Our Stores</p></a></li>
                    <li><a href="#"><p>Contact Us</p></a></li>
                    <li><a href="#"><p>Top Sellers</p></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>My Account</h3>
                <ul>
                    <li><a href="account.html"><p>My Account</p></a></li>
                    <li><a href="#"><p>My Credit slips</p></a></li>
                    <li><a href="#"><p>My Merchandise returns</p></a></li>
                    <li><a href="#"><p>My Personal info</p></a></li>
                    <li><a href="#"><p>My Addresses</p></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Store Information</h3>
                <h4>The company name,
                    <span>Lorem ipsum dolor,</span>
                    Glasglow Dr 40 Fe 72.</h4>
                <h5>+955 123 4567</h5>
                <p><a href="mailto:example@email.com">contact@example.com</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--information-end-->
<!--footer-starts-->
<div class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="col-md-6 footer-left">
                <form>
                    <input type="text" value="Enter Your Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Your Email';}">
                    <input type="submit" value="Subscribe">
                </form>
            </div>
            <div class="col-md-6 footer-right">
                <p>© 2015 Luxury Watches. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--footer-end-->

<!--modal window start-->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel">Cart</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Continue</button>
                <a href="/cart/view" type="button" class="btn btn-primary" id="checkout">Buy</a>
                <button type="button" class="btn btn-danger" onclick="clearCart()" id="clearCart">Clear cart</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal window end-->

<div class="preloader"><img src="/images/ring.svg" alt=""></div>
<script>
    var path = "<?=PATH?>";
</script>

<script src="/js/jquery-1.11.0.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/validator.min.js"></script>
<script src="/js/typeahead.bundle.js"></script>
<script src="/js/jquery.easydropdown.js"></script>
<script src="/megamenu/js/megamenu.js"></script>


<?php if ($_SERVER['REQUEST_URI'] == '/'): ?>
    <!--Slider-Starts-Here-->
    <script src="/js/responsiveslides.min.js"></script>
    <script>
        // You can also use "$(window).load(function() {"
        $(function () {
            // Slideshow 4
            $("#slider4").responsiveSlides({
                auto: true,
                pager: true,
                nav: true,
                speed: 500,
                namespace: "callbacks",
                before: function () {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function () {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });
    </script>
<!--End-slider-script-->
<?php endif; ?>

<?php if (substr($_SERVER['REQUEST_URI'], 0, 9) == '/product/'): ?>
    <script src="/js/imagezoom.js"></script>
    <script defer src="/js/jquery.flexslider.js"></script>
    <script>
        // Can also be used with $(document).ready()
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
        });
    </script>
    <!--dropdown tabs in product-->
    <script type="text/javascript">
        $(function() {
            var menu_ul = $('.menu_drop > li > ul'),
                menu_a  = $('.menu_drop > li > a');
            menu_ul.hide();
            menu_a.click(function(e) {
                e.preventDefault();
                if(!$(this).hasClass('active')) {
                    menu_a.removeClass('active');
                    menu_ul.filter(':visible').slideUp('normal');
                    $(this).addClass('active').next().stop(true,true).slideDown('normal');
                } else {
                    $(this).removeClass('active');
                    $(this).next().stop(true,true).slideUp('normal');
                }
            });
        });
    </script>

    <script src="/number_Input_Spinner/jquery.nice-number.min.js"></script>
    <script>
        $(function(){
            $('.nice-number input').niceNumber();
        });
    </script>

<?php endif; ?>

<script src="/js/main.js"></script>

<?php
//$logs = \R::getDatabaseAdapter()
//    ->getDatabase()
//    ->getLogger();
//
//debug( $logs->grep( 'SELECT' ) );
//?>
</body>
</html>