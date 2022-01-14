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
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('office_removals'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?php echo lang('enter_info'); ?></p>
                <?php
                $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'office_removal_form');
                echo admin_form_open_multipart("products/office_removals", $attrib)
                ?>
                <input type="hidden" name="check" value="product">
                <div class="col-md-4" style="max-height:260px;">
                    <div class="form-group all">
                        <?= lang("product_name", "name") ?>
                        <?= form_input('name', "", 'class="form-control" id="name" required="required"'); ?>
                    </div>
                   
                    <div class="form-group all" style="display: none;">
                        <?= lang("product_price", "price") ?>
                        <?= form_input('price', "0", 'class="form-control tip" id="price" required="required"') ?>
                    </div>
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
                                    <th style="text-align: left">Name</th>
                                    <th style="text-align: left">Prices</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($products)){ ?>
                                    <?php foreach ($products as $p) { ?>
                                        <tr>
                                            <td style="text-align: left"><?=$p->name?></td>
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
                                                            <li><a href="javascript:void(0)" onclick = "fill_values('<?=$p->id?>', 'product', 'duplicate');" ><i class="fa fa-plus-square"></i> Duplicate Product</a></li>
                                                            <li><a href="javascript:void(0)" onclick = "fill_values('<?=$p->id?>', 'product', 'edit');" ><i class="fa fa-edit"></i> Edit Product</a></li><li class="divider"></li>
                                                            <li data-id="<?=$p->id?>"><a href="#" class="tip po toggle-popover-c" title=""  rel="popover" data-original-title="Delete Product"><i class="fa fa-trash-o"></i> Delete Product</a></li>
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
                <input type="hidden" id="action" name="action" value="office_removals">
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
            content: `<p>Are you sure?</p><a class='btn btn-danger po-delete11' id='a__8' href='<?php echo base_url("admin/products/deleteOfficeRemovals/"); ?>'>Yes I'm sure</a> <button class='btn po-close'>No</button>`
        });
        $('form[data-toggle="validator"]').bootstrapValidator({ excluded: [':disabled'] });
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
                    $("#name").val(data[0].name);
                    $('#price').val(data[0].price);
                    if(purpose == "edit"){
                        $("#office_removal_form").attr('action', '<?= base_url('admin/products/office_removals_edit/') ?>'+data[0].id);
                        $(".btn-product").val('Edit Product');
                    }else{
                        $("#office_removal_form").attr('action', '<?= base_url('admin/products/office_removals') ?>');
                        $(".btn-product").val('Add Product');
                    }
                }
            },
            error: function(data) { addAlert('Ajax call failed', 'danger'); }
        });
    }
</script>
