<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="slider-container position-relative">
    <div class="alawi-banner" style="background:url('<?php echo base_url();?>assets/images/vegetable2.png')!important;height:260px;background-size:cover !important;background-repeat:no-repeat !important;"><h3><?= $page_heading;?></h3></div>
</section>    
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="row ">
                    <div class="col-sm-12">

                        <div class="panel panel-default margin-top-lg">
                            <!-- <div class="panel-heading text-bold">
                                <i class="fa fa-list-alt margin-right-sm"></i> <?= $product->name.' ('.$product->code.')'; ?>
                              
                            </div> -->
                            <div class="panel-body mprint ">

                                <div class="row">
                                    <div class="col-sm-5">

                                        <div class="photo-slider">
                                            <div class="carousel slide article-slide" id="photo-carousel">

                                                <div class="carousel-inner cont-slider">
                                                    <div class="item active">
                                                        <a href="#" data-toggle="modal" data-target="#lightbox">
                                                            <img class="br-r-4" src="<?= base_url() ?>assets/uploads/<?= $product->image ?>" alt="<?= $product->name ?>" class="img-responsive img-thumbnail"/>
                                                        </a>
                                                    </div>
                                                    <?php
                                                    if (!empty($images)) {
                                                        foreach ($images as $ph) {
                                                            echo '<div class="item"><a href="#" data-toggle="modal" data-target="#lightbox"><img class="img-responsive img-thumbnail" src="' . base_url('assets/uploads/' . $ph->photo) . '" alt="' . $ph->photo . '" /></a></div>';
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                                <ol class="carousel-indicators">
                                                    <li class="active" data-slide-to="0" data-target="#photo-carousel">
                                                        <img class="img-thumbnail" alt="" src="<?= base_url() ?>assets/uploads/thumbs/<?= $product->image ?>">
                                                    </li>
                                                    <?php
                                                    $r = 1;
                                                    if (!empty($images)) {
                                                        foreach ($images as $ph) {
                                                            echo '<li class="" data-slide-to="'.$r.'" data-target="#photo-carousel"><img class="img-thumbnail" alt="" src="'.base_url('assets/uploads/thumbs/' . $ph->photo).'"></li>';
                                                            $r++;
                                                        }
                                                    }
                                                    ?>

                                                </ol>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                       
                                    </div>

                                    <div class="col-sm-7">
                                        <div class="clearfix"></div>
                                        <div class="responsive_view">
                                            <div class="product_name">
                                                <h3><?= $product->name; ?><span class="p-link"><a href="<?= shop_url('products'); ?>" class="pull-sm-right text_success"> <?= lang('products'); ?></a></span></h3>
                                            </div>
                                            <p class="category_title"><?= lang("category"); ?>: <span><?= '<a href="'.site_url('category/'.$category->slug).'" class="line-height-lg ">'.$category->name.'</a>'; ?></span></p>
                                            <h3><?= $product->product_details; ?></h3>
                                            <?php if (!$shop_settings->hide_price) { ?>
                                                <h2 class="price_product text_success"><?= $this->sma->convertMoney($product->price); ?></h2>
                                            <?php } ?>
                                        </div>   
                                        <?php if (!$shop_settings->hide_price) { ?>
                                        <?= form_open('cart/add/'.$product->id, 'class="validate"'); ?>

                                        <div class="form-group mt-50">
                                                <div class="input-group">
                                                <input type="text" name="quantity" class="form-control text-center quantity-input" value="1" style="width:40%;height:38px;float:left;border-top-left-radius:4px;border-bottom-left-radius:4px;" required="required">
                                                <span class="input-group-addon pointer btn-plus product_increament_icon" style="border-bottom: 0px;background:#e1e1e1;
                                                border-left: 0px;border-top-right-radius:4px;"><span class="fa fa-plus"></span></span>
                                                <span class="input-group-addon pointer  btn-minus product_increament_icon" style="border-bottom-right-radius:4px;background:#ebebeb;"><span class="fa fa-minus"></span></span>
                                            </div>
                                        </div>

                                        <div class="form-group mt-50">
                                            <div class="btn-group" style="border:0px;" role="group" aria-label="...">
                                                <button type="submit" class="btn btn-theme bg-black_div br-r-4 btn-lg"><i class="fa fa-shopping-cart padding-right-md"></i> <?= lang('add_to_cart'); ?></button>
                                            </div>
                                        </div>
                                        <?= form_close(); ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <!-- <div class="col-xs-12">
                                    <?= $product->product_details ? '<div class="panel panel-default"><div class="panel-heading">' . lang('product_details') . '</div><div class="panel-body">' . $product->product_details . '</div></div>' : ''; ?>
                                    <?= $product->details ? '<div class="panel panel-info"><div class="panel-heading">' . lang('product_details_for_invoice') . '</div><div class="panel-body">' . $product->details . '</div></div>' : ''; ?>

                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="">
    <div class="row">
        <?php
        if (!empty($other_products)) {
            ?>
            <div class="col-xs-12">
                <h3 class="margin-top-no f-18 py-20 medium-font">
                    <?= lang('other_products'); ?>
                </h3>
            </div>
            <div class="row">
            <div class="col-xs-12">
                <!-- <?php
                foreach ($other_products as $fp) {
                    ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="product" style="z-index: 1;">
                            <div class="details" style="transition: all 100ms ease-out 0s;">
                                <img src="<?= base_url('assets/uploads/'.$fp->image); ?>" alt="">
                                <?php if (!$shop_settings->hide_price) { ?>
                                <div class="image_overlay"></div>
                                <div class="btn add-to-cart" data-id="<?= $fp->id; ?>"><i class="fa fa-shopping-cart"></i> <?= lang('add_to_cart'); ?></div>
                                <?php } ?>
                                <div class="stats-container">
                                    <?php if (!$shop_settings->hide_price) { ?>
                                    <span class="product_price">
                                        <?php
                                        echo $this->sma->convertMoney($fp->price);
                                        ?>
                                    </span>
                                    <?php } ?>
                                    <span class="product_name">
                                        <a href="<?= site_url('product/'.$fp->slug); ?>"><?= $fp->name; ?></a>
                                    </span>
                                    <a href="<?= site_url('category/'.$fp->category_slug); ?>" class="link"><?= $fp->category_name; ?></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        
                    </div>
                    <?php
                }
                ?> -->
                <?php
                foreach ($other_products as $fp) {
                ?>
                <div class="product-container col-sm-6 col-md-3 ">
                  <div class="product br-r-4 p-0 alt ">
                        <div class="product-top">
                            <div class="product-image">
                                <a class=" text-decoration" href="<?= site_url('product/'.$fp->slug); ?>">
                                    <div class="img" style="background:url('<?= base_url('assets/uploads/'.$fp->image); ?>');background-repeat:no-repeat;background-size:cover;"></div>
                                    
                                </a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="product-bottom">
                            <div class="product-desc">
                                <h2 class="text-center product-name"><a class="product-name text-decoration" href="<?= site_url('product/'.$fp->slug); ?>"><?= $fp->name; ?></a></h2>
                                <h2 class="text-center p-category"><a href="<?= site_url('category/'.$fp->category_slug); ?>" class="link p-category text-decoration"><?= $fp->category_name; ?></a></h2>
                            </div>
                            <div class="product-price" style="color:#000000 !important;">
                                <span class="product_price">
                                    <?php echo $fp->product_details; ?>
                                </span>
                            </div>
                            <div class="product-price">
                                <?php if (!$shop_settings->hide_price) { ?>
                                <span class="product_price">
                                    <?php
                                    echo $this->sma->convertMoney($fp->price);
                                    ?>
                                </span>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                            <div class="product-cart-button pt-20">
                            <?php if (!$shop_settings->hide_price) { ?>
                                <div class="btn-group" role="group" aria-label="...">
                                
                                    <button class="btn bg_success add-to-cart w-100 h-40 " data-id="<?= $fp->id; ?>" style="border-radius:0px 0px 4px 4px;font-weight:500;
                                font-size:15px;font-family:hal-medium;" data-id="144"> Add to Cart</button>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                  <div class="clearfix"></div>
              </div>
            <?php
          }
        ?>
            <?php
        }
        ?>
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
</div>

</section>

<div id="lightbox" class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="modal-body">
                <img src="" alt="" />
            </div>
        </div>
    </div>
</div>
