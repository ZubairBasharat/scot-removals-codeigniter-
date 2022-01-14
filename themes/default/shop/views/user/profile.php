<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="alawi-banner" style="background:url('<?php echo base_url();?>assets/images/vegetable2.png')!important;height:260px;background-size:cover !important;background-repeat:no-repeat !important;"><h3>Fresh Vegetables</h3></div>
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-content padding-lg white bordered-light" style="margin-top:-1px;margin-bottom:30px;">
                            <ul class="nav nav-tabs inline-list tab_list tabs_form content-center d-align-center " role="tablist">
                                <li role="presentation" class="active"><a href="#user" aria-controls="user" role="tab" data-toggle="tab" class="f-15"><?= lang('details'); ?></a></li>
                                <li role="presentation"><a href="#password" aria-controls="password" role="tab" class="f-15" data-toggle="tab"><?= lang('change_password'); ?></a></li>
                            </ul>
                            <div role="tabpanel" class="tab-pane fade in active" id="user">

                                <p class="f-15 font-regular"><?= lang('fill_form'); ?></p>
                                <?= form_open("profile/user", 'class="validate"'); ?>
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= lang('name', 'name'); ?>
                                                <?= form_input('name', set_value('name', $user->name), 'class="form-control tip" id="name" required="required"'); ?>
                                            </div>
                                        </div>
                                
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= lang('phone', 'phone'); ?>
                                                <?= form_input('phone', set_value('phone', $customer->phone), 'class="form-control tip" id="phone" required="required"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= lang('email', 'email'); ?>
                                                <?= form_input('email', set_value('email', $customer->email), 'class="form-control tip" id="email" required="required"'); ?>
                                            </div>
                                        </div>
                                
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= lang('address', 'address'); ?>
                                                <?= form_input('address', set_value('address', $customer->address), 'class="form-control tip" id="address"'); ?>
                                            </div>
                                        </div>
                                   </div>  

                                <?= form_submit('billing', lang('update'), 'class="btn w-100 br-r-4 bg_success h-40 font-medium"'); ?>
                                <?php echo form_close(); ?>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="password">
                                <p class="f-15 font-regular"><?= lang('fill_form'); ?></p>
                                <?= form_open("profile/password", 'class="validate"'); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group col-md-6 p-0">
                                            <?= lang('current_password', 'old_password'); ?>
                                            <?= form_password('old_password', set_value('old_password'), 'class="form-control tip" id="old_password" required="required"'); ?>
                                        </div>

                                        <div class="form-group col-md-6 pr-0">
                                            <?= lang('new_password', 'new_password'); ?>
                                            <?= form_password('new_password', set_value('new_password'), 'class="form-control tip" id="new_password" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" data-fv-regexp-message="'.lang('pasword_hint').'"'); ?>
                                        </div>

                                        <div class="form-group col-md-12 p-0">
                                            <?= lang('confirm_password', 'new_password_confirm'); ?>
                                            <?= form_password('new_password_confirm', set_value('new_password_confirm'), 'class="form-control tip" id="new_password_confirm" required="required" data-fv-identical="true" data-fv-identical-field="new_password" data-fv-identical-message="'.lang('pw_not_same').'"'); ?>
                                        </div>

                                        <?= form_submit('change_password', lang('change_password'), 'class="btn bg_success h-40 w-100 font-medium"'); ?>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="content-slider" class=" mt-20">
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
    </div>
</section>
