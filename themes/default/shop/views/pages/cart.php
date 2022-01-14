<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-sm-8">
                        <div class="panel panel-default margin-top-lg">
                            <div class="panel-heading pr-0 h-45 py-0">
                                <div class="d-flex h-100 d-align-center">
                                    <img src="<?php echo base_url();?>assets/images/shopping.png" class=" margin-right-sm"> <?= lang('shopping_cart'); ?>
                                    [ <?= lang('items'); ?>: <span id="total-items"></span> ]
                                    <a href="<?= shop_url('products'); ?>" class="ml-auto text-decoration hidden-xs d-flex px-15 h-100 d-align-center bg-transparent-green"style="border-top-right-radius: 4px;">
                                      <img src="<?php echo base_url();?>assets/images/lock.png">
                                        <?= lang('continue_shopping'); ?>
                                    </a>
                                </div>    
                                
                            </div>
                            <div class="panel-body" style="padding:0;">
                                <div class="cart-empty-msg <?=($this->cart->total_items() > 1) ? 'hide' :'';?>">
                                    <?= '<h4 class="">'.lang('empty_cart').'</h4>'; ?>
                                </div>
                                <div class="cart-contents">
                                    <div class="table-responsive">
                                        <table id="cart-table" class="table table-condensed table-striped table-cart margin-bottom-no">
                                            <thead class="bg-black-row">
                                                <tr>
                                                    <th class="py-10"><i class=" fa fa-trash-o"></i></th>
                                                    <th class="py-10">#</th>
                                                    <th class="col-xs-3 py-10" colspan="2"><?= lang('product'); ?></th>
                                                    <!-- <th class="col-xs-3 py-10"><?= lang('option'); ?></th> -->
                                                    <th class="col-xs-1 py-10"><?= lang('qty'); ?></th>
                                                    <th class="col-xs-2 py-10"><?= lang('price'); ?></th>
                                                    <th class="col-xs-3 py-10"><?= lang('subtotal'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-contents">
                                <div id="cart-helper" class="panel panel-footer margin-bottom-no">
                                    <a href="<?= site_url('cart/destroy'); ?>" id="empty-cart" class="btn btn-danger btn-sm">
                                        <?= lang('empty_cart'); ?>
                                    </a>
                                    <a href="<?= shop_url('products'); ?>" class="btn bg_success btn-sm pull-right">
                                        <i class="fa fa-share"></i>
                                        <?= lang('continue_shopping'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-contents">
                        <div class="col-sm-4">
                            <div id="sticky-con" class="margin-top-lg">
                                <div class="panel panel-default">
                                    <div class="panel-heading ">
                                        <i class="fa fa-calculator margin-right-sm"></i> <?= lang('cart_totals'); ?>
                                    </div>
                                    <div class="panel-body p-0">
                                        <table id="cart-totals" class="table table-borderless table-striped cart-totals"></table>
                                        <div class="px-15 mb-20">
                                            <a href="<?= site_url('cart/checkout'); ?>" class="btn border-r-4 bg_success btn-lg btn-block"><?= lang('checkout'); ?></a>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12  mt-3">
               <div id="content-slider">
                    <div id="slider">
                        <div id="mask">
                            <ul>
                                <li id="third" class="thirdanimation">
                                    <div class="product_view_banner alawi-banner black_layer bg-color-white" style="background:url('<?php echo base_url();?>assets/images/vegetable2.png');height:100%;border-radius:6px;border-radius:0px;background-size:cover;border:5px solid #ffff;background-repeat:no-repeat;position:relative;">
                                        <h3>Fresh Vegetable</h3>    
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</section>
