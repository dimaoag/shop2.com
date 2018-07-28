<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?= PATH ?>">Home</a></li>
                <li>Cabinet</li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--prdt-starts-->
<div class="prdt">
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-12">
                <div class="product-one login">
                    <div class="register-top heading">
                        <?php if (isset($_SESSION['errors'])): ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['errors']; unset($_SESSION['errors']); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success">
                                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                            </div>
                        <?php endif; ?>
                        <h2>Cabinet</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Hello <?=$_SESSION['user']['name'];?></h3>
                            <a href="/user/edit" class="btn btn-default">Edit user profile</a>
                            <a href="/user/orders" class="btn btn-default">History orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product-end-->