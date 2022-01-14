<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="alawi-banner" style="background:url('<?php echo base_url();?>assets/images/vegetable2.png')!important;height:260px;background-size:cover !important;background-repeat:no-repeat !important;"><h3>Fresh Vegetables</h3></div>
<section class="page-contents checkout_page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row ">
                    <div class="col-sm-8">
                        <div class="panel  panel-default margin-top-lg">
                            <div class="panel-heading pr-0 h-45 py-0">
                                <div class="d-flex h-100 d-align-center">
                                    <img src="<?php echo base_url();?>assets/images/shopping.png" class=" margin-right-sm"> <?= lang('checkout'); ?>
                                    <a href="<?= site_url('cart'); ?>" class="ml-auto text-decoration d-flex px-15 h-100 d-align-center bg-transparent-green" style="border-top-right-radius: 4px;">
                                    <img class="margin-right-sm" src="<?php echo base_url();?>assets/images/lock.png">
                                        <?= lang('back_to_cart'); ?>
                                    </a>
                                </div>
                            </div>
                             
                            <div class="panel-body px-0 pt-0 pb-20">
                                <input class="form-control w-100" id="searchBox" class="controls" type="text" placeholder="Search places">
                                <div id="map" style="height:400px;"></div>
                                <button class="btn btn-theme w-100 bg_success  h-40" onclick="initMap()">Current Location</button>
                            <div>

                            <?php
                            if (!$this->loggedIn) {
                            ?>
                                <ul class="nav inline-list nav-tabs d-align-center content-center pt-20  tab_list tabs_form" role="tablist">
                                    <li role="presentation" class="active"><a href="<?= site_url('#user'); ?>" aria-controls="user" role="tab" data-toggle="tab" class="text-uppercase"><?= lang('login'); ?></a></li>
                                    <li role="presentation"><a href="#guest" aria-controls="guest" role="tab" data-toggle="tab" class="text-uppercase"><?= lang('guest_checkout'); ?></a></li>
                                </ul>
                            <?php
                            }
                            ?>
                                    <div class="tab-content padding-lg">
                                        <div role="tabpanel" class="tab-pane fade in active" id="user">
                                            <?php
                                            if ($this->loggedIn) {
                                                echo shop_form_open('order', 'class="validate"');
                                                echo '<script>var istates = false; </script>';
                                                ?>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?= lang('name', 'name'); ?> *
                                                                <?= form_input('name', ($this->loggedIn ? $loggedInUser->name : set_value('name')), 'class="form-control" id="name" required="required"'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?= lang('phone_number', 'phone_number'); ?> *
                                                        <?= form_input('phone', ($this->loggedIn ? $loggedInUser->phone : set_value('phone')), 'class="form-control" id="phone" required="required"'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?= lang('confirm_phone_number', 'confirm_phone_number'); ?> *
                                                        <?= form_input('confirm_phone', set_value('confirm_phone'), 'class="form-control" id="confirm_phone" required="required"'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <hr>
                                                            <h5><strong><?= lang('payment_method'); ?></strong></h5>
                                                            <div class="checkbox bg">
                                                                <label class="px-0" style="display: inline-block; width: auto;">
                                                                    <input type="radio" class="d-none" name="payment_method" value="cod" checked="checked" id="cod" required="required">
                                                                    <span>
                                                                       <img class="margin-right-md" src="<?php echo base_url();?>assets/images/cash.png"><?= lang('cod') ?>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <hr>
                                                            <div class="form-group">
                                                                <?= lang('comment_any', 'comment'); ?>
                                                                <?= form_textarea('comment', set_value('comment'), 'class="form-control br-r-4 h-100" id="comment"'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                     
                                                <div class="col-md-12">
                                                    <input type="hidden" name="lat" id="lat">
                                                    <input type="hidden" name="lon" id="lon">
                                                    <input type="hidden" name="city" id="city">
                                                <?php
                                                    echo form_submit('add_order', lang('submit_order'), 'class="btn btn-theme w-100 bg_success br-r-4"');
                                                    echo form_close();
                                                    echo '</div>';
                                            } else {
                                                ?>
                                                <div class="row mt-20">
                                                    <div class="col-sm-6">
                                                        <div class="margin-bottom-no">
                                                            <?php  include FCPATH.'themes'.DIRECTORY_SEPARATOR.$Settings->theme.DIRECTORY_SEPARATOR.'shop'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'user'.DIRECTORY_SEPARATOR.'login_form.php';  ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h4 class="title"><span><?= lang('register_new_account'); ?></span></h4>
                                                        <p>
                                                            <?= lang('register_account_info'); ?>
                                                        </p>
                                                        <a href="<?= site_url('login#register'); ?>" class="btn btn-theme bg_success br-r-4 mt-20" ><?= lang('register'); ?></a>
                                                        <a href="#guest" class="btn role_tab pull-right guest-checkout bg_success br-r-4 mt-20"  aria-controls="guest" role="tab" data-toggle="tab" aria-expanded="false"><?= lang('guest_checkout'); ?></a>
                                                    </div>
                                                </div>

                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="guest">
                                            <?= shop_form_open('order', 'class="validate" id="guest-checkout"'); ?>
                                            <input type="hidden" value="1" name="guest_checkout">
                                            <input type="hidden" value="new" name="address">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?= lang('name', 'name'); ?> *
                                                                <?= form_input('name', set_value('name'), 'class="form-control" id="name" required="required"'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?= lang('email', 'email'); ?> *
                                                        <?= form_input('email', set_value('email'), 'class="form-control" id="email" required="required"'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?= lang('phone_number', 'phone_number'); ?> *
                                                        <?= form_input('phone', ($this->loggedIn ? $loggedInUser->phone : set_value('phone')), 'class="form-control" id="phone" required="required"'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?= lang('confirm_phone_number', 'confirm_phone_number'); ?> *
                                                        <?= form_input('confirm_phone', set_value('confirm_phone'), 'class="form-control" id="confirm_phone" required="required"'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h5><strong><?= lang('payment_method'); ?></strong></h5>
                                                    <hr>
                                                    <div class="checkbox bg">
                                                        <label class="px-0" style="display: inline-block; width: auto;">
                                                            <input type="radio" name="payment_method" value="cod" id="cod" class="d-none" checked="checked" required="required">
                                                            <span>
                                                                <img class="margin-right-md" src="<?php echo base_url();?>assets/images/cash.png"><?= lang('cod') ?>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <hr>
                                                    <div class="form-group m_font">
                                                        <span><?= lang('comment_any', 'comment'); ?></span>
                                                        <?= form_textarea('comment', set_value('comment'), 'class="form-control h-100 br-r-4" id="comment"'); ?>
                                                    </div>
                                                </div>

                                            </div>
                                                <input type="hidden" name="lat" id="lat">
                                                <input type="hidden" name="lon" id="lon">
                                                <input type="hidden" name="city" id="city">
                                            <?= form_submit('guest_order', lang('submit'), 'class="btn w-100  font-15 medium br-r-4 bg_success"'); ?>
                                            <?= form_close(); ?>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div id="sticky-con" class="margin-top-lg">
                            <div class="panel panel-default">
                                <div class="panel-heading ">
                                <img src="<?php echo base_url();?>assets/images/shopping.png" class=" margin-right-sm"> <?= lang('totals'); ?>
                                </div>
                                <div class="panel-body">
                                    <?php
                                    $total = $this->sma->convertMoney($this->cart->total(), FALSE, FALSE);
                                    $shipping = $this->sma->convertMoney($this->cart->shipping(), FALSE, FALSE);
                                    ?>
                                    <table class="table table-striped table-borderless cart-totals margin-bottom-no">
                                        <tr>
                                            <td class="bg_light_grey"><?= lang('total'); ?></td>
                                            <td class="text-right bg_light_grey"><?= $this->sma->formatMoney($total, $selected_currency->symbol); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="bg_d_grey"><?= lang('delivery_charges'); ?> *</td>
                                            <td class="text-right bg_d_grey"><?= $this->sma->formatMoney($shipping, $selected_currency->symbol); ?></td>
                                        </tr>
                                        <!-- <tr><td colspan="2"></td></tr> -->
                                        <tr class="active text-bold">
                                            <td class="bg-black-row"><?= lang('grand_total'); ?></td>
                                            <td class="text-right bg-black-row"><?= $this->sma->formatMoney(($this->sma->formatDecimal($total)+$this->sma->formatDecimal($shipping)), $selected_currency->symbol); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="content-slider">
                <div id="slider">
                    <div id="mask">
                    <ul>          
                        <li id="fifth" class="fifthanimation">
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
 </div>
</section>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGmh2t2Z5ebO54ldM_gu4zY43i-c0iPOA&&libraries=places&callback=initMap"></script>
<script>
  var map, infoWindow;
  var marker;
  var markers = [];
    function initMap() {  // load map in map div
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12
      });
      var input = document.getElementById('searchBox');
      var searchBox = new google.maps.places.SearchBox(input);
    //   var a= map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
      map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
      });
      searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        if (places.length == 0) {
          return;
        }
    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
        marker.setMap(null);
        if (!place.geometry) {
            console.log("Returned place contains no geometry");
            return;
        }

        markers.push(new google.maps.Marker({
            map: map,
            title: place.name,
            position: place.geometry.location
        }));
        if (place.geometry.viewport) {
        // Only geocodes have viewport.
            bounds.union(place.geometry.viewport);
        } else {
            bounds.extend(place.geometry.location);
        }

        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;

        position = JSON.parse(JSON.stringify(place.geometry.location));
        $('#lat').val(position.lat);
        $('#lon').val(position.lng);

        geocodeLatLng(geocoder,infowindow,map);
    });
    map.fitBounds(bounds);
  });
        infoWindow = new google.maps.InfoWindow;
            map.addListener( 'click', function (e) { // click on map ang get lat lang where clicked
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            var position = e.latLng;
            marker.setMap(null);

            // marker = new google.maps.Marker({position: position, map: map});
            markers.push(new google.maps.Marker({
                map: map,
                position: position
            }));

            var geocoder = new google.maps.Geocoder;
            var infowindow = new google.maps.InfoWindow;

            position = JSON.parse(JSON.stringify(position));
            $('#lat').val(position.lat);
            $('#lon').val(position.lng);

            geocodeLatLng(geocoder,infowindow,map);

        });
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {   // get latand lan of urrent location
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude         
          };

          $('#lat').val(position.coords.latitude);
          $('#lon').val(position.coords.longitude);

          infoWindow.setPosition(pos);
          map.setCenter(pos);
          var geocoder = new google.maps.Geocoder;
          var infowindow = new google.maps.InfoWindow;

          geocodeLatLng(geocoder,infowindow,map);
        }, function() {
          handleLocationError(true, infoWindow, map.getCenter());
        });
      } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }
      function handleLocationError(browserHasGeolocation, infoWindow, pos) { // errror functions
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
          'Error: The Geolocation service failed.' :
          'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

      function geocodeLatLng(geocoder,infowindow,map) { // get locaion name with the help of lat and lang and display on marker
        var lat = $('#lat').val();
        var lon = $('#lon').val();
        
        var latlng = {lat: parseFloat(lat), lng: parseFloat(lon)};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              map.setZoom(18);
              marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              infowindow.setContent(results[0].formatted_address);
              $('#city').val(results[0].formatted_address);
              
              infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }

      var _position;
      function getLocation(){
       var currentLoc = $('#city').val();

       var infowindow = new google.maps.InfoWindow;
       if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          marker.setMap(null);
          map.setCenter(pos);
          marker = new google.maps.Marker({
            position: pos,
            map: map
          });
          infowindow.setContent(currentLoc);
          infowindow.open(map, marker);
          map.setZoom(18);

          $('#searchBox').val('');
        }, function() {
          handleLocationError(true, infoWindow, map.getCenter());
        });
      } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }
    </script>