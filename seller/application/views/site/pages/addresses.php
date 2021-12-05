        <?php include('include/header.php'); ?>
        

       

        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
            <!-- breadcrumb -->
            <div class="bg-gray-13 bg-md-transparent">
                <div class="container">
                    <!-- breadcrumb -->
                    <div class="my-md-3">   
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?php echo base_url('/'); ?>">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><?php echo $page_title; ?></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

           
            <div class="container">
                <div class="row mb-10">
                    <div class="col-md-3 col-xl-3">
                        <?php include('include/my_account_sidebar.php'); ?>
                    </div>
                    <div class="col-md-9 col-xl-9">
                        <div class="mr-xl-6">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25"><?php echo $page_title; ?></h3>
                            </div>
                        
                            <div class="container">
                                <?php
                                if(!empty($addresses))
                                {
                                ?>
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <tbody style="border-bottom: 2px solid grey;">   
                                        
                                            <?php 
                                            foreach ($addresses as $key => $value) 
                                            {
                                            ?>
                                        
                                            <tr>
                                                <td>
                                                    <div style="background: rgba(0, 0, 0, 0.05);display: inline-block;width: auto;padding: 1px 10px;border-radius: 4px;margin-bottom: 8px;text-transform: uppercase;font-size: 12px;font-weight: 500;border: 1px solid rgba(0, 0, 0, 0.05);" ><?=($value->address_type==1) ? $this->lang->line('home_address_val_lbl') : $this->lang->line('office_address_val_lbl')?></div>
                                                    <br>
                                                    <span style="margin-bottom: 5px;font-size: 16px;font-weight: 500;float: none;color: #424242;text-transform: capitalize;display: inline-block;"><?=$value->name?> <?=$value->mobile_no?></span>
                                                    
                                                  <p>
                                                    <?=$value->building_name.', '.$value->road_area_colony.', '.$value->city.', '.$value->state.', '.$value->country.' - '.$value->pincode;?>
                                                  </p>
                                                </td>
                                                <td class="text-right">
                                                    
                                                    <a href="javascript:void(0)" style="padding: 3px 3px 3px 3px;" class="btn btn-primary btn_edit_address mb-3" data-stuff='<?php echo htmlentities(json_encode($value)); ?>'><?=$this->lang->line('edit_btn')?></a>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-primary btn_delete_address "  style="padding: 3px 3px 3px 3px;" data-id="<?=$value->id?>"><?=$this->lang->  line('delete_btn')?></a>
                                                    
                                                </td>  
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            
                                <?php }else{ ?>
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <tbody style="border-bottom: 2px solid grey;">
                                            <tr>
                                                <td>No Addressess</td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                                

                                <?php } ?>
                                <div id="shopCartAccordion" class="accordion rounded mb-5">
                                    <!-- Card -->
                                    <div class="card border-0">
                                        <div id="shopCartHeadingOne" class="alert alert-primary mb-0" role="alert">
                                            <a href="#" class="alert-link collapsed" data-toggle="collapse" data-target="#shopCartOne" aria-expanded="false" aria-controls="shopCartOne">+ <?=$this->lang->line('add_new_address_lbl')?></a>
                                        </div>
                                        <div id="shopCartOne" class="border border-top-0 collapse" aria-labelledby="shopCartHeadingOne" data-parent="#shopCartAccordion" style="">
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

        <!-- ========== END MAIN CONTENT ========== -->
        <?php include('include/footer.php'); ?>
        <?php
          if($this->session->flashdata('response_msg')) {
            $message = $this->session->flashdata('response_msg');
            ?>
              <script type="text/javascript">
                var _msg='<?=$message['message']?>';
                var _class='<?=$message['class']?>';

                $('.notifyjs-corner').empty();
                $.notify(
                  _msg, 
                  { position:"top right",className: _class }
                ); 
              </script>
            <?php
            unset($_SESSION['response_msg']);
          }
        ?>
