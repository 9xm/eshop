        <?php include('include/header.php');
        $ci =& get_instance();

        $currentURL = current_url();
        $params   = $_SERVER['QUERY_STRING'];
        $fullURL = $currentURL . '?' . $params;

        $cart_type=($buy_now=='true') ? 'temp_cart' : 'main_cart';
        ?>

        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main" class="checkout-page">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?= base_url('/') ?>">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><?php echo $current_page; ?></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container">
                <div class="mb-5">
                    <h1 class="text-center">Checkout</h1>
                </div>
                

                <div class="row">
                    <div class="col-lg-7 order-lg-1">

                        <div class="pb-2 mb-2">
                            <!-- Title -->
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">Billing details</h3>
                            </div>
                            <!-- End Title -->
                            <div class="table-responsive-sm">
                                <table class="table">
                                    <tbody>
                                        <?php 
                                    $order_address_id=0;
                                    foreach ($addresses as $key => $value) {

                                      if($value->is_default=='true'){
                                        $order_address_id=$value->id;
                                      }

                                      ?>
                            
                                        <tr>
                                            <td>
                                                <label class="container">
                                                    <input type="radio" name="radio" class="address_radio" value="<?=$value->id?>" <?php echo $value->is_default=='true' ? 'checked="checked"' : ''; ?>>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <span><?=$value->name?> <?=$value->mobile_no?></span>
                                                
                                                <p>
                                                    <?=$value->building_name.', '.$value->road_area_colony.', '.$value->city.', '.$value->state.', '.$value->country.' - '.$value->pincode;?>
                                                </p>
                                            </td>
                                            <td>
                                                <div class="address_list_edit">
                                                    <a href="javascript:void(0)" class="btn_edit_address" data-stuff='<?php echo htmlentities(json_encode($value)); ?>'><?=$this->lang->line('edit_btn')?></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="shopCartAccordion" class="accordion rounded mb-5">
                                <!-- Card -->
                                <div class="card border-0">
                                    <div id="shopCartHeadingOne" class="alert alert-primary mb-0" role="alert">
                                        <a href="#" class="alert-link collapsed" data-toggle="collapse" data-target="#shopCartOne" aria-expanded="false" aria-controls="shopCartOne">+ <?=$this->lang->line('add_new_address_lbl')?></a>
                                    </div>
                                    <div id="shopCartOne" class="border border-top-0 collapse <?php if(empty($addresses)){ echo 'show';}?>" aria-labelledby="shopCartHeadingOne" data-parent="#shopCartAccordion" style="">
                                        <!-- Form -->
                                        <form  action="<?php echo site_url('site/addAddress'); ?>" method="post" name="address_form" class="js-validate p-5" novalidate="novalidate">
                                            


                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <!-- Form Group -->
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('name_place_lbl')?></label>
                                                        <input type="text" class="form-control" name="billing_name" value="" required="" placeholder="<?=$this->lang->line('name_place_lbl')?>">
                                                    </div>
                                                    <!-- End Form Group -->
                                                </div>

                                                <div class="col-lg-6">
                                                    <!-- Form Group -->
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('email_place_lbl')?></label>
                                                        <input type="email" name="billing_email"  class="form-control"  value="" required="" placeholder="<?=$this->lang->line('email_place_lbl')?>">
                                                    </div>
                                                    <!-- End Form Group -->
                                                </div>
                                                <div class="col-lg-6">
                                                    <!-- Form Group -->
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('phone_no_place_lbl')?></label>
                                                        <input type="text" name="billing_mobile_no" value="" required="" class="form-control"  placeholder="<?=$this->lang->line('phone_no_place_lbl')?>" onkeypress="return isNumberKey(event)" maxlength="15">
                                                    </div>
                                                    <!-- End Form Group -->
                                                </div>
                                                <div class="col-lg-6">
                                                    <!-- Form Group -->
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('alt_phone_no_place_lbl')?></label>
                                                        <input type="text" name="alter_mobile_no" value="" class="form-control"  placeholder="<?=$this->lang->line('alt_phone_no_place_lbl')?>" onkeypress="return isNumberKey(event)" maxlength="15">
                                                    </div>
                                                    <!-- End Form Group -->
                                                </div>
                                                <div class="col-lg-12">
                                                    <!-- Form Group -->
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('address_place_lbl')?></label>
                                                        <textarea placeholder="<?=$this->lang->line('address_place_lbl')?>" class="form-control"  name="building_name" style="background: #fff" required=""></textarea>
                                                    </div>
                                                    <!-- End Form Group -->
                                                </div>
                                                <div class="col-lg-12">
                                                    <!-- Form Group -->
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('road_area_colony_lbl')?></label>
                                                        <input type="text" name="road_area_colony" value="" required="" class="form-control"  placeholder="<?=$this->lang->line('road_area_colony_lbl')?>">
                                                    </div>
                                                    <!-- End Form Group -->
                                                </div>
                                                <div class="col-lg-12">
                                                    <!-- Form Group -->
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('country_place_lbl')?></label>
                                                        <select name="country"  class="form-control"  id="country" data-placeholder="Choose country...." tabindex="-1" style="background: rgba(255,255,255,1) url(assets/site_assets/img/arow.png) no-repeat scroll 97% center;border-radius: 4px;height: 50px;margin-bottom:20px" required="">
                                                            <option value="" selected="" disabled=""><?=$this->lang->line('country_place_lbl')?></option>
                                                        <?php 
                                                           $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                                                          ?>
                                                            <?php 
                                                              foreach ($countries as $key => $value) {
                                                                ?>
                                                                <option value="<?=$value?>"><?=$value?></option>
                                                                <?php
                                                              }
                                                            ?>
                                                          </select>
                                                    </div>
                                                    <!-- End Form Group -->
                                                </div>
                                                <div class="col-lg-6">
                                                    <!-- Form Group -->
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('district_place_lbl')?></label>
                                                        <input type="text" name="district" class="form-control"  value="" placeholder="<?=$this->lang->line('district_place_lbl')?>">
                                                    </div>
                                                    <!-- End Form Group -->
                                                </div>
                                                <div class="col-lg-6">
                                                    <!-- Form Group -->
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('city_place_lbl')?></label>
                                                        <input type="text"  class="form-control"  name="city" value="" required="" placeholder="<?=$this->lang->line('city_place_lbl')?>">
                                                    </div>
                                                    <!-- End Form Group -->
                                                </div>
                                                <div class="col-lg-6">
                                                    <!-- Form Group -->
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('zipcode_place_lbl')?></label>
                                                        <input type="text" name="pincode" value="" class="form-control"  required="" placeholder="<?=$this->lang->line('zipcode_place_lbl')?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="7">
                                                    </div>
                                                    <!-- End Form Group -->
                                                </div>
                                                <div class="col-lg-12">
                                                    <!-- Form Group -->
                                                    <div class="js-form-message form-group">
                                                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('name_place_lbl')?></label>
                                                        
                                                            <input type="radio" name="address_type" value="1" readonly="" style="width: 20px;height: 15px" checked><?=$this->lang->line('home_address_lbl')?>
                                                            
                                                            <input type="radio" name="address_type" readonly="" value="2" style="width: 20px;height: 15px"><?=$this->lang->line('office_address_lbl')?>
                                                    </div>
                                                    <!-- End Form Group -->
                                                </div>
                                            </div>
                                            <!-- Button -->
                                            <div class="mb-1">
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary-dark-w px-5">Save</button>
                                                </div>
                                            </div>
                                            <!-- End Button -->
                                        </form>
                                        <!-- End Form -->
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 order-lg-2 mb-lg-0">
                        <div class="pl-lg-3 ">
                            <div class="bg-gray-1 rounded-lg">
                                <!-- Order Summary -->
                                <div class="p-4 mb-4 checkout-table">
                                    <!-- Title -->
                                    <div class="border-bottom border-color-1 mb-5">
                                        <h3 class="section-title mb-0 pb-2 font-size-25"><?=$this->lang->line('order_section_lbl')?></h3>
                                    </div>
                                    <!-- End Title -->

                                    <!-- Product Content -->
                                    <div class="your-order-table table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name"><?=$this->lang->line('product_lbl')?></th>
                                                    <th class="product-total"><?=$this->lang->line('total_lbl')?></th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                            <?php 

                                            $total_cart_amt=$you_save=$delivery_charge=0;

                                            $cart_ids='';

                                            foreach ($my_cart as $key => $value) {

                                              $cart_ids.=$value->id.',';

                                              $is_avail=true;

                                              if($ci->get_single_info(array('id' => $value->product_id),'status','tbl_product')==0){
                                                $is_avail=false;
                                              }

                                              ?>
                                              <tr class="cart_item">
                                                <td nowrap="" class="product-name" style="width: 80%">
                                                  <span <?=(!$is_avail) ? 'style="opacity: 0.5;"' : ''?>>
                                                    <?php 
                                                      if(strlen($value->product_title) > 25){
                                                        echo substr(stripslashes($value->product_title), 0, 25).'...';  
                                                      }else{
                                                        echo $value->product_title;
                                                      }
                                                    ?>
                                                    <strong class="product-quantity"> ×<?=$value->product_qty?></strong>
                                                  </span>
                                                  <?php 
                                                    if(!$is_avail){
                                                      echo '<br/><p style="color: red;background: #FFF;display: inline-block;box-shadow: 0px 5px 10px #ccc;padding: 5px 10px;line-height: initial">'.$this->lang->line('unavailable_lbl').'</p>';
                                                    }
                                                  ?>
                                                </td>
                                                <td nowrap="" class="product-total" <?=(!$is_avail) ? 'style="opacity: 0.5;"' : ''?>>
                                                  <span class="amount">
                                                    <?php 
                                                    if($value->you_save_amt!='0'){
                                                      echo CURRENCY_CODE.' '.number_format(($value->selling_price * $value->product_qty), 2);
                                                      echo '<br/>';
                                                      echo '<del style="color: #a2a2a2">';
                                                      echo CURRENCY_CODE.' '.number_format(($value->product_mrp * $value->product_qty), 2);
                                                      echo '</del>';
                                                    }
                                                    else{
                                                      echo CURRENCY_CODE.' '.number_format(($value->selling_price * $value->product_qty), 2);
                                                    }
                                                    ?>
                                                  </span>
                                                </td>
                                                </tr>
                                                <?php

                                                if($is_avail){
                                                  $total_cart_amt+=$value->selling_price*$value->product_qty;
                                                  $delivery_charge+=$value->delivery_charge;
                                                  $you_save+=$value->you_save_amt * $value->product_qty;
                                                }
                                              }

                                              $cart_ids=rtrim($cart_ids,',');

                                              $total_cart_amt+=$delivery_charge;
                                              ?>
                                        </tbody>
                                        <tfoot>
                                          <tr class="cart-subtotal">
                                            <th><?=$this->lang->line('sub_total_lbl')?></th>
                                            <td nowrap=""><span class="amount"><?=CURRENCY_CODE.' '.number_format(($total_cart_amt-$delivery_charge), 2);?></span></td>
                                          </tr>
                                          <tr class="shipping">
                                            <th><?=$this->lang->line('delivery_charge_lbl')?></th>
                                            <td nowrap="" data-title="<?=$this->lang->line('delivery_charge_lbl')?>"><p><?=($delivery_charge!=0)?'+ '.CURRENCY_CODE.number_format($delivery_charge, 2) : $this->lang->line('free_lbl');?></p></td>
                                          </tr>
                                          <tr class="order-total">
                                            <th><?=$this->lang->line('total_lbl')?></th>
                                            <td nowrap=""><strong><span class="total-amount"><?=CURRENCY_CODE.' '.number_format($total_cart_amt, 2);?></span></strong></td>
                                          </tr>
                                          <tr class="apply_msg">
                                            <td colspan="2">
                                              <h4 class="text-center msg_2" style="font-weight: 500;color: green;margin-bottom: 15px;">
                                                <?=($you_save > 0) ? str_replace('###', CURRENCY_CODE.' '.number_format($you_save, 2), $this->lang->line('coupon_save_msg_lbl')) : ''?>
                                              </h4>
                                            </td>
                                          </tr>
                                          <tr class="apply_button">
                                            <td colspan="2">
                                              <a href="javascript:void(0)" data-toggle="modal" data-target="#coupons_detail">
                                                <img src="<?=base_url('assets/images/coupon-icon.png')?>" style="width: 30px;height: 30px">
                                                <?=$this->lang->line('apply_coupan_lbl')?>
                                              </a>
                                            </td>
                                          </tr>
                                          <tr class="remove_coupon" style="display: none;">
                                            <td colspan="2">
                                              <a href="javascript:void(0)" data-coupon="<?=$coupon_id?>" data-cart_ids="<?=$cart_ids?>" style="color: red">
                                                &times; <?=$this->lang->line('remove_coupan_lbl')?>
                                              </a>
                                            </td>
                                          </tr>
                                        </tfoot>
                                      </table>
                                    </div>
                                    

            
         
                                    <!-- End Product Content -->
                                    <form method="POST" name="place_order">
                                        <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                            <!-- Basics Accordion -->
                                            <div id="basicsAccordion1">
                                                <h3><?=$this->lang->line('payment_lbl')?></h3>
                                                    <input type="hidden" name="buy_now" value="<?=$buy_now?>">
                                                    <input type="hidden" name="coupon_id" value="<?=$coupon_id?>">
                                                    <input type="hidden" name="order_address" value="<?=$order_address_id?>">
                                                    <input type="hidden" name="cart_ids" value="<?=$cart_ids?>">
                                                    <?php 
                                                    if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->cod_status!='false')
                                                    {
                                                    ?>
                                                <!-- Card -->
                                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                                        <div class="p-3" id="basicsHeadingOne">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="payment_method_cod" class="custom-control-input" name="payment_method" checked="checked" value="cod">
                                                                <label class="custom-control-label form-label" for="payment_method_cod"
                                                                    data-toggle="collapse"
                                                                    data-target="#basicsCollapseOnee"
                                                                    aria-expanded="true"
                                                                    aria-controls="basicsCollapseOnee">
                                                                    <?=$this->lang->line('cod_lbl')?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="basicsCollapseOnee" class="collapse show border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                            aria-labelledby="basicsHeadingOne"
                                                            data-parent="#basicsAccordion1">
                                                            <div class="p-4">
                                                                <div class="pay-box payment_method_cod">
                                                                    <div class="col-md-12">
                                                                      
                                                                        <label style="margin-top: 10px;letter-spacing: 2px"><span class="_lblnum1"><?=rand(0,10)?></span> + <span class="_lblnum2"><?=rand(5,10)?></span> = </label>
                                                                        <input type="text" name="" class=" input_txt">
                                                                      
                                                                    </div>            
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                    }
                                                    ?>
                                                    <?php 
                                                    if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->paypal_status!='false' AND $this->db->get_where('tbl_settings', array('id' => '1'))->row()->paypal_client_id!='' AND $this->db->get_where('tbl_settings', array('id' => '1'))->row()->paypal_secret_key!='')
                                                    {
                                                    ?>
                                                <!-- Card -->
                                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                                        <div class="p-3" id="basicsHeadingOne">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="payment_method_paypal" class="custom-control-input" name="payment_method" data-order_button_text="Proceed to PayPal" value="paypal">
                                                                <label class="custom-control-label form-label" for="payment_method_paypal"
                                                                    data-toggle="collapse"
                                                                    data-target="#basicsCollapseOneee"
                                                                    aria-expanded="true"
                                                                    aria-controls="basicsCollapseOneee">
                                                                    <?=$this->lang->line('paypal_lbl')?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="basicsCollapseOneee" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                            aria-labelledby="basicsHeadingOne"
                                                            data-parent="#basicsAccordion1">
                                                            <div class="p-4">
                                                                <div class="pay-box payment_method_paypal">
                                                                    
                                                                    <p><?=$this->lang->line('paypal_msg_lbl')?></p>           
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                    }
                                                    ?>
                                                    <?php
                                                    if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->stripe_status!='false' AND $this->db->get_where('tbl_settings', array('id' => '1'))->row()->stripe_key!='' AND $this->db->get_where('tbl_settings', array('id' => '1'))->row()->stripe_secret!='')
                                                    {
                                                    ?>
                                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                                        <div class="p-3" id="basicsHeadingOne">
                                                            <div class="custom-control custom-radio">
                                                                <input id="payment_method_stripe" class="custom-control-input" name="payment_method" value="stripe" data-order_button_text="Proceed to Stripe" type="radio">
                                                                <label class="custom-control-label form-label" for="payment_method_stripe"
                                                                    data-toggle="collapse"
                                                                    data-target="#basicsCollapseOneeee"
                                                                    aria-expanded="true"
                                                                    aria-controls="basicsCollapseOneeee">
                                                                    <?=$this->lang->line('stripe_lbl')?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="basicsCollapseOneeee" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                            aria-labelledby="basicsHeadingOneeee"
                                                            data-parent="#basicsAccordion1">
                                                            <div class="p-4">
                                                                <div class="pay-box payment_method_stripe">
                                                                    
                                                                    <p><?=$this->lang->line('stripe_msg_lbl')?></p>           
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                    }
                                                    ?>
                                                    <?php
                                                    if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->razorpay_status!='false' AND $this->db->get_where('tbl_settings', array('id' => '1'))->row()->razorpay_key!='' AND $this->db->get_where('tbl_settings', array('id' => '1'))->row()->razorpay_secret!='' AND APP_CURRENCY=='INR')
                                                    {
                                                    ?>
                                                    <div class="border-bottom border-color-1 border-dotted-bottom">
                                                        <div class="p-3" id="basicsHeadingOne">
                                                            <div class="custom-control custom-radio">
                                                                <input id="payment_method_razorpay" class="custom-control-input" name="payment_method" data-amount="<?=$total_cart_amt?>" value="razorpay" data-order_button_text="Proceed to Razorpay" type="radio">
                                                                <label class="custom-control-label form-label" for="payment_method_razorpay"
                                                                    data-toggle="collapse"
                                                                    data-target="#basicsCollapse"
                                                                    aria-expanded="true"
                                                                    aria-controls="basicsCollapse">
                                                                    <?=$this->lang->line('razorpay_lbl')?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="basicsCollapse" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                            aria-labelledby="basicsHeadingOneeee"
                                                            data-parent="#basicsAccordion1">
                                                            <div class="p-4">
                                                                <div class="pay-box payment_method_razorpay">
                                                                    
                                                                    <p><?=$this->lang->line('razorpay_msg_lbl')?></p>           
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                    }
                                                    ?>
                                                <!-- End Card -->
                                            </div>

                                            <!-- End Basics Accordion -->
                                        </div>
                                    
                                        <input type="hidden" name="current_page" value="<?=$fullURL?>">
                                        <button type="submit" class="btn btn_place_order btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3"><?=$this->lang->line('place_ord_btn')?></button>
                                    </form>
                                    <?php 
                                    if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->razorpay_status!='false' AND $this->db->get_where('tbl_settings', array('id' => '1'))->row()->razorpay_key!='' AND $this->db->get_where('tbl_settings', array('id' => '1'))->row()->razorpay_secret!='' AND APP_CURRENCY=='INR')
                                    {
                                    ?>

                                        <form action="<?=base_url('razorpay/pay')?>" method="post" id="razorpayForm" style="display: none;">
                                        </form>
                                    <?php } ?>
                                </div>
                                <!-- End Order Summary -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div id="edit_address" class="modal fade" role="dialog" style="z-index: 99999">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-details">
                            <div style="background: none;border:none;">
                                <form action="" method="post" id="edit_address_form">
                                  <input type="hidden" name="address_id">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('name_place_lbl')?></label>
                                                <input type="text" class="form-control" name="billing_name" value="" required="" placeholder="<?=$this->lang->line('name_place_lbl')?>">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>

                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('email_place_lbl')?></label>
                                                <input type="email" name="billing_email"  class="form-control"  value="" required="" placeholder="<?=$this->lang->line('email_place_lbl')?>">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('phone_no_place_lbl')?></label>
                                                <input type="text" name="billing_mobile_no" value="" required="" class="form-control"  placeholder="<?=$this->lang->line('phone_no_place_lbl')?>" onkeypress="return isNumberKey(event)" maxlength="15">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('alt_phone_no_place_lbl')?></label>
                                                <input type="text" name="alter_mobile_no" value="" class="form-control"  placeholder="<?=$this->lang->line('alt_phone_no_place_lbl')?>" onkeypress="return isNumberKey(event)" maxlength="15">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        <div class="col-lg-12">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('address_place_lbl')?></label>
                                                <textarea placeholder="<?=$this->lang->line('address_place_lbl')?>" class="form-control"  name="building_name" style="background: #fff" required=""></textarea>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        <div class="col-lg-12">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('road_area_colony_lbl')?></label>
                                                <input type="text" name="road_area_colony" value="" required="" class="form-control"  placeholder="<?=$this->lang->line('road_area_colony_lbl')?>">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        <div class="col-lg-12">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('country_place_lbl')?></label>
                                                <select name="country"  class="form-control"  id="country" data-placeholder="Choose country...." tabindex="-1" style="background: rgba(255,255,255,1) url(assets/site_assets/img/arow.png) no-repeat scroll 97% center;border-radius: 4px;height: 50px;margin-bottom:20px" required="">
                                                    <option value="" selected="" disabled=""><?=$this->lang->line('country_place_lbl')?></option>
                                                <?php 
                                                   $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                                                  ?>
                                                    <?php 
                                                      foreach ($countries as $key => $value) {
                                                        ?>
                                                        <option value="<?=$value?>"><?=$value?></option>
                                                        <?php
                                                      }
                                                    ?>
                                                  </select>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('district_place_lbl')?></label>
                                                <input type="text" name="district" class="form-control"  value="" placeholder="<?=$this->lang->line('district_place_lbl')?>">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('city_place_lbl')?></label>
                                                <input type="text"  class="form-control"  name="city" value="" required="" placeholder="<?=$this->lang->line('city_place_lbl')?>">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('zipcode_place_lbl')?></label>
                                                <input type="text" name="pincode" value="" class="form-control"  required="" placeholder="<?=$this->lang->line('zipcode_place_lbl')?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="7">
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                        <div class="col-lg-12">
                                            <!-- Form Group -->
                                            <div class="js-form-message form-group">
                                                <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('name_place_lbl')?></label>
                                                
                                                    <input type="radio" name="address_type" value="1" readonly="" style="width: 20px;height: 15px" checked><?=$this->lang->line('home_address_lbl')?>
                                                    
                                                    <input type="radio" name="address_type" readonly="" value="2" style="width: 20px;height: 15px"><?=$this->lang->line('office_address_lbl')?>
                                            </div>
                                            <!-- End Form Group -->
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div class="mb-1">
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary-dark-w px-5">Save</button>
                                            <button class="btn btn-primary-dark-w px-5" type="button" data-dismiss="modal"><?=$this->lang->line('close_btn')?></button>
                                        </div>
                                    </div>
                                                                       
                                </form>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="coupons_detail" class="modal fade" role="dialog" style="z-index: 9999999;background: rgba(0,0,0,0.8);">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="modal-details">
                    <div class="row"> 
                      <div class="col-md-12 col-sm-12">
                        <div class="product-info">
                          <h3><?=$this->lang->line('avail_coupan_lbl')?></h3>
                          <br/>
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td class="text-center"><b><?=$this->lang->line('avail_coupan_code_lbl')?></b></td>
                                <td class="text-center"><b><?=$this->lang->line('avail_coupan_max_lbl')?></b></td>
                                <td class="text-center"><?=$this->lang->line('avail_coupan_apply_lbl')?></td>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              $row_coupon=$ci->get_coupons();
                              $total_amt=$total_cart_amt-$delivery_charge;
                              foreach ($row_coupon as $key => $value) {

                                if($value->cart_status=='true'){
                                  if($value->coupon_cart_min > $total_amt){
                                    continue;
                                  }
                                }

                                if($value->coupon_per==0 && ($total_amt < $value->coupon_amt)){
                                  continue;
                                }
                                ?>
                                <tr>
                                  <td class="text-center">
                                    <?=$value->coupon_code?>
                                  </td>
                                  <td class="text-center">
                                    <?php 
                                    if($value->coupon_per!=0 AND $value->coupon_max_amt!=0){
                                      echo CURRENCY_CODE.' '.$value->coupon_max_amt;
                                    }
                                    else{
                                      echo CURRENCY_CODE.' '.$value->coupon_amt;
                                    }
                                    ?>
                                  </td>
                                  <td class="text-center">
                                    <a href="javascript:void(0)" data-coupon="<?=$value->id?>" data-type="<?=$cart_type?>" data-cart="<?=$cart_ids?>"class="btn btn-success btn-sm btn_apply_coupon" style="border-radius: 3px">Apply</a>
                                  </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <div id="orderConfirm" class="modal" style="z-index: 9999999;background: rgba(0,0,0,0.8);text-align:center;">
            <div class="modal-dialog modal-confirm" style="width: fit-content">
              <div class="modal-content">
                <div class="modal-header">
                  <img src="<?=base_url('assets/img/successful-icon.png')?>" style="width: 70px">
                  <h4 class="modal-title" style="margin-top:15px;text-align:center;width: 100%;padding: 0;"><?=$this->lang->line('ord_placed_lbl')?></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding-top: 0px">
                  <p class="text-center" style="font-size: 22px;color: green;font-weight: 600;margin-bottom: 10px;padding-top: 20px;text-transform: capitalize;"><?=$this->lang->line('thank_you_ord_lbl')?></p>
                  <p style="margin-bottom: 5px;text-align: center;"><?=$this->lang->line('ord_confirm_lbl')?></p>
                  <p style="color: #000;margin-bottom: 5px;font-size: 16px;text-align: center;"><strong><?=$this->lang->line('ord_no_lbl')?>:</strong> <span class="ord_no_lbl"></span></p>
                </div>
                <div class="modal-footer" style="text-align: center;">
                  <button class="btn btn-danger btn_track"><?=$this->lang->line('track_ord_btn')?></button>
                  <button class="btn btn-success btn_orders" onclick="location.href='<?=base_url('my-orders')?>'"><?=$this->lang->line('my_ord_btn')?></button>
                </div>
              </div>
            </div>
        </div>
        <!-- ========== END MAIN CONTENT ========== -->

        <?php include('include/footer3.php'); ?>
<?php
  if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->stripe_status!='false' AND $this->db->get_where('tbl_settings', array('id' => '1'))->row()->stripe_key!='' AND $this->db->get_where('tbl_settings', array('id' => '1'))->row()->stripe_secret!='')
  {
    ?>

    <div id="stripeModal" class="modal" style="z-index: 9999999;background: rgba(0,0,0,0.8);">
      <div class="modal-dialog stripe-modaldialog">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" style="margin:15px 0px 0px 20px;font-weight:600;font-size:20px"><?=$this->lang->line('modal_heading_lbl')?></h2> 
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">

            <form role="form" action="<?=base_url()?>stripe/stripePost" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->stripe_key!=''){ echo $this->db->get_where('tbl_settings', array('id' => '1'))->row()->stripe_key; } ?>" id="stripe-form">
              <input type="hidden" name="buy_now" value="<?=$buy_now?>">
              <input type="hidden" name="coupon_id" value="<?=$coupon_id?>">
              <input type="hidden" name="order_address" value="<?=$order_address_id?>">
              <input type="hidden" name="cart_ids" value="<?=$cart_ids?>">
              <input type="hidden" name="payment_method" value="stripe">
              <div class='form-row row'>
                    <div class='col-md-12 form-group required'>
                        <div class="js-form-message form-group">
                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('card_name_lbl')?></label>
                            <input type="text" class="form-control" name="card_name" required="" placeholder="<?=$this->lang->line('card_name_lbl')?>" value="<?=$this->session->userdata('user_name')?>">
                        </div>
                    </div>
                    <div class='col-md-12 form-group required'>
                        <div class="js-form-message form-group">
                            <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('card_no_lbl')?></label>
                            <input type="text" class="form-control card-number" name="card_no" required="" placeholder="<?=$this->lang->line('card_no_lbl')?>"  size="20" value="4242424242424242" autocomplete="off">
                        </div>
                    </div>
              </div>

              <div class='form-row row'>
                <div class='col-xs-12 col-md-4 form-group cvc required'>
                    <div class="js-form-message form-group">
                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('card_cvc_lbl')?></label>
                        <input type="text" class="form-control card-cvc" name="cvvNumber" required="" placeholder="<?=$this->lang->line('card_cvc_lbl')?>"  size="4" value="123" autocomplete="off">
                    </div>
                </div>
                <div class='col-xs-12 col-md-4 form-group expiration required'>
                    <div class="js-form-message form-group">
                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('card_exp_mon_lbl')?></label>
                        <input type="text" class="form-control card-expiry-month" name="ccExpiryMonth" required="" placeholder="<?=$this->lang->line('card_exp_mon_lbl')?>"  size="2" value="12" autocomplete="off">
                    </div>
                </div>
                <div class='col-xs-12 col-md-4 form-group expiration required'>
                    <div class="js-form-message form-group">
                        <label class="form-label" for="signinSrEmailExample3"><?=$this->lang->line('card_exp_yr_lbl')?></label>
                        <input type="text" class="form-control card-expiry-year" name="ccExpiryYear" required="" placeholder="<?=$this->lang->line('card_exp_yr_lbl')?>"  size="4" value="<?=date('Y')?>" autocomplete="off">
                    </div>
                </div>
              </div>

              <div class='form-row row'>
                <div class='col-md-12 error form-group hide'>
                    <div class='alert-danger alert'><?=$this->lang->line('correct_err')?></div>
                </div>
                <div class="col-xs-12">
                    <button class="order-btn btn-primary btn-pill mb-3 " type="submit"><?=$this->lang->line('place_ord_btn')?></button>
                </div>
              </div>
              <div class="row">
                
              </div>    
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">

    // for stripe payment
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {

      $(".process_loader").show();

      e.preventDefault();

      var $form         = $(".require-validation"),
      inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]','textarea'].join(', '),
      $inputs       = $form.find('.required').find(inputSelector),
      $errorMessage = $form.find('div.error'),
      valid         = true;
      $errorMessage.addClass('hide');
      
      $('.has-error').removeClass('has-error');
      $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
          $input.parent().addClass('has-error');
          $errorMessage.removeClass('hide');
          e.preventDefault();
        }
      });
      
      if (!$form.data('cc-on-file')) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
      }
      
    });

    function stripeResponseHandler(status, response) {

      $(".process_loader").show();

      if (response.error) {

        $(".process_loader").hide();

        $('.error')
        .removeClass('hide')
        .find('.alert')
        .text(response.error.message);
      } else {

        var token = response['id'];
        $form.find('input[type=text]').empty();
        $("#stripeModal").modal("hide");

        $.ajax({
          type:'POST',
          url:$form.attr("action"),
          data:$form.serialize(),
          success:function(res){
            $(".process_loader").hide();
            var obj = $.parseJSON(res);
            if(obj.success=='1'){
              $(".process_loader").hide();
              window.location.href='<?=base_url().'my-orders';?>';
            }
            else if(obj.success=='-2'){
              swal({
                title: Settings.err_something_went_wrong,
                text: obj.msg,
                type: "error"
              }, function() {
                window.location.href='<?=base_url().'my-cart';?>';
              });
            }
            else{
              swal({
                title: Settings.err_something_went_wrong,
                text: obj.msg,
                type: "error"
              }, function() {
                location.reload();
              });
            }

          }
        });
      }
    }

  </script>
  <?php } ?>

  <?php 
  if($coupon_id!=0){
    ?>
    <script type="text/javascript">

      href = "<?=base_url('site/apply_coupon')?>";

      var coupon_id="<?=$coupon_id?>";
      var cart_ids="<?=$cart_ids?>";

      var cart_type="<?=$cart_type?>";
      
      $.ajax({
        url: href,
        type: 'post',
        data: {'coupon_id' : coupon_id, 'cart_ids' : cart_ids, 'cart_type' : cart_type},
        success: function(data) {
          var obj = $.parseJSON(data);

          $(".code_err").hide();

          $("#coupons_detail").modal("hide");
          
          if(obj.success == '1') {
            $(".order-total").find("span").html("<?=CURRENCY_CODE?>" + ' ' + obj.payable_amt);
            $(".msg_2").html(obj.you_save_msg);
            $(".apply_msg").show();
            $("input[name='coupon_id']").val(obj.coupon_id);
            $(".apply_button").hide();
            $(".remove_coupon").show();
          }
          else if(obj.success=='-1'){
            
          }
          else {
            swal({
              title: Settings.err_something_went_wrong,
              text: obj.msg,
              type: "error"
            }, function() {
              location.reload();
            });
          }
        },
        error: function(res) {
          alert("error");
        }

      });
    </script>
    <?php
  }
  ?>

  <?php
  if($this->session->flashdata('payment_msg')) {
    $data = $this->session->flashdata('payment_msg');
    ?>
    <script type="text/javascript">
      $("#orderConfirm .ord_no_lbl").text('<?=$data['order_unique_id']?>');

      $("#orderConfirm .btn_track").click(function(e){
        window.location.href='<?=base_url().'my-orders/'.$data['order_unique_id']?>';
      });

      $("#orderConfirm").fadeIn();
    </script>
    <?php
    unset($_SESSION['payment_msg']);
  } 
  ?>