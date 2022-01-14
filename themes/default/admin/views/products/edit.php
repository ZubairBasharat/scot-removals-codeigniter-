<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('.gen_slug').change(function(e) {
            getSlug($(this).val(), 'products');
        });

        $('#code').bind('keypress', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i><?= lang('edit_product'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?php echo lang('update_info'); ?></p>
                <?php
                $attrib = array('data-toggle' => 'validator', 'role' => 'form');
                echo admin_form_open_multipart("products/edit/" . $product->id, $attrib)
                ?>
                <div class="col-md-5">
                    <div class="form-group">
                        <?= lang("product_type", "type") ?>
                        <?php
                        $opts = array('standard' => lang('standard'));
                        echo form_dropdown('type', $opts, (isset($_POST['type']) ? $_POST['type'] : ($product ? $product->type : '')), 'class="form-control" id="type" required="required"');
                        ?>
                    </div>
                    <div class="form-group all">
                        <?= lang("product_name", "name") ?>
                        <?= form_input('name', (isset($_POST['name']) ? $_POST['name'] : ($product ? $product->name : '')), 'class="form-control gen_slug" id="name" required="required"'); ?>
                    </div>

                    <div class="form-group all">
                        <?= lang("product_details", "product_details") ?>
                        <?= form_textarea('product_details', (isset($_POST['product_details']) ? $_POST['product_details'] : ($product ? $product->product_details : '')), 'class="form-control" id="details"'); ?>
                    </div>

                    <div class="form-group all">
                        <?= lang("details", "details") ?>
                        <?= form_textarea('details', (isset($_POST['details']) ? $_POST['details'] : ($product ? $product->details : '')), 'class="form-control" id="details"'); ?>
                    </div>

                    <div class="form-group all">
                        <?= lang("product_code", "code") ?>
                        <?= form_input('code', (isset($_POST['code']) ? $_POST['code'] : ($product ? $product->code : '')), 'class="form-control" id="code"  required="required"') ?>
                    </div>

                    <div class="form-group all">
                        <?= lang('slug', 'slug'); ?>
                        <?= form_input('slug', set_value('slug', ($product ? $product->slug : '')), 'class="form-control tip" id="slug" required="required"'); ?>
                    </div>

                    
                    <div class="form-group all">
                        <?= lang("category", "category") ?>
                        <?php
                        $cat[''] = "";
                        foreach ($categories as $category) {
                            $cat[$category->id] = $category->name;
                        }
                        echo form_dropdown('category', $cat, (isset($_POST['category']) ? $_POST['category'] : ($product ? $product->category_id : '')), 'class="form-control select" id="category" placeholder="' . lang("select") . " " . lang("category") . '" required="required" style="width:100%"')
                        ?>
                    </div>

                    <div class="form-group all">
                        <?= lang("product_price", "price") ?>
                        <?= form_input('price', (isset($_POST['price']) ? $_POST['price'] : ($product ? $this->sma->formatDecimal($product->price) : '')), 'class="form-control tip" id="price" required="required"') ?>
                    </div>


                    <div class="form-group all">
                        <?= lang("product_image", "product_image") ?>
                        <input id="product_image" type="file" data-browse-label="<?= lang('browse'); ?>" name="product_image" data-show-upload="false"
                               data-show-preview="false" accept="image/*" class="form-control file">
                    </div>

                    <div class="form-group all">
                        <?= lang("product_gallery_images", "images") ?>
                        <input id="images" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile[]" multiple="true" data-show-upload="false"
                               data-show-preview="false" class="form-control file" accept="image/*">
                    </div>
                    <div id="img-details"></div>
                </div> 

                <div class="col-md-5">
                    <?php
                    foreach($languages as $lang => $val){ 
                        if($lang != "english"){ @$trans = getProductsTranslation($lang, $product->id); ?>
                            <div class="form-group all">
                                <label  class="control-label text-left"> <?= lang('product_name', 'name'); ?> <img src="<?php echo ALS_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" />&nbsp;<?php echo $val['name'];?></label>
                                <input type="text" name='<?php echo "translated[$lang][name]"; ?>' class="form-control" value="<?php echo @$trans[0]->trans_name;?>" >

                                <div class="form-group all">
                                    <label> <?= lang('product_details', 'product_details'); ?> <img src="<?php echo ALS_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" />&nbsp;<?php echo $val['name'];?></label>
                                    <textarea type="text" name='<?php echo "translated[$lang][product_details]"; ?>' class="form-control" ><?php echo @$trans[0]->trans_details;?></textarea>
                                </div>

                                <div class="form-group all">
                                    <label> <?= lang('details', 'details'); ?> <img src="<?php echo ALS_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" />&nbsp;<?php echo $val['name'];?></label>
                                    <textarea type="text" name='<?php echo "translated[$lang][details]"; ?>' class="form-control"><?php echo @$trans[0]->trans_product_details;?></textarea>
                                </div>
                            </div>
                        <?php 
                        } 
                    } ?>
                </div> 

                <div class="col-md-12">

                    <div class="form-group">
                        <input name="hide" type="checkbox" class="checkbox" id="hide" value="1" <?= isset($_POST['hide']) ? 'checked="checked"' : '' ?>/>
                        <label for="hide" class="padding05"><?= lang('hide_in_shop') ?></label>
                    </div>

                    <div class="form-group">
                        <?php echo form_submit('edit_product', $this->lang->line("edit_product"), 'class="btn btn-primary"'); ?>
                    </div>

                </div>
                <?= form_close(); ?>

            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('form[data-toggle="validator"]').bootstrapValidator({ excluded: [':disabled'] });

        var _URL = window.URL || window.webkitURL;
        $("input#images").on('change.bs.fileinput', function () {
            var ele = document.getElementById($(this).attr('id'));
            var result = ele.files;
            $('#img-details').empty();
            for (var x = 0; x < result.length; x++) {
                var fle = result[x];
                for (var i = 0; i <= result.length; i++) {
                    var img = new Image();
                    img.onload = (function (value) {
                        return function () {
                            ctx[value].drawImage(result[value], 0, 0);
                        }
                    })(i);

                    img.src = 'images/' + result[i];
                }
            }
        });
        
    });

    <?php if ($product) { ?>
        $(document).ready(function () {
            $("#product_image").parent('.form-group').addClass("text-warning");
            $("#images").parent('.form-group').addClass("text-warning");
        });
    <?php } ?>
</script>
