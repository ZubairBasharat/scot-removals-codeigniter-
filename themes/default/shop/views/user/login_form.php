<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?= form_open('login', 'class="validate"'); ?>
<div class="row form_container_row ">
    <div class="col-md-12">
        <div class="form-group">
            <!-- <?php if (!$shop_settings->private) { ?>
                <a href="<?= site_url('login#register'); ?>" class="pull-right text-blue"><?= lang('register'); ?></a>
            <?php } ?> -->
            <?php $u = mt_rand(); ?>
            <label for="username<?= $u; ?>" class="control-label"><?= lang('identity'); ?></label>
            <input type="text" name="identity" id="username<?= $u; ?>" class="form-control bg-none" value="" required placeholder="<?= lang('email'); ?>">
        </div>
        <div class="form-group">
            <label for="password<?= $u; ?>" class="control-label"><?= lang('password'); ?></label>
            <input type="password" id="password<?= $u; ?>" name="password" class="form-control bg-none" placeholder="<?= lang('password'); ?>" value="" required>
        </div>
        <?php
        if ($Settings->captcha) {
            ?>
            <div class="form-group">
            <div class="form-group text-center">
                    <span class="captcha-image"><?= $image; ?></span>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <a href="<?= admin_url('auth/reload_captcha'); ?>" class="reload-captcha text-blue">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </span>
                        <?= form_input($captcha); ?>
                    </div>
                </div>
            </div>
            <?php
        } /* echo $recaptcha_html; */
        ?>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="remember_me"><span> <?= lang('remember_me'); ?></span>
                </label>
                <a href="#" tabindex="-1" class="forgot-password pull-right text-blue"><?= lang('forgot?'); ?></a>
            </div>
        </div>
        <button type="submit" value="login" name="login" class="btn btn-block bg_success br-r-4"><?= lang('login'); ?></button>
    </div>
</div>
<?= form_close(); ?>

<?php
if (!$shop_settings->private) {
    $providers = config_item('providers');
    foreach($providers as $key => $provider) {
        if($provider['enabled']) {
            echo '<div style="margin-top:10px;"><a href="'.site_url('social_auth/login/'.$key).'" class="btn btn-sm mt btn-default btn-block" title="'.lang('login_with').' '.$key.'">'.lang('login_with').' '.$key.'</a></div>';
        }
    }
}
?>
