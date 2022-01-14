<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Adroit Light Solutions">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript">if (parent.frames.length !== 0) { top.location = '<?= site_url(); ?>'; }</script>
        <title><?= $page_title; ?></title>
        <meta name="description" content="<?= $page_desc; ?>">
        <meta name="keywords" content="Scott Removals, house removals, movers, shifting">
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png">
        
        <meta property="og:url" content="<?= isset($product) && !empty($product) ? site_url('product/'.$product->slug) : site_url(); ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?= $page_title; ?>" />
        <meta property="og:description" content="<?= $page_desc; ?>" />
        <meta property="og:image" content="<?= isset($product) && !empty($product) ? base_url('assets/uploads/'.$product->image) : base_url('assets/uploads/logos/'.$shop_settings->logo); ?>" />

        <link rel="stylesheet" type="text/css" href="<?= $assets; ?>bootstrap/css/bootstrap.min.css?v=3">
        <link href="<?= $assets; ?>select2.min.css" rel="stylesheet" />
        <script type="text/javascript" src="<?= $assets; ?>jquery.min.js?v=3"></script>
        <script type="text/javascript" src="<?= $assets; ?>bootstrap/js/popper.min.js?v=3"></script>
        <script type="text/javascript" src="<?= $assets; ?>bootstrap/js/bootstrap.min.js?v=3"></script>
        <script src="<?= $assets; ?>bootstrap/js/bootstrap.min.js?v=3"></script>
        <script type="text/javascript" src="<?= $assets; ?>bootstrap/js/select2.min.js"></script>
        <!--- <script src="<?= $assets; ?>wow.min.js?v=3"></script>--->
        <script src="<?= $assets; ?>sweetalert.min.js"></script>
        <link rel="stylesheet" href="<?= $assets; ?>owl.carousel.min.css?v=3">
        <link rel="stylesheet" href="<?= $assets; ?>owl.theme.default.min.css?v=3">
        <script src="<?= $assets; ?>owl.carousel.min.js?v=3"></script>
        <script src="<?= $assets; ?>swiper.min.js?v=3"></script>
        <link rel="stylesheet" type="text/css" href="<?= $assets; ?>fontawesome/css/all.min.css?v=3">
        <link rel="stylesheet" type="text/css" href="<?= $assets; ?>animate.css?v=3">
        <link rel="stylesheet" href="<?= $assets; ?>jquery-ui.css">
        <!--Custom Stylesheet -->
        <link rel="stylesheet" type="text/css" href="<?= $assets; ?>style.css?v=3">
        <link rel="stylesheet" type="text/css" href="<?= $assets; ?>responsive.css?v=2">
        <!--Custom Js -->
        <script src="<?= $assets; ?>jquery-ui.js"></script>
        <script src="<?= $assets; ?>web.js?v=1"></script>
        <script src="<?= $assets; ?>jssor.slider.min.js" type="text/javascript"></script>
        <style>
         footer .social_media ul li:hover a{
            transform:scale(1.5);
            color: rgb(213, 4, 17);
        }</style>

        <script>
            $(document).ready(function(){
                $(".dropdown_content.select_moving ul li").mouseover(function() {
                    var sv = $(this).find('button svg').clone();
                    $('.company_van_img svg').remove();
                    $('.company_van_img').prepend(sv);  
                });
                $('.select2').select2();

            });
        </script>
        <script type="text/javascript">
        window.jssor_1_slider_init = function() {

            var jssor_1_SlideshowTransitions = [
              {$Duration:800,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $SpacingX: 5,
                $SpacingY: 5
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    </head>
<body>
<div class="body_wrapper">
    <!-- Header Start -->

    <section class="header_sec">
        <header>
           <!---<div class="top-header-wrapper">
                <div class="top-header mx-auto clearfix">
                    <div class="contact-social float-left min-h-31">
                        <ul class="m-0 d-flex align-center min-h-31 justify-content-center">
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
                    <div class="contact-social float-right min-h-31">
                        <ul class="m-0 d-flex align-center min-h-31 justify-content-center">
                            <li>
                                <a  href="tel:0141-390-8967" class="text-white pr-3">0141-390-8967</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>--->
            <div class="navbar-wrapper">
                <nav class="navbar navbar-expand-lg p-0 mx-auto navbar-light navbar_bg">
                    <a class="navbar-brand py-3" href="<?= base_url(''); ?>">
                        <img src="<?php echo base_url('assets/uploads/logos/'.$shop_settings->logo);?>" alt="scot Removals">
                    </a>
                    <a href="tel:0141-390-8967" class="my-auto margin-right-75 text-center d-lg-none" style="flex:2;"><button class=" call-us-mbl-btn">Call Us</button></a>
                    <div class="mobile d-lg-none d-block">
                        <div class="mainContainer" style="flex:1;">
                            <a href="#" class="menuBtn">
                                <span class="lines"></span>
                            </a>
                            <nav class="mainMenu">
                                <ul class="px-0">
                                    <li>
                                      <a href="<?= base_url();?>">Home</a>
                                    </li>
                                    <li>
                                      <a href="<?= base_url('shop/house_removal');?>">House Removals</a>
                                    </li>
                                    <li>
                                      <a href="<?= base_url('shop/furniture_delivery');?>">Furniture Delivery</a>
                                    </li>
                                    <li>
                                       <a href="<?= base_url('shop/office_removal');?>">Office Removals</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('shop/piano_removal');?>">Piano Removals</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('shop/man_and_van');?>">Man & Van</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('shop/why_us');?>">Why Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item <?php if($menu_active == "home"){ echo "active"; } ?>">
                                <a class="nav-link" href="<?= base_url('');?>">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item <?php if($menu_active == "house_removal"){ echo "active"; } ?>">
                                <a class="nav-link" href="<?= base_url('shop/house_removal');?>">House Removals</a>
                            </li>
                            <li class="nav-item <?php if($menu_active == "furniture_delivery"){ echo "active"; } ?>">
                                <a class="nav-link " href="<?= base_url('shop/furniture_delivery');?>">Furniture Delivery</a>
                            </li>

                            <li class="nav-item <?php if($menu_active == "office_removal"){ echo "active"; } ?>">
                                <a class="nav-link " href="<?= base_url('shop/office_removal');?>">Office Removals</a>
                            </li>

                            <li class="nav-item <?php if($menu_active == "piano_removal"){ echo "active"; } ?>">
                                <a class="nav-link " href="<?= base_url('shop/piano_removal');?>">Piano Removals</a>
                            </li>
                            <!---<li class="nav-item position-relative <?php if($menu_active == "piano_removal"){ echo "active"; }else if($menu_active == "house_removal"){ echo "active"; }else if($menu_active == "furniture_delivery"){ echo "active"; }else if($menu_active == "office_removal"){ echo "active"; }else if($menu_active == "piano_removal"){ echo "active";} ?>">
                                <a class="nav-link" href="javascript:void(0)">Removal Services</a>
                                <div class="scot-dropdown-hover position-absolute">
                                    <ul class="list-unstyled">
                                        <li class="<?php if($menu_active == "house_removal"){ echo "active"; } ?>">
                                            <a href="<?= base_url('shop/house_removal');?>">House Removals</a>
                                        </li>
                                        <li class="<?php if($menu_active == "furniture_delivery"){ echo "active"; } ?>">
                                            <a  href="<?= base_url('shop/furniture_delivery');?>">Furniture Delivery</a>
                                        </li>
                                        <li class="<?php if($menu_active == "office_removal"){ echo "active"; } ?>">
                                            <a  href="<?= base_url('shop/office_removal');?>">Office Removals</a>
                                        </li>
                                        <li class="<?php if($menu_active == "piano_removal"){ echo "active"; } ?>">
                                            <a  href="<?= base_url('shop/piano_removal');?>">Piano Removals</a>
                                        </li>
                                    </ul>
                                </div>    
                            </li>--->
                            <!---<li class="nav-item <?php if($menu_active == "man_and_van"){ echo "active"; } ?>">
                               <a class="nav-link" href="<?= base_url('shop/man_and_van');?>">Man & Van</a>
                            </li>--->
                            <!---<li class="nav-item members-hover <?php if($menu_active == "my_order"){ echo "active"; } ?>">
                                <a class="nav-link" href="<?= base_url('shop/my_order');?>">My Orders</a>
                            </li>--->
                            <li class="nav-item members-hover <?php if($menu_active == "why_us"){ echo "active"; } ?>">
                                <a class="nav-link" href="<?= base_url('shop/why_us');?>">Why Us</a>
                            </li>
                            <!---- <li class="">
                                <a href="#" class="nav-link"><i class="fa fa-headset"></i></a>
                            </li>---->
                            </ul>
                            <!---<div class="d-flex justify-content-center align-center head-phone nav-link pr-0">
                            <i class="text-white fas fa-phone-alt"></i>
                            <p class="head-phone-text"><a href="tel:0141-390-8967" class="text-white text-decoration-none p-0">0141-390-8967</a></p>
                            </div>---->
                    </div>
                </nav>
            </div>    
            
        </header>
    </section>
    
    <!-- Header End -->