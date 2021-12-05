<?php
  define('APP_CURRENCY', $this->db->get_where('tbl_settings', array('id' => '1'))->row()->app_currency_code);
  define('CURRENCY_CODE', $this->db->get_where('tbl_settings', array('id' => '1'))->row()->app_currency_html_code);

  $ci =& get_instance();
?>

<div class="row card_item_block" style="padding-left: 30px;padding-right: 30px">

  <div class="col-lg-12">
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
       <h4 id="oh-snap!-you-got-an-error!"><?=$this->lang->line("note_lbl")?>:<a class="anchorjs-link" href="#oh-snap!-you-got-an-error!"><span class="anchorjs-icon"></span></a></h4>
      <p><?=$this->lang->line('we_recommended_img_lbl')?></p>  
    </div>
  </div>

	

	

	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> 
		<a href="<?=site_url('vendor/product')?>" title="<?=$product_cnt?>" class="card card-banner card-pink-light">
			<div class="card-body"> <i class="icon fa fa-product-hunt fa-4x"></i>
				<div class="content">
					<div class="title"><?=$this->lang->line('products_lbl')?></div>
					<div class="value"><span class="sign"></span><?php echo $product_cnt;?></div>
				</div>
			</div>
		</a> 
	</div>
</div>

 <script type="text/javascript">
 	$(".refresh_btn").click(function(e){
 		e.preventDefault();
 		location.reload();
 	});
 </script>