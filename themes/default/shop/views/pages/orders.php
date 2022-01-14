<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="alawi-banner" style="background:url('<?php echo base_url();?>assets/images/vegetable2.png')!important;height:260px;background-size:cover !important;background-repeat:no-repeat !important;"><h3>Fresh Vegetables</h3></div>
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-sm-12">

                        <div class="panel panel-default margin-top-lg">
                            <div class="panel-heading">
                               <img src="<?php echo base_url();?>assets/images/page.png" class="margin-right-sm"> <?= lang('my_orders'); ?>
                            </div>
                            <div class="panel-body">
                                <?php
                                if (!empty($orders)) {
                                    echo '<div class="row">';
                                    echo '<div class="col-sm-12 text-header-card">'.lang('click_to_view').'</div>';
                                    echo '<div class="clearfix"></div>';
                                    $r = 1;
                                    foreach ($orders as $order) {
                                        ?>
                                        <div class="col-md-6 mt-20">
                                            <div class="border-top-success py-20 px-2 br-r-4 bg_light_fc fc_border">
                                                <a class="text-decoration d-block" href="<?= shop_url('orders/'.$order->id); ?>" >
                                                <table class="table table-borderless table_font table-condensed" style="margin-bottom:0;">
                                                    <?= '<tr><td class="text_success">'.lang('date').'</td><td class="text-right">'.$this->sma->hrld($order->date).'</td></tr>'; ?>
                                                    <?= '<tr><td class="text_success">'.lang('ref').'</td><td class="text-right">'.$order->reference_no.'</td></tr>'; ?>
                                                    <?= '<tr><td class="text_success">'.lang('sale_status').'</td><td class="text-right"><span id="status-'.$order->id.'">'.lang($order->sale_status).'</span></td></tr>'; ?>
                                                    <?= '<tr><td class="text_success">'.lang('amount').'</td><td class="text-right">'.$this->sma->formatMoney($order->grand_total, $this->default_currency->symbol).'</td></tr>'; ?>
                                                    </table>
                                                    <span class="count"><i><?= $order->id; ?></i></span>
                                                    <span class="edit"><i class="fa fa-eye"></i></span>
                                                </a>
                                                  <button  class="btn btn-danger medium-font br-r-4 pull-right h-40 cancel_order" data-id="<?= $order->id; ?>"><?= lang('Cancel_order'); ?></button>
                                            </div>    
                                        </div>
                                        <?php
                                        $r++;
                                    }
                                    echo '</div>';
                                    ?>
                                    <div class="row" style="margin-top:15px;">
                                        <div class="col-md-6">
                                            <span class="page-info line-height-xl hidden-xs hidden-sm">
                                                <?= str_replace(['_page_', '_total_'], [$page_info['page'], $page_info['total']], lang('page_info')); ?>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                        <div id="pagination" class="pagination-right"><?= $pagination; ?></div>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    echo '<strong>'.lang('no_data_to_display').'</strong>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
                   <div id="content-slider col-xs-12 mt-20">
                        <div id="slider">
                            <div id="mask">
                                <ul>
                                    <li id="second" class="secondanimation">
                                        <div class="product_view_banner alawi-banner black_layer bg-color-white" style="background:url('<?php echo base_url();?>assets/images/fruit_banner.png');height:100%;border-radius:6px;border-radius:0px;background-size:cover;border:5px solid #ffff;background-repeat:no-repeat;position:relative;">
                                            <h3>Fresh Fruits</h3>    
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
               </div> 
            </div>
        </div>
    </div>
</section>
