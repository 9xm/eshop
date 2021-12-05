<?php 

define('APP_CURRENCY', $this->db->get_where('tbl_settings', array('id' => '1'))->row()->app_currency_code);
define('CURRENCY_CODE', $this->db->get_where('tbl_settings', array('id' => '1'))->row()->app_currency_html_code);

?>

<style type="text/css">
	.label-success-cust{
		background: green !important;
	}
</style>

<div class="row card_item_block" style="padding-left:30px;padding-right: 30px">
	<div class="col-lg-12">
		<div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-bordered">
                  <tbody>
                      <tr>
                          <td>Name</td>
                          <td><?php echo $user[0]->user_name; ?></td>
                      </tr>
                      <tr>
                          <td>Email Id</td>
                          <td><?php echo $user[0]->user_email; ?></td>
                      </tr>
                      <tr>
                          <td>Mobile No </td>
                          <td><?php echo $user[0]->user_phone; ?></td>
                      </tr>
                      <tr>
                          <td>GST No </td>
                          <td><?php echo $user[0]->gstno; ?></td>
                      </tr>
                      <tr>
                          <td>GST Certificate </td>
                          <td>
                            <?php 
                            if($user[0]->gstdoc != '')
                            {
                            ?>
                            <div class="fileupload_img">
                                <a href="<?php echo base_url('upload/vendor/'.$user[0]->gstdoc); ?>" target="_blank">View</a>
                            </div>
                            <?php 
                            }
                            ?>
                          </td>
                      </tr>
                      <tr>
                          <td>Bank Account No </td>
                          <td><?php echo $user[0]->bankacno; ?></td>
                      </tr>
                      <tr>
                          <td>IFSC Code </td>
                          <td><?php echo $user[0]->ifsc; ?></td>
                      </tr>
                      <tr>
                          <td>Branch Name </td>
                          <td><?php echo $user[0]->branchname; ?></td>
                      </tr>
                      <tr>
                          <td>Bank Passbook </td>
                          <td>
                            <?php 
                            if($user[0]->bankdoc != '')
                            {
                            ?>
                            <div class="fileupload_img">
                                <a href="<?php echo base_url('upload/vendor/'.$user[0]->bankdoc); ?>" target="_blank">View</a>
                            </div>
                            <?php 
                            }
                            ?>
                          </td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
         </div>
	</div>
</div>