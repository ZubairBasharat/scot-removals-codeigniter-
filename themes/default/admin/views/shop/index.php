<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-cog"></i><?= lang('shop_settings'); ?></h2>
        <?php if(isset($shop_settings->purchase_code) && ! empty($shop_settings->purchase_code) && $shop_settings->purchase_code != 'purchase_code') { ?>
        <div class="box-icon">
            <ul class="btn-tasks">
                <!-- <li class="dropdown"><a href="<?= admin_url('shop_settings/updates') ?>" class="toggle_down"><i
                    class="icon fa fa-upload"></i><span class="padding-right-10"><?= lang('updates'); ?></span></a>
                </li> -->
            </ul>
        </div>
        <?php } ?>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?= lang('update_info'); ?></p>

                <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form');
                echo admin_form_open_multipart("shop_settings", $attrib);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= lang('shop_name', 'shop_name'); ?>
                            <?= form_input('shop_name', set_value('shop_name', $shop_settings->shop_name), 'class="form-control tip" id="shop_name" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('description', 'description'); ?>
                            <?= form_input('description', set_value('description', $shop_settings->description), 'class="form-control tip" id="description" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('products_description', 'products_description'); ?>
                            <?= form_input('products_description', set_value('products_description', $shop_settings->products_description), 'class="form-control tip" id="products_description" required="required"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= lang('shipping', 'shipping'); ?>
                            <?= form_input('shipping', set_value('shipping', $shop_settings->shipping), 'class="form-control tip" id="shipping"'); ?>
                        </div>
                        
                        <div class="form-group">
                            <?= lang('biller', 'biller'); ?>
                            <?php
                            $bl[''] = lang('select').' '.lang('biller');
                            foreach ($billers as $biller) {
                                $bl[$biller->id] = $biller->company && $biller->company != '-' ? $biller->company : $biller->name;
                            }
                            ?>
                            <?= form_dropdown('biller', $bl, set_value('biller', $shop_settings->biller), 'class="form-control tip" id="biller"  required="required"'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <?= lang('follow_text', 'follow_text'); ?>
                            <?= form_input('follow_text', set_value('follow_text', $shop_settings->follow_text), 'class="form-control tip" id="follow_text" required="required"'); ?>
                        </div>
                        <!-- <div class="form-group">
                            <?= lang('facebook', 'facebook'); ?>
                            <?= form_input('facebook', set_value('facebook', $shop_settings->facebook), 'class="form-control tip" id="facebook" required="required"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('twitter', 'twitter'); ?>
                            <?= form_input('twitter', set_value('twitter', $shop_settings->twitter), 'class="form-control tip" id="twitter"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('google_plus', 'google_plus'); ?>
                            <?= form_input('google_plus', set_value('google_plus', $shop_settings->google_plus), 'class="form-control tip" id="google_plus"'); ?>
                        </div>
                        <div class="form-group">
                            <?= lang('instagram', 'instagram'); ?>
                            <?= form_input('instagram', set_value('instagram', $shop_settings->instagram), 'class="form-control tip" id="instagram"'); ?>
                        </div> -->

                    </div>

                    <div class="col-md-12">
                        <?= form_submit('update', lang('update'), 'class="btn btn-primary"'); ?>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
