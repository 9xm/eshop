        <?php include('include/header-test.php'); ?>
        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
            <!-- Slider Section -->
            <?php
            // for hide/show slider 
            if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->home_slider_opt=='true')
            {
            ?>
            <!--<div class="mb-4">
                <div class="bg-img-hero" style="background-image: url(<?php echo base_url(); ?>assets/site_assets/img/1920X422/img2.jpg);">
                    <div class="container overflow-hidden">
                        <div class="js-slick-carousel u-slick"
                            data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-center mb-3 mb-md-4">
                            <?php 
                            $i=0;
                            $this->db->select('*');
                            $this->db->from('tbl_banner'); 
                            $this->db->where('status', '1'); 
                            $this->db->limit('6');
                            $this->db->order_by('id', 'DESC');
                            $banner_list = $this->db->get()->result();
                            foreach ($banner_list as $key => $row) 
                            {
                                $img_file=base_url('assets/images/banner/'.$row->banner_image);

                                //$thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->banner_image);

                                //$img_file=base_url().$ci->_create_thumbnail('assets/images/banner/',$thumb_img_nm,$row->banner_image,468,417);
                            ?>
                            <div class="js-slide">
                                <div class="row pt-7 py-md-0">
                                    <div class="d-none d-wd-block offset-1"></div>
                                    <div class="col-xl col col-md-6 mt-md-8 mt-lg-10">
                                        <div class="ml-xl-4">
                                            <h6 class="font-size-15 font-weight-bold mb-2 text-cyan"
                                                data-scs-animation-in="fadeInUp">
                                                <?php echo $row->banner_title; ?>
                                            </h6>
                                            <h1 class="font-size-46 text-lh-50 font-weight-light mb-8 jhdsbchdcjhdcbjsdjhdcbsdcsc"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="200">
                                                <?php echo $row->banner_desc; ?>
                                            </h1>
                                            <a href="<?=base_url('banners/'.$row->banner_slug)?>" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="300">
                                                Start Buying
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 col-6 d-flex align-items-end ml-auto ml-md-0"
                                        data-scs-animation-in="fadeInRight"
                                        data-scs-animation-delay="500">
                                        <img class="img-fluid ml-auto mr-10 mr-wd-auto" src="<?=$img_file?>" alt="Image Description">
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>-->
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php 
                    $i=0;
                    $this->db->select('*');
                    $this->db->from('tbl_banner'); 
                    $this->db->where('status', '1'); 
                    $this->db->limit('6');
                    $this->db->order_by('id', 'DESC');
                    $banner_list = $this->db->get()->result();
                    foreach ($banner_list as $key => $row) 
                    {
                        $img_file=base_url('assets/images/banner/'.$row->banner_image);

                        //$thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->banner_image);

                        //$img_file=base_url().$ci->_create_thumbnail('assets/images/banner/',$thumb_img_nm,$row->banner_image,468,417);
                    ?>
                    <div class="carousel-item <?php echo $i==0 ? 'active' : '';?>">
                        <a href="<?=base_url('banners/'.$row->banner_slug)?>">
                            <img class="d-block w-100 sasdasdsdasdasdasdasd" src="<?php echo $img_file; ?>" style="height:400px;">
                        </a>
                    </div>
                    <?php 
                    $i++;
                    }
                    ?>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <?php
            }
            ?>
            <br>
            <!-- End Slider Section -->
            <div class="container">
                <?php
                // for hide/show slider 2 
                if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->home_slider_opt2=='true')
                {
                ?>
                <!-- Banner -->
                <div class="row mb-2 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                    <?php 
                    $i=0;
                    $this->db->select('*');
                    $this->db->from('tbl_offers'); 
                    $this->db->where('status', '1'); 
                    $this->db->limit('8');
                    $this->db->order_by('id', 'DESC');
                    $banner_list2 = $this->db->get()->result();
                    foreach ($banner_list2 as $key => $row) 
                    {
                        $img_file=base_url('assets/images/offers/'.$row->offer_image);

                        //$thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->banner_image);

                        //$img_file=base_url().$ci->_create_thumbnail('assets/images/banner/',$thumb_img_nm,$row->banner_image,246,176);
                    ?>
                    <div class="col-md-6 mb-4 mb-xl-0 col-xl-4 col-wd-3 flex-shrink-0 flex-xl-shrink-1">
                        <a href="<?=base_url('offers/'.$row->offer_slug)?>" class="min-height-146 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                            <div class="col-6 col-xl-7 col-wd-6 pr-0">
                                <img class="img-fluid" src="<?=$img_file?>" alt="Image Description" style="width: 200px;height: 145px;">
                            </div>
                            <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                                <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                    <?=$row->offer_title?>
                                </div>
                                <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                                    Shop now
                                    <span class="link__icon ml-1">
                                        <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
                <!-- End Banner -->
                <?php } ?>
                
                <!-- Tab Prodcut Section -->
                <?php 
                if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->feature_products=='true')
                {
                    $this->db->select('*');
                    $this->db->from('tbl_product'); 
                    $this->db->where('status', '1'); 
                    $this->db->where('is_featured', '1');
                    $this->db->limit('8'); 
                    $this->db->order_by('id', 'DESC');
                    $feature_products = $this->db->get()->result();
                    
                    if(count($feature_products) > 2)
                    {
                ?>
                    <div class="mb-2">
                        <!-- Nav Classic -->
                        <div class="position-relative bg-white text-center z-index-2">
                            <ul class="nav nav-classic nav-tab justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active js-animation-link" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="true"
                                        data-target="#pills-one-example1"
                                        data-link-group="groups"
                                        data-animation-in="slideInUp">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            Featured Products
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Nav Classic -->
                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                                <ul class="row list-unstyled products-group no-gutters">
                                    <?php 
                                    foreach ($feature_products as $key => $row) 
                                    {
                                        $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->featured_image);

                                        $img_file=$ci->_create_thumbnail('assets/images/products/',$thumb_img_nm,$row->featured_image,250,250);

                                        $is_avail=true;

                                        if($row->status==0)
                                        {
                                            $is_avail=false;
                                        }
                                    ?>
                                    <li class="col-6 col-md-4 col-xl product-item">
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
                                                        if(!$ci->check_cart($row->id,$user_id)){
                                                        ?>
                                                        <div class="prodcut-add-cart">
                                                            <a href="javascript:void(0)" data-id="<?=$row->id?>" data-maxunit="<?=$row->max_unit_buy?>" data-toggle="tooltip" title="<?=$this->lang->line('add_cart_lbl')?>" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                        <?php } else { 
                                                        $cart_id=$ci->get_single_info(array('product_id' => $row->id, 'user_id' => $user_id),'id','tbl_cart');
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
                                                        if(check_user_login() && $ci->is_compare($this->session->userdata('user_id'), $row->id)){
                                                        ?>
                                                        <a href="javascript:void(0)" style="color: red !important;" data-id="<?=$row->id?>" data-toggle="tooltip"  title="Remove From Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <?php 
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <a href="javascript:void(0)" data-id="<?=$row->id?>" data-toggle="tooltip"  title="Add in Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <?php    
                                                        }
                                                        ?>
                                                        <?php 
                                                        if(check_user_login() && $ci->is_favorite($this->session->userdata('user_id'), $row->id)){
                                                        ?>
                                                        <a href="javascript:void(0)"  style="color: red !important;" data-id="<?=$row->id?>" data-toggle="tooltip" title="<?=$this->lang->line('remove_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                        <?php 
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <a href="javascript:void(0)" data-id="<?=$row->id?>" data-toggle="tooltip" title="<?=$this->lang->line('add_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php 
                                    }
                                    ?>
                                    
                                </ul>
                            </div>
                        </div>
                        <!-- End Tab Content -->
                    </div>
                <!-- End Tab Prodcut Section -->
                <?php }
                } 
                ?>
            </div>
            <?php 
            $this->db->order_by('rand()');
            $this->db->limit(2); 
            $show_category = $this->db->get_where('tbl_category',array('set_on_home'=>1,'status'=>1))->result();
            if(count($show_category) > 0)
            {
                if(isset($show_category[0]) && !empty($show_category[0]))
                {
                    $this->db->select('*');
                    $this->db->from('tbl_product'); 
                    $this->db->where('status', '1'); 
                    $this->db->where('category_id', $show_category[0]->id);
                    $this->db->limit(8); 
                    $this->db->order_by('id', 'DESC');
                    $show_category_pro1 = $this->db->get()->result();
                    
                   /* if(count($show_category_pro1) > 4)
                    {*/

                        $img_file='assets/images/category/'.$show_category[0]->category_image;
            ?>
            <!-- Television Entertainment -->
            <div class="mb-2">
                <div class="container">
                    <div class="row min-height-564 align-items-center">
                        <div class="col-12 col-lg-4 col-xl-5 col-wd-6 d-none d-md-block">
                            <img class="img-fluid" src="<?=$img_file?>" alt="Image Description" style="height: 435px;width: 470px;">
                        </div>
                        <div class="col-12 col-lg-8 col-xl-7 col-wd-6 pt-6 pt-md-0">
                            <div class=" d-flex border-bottom border-color-1 mr-md-2">
                                <h3 class="section-title section-title__full mb-0 pb-2 font-size-22"><?php echo $show_category[0]->category_name; ?></h3>
                            </div>
                            <div class="js-slick-carousel position-static u-slick u-slick--gutters-2 u-slick overflow-hidden u-slick-overflow-visble py-5"
                                data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10 pt-6 pt-md-0"
                                data-arrow-left-classes="fa fa-angle-left right-2"
                                data-arrow-right-classes="fa fa-angle-right right-1"
                                data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">
                                <div class="js-slide">
                                    <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                                        <?php 
                                        $i = 0;
                                        
                                        foreach ($show_category_pro1 as $key => $row) 
                                        {
                                            if($i < 4)
                                            {
                                            $img_file='assets/images/products/'.$row->featured_image;

                                            $is_avail=true;

                                            if($row->status==0)
                                            {
                                                $is_avail=false;
                                            }
                                        ?>
                                        <li class="col-md-6 product-item product-item__card mb-2 remove-divider pr-md-2 border-bottom-0">
                                            <div class="product-item__outer h-100 w-100">
                                                <div class="product-item__inner p-md-3 row no-gutters bg-white max-width-334">
                                                    <div class="col col-lg-auto product-media-left">
                                                        <a href="<?php echo site_url('product/'.$row->product_slug); ?>" class="d-block" style="max-width: 5.5rem;"><img class="img-fluid" src="<?=base_url().$img_file?>" alt="Image Description" style="width: 120px ;height: 112px;"></a>
                                                    </div>
                                                    <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1 pr-3 pr-md-0 pt-1 pt-md-0">
                                                        <div class="mb-2">
                                                            <h5 class="mb-1 product-item__title"><a href="<?php echo site_url('product/'.$row->product_slug); ?>" title="<?=$row->product_title?>" class="text-blue font-weight-bold">
                                                                <?php 
                                                                if(strlen($row->product_title) > 15){
                                                                    echo substr(stripslashes($row->product_title), 0, 15).'...';  
                                                                }else{
                                                                    echo $row->product_title;
                                                                }
                                                                ?>
                                                                </a>
                                                            </h5>
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
                                                        </div>
                                                        <div class="flex-center-between mb-2">
                                                            
                                                           
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
                                                            <?php
                                                            $user_id=$this->session->userdata('user_id') ? $this->session->userdata('user_id'):'0'; 
                                                            if(!$ci->check_cart($row->id,$user_id)){
                                                            ?>
                                                            <div class="prodcut-add-cart">
                                                                <a href="javascript:void(0)" data-id="<?=$row->id?>" data-maxunit="<?=$row->max_unit_buy?>" data-toggle="tooltip" title="<?=$this->lang->line('add_cart_lbl')?>" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                            </div>
                                                            <?php } else { 
                                                            $cart_id=$ci->get_single_info(array('product_id' => $row->id, 'user_id' => $user_id),'id','tbl_cart');
                                                            ?>
                                                            <div class="prodcut-add-cart">
                                                                <a href="<?php echo site_url('remove-to-cart/'.$cart_id); ?>" style="background-color: red;" title="<?=$this->lang->line('remove_cart_lbl')?>" class=" btn_remove_cart btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="product-item__footer bg-white">
                                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                                <?php 
                                                                if(check_user_login() && $ci->is_compare($this->session->userdata('user_id'), $row->id)){
                                                                ?>
                                                                <a href="javascript:void(0)" style="color: red !important;" data-id="<?=$row->id?>" data-toggle="tooltip"  title="Remove From Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                                <?php 
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <a href="javascript:void(0)" data-id="<?=$row->id?>" data-toggle="tooltip"  title="Add in Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                                <?php    
                                                                }
                                                                ?>
                                                                <?php 
                                                                if(check_user_login() && $ci->is_favorite($this->session->userdata('user_id'), $row->id)){
                                                                ?>
                                                                <a href="javascript:void(0)"  style="color: red !important;" data-id="<?=$row->id?>" data-toggle="tooltip" title="<?=$this->lang->line('remove_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                                <?php 
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <a href="javascript:void(0)" data-id="<?=$row->id?>" data-toggle="tooltip" title="<?=$this->lang->line('add_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                                <?php    
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php } $i++; } ?>
                                    </ul>
                                </div>
                                <?php 
                                if(count($show_category_pro1) > 4){    
                                ?>
                                <div class="js-slide">
                                    <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                                        <?php 
                                        $i = 0;
                                        
                                        foreach ($show_category_pro1 as $key => $row) 
                                        {
                                            if($i >= 4)
                                            {
                                            $img_file='assets/images/products/'.$row->featured_image;

                                            $is_avail=true;

                                            if($row->status==0)
                                            {
                                                $is_avail=false;
                                            }
                                        ?>
                                        <li class="col-md-6 product-item product-item__card mb-2 remove-divider pr-md-2 border-bottom-0">
                                            <div class="product-item__outer h-100 w-100">
                                                <div class="product-item__inner p-md-3 row no-gutters bg-white max-width-334">
                                                    <div class="col col-lg-auto product-media-left">
                                                        <a href="<?php echo site_url('product/'.$row->product_slug); ?>" class="d-block" style="max-width: 5.5rem;"><img class="img-fluid" src="<?=base_url().$img_file?>" alt="Image Description" style="width: 120px ;height: 112px;"></a>
                                                    </div>
                                                    <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1 pr-3 pr-md-0 pt-1 pt-md-0">
                                                        <div class="mb-2">
                                                            <h5 class="mb-1 product-item__title"><a href="<?php echo site_url('product/'.$row->product_slug); ?>" title="<?=$row->product_title?>" class="text-blue font-weight-bold">
                                                                <?php 
                                                                if(strlen($row->product_title) > 15){
                                                                    echo substr(stripslashes($row->product_title), 0, 15).'...';  
                                                                }else{
                                                                    echo $row->product_title;
                                                                }
                                                                ?>
                                                                </a>
                                                            </h5>
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
                                                        </div>
                                                        <div class="flex-center-between mb-2">
                                                            
                                                           
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
                                                            <?php
                                                            $user_id=$this->session->userdata('user_id') ? $this->session->userdata('user_id'):'0'; 
                                                            if(!$ci->check_cart($row->id,$user_id)){
                                                            ?>
                                                            <div class="prodcut-add-cart">
                                                                <a href="javascript:void(0)" data-id="<?=$row->id?>" data-maxunit="<?=$row->max_unit_buy?>" data-toggle="tooltip" title="<?=$this->lang->line('add_cart_lbl')?>" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                            </div>
                                                            <?php } else { 
                                                            $cart_id=$ci->get_single_info(array('product_id' => $row->id, 'user_id' => $user_id),'id','tbl_cart');
                                                            ?>
                                                            <div class="prodcut-add-cart">
                                                                <a href="<?php echo site_url('remove-to-cart/'.$cart_id); ?>" style="background-color: red;" title="<?=$this->lang->line('remove_cart_lbl')?>" class=" btn_remove_cart btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="product-item__footer bg-white">
                                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                                <?php 
                                                                if(check_user_login() && $ci->is_compare($this->session->userdata('user_id'), $row->id)){
                                                                ?>
                                                                <a href="javascript:void(0)" style="color: red !important;" data-id="<?=$row->id?>" data-toggle="tooltip"  title="Remove From Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                                <?php 
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <a href="javascript:void(0)" data-id="<?=$row->id?>" data-toggle="tooltip"  title="Add in Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                                <?php    
                                                                }
                                                                ?>
                                                                <?php 
                                                                if(check_user_login() && $ci->is_favorite($this->session->userdata('user_id'), $row->id)){
                                                                ?>
                                                                <a href="javascript:void(0)"  style="color: red !important;" data-id="<?=$row->id?>" data-toggle="tooltip" title="<?=$this->lang->line('remove_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                                <?php 
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <a href="javascript:void(0)" data-id="<?=$row->id?>" data-toggle="tooltip" title="<?=$this->lang->line('add_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                                <?php    
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php  }$i++;} ?>
                                    </ul>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Television Entertainment -->
            <?php 
                    
                }
                if(isset($show_category[1]) && !empty($show_category[1]))
                {
                    $this->db->select('*');
                    $this->db->from('tbl_product'); 
                    $this->db->where('status', '1'); 
                    $this->db->where('category_id', $show_category[1]->id);
                    $this->db->limit(12); 
                    $this->db->order_by('id', 'DESC');
                    $show_category_pro2 = $this->db->get()->result();
                    
            ?>
            <div class="container">
                <!-- Laptops & Computers -->
                <div class="mb-6 position-relative">
                    <dv class="d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                        <h3 class="section-title section-title__full mb-0 pb-2 font-size-22"><?php echo $show_category[1]->category_name; ?></h3>
                    </dv>
                    <div class="js-slick-carousel position-static u-slick u-slick--gutters-1 overflow-hidden u-slick-overflow-visble pt-3 pb-3"
                        data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                        data-arrow-left-classes="fa fa-angle-left right-1"
                        data-arrow-right-classes="fa fa-angle-right right-0"
                        data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">
                        <div class="js-slide">
                            <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                                <?php 
                                $i = 0;
                                
                                foreach ($show_category_pro2 as $key => $row) 
                                {
                                    if($i < 6)
                                    {
                                    $img_file='assets/images/products/'.$row->featured_image;

                                    $is_avail=true;

                                    if($row->status==0)
                                    {
                                        $is_avail=false;
                                    }
                                ?>
                                <li class="col-md-4 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                    <div class="product-item__outer h-100 w-100">
                                        <div class="product-item__inner p-md-3 row no-gutters bg-white max-width-334">
                                            <div class="col col-lg-auto product-media-left">
                                                <a href="<?php echo site_url('product/'.$row->product_slug); ?>" class="d-block" style="max-width: 5.5rem;"><img class="img-fluid" src="<?=base_url().$img_file?>" alt="Image Description" style="width: 120px ;height: 112px;"></a>
                                            </div>
                                            <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1 pr-3 pr-md-0 pt-1 pt-md-0">
                                                <div class="mb-2">
                                                    <h5 class="mb-1 product-item__title"><a href="<?php echo site_url('product/'.$row->product_slug); ?>" title="<?=$row->product_title?>" class="text-blue font-weight-bold">
                                                        <?php 
                                                        if(strlen($row->product_title) > 15){
                                                            echo substr(stripslashes($row->product_title), 0, 15).'...';  
                                                        }else{
                                                            echo $row->product_title;
                                                        }
                                                        ?>
                                                        </a>
                                                    </h5>
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
                                                </div>
                                                <div class="flex-center-between mb-2">
                                                    
                                                   
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
                                                    <?php
                                                    $user_id=$this->session->userdata('user_id') ? $this->session->userdata('user_id'):'0'; 
                                                    if(!$ci->check_cart($row->id,$user_id)){
                                                    ?>
                                                    <div class="prodcut-add-cart">
                                                        <a href="javascript:void(0)" data-id="<?=$row->id?>" data-maxunit="<?=$row->max_unit_buy?>" data-toggle="tooltip" title="<?=$this->lang->line('add_cart_lbl')?>" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                    <?php } else { 
                                                    $cart_id=$ci->get_single_info(array('product_id' => $row->id, 'user_id' => $user_id),'id','tbl_cart');
                                                    ?>
                                                    <div class="prodcut-add-cart">
                                                        <a href="<?php echo site_url('remove-to-cart/'.$cart_id); ?>" style="background-color: red;" title="<?=$this->lang->line('remove_cart_lbl')?>" class=" btn_remove_cart btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="product-item__footer bg-white">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <?php 
                                                        if(check_user_login() && $ci->is_compare($this->session->userdata('user_id'), $row->id)){
                                                        ?>
                                                        <a href="javascript:void(0)" style="color: red !important;" data-id="<?=$row->id?>" data-toggle="tooltip"  title="Remove From Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <?php 
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <a href="javascript:void(0)" data-id="<?=$row->id?>" data-toggle="tooltip"  title="Add in Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <?php    
                                                        }
                                                        ?>
                                                        <?php 
                                                        if(check_user_login() && $ci->is_favorite($this->session->userdata('user_id'), $row->id)){
                                                        ?>
                                                        <a href="javascript:void(0)"  style="color: red !important;" data-id="<?=$row->id?>" data-toggle="tooltip" title="<?=$this->lang->line('remove_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                        <?php 
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <a href="javascript:void(0)" data-id="<?=$row->id?>" data-toggle="tooltip" title="<?=$this->lang->line('add_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php } $i++; } ?>
                                
                            </ul>
                        </div>
                        <?php 
                        if(count($show_category_pro2) > 6)
                        {
                        ?>
                        <div class="js-slide">
                            <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                                <?php 
                                $i = 0;
                                
                                foreach ($show_category_pro2 as $key => $row) 
                                {
                                    if($i >= 6)
                                    {
                                    $img_file='assets/images/products/'.$row->featured_image;

                                    $is_avail=true;

                                    if($row->status==0)
                                    {
                                        $is_avail=false;
                                    }
                                ?>
                                <li class="col-md-4 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                    <div class="product-item__outer h-100 w-100">
                                        <div class="product-item__inner p-md-3 row no-gutters bg-white max-width-334">
                                            <div class="col col-lg-auto product-media-left">
                                                <a href="<?php echo site_url('product/'.$row->product_slug); ?>" class="d-block" style="max-width: 5.5rem;"><img class="img-fluid" src="<?=base_url().$img_file?>" alt="Image Description" style="width: 120px ;height: 112px;"></a>
                                            </div>
                                            <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1 pr-3 pr-md-0 pt-1 pt-md-0">
                                                <div class="mb-2">
                                                    <h5 class="mb-1 product-item__title"><a href="<?php echo site_url('product/'.$row->product_slug); ?>" title="<?=$row->product_title?>" class="text-blue font-weight-bold">
                                                        <?php 
                                                        if(strlen($row->product_title) > 15){
                                                            echo substr(stripslashes($row->product_title), 0, 15).'...';  
                                                        }else{
                                                            echo $row->product_title;
                                                        }
                                                        ?>
                                                        </a>
                                                    </h5>
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
                                                </div>
                                                <div class="flex-center-between mb-2">
                                                    
                                                   
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
                                                    <?php
                                                    $user_id=$this->session->userdata('user_id') ? $this->session->userdata('user_id'):'0'; 
                                                    if(!$ci->check_cart($row->id,$user_id)){
                                                    ?>
                                                    <div class="prodcut-add-cart">
                                                        <a href="javascript:void(0)" data-id="<?=$row->id?>" data-maxunit="<?=$row->max_unit_buy?>" data-toggle="tooltip" title="<?=$this->lang->line('add_cart_lbl')?>" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                    <?php } else { 
                                                    $cart_id=$ci->get_single_info(array('product_id' => $row->id, 'user_id' => $user_id),'id','tbl_cart');
                                                    ?>
                                                    <div class="prodcut-add-cart">
                                                        <a href="<?php echo site_url('remove-to-cart/'.$cart_id); ?>" style="background-color: red;" title="<?=$this->lang->line('remove_cart_lbl')?>" class=" btn_remove_cart btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="product-item__footer bg-white">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <?php 
                                                        if(check_user_login() && $ci->is_compare($this->session->userdata('user_id'), $row->id)){
                                                        ?>
                                                        <a href="javascript:void(0)" style="color: red !important;" data-id="<?=$row->id?>" data-toggle="tooltip"  title="Remove From Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <?php 
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <a href="javascript:void(0)" data-id="<?=$row->id?>" data-toggle="tooltip"  title="Add in Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                        <?php    
                                                        }
                                                        ?>
                                                        <?php 
                                                        if(check_user_login() && $ci->is_favorite($this->session->userdata('user_id'), $row->id)){
                                                        ?>
                                                        <a href="javascript:void(0)"  style="color: red !important;" data-id="<?=$row->id?>" data-toggle="tooltip" title="<?=$this->lang->line('remove_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                        <?php 
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <a href="javascript:void(0)" data-id="<?=$row->id?>" data-toggle="tooltip" title="<?=$this->lang->line('add_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php } $i++; } ?>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- End Laptops & Computers -->
            </div>
            <?php
                } 
            }
            ?>
            
            <?php 
            if(!empty($todays_deal) &&  count($todays_deal) > 2)
            {
            ?>
            <div class="container">
                <!-- Recommendation for you -->
                <div class="position-relative">
                    <div class="border-bottom border-color-1 mb-2">
                        <h3 class="section-title section-title__full d-inline-block mb-0 pb-2 font-size-22">Today Deal's</h3>
                    </div>
                    <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-7 pt-2 px-1"
                        data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
                        data-slides-show="7"
                        data-slides-scroll="1"
                        data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                        data-arrow-left-classes="fa fa-angle-left right-1"
                        data-arrow-right-classes="fa fa-angle-right right-0"
                        data-responsive='[{
                          "breakpoint": 1400,
                          "settings": {
                            "slidesToShow": 6
                          }
                        }, {
                            "breakpoint": 1200,
                            "settings": {
                              "slidesToShow": 3
                            }
                        }, {
                          "breakpoint": 992,
                          "settings": {
                            "slidesToShow": 3
                          }
                        }, {
                          "breakpoint": 768,
                          "settings": {
                            "slidesToShow": 2
                          }
                        }, {
                          "breakpoint": 554,
                          "settings": {
                            "slidesToShow": 2
                          }
                        }]'>
                        <?php 
                        foreach ($todays_deal as $key => $row) 
                        {
                            $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->featured_image);

                            $img_file=$ci->_create_thumbnail('assets/images/products/',$thumb_img_nm,$row->featured_image,250,250);

                            $is_avail=true;

                            if($row->status==0)
                            {
                                $is_avail=false;
                            }
                        ?>
                        <div class="js-slide products-group">
                            <div class="product-item">
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
                                                    <a href="<?php echo site_url('remove-to-cart/'.$cart_id); ?>" style="background-color: #333e48;" title="<?=$this->lang->line('remove_cart_lbl')?>" class="btn-add-cart btn-primary transition-3d-hover btn_remove_cart "><i class="ec ec-add-to-cart"></i></a>
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
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- End Recommendation for you -->
            </div>
            <?php 
            }
            ?>
            
            <div class="container">
                <?php
                    $this->db->select('*');
                    $this->db->from('tbl_product'); 
                    $this->db->where('status', '1'); 
                    $this->db->limit(12); 
                    $this->db->order_by('id', 'DESC');
                    $new_arrival = $this->db->get()->result();
                    
                    if(count($new_arrival) > 2)
                    {
                ?>
                <!-- Recommendation for you -->
                <div class="position-relative">
                    <div class="border-bottom border-color-1 mb-2">
                        <h3 class="section-title section-title__full d-inline-block mb-0 pb-2 font-size-22">New Arrivals</h3>
                    </div>
                    <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-7 pt-2 px-1"
                        data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
                        data-slides-show="6"
                        data-slides-scroll="3"
                        data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                        data-arrow-left-classes="fa fa-angle-left right-1"
                        data-arrow-right-classes="fa fa-angle-right right-0"
                        data-responsive='[{
                          "breakpoint": 1400,
                          "settings": {
                            "slidesToShow": 6
                          }
                        }, {
                            "breakpoint": 1200,
                            "settings": {
                              "slidesToShow": 3
                            }
                        }, {
                          "breakpoint": 992,
                          "settings": {
                            "slidesToShow": 3
                          }
                        }, {
                          "breakpoint": 768,
                          "settings": {
                            "slidesToShow": 2
                          }
                        }, {
                          "breakpoint": 554,
                          "settings": {
                            "slidesToShow": 2
                          }
                        }]'>
                        <?php 
                        foreach ($new_arrival as $key => $row) 
                        {
                            $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->featured_image);

                            $img_file=$ci->_create_thumbnail('assets/images/products/',$thumb_img_nm,$row->featured_image,250,250);

                            $is_avail=true;

                            if($row->status==0)
                            {
                                $is_avail=false;
                            }
                        ?>
                        <div class="js-slide products-group">
                            <div class="product-item">
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
                                                if(!$ci->check_cart($row->id,$user_id)){
                                                ?>
                                                <div class="prodcut-add-cart">
                                                    <a href="javascript:void(0)" data-id="<?=$row->id?>" data-maxunit="<?=$row->max_unit_buy?>" data-toggle="tooltip" title="<?=$this->lang->line('add_cart_lbl')?>" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                </div>
                                                <?php } else { 
                                                $cart_id=$ci->get_single_info(array('product_id' => $row->id, 'user_id' => $user_id),'id','tbl_cart');
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
                                                if(check_user_login() && $ci->is_compare($this->session->userdata('user_id'), $row->id)){
                                                ?>
                                                <a href="javascript:void(0)" style="color: red !important;" data-id="<?=$row->id?>" data-toggle="tooltip"  title="Remove From Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <?php 
                                                }
                                                else
                                                {
                                                ?>
                                                <a href="javascript:void(0)" data-id="<?=$row->id?>" data-toggle="tooltip"  title="Add in Compare" class="text-gray-6 font-size-13 btn-compare"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <?php    
                                                }
                                                ?>
                                                <?php 
                                                if(check_user_login() && $ci->is_favorite($this->session->userdata('user_id'), $row->id)){
                                                ?>
                                                <a href="javascript:void(0)"  style="color: red !important;" data-id="<?=$row->id?>" data-toggle="tooltip" title="<?=$this->lang->line('remove_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                <?php 
                                                }
                                                else
                                                {
                                                ?>
                                                <a href="javascript:void(0)" data-id="<?=$row->id?>" data-toggle="tooltip" title="<?=$this->lang->line('add_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                <?php    
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <!-- End Recommendation for you -->
                
                <!-- Banner 2 columns -->
                <?php 
                $i=0;
                $this->db->select('*');
                $this->db->from('tbl_footer_banner'); 
                $this->db->where('status', '1'); 
                $this->db->limit(2);
                $this->db->order_by('id', 'DESC');
                $banner_list3 = $this->db->get()->result();
                if(count($banner_list3) >= 2)
                {
                ?>
                <div class="mb-8">
                    <div class="row">
                        <?php
                        foreach ($banner_list3 as $key => $row) 
                        {
                            $img_file=base_url('assets/images/banner/'.$row->banner_image);
                        ?>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <a href="#">
                                <img class="img-fluid" src="<?php echo $img_file; ?>" alt="Image Description">
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <!-- End Banner 2 columns -->
            </div>
            <?php
              // for hide/show brands 
              if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->home_brand_opt=='true')
              {
                ?>
            <!-- Brand Carousel -->
            <div class="container mb-8">
                <div class="py-2 border-top border-bottom">
                    <div class="js-slick-carousel u-slick my-1"
                        data-slides-show="5"
                        data-slides-scroll="1"
                        data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y"
                        data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9"
                        data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right"
                        data-responsive='[{
                            "breakpoint": 992,
                            "settings": {
                                "slidesToShow": 2
                            }
                        }, {
                            "breakpoint": 768,
                            "settings": {
                                "slidesToShow": 1
                            }
                        }, {
                            "breakpoint": 554,
                            "settings": {
                                "slidesToShow": 1
                            }
                        }]'>
                        <?php 
                        $i=0;
                        $this->db->select('*');
                        $this->db->from('tbl_brands'); 
                        $this->db->where('status', '1');
                        $this->db->order_by('id', 'DESC');
                          
                        $brands_list = $this->db->get()->result();
                        foreach ($brands_list as $key => $row) 
                        {

                            if($row->brand_image!='')
                            {

                                $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->brand_image);

                                $img_file='assets/images/brand/'.$row->brand_image;
                            }
                            else{
                                $img_file='https://via.placeholder.com/300x180?text=No image';
                            }
                            $url=base_url('brand/'.$row->brand_slug);
                          ?>
                        <div class="js-slide">
                            <a href="<?=$url?>" title="<?=$row->brand_name?>" class="link-hover__brand">
                                <img class="img-fluid m-auto max-height-50" src="<?=$img_file?>" style="width: 200px;height: 60px;" alt="Image Description">
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- End Brand Carousel -->
        </main>
        <!-- ========== END MAIN CONTENT ========== -->
        <?php include('include/footer-test.php'); ?>

        