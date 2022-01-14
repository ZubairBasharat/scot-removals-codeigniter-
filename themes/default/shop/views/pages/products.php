<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    @media(max-width:767px){
    .page-contents .col-xs-12 , .page-contents .col-md-6 , .page-contents .col-sm-6 , .page-contents .col-sm-12  {
        padding:0px !important;
    }
    .row{
        margin:0px !important;
    }
    #grid-selector ul{
        padding-left:15px !important;
    }
}
</style>
<div class="alawi-banner" style="background:url('<?php echo base_url();?>assets/images/vegetable2.png')!important;height:260px;background-size:cover !important;background-repeat:no-repeat !important;"><h3><?= $page_heading; ?></h3></div>
<div id="grid-selector">
<div class="h-68 container p-0 px-2">
    <ul class="inline-list h-100 float-left mb-0">
        <?php if (!$shop_settings->hide_price) { ?>
            <li> 
             <h5 class="title" style="margin-right:10px;"><span><?= lang('price_range'); ?></span></h5>
              
           </li> 
                <li class="h-100">
                 <input type="text" name="min-price" id="min-price" value="" placeholder="Min" class="h-100 text-center bg_light_grey" style="width:55px;border:none;"></input>        
                 <input type="text" name="max-price" id="max-price" value="" placeholder="Max" class="h-100 text-center bg_light_grey" style="width:55px;border:none;"></input>
            </li>  
        <?php } ?> 
    </ul>
    <ul class="list-inline h-100 float-right mb-0 d-align-center">
     
    <li class="d-flex h-100">        
        <div id="grid-sort" class="d-align-center h-100">
           <h3 class="title mb-0"><span class="pb-0"><?= lang('sort'); ?></span></h3> :
            <div class="sort">
                <select name="sorting" id="sorting" class="selectpicker bg-none" data-style="btn-sm" data-width="150px">
                    <option value="name-asc"><?= lang('name_asc'); ?></option>
                    <option value="name-desc"><?= lang('name_desc'); ?></option>
                    <option value="price-asc"><?= lang('price_asc'); ?></option>
                    <option value="price-desc"><?= lang('price_desc'); ?></option>
                    <option value="id-desc"><?= lang('id_desc'); ?></option>
                    <option value="id-asc"><?= lang('id_asc'); ?></option>
                    <option value="views-desc"><?= lang('views_desc'); ?></option>
                    <option value="views-asc"><?= lang('views_asc'); ?></option>
                </select>
            </div>
        </div>
    </li>
    <li class="pr-0">          
        <div id="grid-menu" class="hidden-xs hidden-sm tabs_svg">   
            <!-- <?= lang('grid'); ?>: -->
            <ul class="d-align-center">
                <li class="two-col " style="margin-right:15px;"><img class="svg" src="<?php echo base_url();?>assets/images/grid.svg"></li>
                <li class="three-col active"><img class="svg" src="<?php echo base_url();?>assets/images/list.svg"></li>
            </ul>
        </div>
    </li>   
    </ul>    
    <!-- <span class="page-info"></span> -->
</div>
</div>
<section class="page-contents">
    <div class="container">
    <div class="row">
        <div class="row m-0">
            <div class="col-md-12 pt-20 page_info text-right">
                <span class="page-info line-height-xl hidden-xs hidden-sm"></span>
            </div>
            <div class="col-md-12">
                <div id="pagination" class="pagination-right"></div>
            </div>
        </div>

        <div class="col-xs-12 my-20 products-top">
            <div class="row m-0">
                <div class="col-sm-12 col-md-12">
                    <div id="loading">
                        <div class="wave">
                            <div class="rect rect1"></div>
                            <div class="rect rect2"></div>
                            <div class="rect rect3"></div>
                            <div class="rect rect4"></div>
                            <div class="rect rect5"></div>
                        </div>
                    </div>
                    

                    <div class="clearfix"></div>
                    <div class="row">
                        <div id="results" class="grid"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
                <div class="row m-0">
                    <div class="col-md-12 pt-20 page_info text-right">
                        <span class="page-info line-height-xl hidden-xs hidden-sm"></span>
                    </div>
                    <div class="col-md-12">
                        <div id="pagination" class="pagination-right "></div>
                    </div>
                </div>
                <div id="content-slider" class="col-xs-12">
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
</section>
