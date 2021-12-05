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
            <style type="text/css">
                .price-range-slider {
                    width:100%;
                    float:left;
                    

                }
                .range-value {
                    margin:0;
                }
                .range-value input 
                {
                    width:100%;
                    background:none;
                    color: #000;
                    font-size: 16px;
                    font-weight: initial;
                    box-shadow: none;
                    border: none;
                }
                                
                .range-bar {
                    border: none;
                    background: #000;
                    height: 3px;    
                    width: 96%;
                    margin-left: 8px;
                }
                                    
                .range-bar .ui-slider-range {
                    background:#ff5252;
                }
                                    
                .range-bar .ui-slider-handle {
                    border:none;
                    border-radius:25px;
                    background:#fff;
                    border:2px solid #ff5252;
                    height:17px;
                    width:17px;
                    top: -0.52em;
                    cursor:pointer;
                }
                .range-bar .ui-slider-handle + span {
                    background:#ff5252;
                }
                </style>
            <div class="container">
                <div class="row mb-8">
                    <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                        <div class="mb-6">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Filters</h3>
                            </div>
                            <div class="border-bottom pb-4 mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold">Category</h4>
                                <?php 
                                $n=1;
                                foreach ($category_list as $key => $row) 
                                {
                                    if($n > 5){
                                        break;
                                    }

                                    $n++;
                                    $counts=$ci->getCount('tbl_sub_category', array('category_id' => $row->id, 'status' => '1'));

                                    if($counts > 0)
                                    {
                                        $url=base_url('category/'.$row->category_slug);  
                                    }
                                    else{
                                        $url=base_url('category/products/'.$row->id);
                                    }
                                ?>
                                <!-- Checkboxes -->
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <label style="margin-bottom: 0;">
                                            <a href="<?=$url?>" style="color:black;"><i class="fas fa-arrow-right"></i> 
                                                <?php 
                                                if(strlen($row->category_name) > 30){
                                                  echo substr(stripslashes($row->category_name), 0, 30).'...';  
                                                }else{
                                                  echo $row->category_name;
                                                }
                                              ?> 
                                            </a>
                                        </label>
                                    </div>
                                </div>
                                <?php 
                                } 
                                if(count($category_list) > 5)
                                {
                                ?>
                                

                                <!-- End Checkboxes -->

                                <!-- View More - Collapse -->
                                <div class="collapse" id="collapseBrand">
                                    <?php 
                                    $m=1;
                                    foreach ($category_list as $key => $row) 
                                    {
                                        
                                        if($m < 6){
                                            $m++;
                                            continue;
                                        }

                                        
                                        $counts=$ci->getCount('tbl_sub_category', array('category_id' => $row->id, 'status' => '1'));

                                        if($counts > 0)
                                        {
                                            $url=base_url('category/'.$row->category_slug);  
                                        }
                                        else{
                                            $url=base_url('category/products/'.$row->id);
                                        }
                                    ?>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <label style="margin-bottom: 0;">
                                                <a href="<?=$url?>" style="color:black;"><i class="fas fa-arrow-right"></i> 
                                                    <?php 
                                                    if(strlen($row->category_name) > 30){
                                                      echo substr(stripslashes($row->category_name), 0, 30).'...';  
                                                    }else{
                                                      echo $row->category_name;
                                                    }
                                                  ?> 
                                                </a>
                                            </label>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <!-- End View More - Collapse -->

                                <!-- Link -->
                                <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2" data-toggle="collapse" href="#collapseBrand" role="button" aria-expanded="false" aria-controls="collapseBrand">
                                    <span class="link__icon text-gray-27 bg-white">
                                        <span class="link__icon-inner">+</span>
                                    </span>
                                    <span class="link-collapse__default">Show more</span>
                                    <span class="link-collapse__active">Show less</span>
                                </a>
                                <!-- End Link -->
                                <?php 
                                }
                                ?>
                            </div>
                        </div>
                        <?php 
                        if(!empty($brand_list))
                        {
                        ?>
                        <div class="mb-6">
                            <div class="border-bottom pb-4 mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold"><?=$this->lang->line('brand_filter_lbl')?></h4>
                                <form action="" id="brand_sort" method="get">
                                  <?php

                                    if(isset($_GET['category'])){
                                      echo '<input type="hidden" name="category" value="'.$_GET['category'].'">';
                                    }

                                    if(isset($_GET['keyword'])){
                                      echo '<input type="hidden" name="keyword" value="'.$_GET['keyword'].'">';
                                    }

                                    if(isset($_GET['price_filter'])){
                                      echo '<input type="hidden" name="price_filter" value="'.$_GET['price_filter'].'">';
                                    }

                                  ?>
                                  <?php 
                                  $checked='';
                                  foreach ($brand_list as $key => $value) {

                                    if(!empty($_GET['sortByBrand'])){
                                      if(in_array($value->id,$_GET['sortByBrand'])){
                                        $checked='checked="checked"';
                                      }
                                      else{
                                        $checked='';
                                      }
                                    }
                                ?>
                                <!-- Checkboxes -->
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="sortByBrand[]" <?=$checked?> value="<?=$value->id?>" class="custom-control-input" id="categoryTshirt">
                                        <label class="custom-control-label" for="categoryTshirt"><?=$value->brand_name?>  <span class="text-gray-25 font-size-12 font-weight-normal"> (<?=$brand_count_items[$value->id]?>)</span></label>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php

                                if(isset($_GET['sortBySize']))
                                {
                                    foreach ($_GET['sortBySize'] as $key => $value) 
                                    {
                                        echo '<input type="hidden" name="sortBySize[]" value="'.$value.'">';  
                                    }
                                }

                                if(isset($_GET['sort'])){
                                    echo '<input type="hidden" name="sort" value="'.$_GET['sort'].'">'; 
                                }

                                ?>
                                <div class="clearfix"></div>
                                <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg">Filter</button>
                                </form>

                                

                            </div>
                        </div>
                        <?php } ?>

                        <?php 
                        if(!empty($size_list))
                        {
                        ?>
                        <div class="mb-6">
                            <div class="border-bottom pb-4 mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold"><?=$this->lang->line('size_lbl')?></h4>
                                <form action="" id="size_sort" method="get">
                                  <?php

                                    if(isset($_GET['category'])){
                                      echo '<input type="hidden" name="category" value="'.$_GET['category'].'">';
                                    }

                                    if(isset($_GET['keyword'])){
                                      echo '<input type="hidden" name="keyword" value="'.$_GET['keyword'].'">';
                                    }

                                    if(isset($_GET['price_filter'])){
                                      echo '<input type="hidden" name="price_filter" value="'.$_GET['price_filter'].'">';
                                    }

                                    if(isset($_GET['sortByBrand'])){
                                      foreach ($_GET['sortByBrand'] as $key => $value) {
                                        echo '<input type="hidden" name="sortByBrand[]" value="'.$value.'">';  
                                      }
                                    }

                                  ?>
                                  <?php 
                                  $checked='';
                                  foreach ($size_list as $key => $value) {

                                    if(!empty($_GET['sortBySize'])){
                                      if(in_array($value,$_GET['sortBySize'])){
                                        $checked='checked="checked"';
                                      }
                                      else{
                                        $checked='';
                                      }
                                    }
                                ?>
                                <!-- Checkboxes -->
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="sortBySize[]" <?=$checked?> value="<?=$value?>" class="custom-control-input" id="categoryTshirt">
                                        <label class="custom-control-label" for="categoryTshirt"><?=$value?>  </label>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php

                                    if(isset($_GET['sort'])){
                                      echo '<input type="hidden" name="sort" value="'.$_GET['sort'].'">'; 
                                    }
                                  ?>
                                <div class="clearfix"></div>
                                <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg">Filter</button>
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                        <?php 
                        if($price_min!=$price_max)
                        {
                        ?>
                        
                        <?php 
                        if(isset($_GET['price_filter'])){

                          $price_filter=(explode('-', $_GET['price_filter']));

                          $min_price=$price_filter[0];
                          $max_price=$price_filter[1];

                        }
                        else{
                          $min_price=$price_min;
                          $max_price=$price_max;
                        }
                      ?>
                        <div class="mb-6">
                            <div class="border-bottom pb-4 mb-4">
                                <form action="" method="get" id="price_filter_form">
                                    <?php

                                      if(isset($_GET['category'])){
                                        echo '<input type="hidden" name="category" value="'.$_GET['category'].'">';
                                      }

                                      if(isset($_GET['keyword'])){
                                        echo '<input type="hidden" name="keyword" value="'.$_GET['keyword'].'">';
                                      }

                                    ?>
                                    <div class="price-range-slider">
          
                                      
                                      <div id="slider-range" class="range-bar slider-range"></div>
                                      <br>
                                      <p class="range-value">
                                        <span><?=$this->lang->line('price_range_lbl')?> :- <input id="amount" class="amount" type="text" readonly="" data-currency="<?=CURRENCY_CODE?>" data-min="<?=floor($price_min)?>" data-max="<?=ceil($price_max)?>" data-min2="<?=floor($min_price)?>" data-max2="<?=ceil($max_price)?>" value="<?=CURRENCY_CODE?> <?=floor($price_min)?> - <?=CURRENCY_CODE?> <?=ceil($price_max)?>">
                                            <input type="hidden" name="price_filter" id="price_filter" class="price_filter" value="">
                                        </span>
                                      </p>
                                    </div>
                                    <?php
                                      if(isset($_GET['sortByBrand'])){
                                        foreach ($_GET['sortByBrand'] as $key => $value) {
                                          echo '<input type="hidden" name="sortByBrand[]" value="'.$value.'">';
                                        }
                                      }
                                      
                                      if(isset($_GET['sortBySize'])){
                                        foreach ($_GET['sortBySize'] as $key => $value) {
                                          echo '<input type="hidden" name="sortBySize[]" value="'.$value.'">';
                                        }
                                      }

                                      if(isset($_GET['sort'])){
                                        echo '<input type="hidden" name="sort" value="'.$_GET['sort'].'">';
                                      }
                                    ?>

                                    <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg">Filter</button>
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    

                    <div class="col-xl-9 col-wd-9gdot5">
                        <!-- Shop-control-bar -->
                        <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                            <div class="d-xl-none">
                                <!-- Account Sidebar Toggle Button -->
                                <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button"
                                    aria-controls="sidebarContent1"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    data-unfold-event="click"
                                    data-unfold-hide-on-scroll="false"
                                    data-unfold-target="#sidebarContent1"
                                    data-unfold-type="css-animation"
                                    data-unfold-animation-in="fadeInLeft"
                                    data-unfold-animation-out="fadeOutLeft"
                                    data-unfold-duration="500">
                                    <i class="fas fa-sliders-h"></i> <span class="ml-1">Filters</span>
                                </a>
                                <!-- End Account Sidebar Toggle Button -->
                            </div>
                            <div class="px-3 d-none d-xl-block">
                                

                            </div>
                            <div class="d-flex">
                                <form action="" method="get" id="sort_filter_form">

                                      <?php

                                        if(isset($_GET['category'])){
                                          echo '<input type="hidden" name="category" value="'.$_GET['category'].'">';
                                        }

                                        if(isset($_GET['keyword'])){
                                          echo '<input type="hidden" name="keyword" value="'.$_GET['keyword'].'">';
                                        }

                                        if(isset($_GET['price_filter'])){
                                          echo '<input type="hidden" name="price_filter" value="'.$_GET['price_filter'].'">';
                                        }

                                        if(isset($_GET['sortByBrand'])){
                                          foreach ($_GET['sortByBrand'] as $key => $value) {
                                            echo '<input type="hidden" name="sortByBrand[]" value="'.$value.'">';  
                                          }
                                        }

                                        if(isset($_GET['sortBySize'])){
                                          foreach ($_GET['sortBySize'] as $key => $value) {
                                            echo '<input type="hidden" name="sortBySize[]" value="'.$value.'">';
                                          }
                                        }
                                      ?>
                                    <!-- Select -->
                                    <select class="js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0 list_order"
                                        data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0" name="sort" data-placeholder="<?=$this->lang->line('sort_by_lbl')?>...">
                                        <option value="newest" <?php echo (isset($_GET['sort']) && strcmp($_GET['sort'], 'newest')==0) ? 'selected' : '' ?>><?=$this->lang->line('newest_first_lbl')?></option>
                                        <option value="low-high" <?php echo (isset($_GET['sort']) && strcmp($_GET['sort'], 'low-high')==0) ? 'selected' : '' ?>><?=$this->lang->line('low_to_high_lbl')?></option>
                                        <option value="high-low" <?php echo (isset($_GET['sort']) && strcmp($_GET['sort'], 'high-low')==0) ? 'selected' : '' ?>><?=$this->lang->line('high_to_low_lbl')?></option>
                                        <option value="top" <?php echo (isset($_GET['sort']) && strcmp($_GET['sort'], 'top')==0) ? 'selected' : '' ?>><?=$this->lang->line('top_selling_lbl')?></option>
                                    </select>
                                    <!-- End Select -->
                                </form>
                                

                            </div>
                            

                        </div>
                        <!-- End Shop-control-bar -->
                        <!-- Shop Body -->
                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                                <ul class="row list-unstyled products-group no-gutters">
                                    <?php

                                        $ci =& get_instance();
                                        foreach ($product_list as $key => $row)
                                        {

                                          $user_id=$this->session->userdata('user_id') ? $this->session->userdata('user_id'):'0';

                                          $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->featured_image);

                                          $img_file=$ci->_create_thumbnail('assets/images/products/',$thumb_img_nm,$row->featured_image,300,300);

                                          $img_file2=$ci->_create_thumbnail('assets/images/products/',$row->product_id,$row->featured_image2,300,300);

                                          $is_avail=true;

                                          if($row->status==0)
                                          {
                                            $is_avail=false;
                                          }

                                      ?>
                                    <li class="col-6 col-md-3 product-item">
                                        <div class="product-item__outer h-100 w-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <h5 class="mb-1 product-item__title"><a href="<?php echo site_url('product/'.$row->product_slug); ?>" title="<?=$row->product_title?>" class="text-blue font-weight-bold"><?php 
                                                          if(strlen($row->product_title) > 15){
                                                            echo substr(stripslashes($row->product_title), 0, 15).'...';  
                                                          }else{
                                                            echo $row->product_title;
                                                          }
                                                          ?>
                                                        </a>
                                                    </h5>
                                                    <div class="mb-2">
                                                        <a href="<?php echo site_url('product/'.$row->product_slug); ?>" class="d-block text-center"><img class="img-fluid" src="<?=base_url().$img_file?>" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <?php 
                                                            for ($x = 0; $x < 5; $x++) { 
                                                              if($x < $row->rate_avg){
                                                                ?>
                                                                <i class="fa fa-star" style="color: #F9BA48;font-size:14px;"></i>
                                                                <?php  
                                                              }
                                                              else{
                                                                ?>
                                                                <i class="fa fa-star"  style="font-size:14px;"></i>
                                                                <?php
                                                              }
                                                            }
                                                            ?>
                                                            <?php 
                                                            if($row->you_save_amt!='0')
                                                            {
                                                            ?>
                                                            <div class="text-gray-100"><?=CURRENCY_CODE.' '.number_format($row->selling_price, 2)?></div>
                                                            <?php 
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <div class="text-gray-100"><?=CURRENCY_CODE.' '.number_format($row->product_mrp, 2)?></div>
                                                            <?php    
                                                            }
                                                            ?>
                                                        </div>
                                                        <?php
                                                        $user_id=$this->session->userdata('user_id') ? $this->session->userdata('user_id'):'0'; 
                                                        if(!$ci->check_cart($row->product_id,$user_id)){
                                                        ?>
                                                        <div class="prodcut-add-cart">
                                                            <a href="javascript:void(0)" data-id="<?=$row->product_id?>" data-maxunit="<?=$row->max_unit_buy?>" data-toggle="tooltip" title="<?=$this->lang->line('add_cart_lbl')?>" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                        <?php } else { 
                                                        $cart_id=$ci->get_single_info(array('product_id' => $row->product_id, 'user_id' => $user_id),'id','tbl_cart');
                                                        ?>
                                                        <div class="prodcut-add-cart">
                                                            <a href="<?php echo site_url('remove-to-cart/'.$cart_id); ?>" style="background-color: red;" title="<?=$this->lang->line('remove_cart_lbl')?>" class=" btn_remove_cart btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <?php 
                                                        if(check_user_login() && $ci->is_compare($this->session->userdata('user_id'), $row->product_id)){
                                                        ?>
                                                        <a href="javascript:void(0)" style="color: red !important;" data-id="<?=$row->product_id?>" data-toggle="tooltip"  title="Remove From Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <?php 
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <a href="javascript:void(0)" data-id="<?=$row->product_id?>" data-toggle="tooltip"  title="Add in Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <?php    
                                                        }
                                                        ?>
                                                        <?php 
                                                        if(check_user_login() && $ci->is_favorite($this->session->userdata('user_id'), $row->product_id)){
                                                        ?>
                                                        <a href="javascript:void(0)"  style="color: red !important;" data-id="<?=$row->product_id?>" data-toggle="tooltip" title="<?=$this->lang->line('remove_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                        <?php 
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <a href="javascript:void(0)" data-id="<?=$row->product_id?>" data-toggle="tooltip" title="<?=$this->lang->line('add_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    

                                    

                                </ul>
                            </div>
                            

                        </div>
                        <!-- End Tab Content -->
                        <!-- End Shop Body -->
                        <?php 
                          if(!empty($links)){
                        ?>
                        <!-- Shop Pagination -->
                        <nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
                            <div class="text-center text-md-left mb-3 mb-md-0"><?=$show_result;?></div>
                            <!-- <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
                                <li class="page-item"><a class="page-link current" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                            </ul> -->
                            <?php 
                                  echo $links;  
                              ?>
                        </nav>
                        <!-- End Shop Pagination -->
                        <?php } ?>
                    </div>
                </div>
                

            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->
        <aside id="sidebarContent1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarNavToggler1">
            <div class="u-sidebar__scroller">
                <div class="u-sidebar__container">
                    <div class="">
                        <!-- Toggle Button -->
                        <div class="d-flex align-items-center pt-3 px-4 bg-white">
                            <button type="button" class="close ml-auto"
                                aria-controls="sidebarContent1"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-unfold-event="click"
                                data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarContent1"
                                data-unfold-type="css-animation"
                                data-unfold-animation-in="fadeInLeft"
                                data-unfold-animation-out="fadeOutLeft"
                                data-unfold-duration="500">
                                <span aria-hidden="true"><i class="ec ec-close-remove"></i></span>
                            </button>
                        </div>
                        <!-- End Toggle Button -->

                        <!-- Content -->
                        <div class="js-scrollbar u-sidebar__body">
                            <div class="u-sidebar__content u-header-sidebar__content px-4">
                                

                                <div class="mb-6">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Filters</h3>
                            </div>
                            <div class="border-bottom pb-4 mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold">Category</h4>
                                <?php 
                                $n=1;
                                foreach ($category_list as $key => $row) 
                                {
                                    if($n > 5){
                                        break;
                                    }

                                    $n++;
                                    $counts=$ci->getCount('tbl_sub_category', array('category_id' => $row->id, 'status' => '1'));

                                    if($counts > 0)
                                    {
                                        $url=base_url('category/'.$row->category_slug);  
                                    }
                                    else{
                                        $url=base_url('category/products/'.$row->id);
                                    }
                                ?>
                                <!-- Checkboxes -->
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <label style="margin-bottom: 0;">
                                            <a href="<?=$url?>" style="color:black;"><i class="fas fa-arrow-right"></i> 
                                                <?php 
                                                if(strlen($row->category_name) > 30){
                                                  echo substr(stripslashes($row->category_name), 0, 30).'...';  
                                                }else{
                                                  echo $row->category_name;
                                                }
                                              ?> 
                                            </a>
                                        </label>
                                    </div>
                                </div>
                                <?php 
                                } 
                                if(count($category_list) > 5)
                                {
                                ?>
                                

                                <!-- End Checkboxes -->

                                <!-- View More - Collapse -->
                                <div class="collapse" id="collapseBrand">
                                    <?php 
                                    $m=1;
                                    foreach ($category_list as $key => $row) 
                                    {
                                        
                                        if($m < 6){
                                            $m++;
                                            continue;
                                        }

                                        
                                        $counts=$ci->getCount('tbl_sub_category', array('category_id' => $row->id, 'status' => '1'));

                                        if($counts > 0)
                                        {
                                            $url=base_url('category/'.$row->category_slug);  
                                        }
                                        else{
                                            $url=base_url('category/products/'.$row->id);
                                        }
                                    ?>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <label style="margin-bottom: 0;">
                                                <a href="<?=$url?>" style="color:black;"><i class="fas fa-arrow-right"></i> 
                                                    <?php 
                                                    if(strlen($row->category_name) > 30){
                                                      echo substr(stripslashes($row->category_name), 0, 30).'...';  
                                                    }else{
                                                      echo $row->category_name;
                                                    }
                                                  ?> 
                                                </a>
                                            </label>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <!-- End View More - Collapse -->

                                <!-- Link -->
                                <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2" data-toggle="collapse" href="#collapseBrand" role="button" aria-expanded="false" aria-controls="collapseBrand">
                                    <span class="link__icon text-gray-27 bg-white">
                                        <span class="link__icon-inner">+</span>
                                    </span>
                                    <span class="link-collapse__default">Show more</span>
                                    <span class="link-collapse__active">Show less</span>
                                </a>
                                <!-- End Link -->
                                <?php 
                                }
                                ?>
                            </div>
                        </div>
                        <?php 
                        if(!empty($brand_list))
                        {
                        ?>
                        <div class="mb-6">
                            <div class="border-bottom pb-4 mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold"><?=$this->lang->line('brand_filter_lbl')?></h4>
                                <form action="" id="brand_sort" method="get">
                                  <?php

                                    if(isset($_GET['category'])){
                                      echo '<input type="hidden" name="category" value="'.$_GET['category'].'">';
                                    }

                                    if(isset($_GET['keyword'])){
                                      echo '<input type="hidden" name="keyword" value="'.$_GET['keyword'].'">';
                                    }

                                    if(isset($_GET['price_filter'])){
                                      echo '<input type="hidden" name="price_filter" value="'.$_GET['price_filter'].'">';
                                    }

                                  ?>
                                  <?php 
                                  $checked='';
                                  foreach ($brand_list as $key => $value) {

                                    if(!empty($_GET['sortByBrand'])){
                                      if(in_array($value->id,$_GET['sortByBrand'])){
                                        $checked='checked="checked"';
                                      }
                                      else{
                                        $checked='';
                                      }
                                    }
                                ?>
                                <!-- Checkboxes -->
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="sortByBrand[]" <?=$checked?> value="<?=$value->id?>" class="custom-control-input" id="categoryTshirt">
                                        <label class="custom-control-label" for="categoryTshirt"><?=$value->brand_name?>  <span class="text-gray-25 font-size-12 font-weight-normal"> (<?=$brand_count_items[$value->id]?>)</span></label>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php

                                if(isset($_GET['sortBySize']))
                                {
                                    foreach ($_GET['sortBySize'] as $key => $value) 
                                    {
                                        echo '<input type="hidden" name="sortBySize[]" value="'.$value.'">';  
                                    }
                                }

                                if(isset($_GET['sort'])){
                                    echo '<input type="hidden" name="sort" value="'.$_GET['sort'].'">'; 
                                }

                                ?>
                                <div class="clearfix"></div>
                                <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg">Filter</button>
                                </form>

                                

                            </div>
                        </div>
                        <?php } ?>

                        <?php 
                        if(!empty($size_list))
                        {
                        ?>
                        <div class="mb-6">
                            <div class="border-bottom pb-4 mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold"><?=$this->lang->line('size_lbl')?></h4>
                                <form action="" id="size_sort" method="get">
                                  <?php

                                    if(isset($_GET['category'])){
                                      echo '<input type="hidden" name="category" value="'.$_GET['category'].'">';
                                    }

                                    if(isset($_GET['keyword'])){
                                      echo '<input type="hidden" name="keyword" value="'.$_GET['keyword'].'">';
                                    }

                                    if(isset($_GET['price_filter'])){
                                      echo '<input type="hidden" name="price_filter" value="'.$_GET['price_filter'].'">';
                                    }

                                    if(isset($_GET['sortByBrand'])){
                                      foreach ($_GET['sortByBrand'] as $key => $value) {
                                        echo '<input type="hidden" name="sortByBrand[]" value="'.$value.'">';  
                                      }
                                    }

                                  ?>
                                  <?php 
                                  $checked='';
                                  foreach ($size_list as $key => $value) {

                                    if(!empty($_GET['sortBySize'])){
                                      if(in_array($value,$_GET['sortBySize'])){
                                        $checked='checked="checked"';
                                      }
                                      else{
                                        $checked='';
                                      }
                                    }
                                ?>
                                <!-- Checkboxes -->
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="sortBySize[]" <?=$checked?> value="<?=$value?>" class="custom-control-input" id="categoryTshirt">
                                        <label class="custom-control-label" for="categoryTshirt"><?=$value?>  </label>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php

                                    if(isset($_GET['sort'])){
                                      echo '<input type="hidden" name="sort" value="'.$_GET['sort'].'">'; 
                                    }
                                  ?>
                                <div class="clearfix"></div>
                                <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg">Filter</button>
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                        <?php 
                        if($price_min!=$price_max)
                        {
                        ?>
                        
                        <?php 
                        if(isset($_GET['price_filter'])){

                          $price_filter=(explode('-', $_GET['price_filter']));

                          $min_price=$price_filter[0];
                          $max_price=$price_filter[1];

                        }
                        else{
                          $min_price=$price_min;
                          $max_price=$price_max;
                        }
                      ?>
                        <div class="mb-6">
                            <div class="border-bottom pb-4 mb-4">
                                <form action="" method="get" id="price_filter_form">
                                    <?php

                                      if(isset($_GET['category'])){
                                        echo '<input type="hidden" name="category" value="'.$_GET['category'].'">';
                                      }

                                      if(isset($_GET['keyword'])){
                                        echo '<input type="hidden" name="keyword" value="'.$_GET['keyword'].'">';
                                      }

                                    ?>
                                    <div class="price-range-slider">
          
                                      
                                      <div id="slider-range" class="range-bar slider-range"></div>
                                      <br>
                                      <p class="range-value">
                                        <span><?=$this->lang->line('price_range_lbl')?> :- <input class="amount" type="text" readonly="" data-currency="<?=CURRENCY_CODE?>" data-min="<?=floor($price_min)?>" data-max="<?=ceil($price_max)?>" data-min2="<?=floor($min_price)?>" data-max2="<?=ceil($max_price)?>" value="<?=CURRENCY_CODE?> <?=floor($price_min)?> - <?=CURRENCY_CODE?> <?=ceil($price_max)?>">
                                            <input type="hidden" name="price_filter"  class="price_filter" value="">
                                        </span>
                                      </p>
                                    </div>
                                    <?php
                                      if(isset($_GET['sortByBrand'])){
                                        foreach ($_GET['sortByBrand'] as $key => $value) {
                                          echo '<input type="hidden" name="sortByBrand[]" value="'.$value.'">';
                                        }
                                      }
                                      
                                      if(isset($_GET['sortBySize'])){
                                        foreach ($_GET['sortBySize'] as $key => $value) {
                                          echo '<input type="hidden" name="sortBySize[]" value="'.$value.'">';
                                        }
                                      }

                                      if(isset($_GET['sort'])){
                                        echo '<input type="hidden" name="sort" value="'.$_GET['sort'].'">';
                                      }
                                    ?>

                                    <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg">Filter</button>
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                            </div>
                        </div>
                        <!-- End Content -->
                    </div>
                </div>
            </div>
        </aside>
        <?php include('include/footer.php'); ?>
        <script type="text/javascript">

  $("#brand_search").val('');

  $("#brand_search").on("keyup",function(e){
    var input, filter, ul, li, a, i, txtValue;
    input = $(this).val();

    if(input!=''){
      $(".clear_search").show();
    }
    else{
      $(".clear_search").hide(); 
    }

    filter = input.toUpperCase();
    ul = $(this).parents("div").next("ul");
    li = ul.find('li');
    label = ul.find('li label');

    // Loop through all list items, and hide those who don't match the search query
    var _empty=0;
    for (i = 0; i < label.length; i++) {
      a = label[i];
      txtValue = a.textContent || a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        label[i].style.display = "";
        li[i].style.display = "";
      } else {
        label[i].style.display = "none";
        li[i].style.display = "none";
        _empty++;
      }
    }

    if(_empty==label.length){
      ul.find(".no_data_found").show();
    }
    else{
      ul.find(".no_data_found").hide(); 
    }

  })


  $(".clear_search").click(function(e){
    e.preventDefault();

    $("#brand_search").val('');
    $("#brand_search").trigger('keyup');
    $(this).hide();
  });
</script>