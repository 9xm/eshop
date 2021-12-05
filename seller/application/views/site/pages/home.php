
<?php 
define('APP_NAME', $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->site_name);
define('APP_FAVICON', $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->web_favicon);
define('APP_LOGO', $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->web_logo_1);
define('APP_LOGO_2', $this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->web_logo_1);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min-5.css'); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site_assets/vendor/font-awesome/css/fontawesome-all.min.css">

    <title>Becarto Seller</title>
    <style>
        .becart-header{background-color: #e91e63;}
        .card-becartobg-white{background-color: #e91e63; color: #ebf8fa;}
        .becart-banner{background-image: url("<?= base_url('assets/images/wave-2.svg'); ?>"); background-size: 100% 100%;-o-background-size: 100% 100%;-webkit-background-size: 100% 100%;background-size: cover;margin-bottom: 60px;}
        .navbar.navbar-belight{background-color: #e91e63;}
        .navbar-belight a.navbar-brand{ display: inline-block; width: 25%; font-size:3rem; font-weight:bold; color:#fff; }
        .navbar-belight a.navbar-brand img{width: 100%;}
        .navbar-belight .navbar-nav{ flex-direction: row;}
        .card-becartobg-sky{ background-color: #ebf8fa;} 
        .seller-login{color: #ebf8fa; font-weight: bold; margin-right: 30px;}
        .seller-login:hover{box-shadow: 0 2px #ebf8fa;}
        .navbar .start-selling{ font-weight: bold; background-color: #ebf8fa; color: #e91e63;}
        .becart-banner .start-selling{ font-weight: bold; background-color: #ebf8fa; color: #e91e63;}
        .becart-banner h1{ color: #ebf8fa; margin-top: 10%;}
        .becart-banner .btntool{margin-top: 20px;margin-bottom: 20px;}
        .becart-banner .start-selling{margin-right: 20px;}
        .becart-banner .learn-more{background-color: #002f36; color: #ebf8fa;}
        .becart-banner .tnc{ color: #ebf8fa; }
        .becart-banner text{}
        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            .navbar-belight a.navbar-brand{ font-size:2rem; }
            .container .float-end { float: none!important;}
            a.seller-login{background-color: #ebf8fa; color: #e91e63;}
          .container .col-6.beacrto-footer-last{width: 100%!important;}
        .becart-banner .row{ display: inherit;}
        .becart-banner .row h1{ margin-top:0px; padding-top: 10px;}
        }
   </style>
  </head>
  <body>
    <div class="becart-header">  
        <div class="container">
        
        <nav class="navbar d-block navbar-expand-lg navbar-belight">
              <a class="navbar-brand" href="http://seller.becarto.in"><!--img src="http://seller.becarto.in/assets/images/14102021112941_11133.png" /-->Becarto Seller</a>
                <div class="float-end">
                    
                    <ul class=" navbar-text navbar-nav mb-2">
                        <?php  if ($is_login): ?>
                            <li class="nav-item">
                                <a class="btn" href="<?=site_url('admin'); ?>">My Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn" href="<?=site_url('admin/logout'); ?>">Logout</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="btn seller-login" href="http://seller.becarto.in/admin">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn start-selling" href="http://seller.becarto.in/register">Start Selling</a>
                            </li>
                        <?php endif; ?>
                        </ul>
                </div>
          </nav>
        </div>
        </div>
        <div class="becart-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <h1><?php echo get_seller_option('home_banner_headding', $sellerrow);?></h1>
                        <div class="text"><?php echo get_seller_option('home_banner_sub_headding', $sellerrow);?></div>
                        <div class="clearfix btntool"><a class="btn btn-outline-secondary start-selling" href="http://seller.becarto.in/register">Start Selling</a> <a class="btn btn-outline-secondary learn-more" href="<?php echo get_seller_option('home_banner_learn_more_link', $sellerrow);?>">Learn More</a></div>
                        <div class="clearfix"><a  class="tnc" href="<?php echo get_seller_option('home_banner_t_c_link', $sellerrow);?>">* T&C</a></div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                    <?php 
                              $img_path='http://becarto.in/assets/images/';
                              $img_url='';
                              $home_banner_image=get_seller_option('home_banner_image', $sellerrow);
                              if($home_banner_image!="" || file_exists($img_path.$home_banner_image))
                              {
                                $img_url=$img_path.$home_banner_image;
                              }
                              else{
                                $img_url=$img_path.'no-image-1.jpg';
                              }

                            ?>
                        <a href="javascript:;">
                            <img class="img-thumbnail rounded-circle  p-3 mb-2 bg-white rounded" src="<?php echo $img_url; ?>">
						</a>                    
                    </div>

                </div>
            </div>  
        </div>  
        <?php 
                             // $img_path=base_url().'assets/images/';
                              $img_url='';
                              $home_first_card_image=get_seller_option('home_first_card_image', $sellerrow);
                              if($home_first_card_image!="" || file_exists($img_path.$home_first_card_image))
                              {
                                $img_url=$img_path.$home_first_card_image;
                              }
                              else{
                                $img_url=$img_path.'no-image-1.jpg';
                              }
?>
        <div class="container">
            <div class="card mb-4 card-becartobg-white" >
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="<?php echo $img_url; ?>" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo get_seller_option('home_first_card_title', $sellerrow);?></h5>
                      <p class="card-text"><?php echo get_seller_option('home_first_card_description', $sellerrow);?></p>
                      <!--p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p-->
                    </div>
                  </div>
                </div>
              </div>
              <?php 
                              //$img_path=base_url().'assets/images/';
                              $img_url="";
                              $second_image=get_seller_option('home_second_card_image', $sellerrow);

                              if($second_image!="" || file_exists($img_path.$second_image))
                              {
                                $img_url=$img_path.$second_image;
                              }
                              else{
                                $img_url=$img_path.'no-image-1.jpg';
                              }

                            ?>
              <div class="card mb-3 card-becartobg-sky" >
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="<?php echo $img_url; ?>" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo get_seller_option('home_second_card_title', $sellerrow);?></h5>
                      <p class="card-text"><?php echo get_seller_option('home_second_card_description', $sellerrow);?></p>
                      <!--p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p-->
                    </div>
                  </div>
                </div>
              </div>
              <footer class="pt-4 my-md-5 pt-md-5 border-top">
                <div class="row">
                  <div class="col-12 col-md beacrto-footer-first">
                    <img class="mb-2" src="http://seller.becarto.in/assets/images/14102021112941_11133.png" style="80%" alt="" >
                    <div class="mb-4">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <i class="ec ec-support text-primary font-size-56"></i>
                                    </div>
                                    <div class="col pl-3">
                                        <div class="font-size-13 font-weight-light">Got questions? Call us!</div>
                                        <a href="tel: 9724694647" class="font-size-20 text-gray-90">9724694647</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h6 class="mb-1 font-weight-bold">Address:</h6>
                                <address class="">
                                    #9 Tulshidham Society near guruku...                                </address>
                            </div>

                    
                  </div>
                  <div class="col-6 col-md">
                    <h5>About</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="https://becarto.in/about-us">About Us</a></li>
                        <li><a class="text-muted" href="https://becarto.in/terms-of-use">Terms &amp; Conditions</a></li>
                        <li><a class="text-muted" href="https://becarto.in/privacy">Privacy Policy </a></li>
                        <li><a class="text-muted" href="https://becarto.in/refund-return-policy"> Return Policy</a></li>
                        <li><a class="text-muted" href="https://becarto.in/cancellation">Cancellation Policy</a></li>
                        <li><a class="text-muted" href="https://becarto.in/payments">Payment</a></li>
                        <li><a class="text-muted" href="https://becarto.in/contact-us">Contact Us</a></li>
                    </ul>
                  </div>
                  <div class="col-6 col-md">
                    <h5>My Account</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="https://becarto.in/my-account">My Account</a></li>
                        <li><a class="text-muted" href="https://becarto.in/my-orders">My Orders</a></li>
                        <li><a class="text-muted" href="https://becarto.in/my-cart">Shopping Cart</a></li>
                        <li><a class="text-muted" href="https://becarto.in/wishlist">Wishlist</a></li>
                        <li><a class="text-muted" href="https://becarto.in/compare">Compare</a></li>
                        <li><a class="text-muted" href="https://becarto.in/faq">FAQ</a></li>
                    </ul>
                  </div>
                  <div class="col-6 col-sm-12 col-md beacrto-footer-last">
                    <h5>About</h5>
                    <ul class="list-inline mb-0 opacity-7">
                        <li class="list-inline-item mr-0">
                            <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="sdfsfs">
                                <span class="fab fa-facebook-f btn-icon__inner"></span>
                            </a>
                        </li>
                                                                                                                <li class="list-inline-item mr-0">
                            <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="sdfsdf">
                                <span class="fab fa-instagram btn-icon__inner"></span>
                            </a>
                        </li>
                                                                                                                <li class="list-inline-item mr-0">
                            <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="dfsdf">
                                <span class="fab fa-twitter btn-icon__inner"></span>
                            </a>
                        </li>
                    </ul>
                    <ul class="list-inline mb-0 opacity-7">
                        <li class="list-inline-item mr-0">
                            <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="sdfsfs">
                                <span class="fab fa-cc-visa btn-icon__inner"></span>
                            </a>
                        </li>
                                                                                                                <li class="list-inline-item mr-0">
                            <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="sdfsdf">
                                <span class="fab fa-cc-mastercard btn-icon__inner"></span>
                            </a>
                        </li>
                        <li class="list-inline-item mr-0">
                            <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="dfsdf">
                                <span class="fab fa-cc-discover btn-icon__inner"></span>
                            </a>
                            <li class="list-inline-item mr-0">
                            <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="dfsdf">
                                <span class="fab fa-cc-paypal btn-icon__inner"></span>
                            </a>
                        </li>
                    </ul>
                    <small class="d-block mb-3 text-muted">&copy; 2020-2021</small>
                  </div>
                </div>
              </footer>
        </div>  


  </body>
</html>
