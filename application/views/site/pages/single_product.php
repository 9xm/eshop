        <?php include('include/header.php'); ?>
        <style type="text/css">
            .radio-group .radio_btn {
                margin: 3px 4px 3px 0;
                text-align: center;
                padding: 5px 10px !important;
                min-width: 40px;
                border-radius: 4px;
            }

            .radio_btn.selected {
                border-color: #ff5252;
            }
            .radio_btn.selected {
                border-color: #ff5252;
                background: #ff5252;
                color: #fff;
            }
            .radio_btn {
                display: inline-block;
                width: auto;
                height: auto;
                background-color: #eee;
                border: 2px solid #ddd;
                cursor: pointer;
                margin: 2px 1px;
                text-align: center;
                padding: 5px 15px;
            }
            

            .quantity {
                z-index: 1;
                position: relative;
            }
            .buttons_added {
                text-align: left;
                position: relative;
                white-space: nowrap;
                vertical-align: top;
            }
            .buttons_added .minus, .buttons_added .plus {
                padding: 8px;
                height: 35px;
                width: 35px;
                border-radius: 50%;
                background-color: #ff5252;
                color: #FFF;
                cursor: pointer;
                line-height: 50%;
                font-size: x-large;
                border: none;
            }
            .buttons_added input {
                display: inline-block;
                margin: 0;
                vertical-align: top;
                box-shadow: none;
            }
            .quantity input {
                width: 75px;
                border: 1px solid #ebebeb;
                border-radius: 3px;
                height: 36px;
                font-size: 16px;
                line-height: 34px;
                color: #363f4d;
                padding: 0 0 0 10px;
            }
            .product_qty {
                text-align: center !important;
                width: 50px !important;
                padding: 0px !important;
            }
            .share_product_a
            {
                color: #fff;
                width: 34px;
                height: 34px;
                background: #ff5252;
                font-size: 16px;
                display: block;
                line-height: 36px;
                text-align: center;
                border-radius: 30px;
                -webkit-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
            }
            .quantity-button {
    background: #363f4d;
    box-shadow: none;
    border: 0;
    border-radius: 3px;
    color: #fff;
    display: block;
    font-size: 1em;
    font-weight: 500;
    height: 42px;
    line-height: 42px;
    overflow: hidden;
    padding: 0 20px;
    text-shadow: none;
    text-align: center;
    -webkit-transition: all .4s ease-out;
    -moz-transition: all .4s ease-out;
    -ms-transition: all .4s ease-out;
    -o-transition: all .4s ease-out;
    vertical-align: middle;
    white-space: nowrap;
   

    background: #ff5252;
    margin: 0;
}
            
        </style>
        <?php 

        $ci =& get_instance();

        $single_pre_url=current_url();

        $this->session->set_userdata(array('single_pre_url' => $single_pre_url));

        $user_id=$this->session->userdata('user_id') ? $this->session->userdata('user_id'):'0';

        $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $product->featured_image);

        $img_file=$ci->_create_thumbnail('assets/images/products/',$thumb_img_nm,$product->featured_image,600,600);

        $img_file_sm=$ci->_create_thumbnail('assets/images/products/',$thumb_img_nm,$product->featured_image,200,200);

                                

        $full_img='<div class="js-slide"><img class="img-fluid" src="'.base_url().$img_file.'" alt=""> </div>';

        $thumb_img='<div class="js-slide" style="cursor: pointer;"><img class="img-fluid" src="'.base_url().$img_file_sm.'" alt=""></div> ';                       

        $where = array('parent_id' => $product->id,'type' => 'product');

        $row_img=$ci->common_model->selectByids($where,'tbl_product_images');

        foreach ($row_img as $key => $value) {

            $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value->image_file);

            $img_big=$ci->_create_thumbnail('assets/images/products/gallery/',$thumb_img_nm,$value->image_file,600,600);

            $img_small=$ci->_create_thumbnail('assets/images/products/gallery/',$thumb_img_nm,$value->image_file,200,200);

            $full_img.='<div class="js-slide"><img class="img-fluid" src="'.base_url().$img_big.'" alt=""> </div>';

            $thumb_img.='<div class="js-slide" style="cursor: pointer;"><img class="img-fluid" src="'.base_url().$img_small.'" alt=""></div> ';
        }

        $size=$selected_size=$size_view='';
        if($product->product_size !=''){

            $i=1;
            foreach (explode(',', $product->product_size) as $key => $value) {

                $class='radio_btn';

                if($ci->check_cart($product->id,$this->session->userdata('user_id'))){

                    $cart_size=$ci->get_single_info(array('product_id' => $product->id, 'user_id' => $this->session->userdata('user_id')),'product_size','tbl_cart');


                    if($cart_size==$value){
                        $class='radio_btn selected';
                    }
                    else{
                        $class='radio_btn';
                    }
                }
                else{
                    if($i==1){
                        $class='radio_btn selected';
                    }
                    else{
                        $class='radio_btn';
                    }
                }

                if($i==1){
                    $selected_size=$value;
                    $size.='<div class="'.$class.'" data-value="'.$value.'">'.$value.'</div>';
                    $i=0;
                }
                else{
                    $size.='<div class="'.$class.'" data-value="'.$value.'">'.$value.'</div>';
                }
            }

            $size_chart=(file_exists('assets/images/products/'.$product->size_chart) AND $product->size_chart!='') ? base_url('assets/images/products/'.$product->size_chart) : "";

            if($size_chart!=''){
                $size_view.='<p style="margin:0px 5px 8px">'.$this->lang->line('size_lbl').' :- </p>
                <div class="radio-group" style="margin-bottom:10px">
                '.$size.'
                <input type="hidden" id="radio-value" name="product_size" value="'.$selected_size.'" />

                </div>';
            }
            else{

                $size_view.='
                <div class="clearfix"></div>
                <p style="margin:0px 5px 8px">'.$this->lang->line('size_lbl').'</p>
                <div class="radio-group">
                '.$size.'
                <input type="hidden" id="radio-value" name="product_size" value="'.$selected_size.'" />
                </div><br/>';

            }
        }

        $is_avail=true;

        if($product->status==0)
        {
            $is_avail=false;
        }

        ?>
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
                <!-- Single Product Body -->
                <div class="mb-xl-14 mb-6">
                    <div class="row">
                        <div class="col-md-5 mb-4 mb-md-0">
                            <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2"
                                data-infinite="true"
                                data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                                data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                                data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                                data-nav-for="#sliderSyncingThumb">
                                <?=$full_img?>
                            </div>

                            <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                                data-infinite="true"
                                data-slides-show="5"
                                data-is-thumbs="true"
                                data-nav-for="#sliderSyncingNav">
                                <?=$thumb_img?>
                            </div>
                        </div>
                        <div class="col-md-7 mb-md-6 mb-lg-0">
                            <div class="mb-2">
                                <div class="border-bottom mb-3 pb-md-1 pb-3">
                                    <h2 class="font-size-25 text-lh-1dot2"><?=$product->product_title?></h2>
                                    <div class="mb-2">
                                        <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                                            <div class="text-warning mr-2">
                                                <?php 
                                                for ($x = 0; $x < 5; $x++) { 
                                                    if($x < $product->rate_avg){
                                                        ?>
                                                        <small class="fas fa-star"></small>
                                                        <?php  
                                                    }
                                                    else{
                                                        ?>
                                                        <small class="far fa-star text-muted"></small>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="flex-horizontal-center flex-wrap mb-4">

                                    <?php 
                                    if(check_user_login() && $ci->is_favorite($this->session->userdata('user_id'), $product->id)){
                                    ?>
                                    <a href="javascript:void(0)"  style="color: red !important;" data-id="<?=$product->id?>" data-toggle="tooltip" title="<?=$this->lang->line('remove_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist mr-2"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                    <?php 
                                    }
                                    else
                                    {
                                    ?>
                                    <a href="javascript:void(0)" data-id="<?=$product->id?>" data-toggle="tooltip" title="<?=$this->lang->line('add_wishlist_lbl')?>" class="text-gray-6 font-size-13 btn_wishlist mr-2"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                    <?php    
                                    }
                                    ?>
                                    <?php 
                                    if(check_user_login() && $ci->is_compare($this->session->userdata('user_id'), $product->id)){
                                    ?>
                                    <a href="javascript:void(0)" style="color: red !important;" data-id="<?=$product->id?>" data-toggle="tooltip"  title="Remove From Compare" class="text-gray-6 font-size-13 btn-compare mr-2"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                    <?php 
                                    }
                                    else
                                    {
                                    ?>
                                    <a href="javascript:void(0)" data-id="<?=$product->id?>" data-toggle="tooltip"  title="Add in Compare" class="text-gray-6 font-size-13 btn-compare mr-2"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                    <?php    
                                    }
                                    ?>
                                    <ul style="margin: 0;padding: 0;">
                                        <li style="display: inline-block;margin-right: 5px;"><a class="share_product_a" href="https://www.facebook.com/sharer/sharer.php?u=<?=current_url()?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        <li style="display: inline-block;margin-right: 5px;"><a class="share_product_a" href="https://twitter.com/intent/tweet?text=<?=$page_title?>&amp;url=<?=current_url()?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        <li style="display: inline-block;margin-right: 5px;"><a class="share_product_a" href="http://pinterest.com/pin/create/button/?url=<?=current_url()?>&media=<?=base_url().$img_file?>&description=<?=$page_title?>" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>

                                        <li style="display: inline-block;margin-right: 5px;"><a class="share_product_a" href="https://api.whatsapp.com/send?text=<?=urlencode(current_url())?>" target="_blank" data-action="share/whatsapp/share"><i class="fab fa-whatsapp"></i></a></li>
                                    </ul>
                                </div>
                                <div class="flex-horizontal-center flex-wrap mb-4">
                                    <?php 
                                    if($product->offer_id!=0){
                                        ?>
                                        <br/>
                                        <a href="javascript:void(0)" class="applied_offer_lbl" data-offer="<?=$product->offer_id?>" style="font-weight: 500;color: green;font-size: 15px">
                                            <i class="fa fa-gift"></i> <?=$this->lang->line('applied_offer_lbl')?>

                                            <div class="offer_details" style="display: none">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 style="text-align: left">
                                                            <strong><?=$ci->get_single_info(array('id' => $product->offer_id),'offer_title','tbl_offers')?></strong>
                                                        </h4>
                                                        <p style="font-weight: normal !important;">
                                                            <?=$ci->get_single_info(array('id' => $product->offer_id),'offer_desc','tbl_offers')?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr style="margin: 10px auto" />
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p style="font-weight: normal !important;">
                                                            <strong>Discount: </strong><?=$ci->get_single_info(array('id' => $product->offer_id),'offer_percentage','tbl_offers')?>%</p>
                                                        </div>

                                                    </div>
                                                </div>

                                            </a>
                                        <?php } ?>
                                </div>
                                <p><?=$product->product_desc?></p>
                                <div class="mb-4">
                                    <div class="d-flex align-items-baseline">
                                        <?php 
                                        if($product->you_save_amt!='0'){
                                            ?>
                                            <ins class="font-size-36 text-decoration-none"><?=CURRENCY_CODE.' '.number_format($product->selling_price, 2)?></ins>
                                            <del class="font-size-20 ml-2 text-gray-6"><?=CURRENCY_CODE.' '.number_format($product->product_mrp, 2);?></del>
                                            <?php
                                        }
                                        else{
                                            ?>
                                           <ins class="font-size-36 text-decoration-none"><?=CURRENCY_CODE.' '.number_format($product->product_mrp, 2);?></ins>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                

                                
                                <?php 
                                if($product->color!=''){
                                    $color_arr=explode('/', $product->color);
                                    $color_name=$color_arr[0];
                                    $color_code=$color_arr[1];  
                                ?>
                                <div class="border-top border-bottom py-3 mb-4">
                                    <div class="d-flex align-items-center">
                                        <h6 class="font-size-14 mb-0"><?=$this->lang->line('colour_lbl') ?> : <?php echo $color_name; ?></h6>
                                        <!-- Select -->
                                        <!-- <select class="js-select selectpicker dropdown-select ml-3"
                                            data-style="btn-sm bg-white font-weight-normal py-2 border">
                                            <option value="one" selected>White with Gold</option>
                                            <option value="two">Red</option>
                                            <option value="three">Green</option>
                                            <option value="four">Blue</option>
                                        </select> -->
                                        <!-- End Select -->
                                    </div>
                                </div>
                                <?php } ?>
                               
                                        <?php 
                                        if($product->other_color_product!='')
                                        {

                                            $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $product->featured_image);

                                            $img_color_sm='assets/images/products/'.$product->featured_image;

                                            ?>
                                <div class="border-top border-bottom py-3 mb-4">
                                    <div class="d-flex align-items-center">
                                        <h6 class="font-size-14 mb-0"><?=$this->lang->line('colour_lbl') ?> :-  </h6>
                                                <a href="<?php echo site_url('product/'.$product->product_slug); ?>" title="<?=$color_name?>">
                                                    <div class="text-center" style="auto;">
                                                        <div class="container-fluid" style="border: 2px solid #ff5252;padding: 2px;border-radius:6px;">
                                                            <img src="<?=base_url().$img_color_sm?>" style="border-radius:4px;height: 80px;width: 80px;">        
                                                        </div>
                                                    </div>
                                                </a>
                                           
                                            <?php

                                            $ids=explode(',', $product->other_color_product);

                                            foreach ($ids as $key => $value) {

                                                $product_slug=$ci->get_single_info(array('id' => $value),'product_slug','tbl_product');

                                                $featured_image=$ci->get_single_info(array('id' => $value),'featured_image','tbl_product');

                                                $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $featured_image);

                                                $img_color_sm='assets/images/products/'.$featured_image;

                                                $color_arr=explode('/', $ci->get_single_info(array('id' => $value),'color','tbl_product'));
                                                $color_name=$color_arr[0];
                                                
                                                if($product_slug != '')
                                                {
                                                ?>
                                                
                                                    <a href="<?php echo site_url('product/'.$product_slug); ?>" title="<?=$color_name?>" style="float:left">
                                                        <div class="text-center" style="width: auto;">
                                                            <div class="container-fluid" style="border: 2px solid #eee;padding: 2px;border-radius:6px;">
                                                                <img src="<?=base_url().$img_color_sm?>" style="border-radius:4px;height: 80px;width: 80px;">
                                                            </div>
                                                        </div>
                                                    </a>
                                                
                                                <?php
                                                }
                                            }
                                            ?>
                                    </div>
                                </div>
                                <?php
                                        }
                                        ?>
                                    
                                    
                                <form action="<?=base_url('site/add_to_cart')?>" method="post" id="cartForm2">
                                    <?php 
                                    if($size_view != '')
                                    {
                                    ?>
                                    <div class="border-top border-bottom py-3 mb-4">
                                        <div class="d-flex align-items-center">
                                            <?php 
                                                echo $size_view;
                                            ?>
                                        </div>
                                    </div>
                                    <?php 
                                    }
                                    ?>
                                    <div class="d-md-flex align-items-end mb-3">
                                        <div class="mb-2 col-lg-3 col-md-4 col-sm-12" style="width: 50%;">
                                            <h6 class="font-size-14">Quantity</h6>
                                            <!-- Quantity -->
                                            <div class="quantity">
                                                <input type="hidden" name="user_id" value="<?=$this->session->userdata('user_id')?>">
                                                <input type="hidden" name="max_unit_buy" value="<?=$product->max_unit_buy ? $product->max_unit_buy: '1'?>" class="max_unit_buy">
                                                <input type="hidden" name="preview_url" value="<?=current_url()?>">
                                                <input type="hidden" name="product_id" value="<?=$product->id?>" />
                                            
                                                <div class="buttons_added">
                                                    <input type="button" value="-" class="minus">
                                                    <input class="input-text product_qty" name="product_qty" value="<?php if($ci->check_cart($product->id,$this->session->userdata('user_id'))){ echo $ci->get_single_info(array('product_id' => $product->id, 'user_id' => $this->session->userdata('user_id')),'product_qty','tbl_cart'); }else{ echo '1'; } ?>" type="text" min="1" max="<?=$product->max_unit_buy ? $product->max_unit_buy: '1'?>" onkeypress="return isNumberKey(event)" readonly="">
                                                    <input type="button" value="+" class="plus">
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <!-- End Quantity -->
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                                            <button class="quantity-button btn-add-cart btn px-2 btn-primary-dark transition-3d-hover" type="submit" style="width:auto;"  data-id="<?=$product->id?>" data-maxunit="<?=$product->max_unit_buy?>" data-toggle="tooltip"><i class="ec ec-add-to-cart mr-2 font-size-20"></i><?php if($ci->check_cart($product->id,$this->session->userdata('user_id'))){ echo $this->lang->line('update_cart_btn'); }else{ echo $this->lang->line('add_cart_btn'); } ?></button>
                                        </div>
                                    </form>
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                                            <form action="<?=site_url('buy-now')?>" id="buy_now_form" action="post">
                                                <input type="hidden" name="product" value="<?=$product->product_slug?>">
                                                <input type="hidden" name="size" value="">
                                                <input type="hidden" name="qty" value="">
                                                <input type="hidden" name="chkout_ref" value="<?=uniqid('chkref_')?>">
                                                <button class="btn px-5 btn-primary-dark transition-3d-hover quantity-button" type="submit" id="buy_now_btn"><?=$this->lang->line('buy_now_btn');?></button>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Product Body -->
                <!-- Single Product Tab -->
                <div class="mb-8">
                    <div class="position-relative position-md-static px-md-6">
                        <ul class="nav nav-classic nav-tab nav-tab-lg  flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                            
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link " id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">Specification</a>
                            </li>
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link active" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="false">Rating & Reviews</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Tab Content -->
                    <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                        <div class="tab-content" id="Jpills-tabContent">
                            

                            <div class="tab-pane fade " id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                                <div class="mx-md-5 pt-1">
                                    <?=$product->product_features?>
                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                                
                                <?php 

                                $totrating = $this->db->get_where('tbl_rating',array('product_id'=>$product->id))->num_rows();
                                $productrating5 = $this->db->get_where('tbl_rating',array('product_id'=>$product->id,'rating'=>5))->num_rows();
                                $productrating4 = $this->db->get_where('tbl_rating',array('product_id'=>$product->id,'rating'=>4))->num_rows();
                                $productrating3 = $this->db->get_where('tbl_rating',array('product_id'=>$product->id,'rating'=>3))->num_rows();
                                $productrating2 = $this->db->get_where('tbl_rating',array('product_id'=>$product->id,'rating'=>2))->num_rows();
                                $productrating1 = $this->db->get_where('tbl_rating',array('product_id'=>$product->id,'rating'=>1))->num_rows();
                                /*if(empty($productrating5))
                                {
                                    $productrating5 = 0;
                                }*/
                                if($productrating5 > 0 and $totrating > 0)
                                {
                                    $fdgfg = $productrating5/$totrating * 100;
                                }
                                else
                                {
                                    $fdgfg = 0;
                                }

                                if($productrating4 > 0 and $totrating > 0)
                                {
                                    $fdgfg1 = $productrating4/$totrating * 100;
                                }
                                else
                                {
                                    $fdgfg1 = 0;
                                }

                                if($productrating3 > 0 and $totrating > 0)
                                {
                                    $fdgfg2 = $productrating3/$totrating * 100;
                                }
                                else
                                {
                                    $fdgfg2 = 0;
                                }

                                if($productrating2 > 0 and $totrating > 0)
                                {
                                    $fdgfg3 = $productrating2/$totrating * 100;
                                }
                                else
                                {
                                    $fdgfg3 = 0;
                                }

                                if($productrating1 > 0 and $totrating > 0)
                                {
                                    $fdgfg4 = $productrating1/$totrating * 100;
                                }
                                else
                                {
                                    $fdgfg4 = 0;
                                }
                            
                                ?>    
                                <div class="row mb-8">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h3 class="font-size-18 mb-6">Rating</h3>
                                            <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0">
                                                
                                                <?php 
                                                if($productrating5 > 0 || $productrating4 > 0 || $productrating3 > 0 || $productrating2 > 0 || $productrating1 > 0)
                                                {
                                                echo number_format((5*$productrating5 + 4*$productrating4 + 3*$productrating3 + 2*$productrating2 + 1*$productrating1) / ($productrating5 + $productrating4 + $productrating3 + $productrating2 + $productrating1), 1);
                                                }
                                                else
                                                {
                                                
                                                }
                                                ?>

                                            </h2>
                                            <div class="text-lh-1">overall</div>
                                        </div>

                                        <!-- Ratings -->
                                        <ul class="list-unstyled">
                                            
                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar" style="width: <?= $fdgfg ?>%;background: green;" aria-valuenow="<?= $fdgfg ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span class="text-gray-90"><?= $productrating5; ?></span>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar" style="width: <?= $fdgfg1 ?>%;background: green;" aria-valuenow="<?= $fdgfg ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span class="text-gray-90"><?= $productrating4; ?></span>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar" style="width: <?= $fdgfg2 ?>%;background: green;" aria-valuenow="<?= $fdgfg ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span class="text-gray-90"><?= $productrating3; ?></span>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar" style="width: <?= $fdgfg3 ?>%;background: yellow;" aria-valuenow="<?= $fdgfg ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span class="text-gray-90"><?= $productrating2; ?></span>
                                                    </div>
                                                </a>
                                            </li>

                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                            <small class="far fa-star text-muted"></small>

                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar" style="width: <?= $fdgfg4 ?>%;background: red;" aria-valuenow="<?= $fdgfg ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-right">
                                                        <span class="text-gray-90"><?= $productrating1; ?></span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- End Ratings -->
                                    </div>
                                    <div class="col-md-6">
                                        
                                        <h3 class="font-size-18 mb-5">Add a review</h3>
                                        <form action="<?=base_url('site/product_review')?>" id="review-form" method="post">
                                            <input type="hidden" name="product_id" value="<?=$product->id?>">
                                        
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <fieldset class="rating">
                                                        

                                                        <input type="radio" id="star5" name="rating" value="5" required/> <label for="star5" title="Rocks!">5 <small class="fas fa-star"></small></label>
                                                        <input type="radio" id="star4" name="rating" value="4" required/> <label for="star4" title="Pretty good">4 <small class="fas fa-star"></small></label>
                                                        <input type="radio" id="star3" name="rating" value="3" required/> <label for="star3" title="Meh">3 <small class="fas fa-star"></small></label>
                                                        <input type="radio" id="star2" name="rating" value="2" required/> <label for="star2" title="Kinda bad">2 <small class="fas fa-star"></small></label>
                                                        <input type="radio" id="star1" name="rating" value="1" required/> <label for="star1" title="Sucks big time">1 <small class="fas fa-star"></small></label>
                                                    </fieldset>        
                                                </div>
                                                

                                                <div class="col-md-12">
                                                    <div class="form-group mb-2">
                                                        <label>Review <span class="text-danger">*</span></label>
                                                        <textarea cols="5" rows="6" class="form-control form-control-sm" name="message" required=""></textarea>
                                                    </div><!-- End .form-group -->    
                                                </div>
                                                <div class="row">
                                                    <div class="offset-md-4 offset-lg-3 col-auto">
                                                        <button type="submit" class="btn btn-primary-dark btn-wide transition-3d-hover">Add Review</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>
                                <?php 
                                if($totrating > 0)
                                {
                                    $totrating = $this->db->get_where('tbl_rating',array('product_id'=>$product->id))->result();
                                    foreach($totrating as $key)
                                    {

                                ?>
                                <!-- Review -->
                                <div class="border-bottom border-color-1 pb-4 mb-4">
                                    <!-- Review Rating -->
                                    <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                            <?php 
                                            for ($x = 0; $x < 5; $x++) { 
                                                if($x < $key->rating){
                                                    ?>
                                                    <small class="fas fa-star"></small>
                                                    <?php  
                                                }
                                                else{
                                                    ?>
                                                    <small class="far fa-star text-muted"></small>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            

                                        </div>
                                    </div>
                                    <!-- End Review Rating -->

                                    <p class="text-gray-90"><?=nl2br(stripslashes($key->rating_desc))?></p>

                                    <!-- Reviewer -->
                                    <div class="mb-2">
                                        <strong><?=$this->common_model->selectByidParam($key->user_id, 'tbl_users','user_name'); ?></strong>
                                        <span class="font-size-13 text-gray-23">- <?=date('F d, Y',strtotime($key->created_at));?></span>
                                    </div>
                                    <!-- End Reviewer -->
                                </div>
                                <?php 
                                    }
                                }
                                else
                                {
                                ?>
                                <div class="border-bottom border-color-1 pb-4 mb-4">
                                    <!-- Review Rating -->
                                    <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                        <div class="text-default text-ls-n2 font-size-16" style="width: 80px;">
                                            <h2 class="reviews-title">No Reviews</h2>
                                        </div>
                                    </div>
                                </div>
                                        
                                <?php    
                                }
                                ?>
                                <!-- End Review -->
                
                            </div>
                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- End Single Product Tab -->
                <!-- Related products -->
                <div class="mb-6">
                    <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                        <h3 class="section-title mb-0 pb-2 font-size-22"><?=$this->lang->line('related_product_lbl')?></h3>
                    </div>
                    <ul class="row list-unstyled products-group no-gutters">
                        <?php 
                        $n = 1;
                        foreach ($related_products as $key => $row) 
                        {
                            if($n > 5)
                            {
                                break;
                            }
                            $n++;
                            $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->featured_image);

                            $img_file=$ci->_create_thumbnail('assets/images/products/',$thumb_img_nm,$row->featured_image,250,250);

                            $is_avail=true;

                            if($row->status==0)
                            {
                                $is_avail=false;
                            }
                        ?>
                        <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                            <div class="product-item__outer h-100">
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
                    <?php  }?>
                    </ul>
                </div>
                <!-- End Related products -->
            </div>
            <div id="offer_details" class="modal" style="z-index: 9999999;background: rgba(0,0,0,0.5);overflow-y: auto;">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content p-4">
                        <div class="modal-header">
                            <h4 class="modal-title" style="font-weight: 600"><?=$this->lang->line('offer_details_lbl')?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" style="padding:0px;padding-top:15px;">
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->

        <?php include('include/footer.php'); ?>
        <script type="text/javascript">
    // submit review form
    $("#review-form").submit(function(e){
        e.preventDefault();

        var formData = new FormData($(this)[0]);

        $.ajax({
            url:$(this).attr("action"),
            processData: false,
            contentType: false,
            type: 'POST',
            data: formData,
            success: function(data){

                var obj = $.parseJSON(data);
                if(obj.success=='1'){
                    location.reload();
                }
                else{
                    swal("<?=$this->lang->line('something_went_wrong_err')?>");
                }
            }

        });

    });

    $(document).ready(function(e){
        $("#buy_now_form").find("input[name='size']").val($("input[name='product_size']").val());
        $("#buy_now_form").find("input[name='qty']").val($("input[name='product_qty']").val());
    });


    $('.radio-group .radio_btn').click(function(){

        $(this).parent().find('.radio_btn').removeClass('selected');
        $(this).addClass('selected');
        var val = $(this).attr('data-value');
        $(this).parent().find('input').val(val);

        var size = $("input[name='product_size']").val();

        $("#buy_now_form").find("input[name='size']").val(size);
    });

    $(".btn_remove_img").click(function(e){
        e.preventDefault();

        var _ele=$(this).parent(".review_img_holder");

        var href = '<?=base_url()?>site/remove_review_image';

        var id=$(this).data("id");

        swal({
            title: "<?=$this->lang->line('are_you_sure_msg')?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger btn_edit",
            cancelButtonClass: "btn-warning btn_edit",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false,
            showLoaderOnConfirm: true
        },
        function(isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url:href,
                    data: {"id": id},
                    type:'post',
                    success:function(res){
                        var obj = $.parseJSON(res); 
                        swal.close();
                        if(obj.success==1){
                            _ele.remove();
                            $('.notifyjs-corner').empty();
                            $.notify(
                                obj.message, 
                                { position:"top center",className: obj.class }
                                );
                        }
                        else{
                            swal("<?=$this->lang->line('something_went_wrong_err')?>");
                        }
                    }
                });

            }else{
                swal.close();
            }
        });
    });

    $(document).ready(function() {
        var showChar = 200;
        var ellipsestext = "...";
        var moretext = '<?=$this->lang->line("show_more_lbl")?> <i class="fa fa-chevron-right" style="font-size: 12px"></i>';
        var lesstext = '<?=$this->lang->line("show_less_lbl")?> <i class="fa fa-chevron-left" style="font-size: 12px"></i>';


        $('.more').each(function() {
            var content = $.trim($(this).text());

            if(content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span><a href="" class="morelink">' + moretext + '</a></span>';

                $(this).html(html);
            }

        });

        $(".morelink").click(function(){
            if($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });

        $("#cartForm2").submit(function(event){

            event.preventDefault();
            $(".process_loader").show();

            var formData = $(this).serialize();
            var _form=$(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData
            })
            .done(function(response) {

                var res = $.parseJSON(response);
                $(".process_loader").hide();

                if(res.success=='1'){
                    swal({ title: "<?=$this->lang->line('done_lbl')?>", text: res.msg, type: "success" }, function(){ location.reload(); });
                }
                else if(res.success=='0'){
                    window.location.href='<?=base_url()?>login-register';
                }

            })
            .fail(function(response) {
                $(".process_loader").hide();
                swal("<?=$this->lang->line('something_went_wrong_err')?>");
            });

        });

    });

    // for size chart modal open

    $(".size_chart").click(function(e){
        e.preventDefault();

        $(".size_chart_img").hide();
        $(".no_data").hide();

        if($(this).data("img")==''){
            $(".no_data").show();
        }
        else{
            $(".size_chart_img").show();
            $(".size_chart_img").attr("src",$(this).data("img"));
        }
        
        $("#size_chart").modal("show")

    });


    $(".applied_offer_lbl").click(function(e){
        e.preventDefault();

        var content=$(this).find(".offer_details").html();
        $("#offer_details .modal-body").html(content)
        $("#offer_details").modal("show");
    });

    function showReviewNotAllow(){
        $('.notifyjs-corner').empty();
        $.notify("<?=$this->lang->line('review_not_allow_lbl')?>", { position:"top center",className: 'error' });
    }

    $("#buy_now_form").submit(function()
    {
        $(this).children(':input[value=""]').attr("disabled", "disabled");
        return true; // ensure form still submits
    });

</script>

<?php
if($this->session->flashdata('cart_msg')) {
$message = $this->session->flashdata('cart_msg');
?>
<script type="text/javascript">
    var _msg='<?=$message['message']?>';
    var _class='<?=$message['class']?>';

    $('.notifyjs-corner').empty();
    $.notify(
        _msg, 
        { position:"top center",className: _class }
        ); 
    </script>
    <?php
    unset($_SESSION['cart_msg']);
}
?>

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
        { position:"top center",className: _class }
        ); 
    </script>
    <?php
    unset($_SESSION['response_msg']);
}
?>