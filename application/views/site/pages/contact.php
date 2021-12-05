        <?php include('include/header.php'); ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <div class="mb-5">
                    <h1 class="text-center"><?php echo $page_title; ?></h1>
                </div>
                <div class="row mb-10">
                    <div class="col-lg-7 col-xl-6 mb-8 mb-lg-0">
                        <div class="mr-xl-6">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25"><?=$this->lang->line('form_section_lbl')?></h3>
                            </div>
                            
                            <form class="js-validate"  action="<?php echo site_url('site/contact_form'); ?>" method="post" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                <?=$this->lang->line('name_place_lbl')?>
                                                <span class="text-danger">*</span>
                                            </label>
                                           
                                            <input type="text"  class="form-control" name="name" required="" placeholder="<?=$this->lang->line('name_place_lbl')?> *">
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                <?=$this->lang->line('email_lbl')?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="lastName" placeholder="" aria-label="" required="" data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                        <!-- End Input -->
                                    </div>

                                    <div class="col-md-12">
                                        <!-- Input -->
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                Subject
                                            </label>
                                            
                                            <input type="email"  class="form-control" name="email" required="" placeholder="<?=$this->lang->line('email_lbl')?> *">
                                        </div>
                                        <!-- End Input -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                Subject
                                            </label>

                                            <div class="input-group">
                                                <select name="subject_id" class="form-control" required="">
                                                    <option value=""><?=$this->lang->line('subject_lbl')?></option>
                                                    <?php 
                                                    foreach ($contact_subjects as $key => $value) {
                                                        echo '<option value="'.$value->id.'">'.$value->title.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="js-form-message mb-4">
                                            <label class="form-label">
                                                <?=$this->lang->line('message_lbl')?>
                                            </label>

                                            <div class="input-group">
                                                
                                                <textarea name="message" class="form-control p-5" required="" cols="40" rows="4" placeholder="<?=$this->lang->line('message_lbl')?> *"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="wizard-form-input has-float-label">
                                            <div class="g-recaptcha" data-sitekey="<?=$this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->g_captcha_site_key?>"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary-dark-w px-5">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-6">
                        
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Our Address</h3>
                        </div>
                        <address class="mb-6 text-lh-23">
                            <?=$this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->address?>
                            
                        </address>
                        <address class="mb-6 text-lh-23">
                            
                            <div class=""><?=$this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->contact_number?></div>
                            
                        </address>
                        <address class="mb-6 text-lh-23">
                            
                            <div class="">Email: <a class="text-blue text-decoration-on" href="mailto:<?=$this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->contact_email?>"><?=$this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->contact_email?></a></div>
                        </address>
                        <?php 
                                      if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->facebook_url!='' || $this->db->get_where('tbl_settings', array('id' => '1'))->row()->twitter_url!='' || $this->db->get_where('tbl_settings', array('id' => '1'))->row()->instagram_url!='')
                                      {
                                        ?>
                                    <div class="my-4 my-md-4">
                                        <ul class="list-inline mb-0 opacity-7">
                                            <?php 
                                            if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->facebook_url!='')
                                            {
                                            ?>
                                            <li class="list-inline-item mr-0">
                                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="<?=$this->db->get_where('tbl_settings', array('id' => '1'))->row()->facebook_url?>">
                                                    <span class="fab fa-facebook-f btn-icon__inner"></span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                            <?php 
                                            if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->instagram_url!='')
                                            {
                                            ?>
                                            <li class="list-inline-item mr-0">
                                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="<?=$this->db->get_where('tbl_settings', array('id' => '1'))->row()->instagram_url?>">
                                                    <span class="fab fa-instagram btn-icon__inner"></span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                            <?php 
                                            if($this->db->get_where('tbl_settings', array('id' => '1'))->row()->twitter_url!='')
                                            {
                                            ?>
                                            <li class="list-inline-item mr-0">
                                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="<?=$this->db->get_where('tbl_settings', array('id' => '1'))->row()->twitter_url?>">
                                                    <span class="fab fa-twitter btn-icon__inner"></span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                            <!-- <li class="list-inline-item mr-0">
                                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                                    <span class="fab fa-youtube btn-icon__inner"></span>
                                                </a>
                                            </li> -->
                                        </ul>
                                    </div>
                                <?php } ?>
                    </div>
                </div>
                
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->
        <?php include('include/footer.php'); ?>
       