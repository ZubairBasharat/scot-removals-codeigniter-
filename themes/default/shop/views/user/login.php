<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="alawi-banner" style="background:url('<?php echo base_url();?>assets/images/vegetable2.png')!important;height:260px;background-size:cover !important;background-repeat:no-repeat !important;"><h3>Fresh Vegetables</h3></div>
<section class="page-contents" style="background:url('<?php echo base_url();?>assets/images/login_page_layer.png')!important;background-repeat:no-repeat !important;background-size:cover !important;background-positon:center !important;">
    <div class="container">
        <div class="row ">
            <div class="col-xs-12">
                <div class="row mb-30">
                    <div class="col-sm-12">
                        <div class="tab-content border-top-success box_shadow br-r-4 white border_grey" style="margin-top:-1px;">
                            <ul class="nav nav-tabs px-2 inline-list z-index-100 w-md-50 d-align-center content-center tab_list tabs_form" style="position:absolute;top:20px;" role="tablist">
                                <li role="presentation" class="active m-0"><a href="#login" aria-controls="login" role="tab" data-toggle="tab"><?= lang('login'); ?></a></li>
                                <?php if (!$shop_settings->private) { ?>
                                <li role="presentation" class="role_tab_btn m-0"><a href="#register" aria-controls="register" role="tab" data-toggle="tab"><?= lang('register'); ?></a></li>
                                <?php } ?>
                            </ul>
                            <div role="tabpanel" class="tab-pane fade in active" id="login">
                                <div class="row bg_info br-r-4 m-0 h-460">
                                    <div class="col-sm-6 mt-20 h-100 pt-5">
                                        <div class=" margin-bottom-no pt-20 px-2">
                                            <?php include('login_form.php'); ?>
                                        </div>
                                    </div>
                                    <?php if (!$shop_settings->private) { ?>
                                    <div class="col-sm-6 p-0 h-100">
                                     <div class="right-side-banner  position-relative pt-5 px-2 h-100" style="background:url('<?php echo base_url();?>assets/images/all_fruit.png');background-repeat:no-repeat!important;">
                                            <div class="pt-20"> 
                                            <h4 class="z-index-100 m-0 pt-20"><span><?= lang('register_new_account'); ?></span></h4>
                                                <p class="z-index-100 pt-20">
                                                    <?= lang('register_account_info'); ?>
                                                </p>
                                                <div class="col-sm-6 ">
                                                  <a href="<?php echo base_url();?>cart/checkout#guest" class=" w-100  role_tab btn br-r-4 mt-20 text-white z-index-100  bg_success"><?= lang('guest_checkout'); ?></a>
                                                </div>
                                                <div class="col-sm-6">
                                                  <a href="#register" role="tab" data-toggle="tab" class="show-tab w-100 role_tab btn br-r-4 mt-20 text-white z-index-100  bg_success"><?= lang('register'); ?></a>
                                              </div>
                                              
                                            </div>
                                        </div>
                                      <?php } ?>
                                   </div>
                                </div>   
                            </div>

                            <?php if (!$shop_settings->private) { ?>
                            <div role="tabpanel" class="tab-pane fade" id="register">

                                <?php $attrib = array('class' => 'validate', 'role' => 'form');
                                echo form_open("register", $attrib); ?>
                                <div class="row bg_info px-2 br-r-4  m-0 " style="padding-top:90px;padding-bottom:20px;">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?= lang('name', 'name'); ?>
                                            <div class="controls">
                                                <?= form_input('name', '', 'class="form-control br-r-4 bg-none" id="name" required="required" pattern=".{3,10}"'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?= lang('email', 'email'); ?>
                                            <div class="controls">
                                                <input type="email" id="email" name="email" class="form-control br-r-4 bg-none" required="required"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?= lang('password', 'passwordr'); ?>
                                            <div class="controls">
                                                <?= form_password('password', '', 'class="form-control br-r-4 bg-none tip" id="passwordr" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"'); ?>
                                                <span class="help-block"><?php lang('pasword_hint'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?= lang('confirm_password', 'password_confirm'); ?>
                                            <div class="controls">
                                                <?= form_password('password_confirm', '', 'class="form-control br-r-4 bg-none" id="password_confirm" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" data-bv-identical="true" data-bv-identical-field="password" data-bv-identical-message="' . lang('pw_not_same') . '"'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?= lang('phone', 'phone'); ?>
                                            <div class="controls">
                                                <?= form_input('phone', '', 'class="form-control h-40 br-r-4 bg-none" id="phone"'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <?= form_submit('register', lang('register'), 'class="btn bg_success w-100"'); ?>
                                <?= form_close(); ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                </div> 
                    <div id="content-slider">
                        <div id="slider">
                            <div id="mask">
                                <ul>
                                    <li id="fourth" class="fourthanimation">
                                        <div class="product_view_banner alawi-banner black_layer bg-color-white" style="background:url('<?php echo base_url();?>assets/images/all_fruit.png');height:100%;border-radius:6px;border-radius:0px;background-size:cover;border:5px solid #ffff;background-repeat:no-repeat;position:relative;">
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

</section>
