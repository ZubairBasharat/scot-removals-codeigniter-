<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="alawi-banner" style="background:url('<?php echo base_url();?>assets/images/invoice.png')!important;height:260px;background-size:cover !important;background-repeat:no-repeat !important; "><h3 style="color:#2a2a2a !important;">Invoice</h3></div>
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-sm-12">

                        <div class="panel panel-default margin-top-lg">
                            <div class="panel-heading h-min-45 d-align-center d-flexalign-content">
                           <img src="<?php echo base_url();?>assets/images/page.png" class="margin-right-sm"> <?= lang('view_order').($inv ? ' ('.$inv->reference_no.')' : ''); ?>
                            <?= $this->loggedIn ? '<a href="'.shop_url('orders').'" class="ml-auto text-decoration"><img src="'.base_url().'assets/images/lock.png" class="margin-right-sm"> '.lang('my_orders').'</a>' : ''; ?>
                            <!-- <a href="<?= shop_url('orders?download='.$inv->id.($this->loggedIn ? '' : '&hash='.$inv->hash)); ?>" class="pull-right" style="margin-right:10px;"><i class="fa fa-download"></i> <?= lang('download'); ?></a> -->
                            </div>
                            <div class="panel-body mprint">
                               <div class="cancel_order_sec">
                                    <button  class="btn btn-danger medium-font br-r-4  h-40 cancel_order" data-id="<?= $inv->id; ?>"><?= lang('Cancel_order'); ?></button>
                                </div>
                                <div class="text-center biller-header print" style="margin-bottom:20px;">
                                    <img src="<?= base_url() . 'assets/uploads/logos/' . $biller->logo; ?>"
                                    alt="<?= $biller->name; ?>">
                                    <h2 style="margin-top:10px;"><?= $biller->name; ?></h2>
                                    <?= $biller->company ? "" : "Attn: " . $biller->name ?>

                                    <?php
                                    echo $biller->address . " " . $biller->city . " " . $biller->postal_code . " " . $biller->state . " " . $biller->country;

                                    echo "<br>";

                                    echo "<br>";
                                    echo lang("tel") . ": " . $biller->phone . " " . lang("email") . ": " . $biller->email;
                                    ?>
                                </div>

                                <div class="pt-20">
                                    <div class="row bold">
                                        <div class="col-sm-5">
                                            <p class="text_invoice" style="margin-bottom:0;">
                                                <?= lang("date"); ?>: <?= $this->sma->hrld($inv->date); ?><br>
                                                <?= lang("ref"); ?>: <?= $inv->reference_no; ?><br>
                                                <!-- <?= lang("sale_status"); ?>: <?= lang($inv->sale_status); ?><br> -->
                                            </p>
                                        </div>
                                        <div class="col-sm-7 my-sm-10 text-right order_barcodes">
                                            <img src="<?= admin_url('misc/barcode/'.$this->sma->base64url_encode($inv->reference_no).'/code128/74/0/1'); ?>" alt="<?= $inv->reference_no; ?>" class="bcimg" />
                                            <?= $this->sma->qrcode('link', urlencode(shop_url('orders/' . $inv->id)), 2); ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="row invoice_detail mt-20" style="margin-bottom:15px;">
                                   
                                    <div class="col-sm-6">
                                        <P class="text_invoice2"><?php echo $this->lang->line("customer"); ?></p>
                                        <h2 style="margin-top:10px;"><?= $customer->company && $customer->company != '-' ? $customer->company : $customer->name; ?></h2>
                                        <?php
                                        echo $customer->city;

                                        echo "<p class='text_invoice'>";
                                         echo lang("tel") . ": " . $customer->phone . "<br>" . lang("email") . ": " . $customer->email;
                                        echo "</p>";
                                       
                                        ?>
                                    </div>
                                    <?php if ($address) { ?>
                                    <div class="col-sm-6">
                                        <p class="text_invoice2"><?php echo $this->lang->line("shipping"); ?></p>
                                        <h2 style="margin-top:10px;"><?= $address->name; ?></h2>
                                        <p class="text_invoice">
                                            <?= $address->city; ?><br>
                                            <?= lang('phone').': '.$address->phone; ?>
                                        </p>
                                    </div>
                                    <?php } ?>

                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped print-table order-table">

                                        <thead>

                                            <tr>
                                                <th><?= lang("no"); ?></th>
                                                <th><?= lang("description"); ?></th>
                                                <th><?= lang("quantity"); ?></th>
                                                <th><?= lang("unit_price"); ?></th>
                                                <?php
                                                if ($Settings->product_discount && $inv->product_discount != 0) {
                                                    echo '<th>' . lang("discount") . '</th>';
                                                }
                                                ?>
                                                <th><?= lang("subtotal"); ?></th>
                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php $r = 1;
                                            $tax_summary = array();
                                            foreach ($rows as $row):
                                                ?>
                                            <tr>
                                                <td style="text-align:center; width:40px; vertical-align:middle;"><?= $r; ?></td>
                                                <td style="vertical-align:middle;">
                                                    <?= $row->product_code.' - '.$row->product_name; ?>
                                                    <?= $row->product_details ? '<br>' . $row->product_details : ''; ?>
                                                </td>
                                                <td style="width: 80px; text-align:center; vertical-align:middle;"><?= $this->sma->formatQuantity($row->unit_quantity).' '.$row->product_unit_code; ?></td>
                                                <td style="text-align:center; width:100px;"><?= $this->sma->formatMoney($row->real_unit_price); ?></td>
                                                <?php
                                                if ($Settings->product_discount && $inv->product_discount != 0) {
                                                    echo '<td style="width: 100px; text-align:center; vertical-align:middle;">' . ($row->discount != 0 ? '<small>(' . $row->discount . ')</small> ' : '') . $this->sma->formatMoney($row->item_discount) . '</td>';
                                                }
                                                ?>
                                                <td style="text-align:center; width:120px;"><?= $this->sma->formatMoney($row->subtotal); ?></td>
                                            </tr>
                                            <?php
                                            $r++;
                                            endforeach;
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <?php
                                            $col = 4;
                                            if ($Settings->product_discount && $inv->product_discount != 0) {
                                                $col++;
                                            }
                                            if ($Settings->product_discount && $inv->product_discount != 0) {
                                                $tcol = $col - 2;
                                            } elseif ($Settings->product_discount && $inv->product_discount != 0) {
                                                $tcol = $col - 1;
                                            } else {
                                                $tcol = $col;
                                            }
                                            ?>
                                            <?php if ($inv->grand_total != $inv->total) { ?>
                                            <tr>
                                                <td class="total_valumn" colspan="<?= $tcol; ?>"
                                                    style="text-align:right;padding:0px; padding-right:10px;border:none;"><div class="ml-auto element-valumn"><?= lang("total"); ?><span>(<?= $default_currency->code; ?>)</span></div>
                                                    
                                                </td>
                                                <?php
                                                if ($Settings->product_discount && $inv->product_discount != 0) {
                                                    echo '<td style="text-align:right;">' . $this->sma->formatMoney($inv->product_discount) . '</td>';
                                                }
                                                ?>
                                                <td class="total_valumn" style="text-align:right; padding-right:10px;"><div class="ml-auto element-valumn"><?= $this->sma->formatMoney($inv->total); ?></div></td>
                                            </tr>
                                            <?php } ?>
                                            <?php if ($inv->order_discount != 0) {
                                                echo '<tr><td class="total_valumn" colspan="' . $col . '" style="text-align:right; padding-right:10px;;">' . lang("order_discount") . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">'.($inv->order_discount_id ? '<small>('.$inv->order_discount_id.')</small> ' : '') . $this->sma->formatMoney($inv->order_discount) . '</td></tr>';
                                            }
                                            ?>
                                            <?php if ($inv->shipping != 0) {
                                                echo '<tr ><td class="total_valumn" colspan="' . $col . '" style="text-align:right; padding-right:10px;;">' .'<div class="ml-auto element-valumn">' . lang("delivery_charges") . ' (' . $default_currency->code . ')</div></td><td class="total_valumn" style="text-align:right; padding-right:10px;">' .'<div class="ml-auto element-valumn">' . $this->sma->formatMoney($inv->shipping) . '</div></td></tr>';
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="<?= $col; ?>"
                                                    style="text-align:right; " class="total_valumn"><div class="ml-auto element-valumn"><?= lang("total_amount"); ?><span> (<?= $default_currency->code; ?>)</span></div>
                                                   
                                                </td>
                                                <td class="total_valumn" style="text-align:right; padding-right:10px; " ><div class="ml-auto element-valumn"><?= $this->sma->formatMoney($inv->grand_total); ?></div></td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <?php
                                        if ($inv->note || $inv->note != "") { ?>
                                        <div class="well well-sm" style="margin-bottom:0;">
                                            <p class="bold"><?= lang("note"); ?>:</p>
                                            <div><?= $this->sma->decode_html($inv->note); ?></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="content-slider" class="col-xs-12 mt-20">
                <div id="slider">
                    <div id="mask">
                    <ul>
                        <li id="first" class="firstanimation">
                            <div class="product_view_banner alawi-banner black_layer bg-color-white" style="background:url('<?php echo base_url();?>assets/images/tomato.png');height:100%;border-radius:6px;border-radius:0px;background-size:cover;border:5px solid #ffff;background-repeat:no-repeat;position:relative;">
                             <h3>Fresh Vegetables</h3>    
                            </div>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
