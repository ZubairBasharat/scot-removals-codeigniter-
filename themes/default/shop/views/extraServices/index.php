<?php $selected_products = !empty($storage) ? json_decode($storage->products_list) : array();
$type = !empty($storage) ? $storage->type : "";
$storage_id = !empty($storage) ? $storage->id : 0;
$storage_id = !empty($storage) ? $storage->id : 0;
$price = $storage->km+$storage->price;
$price = ceil($price)+0;
if($price<40)
{
    $price = 40;
}
?>
<section class="banner_main px-0">
    <div class="container-custom mx-auto">
        <div class="row m-0">
            <div class="col-md-8 pl-0 pr-md-3 pr-0">
            <div class="mb-4 position-relative d-md-none">
                  <div class="position-absolute" style="bottom: 0px; left: -12px; z-index: 99;">
                     <img src="<?php echo base_url('assets/images/helpline.png');?>" class="img-fluid helpline-img">
                  </div>
                  <div class="helpline position-relative py-1">
                     <span class="helpline-shape"></span>
                     <div class="mt-4 mb-4 px-5">
                        <p class="text-center helpline-text mb-0">Prefer to get a price over the phone?</p>
                        <p class="text-center helpline-num"><a class="num-clr" href="tel:0141-390-8967">0141-390-8967</a></p>
                     </div>
                  </div>
               </div>
                <div class="tabs_sec bg-none">
                    <h3 class="header-title-collapse mb-3 ">You can add extra service</h3>
                    <!-- <p class="extra-ser-text pl-1">You can add extra service on the next step</p> -->
                    <div id="accordion">
                        <?php $i = 0; if(!empty($products)){ ?>
                            <?php foreach($products as $p){ ?>
                                <?php if($p->add_limit_check == 2){ ?>
                                    <?php if($i == 0){ ?>
                                        <h3 class="header-title-collapse-inner">Packing service</h3>
                                    <?php } ?>
                                <?php $i++; } ?>
                                <div class="card mb-2">
                                    <div class="card-header py-1 border-bottom-0 bg-white px-sm-custom" id="headingOne_<?=$p->id?>">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed w-100 d-flex align-center text-left" data-toggle="collapse" data-target="#collapseOne_<?=$p->id?>" aria-expanded="true" aria-controls="collapseOne_<?=$p->id?>">
                                                <?=$p->name?>
                                                <span class="ml-auto collapse-icon"></span>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne_<?=$p->id?>" class="collapse extra_services" aria-labelledby="headingOne_<?=$p->id?>" data-parent="#accordion">
                                        <div class="card-body px-sm-10">
                                            <?php if(!empty($p->sub_products)){ ?>
                                                <?php foreach($p->sub_products as $sp){ ?>
                                                    <div class="tab-content">
                                                        <div class="tab-pane bg-none target_add_input Living product_tabs active show" data-id="<?=$sp->id?>" id="living" role="tabpanel" aria-labelledby="home-tab">
                                                            <div class="items_counter border-bottom-sr">
                                                                <div class="item_catagory">
                                                                    <div class="item_catagory_inner" data-id="<?=$sp->id?>" id="counter_<?=$sp->id?>">
                                                                        <p data-id="<?=$sp->id?>" class="products<?=$sp->id?>" onclick="add_item_list('<?=$sp->id?>')"><span class="item_title<?=$sp->id?>"><?=$sp->name?></span><span class="fa fa-plus ml-auto mr-3 item_category_add<?=$sp->id?>"></span></p>
                                                                    </div>
                                                                    <div class="add_counter counter_<?=$sp->id?>" style="display: none;">
                                                                        <ul class="d-flex align-center" data-item="1" data-id="1">
                                                                            <li>
                                                                                <button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('<?=$sp->id?>')"></button>
                                                                            </li>
                                                                            <li>
                                                                                <input class="item_catagory_value" id="item_val_<?=$sp->id?>" data-id="0" type="number" value="1" onchange="change_qty('<?=$sp->id?>')" data-item="0" />
                                                                            </li>
                                                                            <li>
                                                                                <button class="fa fa-plus item_catagory_plus" onclick="add_qty('<?=$sp->id?>')"></button>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        
                        <!-- <div class="card mb-2">
                            <div class="card-header py-1 border-bottom-0 bg-white  px-sm-custom" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link w-100 d-flex align-center text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Reassembly Service
                                        <span class="ml-auto collapse-icon"></span>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse extra_services" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body  px-sm-10">
                                    <div class="tab-content">
                                        <div class="tab-pane bg-none target_add_input Living product_tabs active show" data-id="498" id="living" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="items_counter border-bottom-sr">
                                                <div class="item_catagory">
                                                    <div class="item_catagory_inner" data-id="363" id="counter_370">
                                                        <p data-id="363" class="products363" onclick="add_item_list('363')"><span class="item_title363">Bed</span><span class="fa fa-plus ml-auto mr-3 item_category_add363"></span></p>
                                                    </div>
                                                    <div class="add_counter counter_370" style="display: none;">
                                                        <ul class="d-flex align-center" data-item="1" data-id="1">
                                                            <li>
                                                                <button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('363')"></button>
                                                            </li>
                                                            <li>
                                                                <input class="item_catagory_value" id="item_val_363" data-id="0" type="number" value="1" onchange="change_qty(363)" data-item="0" />
                                                            </li>
                                                            <li>
                                                                <button class="fa fa-plus item_catagory_plus" onclick="add_qty('363')"></button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="header-title-collapse-inner">Packing service</h3> -->
                        <!-- <div class="card mb-2">
                            <div class="card-header py-1 border-bottom-0 bg-white px-sm-custom" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link w-100 d-flex align-center text-left collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                         Packaging Material 
                                         <span class="ml-auto collapse-icon"></span>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse extra_services" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body px-sm-10">
                                    <div class="tab-content">
                                        <div class="tab-pane bg-none target_add_input Living product_tabs active show" data-id="498" id="living" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="items_counter border-bottom-sr">
                                                <div class="item_catagory">
                                                    <div class="item_catagory_inner" data-id="363" id="counter_34">
                                                        <p data-id="363" class="products363" onclick="add_item_list('363')"><span class="item_title363">Bed</span><span class="fa fa-plus ml-auto mr-3 item_category_add363"></span></p>
                                                    </div>
                                                    <div class="add_counter counter_34" style="display: none;">
                                                        <ul class="d-flex align-center" data-item="1" data-id="1">
                                                            <li>
                                                                <button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('363')"></button>
                                                            </li>
                                                            <li>
                                                                <input class="item_catagory_value" id="item_val_363" data-id="0" type="number" value="1" onchange="change_qty(363)" data-item="0" />
                                                            </li>
                                                            <li>
                                                                <button class="fa fa-plus item_catagory_plus" onclick="add_qty('363')"></button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header py-1 border-bottom-0 bg-white px-sm-custom" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link w-100 d-flex align-center text-left collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Supply and Pack Service 
                                        <span class="ml-auto collapse-icon"></span>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse extra_services" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="card-body px-sm-10">
                                   <div class="tab-content">
                                        <div class="tab-pane bg-none target_add_input Living product_tabs active show" data-id="498" id="living" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="items_counter border-bottom-sr">
                                                <div class="item_catagory">
                                                    <div class="item_catagory_inner" data-id="363" id="counter_50">
                                                        <p data-id="363" class="products363" onclick="add_item_list('363')"><span class="item_title363">Bed</span><span class="fa fa-plus ml-auto mr-3 item_category_add363"></span></p>
                                                    </div>
                                                    <div class="add_counter counter_50" style="display: none;">
                                                        <ul class="d-flex align-center" data-item="1" data-id="1">
                                                            <li>
                                                                <button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('363')"></button>
                                                            </li>
                                                            <li>
                                                                <input class="item_catagory_value" id="item_val_363" data-id="0" type="number" value="1" onchange="change_qty(363)" data-item="0" />
                                                            </li>
                                                            <li>
                                                                <button class="fa fa-plus item_catagory_plus" onclick="add_qty('363')"></button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div
                        </div>-->
                    </div>
                </div>
                <div class="comment-box w-100">
                   <h3 class="header-title-collapse-inner">Any special requirements or notes</h3>
                    <form class="w-100" action="" method="">
                        <textarea></textarea>
                    </form>
                </div>
                <div class="d-none d-md-block instance_btn w-100 mr-sm-2 mr-0 mt-3 position-relative">
                    <a onclick="getPrices();" href="javascript:void(0);" class="price_btn w-100">
                        Proceed to Booking
                    </a>
                    <div class="spinner-border position-absolute text-white button-spinner" role="status" style="display:none;right:10px;top:23%;width:1.5rem;height:1.5rem;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-md-0 mt-4 pr-0 pl-0 pl-md-3">
                <div class="mb-4 position-relative d-none d-md-block">
                  <div class="position-absolute" style="bottom: 0px; left: -12px; z-index: 99;">
                     <img src="<?php echo base_url('assets/images/helpline.png');?>" class="img-fluid helpline-img">
                  </div>
                  <div class="helpline position-relative py-1">
                     <span class="helpline-shape"></span>
                     <div class="mt-4 mb-4 px-5">
                        <p class="text-center helpline-text mb-0">Prefer to get a price over the phone?</p>
                        <p class="text-center helpline-num"><a class="num-clr" href="tel:0141-390-8967">0141-390-8967</a></p>
                     </div>
                  </div>
                </div>
                <div class="tabs_sec cart px-0 pb-0 bg-white item_counter_box">
                    <div class="item_header pb-3 pt-2">
                        <h3>My Item List<span id="items_length" style="font-size: 20px;"></span></h3>
                    </div>
                    <div class="counter-body">
                        <div class="items_counter first_row">
                            <div class="item_catagory_list">
                                <div class="item_catagory_inner_list" data-id="0"></div>
                            </div>
                        </div>
                    </div>
                    <div class="extra_services_container" style="display: none;"> 
                        <div class="py-2 item_inner_header">
                           <span>Extra Services Items</span>
                        </div>
                        <div class="counter-body-extra-services">
                        </div>
                     </div>
                    <div class="text-right mt-4 mb-1">
                       <button class="edit_jobs_btn py-1 px-2 bg-none border mr-2 d-flex align-items-center ml-auto border-left" onclick="edit_job()">Edit Jobs</button>
                   </div>
                <div class="edit_jb_items px-2  align-center py-3 ">
                    <div class="d-flex flex-wrap">
                        <span class="scot-blue">Pickup Location</span>
                        <a href="javascript:void(0)" class="ml-auto" onclick="edit_location();"><img class="svg" src="<?php echo base_url();?>assets/images/edit.svg"></a>
                    </div>
                    <P class="mb-3"><?= $storage->pickup_location ?></p>
                    <span class="privacy-1h">Drop Off Location</span>
                    <P class="mb-0"><?= $storage->drop_location ?></p>
                     <div class="d-flex flex-wrap border-top mt-3 mx-min-m px-2 pt-3">
                        <h6 class="mb-0">Total Price</h6>
                        <P class="mb-0 ml-auto font-bd">£<span id="t_price"><?= $price;?></span>.00</p>
                    </div>
                </div>   
                </div>
            </div>
            <div class="d-block d-md-none instance_btn w-100 mr-sm-2 mr-0 mt-3 position-relative">
                <a onclick="getPrices();" href="javascript:void(0);" class="price_btn w-100">
                    Proceed to Booking
                </a>
                <div class="spinner-border position-absolute text-white button-spinner" role="status" style="display:none;right:10px;top:23%;width:1.5rem;height:1.5rem;">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</section>
<script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAQxRGo3kiHw9CBikEzmWtzrz1Lsz88Pk"></script>
<script>
   let current_house_removals = [];
   let new_current_house_removals = [];
   totsl_items = 0;
   " <?php if(!empty($selected_products)){ foreach($selected_products as $product){ ?>"
    counter = 0;
    // $(".counter-body").append('<div class=" items_counter_list'+id+' all_items mb-1px" data-id='+id+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+id+'" >'+ item_name +'</p></div><div class="add_counter h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value'+id+'" type="number" value="'+ 1 +'" data-item="1"></li><li class="h-100 d-flex align-center"><button class="h-100 border-0 px-2 bg-silver d-flex align-center" data-toggle="modal" data-target="#add_item_modal"><img src="<?php echo base_url();?>assets/images/edit.svg" style="width:19px;"></button></li></ul></div></div></div>');
    "<?php if($product->type!="extra_services"){ ?>"
       $(".tabs_sec .counter-body").append('<div class="items_counter item_list list_counter_right'+<?= $product->id ?>+' item_row'+<?= $product->id ?>+' mb-1px" data-id='+"<?= $product->id ?>"+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+'><p class="item_name'+"<?= $product->id ?>"+'" data-id = "data-id='+"<?= $product->id ?>"+'">'+ "<?= $product->name ?>" +'</p><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input class="item_catagory_value<?= $product->id?>" readonly type="number" value="<?= $product->quantity?>" onchange="change_qty(<?= $product->id?>)" data-item="<?= $product->id?>"></li></ul></div></div></div></div><input type="hidden" class="type_'+<?= $product->id ?>+'" value="<?= $product->type ?>"><input type="hidden" class="tab_'+<?= $product->id ?>+'" value="<?= $product->tab ?>">');
    "<?php }else{ ?>" 
        $(".extra_services_container").css("display","block");
        $(".counter-body-extra-services").append('<div class="items_counter item_list list_counter_right'+<?= $product->id ?>+' item_row'+<?= $product->id ?>+' mb-1px" data-id='+"<?= $product->id ?>"+'><div class="item_catagory"><div class="item_catagory_inner" data-id='+"<?= $product->id ?>"+'><p class="item_name'+"<?= $product->id ?>"+'" data-id = "data-id='+"<?= $product->id ?>"+'">'+ "<?= $product->name ?>" +'</p><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input class="item_catagory_value<?= $product->id?>" readonly type="number" value="<?= $product->quantity?>" onchange="change_qty(<?= $product->id?>)" data-item="<?= $product->id?>"></li></ul></div></div></div></div><input type="hidden" class="type_'+<?= $product->id ?>+'" value="<?= $product->type ?>"><input type="hidden" class="tab_'+<?= $product->id ?>+'" value="<?= $product->tab ?>">');
    "<?php } ?>"       
       $(".counter_"+"<?= $product->id ?>").css("display","block");
            $(".item_category_add"+"<?= $product->id ?>").css("display","none");
            $("#item_val_"+"<?= $product->id ?>").val("<?= $product->quantity ?>");
            $(".products"+"<?= $product->id ?>").removeAttr('onclick');
            $("#item_val_"+"<?= $product->id ?>").attr('data-id',1);
            counter++;
         totsl_items += parseInt("<?= $product->quantity ?>");
     " <?php }} ?>"
         $('#items_length').text(" ("+totsl_items+")");
//    if(localStorage.getItem('extra_service')!=null)
//    {
//       var current_house_removals_items = JSON.parse(localStorage.getItem('extra_service'));
//       var counter = 0;
//       $.each(current_house_removals_items , function(index,value){
//          var append = true;
//          var next = 0;
//          if(current_house_removals_items[counter].quantity >=1)
//          {
//             " <?php if(!empty($selected_products)){ foreach($selected_products as $product){ ?>"
//                 if("<?=$product->id?>"==current_house_removals_items[counter].id)
//                 {
//                     append = false;
//                 }
//                 else
//                 {
//                     apend = true;
//                 }
//             " <?php }} ?>"
//             if(append==true)
//             {
//               $(".counter-body").append('<div class="item_list items_counter_list'+current_house_removals_items[counter].id+' all_items mb-1px" data-id='+current_house_removals_items[counter].id+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+current_house_removals_items[counter].id+'" >'+ current_house_removals_items[counter].name +'</p></div><div class="add_counter h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex align-center" data-item="1" data-id="1"><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value'+current_house_removals_items[counter].id+'" type="number" value="'+ current_house_removals_items[counter].quantity +'" data-item="1"></li><li class="h-100 d-flex align-center"><button class="h-100 border-0 px-2 bg-silver d-flex align-center" data-toggle="modal" data-target="#add_item_modal"><img src="<?php echo base_url();?>assets/images/edit.svg" style="width:19px;"></button></li></ul></div></div></div>');
//             }
//          $(".counter_"+current_house_removals_items[counter].id).css("display","block");
//          $(".item_category_add"+current_house_removals_items[counter].id).css("display","none");
//          $("#item_val_"+current_house_removals_items[counter].id).val(current_house_removals_items[counter].quantity);
//          $(".products"+current_house_removals_items[counter].id).removeAttr('onclick');
//          $("#item_val_"+current_house_removals_items[counter].id).attr('data-id',1);
//          current_house_removals_obj = {"name":current_house_removals_items[counter].name , "id":current_house_removals_items[counter].id , "quantity":current_house_removals_items[counter].quantity};
//         current_house_removals.push(current_house_removals_obj);
//         localStorage.setItem('extra_service', JSON.stringify(current_house_removals));
//          counter++;
//          }
//       });
//    }
   var home = new Array();
   $('.nav-tabs .nav-item:nth-child(1) .nav-link').addClass('active');
   $('.tab-pane.product_tabs:nth-child(1)').addClass('active show');
   function getPrices(){
        var main = $(".tabs_sec");
        var slug = "<?=$storage->slug?>";
        var sub = $(main).find('.items_counter');
        let ids = [];
        let qtys = [];
        let home = [];
        var i = 0;
        var premium_price = 0;
        var next = 0;
        // $.each(sub, function( index, value ) {
         // var name = $(value).find('p').text();
            // var id = $(value).find('p').attr('data-id');
            // var qty = $(value).find('ul').find('.item_catagory_value').val();
            // if(qty > 0){
                // //  ids[i] = [id, qty];
                // ids.push(id);
                // qtys.push(qty);
            // }
            // i++;
        // });
         $(".item_list").each(function(){
        var product_id  =  $(".item_list").eq(next).attr('data-id');
        var producd_name = $(".item_name"+product_id).text();
        var product_qty =  $(".item_catagory_value"+product_id).val();
        var type = $(".type_"+product_id).val();
		if(product_qty > 0){
			ids.push(product_id);
            qtys.push(product_qty);
        }
        next++;
         });
        $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/getPrices'); ?>',
            dataType: 'json',
            data: {'id': ids, 'qty': qtys, 'slug': slug, 'type': "extra_services"},
            beforeSend: function() {
               $('.button-spinner').show();
               $('.price_btn').attr('disabled', 'disabled');
            },
              success: function(data) {
                if(data[0] != null){
                    // alert(data[0].price);
                  var service = new google.maps.DistanceMatrixService;
                  service.getDistanceMatrix({
                  origins: ['<?= $storage->pickup_location?>'],
                  destinations: ['<?=$storage->drop_location?>'],
                  travelMode: 'DRIVING',
                  unitSystem: google.maps.UnitSystem.METRIC,
                  avoidHighways: false,
                  avoidTolls: false
                  }, function(response, status) {
                  if (status !== 'OK') {
                     alert('Error was: ' + status);
                  } else {
                     var originList = response.originAddresses;
                     var destinationList = response.destinationAddresses;
                     var amount = 0;
                     var price = 0;
                     var km = 0;
                     for (var i = 0; i < originList.length; i++) {
                           var results = response.rows[i].elements;
                           for (var j = 0; j < results.length; j++) {
                              var kilometers = results[j].distance.text;
                              kilometers = kilometers.replace(' km', '');
                              // alert(kilometers);
                              price = parseFloat(data[0].price);
                              price = premium_price+price;
                              km = parseFloat(kilometers)*0.621371;
                              km = parseFloat(km)*0.80;
                              amount = parseFloat(km) + parseFloat(price);
                              if(amount<40)
                              {
                                  amount = 40;
                              }
                              localStorage.setItem('price',amount);
                              $.ajax({
                                    type: "GET",
                                    url: '<?php echo base_url('shop/save_storage'); ?>',
                                    dataType: 'json',
                                    data: {'slug': '<?= !empty($storage) ? $storage->slug : '' ?>', 'type': '<?= !empty($storage) ? $storage->type : '' ?>', 'pickup': '<?= !empty($storage) ? $storage->pickup_location : '' ?>', 'drop': '<?= !empty($storage) ? $storage->drop_location : '' ?>' , 'storage_id': '<?= !empty($storage) ? $storage->id : '' ?>', 'price': price, 'km': km, 'total': Math.ceil(amount) , 'items' : home},
                                    success:function(data)
                                    {
                                        $('.button-spinner').hide();
                                        window.location.href = '<?= base_url('shop/price_options/');?>'+data;
                                    }
                                });
                           }
                     }
                  }
                  });
                }else{
                    alert(data[0].label);
                }
            },
            error: function(data) { alert('Ajax call failed'); }
        });
    }
   function add_product(product,id)
   {
      $('#searchResult').hide();
      $('#searchResult').css('z-index', '-1');     
       var next = 0;
       var append = false;
   $(".item_catagory_inner ").each(function(){
      var a = $(".item_catagory_inner").eq(next).attr("data-id");
       if(a==id)
       {
          append = false;
          return false;
       }
       else
       {
          append = true;
       }
       next++;
   });
   if(append)
   {
      var tab =  $(".active.tabs").attr('data-name');
    //   $(".active.target_add_input").append('<div class="c_ui_add items_counter o_category"><div class="item_catagory"><div class="item_catagory_inner" data-id='+id+' id="counter_' + id + '"><p><span class="item_title">' + product + '</span> <span class="fa fa-plus ml-auto mr-3 item_category_add'+id+'"></span></p></div><div class="add_counter counter_' + id + '" style="display: none;"><ul class="d-table-cell-child" data-item="1" data-id="1"><li><button class="fa mr-1 fa-trash delete_item_trash "></button></li><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty('+id+')"></button></li><li><input onchange="change_qty('+id+')" class="item_catagory_value" type="text" id="item_val_'+id+'" data-id="0" value="1" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+id+')"></button></li></ul></div></div></div>');
      $(".counter-body").append('<div class="items_counter_list'+id+' all_items mb-1px" data-id='+id+' ><div class="item_catagory"><div class="item_catagory_inner"><p class="item_name'+id+'" >'+ item_name +'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex align-center mr-2 list_counter_right" data-item="1" data-id="1"><li><button class="fa fa-minus item_catagory_minus" onclick="subtract_qty()"></button></li><li class="h-100 d-flex align-center"><input readonly class="item_catagory_value'+id+'" type="number" value="'+ 1 +'" data-item="1"></li><li><button class="fa fa-plus item_catagory_plus" onclick="add_qty('+id+')"></button></li></ul></div></div></div><input type="hidden" class="type_'+id+'" value="extra_services"><input type="hidden" class="tab_'+id+'" value="<?= $storage->type?>">'); 
      $("#add_more").val("");  
      $(".counter_"+id).css("display","block");
       $(".item_category_add"+id).css("display","none");
      $(".products_list").remove();
      $("#item_val_"+id).attr('data-id',1);
    //   new_current_house_removals_obj = {"name":product , "id":id , "quantity":1 , "tab":tab};
    //   new_current_house_removals.push(new_current_house_removals_obj);
    //     localStorage.setItem('new_current_house_removals', JSON.stringify(new_current_house_removals));
   }
   else
   {
      $(".counter_"+id).css("display","block");
       $(".item_category_add"+id).css("display","none");
        var data_id =  $("#item_val_"+id).attr('data-id');
        if(data_id !=0)
        {
       var value = $("#item_val_"+id).val();
       value++;
       $("#item_val_"+id).val(value);
        }
        else
        {
            $("#item_val_"+id).attr('data-id',1);
        }
        $("#add_more").val("");  
       add_item_list(id);
   }
}
function switch_tab()
{
   $("#add_more").val("");  
   $(".products_list").remove();
}
// below functions are for map 
function initMap(pick,drop) {
         var pickup = '';
         var dropup = '';
         pickup = pick;
         dropup = drop;
         var directionsRenderer = new google.maps.DirectionsRenderer({
            //   polylineOptions: {
            //     strokeColor: "red"
            //   },
               suppressMarkers: true
            });
         var directionsService = new google.maps.DirectionsService;
         var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: {lat: 51.5074, lng: 0.1278},
            disableDefaultUI: true,
         });
         directionsRenderer.setMap(map);
         calculateAndDisplayRoute(directionsService, directionsRenderer,map,pickup,dropup);
      }
   function calculateAndDisplayRoute(directionsService, directionsRenderer,map , pick, drop) {
         var pickup = '<?php echo base_url();?>assets/images/pickup.png';
         var dropoff = '<?php echo base_url();?>assets/images/dropoff.png';
         if(pick == '' && drop == '' ){
            // pick = 'guildford';
            // drop = 'woking';
            pick = {lat: 51.3190, lng: 0.5340};
            drop = {lat: 51.2406, lng: 0.5651};
         }
         
            // for marker testing
         var icons = {
            start: new google.maps.MarkerImage( pickup),
            end: new google.maps.MarkerImage( dropoff )
            };
            // for marker testing end

         directionsService.route({
          origin: pick,  // Haight.
          destination: drop,  // Ocean Beach.
          travelMode: google.maps.TravelMode["DRIVING"],
         }, function(response, status) {
          if (status == 'OK') {
            directionsRenderer.setDirections(response);
            var leg = response.routes[ 0 ].legs[ 0 ];
            makeMarker(map, leg.start_location, icons.start, "title" );
            makeMarker(map, leg.end_location, icons.end, 'title' );
          } else {
            swal({
               icon: 'error',
               title: 'Oops...',
               text: 'Directions request failed due to '  + status
            });
          }
         });
         
      }
      function makeMarker(map, position, icon, title ) {
         console.log(icon);
         new google.maps.Marker({
         position: position,
         map: map,
         icon: icon,
         title: title
         });
         }
      
   $(document).ready(function(){
      initMap("<?=$storage->pickup_location?>", "<?=$storage->drop_location?>");
   });
   function add_item_list(id)
   {
       $("#item_val_"+id).val(1);
      item_name = $(".item_title"+id).text();
      var next= 0;
      var append = true;
      $(".items_counter_list"+id).each(function(){
      var itme_id = $(".items_counter_list"+id).eq(next).attr("data-id");
       if(itme_id==id)
       {
          append = false;
          return false;
       }
       else
       {
          append = true;
       }
       next++;
   });
   if(append){
    // $(".extra_services_container").css("display","block");
     $('.tabs_sec .counter-body-extra-services').append('<div class="items_counter item_list list_counter_right'+id+' mb-1px" data-id="'+id+'" id="item_container'+id+'"><div class="item_catagory all_items" data-id="'+id+'"><div class="item_catagory_inner" data-id = "'+id+'"><p class="item_name'+id+'" data-id = "'+id+'">'+ item_name +'</p></div><div class="add_counter list_counter_right h-100" style="top:0px;right:0px;"><ul class="mb-0 h-100 d-flex mr-2 align-center" data-item="1" data-id="1"><li><input class="item_catagory_value'+id+'"" readonly type="number" value="1" onchange="change_qty("'+id+'")" data-item="'+id+'"></li></ul></div></div></div><input type="hidden" class="type_'+id+'" value="extra_services"><input type="hidden" class="tab_'+id+'" value="<?= $storage->type?>">');
    $(".products"+id).removeAttr('onclick');
    //   current_house_removals_obj = {"name":item_name , "id":id , "quantity":1};
    //   current_house_removals.push(current_house_removals_obj);
    //     localStorage.setItem('extra_service', JSON.stringify(current_house_removals));
      }
      update_items();
   }
   function add_qty(id)
   {
      var cuerrent_items = 0;
    //   var name = $(".item_name"+id).text();
     $(".item_catagory_value"+id).val(parseInt($(".item_catagory_value"+id).val())+1);
     $("#item_val_"+id).val($(".item_catagory_value"+id).val());
    //  $.each(current_house_removals , function(index,value){
    //         if(current_house_removals[cuerrent_items].id==id)
    //         {
    //            current_house_removals.splice(cuerrent_items,1);
    //            return false;
    //         }
    //         cuerrent_items++;
    //      });
    //      current_house_removals_obj = {"name":name , "id":id , "quantity":$(".item_catagory_value"+id).val()};
    //     current_house_removals.push(current_house_removals_obj);
    //     localStorage.setItem('extra_service', JSON.stringify(current_house_removals));
           update_items();
      }
   function subtract_qty(id)
   {
      var next= 0;
      var cuerrent_items = 0;
      var data_id = true;
       var name = $(".item_name"+id).text();
      if($(".item_catagory_value"+id).val()<=1)
      {
       $(".list_counter_right"+id).remove();
       $(".products"+id).attr("onclick","add_item_list("+id+")");
       $(".counter_"+id).removeClass('d-block');
    //    $(".item_category_add"+id).css("display","block")
       $(".counter_"+id).css("display","none");
         $(".item_category_add"+id).css("display","flex");
         $(".item_category_add"+id).addClass('fa-plus');
         $(".item_catagory_inner ").each(function(){
            var a = $(".item_catagory_inner").eq(next).attr("data-id");
            if(a==id)
            {
               data_id = false;
               return false;
            }
            else
            {
               data_id = true;
            }
            next++;
         });
         if(data_id)
         {
         }
         else
         {
            $("#item_val_"+id).attr('data-id',0);
         }
      }
      else
      {
      var qty = parseInt($(".item_catagory_value"+id).val())-1 ;
      $(".item_catagory_value"+id).val(qty);
      $("#item_val_"+id).val(qty);
      }
           update_items();
   }
   function change_qty(id)
   {
      var next= 0;
      var data_id = true;
      var quantity = $("#item_val_"+id).val();
      $(".item_catagory_value"+id).val(quantity);
      if(quantity<1)
      {
        $(".list_counter_right"+id).remove();
       $(".products"+id).attr("onclick","add_item_list("+id+")");
       $(".counter_"+id).removeClass('d-block');
    //    $(".item_category_add"+id).css("display","block")
       $(".counter_"+id).css("display","none");
         $(".item_category_add"+id).css("display","flex");
         $(".item_category_add"+id).addClass('fa-plus');
         $(".item_catagory_inner ").each(function(){
            var a = $(".item_catagory_inner").eq(next).attr("data-id");
            if(a==id)
            {
               data_id = false;
               return false;
            }
            else
            {
               data_id = true;
            }
            next++;
         });
         if(data_id)
         {
         }
         else
         {
            $("#item_val_"+id).attr('data-id',0);
         }
      }
    //   var cuerrent_items = 0;
    //   $(".item_catagory_value"+id).val($("#item_val_"+id).val());
    //   var name = $(".item_name"+id).text();
    //   $.each(current_house_removals , function(index,value){
    //         if(current_house_removals[cuerrent_items].id==id)
    //         {
    //            current_house_removals.splice(cuerrent_items,1);
    //            return false;
    //         }
    //         cuerrent_items++;
    //      });
    //      current_house_removals_obj = {"name":name , "id":id , "quantity":$(".item_catagory_value"+id).val()};
    //     current_house_removals.push(current_house_removals_obj);
    //     localStorage.setItem('extra_service', JSON.stringify(current_house_removals));
        update_items();
   }
   function update_items()
   {
       var extra_services = false;
    var total_items = 0;
       var home = new Array();
       var next = 0;
       $(".item_list").each(function(){
        var product_id  =  $(".item_list").eq(next).attr('data-id');
        var producd_name = $(".item_name"+product_id).text();
        var product_qty =  $(".item_catagory_value"+product_id).val();
        var type = $(".type_"+product_id).val();
        var tab = $(".tab_"+product_id).val();
        home_obj = {"name":producd_name , "id":product_id , "quantity":product_qty, "tab": tab, "type":type};
        home.push(home_obj);
        if(type=="extra_services")
        {
            extra_services = true;
        }
        next++;
        total_items += parseInt(product_qty);
         });
         if(extra_services==true)
         {
             $(".extra_services_container").css("display","block")
         }
         else
         {
            $(".extra_services_container").css("display","none")
         }
         $('#items_length').text(" ("+total_items+")");
         $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/update_items_tdb'); ?>',
            dataType: 'json',
            data: {'items' : home},
            success:function(data)
            {
                window.location.href = '<?=base_url('shop/prices/')?>'+data;
            }
        });
        prices();
   }
   // For Map end
   function prices()
   {
    var main = $(".tabs_sec");
        var slug = "<?=$storage->slug?>";
        var sub = $(main).find('.items_counter');
        let ids = [];
        let qtys = [];
        let home = [];
        var i = 0;
        var premium_price = 0;
        var next = 0;
         $(".item_list").each(function(){
        var product_id  =  $(".item_list").eq(next).attr('data-id');
        var producd_name = $(".item_name"+product_id).text();
        var product_qty =  $(".item_catagory_value"+product_id).val();
        var type = $(".type_"+product_id).val();
		if(product_qty > 0){
			ids.push(product_id);
            qtys.push(product_qty);
        }
        next++;
         });
        $.ajax({
            type: "GET",
            url: '<?php echo base_url('shop/getPrices'); ?>',
            dataType: 'json',
            data: {'id': ids, 'qty': qtys, 'slug': slug, 'type': "<?=$storage->slug?>",'type': "extra_services"},
              success: function(data) {
                if(data[0] != null){
                    // alert(data[0].price);
                  var service = new google.maps.DistanceMatrixService;
                  service.getDistanceMatrix({
                  origins: ['<?= $storage->pickup_location?>'],
                  destinations: ['<?=$storage->drop_location?>'],
                  travelMode: 'DRIVING',
                  unitSystem: google.maps.UnitSystem.METRIC,
                  avoidHighways: false,
                  avoidTolls: false
                  }, function(response, status) {
                  if (status !== 'OK') {
                     alert('Error was: ' + status);
                  } else {
                     var originList = response.originAddresses;
                     var destinationList = response.destinationAddresses;
                     var amount = 0;
                     var price = 0;
                     var km = 0;
                     for (var i = 0; i < originList.length; i++) {
                           var results = response.rows[i].elements;
                           for (var j = 0; j < results.length; j++) {
                              var kilometers = results[j].distance.text;
                              kilometers = kilometers.replace(' km', '');
                              price = parseFloat(data[0].price);
                              price = premium_price+price;
                              km = parseFloat(kilometers)*0.621371;
                              km = parseFloat(km)*0.80;
                              amount = parseFloat(km) + parseFloat(price);
                              if(amount<40)
                              {
                                  amount = 40;
                              }
                              $("#t_price").text(Math.ceil(amount));
                              localStorage.setItem('price',amount);
                              $.ajax({
                                    type: "GET",
                                    url: '<?php echo base_url('shop/save_storage'); ?>',
                                    dataType: 'json',
                                    data: {'slug': '<?= !empty($storage) ? $storage->slug : '' ?>', 'type': '<?= !empty($storage) ? $storage->type : '' ?>', 'pickup': '<?= !empty($storage) ? $storage->pickup_location : '' ?>', 'drop': '<?= !empty($storage) ? $storage->drop_location : '' ?>' , 'storage_id': '<?= !empty($storage) ? $storage->id : '' ?>', 'price': price, 'km': km, 'total': Math.ceil(amount) , 'items' : home},
                                    success:function(data)
                                    {
                                    }
                                });
                           }
                     }
                  }
                  });
                }else{
                    alert(data[0].label);
                }
            },
            error: function(data) { alert('Ajax call failed'); }
        });

   }
   function edit_job()
   {
       if('<?= $type?>'=="piano_transport")
       {
        window.location.href = '<?= base_url('shop/piano_removal');?>';
       }
       else
       {
         window.location.href = '<?= base_url('shop/'.$type.'/details/'.$storage_id);?>';
       }
   }
   function edit_location(){
    if('<?= $type?>'=="piano_transport")
       {
        window.location.href = '<?= base_url('shop/piano_removal');?>';
       }
       else
       {
         window.location.href = '<?= base_url('shop/'.$type.'');?>';
       }
   }
</script>