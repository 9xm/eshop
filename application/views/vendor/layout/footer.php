    <footer class="app-footer" style="position:relative;">
      <div class="row">
        <div class="col-xs-12">
          <div class="footer-copyright"><?=$this->db->get_where('tbl_web_settings', array('id' => '1'))->row()->copyright_text?></div>
        </div>
      </div>
    </footer>
  </div>
</div>


<script type="text/javascript" src="<?=base_url('assets/js/app.js')?>"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php
if($this->session->flashdata('response_msg')) {
  $message = $this->session->flashdata('response_msg');
  ?>
  <script type="text/javascript">

    var _msg='<?=$message['message']?>';
    var _class='<?=$message['class']?>';

    _msg=_msg.replace(/(<([^>]+)>)/ig,"");

    $('.notifyjs-corner').empty();
    $.notify(
      _msg, 
      { position:"top center",className: _class}
      );
      <?php unset($_SESSION['response_msg']);?>
    </script>
    <?php
  }
  ?>

  <script type="text/javascript">

    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode != 43 && charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
      }
      return true;
    }

    $(".loader").show();
    $(document).ready(function(){

      $(".loader").fadeOut("slow");

      new_arrival_orders();

      setInterval(function(){
        new_arrival_orders();
      },60000);


    });
    
    function new_arrival_orders() {
      var _href='<?=base_url()?>vendor/order/order_notify';

      $.ajax({
        type:'POST',
        url:_href,
        success:function(res){
          var obj = $.parseJSON(atob(res));
          $(".notify_count").text(obj.count);

          $("li.ordering_heading").nextAll("li").remove();

          if(obj.count==0){
            $(".ordering_heading").after('<li class="dropdown-empty">No New Ordered</li>');
            $(".dropdown-empty").after('<li class="dropdown-footer"><a href="<?=site_url('vendor/orders')?>"><?=$this->lang->line('view_all_lbl')?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>');             
          }
          else{

            $(".ordering_heading").after(obj.content);
            $(".ordering_ul").append('<li class="dropdown-footer"><a href="<?=site_url('vendor/orders')?>"><?=$this->lang->line('view_all_lbl')?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>');
          }
        }
      });
    }


    if($(".dropdown-li").hasClass("active")){
      var _act_page='<?php echo $current_page; ?>';
      $("."+_act_page).next(".cust-dropdown-container").show();
      $("."+_act_page).find(".title").next("i").removeClass("fa-angle-right");
      $("."+_act_page).find(".title").next("i").addClass("fa-angle-down");
    }

    $(document).ready(function(e){

      $(".datepicker").datepicker({ dateFormat: 'dd-mm-yy' });

      $(".filter_datepicker").datepicker({ 
        maxDate: '0',
        dateFormat: 'dd-mm-yy',
        onSelect : function (dateText, inst) {
          $("#filterForm *").filter(":input").each(function(){
            if ($(this).val() == '')
              $(this).prop("disabled", true);
          });
          $("#filterForm").submit();
        }
      });

      var _flag=false;

      $(".dropdown-a").click(function(e){

        $(this).parents("ul").find(".cust-dropdown-container").slideUp();

        $(this).parents("ul").find(".title").next("i").addClass("fa-angle-right");
        $(this).parents("ul").find(".title").next("i").removeClass("fa-angle-down");

        if($(this).parent("li").next(".cust-dropdown-container").css('display') !='none'){
          $(this).parent("li").next(".cust-dropdown-container").slideUp();
          $(this).find(".title").next("i").addClass("fa-angle-right");
          $(this).find(".title").next("i").removeClass("fa-angle-down");
        }else{
          $(this).parent("li").next(".cust-dropdown-container").slideDown();
          $(this).find(".title").next("i").removeClass("fa-angle-right");
          $(this).find(".title").next("i").addClass("fa-angle-down");
        }

      });
    });

  </script>

  <script type="text/javascript">

    $(".btn_top_action").on("click",function(e){
      e.preventDefault();

      var href = $(this).attr("href");

      swal({
        title: "<?=$this->lang->line('are_you_sure_msg')?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger btn_edit",
        cancelButtonClass: "btn-warning btn_edit",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
      },
      function(isConfirm) {
        if(isConfirm) {
          window.location.href=href;
          swal.close();
        }
        else{
          swal.close();
        }
      })
    });

  </script>



</body>
</html>