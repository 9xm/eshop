<?php 

	define('APP_FAVICON', $this->db->get_where('tbl_settings', array('id' => '1'))->row()->web_favicon);
	define('APP_LOGO', $this->db->get_where('tbl_settings', array('id' => '1'))->row()->app_logo);

	define('APP_CURRENCY', $this->db->get_where('tbl_settings', array('id' => '1'))->row()->app_currency_code);
	define('CURRENCY_CODE', $this->db->get_where('tbl_settings', array('id' => '1'))->row()->app_currency_html_code);

	$address_arr=$this->common_model->get_addresses($order_data[0]->user_id,true);

	$ci =& get_instance();

?>

<!DOCTYPE html>
<html>
<head>
	<title><?=$this->lang->line('ord_invoice_lbl')?> - <?=$order_data[0]->order_unique_id?></title>
	<link rel="shortcut icon" type="image/png" href="<?=base_url('assets/images/').APP_FAVICON?>"/>
	
	<style type="text/css">
		

		.invoice-warpper{ border: 1px solid #ddd; padding: 20px;}
		.order-info{border: 2px solid #f1f1f1;}
		table{ width:100%;}
		table tr{ }
		table tr td{ /*border:1px solid red; */ padding: 10px 5px;vertical-align: top;}
	</style>

</head>
<body>
	<div class="container invoice-warpper">
		<table>
	    <tr>
	     
				  <td>            
					<div>
					  <strong><?=$this->lang->line('billing_shipping_section_lbl')?>:</strong>
					</div>
					<div>
					  	<?php echo $order_data[0]->name?><br>
					  	<?php 
                            echo $order_data[0]->building_name.', '.$order_data[0]->road_area_colony.',<br/>'.$order_data[0]->city.',<br/>'.$order_data[0]->state.' - '.$order_data[0]->country.'<br/>'.$order_data[0]->pincode;
                        ?>
                        <br/>
                        <strong><?=$this->lang->line('phone_no_lbl')?>.</strong> <?php echo $order_data[0]->mobile_no;?><br>
                        <strong><?=$this->lang->line('email_lbl')?>.</strong> <?php echo $order_data[0]->email;?>
					</div>				
</td>
				  <td width="40%">
					  <table>
						  <tr>
							  <td>
					<div class="invoice-title">
					  <img src="<?=base_url('assets/images/'.APP_LOGO);?>" style="width: 180px;" alt="" />
					</div>
</td>
</tr>
<tr>
<td>					

						<table class="table order-info">
							<tbody>
							<tr>
								<td><strong><?=$this->lang->line('ord_id_lbl')?> #</strong></td>
								<td style="text-align:right"><?=$order_data[0]->order_unique_id?></td>
							</tr>
							<tr>
								<td><strong><?=$this->lang->line('ord_on_lbl')?>:</strong></td>
								<td style="text-align:right"><?php echo date('F d, Y',$order_data[0]->order_date);?></td>
							</tr>
							<tr style="background:#d7dcdc">
								<td><strong><?=$this->lang->line('total_amt_lbl')?></strong></td>
								<td style="text-align:right"><strong><?php echo CURRENCY_CODE.' '.$order_data[0]->payable_amt;?></strong></td>
							</tr>
							</tbody>
						</table>
</td>
</tr>
</table>
</td>	
			</tr>
			<tr>	  
	         
	            <td colspan="2">
	              <table >
	                <thead>
	                    <tr class="top_bdr" style="background:#d7dcdc">
						  <td class="rank_item text-left bdr_left bdr_right"><strong style="font-weight: 600"><?=$this->lang->line('product_lbl')?></strong></td>	
	                      <td class="text-right bdr_right"><strong style="font-weight: 600"><?=$this->lang->line('price_lbl')?></strong></td>	
	                      <td class="text-right bdr_right"><strong style="font-weight: 600"><?=$this->lang->line('saving_lbl')?></strong></td>	
	                      <td class="text-right bdr_right"><strong style="font-weight: 600"><?=$this->lang->line('qty_lbl')?></strong></td>
						  <td class="text-right bdr_right"><strong style="font-weight: 600"><?=$this->lang->line('total_price_lbl')?></strong></td>					  
	                    </tr>
	                </thead>
	                <tbody>
					<?php

						$items_arr=$this->common_model->selectByids(array('order_id' => $order_data[0]->id), 'tbl_order_items');

                        foreach ($items_arr as $key => $val) 
                        {
					?>  
	                  <tr>
						<td class="rank_item text-left thick-line bdr_left" style="min-width: 450px !important"><?=$val->product_title?></td>
	                    
	                    <td class="text-right thick-line"><?=CURRENCY_CODE.' '.$val->product_price?></td>
	                    <td class="text-right thick-line"><?php echo CURRENCY_CODE.' '.($this->common_model->selectByidParam($val->product_id, 'tbl_product','product_mrp')-$val->product_price)?></td>
	                    <td class="text-right thick-line"><?=$val->product_qty?></td>
						<td class="text-right thick-line"><?=CURRENCY_CODE.' '.$val->total_price?></td>					
	                  </tr>
	              	<?php } ?>
	                  <tr>
					    <td class="thick-line bdr_left"></td>
					    <td class="thick-line bdr_left"></td>
	                    <td class="text-right thick-line"></td>
						<td class="text-right thick-line"></td>
	                    <td class="text-right thick-line"></td>
	                  </tr>				  				  			                    				  
	                </tbody>
	              </table>
						</td>
						</tr>
						<tr>
				<td >&nbsp;</td>
					<td>
					<table class="table">
					  <tbody>
						<tr>
						  <td><strong style="font-weight: 600"><?=$this->lang->line('total_lbl')?></strong></td>
						  <td style="text-align:right"><?=CURRENCY_CODE.' '.number_format($order_data[0]->total_amt, 2)?></td>
						</tr>
						<?php 
                        	if(!empty($refund_data))
                        	{
                            	$cancel_ord_amt=array_sum(array_column($refund_data,'refund_pay_amt'));
                        ?>
						<tr>
						  <td><strong style="font-weight: 600"><?=$this->lang->line('cancel_ord_amt_lbl')?></strong></td>
						  <td style="text-align:right">- <?=CURRENCY_CODE.' '.number_format($cancel_ord_amt, 2)?></td>
						</tr>                        
                    	<?php } ?>

						<tr>
						  <td><strong style="font-weight: 600"><?=$this->lang->line('discount_lbl')?></strong></td>
						  <td style="text-align:right">- <?=CURRENCY_CODE.' '.($order_data[0]->discount_amt)?></td>
						</tr>
						<tr>
						  <td><strong style="font-weight: 600"><?=$this->lang->line('delivery_charge_lbl')?></strong></td>
						  <td style="text-align:right"><?=($order_data[0]->delivery_charge) ? '+ '.CURRENCY_CODE.' '.number_format($order_data[0]->delivery_charge, 2) : $this->lang->line('free_lbl')?></td>
						</tr>
						<tr>
						  <td><strong style="font-weight: 600"><?=$this->lang->line('payable_amt_lbl')?></strong></td>
						  <td style="text-align:right"><?=CURRENCY_CODE.' '.number_format($order_data[0]->new_payable_amt)?></td>
						</tr>
					  </tbody>
					</table>
		
							</td>
	      

							</tr>
							</table>

	</div>

	

</body>
</html>





