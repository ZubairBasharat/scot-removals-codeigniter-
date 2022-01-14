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
<style>
    .file-input .input-group {
        display:flex;
        flex-wrap:wrap;
    }
    .file-input .input-group .file-caption{
        width:68% !important;
    }
    .fileinput-remove-button{
        position:absolute !important;
        width:109px;
        top:-34px;
    }
</style>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('house_removals'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?php echo lang('enter_info'); ?></p>
                <?php
                $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'category_form');
                echo admin_form_open_multipart("products/house_removals_category", $attrib)
                ?>
                <div class="col-md-4" style="max-height:260px;">

                    <div class="form-group all">
                        <?= lang("category_name", "category_name") ?>
                        <?= form_input('category_name', "", 'class="form-control" id="category_name" required="required"'); ?>
                    </div>

                    <!-- <div class="form-group all">
                        <?= lang("category_font", "category_font") ?>
                        <?= form_input('category_font', "", 'class="form-control" id="category_font" required="required"'); ?>
                    </div> -->
                    <div class="form-group all">
                        <?= lang("category_image", "category_image") ?>
                        <input id="category_image" type="file" data-browse-label="<?= lang('browse'); ?>" name="category_image" data-show-upload="false"
                               data-show-preview="false" accept="image/*" class="form-control file">
                    </div>
                    <div class="form-group">
                        <?php echo form_submit('add_category', $this->lang->line("add_category"), 'class="btn btn-primary btn-product-category"'); ?>
                    </div>

                </div>
                <div class="col-md-8">
                    <p style="font-weight: bold;margin-bottom: 8px;">Categories</p>
                    <div style="height:238px;overflow-y:auto;border-bottom:1px solid #ddd;">
                        <table class="table table-bordered mb-0 table-condensed table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Image</th>
                                    <th style="text-align: left">Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($categories)){ ?>
                                    <?php foreach ($categories as $c) { ?>
                                        <tr>
                                            <td style="text-align: center"> <img style="width: 30px;" src="<?=base_url('assets/uploads/').$c->category_image?>" alt=""> </td>
                                            <td style="text-align: left"><?=$c->category_name?></td>
                                            <td style="text-align: center">
                                                <div class="text-center">
                                                    <div class="btn-group text-left"><button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li><a href="javascript:void(0)" onclick = "fill_values_categories('<?=$c->id?>', 'duplicate');" ><i class="fa fa-plus-square"></i> Duplicate Category</a></li>
                                                            <li><a href="javascript:void(0)" onclick = "fill_values_categories('<?=$c->id?>', 'edit');" ><i class="fa fa-edit"></i> Edit Category</a></li><li class="divider"></li>
                                                            <li data-id="<?=$c->id?>"><a href="#" class="tip po toggle-popover-c" title=""  rel="popover" data-original-title="Delete Category"><i class="fa fa-trash-o"></i> Delete Category</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <tr>
                                        <td colspan="3" style="text-align: left">No Records....</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>   
                </div>
                <?= form_close(); ?>

                <?php
                $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'property_form');
                echo admin_form_open_multipart("products/house_removals", $attrib)
                ?>
                <input type="hidden" name="check" value="property">
                <div class="col-md-4" style="max-height:260px;">
                    <div class="form-group all">
                        <label for="product">Category</label>
                        <select name="category" id="category" class="form-control" required>
                            <option value="">---Select---</option>
                            <?php foreach ($categories as $c) { ?>
                                <option value="<?=$c->id?>"><?=$c->category_name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group all">
                        <?= lang("property_name", "property_name") ?>
                        <?= form_input('property_name', "", 'class="form-control" id="property_name" required="required"'); ?>
                    </div>

                    <div class="form-group all">
                        <?= lang("slug", "slug") ?>
                        <?= form_input('slug', "", 'class="form-control" id="slug" required="required"'); ?>
                    </div>

                    <div class="form-group all">
                        <label for="product">Lift Option</label>
                        <select name="lift_option" id="lift_option" class="form-control" required>
                            <option value="">---Select---</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div id="img-details"></div>
                    <div class="form-group">
                        <?php echo form_submit('add_property', $this->lang->line("add_property"), 'class="btn btn-primary btn-property"'); ?>
                    </div>

                </div>
                <div class="col-md-8">
                    <p style="font-weight: bold;margin-bottom: 8px;">Properties</p>
                    <div style="height:315px;overflow-y:auto;border-bottom:1px solid #ddd;">
                        <table class="table table-bordered mb-0 table-condensed table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Category</th>
                                    <th style="text-align: left">Name</th>
                                    <th style="text-align: left">Slug</th>
                                    <th style="text-align: left">Lift</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($properties)){ ?>
                                    <?php foreach ($properties as $p) { ?>
                                        <tr>
                                            <td style="text-align: center"><?=$p->parent_name?></td>
                                            <td style="text-align: left"><?=$p->name?></td>
                                            <td style="text-align: left"><?=$p->slug?></td>
                                            <td style="text-align: left"><?=$p->lift_option?></td>
                                            <td style="text-align: center">
                                                <div class="text-center">
                                                    <div class="btn-group text-left"><button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li><a href="javascript:void(0)" onclick = "fill_values('<?=$p->id?>', 'property', 'duplicate');" ><i class="fa fa-plus-square"></i> Duplicate Property</a></li>
                                                            <li><a href="javascript:void(0)" onclick = "fill_values('<?=$p->id?>', 'property', 'edit');" ><i class="fa fa-edit"></i> Edit Property</a></li><li class="divider"></li>
                                                            <li data-id="<?=$p->id?>"><a href="#" class="tip po toggle-popover-cc" title=""  rel="popover" data-original-title="Delete Property"><i class="fa fa-trash-o"></i> Delete Property</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <tr>
                                        <td colspan="5" style="text-align: left">No Records....</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>   
                </div>
                <?= form_close(); ?>
                                    
                <?php
                $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'product_form');
                echo admin_form_open_multipart("products/house_removals", $attrib)
                ?>
                <input type="hidden" name="check" value="product">
                <div class="col-md-4" style="max-height:260px;">
                    <div class="form-group all">
                        <?= lang("product_name", "name") ?>
                        <?= form_input('name', "", 'class="form-control" id="name" required="required"'); ?>
                    </div>

                    <div class="form-group all">
                        <?= lang("order", "order") ?>
                        <?= form_input('order_by', "", 'class="form-control" id="order_by" required="required"'); ?>
                    </div>
                   
                    <div class="form-group all" style="display: none;">
                        <?= lang("product_price", "price") ?>
                        <?= form_input('price', "0", 'class="form-control tip" id="price" required="required"') ?>
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
                                    <th style="text-align: left">Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($products)){ ?>
                                    <?php foreach ($products as $p) { ?>
                                        <tr>
                                            <td style="text-align: center"><div style="width:32px; margin: 0 auto;"><a target="_blank" href="<?php echo base_url('assets/uploads/thumbs/'.$p->image.''); ?>" class="open-image"><img src="<?php echo base_url('assets/uploads/'.$p->image.''); ?>" alt="" class="img-responsive"></a></div></td>
                                            <td style="text-align: left"><?=$p->name?></td>
                                            <td style="text-align: left"><?=$p->order_by?></td>
                                            <td style="text-align: center">
                                                <div class="text-center">
                                                    <div class="btn-group text-left"><button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li><a href="javascript:void(0)" onclick = "fill_values('<?=$p->id?>', 'product', 'duplicate');" ><i class="fa fa-plus-square"></i> Duplicate Product</a></li>
                                                            <li><a href="javascript:void(0)" onclick = "fill_values('<?=$p->id?>', 'product', 'edit');" ><i class="fa fa-edit"></i> Edit Product</a></li><li class="divider"></li>
                                                            <li data-id="<?=$p->id?>"><a href="#" class="tip po toggle-popover-c1" title=""  rel="popover" data-original-title="Delete Product"><i class="fa fa-trash-o"></i> Delete Product</a></li>
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
                        </table>
                    </div>   
                </div>

               
                <?= form_close(); ?>
                
                <?php 
                $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'sub_product_form');
                echo admin_form_open_multipart("products/house_removals", $attrib)
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
                        <label for="sub_product_name">Sub Product Order</label>
                        <?= form_input('sub_product_order', "", 'class="form-control" id="sub_product_order" required="required"'); ?>
                    </div>
                    <div class="form-group all" style="display: none;">
                        <label for="sub_product_price">Sub Product Price</label>
                        <?= form_input('sub_product_price', "0", 'class="form-control tip" id="sub_product_price" required="required"') ?>
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
                                    <th style="text-align: left">Order By</th>
                                    <th style="text-align: left">Prices</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($sub_products)){ ?>
                                    <?php foreach ($sub_products as $p) { ?>
                                        <tr>
                                            <td style="text-align: left"><?=$p->parent_name?></td>
                                            <td style="text-align: left"><?=$p->name?></td>
                                            <td style="text-align: left"><?=$p->order_by?></td>
                                            <td style="text-align: left">
                                                <?php if($p->price_added == 0){ ?>
                                                    <span>No Prices</span>
                                                <?php }else{ ?>
                                                    <a href="#" data-toggle="modal" data-target="#myModal" onclick = "view_prices('<?=$p->id?>');" style="width: 78px;padding: 0px;" class="btn btn-info">View Prices</a>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <div class="text-center">
                                                    <div class="btn-group text-left"><button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <?php if($p->price_added == 0){ ?>
                                                                <li><a href="#" data-toggle="modal" data-target="#myModal" onclick = "add_prices('<?=$p->id?>', '<?=$p->name?>');" ><i class="fa fa-plus"></i> Add Prices</a></li>
                                                            <?php } ?>
                                                            <li><a href="javascript:void(0)" onclick = "fill_values('<?=$p->id?>', 'sub_product', 'duplicate');" ><i class="fa fa-plus-square"></i> Duplicate Sub Product</a></li>
                                                            <li><a href="javascript:void(0)" onclick = "fill_values('<?=$p->id?>', 'sub_product', 'edit');" ><i class="fa fa-edit"></i> Edit Sub Product</a></li><li class="divider"></li>
                                                            <li data-id="<?=$p->id?>"><a href="#" class="tip po toggle-popover-cc1" title=""  rel="popover" data-original-title="Delete Sub Product"><i class="fa fa-trash-o"></i> Delete Sub Product</a></li>
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
                        </table>
                    </div>    
                </div>

                <?= form_close(); ?>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-2x">&times;</i>
                </button>
                <h4 class="modal-title"><span id="prd_name"></span> Prices</h4>
            </div>
            <?php 
            $attrib = array('data-toggle' => 'validator', 'role' => 'form');
            echo admin_form_open_multipart("products/add_product_prices", $attrib)
            ?>
            <div class="modal-body">
                <input type="hidden" id="prd_id" name="prd_id" value="0">
                <input type="hidden" id="update_id" name="update_id" value="0">
                <input type="hidden" id="action" name="action" value="house_removals">
                <input type="hidden" id="type" name="type" value="add">
                
                <!-- 0 Row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="per_floor_price">Per Floor Price</label>
                            <?= form_input('per_floor_price', "", 'class="form-control" id="per_floor_price"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="per_mile_price">Per Mile Price</label>
                            <?= form_input('per_mile_price', "", 'class="form-control" id="per_mile_price"'); ?>
                        </div>
                    </div>
                </div>

                <!-- 1st Row -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="g_to_g">Ground To Ground</label>
                            <?= form_input('g_to_g', "", 'class="form-control" id="g_to_g"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="g_to_1">Ground To 1st</label>
                            <?= form_input('g_to_1', "", 'class="form-control" id="g_to_1"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="g_to_2">Ground To 2nd</label>
                            <?= form_input('g_to_2', "", 'class="form-control" id="g_to_2"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="g_to_3">Ground To 3rd</label>
                            <?= form_input('g_to_3', "", 'class="form-control" id="g_to_3"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="g_to_4">Ground To 4th</label>
                            <?= form_input('g_to_4', "", 'class="form-control" id="g_to_4"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="g_to_5">Ground To 5th</label>
                            <?= form_input('g_to_5', "", 'class="form-control" id="g_to_5"'); ?>
                        </div>
                    </div>
                </div>

                <!-- 2nd Row -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="g_to_6">Ground To 6th</label>
                            <?= form_input('g_to_6', "", 'class="form-control" id="g_to_6"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="1_to_g">1st To Ground</label>
                            <?= form_input('1_to_g', "", 'class="form-control" id="1_to_g"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="1_to_1">1st To 1st</label>
                            <?= form_input('1_to_1', "", 'class="form-control" id="1_to_1"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="1_to_2">1st To 2nd</label>
                            <?= form_input('1_to_2', "", 'class="form-control" id="1_to_2"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="1_to_3">1st To 3rd</label>
                            <?= form_input('1_to_3', "", 'class="form-control" id="1_to_3"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="1_to_4">1st To 4th</label>
                            <?= form_input('1_to_4', "", 'class="form-control" id="1_to_4"'); ?>
                        </div>
                    </div>
                </div>

                <!-- 3rd Row -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="1_to_5">1st To 5th</label>
                            <?= form_input('1_to_5', "", 'class="form-control" id="1_to_5"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="1_to_6">1st To 6th</label>
                            <?= form_input('1_to_6', "", 'class="form-control" id="1_to_6"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="2_to_g">2nd To Ground</label>
                            <?= form_input('2_to_g', "", 'class="form-control" id="2_to_g"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="2_to_1">2nd To 1st</label>
                            <?= form_input('2_to_1', "", 'class="form-control" id="2_to_1"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="2_to_2">2nd To 2nd</label>
                            <?= form_input('2_to_2', "", 'class="form-control" id="2_to_2"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="2_to_3">2nd To 3rd</label>
                            <?= form_input('2_to_3', "", 'class="form-control" id="2_to_3"'); ?>
                        </div>
                    </div>
                </div>

                <!-- 4th Row -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="2_to_4">2nd To 4th</label>
                            <?= form_input('2_to_4', "", 'class="form-control" id="2_to_4"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="2_to_5">2nd To 5th</label>
                            <?= form_input('2_to_5', "", 'class="form-control" id="2_to_5"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="2_to_6">2nd To 6th</label>
                            <?= form_input('2_to_6', "", 'class="form-control" id="2_to_6"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="3_to_g">3rd To Ground</label>
                            <?= form_input('3_to_g', "", 'class="form-control" id="3_to_g"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="3_to_1">3rd To 1st</label>
                            <?= form_input('3_to_1', "", 'class="form-control" id="3_to_1"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="3_to_2">3rd To 2nd</label>
                            <?= form_input('3_to_2', "", 'class="form-control" id="3_to_2"'); ?>
                        </div>
                    </div>
                </div>

                <!-- 5th Row -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="3_to_3">3rd To 3rd</label>
                            <?= form_input('3_to_3', "", 'class="form-control" id="3_to_3"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="3_to_4">3rd To 4th</label>
                            <?= form_input('3_to_4', "", 'class="form-control" id="3_to_4"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="3_to_5">3rd To 5th</label>
                            <?= form_input('3_to_5', "", 'class="form-control" id="3_to_5"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="3_to_6">3rd To 6th</label>
                            <?= form_input('3_to_6', "", 'class="form-control" id="3_to_6"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="4_to_g">4th To Ground</label>
                            <?= form_input('4_to_g', "", 'class="form-control" id="4_to_g"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="4_to_1">4th To 1st</label>
                            <?= form_input('4_to_1', "", 'class="form-control" id="4_to_1"'); ?>
                        </div>
                    </div>
                </div>

                <!-- 6th Row -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="4_to_2">4th To 2nd</label>
                            <?= form_input('4_to_2', "", 'class="form-control" id="4_to_2"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="4_to_3">4th To 3rd</label>
                            <?= form_input('4_to_3', "", 'class="form-control" id="4_to_3"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="4_to_4">4th To 4th</label>
                            <?= form_input('4_to_4', "", 'class="form-control" id="4_to_4"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="4_to_5">4th To 5th</label>
                            <?= form_input('4_to_5', "", 'class="form-control" id="4_to_5"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="4_to_6">4th To 6th</label>
                            <?= form_input('4_to_6', "", 'class="form-control" id="4_to_6"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="5_to_g">5th To Ground</label>
                            <?= form_input('5_to_g', "", 'class="form-control" id="5_to_g"'); ?>
                        </div>
                    </div>
                </div>

                <!-- 7th Row -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="5_to_1">5th To 1st</label>
                            <?= form_input('5_to_1', "", 'class="form-control" id="5_to_1"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="5_to_2">5th To 2nd</label>
                            <?= form_input('5_to_2', "", 'class="form-control" id="5_to_2"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="5_to_3">5th To 3rd</label>
                            <?= form_input('5_to_3', "", 'class="form-control" id="5_to_3"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="5_to_4">5th To 4th</label>
                            <?= form_input('5_to_4', "", 'class="form-control" id="5_to_4"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="5_to_5">5th To 5th</label>
                            <?= form_input('5_to_5', "", 'class="form-control" id="5_to_5"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="5_to_6">5th To 6th</label>
                            <?= form_input('5_to_6', "", 'class="form-control" id="5_to_6"'); ?>
                        </div>
                    </div>
                </div>

                <!-- 8th Row -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="6_to_g">6th To Ground</label>
                            <?= form_input('6_to_g', "", 'class="form-control" id="6_to_g"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="6_to_1">6th To 1st</label>
                            <?= form_input('6_to_1', "", 'class="form-control" id="6_to_1"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="6_to_2">6th To 2nd</label>
                            <?= form_input('6_to_2', "", 'class="form-control" id="6_to_2"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="6_to_3">6th To 3rd</label>
                            <?= form_input('6_to_3', "", 'class="form-control" id="6_to_3"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="6_to_4">6th To 4th</label>
                            <?= form_input('6_to_4', "", 'class="form-control" id="6_to_4"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="6_to_5">6th To 5th</label>
                            <?= form_input('6_to_5', "", 'class="form-control" id="6_to_5"'); ?>
                        </div>
                    </div>
                </div>

                <!-- 9th Row -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group all">
                            <label style="font-size: 12px;" for="6_to_6">6th To 6th</label>
                            <?= form_input('6_to_6', "", 'class="form-control" id="6_to_6"'); ?>
                        </div>
                    </div>
                    <!-- <div class="col-md-2">
                        <div class="form-group all" style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="o_b_house_to_o_b_house">1 Bed House To 1 Bed House</label>
                            <?= form_input('o_b_house_to_o_b_house', "", 'class="form-control" id="o_b_house_to_o_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="o_b_house_to_t_b_house">1 Bed House To 2 Bed House</label>
                            <?= form_input('o_b_house_to_t_b_house', "", 'class="form-control" id="o_b_house_to_t_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="o_b_house_to_th_b_house">1 Bed House To 3 Bed House</label>
                            <?= form_input('o_b_house_to_th_b_house', "", 'class="form-control" id="o_b_house_to_th_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="o_b_house_to_fp_b_house">1 Bed House To 4+ Bed House</label>
                            <?= form_input('o_b_house_to_fp_b_house', "", 'class="form-control" id="o_b_house_to_fp_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="o_b_house_to_storage_unit">1 Bed House To Storage Unit</label>
                            <?= form_input('o_b_house_to_storage_unit', "", 'class="form-control" id="o_b_house_to_storage_unit"'); ?>
                        </div>
                    </div> -->
                </div>

                <!-- 10th Row -->
                <div class="row">
                    <!-- <div class="col-md-2">
                        <div class="form-group all" style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="t_b_house_to_o_b_house">2 Bed House To 1 Bed House</label>
                            <?= form_input('t_b_house_to_o_b_house', "", 'class="form-control" id="t_b_house_to_o_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all" style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="t_b_house_to_t_b_house">2 Bed House To 2 Bed House</label>
                            <?= form_input('t_b_house_to_t_b_house', "", 'class="form-control" id="t_b_house_to_t_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="t_b_house_to_th_b_house">2 Bed House To 3 Bed House</label>
                            <?= form_input('t_b_house_to_th_b_house', "", 'class="form-control" id="t_b_house_to_th_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="t_b_house_to_fp_b_house">2 Bed House To 4+ Bed House</label>
                            <?= form_input('t_b_house_to_fp_b_house', "", 'class="form-control" id="t_b_house_to_fp_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="t_b_house_to_storage_unit">2 Bed House To Storage Unit</label>
                            <?= form_input('t_b_house_to_storage_unit', "", 'class="form-control" id="t_b_house_to_storage_unit"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="th_b_house_to_o_b_house">3 Bed House To 1 Bed House</label>
                            <?= form_input('th_b_house_to_o_b_house', "", 'class="form-control" id="th_b_house_to_o_b_house"'); ?>
                        </div>
                    </div> -->
                </div>

                <!-- 11th Row -->
                <div class="row">
                    <!-- <div class="col-md-2">
                        <div class="form-group all" style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="th_b_house_to_t_b_house">3 Bed House To 2 Bed House</label>
                            <?= form_input('th_b_house_to_t_b_house', "", 'class="form-control" id="th_b_house_to_t_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all" style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="th_b_house_to_th_b_house">3 Bed House To 3 Bed House</label>
                            <?= form_input('th_b_house_to_th_b_house', "", 'class="form-control" id="th_b_house_to_th_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="th_b_house_to_fp_b_house">3 Bed House To 4+ Bed House</label>
                            <?= form_input('th_b_house_to_fp_b_house', "", 'class="form-control" id="th_b_house_to_fp_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="th_b_house_to_storage_unit">3 Bed House To Storage Unit</label>
                            <?= form_input('th_b_house_to_storage_unit', "", 'class="form-control" id="th_b_house_to_storage_unit"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="fp_b_house_to_o_b_house">4+ Bed House To 1 Bed House</label>
                            <?= form_input('fp_b_house_to_o_b_house', "", 'class="form-control" id="fp_b_house_to_o_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="fp_b_house_to_t_b_house">4+ Bed House To 2 Bed House</label>
                            <?= form_input('fp_b_house_to_t_b_house', "", 'class="form-control" id="fp_b_house_to_t_b_house"'); ?>
                        </div>
                    </div> -->
                </div>

                <!-- 12th Row -->
                <div class="row">
                    <!-- <div class="col-md-2">
                        <div class="form-group all" style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="fp_b_house_to_th_b_house">4+ Bed House To 3 Bed House</label>
                            <?= form_input('fp_b_house_to_th_b_house', "", 'class="form-control" id="fp_b_house_to_th_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all" style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="fp_b_house_to_fp_b_house">4+ Bed House To 4+ Bed House</label>
                            <?= form_input('fp_b_house_to_fp_b_house', "", 'class="form-control" id="fp_b_house_to_fp_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="fp_b_house_to_storage_unit">4+ Bed House To Storage Unit</label>
                            <?= form_input('fp_b_house_to_storage_unit', "", 'class="form-control" id="fp_b_house_to_storage_unit"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="storage_unit_to_o_b_house">Storage Unit To 1 Bed House</label>
                            <?= form_input('storage_unit_to_o_b_house', "", 'class="form-control" id="storage_unit_to_o_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="storage_unit_to_t_b_house">Storage Unit To 2 Bed House</label>
                            <?= form_input('storage_unit_to_t_b_house', "", 'class="form-control" id="storage_unit_to_t_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all"  style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="storage_unit_to_th_b_house">Storage Unit To 3 Bed House</label>
                            <?= form_input('storage_unit_to_th_b_house', "", 'class="form-control" id="storage_unit_to_th_b_house"'); ?>
                        </div>
                    </div> -->
                </div>

                 <!-- 13th Row -->
                <div class="row">
                    <!-- <div class="col-md-2">
                        <div class="form-group all" style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="storage_unit_to_fp_b_house">Storage Unit To 4+ Bed House</label>
                            <?= form_input('storage_unit_to_fp_b_house', "", 'class="form-control" id="storage_unit_to_fp_b_house"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group all" style="margin-top: -18px;">
                            <label style="font-size: 12px;" for="storage_unit_to_storage_unit">Storage Unit To Storage Unit</label>
                            <?= form_input('storage_unit_to_storage_unit', "", 'class="form-control" id="storage_unit_to_storage_unit"'); ?>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?php echo form_submit('add_prices', "Submit", 'class="btn btn-info"'); ?>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".toggle-popover-c").popover({
            html: true,
            placement: 'left',
            content: `<p>Are you sure?</p><a class='btn btn-danger po-delete11' id='a__8' href='<?php echo base_url("admin/products/delete_product_category/"); ?>'>Yes I'm sure</a> <button class='btn po-close'>No</button>`
        });
        $(".toggle-popover-cc").popover({
            html: true,
            placement: 'left',
            content: `<p>Are you sure?</p><a class='btn btn-danger po-delete11' id='a__8' href='<?php echo base_url("admin/products/delete_property/"); ?>'>Yes I'm sure</a> <button class='btn po-close'>No</button>`
        });
        $(".toggle-popover-c1").popover({
            html: true,
            placement: 'left',
            content: `<p>Are you sure?</p><a class='btn btn-danger po-delete11' id='a__8' href='<?php echo base_url("admin/products/deleteHouseRemovals/"); ?>'>Yes I'm sure</a> <button class='btn po-close'>No</button>`
        });
        $(".toggle-popover-cc1").popover({
            html: true,
            placement: 'left',
            content: `<p>Are you sure?</p><a class='btn btn-danger po-delete11' id='a__8' href='<?php echo base_url("admin/products/deleteHouseRemovals1/"); ?>'>Yes I'm sure</a> <button class='btn po-close'>No</button>`
        });
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
    function add_prices(id, name){
        $("#prd_id").val(id);
        $("#prd_name").text(name);
        $("#type").val("add");
        $("#update_id").val("0");
        $("#g_to_g").val("");
        $("#g_to_1").val("");
        $("#g_to_2").val("");
        $("#g_to_3").val("");
        $("#g_to_4").val("");
        $("#g_to_5").val("");
        $("#g_to_6").val("");
        $("#1_to_g").val("");
        $("#1_to_1").val("");
        $("#1_to_2").val("");
        $("#1_to_3").val("");
        $("#1_to_4").val("");
        $("#1_to_5").val("");
        $("#1_to_6").val("");
        $("#2_to_g").val("");
        $("#2_to_1").val("");
        $("#2_to_2").val("");
        $("#2_to_3").val("");
        $("#2_to_4").val("");
        $("#2_to_5").val("");
        $("#2_to_6").val("");
        $("#3_to_g").val("");
        $("#3_to_1").val("");
        $("#3_to_2").val("");
        $("#3_to_3").val("");
        $("#3_to_4").val("");
        $("#3_to_5").val("");
        $("#3_to_6").val("");
        $("#4_to_g").val("");
        $("#4_to_1").val("");
        $("#4_to_2").val("");
        $("#4_to_3").val("");
        $("#4_to_4").val("");
        $("#4_to_5").val("");
        $("#4_to_6").val("");
        $("#5_to_g").val("");
        $("#5_to_1").val("");
        $("#5_to_2").val("");
        $("#5_to_3").val("");
        $("#5_to_4").val("");
        $("#5_to_5").val("");
        $("#5_to_6").val("");
        $("#6_to_g").val("");
        $("#6_to_1").val("");
        $("#6_to_2").val("");
        $("#6_to_3").val("");
        $("#6_to_4").val("");
        $("#6_to_5").val("");
        $("#6_to_6").val("");
        $("#per_floor_price").val("");
        $("#per_mile_price").val("");
        // $("#o_b_house_to_o_b_house").val("");
        // $("#o_b_house_to_t_b_house").val("");
        // $("#o_b_house_to_th_b_house").val("");
        // $("#o_b_house_to_fp_b_house").val("");
        // $("#o_b_house_to_storage_unit").val("");
        // $("#t_b_house_to_o_b_house").val("");
        // $("#t_b_house_to_t_b_house").val("");
        // $("#t_b_house_to_th_b_house").val("");
        // $("#t_b_house_to_fp_b_house").val("");
        // $("#t_b_house_to_storage_unit").val("");
        // $("#th_b_house_to_o_b_house").val("");
        // $("#th_b_house_to_t_b_house").val("");
        // $("#th_b_house_to_th_b_house").val("");
        // $("#th_b_house_to_fp_b_house").val("");
        // $("#th_b_house_to_storage_unit").val("");
        // $("#fp_b_house_to_o_b_house").val("");
        // $("#fp_b_house_to_t_b_house").val("");
        // $("#fp_b_house_to_th_b_house").val("");
        // $("#fp_b_house_to_fp_b_house").val("");
        // $("#fp_b_house_to_storage_unit").val("");
        // $("#storage_unit_to_o_b_house").val("");
        // $("#storage_unit_to_t_b_house").val("");
        // $("#storage_unit_to_th_b_house").val("");
        // $("#storage_unit_to_fp_b_house").val("");
        // $("#storage_unit_to_storage_unit").val("");
    }

    function view_prices(id){
        $.ajax({
            type: "GET",
            url: '<?php echo base_url('admin/products/getPricesByID'); ?>',
            dataType: 'json',
            data: {'id': id},
            success: function(data) {
                if(data[0].id != 0){
                    $("#type").val("update");
                    $("#update_id").val(data[0].id);
                    $("#prd_id").val(data[0].product_id);
                    $("#g_to_g").val(data[0].g_to_g);
                    $("#g_to_1").val(data[0].g_to_1);
                    $("#g_to_2").val(data[0].g_to_2);
                    $("#g_to_3").val(data[0].g_to_3);
                    $("#g_to_4").val(data[0].g_to_4);
                    $("#g_to_5").val(data[0].g_to_5);
                    $("#g_to_6").val(data[0].g_to_6);
                    $("#1_to_g").val(data[0].one_to_g);
                    $("#1_to_1").val(data[0].one_to_1);
                    $("#1_to_2").val(data[0].one_to_2);
                    $("#1_to_3").val(data[0].one_to_3);
                    $("#1_to_4").val(data[0].one_to_4);
                    $("#1_to_5").val(data[0].one_to_5);
                    $("#1_to_6").val(data[0].one_to_6);
                    $("#2_to_g").val(data[0].two_to_g);
                    $("#2_to_1").val(data[0].two_to_1);
                    $("#2_to_2").val(data[0].two_to_2);
                    $("#2_to_3").val(data[0].two_to_3);
                    $("#2_to_4").val(data[0].two_to_4);
                    $("#2_to_5").val(data[0].two_to_5);
                    $("#2_to_6").val(data[0].two_to_6);
                    $("#3_to_g").val(data[0].three_to_g);
                    $("#3_to_1").val(data[0].three_to_1);
                    $("#3_to_2").val(data[0].three_to_2);
                    $("#3_to_3").val(data[0].three_to_3);
                    $("#3_to_4").val(data[0].three_to_4);
                    $("#3_to_5").val(data[0].three_to_5);
                    $("#3_to_6").val(data[0].three_to_6);
                    $("#4_to_g").val(data[0].fourth_to_g);
                    $("#4_to_1").val(data[0].fourth_to_1);
                    $("#4_to_2").val(data[0].fourth_to_2);
                    $("#4_to_3").val(data[0].fourth_to_3);
                    $("#4_to_4").val(data[0].fourth_to_4);
                    $("#4_to_5").val(data[0].fourth_to_5);
                    $("#4_to_6").val(data[0].fourth_to_6);
                    $("#5_to_g").val(data[0].fifth_to_g);
                    $("#5_to_1").val(data[0].fifth_to_1);
                    $("#5_to_2").val(data[0].fifth_to_2);
                    $("#5_to_3").val(data[0].fifth_to_3);
                    $("#5_to_4").val(data[0].fifth_to_4);
                    $("#5_to_5").val(data[0].fifth_to_5);
                    $("#5_to_6").val(data[0].fifth_to_6);
                    $("#6_to_g").val(data[0].sixth_to_g);
                    $("#6_to_1").val(data[0].sixth_to_1);
                    $("#6_to_2").val(data[0].sixth_to_2);
                    $("#6_to_3").val(data[0].sixth_to_3);
                    $("#6_to_4").val(data[0].sixth_to_4);
                    $("#6_to_5").val(data[0].sixth_to_5);
                    $("#6_to_6").val(data[0].sixth_to_6);
                    $("#per_floor_price").val(data[0].per_floor_price);
                    $("#per_mile_price").val(data[0].per_mile_price);
                    // $("#o_b_house_to_o_b_house").val(data[0].o_b_house_to_o_b_house);
                    // $("#o_b_house_to_t_b_house").val(data[0].o_b_house_to_t_b_house);
                    // $("#o_b_house_to_th_b_house").val(data[0].o_b_house_to_th_b_house);
                    // $("#o_b_house_to_fp_b_house").val(data[0].o_b_house_to_fp_b_house);
                    // $("#o_b_house_to_storage_unit").val(data[0].o_b_house_to_storage_unit);
                    // $("#t_b_house_to_o_b_house").val(data[0].t_b_house_to_o_b_house);
                    // $("#t_b_house_to_t_b_house").val(data[0].t_b_house_to_t_b_house);
                    // $("#t_b_house_to_th_b_house").val(data[0].t_b_house_to_th_b_house);
                    // $("#t_b_house_to_fp_b_house").val(data[0].t_b_house_to_fp_b_house);
                    // $("#t_b_house_to_storage_unit").val(data[0].t_b_house_to_storage_unit);
                    // $("#th_b_house_to_o_b_house").val(data[0].th_b_house_to_o_b_house);
                    // $("#th_b_house_to_t_b_house").val(data[0].th_b_house_to_t_b_house);
                    // $("#th_b_house_to_th_b_house").val(data[0].th_b_house_to_th_b_house);
                    // $("#th_b_house_to_fp_b_house").val(data[0].th_b_house_to_fp_b_house);
                    // $("#th_b_house_to_storage_unit").val(data[0].th_b_house_to_storage_unit);
                    // $("#fp_b_house_to_o_b_house").val(data[0].fp_b_house_to_o_b_house);
                    // $("#fp_b_house_to_t_b_house").val(data[0].fp_b_house_to_t_b_house);
                    // $("#fp_b_house_to_th_b_house").val(data[0].fp_b_house_to_th_b_house);
                    // $("#fp_b_house_to_fp_b_house").val(data[0].fp_b_house_to_fp_b_house);
                    // $("#fp_b_house_to_storage_unit").val(data[0].fp_b_house_to_storage_unit);
                    // $("#storage_unit_to_o_b_house").val(data[0].storage_unit_to_o_b_house);
                    // $("#storage_unit_to_t_b_house").val(data[0].storage_unit_to_t_b_house);
                    // $("#storage_unit_to_th_b_house").val(data[0].storage_unit_to_th_b_house);
                    // $("#storage_unit_to_fp_b_house").val(data[0].storage_unit_to_fp_b_house);
                    // $("#storage_unit_to_storage_unit").val(data[0].storage_unit_to_storage_unit);
                }
            },
            error: function(data) { addAlert('Ajax call failed', 'danger'); }
        });
    }
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
                        $('#order_by').val(data[0].order);
                        $('.file-caption-name').text(data[0].image);
                        if(purpose == "edit"){
                            $("#product_form").attr('action', '<?= base_url('admin/products/house_removals_edit/') ?>'+data[0].id);
                            $(".btn-product").val('Edit Product');
                        }else{
                            $("#product_form").attr('action', '<?= base_url('admin/products/house_removals') ?>');
                            $(".btn-product").val('Add Product');
                        }
                    }else if(type == "property"){
                        $('#category').select2("data", {id: data[0].parent, text: data[0].parent_name});
                        $('#property_name').val(data[0].name);
                        $('#slug').val(data[0].slug);
                        $('#lift_option').select2("data", {id: data[0].lift_option, text: data[0].lift_option});
                        if(purpose == "edit"){
                            $("#property_form").attr('action', '<?= base_url('admin/products/house_removals_edit/') ?>'+data[0].id);
                            $(".btn-property").val('Edit Property');
                        }else{
                            $("#property_form").attr('action', '<?= base_url('admin/products/house_removals') ?>');
                            $(".btn-property").val('Add Property');
                        }
                    }else{
                        $('#product').select2("data", {id: data[0].parent, text: data[0].parent_name});
                        $('#sub_product_name').val(data[0].name);
                        $('#sub_product_price').val(data[0].price);
                        $('#sub_product_order').val(data[0].order_by);
                        if(purpose == "edit"){
                            $("#sub_product_form").attr('action', '<?= base_url('admin/products/house_removals_edit/') ?>'+data[0].id);
                            $(".btn-sub-product").val('Edit Product');
                        }else{
                            $("#sub_product_form").attr('action', '<?= base_url('admin/products/house_removals') ?>');
                            $(".btn-sub-product").val('Add Product');
                        }
                    }
                }
            },
            error: function(data) { addAlert('Ajax call failed', 'danger'); }
        });
    }

    function fill_values_categories(id, purpose){
        $.ajax({
            type: "GET",
            url: '<?php echo base_url('admin/products/getProductCategoryByID'); ?>',
            dataType: 'json',
            data: {'id': id},
            success: function(data) {
                if(data[0].id != 0){
                    $("#category_name").val(data[0].name);
                    $("#category_image").val(data[0].image);
                    if(purpose == "edit"){
                        $("#category_form").attr('action', '<?= base_url('admin/products/house_removals_category_edit/') ?>'+data[0].id);
                        $(".btn-product-category").val('Edit Category');
                    }else{
                        $("#category_form").attr('action', '<?= base_url('admin/products/house_removals_category') ?>');
                        $(".btn-product-category").val('Add Category');
                    }
                }
            },
            error: function(data) { addAlert('Ajax call failed', 'danger'); }
        });
    }
</script>
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