<section class="content-header">
    <h1>Categories</h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/category"><i class="fa fa-dashboard"></i>Categories</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <?php new \app\widgets\menu\Menu([
                        'tpl' => WWW . '/menu/menu_admin.php',
                        'container' => 'div',
                        'cache' => 0,
                        'cacheKey' => 'admin_category',
                        'class' => 'list-group list-group-root well',
                    ]);?>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
