<style type="text/css">
  .dropdown-li{
    margin-bottom: 0px !important;
  }
  .cust-dropdown-container{
    background: #E7EDEE;
    display: none;
  }
  .cust-dropdown{
    list-style: none;
    background: #eee;
	padding-left:27px;
  }
  .cust-dropdown li a{
    padding: 8px 0px;
    width: 100%;
    display: block;
    color: #444;
    float: left;
    text-decoration: none;
    transition: all linear 0.2s;
    font-weight: 500;
  }
  .cust-dropdown li a:hover, .cust-dropdown li a.active{
    color: #e91e63;
  }
</style>

<aside class="app-sidebar" id="sidebar">
  <div class="sidebar-header"> <a class="sidebar-brand" href="<?=site_url('vendor/pages/dashboard')?>"><img src="<?=base_url('assets/images/'.APP_LOGO);?>" alt="app logo" /></a>
    <button type="button" class="sidebar-toggle"> <i class="fa fa-times"></i> </button>
  </div>
  <div class="sidebar-menu">
    <ul class="sidebar-nav">
      <li class="<?php if($page_title==$this->lang->line('dashboard_lbl')){ echo 'active';} ?>">
        <a href="<?=site_url('vendor/pages/dashboard')?>">
        <div class="icon"> <i class="fa fa-dashboard" aria-hidden="true"></i> </div>
        <div class="title"><?=$this->lang->line('dashboard_lbl')?></div>
        </a> 
      </li>

      <li class="<?php if($page_title==$this->lang->line('products_lbl') OR $page_title==$this->lang->line('add_product_lbl') OR $page_title==$this->lang->line('edit_product_lbl')){ echo 'active';} ?>">
        <a href="<?=site_url('vendor/product/index')?>">
          <div class="icon"> <i class="fa fa-map-o" aria-hidden="true"></i> </div>
          <div class="title"><?=$this->lang->line('products_lbl')?></div>
          </a>
      </li>
      
      <li class="<?php if($page_title==$this->lang->line('ord_list_lbl')){ echo 'active';} ?>">
        <a href="<?=site_url('vendor/orders')?>">
        <div class="icon"> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> </div>
        <div class="title"><?=$this->lang->line('ord_list_lbl')?></div>
        </a> 
      </li>
      
      <li class="<?php if($page_title=='Vendor Commission'){ echo 'active';} ?>">
        <a href="<?=site_url('vendor/pages/vendor_commission')?>">
        <div class="icon"> <i class="fa fa-users" aria-hidden="true"></i> </div>
        <div class="title">Commission</div>
        </a> 
      </li>
    </ul>
  </div>
   
</aside>