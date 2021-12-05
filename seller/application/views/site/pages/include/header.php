<?php 
define('APP_NAME', $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->site_name);
define('APP_FAVICON', $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->web_favicon);
define('APP_LOGO', $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->web_logo_1);
define('APP_LOGO_2', $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->web_logo_1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Title -->
        <title><?php if (isset($current_page)) {
    echo $current_page . ' | ';
  } ?><?php echo APP_NAME; ?></title>

        <!-- Required Meta Tags Always Come First -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="description" content="<?= isset($current_desc) ? $current_desc : $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->site_description ;?>">
        <meta name="keywords" content="<?= isset($current_keyword) ? $current_keyword : $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->site_keywords ;?>">

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?= base_url('assets/images/') . APP_FAVICON ?>">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;display=swap" rel="stylesheet">

        <!-- CSS Implementing Plugins -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site_assets/vendor/font-awesome/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site_assets/css/font-electro.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site_assets/vendor/animate.css/animate.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site_assets/vendor/hs-megamenu/src/hs.megamenu.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site_assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site_assets/vendor/fancybox/jquery.fancybox.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site_assets/vendor/slick-carousel/slick/slick.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site_assets/vendor/ion-rangeslider/css/ion.rangeSlider.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site_assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site_assets/css/jquery-ui.min.css">

        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- CSS Electro Template -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site_assets/css/theme.css">
        <!-- Sweetalert popup -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/sweetalert/sweetalert.css') ?>">

        <script src="<?= base_url('assets/site_assets/js/notify.min.js') ?>"></script>
        <script type="text/javascript">
        var Settings = {
          base_url: '<?= base_url() ?>',
          currency_code: '<?= CURRENCY_CODE ?>',
          hour: '<?= $this->lang->line('hour_lbl') ?>',
          minute: '<?= $this->lang->line('minute_lbl') ?>',
          second: '<?= $this->lang->line('second_lbl') ?>',
          confirm_msg: '<?= $this->lang->line('are_you_sure_msg') ?>',
          ord_cancel_confirm: '<?= $this->lang->line('ord_cancel_confirm_lbl') ?>',
          product_cancel_confirm: '<?= $this->lang->line('product_cancel_confirm_lbl') ?>',
          err_cart_item_buy: '<?= $this->lang->line('err_cart_item_buy_lbl') ?>',
          err_shipping_address: '<?= $this->lang->line('no_shipping_address_err') ?>',
          err_something_went_wrong: '<?= $this->lang->line('something_went_wrong_err') ?>',
        }
        </script>		<style>							</style>
    </head>
    <body>
        <?php  $ci =& get_instance(); 
        $this->db->select('*');
        $this->db->from('tbl_category'); 
        $this->db->where('status', '1'); 
          
        
      
        $category_list = $this->db->get()->result();
        ?>
        <!-- ========== HEADER ========== -->
        <header id="header" class="u-header u-header-left-aligned-nav">
            <div class="u-header__section">
                <!-- Topbar -->
                <!--<div class="u-header-topbar py-2 d-none d-xl-block">
                    <div class="container">
                        <div class="d-flex align-items-center">
                            <div class="topbar-left">
                                <a href="<?= base_url('/'); ?>" class="text-gray-110 font-size-13 u-header-topbar__nav-link">Welcome to <?php echo APP_NAME; ?></a>
                            </div>
                            <div class="topbar-right ml-auto">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                        <a href="<?php echo site_url('my-account'); ?>" class="u-header-topbar__nav-link"><i class="ec ec-user mr-1"></i> My Account</a>
                                    </li>
                                    <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                        <a href="<?= base_url() ?>vendor-register" class="u-header-topbar__nav-link"><i class="ec ec-user mr-1"></i> Seller</a>
                                    </li>
                                    <?php 
                                    if($this->session->userdata('user_id') != '')
                                    {
                                    ?>  
                                    <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                        <a href="<?= base_url(); ?>site/logout" class="u-header-topbar__nav-link"><i class="ec ec-user mr-1"></i>Logout</a>
                                        
                                    </li>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                        <a href="<?= base_url() ?>login-register" class="u-header-topbar__nav-link"><i class="ec ec-user mr-1"></i> Register <span class="text-gray-50">or</span> Sign in</a>
                                    </li>
                                    <?php 
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>-->
                <!-- End Topbar -->

                <!-- Logo-Search-header-icons -->
                <div class="py-2 py-xl-5 bg-primary-down-lg">
                    <div class="container my-0dot5 my-xl-0">
                        <div class="row align-items-center">
                            <!-- Logo-offcanvas-menu -->
                            <div class="col-auto">
                                <!-- Nav -->
                                <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                                    <!-- Logo -->
                                    <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="<?= base_url('/') ?>" aria-label="">
                                        <img src="<?= base_url('assets/images/') . APP_LOGO ?>" alt="<?= APP_NAME ?>">    
                                    </a>
                                    <!-- End Logo -->

                                    <button id="sidebarHeaderInvokerMenu" type="button" class="btn u-hamburger mr-3 mr-xl-0 sdsfsdfsdfseefsdsfss"
                                        aria-controls="sidebarHeader"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        data-unfold-event="click"
                                        data-unfold-hide-on-scroll="false"
                                        data-unfold-target="#sidebarHeader1"
                                        data-unfold-type="css-animation"
                                        data-unfold-animation-in="fadeInLeft"
                                        data-unfold-animation-out="fadeOutLeft"
                                        data-unfold-duration="500">
                                        <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                            <span class="u-hamburger__inner"></span>
                                        </span>
                                    </button>
                                </nav>
                                <!-- End Nav -->
                                <!-- ========== HEADER SIDEBAR ========== -->
                                <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarHeaderInvokerMenu">
                                    <div class="u-sidebar__scroller">
                                        <div class="u-sidebar__container">
                                            <div class="u-header-sidebar__footer-offset pb-0">
                                                <!-- Toggle Button -->
                                                <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-7">
                                                    <button type="button" class="close ml-auto"
                                                        aria-controls="sidebarHeader"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                        data-unfold-event="click"
                                                        data-unfold-hide-on-scroll="false"
                                                        data-unfold-target="#sidebarHeader1"
                                                        data-unfold-type="css-animation"
                                                        data-unfold-animation-in="fadeInLeft"
                                                        data-unfold-animation-out="fadeOutLeft"
                                                        data-unfold-duration="500">
                                                        <span aria-hidden="true"><i class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                                    </button>
                                                </div>
                                                <!-- End Toggle Button -->

                                                <!-- Content -->
                                                <div class="js-scrollbar u-sidebar__body">
                                                    <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
                                                        <!-- Logo -->
                                                        <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="<?= base_url('/') ?>" aria-label="">
                                                            <img src="<?= base_url('assets/images/') . APP_LOGO ?>" alt="<?= APP_NAME ?>">    
                                                        </a>
                                                        <!-- End Logo -->
                                                        <ul class="u-header-collapse__nav">
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link" href="<?= base_url() ?>vendor-register" style="position: relative;">
                                                                    Seller Register
                                                                </a>
                                                            </li>
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link" href="<?php echo site_url('my-account'); ?>" style="position: relative;">
                                                                    <?=$this->lang->line('myaccount_lbl')?>
                                                                </a>
                                                            </li>
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link" href="<?= base_url('/todays-deals') ?>" style="position: relative;"><?= $this->lang->line('todays_deal_lbl') ?></a>
                                                            </li>
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link" href="<?php echo site_url('my-orders'); ?>" style="position: relative;">
                                                                    <?=$this->lang->line('myorders_lbl')?>
                                                                </a>
                                                            </li>

                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link" href="<?php echo site_url('my-cart'); ?>" style="position: relative;">
                                                                    <?=$this->lang->line('shoppingcart_lbl')?>
                                                                </a>
                                                            </li>

                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link" href="<?php echo site_url('wishlist'); ?>" style="position: relative;">
                                                                    <?=$this->lang->line('mywishlist_lbl')?>
                                                                </a>
                                                            </li>
                                                            
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link" href="<?php echo site_url('compare'); ?>" style="position: relative;">
                                                                    Compare
                                                                </a>
                                                            </li>
                                                            <?php 
                                                            if($this->session->userdata('user_id') != '')
                                                            {
                                                                ?>
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link" href="<?= base_url(); ?>site/logout" style="position: relative;">
                                                                    Log Out
                                                                </a>
                                                            </li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                        <hr>
                                                        <h5>Categories</h5>
                                                        <div style="height:300px;overflow-y:scroll">
                                                        <!-- List -->
                                                        <ul id="headerSidebarList" class="u-header-collapse__nav">
                                                            <?php 
                                                            $j = 1;
                                                            foreach ($category_list as $key => $row) 
                                                            {
                                                            
                                                                $j++;
                                                                $counts = $ci->getCount('tbl_sub_category', array('category_id' => $row->id, 'status' => '1'));

                                                                if ($counts > 0) 
                                                                {
                                                                ?>
                                                                <li class="u-has-submenu u-header-collapse__submenu">
                                                                    <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarHomeCollapse" data-target="#headerSidebarHomeCollapse<?= $j; ?>">
                                                                    <?php
                                                                        if (strlen($row->category_name) > 20) {
                                                                          echo substr(stripslashes($row->category_name), 0, 20) . '...';
                                                                        } else {
                                                                          echo $row->category_name;
                                                                        }
                                                                        ?>
                                                                    </a>
                                                                    <div id="headerSidebarHomeCollapse<?= $j; ?>" class="collapse" data-parent="#headerSidebarContent">
                                                                        <ul id="headerSidebarHomeMenu" class="u-header-collapse__nav-list">
                                                                        <?php
                                                                        $sub_category_list = $ci->get_sub_category($row->id);
                                                                        $i = 1;
                                                                        foreach ($sub_category_list as $key1 => $row1) {
                                                                        ?>
                                                                            <li><a class="u-header-collapse__submenu-nav-link" href="<?= site_url('category/' . $row->category_slug . '/' . $row1->sub_category_slug) ?>"><?php
                                                                                    if (strlen($row1->sub_category_name) > 30) {
                                                                                      echo substr(stripslashes($row1->sub_category_name), 0, 30) . '...';
                                                                                    } else {
                                                                                      echo $row1->sub_category_name;
                                                                                    }
                                                                                    ?>
                                                                                        
                                                                                </a>
                                                                            </li>
                                                                        <?php 
                                                                        }
                                                                        ?>
                                                                        </ul>
                                                                    </li>
                                                                <?php 
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <li class="u-has-submenu u-header-collapse__submenu">
                                                                    <a class="u-header-collapse__nav-link" href="<?php echo base_url('category/products/' . $row->id); ?>" style="position: relative;">
                                                                        <?php
                                                                        if (strlen($row->category_name) > 20) {
                                                                          echo substr(stripslashes($row->category_name), 0, 20) . '...';
                                                                        } else {
                                                                          echo $row->category_name;
                                                                        }
                                                                        ?>
                                                                    </a>
                                                                </li>
                                                                <?php    
                                                                }}
                                                                ?>
                                                                
                                                            <!-- Home Section -->
                                                        </ul>
                                                        </div>
                                                        <!-- End List -->
                                                    </div>
                                                </div>
                                                <!-- End Content -->
                                            </div>
                                            <footer id="SVGwaveWithDots" class="u-header-sidebar__footer" style="">
            

                                                <!-- SVG Background Shape -->
                                                <div class="position-absolute right-0 bottom-0 left-0 z-index-n1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 126.5" style="margin-bottom: -5px; enable-background:new 0 0 300 126.5;" xml:space="preserve" class="injected-svg js-svg-injector" data-parent="#SVGwaveWithDots">
                                                    <style type="text/css">
                                                        .wave-bottom-with-dots-0{fill:#377DFF;}
                                                        .wave-bottom-with-dots-1{fill:#377DFF;}
                                                        .wave-bottom-with-dots-2{fill:#DE4437;}
                                                        .wave-bottom-with-dots-3{fill:#00C9A7;}
                                                        .wave-bottom-with-dots-4{fill:#FFC107;}
                                                    </style>
                                                    <path class="wave-bottom-with-dots-0 fill-primary" opacity=".6" d="M0,58.9c0-0.9,5.1-2,5.8-2.2c6-0.8,11.8,2.2,17.2,4.6c4.5,2.1,8.6,5.3,13.3,7.1C48.2,73.3,61,73.8,73,69  c43-16.9,40-7.9,84-2.2c44,5.7,83-31.5,143-10.1v69.8H0C0,126.5,0,59,0,58.9z"></path>
                                                    <path class="wave-bottom-with-dots-1 fill-primary" d="M300,68.5v58H0v-58c0,0,43-16.7,82,5.6c12.4,7.1,26.5,9.6,40.2,5.9c7.5-2.1,14.5-6.1,20.9-11  c6.2-4.7,12-10.4,18.8-13.8c7.3-3.8,15.6-5.2,23.6-5.2c16.1,0.1,30.7,8.2,45,16.1c13.4,7.4,28.1,12.2,43.3,11.2  C282.5,76.7,292.7,74.4,300,68.5z"></path>
                                                    <g>
                                                        <circle class="wave-bottom-with-dots-2 fill-danger" cx="259.5" cy="17" r="13"></circle>
                                                        <circle class="wave-bottom-with-dots-1 fill-primary" cx="290" cy="35.5" r="8.5"></circle>
                                                        <circle class="wave-bottom-with-dots-3 fill-success" cx="288" cy="5.5" r="5.5"></circle>
                                                        <circle class="wave-bottom-with-dots-4 fill-warning" cx="232.5" cy="34" r="2"></circle>
                                                    </g>
                                                    </svg>
                                                </div>
                                                <!-- End SVG Background Shape -->
                                            </footer>
                                        </div>
                                    </div>
                                </aside>
                                <!-- ========== END HEADER SIDEBAR ========== -->
                                
                            </div>
                            <!-- End Logo-offcanvas-menu -->
                            <!-- Search Bar -->
                            <div class="col d-none d-xl-block">
                                <form  action="<?= base_url('search-result') ?>" id="search_form" method="get" class="js-focus-state">
                                    <label class="sr-only" for="searchproduct">Search</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control py-2 pl-5 font-size-15 border-right-0 height-40 border-width-2 rounded-left-pill border-primary" name="keyword" id="search" autocomplete="off" placeholder="<?= $this->lang->line('search_lbl') ?>" aria-label="<?= $this->lang->line('search_lbl') ?>" aria-describedby="searchProduct1" value="<?= $this->input->get('keyword') != '' ? $this->input->get('keyword') : '' ?>" required>
                                        <div class="input-group-append">
                                            <!-- Select -->
                                            <select class="js-select selectpicker dropdown-select custom-search-categories-select"
                                                data-style="btn height-40 text-gray-60 font-weight-normal border-top border-bottom border-left-0 rounded-0 border-primary border-width-2 pl-0 pr-5 py-2" name="category" data-placeholder="Choose Category">
                                                <option value="">All Categories</option>
                                                <?php
                                                foreach ($ci->get_category() as $key => $row) {
                                                  echo '<option value="' . $row->category_slug . '">' . $row->category_name . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <!-- End Select -->
                                            <button class="btn btn-primary height-40 py-2 px-3 rounded-right-pill" type="submit" id="searchProduct1">
                                                <span class="ec ec-search font-size-24"></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End Search Bar -->
                            <!-- Header Icons -->
                            <div class="col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                                <div class="d-inline-flex">
                                    <ul class="d-flex list-unstyled mb-0 align-items-center">
                                        <!-- Search -->
                                        <li class="col d-xl-none px-2 px-sm-3 position-static">
                                            <a id="searchClassicInvoker" class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary" href="javascript:;" role="button"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Search"
                                                aria-controls="searchClassic"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                data-unfold-target="#searchClassic"
                                                data-unfold-type="css-animation"
                                                data-unfold-duration="300"
                                                data-unfold-delay="300"
                                                data-unfold-hide-on-scroll="true"
                                                data-unfold-animation-in="slideInUp"
                                                data-unfold-animation-out="fadeOut">
                                                <span class="ec ec-search"></span>
                                            </a>

                                            <!-- Input -->
                                            <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                                                <form  action="<?= base_url('search-result') ?>" id="search_form" method="get" class="js-focus-state input-group px-3">
                                                    <input class="form-control"  name="keyword"  type="text" placeholder="<?= $this->lang->line('search_lbl') ?>" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary px-3" type="submit"><i class="font-size-18 ec ec-search" id="searchProduct1"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- End Input -->
                                        </li>
                                        <!-- End Search -->
                                        
                                        <li class="col d-none d-xl-block"><a href="<?= base_url() ?>vendor-register" class="text-gray-90 btn btn-outline-secondary sell-button rounded-lg" data-toggle="tooltip" data-placement="top" title="Vendor Register"><i class="fa fa-sign-in" aria-hidden="true"></i>
Sell</a></li>
                                        <?php
                                        if (!check_user_login()) {
                                        ?>
                                        
                                        
                                        
                                        <li class="col d-none d-xl-block"><a href="<?php echo site_url('login-register'); ?>" class="text-gray-90 btn btn-outline-primary sell-button rounded-lg" data-toggle="tooltip" data-placement="top" title="Login/Register"><i class="fa fa-sign-in" aria-hidden="true"></i>
Login</a></li>
                                        
                                        <!--<li class="col d-none d-xl-block"><a href="<?php echo site_url('my-account'); ?>" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="My account"><i class="font-size-22 ec ec-user"></i></a></li>-->
                                        
                                        <li class="col pr-xl-0 px-2 px-sm-3">
                                            <a href="<?php echo site_url('login-register'); ?>" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                                <i class="font-size-22 ec ec-shopping-bag"></i>
                                            </a>
                                        </li>
                                        <?php } else {
                                        ?>
                                        <!--<li class="col d-none d-xl-block"><a href="<?php echo site_url('compare'); ?>" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Compare"><i class="font-size-22 ec ec-compare"></i></a></li>
                                        
                                        <li class="col d-none d-xl-block"><a href="<?php echo site_url('wishlist'); ?>" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Favorites"><i class="font-size-22 ec ec-favorites"></i></a></li>-->																			<li class="col d-none d-xl-block pr-0">										<nav class="navbar-dark navbar-expand-sm">									  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">										<span class="navbar-toggler-icon"></span>									  </button>									  <div class="collapse navbar-collapse" id="navbar-list-4">										<ul class="navbar-nav">																						<li class="nav-item dropdown">											<a class="nav-link dropdown-toggle text-gray-90 rounded-circle" href="<?php echo site_url('my-account'); ?>" id="navbarDropdownMenuLink" style="color: #333e48;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">													<i class="font-size-22 ec ec-user"></i>          											</a>											<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">											  <a class="dropdown-item" href="my-account">Dashboard</a>											   <a class="dropdown-item" href="my-account">Edit Profile</a>											  <a class="dropdown-item" href="my-orders">My Orders</a>											  <a class="dropdown-item" href="logout">Log Out</a>											</div>										  </li>   										</ul>									  </div>									</nav>								</li>								<li>Welcome &nbsp;<strong><?php echo $_SESSION['user_name'];?></strong></li>																												<li class="col d-none d-xl-block"><a href="<?= base_url(); ?>site/logout" class="text-gray-90 btn btn-outline-primary rounded-lg" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out d-inline" aria-hidden="true"></i>Logout</a></li>
                                        
                                        <li class="col pr-xl-0 px-2 px-sm-3">
                                            <a href="<?php echo site_url('my-cart'); ?>" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                                <i class="font-size-22 ec ec-shopping-bag"></i>
                                                <span class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12"><?php echo $ci->getCount('tbl_cart', array('user_id' => $this->session->userdata('user_id'))); ?></span>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Header Icons -->
                        </div>
                    </div>
                </div>
                <!-- End Logo-Search-header-icons -->

                <!-- Primary-menu-wide -->
                <div class="d-none d-xl-block bg-primary">
                    <div class="container">
                        <div class="min-height-45">
                            <div class="col d-none d-xl-block">
                                <!-- Nav -->
                                <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space hs-menu-initialized hs-menu-horizontal">
                                    <!-- Navigation -->
                                    <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                        <ul class="navbar-nav u-header__navbar-nav">
                                            <!-- About us -->
                                            <li class="nav-item u-header__nav-item">
                                                <a class="nav-link u-header__nav-link" href="<?php echo base_url('/') ?>">Home</a>
                                            </li>
                                            
                                            
                                            <!-- End About us -->

                                            <?php
                                            $n = 1;

                                            foreach ($category_list as $key => $row) {
                                                if ($n > 6) {
                                                    break;
                                                }

                                                $n++;

                                                $counts = $ci->getCount('tbl_sub_category', array('category_id' => $row->id, 'status' => '1'));

                                                if ($counts > 0) 
                                                {
                                                ?>
                                                    <li class="nav-item hs-has-sub-menu u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut">
                                                        <a id="blogMegaMenu<?php echo $n; ?>" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="<?php echo base_url('category/' . $row->category_slug); ?>" aria-haspopup="true" aria-expanded="false" aria-labelledby="blogSubMenu"><?php
                                                        if (strlen($row->category_name) > 20) {
                                                          echo substr(stripslashes($row->category_name), 0, 20) . '...';
                                                        } else {
                                                          echo $row->category_name;
                                                        }
                                                        ?></a>

                                                        <!-- Blog - Submenu -->
                                                        <ul id="blogSubMenu<?php echo $n; ?>" class="hs-sub-menu u-header__sub-menu" aria-labelledby="blogMegaMenu" style="min-width: 510px; display: none;">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <?php
                                                                    $sub_category_list = $ci->get_sub_category($row->id);
                                                                    $i = 1;
                                                                    foreach ($sub_category_list as $key1 => $row1) {
                                                                    ?>
                                                                    <li><a class="nav-link u-header__sub-menu-nav-link" href="<?= site_url('category/' . $row->category_slug . '/' . $row1->sub_category_slug) ?>">
                                                                        <?php
                                                                        if (strlen($row1->sub_category_name) > 30) {
                                                                          echo substr(stripslashes($row1->sub_category_name), 0, 30) . '...';
                                                                        } else {
                                                                          echo $row1->sub_category_name;
                                                                        }
                                                                        ?>
                                                                    </a></li>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <a href="#" class="d-block">
                                                                        <img class="img-fluid" src="<?= base_url().'assets/images/category/'.$row->category_image?>" alt="Image Description" style="max-width:94% ;width: auto;height: auto;">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </ul>
                                                    <!-- End Submenu -->
                                                    </li>
                                                <?php    
                                                } 
                                                else 
                                                {
                                                ?> 
                                                <li class="nav-item u-header__nav-item">
                                                    <a class="nav-link u-header__nav-link" href="<?php echo base_url('category/products/' . $row->id); ?>"><?php
                                                    if (strlen($row->category_name) > 20) {
                                                      echo substr(stripslashes($row->category_name), 0, 20) . '...';
                                                    } else {
                                                      echo $row->category_name;
                                                    }
                                                    ?></a>
                                                </li>   
                                                    
                                                <?php 
                                                }}
                                                ?>
                                        </ul>
                                    </div>
                                    <!-- End Navigation -->
                                    <?php 
                                    if($n > 6)
                                    {
                                    ?>
                                    <div class="col-md-auto d-none d-xl-block">
                                        <div class="max-width-270 min-width-270">
                                            <!-- Basics Accordion -->
                                            <div id="basicsAccordion">
                                                <!-- Card -->
                                                <div class="card border-0">
                                                    
                                                    <div class="card-header card-collapse border-0" id="basicsHeadingOne">
                                                        <button type="button" class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary border-0 font-weight-bold collapsed" data-toggle="collapse" data-target="#basicsCollapseOne" aria-expanded="false" aria-controls="basicsCollapseOne" style="color:white;">
                                                            <span class="ml-0 
                                                             mr-2">
                                                                <span class="fa fa-list-ul"></span>
                                                            </span>
                                                            <span class="pl-1 
                                                            ">More Categories</span>
                                                        </button>
                                                    </div>
                                                    <div id="basicsCollapseOne" class="vertical-menu collapse" aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion" style="">
                                                        <div class="card-body p-0">
                                                            <nav class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized hs-menu-horizontal">
                                                                <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                                                    <ul class="navbar-nav u-header__navbar-nav">
                                                                        <?php 
                                                                        $j = 1;
                                                                        foreach ($category_list as $key => $row) 
                                                                        {
                                                                            

                                                                            if ($j < 7) {
                                                                                $j++;
                                                                                continue;
                                                                            }

                                                                            $j++;
                                                                            $counts = $ci->getCount('tbl_sub_category', array('category_id' => $row->id, 'status' => '1'));

                                                                            if ($counts > 0) 
                                                                            {
                                                                            ?>
                                                                            <li class="nav-item hs-has-sub-menu u-header__nav-item" data-event="click" data-animation-in="slideInUp" data-animation-out="fadeOut" data-position="right">
                                                                                <a id="homeMegaMenu<?= $j; ?>" class="nav-link u-header__nav-link-toggle u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="homeSubMenu" style="background-color: #ff5252;font-weight: 700;color: white;"><i class="far fa-hand-point-left"></i> <?php
                                                                                    if (strlen($row->category_name) > 20) {
                                                                                      echo substr(stripslashes($row->category_name), 0, 20) . '...';
                                                                                    } else {
                                                                                      echo $row->category_name;
                                                                                    }
                                                                                    ?>
                                                                                </a>

                                                                                <!-- Home - Submenu -->
                                                                                <ul id="homeSubMenu<?= $j; ?>" class="hs-sub-menu u-header__sub-menu animated hs-position-right fadeOut" aria-labelledby="homeMegaMenu" style="min-width: 230px; display: none;display: block !important;height: auto;top: 0px;left: calc(-100% - 0px);bottom: 0;max-height: fit-content;">
                                                                                    <?php
                                                                                    $sub_category_list = $ci->get_sub_category($row->id);
                                                                                    $i = 1;
                                                                                    foreach ($sub_category_list as $key1 => $row1) {
                                                                                    ?>
                                                                                    <li class="hs-has-sub-menu">
                                                                                        <a class="nav-link u-header__sub-menu-nav-link " href="<?= site_url('category/' . $row->category_slug . '/' . $row1->sub_category_slug) ?>">
                                                                                            <?php
                                                                                            if (strlen($row1->sub_category_name) > 30) {
                                                                                              echo substr(stripslashes($row1->sub_category_name), 0, 30) . '...';
                                                                                            } else {
                                                                                              echo $row1->sub_category_name;
                                                                                            }
                                                                                            ?>
                                                                                        </a>
                                                                                    </li>
                                                                                    <?php 
                                                                                    }
                                                                                    ?>
                                                                                </ul>
                                                                           
                                                                            </li>
                                                                            <?php 
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <li class="nav-item u-header__nav-item" data-event="hover" data-position="left">
                                                                                <a href="<?php echo base_url('category/products/' . $row->id); ?>" class="nav-link u-header__nav-link font-weight-bold" style="background-color: #ff5252;font-weight: 700;color: white;"><?php
                                                                                if (strlen($row->category_name) > 20) {
                                                                                  echo substr(stripslashes($row->category_name), 0, 20) . '...';
                                                                                } else {
                                                                                  echo $row->category_name;
                                                                                }
                                                                                ?></a>
                                                                            </li>
                                                                            <?php    
                                                                            }}
                                                                            ?>
                                                                    </ul>
                                                                </div>
                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Card -->
                                            </div>
                                            <!-- End Basics Accordion -->
                                        </div>
                                    </div>
                                    <?php 
                                     }
                                    ?>
                                </nav>
                                <!-- End Nav -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Primary-menu-wide -->
            </div>
        </header>
        <!-- ========== END HEADER ========== -->