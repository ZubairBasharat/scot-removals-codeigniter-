<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- <div id="status"></div> -->
</div>

    <!-- Footer Start -->
    <footer>
        <div class="main_wrapper container-wrapper">
            <div class="row m-0">
                <div class="col-lg-3 col-6 pl-0 pb-4 pb-lg-0 ">
                    <div class="footer_detail">
                        <h5><span></span>About Us</h5>
                        <p class="mb-1 pr-sm-2">Scot Removals is the most reliable professional moving company in Scotland since 2014. We have served thousands of customers. We are equipped to move any Large size Homes andOffices to even just a few boxes or small furniture items. We provide complete home removal service including packing, dismantling and reassembling furniture. Our drivers and porters are highly experienced. We make sure to provide a complete hassle free moving experience to all our customers.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="footer_detail">
                        <h5><span></span>Our Services</h5>
                        <div class="service_links">
                            <ul class="p-0 ">
                                <li><a href="<?= base_url('shop/house_removal');?>">House Removals</a></li>
                                <li><a href="<?= base_url('shop/furniture_delivery');?>">Furniture Delivery</a></li>
                                <li><a href="<?= base_url('shop/piano_removal');?>">Piano Removals</a></li>
                                <li><a href="<?= base_url('shop/man_and_van');?>">Man & Van Service</a></li>
                                <li><a href="<?= base_url('');?>">Man Power Only</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 pl-md-3 pl-0 ">
                    <div class="footer_detail">
                        <h5><span></span>Contact Us</h5>
                        <div class="contact_info">
                            <ul class="p-0 ">
                                <li>
                                    <img src="<?= base_url('assets/uploads/mailbox.png');?>"><span>andahdsfsndlvs sflkndlfsd,</span>
                                    <br>
                                    <span class="child_2">khbcsd asdas 48556</span>
                                </li>
                                <li>
                                    <i class="text-white fas fa-phone-alt"></i>
                                    <span>0141-390-8967</span>
                                </li>
                                <li>
                                    <img src="<?= base_url('assets/uploads/paper-plane.png');?>"><span>admin@scotremovals.com</span>
                                    <br>
                                </li>
                            </ul>
                            <div class="social_media">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6  col-12  pr-sm-0 pl-0 pl-xl-3">
                    <div class="footer_detail">
                        <h5><span></span>Newsletter Subscribe</h5>
                        <div class="email_input">
                            <p>Subscribe to our mailing list to get the
                                <br>
                                <span class="child_2"> updates to your email inbox.</span>
                                <form>
                                    <!-- <div class="user-input-wrp">
                                <input type="email"  class="inputText" placeholder="Your Email Here">
                                <span class="floating-label">Your Email Here"</span>
                            </div> -->
                                    <div class="user-input-wrp">

                                        <input type="text" class="inputText" style=" background:url('<?php echo base_url('assets/images/envelope.png');?>')" required/>
                                        <span class="floating-label">Your Email Here</span>
                                    </div>

                                </form>
                        </div>
                    </div>
                </div>
            </div>
            <p class="pr-md-4 mb-2 text-center grey-footer-text">Scot Removals Glasgow Limited is a registered company in Scotland. Registered Address: Flat ½, 4 Bunessan Street Glasgow G52 1DY | Company Number: SC597737</p>
        </div>
        <div class="copyright_text container-wrapper text-center">
            <p class="mb-0 "> Copyright &copy; Scot Removal 2020 All Rights Reserved. <a href="<?= base_url('shop/privacy_policy') ?>"><b> Privacy Policy</b></a></p>
        </div>
        <div id="status"></div>
    </footer>
    <!-- Footer End -->
    <!-- ajax loader -->
    <div class="wrap-loader" id="scr_c_loader">
        <div class="loading">
            <div class="bounceball"></div>
            <div class="text-label-loader"><span>We Save</span> You Money</div>
        </div>
    </div>
<div class="back-drop-loader">
</div>

<?php if (!get_cookie('shop_use_cookie') && get_cookie('shop_use_cookie') != 'accepted' && !empty($shop_settings->cookie_message)) { ?>
<div class="cookie-warning w-100">
    <div class="m-0 alert d-flex flex-wrap alert-info">
        <!-- <a href="<?= site_url('main/cookie/accepted'); ?>" class="close">&times;</a> -->
        <p class="mb-0">
            <?= $shop_settings->cookie_message; ?>
            <?php if (!empty($shop_settings->cookie_link)) { ?>
            <a href="<?= site_url('page/'.$shop_settings->cookie_link); ?>" ><?= lang('read_more'); ?></a>
            <?php } ?>
        </p>
        <a href="<?= site_url('main/cookie/accepted'); ?>" class="btn btn-sm bg-primary pt-1 text-white d-block ml-auto" style="width:80px;"><?= lang('i_accept'); ?></a>
    </div>
</div>
<?php } ?>
<script type="text/javascript">
    var m = '<?= $m; ?>', v = '<?= $v; ?>', products = {}, filters = <?= isset($filters) && !empty($filters) ? json_encode($filters) : '{}'; ?>, shop_color, shop_grid, sorting;
    var cart = <?= isset($cart) && !empty($cart) ? json_encode($cart) : '{}' ?>;
    var site = {base_url: '<?= base_url(); ?>', site_url: '<?= site_url('/'); ?>', shop_url: '<?= shop_url(); ?>', csrf_token: '<?= $this->security->get_csrf_token_name() ?>', csrf_token_value: '<?= $this->security->get_csrf_hash() ?>', settings: {display_symbol: '<?= $Settings->display_symbol; ?>', symbol: '<?= $Settings->symbol; ?>', decimals: <?= $Settings->decimals; ?>, thousands_sep: '<?= $Settings->thousands_sep; ?>', decimals_sep: '<?= $Settings->decimals_sep; ?>', order_tax_rate: false, products_page: <?= $shop_settings->products_page ? 1 : 0; ?>}, shop_settings: {private: <?= $shop_settings->private ? 1 : 0; ?>, hide_price: <?= $shop_settings->hide_price ? 1 : 0; ?>}}

    var lang = {};
    lang.page_info = '<?= lang('page_info'); ?>';
    lang.cart_empty = '<?= lang('empty_cart'); ?>';
    lang.item = '<?= lang('item'); ?>';
    lang.items = '<?= lang('items'); ?>';
    lang.unique = '<?= lang('unique'); ?>';
    lang.total_items = '<?= lang('total_items'); ?>';
    lang.total_unique_items = '<?= lang('total_unique_items'); ?>';
    lang.tax = '<?= lang('tax'); ?>';
    lang.shipping = '<?= lang('shipping'); ?>';
    lang.delivery_charges = '<?= lang('delivery_charges'); ?>';
    lang.total_w_o_tax = '<?= lang('total_w_o_tax'); ?>';
    lang.product_tax = '<?= lang('product_tax'); ?>';
    lang.order_tax = '<?= lang('order_tax'); ?>';
    lang.total = '<?= lang('total'); ?>';
    lang.grand_total = '<?= lang('grand_total'); ?>';
    lang.reset_pw = '<?= lang('forgot_password?'); ?>';
    lang.type_email = '<?= lang('type_email_to_reset'); ?>';
    lang.submit = '<?= lang('submit'); ?>';
    lang.error = '<?= lang('error'); ?>';
    lang.add_address = '<?= lang('add_address'); ?>';
    lang.update_address = '<?= lang('update_address'); ?>';
    lang.fill_form = '<?= lang('fill_form'); ?>';
    lang.already_have_max_addresses = '<?= lang('already_have_max_addresses'); ?>';
    lang.send_email_title = '<?= lang('send_email_title'); ?>';
    lang.message_sent = '<?= lang('message_sent'); ?>';
    lang.add_to_cart = '<?= lang('add_to_cart'); ?>';
    lang.out_of_stock = '<?= lang('out_of_stock'); ?>';
    lang.x_product = '<?= lang('x_product'); ?>';
</script>
<script src="<?= $assets; ?>js/libs.min.js"></script>

<script src="<?= $assets; ?>scripts/general.js?v=4"></script>

<script type="text/javascript">
<?php if ($message || $warning || $error || $reminder) { ?>
$(document).ready(function() {
    <?php if ($message) { ?>
        sa_alert('<?=lang('success');?>', '<?= trim(str_replace(array("\r","\n","\r\n"), '', addslashes($message))); ?>');
    <?php }  if ($reminder) { ?>
        sa_alert('<?=lang('reminder');?>', '<?= trim(str_replace(array("\r","\n","\r\n"), '', addslashes($reminder))); ?>', 'info');
    <?php } ?>
});
<?php } ?>
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f5a28a9f0e7167d000f2045/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<!-- <script src="https://embed.tawk.to/5f5a28a9f0e7167d000f2045/default"></script>
<script type="text/javascript">
    Tawk_API = Tawk_API || {};
    Tawk_API.onStatusChange = function (status){
    if(status === 'online'){
        document.getElementById('status').innerHTML = '<a href="javascript:void(Tawk_API.toggle())">Online - Prefer to chat</a>';
    }else if(status === 'away'){
        document.getElementById('status').innerHTML = 'We are currently away';
    }else if(status === 'offline'){
        document.getElementById('status').innerHTML = 'Live chat is Offline';
    }
};
</script> -->
</body>