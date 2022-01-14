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
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('furniture_delivery'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?php echo lang('enter_info'); ?></p>
                <?php
                $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'product_form');
                echo admin_form_open_multipart("products/furniture_delivery", $attrib)
                ?>
                <input type="hidden" name="check" value="product">
                <div class="col-md-4" style="max-height:260px;">
                    <div class="form-group all">
                        <?= lang("product_name", "name") ?>
                        <?= form_input('name', "", 'class="form-control" id="name" required="required"'); ?>
                    </div>

                    <!-- <div class="form-group all">
                        <?= lang("product_details", "product_details") ?>
                        <?php //form_textarea('product_details', "", 'class="form-control" id="details"'); ?>
                        <textarea rows="4" class="form-control" id="details"></textarea>
                    </div> -->
                   
                    <div class="form-group all">
                        <?= lang("product_price", "price") ?>
                        <?= form_input('price', "", 'class="form-control tip" id="price" required="required"') ?>
                    </div>

                    <div class="form-group all">
                        <?= lang("product_image", "product_image") ?>
                        <input id="product_image" type="file" data-browse-label="<?= lang('browse'); ?>" name="product_image" data-show-upload="false"
                               data-show-preview="false" accept="image/*" class="form-control file">
                    </div>
                    <div id="img-details"></div>
                    <div class="form-group">
                        <?php echo form_submit('add_product', $this->lang->line("add_product"), 'class="btn btn-primary btn-product"'); ?>
                    </div>

                </div>
                <div class="col-md-8">
                    <p style="font-weight: bold;margin-bottom: 8px;">Products</p>
                    <div style="height:238px;overflow-y:auto;border-bottom:1px solid #ddd;">
                        <table class="table table-bordered mb-0 table-condensed table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Image</th>
                                    <th style="text-align: left">Name</th>
                                    <th style="text-align: left">Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($products)){ ?>
                                    <?php foreach ($products as $p) { ?>
                                        <tr>
                                            <td style="text-align: center"><div style="width:32px; margin: 0 auto;"><a target="_blank" href="<?php echo base_url('assets/uploads/thumbs/'.$p->image.''); ?>" class="open-image"><img src="<?php echo base_url('assets/uploads/'.$p->image.''); ?>" alt="" class="img-responsive"></a></div></td>
                                            <td style="text-align: left"><?=$p->name?></td>
                                            <td style="text-align: left"><?=$this->sma->formatDecimal($p->price)?></td>
                                            <td style="text-align: center">
                                                <div class="text-center">
                                                    <div class="btn-group text-left"><button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li><a href="javascript:void(0)" onclick = "fill_values('<?=$p->id?>', 'product', 'duplicate');" ><i class="fa fa-plus-square"></i> Duplicate Product</a></li>
                                                            <li><a href="javascript:void(0)" onclick = "fill_values('<?=$p->id?>', 'product', 'edit');" ><i class="fa fa-edit"></i> Edit Product</a></li><li class="divider"></li>
                                                            <li><a href="#" class="tip po" title="" data-content="<p>Are you sure?</p><a class='btn btn-danger po-delete1' id='a__4' href='<?php echo base_url('admin/products/delete/'.$p->id.''); ?>'>Yes I'm sure</a> <button class='btn po-close'>No</button>" rel="popover" data-original-title="<b>Delete Product</b>"><i class="fa fa-trash-o"></i> Delete Product</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <tr>
                                        <td colspan="4" style="text-align: left">No Records....</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th style="text-align: center">Image</th>
                                    <th style="text-align: left">Name</th>
                                    <th style="text-align: left">Price</th>
                                    <th style="text-align: center">Actions</th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>   
                </div>

               
                <?= form_close(); ?>
                
                <?php 
                $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'sub_product_form');
                echo admin_form_open_multipart("products/furniture_delivery", $attrib)
                ?>
                <input type="hidden" name="check" value="sub_product">
                <div class="col-md-4" style="margin-top:20px;max-height:275px;">
                    <div class="form-group all">
                        <label for="product">Product</label>
                        <select name="product" id="product" class="form-control" required>
                            <option value="">---Select---</option>
                            <?php foreach ($products as $p) { ?>
                                <option value="<?=$p->id?>"><?=$p->name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group all">
                        <label for="sub_product_name">Sub Product Name</label>
                        <?= form_input('sub_product_name', "", 'class="form-control" id="sub_product_name" required="required"'); ?>
                    </div>
                   
                    <div class="form-group all">
                        <label for="sub_product_price">Sub Product Price</label>
                        <?= form_input('sub_product_price', "", 'class="form-control tip" id="sub_product_price" required="required"') ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_submit('add_product', $this->lang->line("add_product"), 'class="btn btn-primary btn-sub-product"'); ?>
                    </div>
                </div>
                <div class="col-md-8" style="margin-top:20px;">
                    <p style="font-weight: bold;margin-bottom: 8px;">Sub Products</p>
                    <div style="height:245px;overflow-y:auto;border-bottom:1px solid #ddd;">
                        <table class="table mb-0 table-bordered table-condensed table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: left">Parent</th>
                                    <th style="text-align: left">Name</th>
                                    <th style="text-align: left">Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($sub_products)){ ?>
                                    <?php foreach ($sub_products as $p) { ?>
                                        <tr>
                                            <td style="text-align: left"><?=$p->parent_name?></td>
                                            <td style="text-align: left"><?=$p->name?></td>
                                            <td style="text-align: left"><?=$this->sma->formatDecimal($p->price)?></td>
                                            <td style="text-align: center">
                                                <div class="text-center">
                                                    <div class="btn-group text-left"><button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li><a href="javascript:void(0)" onclick = "fill_values('<?=$p->id?>', 'sub_product', 'duplicate');" ><i class="fa fa-plus-square"></i> Duplicate Sub Product</a></li>
                                                            <li><a href="javascript:void(0)" onclick = "fill_values('<?=$p->id?>', 'sub_product', 'edit');" ><i class="fa fa-edit"></i> Edit Sub Product</a></li><li class="divider"></li>
                                                            <li><a href="#" class="tip po" title="" data-content="<p>Are you sure?</p><a class='btn btn-danger po-delete1' id='a__4' href='<?php echo base_url('admin/products/delete_sub/'.$p->id.''); ?>'>Yes I'm sure</a> <button class='btn po-close'>No</button>" rel="popover" data-original-title="<b>Delete Sub Product</b>"><i class="fa fa-trash-o"></i> Delete Sub Product</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <tr>
                                        <td colspan="4" style="text-align: left">No Records....</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th style="text-align: left">Parent</th>
                                    <th style="text-align: left">Name</th>
                                    <th style="text-align: left">Price</th>
                                    <th style="text-align: center">Actions</th>
                                </tr>
                            </tfoot> -->
                        </table>
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
    function fill_values(id, type, purpose){
        $.ajax({
            type: "GET",
            url: '<?php echo base_url('admin/products/getProductByID'); ?>',
            dataType: 'json',
            data: {'id': id, 'type': type},
            success: function(data) {
                if(data[0].id != 0){
                    if(type == "product"){
                        $("#name").val(data[0].name);
                        $('#price').val(data[0].price);
                        if(purpose == "edit"){
                            $("#product_form").attr('action', '<?= base_url('admin/products/furniture_delivery_edit/') ?>'+data[0].id);
                            $(".btn-product").val('Edit Product');
                        }else{
                            $("#product_form").attr('action', '<?= base_url('admin/products/furniture_delivery') ?>');
                            $(".btn-product").val('Add Product');
                        }
                    }else{
                        $('#product').select2("data", {id: data[0].parent, text: data[0].parent_name});
                        $('#sub_product_name').val(data[0].name);
                        $('#sub_product_price').val(data[0].price);
                        if(purpose == "edit"){
                            $("#sub_product_form").attr('action', '<?= base_url('admin/products/furniture_delivery_edit/') ?>'+data[0].id);
                            $(".btn-sub-product").val('Edit Product');
                        }else{
                            $("#sub_product_form").attr('action', '<?= base_url('admin/products/furniture_delivery') ?>');
                            $(".btn-sub-product").val('Add Product');
                        }
                    }
                }
            },
            error: function(data) { addAlert('Ajax call failed', 'danger'); }
        });
    }
</script>
