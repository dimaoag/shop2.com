<section class="content-header">
    <h1>Edit <?=$currency->title;?></h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="<?=ADMIN?>/currency"><i class="fa fa-dashboard"></i>Currencies</a></li>
        <li class="active"><?=$currency->title;?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN?>/currency/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="title"
                                   value="<?=htmlSpecialCharsWrapper($currency->title);?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="code">Code</label>
                            <input type="text" name="code" class="form-control" id="code"
                                   value="<?=htmlSpecialCharsWrapper($currency->code);?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="symbol_left">Symbol left</label>
                            <input type="text" name="symbol_left" class="form-control" id="symbol_left"
                                   value="<?=htmlSpecialCharsWrapper($currency->symbol_left);?>">
                        </div>
                        <div class="form-group">
                            <label for="symbol_right">Symbol right</label>
                            <input type="text" name="symbol_right" class="form-control" id="symbol_right"
                                   value="<?=htmlSpecialCharsWrapper($currency->symbol_right);?>">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="value">Value</label>
                            <input type="text" name="value" class="form-control" id="value"
                                   pattern="^[0-9.]{1,}$"
                                   data-error="Only numbers and dot"
                                   value="<?=$currency->value;?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="base">
                                <input type="checkbox" name="base" id="base"
                                    <?php if ($currency->base) echo 'checked';?>
                                >
                                Base currency
                            </label>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?=$currency->id;?>">
                    <div class="box-footer">
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>