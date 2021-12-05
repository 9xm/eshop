<!-- ========== FOOTER ========== -->
        <footer>
            <!-- Footer-copy-right -->
            <div class="bg-gray-14 py-2">
                <div class="container">
                    <div class="flex-center-between d-block d-md-flex">
                        <div class="mb-3 mb-md-0"><?=$this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->copyright_text?></div>
                        <div class="text-md-right">
                            <span class="d-inline-block bg-white border rounded p-1">
                                <img class="max-width-5" src="<?php echo base_url(); ?>assets/site_assets/img/100X60/img1.jpg" alt="Image Description">
                            </span>
                            <span class="d-inline-block bg-white border rounded p-1">
                                <img class="max-width-5" src="<?php echo base_url(); ?>assets/site_assets/img/100X60/img2.jpg" alt="Image Description">
                            </span>
                            <span class="d-inline-block bg-white border rounded p-1">
                                <img class="max-width-5" src="<?php echo base_url(); ?>assets/site_assets/img/100X60/img3.jpg" alt="Image Description">
                            </span>
                            <span class="d-inline-block bg-white border rounded p-1">
                                <img class="max-width-5" src="<?php echo base_url(); ?>assets/site_assets/img/100X60/img4.jpg" alt="Image Description">
                            </span>
                            <span class="d-inline-block bg-white border rounded p-1">
                                <img class="max-width-5" src="<?php echo base_url(); ?>assets/site_assets/img/100X60/img5.jpg" alt="Image Description">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer-copy-right -->
        </footer>
        <!-- ========== END FOOTER ========== -->
        <div id="cartModal" class="modal fade" role="dialog" style="z-index: 9999999">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- ========== SECONDARY CONTENTS ========== -->
        <!-- Account Sidebar Navigation -->
        <aside id="sidebarContent" class="u-sidebar u-sidebar__lg" aria-labelledby="sidebarNavToggler">
            <div class="u-sidebar__scroller">
                <div class="u-sidebar__container">
                    <div class="js-scrollbar u-header-sidebar__footer-offset pb-3">
                        <!-- Toggle Button -->
                        <div class="d-flex align-items-center pt-4 px-7">
                            <button type="button" class="close ml-auto"
                                aria-controls="sidebarContent"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-unfold-event="click"
                                data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarContent"
                                data-unfold-type="css-animation"
                                data-unfold-animation-in="fadeInRight"
                                data-unfold-animation-out="fadeOutRight"
                                data-unfold-duration="500">
                                <i class="ec ec-close-remove"></i>
                            </button>
                        </div>
                        <!-- End Toggle Button -->

                        <!-- Content -->
                        <div class="js-scrollbar u-sidebar__body">
                            <div class="u-sidebar__content u-header-sidebar__content">
                                <form class="js-validate">
                                    <!-- Login -->
                                    <div id="login" data-target-group="idForm">
                                        <!-- Title -->
                                        <header class="text-center mb-7">
                                        <h2 class="h4 mb-0">Welcome Back!</h2>
                                        <p>Login to manage your account.</p>
                                        </header>
                                        <!-- End Title -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signinEmail">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signinEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="signinEmail" placeholder="Email" aria-label="Email" aria-describedby="signinEmailLabel" required
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                              <label class="sr-only" for="signinPassword">Password</label>
                                              <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signinPasswordLabel">
                                                        <span class="fas fa-lock"></span>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" name="password" id="signinPassword" placeholder="Password" aria-label="Password" aria-describedby="signinPasswordLabel" required
                                                   data-msg="Your password is invalid. Please try again."
                                                   data-error-class="u-has-error"
                                                   data-success-class="u-has-success">
                                              </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <div class="d-flex justify-content-end mb-4">
                                            <a class="js-animation-link small link-muted" href="javascript:;"
                                               data-target="#forgotPassword"
                                               data-link-group="idForm"
                                               data-animation-in="slideInUp">Forgot Password?</a>
                                        </div>

                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Login</button>
                                        </div>

                                        <div class="text-center mb-4">
                                            <span class="small text-muted">Do not have an account?</span>
                                            <a class="js-animation-link small text-dark" href="javascript:;"
                                               data-target="#signup"
                                               data-link-group="idForm"
                                               data-animation-in="slideInUp">Signup
                                            </a>
                                        </div>

                                        <div class="text-center">
                                            <span class="u-divider u-divider--xs u-divider--text mb-4">OR</span>
                                        </div>

                                        <!-- Login Buttons -->
                                        <div class="d-flex">
                                            <a class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1" href="#">
                                              <span class="fab fa-facebook-square mr-1"></span>
                                              Facebook
                                            </a>
                                            <a class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0" href="#">
                                              <span class="fab fa-google mr-1"></span>
                                              Google
                                            </a>
                                        </div>
                                        <!-- End Login Buttons -->
                                    </div>

                                    <!-- Signup -->
                                    <div id="signup" style="display: none; opacity: 0;" data-target-group="idForm">
                                        <!-- Title -->
                                        <header class="text-center mb-7">
                                        <h2 class="h4 mb-0">Welcome to Electro.</h2>
                                        <p>Fill out the form to get started.</p>
                                        </header>
                                        <!-- End Title -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signupEmail">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="signupEmail" placeholder="Email" aria-label="Email" aria-describedby="signupEmailLabel" required
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signupPassword">Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupPasswordLabel">
                                                            <span class="fas fa-lock"></span>
                                                        </span>
                                                    </div>
                                                    <input type="password" class="form-control" name="password" id="signupPassword" placeholder="Password" aria-label="Password" aria-describedby="signupPasswordLabel" required
                                                    data-msg="Your password is invalid. Please try again."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupConfirmPassword">Confirm Password</label>
                                                <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signupConfirmPasswordLabel">
                                                        <span class="fas fa-key"></span>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" name="confirmPassword" id="signupConfirmPassword" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="signupConfirmPasswordLabel" required
                                                data-msg="Password does not match the confirm password."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Get Started</button>
                                        </div>

                                        <div class="text-center mb-4">
                                            <span class="small text-muted">Already have an account?</span>
                                            <a class="js-animation-link small text-dark" href="javascript:;"
                                                data-target="#login"
                                                data-link-group="idForm"
                                                data-animation-in="slideInUp">Login
                                            </a>
                                        </div>

                                        <div class="text-center">
                                            <span class="u-divider u-divider--xs u-divider--text mb-4">OR</span>
                                        </div>

                                        <!-- Login Buttons -->
                                        <div class="d-flex">
                                            <a class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1" href="#">
                                                <span class="fab fa-facebook-square mr-1"></span>
                                                Facebook
                                            </a>
                                            <a class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0" href="#">
                                                <span class="fab fa-google mr-1"></span>
                                                Google
                                            </a>
                                        </div>
                                        <!-- End Login Buttons -->
                                    </div>
                                    <!-- End Signup -->

                                    <!-- Forgot Password -->
                                    <div id="forgotPassword" style="display: none; opacity: 0;" data-target-group="idForm">
                                        <!-- Title -->
                                        <header class="text-center mb-7">
                                            <h2 class="h4 mb-0">Recover Password.</h2>
                                            <p>Enter your email address and an email with instructions will be sent to you.</p>
                                        </header>
                                        <!-- End Title -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="recoverEmail">Your email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="recoverEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="recoverEmail" placeholder="Your email" aria-label="Your email" aria-describedby="recoverEmailLabel" required
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Recover Password</button>
                                        </div>

                                        <div class="text-center mb-4">
                                            <span class="small text-muted">Remember your password?</span>
                                            <a class="js-animation-link small" href="javascript:;"
                                               data-target="#login"
                                               data-link-group="idForm"
                                               data-animation-in="slideInUp">Login
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End Forgot Password -->
                                </form>
                            </div>
                        </div>
                        <!-- End Content -->
                    </div>
                </div>
            </div>
        </aside>
        <!-- End Account Sidebar Navigation -->
        <!-- ========== END SECONDARY CONTENTS ========== -->

        <!-- Go to Top -->
        <a class="js-go-to u-go-to" href="#"
            data-position='{"bottom": 15, "right": 15 }'
            data-type="fixed"
            data-offset-top="400"
            data-compensation="#header"
            data-show-effect="slideInUp"
            data-hide-effect="slideOutDown">
            <span class="fas fa-arrow-up u-go-to__inner"></span>
        </a>
        <!-- End Go to Top -->

        <!-- JS Global Compulsory -->
        
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/bootstrap/bootstrap.min.js"></script>

        <!-- JS Implementing Plugins -->
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/appear.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/jquery.countdown.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/svg-injector/dist/svg-injector.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/fancybox/jquery.fancybox.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/typed.js/lib/typed.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/slick-carousel/slick/slick.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

        <!-- JS Electro -->
        <script src="<?php echo base_url(); ?>assets/site_assets/js/hs.core.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.countdown.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.header.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.hamburgers.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.unfold.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.focus-state.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.malihu-scrollbar.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.validation.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.fancybox.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.onscroll-animation.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.slick-carousel.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.show-animation.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.svg-injector.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.go-to.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.selectpicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/components/hs.range-slider.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/site_assets/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets/sweetalert/sweetalert.min.js')?>"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/custom_jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/site_assets/js/cust_javascript.js"></script>
        
         <?php
        if(isset($_POST['subscribe_email']))
        {
            $emailid = $_POST['emailid'];
            if($emailid != '')
            {
                $data = array(
                    'emailid'=>$emailid,
                    'created_at'=> strtotime(date('d-m-Y h:i:s A')),
                );
                $data = $this->security->xss_clean($data);
                $inserted=$this->db->insert('tbl_subscribe',$data);

                if($inserted=='')
                {
                ?>
                <script type="text/javascript">
                    $(document).ready(function () { 
                        alert("Plz Try Again");
                        $('#subscribe_email').val('');
                         window.location.href(); 
                    });
                </script>
                <?php    
                }
                else
                {
                ?>
                <script type="text/javascript">
                    $(document).ready(function () { 
                        alert("Thank You for Subscribe");
                        $('#subscribe_email').val(''); 
                        window.location.href();
                    });
                </script>
                <?php
                }
            }
            else
            {
             ?>
                <script type="text/javascript">
                    $(document).ready(function () { 
                        alert("Enter Email id");
                        $('#subscribe_email').val('');
                        window.location.href();   
                    });
                </script>
            <?php    
            }
        }
        ?>
        <!-- JS Plugins Init. -->
        <script>
            function jqUpdateSize()
            {
                // Get the dimensions of the viewport
                var width = $(window).width();
                var height = $(window).height();

                if (width < 1200) {
                    //$('.headerfooter').show();
                    $('.product-item__footer').show();
                    $('.prodcut-add-cart').css('display','block !important');
                    //$('.headerwhislist').hide();
                }
                

            };
            $(document).ready(jqUpdateSize);    // When the page first loads
            $(window).resize(jqUpdateSize);

            $(window).on('load', function () {
                // initialization of HSMegaMenu component
                $('.js-mega-menu').HSMegaMenu({
                    event: 'hover',
                    direction: 'horizontal',
                    pageContainer: $('.container'),
                    breakpoint: 767.98,
                    hideTimeOut: 0
                });
            });

            $(document).on('ready', function () {
                // initialization of header
                $.HSCore.components.HSHeader.init($('#header'));

                // initialization of forms
                $.HSCore.components.HSRangeSlider.init('.js-range-slider');

                // initialization of animation
                $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                    afterOpen: function () {
                        $(this).find('input[type="search"]').focus();
                    }
                });

                // initialization of popups
                $.HSCore.components.HSFancyBox.init('.js-fancybox');

                // initialization of countdowns
                var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
                    yearsElSelector: '.js-cd-years',
                    monthsElSelector: '.js-cd-months',
                    daysElSelector: '.js-cd-days',
                    hoursElSelector: '.js-cd-hours',
                    minutesElSelector: '.js-cd-minutes',
                    secondsElSelector: '.js-cd-seconds'
                });

                // initialization of malihu scrollbar
                $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

                // initialization of forms
                $.HSCore.components.HSFocusState.init();

                // initialization of form validation
                $.HSCore.components.HSValidation.init('.js-validate', {
                    rules: {
                        confirmPassword: {
                            equalTo: '#signupPassword'
                        }
                    }
                });

                // initialization of show animations
                $.HSCore.components.HSShowAnimation.init('.js-animation-link');

                // initialization of fancybox
                $.HSCore.components.HSFancyBox.init('.js-fancybox');

                // initialization of slick carousel
                $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

                // initialization of go to
                $.HSCore.components.HSGoTo.init('.js-go-to');

                // initialization of hamburgers
                $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                    beforeClose: function () {
                        $('#hamburgerTrigger').removeClass('is-active');
                    },
                    afterClose: function() {
                        $('#headerSidebarList .collapse.show').collapse('hide');
                    }
                });

                $('#headerSidebarList [data-toggle="collapse"]').on('click', function (e) {
                    e.preventDefault();

                    var target = $(this).data('target');

                    if($(this).attr('aria-expanded') === "true") {
                        $(target).collapse('hide');
                    } else {
                        $(target).collapse('show');
                    }
                });

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

                // initialization of select picker
                $.HSCore.components.HSSelectPicker.init('.js-select');
            });
        </script>

        
        
    
    </body>
</html>
