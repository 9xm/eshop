
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
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><?php echo $current_page ?></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-wd-12gdot5">
                        <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                            <h3 class="section-title section-title__full mb-0 pb-2 font-size-22"><?php echo $page_title; ?></h3>
                        </div>
                        <ul class="row list-unstyled products-group no-gutters mb-6">
                            <?php 
                            $i=0;
                            $ci =& get_instance();
                            


                            foreach ($sub_category_list1 as $key => $row) 
                            {
                                $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->sub_category_image);

                                $img_file=base_url().$ci->_create_thumbnail('assets/images/sub_category/',$thumb_img_nm,$row->sub_category_image,270,162);
                            ?>
                            <li class="col-md-3 col-sm-12 product-item">
                                <div class="product-item__outer h-100 w-100">
                                    <div class="product-item__inner px-xl-4 p-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2">
                                                <a href="<?=site_url('category/'.$category_slug.'/'.$row->sub_category_slug)?>" class="d-block text-center"><img class="img-fluid" src="<?= $img_file; ?>" alt="Image Description"></a>
                                            </div>
                                            <h5 class="text-center mb-1 product-item__title"><a href="<?=site_url('category/'.$category_slug.'/'.$row->sub_category_slug)?>" class="font-size-15 text-gray-90">
                                                <?php 
                                                  if(strlen($row->sub_category_name) > 17){
                                                    echo substr(stripslashes($row->sub_category_name), 0, 17).'...';  
                                                  }else{
                                                    echo $row->sub_category_name;
                                                  }
                                                ?>
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php 
                            }
                            ?>

                        </ul>
                        <?php 
                        
                        foreach ($sub_category_list1 as $key => $product_row) 
                        {
                            
                            if($product_row->show_on_off==0){
                                continue;
                            }

                            $counts=$ci->getCount('tbl_product', array('sub_category_id' => $product_row->id, 'status' => '1'));

                            if($counts <= 0)
                            {
                                continue;
                            }

                        ?>
                        <div class="space-top-2">
                            <dv class=" d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                                <h3 class="section-title mb-0 pb-2 font-size-22"><?=$product_row->sub_category_name?></h3>
                                <?php 
                                if($counts > 5)
                                {
                                ?>
                                <ul class="nav nav-pills mb-2 pt-3 pt-md-0 mb-0 border-top border-color-1 border-md-top-0 align-items-center font-size-15 font-size-15-md flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                                    <li class="nav-item flex-shrink-0 flex-md-shrink-1 category_view_all">
                                        <a class="text-gray-90 btn btn-outline-primary border-width-2 rounded-pill py-1 px-4 font-size-15 text-lh-19 font-size-15-md " href="<?= base_url(); ?>category/<?=$category_slug?>/<?=$product_row->sub_category_slug?>">View all</a>
                                    </li>
                                    

                                </ul>
                                <?php } ?>
                            </dv>
                            <div class="js-slick-carousel u-slick u-slick--gutters-2 overflow-hidden u-slick-overflow-visble pt-3 pb-6 slick-initialized slick-slider slick-dotted" data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">
                                <div class="slick-list draggable">
                                    <div class="slick-track" style="opacity: 1; width: 3558px; transform: translate3d(0px, 0px, 0px);">
                                        <div class="js-slide slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 1170px; height: auto;" tabindex="0" role="tabpanel" id="slick-slide10" aria-describedby="slick-slide-control10">
                                            <ul class="row list-unstyled products-group mb-0 overflow-visible">
                                                <?php 
                                                $products=$ci->get_cat_sub_product($product_row->category_id, $product_row->id);
                                                $i = 0;
                                                foreach ($products as $key => $row) {

                                                    if($i >= 6)
                                                    {
                                                        break;
                                                    }

                                                        $i++;

                                                        $thumb_img_nm = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->featured_image);

                                                        $img_file=$ci->_create_thumbnail('assets/images/products/',$thumb_img_nm,$row->featured_image,210,210);

                                                        $img_file2=$ci->_create_thumbnail('assets/images/products/',$row->product_id,$row->featured_image2,210,210);

                                                ?>
                                                <li class="col-md-4 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                                    <div class="product-item__outer h-100">
                                                        <div class="product-item__inner p-md-3 row no-gutters">
                                                            <div class="col col-lg-auto product-media-left">
                                                                <a href="<?php echo site_url('product/'.$row->product_slug); ?>" class="max-width-150 d-block" tabindex="0"><img class="img-fluid" src="<?=base_url().$img_file?>" alt="Image Description" style="width: 120px ;height: 112px;"></a>
                                                            </div>
                                                            <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1">
                                                                <div class="mb-4">
                                                                    

                                                                    <h5 class="product-item__title"><a href="<?php echo site_url('product/'.$row->product_slug); ?>" title="<?=$row->product_title?>" class="text-blue font-weight-bold" tabindex="0"><?php 
                                                                if(strlen($row->product_title) > 15){
                                                                    echo substr(stripslashes($row->product_title), 0, 15).'...';  
                                                                }else{
                                                                    echo $row->product_title;
                                                                }
                                                                ?></a></h5>
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
                                                                <div class="flex-center-between mb-3">
                                                                    <div class="prodcut-price">
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
                                                                <div class="product-item__footer bg-white">
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
                                                </li>
                                                <?php 
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <?php 
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->
        <?php include('include/footer.php'); ?>
        
