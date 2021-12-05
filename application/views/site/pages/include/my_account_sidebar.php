                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">My Account</h3>
                        </div>
                        <div class="mr-xl-6">
                            <ul class="list-unstyled mb-6">
                                <li class="mb-1"> <i class="fas fa-chevron-right"></i>  <a style="<?php if(isset($current_page) && strcmp($current_page,$this->lang->line('my_profile_lbl'))==0){ echo 'color: black;';} ?>font-size: 18px;" class="active" href="<?= base_url(); ?>my-account">My Profile</a></li>
                                <li class="mb-1"> <i class="fas fa-chevron-right"></i>  <a style="font-size: 18px;" href="<?= base_url(); ?>my-orders">My Orders</a></li>
                                <li class="mb-1"> <i class="fas fa-chevron-right"></i>  <a style="<?php if(isset($current_page) && strcmp($current_page,$this->lang->line('addresses_lbl'))==0){ echo 'color: black;';} ?>font-size: 18px;" href="<?= base_url(); ?>my-addresses">Addresses</a></li>
                                <?php 
                                    if(strcmp($this->session->userdata('user_type'), 'Normal')==0)
                                    {
                                ?>
                                <li class="mb-1">
                                     <i class="fas fa-chevron-right"></i>  
                                    <a style="<?php if(isset($current_page) && strcmp($current_page,$this->lang->line('change_password_lbl'))==0){ echo 'color: black;';} ?>font-size: 18px;" href="<?=base_url('/change-password')?>"><?=$this->lang->line('change_password_lbl')?>
                                    </a>
                                </li>
                                <?php } ?>
                                
                                
                                <li class="mb-1"> <i class="fas fa-chevron-right"></i>  <a style="<?php if(isset($current_page) && strcmp($current_page,$this->lang->line('mywishlist_lbl'))==0){ echo 'color: black;';} ?>font-size: 18px;" href="<?php echo site_url('wishlist'); ?>"><?=$this->lang->line('mywishlist_lbl')?></a></li>
                                <li class="mb-1"> <i class="fas fa-chevron-right"></i>  <a style="<?php if(isset($current_page) && strcmp($current_page,$this->lang->line('saved_bank_lbl'))==0){ echo 'color: black;';} ?>font-size: 18px;" href="<?= base_url(); ?>saved-bank-accounts">Saved Bank Account</a></li>
                                <li class="mb-1"> <i class="fas fa-chevron-right"></i>  <a style="<?php if(isset($current_page) && strcmp($current_page,$this->lang->line('myreviewrating_lbl'))==0){ echo 'color: black;';} ?>font-size: 18px;" href="<?= base_url(); ?>my-reviews">My Reviews &amp; Rating</a></li>
                                <li class="mb-1"> <i class="fas fa-chevron-right"></i>  <a style="  font-size: 18px;" href="<?= base_url(); ?>site/logout">Logout</a></li>
                            </ul>
                        </div>