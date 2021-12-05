<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller
{

    private $app_name;

    private $redirectUrl=NULL;

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('Setting_model');
        $this->load->model('common_model');
        $this->load->model('Api_model', 'api_model');

        $app_setting = $this->api_model->app_details();

        $this->app_name = $app_setting->app_name;

        $this->load->helper("date");

        $currentURL = current_url();
        $params   = $_SERVER['QUERY_STRING'];
        $this->redirectUrl = (!empty($params)) ? $currentURL . '?' . $params : $currentURL;
    }

    public function get_status_title($id)
    {
        return $this->common_model->selectByidParam($id, 'tbl_status_title', 'title');
    }

    public function dashboard()
    {
        $data = array();
        $data['page_title'] = $this->lang->line('dashboard_lbl');
        $data['current_page'] = $this->lang->line('dashboard_lbl');

        $data['cat_cnt'] = count($this->common_model->select('tbl_category'));
        $data['sub_cat_cnt'] = count($this->common_model->select('tbl_sub_category'));

        $user_id=$this->session->userdata('id');

        $data['product_cnt'] = count($this->common_model->selectWhere('tbl_product', ' seller_id='.$user_id));

        //$data['user_cnt'] = count($this->common_model->select('tbl_users'));

        $this->db->select('order.id');
        $this->db->from('tbl_order_items order');
        $this->db->join('tbl_order_details','order.order_id= tbl_order_details.id','LEFT');  
        $this->db->where(array('order.vid'=>$user_id));
        $query = $this->db->get();
        $data['order_cnt'] = count($query->result()); //count($this->common_model->selectByids(array('order_status <> ' => '-1'), 'tbl_order_details'));

        $data['transaction_cnt'] = count($this->common_model->selectByids(array('status' => '1'), 'tbl_transaction'));
        $data['pending_refund_cnt'] = count($this->common_model->selectByids(array('gateway <>' => 'cod'), 'tbl_refund'));

        $data['top_selling_products'] = $this->api_model->top_selling_products();

        $data['todays_orders'] = $this->api_model->todays_orders();

        $countStr = $countStrOrd = '';

        $no_data_status = false;
        $count = $countOrd = $monthCount = 0;

        for ($mon = 1; $mon <= 12; $mon++) {
            
            $monthCount++;

            if ($this->input->get('order_filter') != '') {

                $year = $this->input->get('order_filter');
                $month = date('M', mktime(0, 0, 0, $mon, 1, date('Y')));

                $total_orders = count($this->common_model->selectByids(array("order_status <>" => "-1", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%Y') =" => $year), 'tbl_order_details'));

                $pending_order = count($this->common_model->selectByids(array("order_status >=" => "1", "order_status <" => "4", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%Y') =" => $year), "tbl_order_details"));

                $deliver_order = count($this->common_model->selectByids(array("order_status" => "4", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%Y') =" => $year), "tbl_order_details"));

                $cancel_order = count($this->common_model->selectByids(array("order_status" => "5", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%Y') =" => $year), "tbl_order_details"));
            } else {

                $month = date('M', mktime(0, 0, 0, $mon, 1, date('Y')));

                $total_orders = count($this->common_model->selectByids(array("order_status <>" => "-1", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon), 'tbl_order_details'));

                $pending_order = count($this->common_model->selectByids(array("order_status >=" => "1", "order_status <" => "4", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon), "tbl_order_details"));

                $deliver_order = count($this->common_model->selectByids(array("order_status" => "4", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon), "tbl_order_details"));

                $cancel_order = count($this->common_model->selectByids(array("order_status" => "5", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon), "tbl_order_details"));
            }


            if ($this->input->get('transaction_filter') != '') {

                $year = $this->input->get('transaction_filter');
                $month = date('M', mktime(0, 0, 0, $mon, 1, $year));

                $rowTransactions = $this->common_model->selectByids(array('status' => '1', "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`date`), '%Y') =" => $year), 'tbl_transaction');

                $total_payment = 0;

                foreach ($rowTransactions as $key => $value) {

                    $total_payment += $value->payment_amt;
                }

                $data['total_payment'] = $total_payment;

                $rowCod = $this->common_model->selectByids(array("status" => "1", "gateway" => "cod", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`date`), '%Y') =" => $year), "tbl_transaction");

                $cod_payment = 0;

                foreach ($rowCod as $key => $value) {

                    $cod_payment += $value->payment_amt;
                }

                $rowPayPal = $this->common_model->selectByids(array("status" => "1", "gateway" => "paypal", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`date`), '%Y') =" => $year), "tbl_transaction");

                $paypal_payment = 0;

                foreach ($rowPayPal as $key => $value) {

                    $paypal_payment += $value->payment_amt;
                }

                $rowStripe = $this->common_model->selectByids(array("status" => "1", "gateway" => "stripe", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`date`), '%Y') =" => $year), "tbl_transaction");

                $stripe_payment = 0;

                foreach ($rowStripe as $key => $value) {

                    $stripe_payment += $value->payment_amt;
                }

                $rowRazorpay = $this->common_model->selectByids(array("status" => "1", "gateway" => "razorpay", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`date`), '%Y') =" => $year), "tbl_transaction");

                $razorpay_payment = 0;

                foreach ($rowRazorpay as $key => $value) {

                    $razorpay_payment += $value->payment_amt;
                }
            } else {

                $month = date('M', mktime(0, 0, 0, $mon, 1, date('Y')));

                $rowTransactions = $this->common_model->selectByids(array('status' => '1', "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon), 'tbl_transaction');

                $total_payment = 0;
                
                /*if(!empty($rowTransactions))
                {
                    foreach ($rowTransactions as $key => $value) {

                        $total_payment += $value->payment_amt;
                    }
                }*/
                $data['total_payment'] = $total_payment;

                $rowCod = $this->common_model->selectByids(array("status" => "1", "gateway" => "cod", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon), "tbl_transaction");

                $cod_payment = 0;
                /*if(!empty($rowCod))
                {
                    foreach ($rowCod as $key => $value) {

                        $cod_payment += $value->payment_amt;
                    }
                }*/

                $rowPayPal = $this->common_model->selectByids(array("status" => "1", "gateway" => "paypal", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon), "tbl_transaction");

                $paypal_payment = 0;
                /*if(!empty($rowPayPal))
                {
                    foreach ($rowPayPal as $key => $value) {

                        $paypal_payment += $value->payment_amt;
                    }
                } */   
                $rowStripe = $this->common_model->selectByids(array("status" => "1", "gateway" => "stripe", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon), "tbl_transaction");

                $stripe_payment = 0;
                /*if(!empty($rowStripe))
                {
                    foreach ($rowStripe as $key => $value) {

                        $stripe_payment += $value->payment_amt;
                    }
                }*/

                $rowRazorpay = $this->common_model->selectByids(array("status" => "1", "gateway" => "razorpay", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon), "tbl_transaction");

                $razorpay_payment = 0;
                /*if(!empty($rowRazorpay))
                {
                    foreach ($rowRazorpay as $key => $value) {

                        $razorpay_payment += $value->payment_amt;
                    }
                }*/
            }

            $countStr .= "['" . $month . "', " . $total_payment . ", " . $cod_payment . ", " . $paypal_payment . ", " . $stripe_payment . ", " . $razorpay_payment . "], ";

            $countStrOrd .= "['" . $month . "', " . $total_orders . ", " . $pending_order . ", " . $deliver_order . ", " . $cancel_order . "], ";

            if ($total_payment != 0) {
                $count++;
            }

            if ($total_orders != 0) {
                $countOrd++;
            }
        }

        $countStr = rtrim($countStr, ", ");
        $countStrOrd = rtrim($countStrOrd, ", ");

        $data['countStr'] = $countStr;
        $data['countStrOrd'] = $countStrOrd;

        if ($count != 0) {
            $data['no_data_status'] = false;
        } else {
            $data['no_data_status'] = true;
        }

        if ($countOrd != 0) {
            $data['order_no_data_status'] = false;
        } else {
            $data['order_no_data_status'] = true;
        }

        $this->template->load('admin/template', 'admin/page/dashboard', $data); // :blush:

    }

    public function top_sale_products()
    {

        $data = array();
        $data['page_title'] = 'Top Selling Products';
        $data['current_page'] = 'Top Selling Products';

        $row = $this->api_model->top_selling_products($flag = true);

        $config = array();
        $config["base_url"] = base_url() . 'admin/top-sale-products';
        $config["total_rows"] = count($row);
        $config["per_page"] = 12;

        $config['num_links'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;

        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = FALSE;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '';
        $config['next_tag_open'] = '<span class="nextlink">';
        $config['next_tag_close'] = '</span>';

        $config['prev_link'] = '';
        $config['prev_tag_open'] = '<span class="prevlink">';
        $config['prev_tag_close'] = '</span>';

        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $config['num_tag_open'] = '<li style="margin:3px">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;

        $page = ($page - 1) * $config["per_page"];

        if ($this->input->post('search_value') != '') {

            $keyword = addslashes(trim($this->input->post('search_value')));
            $row = $this->api_model->top_selling_products($flag = true, '', '', $keyword);
        } else {
            $data["links"] = $this->pagination->create_links();
            $row = $this->api_model->top_selling_products($flag = true, $config["per_page"], $page);
        }


        $data['products'] = $row;


        $this->template->load('admin/template', 'admin/page/top_sale_products', $data); // :blush:

    }


    public function check_smtp()
    {
        $response = array();
        $email = trim($this->input->post('email'));
        $subject = $this->app_name . ' - ' . $this->lang->line('smtp_check_email_lbl');
        $body = $this->load->view('admin/emails/check_smtp_email.php', '', TRUE);
        if (send_email($email, ucfirst($this->session->userdata('username')), $subject, $body)) {
            $response = array('success' => '1', 'msg' => $this->lang->line('mail_send_success_msg'));
        } else {
            $response = array('success' => '0', 'msg' => $this->lang->line('mail_send_err_msg'));
        }
        echo json_encode($response);
        exit();
    }

    public function settings()
    {
        $data = array();
        $data['page_title'] = $this->lang->line('general_settings_lbl');
        $data['current_page'] = 'settings';     // don't change this
        $data['settings_row'] = $this->Setting_model->get_details();
        $data['smtp'] = $this->Setting_model->get_smtp_settings();
        $data['faq_row'] = $this->common_model->selectByids(array('type' => 'faq'), 'tbl_faq', 'id', 'DESC');
        $data['payment_faq_row'] = $this->common_model->selectByids(array('type' => 'payment'), 'tbl_faq', 'id', 'DESC');

        $data['category_list'] = $this->api_model->category_list();
        $data['home_category'] = $this->common_model->selectByids(array('set_on_home' => 1), 'tbl_category');

        $data["redirectUrl"] = $this->redirectUrl;

        $this->template->load('admin/template', 'admin/page/settings', $data); // :blush:

    }

    public function get_select2_data()
    {

        $pageEnd = 10;

        $pageStart = ($_GET['page']  - 1) * $pageEnd;

        $type = $_GET['type'];

        $items = array();

        if(!isset($_GET['page']) || $_GET['page'] == 1)
            $items[] = array("id" => '', "text" => '---' . $this->lang->line('select_opt_lbl') . '---');

        if ($type == 'category') {

            $this->load->model('Category_model');

            if (isset($_GET['search'])) {

                $keyword = trim($_GET['search']);

                $total_items = count($this->Category_model->category_list('id', 'DESC', '', '', $keyword));

                $data = $this->Category_model->category_list('id', 'DESC', $pageEnd, $pageStart, $keyword);
            } else {

                $total_items = count($this->Category_model->category_list('id', 'DESC'));

                $data = $this->Category_model->category_list('id', 'DESC', $pageEnd, $pageStart);
            }

            if (count($data) > 0) {
                foreach ($data as $key => $value) {
                    $items[] = array("id" => $value->id, "text" => $value->category_name);
                }
            } else {
                if (count($items) > 0)
                    $items[] = array("id" => "0", "text" => $this->lang->line('no_result_found_msg'));
            }
        }
        else if ($type == 'brand') {

            $this->load->model('Brand_model');

            if (isset($_GET['search'])) {

                $keyword = trim($_GET['search']);

                $total_items = count($this->Brand_model->get_list('id', 'DESC', '', '', $keyword));

                $data = $this->Brand_model->get_list('id', 'DESC', $pageEnd, $pageStart, $keyword);
            } 
            else 
            {
                $total_items = count($this->Brand_model->get_list('id', 'DESC'));
                $data = $this->Brand_model->get_list('id', 'DESC', $pageEnd, $pageStart);
            }

            if (count($data) > 0) {
                foreach ($data as $key => $value) {
                    $items[] = array("id" => $value->id, "text" => $value->brand_name);
                }
            } else {
                if (count($items) > 0)
                    $items[] = array("id" => "0", "text" => $this->lang->line('no_result_found_msg'));
            }
        }
        else if ($type == 'offer') {

            $this->load->model('Offers_model');

            if (isset($_GET['search'])) {

                $keyword = trim($_GET['search']);

                $total_items = count($this->Offers_model->offers_list('id', 'DESC', '', '', $keyword));

                $data = $this->Offers_model->offers_list('id', 'DESC', $pageEnd, $pageStart, $keyword);
            } 
            else 
            {
                $total_items = count($this->Offers_model->offers_list('id', 'DESC'));
                $data = $this->Offers_model->offers_list('id', 'DESC', $pageEnd, $pageStart);
            }

            if (count($data) > 0) {
                foreach ($data as $key => $value) {
                    $items[] = array("id" => $value->id, "text" => $value->offer_title);
                }
            } else {
                if (count($items) > 0)
                    $items[] = array("id" => "0", "text" => $this->lang->line('no_result_found_msg'));
            }
        }
        else if ($type == 'banner') {

            $this->load->model('Banner_model');

            if (isset($_GET['search'])) {

                $keyword = trim($_GET['search']);

                $total_items = count($this->Banner_model->banner_list('id', 'DESC', '', '', $keyword));

                $data = $this->Banner_model->banner_list('id', 'DESC', $pageEnd, $pageStart, $keyword);
            } 
            else 
            {
                $total_items = count($this->Banner_model->banner_list('id', 'DESC'));
                $data = $this->Banner_model->banner_list('id', 'DESC', $pageEnd, $pageStart);
            }

            if (count($data) > 0) {
                foreach ($data as $key => $value) {
                    $items[] = array("id" => $value->id, "text" => $value->banner_title);
                }
            } else {
                if (count($items) > 0)
                    $items[] = array("id" => "0", "text" => $this->lang->line('no_result_found_msg'));
            }
        }
        else if ($type == 'product') {

            $this->load->model('Product_model');

            if (isset($_GET['search'])) {

                $keyword = trim($_GET['search']);

                $total_items = count($this->Product_model->product_list('id', 'DESC', '', '', $keyword));

                $data = $this->Product_model->product_list('id', 'DESC', $pageEnd, $pageStart, $keyword);
            } 
            else 
            {
                $total_items = count($this->Product_model->product_list('id', 'DESC'));
                $data = $this->Product_model->product_list('id', 'DESC', $pageEnd, $pageStart);
            }

            if (count($data) > 0) {
                foreach ($data as $key => $value) {
                    $items[] = array("id" => $value->id, "text" => $value->product_title);
                }
            } else {
                if (count($items) > 0)
                    $items[] = array("id" => "0", "text" => $this->lang->line('no_result_found_msg'));
            }
        }

        $response = array('items' => $items, 'total_count' => $total_items);

        echo json_encode($response);
    }

    public function web_settings()
    {
        $data = array();
        $data['page_title'] = $this->lang->line('web_settings_lbl');
        $data['current_page'] = 'settings';     // don't change this

        $data['settings_row'] = $this->Setting_model->get_details();
        $data['web_settings_row'] = $this->Setting_model->get_web_details();
        $this->template->load('admin/template', 'admin/page/web_settings', $data); // :blush:

    }

    public function android_settings()
    {
        if($this->common_model->selectByidParam('1', 'tbl_verify', 'android_envato_purchased_status')!=1){
            show_404();
        }

        $data = array();
        $data['page_title'] = $this->lang->line('android_settings_lbl');
        $data['current_page'] = 'android';     // don't change this
        $data['settings_row'] = $this->Setting_model->get_web_details();
        $data['settings_android_row'] = $this->Setting_model->get_android_details();
        $data['faq_row'] = $this->common_model->selectByids(array('type' => 'faq'), 'tbl_faq', 'id', 'DESC');
        $data['payment_faq_row'] = $this->common_model->selectByids(array('type' => 'payment'), 'tbl_faq', 'id', 'DESC');
        $this->template->load('admin/template', 'admin/page/android_settings', $data); // :blush:

    }

    public function page_settings()
    {
        $data = array();
        $data['page_title'] = 'Page Settings';
        $data['current_page'] = 'Page Settings';
        $data['settings_row'] = $this->Setting_model->get_details();
        $this->template->load('admin/template', 'admin/page/page_settings', $data); // :blush:
    }

    public function verify_purchase_page()
    {
        $data = array();
        $data['page_title'] = $this->lang->line('verify_purchase_lbl');
        $data['current_page'] = $this->lang->line('verify_purchase_lbl');
        $data['settings_row'] = $this->Setting_model->get_verify_details();
        $this->template->load('admin/template', 'admin/page/verification', $data); // :blush:
    }

    public function api_urls()
    {
        if($this->common_model->selectByidParam('1', 'tbl_verify', 'android_envato_purchased_status')!=1){
            show_404();
        }
        $data = array();
        $data['page_title'] = 'Api Urls';
        $data['current_page'] = 'Api Urls';
        $this->template->load('admin/template', 'admin/page/api_urls', $data); // :blush:
    }

    public function payment_faq_form()
    {
        $data = array();

        $id =  $this->uri->segment(4);

        $data['page_title'] = $this->lang->line('web_settings_lbl');
        if ($id == '') {
            $data['current_page'] = $this->lang->line('add_payment_faq_lbl');
        } else {
            $data['faq_row'] = $this->common_model->selectByid($id, 'tbl_faq');

            $data['current_page'] = $this->lang->line('edit_payment_faq_lbl');
        }
        $this->template->load('admin/template', 'admin/page/payment_faq_form', $data); // :blush:
    }

    public function add_payment_faq()
    {
        $redirect=$_GET['redirect'].(isset($_GET['page']) ? '&page='.$_GET['page'] : '');

        if(!empty($this->input->post('faq_question')))
        {
            foreach ($this->input->post('faq_question') as $key => $value) {

                $question = stripslashes(trim($value));
                $answer = stripslashes(trim($this->input->post('faq_answer')[$key]));

                $data = array(
                    'faq_question' => $question,
                    'faq_answer' => $answer,
                    'type' => 'payment',
                    'created_at' => strtotime(date('d-m-Y h:i:s A', now()))
                );

                $data = $this->security->xss_clean($data);

                $this->common_model->insert($data, 'tbl_faq');
            }

            $message = array('message' => $this->lang->line('add_msg'), 'class' => 'success');
            $this->session->set_flashdata('response_msg', $message);
        }
        else{
            $message = array('message' => $this->lang->line('input_required'), 'class' => 'error');
            $this->session->set_flashdata('response_msg', $message);   
        }

        if(isset($_GET['redirect'])){
            redirect($redirect, 'refresh');
        }
        else{
            redirect(base_url() . 'admin/payment-faq/add');
        }
    }

    public function edit_payment_faq($id)
    {   
        $redirect=$_GET['redirect'].(isset($_GET['page']) ? '&page='.$_GET['page'] : '');

        foreach ($this->input->post('faq_question') as $key => $value) {

            $question = stripslashes(trim($value));
            $answer = stripslashes(trim($this->input->post('faq_answer')[$key]));

            $data = array(
                'faq_question' => $question,
                'faq_answer' => $answer
            );

            $data = $this->security->xss_clean($data);
            $this->common_model->update($data, $id, 'tbl_faq');
        }

        $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
        $this->session->set_flashdata('response_msg', $message);

        if(isset($_GET['redirect'])){
            redirect($redirect, 'refresh');
        }
        else{
            redirect(base_url() . 'admin/payment-faq/edit/' . $id);
        }
    }

    public function faq_form()
    {
        $data = array();

        $id =  $this->uri->segment(4);

        $data['page_title'] = $this->lang->line('web_settings_lbl');
        if ($id == '') {
            $data['current_page'] = $this->lang->line('add_faq_lbl');
        } else {
            $data['faq_row'] = $this->common_model->selectByid($id, 'tbl_faq');

            $data['current_page'] = $this->lang->line('edit_faq_lbl');
        }
        $this->template->load('admin/template', 'admin/page/faq_form', $data); // :blush:
    }

    public function add_faq()
    {
        $redirect=$_GET['redirect'].(isset($_GET['page']) ? '&page='.$_GET['page'] : '');

        if(!empty($this->input->post('faq_question')))
        {
            foreach ($this->input->post('faq_question') as $key => $value) {

                $question = stripslashes(trim($value));
                $answer = stripslashes(trim($this->input->post('faq_answer')[$key]));

                $data = array(
                    'faq_question' => $question,
                    'faq_answer' => $answer,
                    'created_at' => strtotime(date('d-m-Y h:i:s A', now()))
                );

                $data = $this->security->xss_clean($data);

                $this->common_model->insert($data, 'tbl_faq');
            }

            $message = array('message' => $this->lang->line('add_msg'), 'class' => 'success');
            $this->session->set_flashdata('response_msg', $message);
        }
        else{
            $message = array('message' => $this->lang->line('input_required'), 'class' => 'error');
            $this->session->set_flashdata('response_msg', $message);   
        }

        if(isset($_GET['redirect'])){
            redirect($redirect, 'refresh');
        }
        else{
            redirect(base_url() . 'admin/faq/add');
        }
        
    }

    public function edit_faq($id)
    {
        $redirect=$_GET['redirect'].(isset($_GET['page']) ? '&page='.$_GET['page'] : '');
        
        foreach ($this->input->post('faq_question') as $key => $value) {

            $question = stripslashes(trim($value));
            $answer = stripslashes(trim($this->input->post('faq_answer')[$key]));

            $data = array(
                'faq_question' => $question,
                'faq_answer' => $answer
            );

            $data = $this->security->xss_clean($data);
            $this->common_model->update($data, $id, 'tbl_faq');
        }

        $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
        $this->session->set_flashdata('response_msg', $message);

        if(isset($_GET['redirect'])){
            redirect($redirect, 'refresh');
        }
        else{
            redirect(base_url() . 'admin/faq/edit/' . $id);
        }
    }

    public function faq_active($id)
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id, 'tbl_faq');
        $response = array('message' => $this->lang->line('enable_msg'),'status' => '1','class' => 'success');
        echo json_encode($response);
        exit;
    }

    //-- deactive user
    public function faq_deactive($id)
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id, 'tbl_faq');
        $response = array('message' => $this->lang->line('disable_msg'),'status' => '1','class' => 'success');
        echo json_encode($response);
        exit;
    }

    // admin profile

    public function profile()
    {

        $this->load->model('Admin_model');

        $data = array();
        $data['page_title'] = 'Admin Profile';
        $data['current_page'] = 'Admin Profile';
        $user_id=$this->session->userdata('id');
        $data['row'] = $this->Admin_model->get_data($user_id);

        $this->template->load('admin/template', 'admin/page/profile', $data); // :blush:

    }

    // get transactions list

    public function transaction()
    {

        $data = array();
        $data['page_title'] = $this->lang->line('transactions_lbl');
        $data['current_page'] = $this->lang->line('transactions_lbl');
        $seller_id=$this->session->userdata('id');

        $this->db->select('transaction.*');
        $this->db->from('tbl_transaction transaction');
        $this->db->join('tbl_order_items order_items','order_items.order_id= transaction.order_id','LEFT');

        if ($this->input->get('payment_mode')) {

            $payment_mode = trim($this->input->get('payment_mode'));

            //$data['transactions'] = $this->common_model->selectWhere('tbl_transaction', array('status' => '1', 'gateway' => $payment_mode), 'DESC');

            $where=array('transaction.status' => '1','gateway'=>$payment_mode, 'order_items.vid'=>$seller_id);

            if($this->input->get('date_filter')){

                $date_filter=trim($this->input->get('date_filter'));
                $where=array("DATE_FORMAT(FROM_UNIXTIME(`transaction.date`), '%d-%m-%Y') =" => $date_filter, 'transaction.status' => '1','order_items.vid'=>$seller_id);

               // $data['transactions'] = $this->common_model->selectWhere('tbl_transaction',array('status' => '1', 'gateway' => $payment_mode, "DATE_FORMAT(FROM_UNIXTIME(`date`), '%d-%m-%Y') =" => $date_filter), 'DESC');
            }

        }
        else if($this->input->get('date_filter')){

            $date_filter=trim($this->input->get('date_filter'));
            $where=array("DATE_FORMAT(FROM_UNIXTIME(`transaction.date`), '%d-%m-%Y') =" => $date_filter, 'transaction.status' => '1','order_items.vid'=>$seller_id);
           // $data['transactions'] = $this->common_model->selectWhere('tbl_transaction',array("DATE_FORMAT(FROM_UNIXTIME(`date`), '%d-%m-%Y') =" => $date_filter),'DESC');
        }else {
            $where=array('transaction.status' => '1', 'order_items.vid'=>$seller_id);

           // $data['transactions'] = $this->common_model->selectWhere('tbl_transaction', array('status' => '1'), 'DESC');
        }

        if ($where!='') 
        {
           $this->db->where($where);
        }     
        $this->db->order_by('transaction.id', 'DESC');
        $query = $this->db->get();

        
        $data['transactions'] = $query->result();


        $this->template->load('admin/template', 'admin/page/transactions', $data); // :blush:

    }

    // get refund list

    public function refunds()
    {

        $data = array();
        $data['page_title'] = $this->lang->line('refunds_lbl');
        $data['current_page'] = $this->lang->line('refunds_lbl');

        $seller_id=$this->session->userdata('id');



        if ($this->input->get('refund_status')) {

            $refund_status = trim($this->input->get('refund_status'));

            switch ($refund_status) {
                case 'pending':
                    $refund_status = 0;
                    break;
                case 'process':
                    $refund_status = 2;
                    break;
                case 'completed':
                    $refund_status = 1;
                    break;
                default:
                    $refund_status = -1;
                    break;
            }
            $this->db->select('refund.*');
            $this->db->from('tbl_refund refund');
            $this->db->join('tbl_order_items order_items','order_items.order_id= refund.order_id','LEFT');
    
            $where=array('refund.gateway <>' => 'cod', 'refund.request_status' => $refund_status, 'order_items.vid'=>$seller_id);

          
           $this->db->where($where);
           $this->db->order_by('refund.id', 'DESC');
           $query = $this->db->get();

        
            $data['refunds'] = $query->result();

            //$data['refunds'] = $this->common_model->selectWhere('tbl_refund', array('gateway <>' => 'cod', 'request_status' => $refund_status), 'DESC');
        } 
        else 
        {
            $data['refunds'] = $this->api_model->get_refund_data(0, 'order_id');
        }

        //print_r($data);
        
        $this->template->load('admin/template', 'admin/page/refunds', $data); // :blush:

    }

    public function get_refund_products($order_unique_id)
    {
        return $this->api_model->get_refund_products($order_unique_id);
    }

    // change status of refund
    public function refund_status()
    {

        if (!empty($this->input->post())) {

            if ($this->input->post('for_action') == 'pending') {
                $data = array(
                    'request_status' => '0',
                    'last_updated'  =>  strtotime(date('d-m-Y h:i:s A', now()))
                );
            } else if ($this->input->post('for_action') == 'process') {
                $data = array(
                    'request_status' => '2',
                    'last_updated'  =>  strtotime(date('d-m-Y h:i:s A', now()))
                );
            } else if ($this->input->post('for_action') == 'completed') {
                $data = array(
                    'request_status' => '1',
                    'last_updated'  =>  strtotime(date('d-m-Y h:i:s A', now()))
                );
            }

            $data = $this->security->xss_clean($data);
            $this->common_model->update($data, $this->input->post('id'), 'tbl_refund', now());
        } else {
            show_404();
        }

        echo json_encode(array('status' => 1, 'msg' => 'Done'));
    }

    // for notification page
    public function notification()
    {
        if($this->common_model->selectByidParam('1', 'tbl_verify', 'android_envato_purchased_status')!=1){
            show_404();
        }

        $data = array();
        $data['page_title'] = $this->lang->line('notification_lbl');
        $data['current_page'] = 'android';

        $data['settings_row'] = $this->Setting_model->get_android_details();

        $data['category_list'] = $this->api_model->category_list();

        $data['brand_list'] = $this->api_model->brand_list();

        $data['offers_list'] = $this->api_model->offers_list();

        $data['banner_list'] = $this->api_model->banner_list();

        $data['product_list'] = $this->api_model->product_list();

        $data['todays_deal'] = $this->api_model->products_filter('today_deal', '0');

        $this->template->load('admin/template', 'admin/page/notification', $data); // :blush:

    }

    // for send notification

    public function send_notification()
    {

        $row_app = $this->Setting_model->get_android_details();

        if ($this->input->post('external_link') != "") {
            $external_link = trim($this->input->post('external_link'));
        } else {
            $external_link = false;
        }

        $type = $this->input->post('type');

        $notification_title = trim($this->input->post('notification_title'));
        $notification_msg = trim($this->input->post('notification_msg'));

        $id = $sub_id = 0;
        $title = '';

        switch ($type) {
            case 'category':
                $id = $this->input->post('cat_id');
                $title = $this->common_model->selectByidParam($id, 'tbl_category', 'category_name');
                break;

            case 'sub_category':
                $id = $this->input->post('cat_id2');
                $sub_id = $this->input->post('sub_cat_id');
                $title = $this->common_model->selectByidParam($sub_id, 'tbl_sub_category', 'sub_category_name');
                break;

            case 'todays_deal':
                $id = 0;
                break;

            case 'offer':
                $id = $this->input->post('offer_id');
                $title = $this->common_model->selectByidParam($id, 'tbl_offers', 'offer_title');
                break;

            case 'banner':
                $id = $this->input->post('banner_ad');
                $title = $this->common_model->selectByidParam($id, 'tbl_banner', 'banner_title');
                break;

            case 'product':
                $id = $this->input->post('product_id');
                $title = $this->common_model->selectByidParam($id, 'tbl_product', 'product_title');
                break;

            default:
                $id = 0;
                break;
        }

        $id = strval($id);
        $sub_id = strval($sub_id);

        if ($_FILES['big_picture']['error'] != 4) {

            $config['upload_path'] =  'assets/images/';
            $config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

            $image = date('dmYhis') . '_' . rand(0, 99999) . "_notification." . pathinfo($_FILES['big_picture']['name'], PATHINFO_EXTENSION);

            $config['file_name'] = $image;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('big_picture')) {
                $messge = array('message' => $this->upload->display_errors(), 'class' => 'error');
                $this->session->set_flashdata('response_msg', $messge);
                redirect(base_url() . 'admin/notification', 'refresh');
            }

            $file_name = base_url('assets/images/' . $image);

            $fields = array(
                'app_id' => $row_app->onesignal_app_id,
                'included_segments' => array('All'),
                'data' => array("foo" => "bar", "type" => $type, "id" => $id, "sub_id" => $sub_id, "title" => $title, "external_link" => $external_link),
                'headings' => array("en" => $notification_title),
                'contents' => array("en" => $notification_msg),
                'big_picture' => $file_name
            );
        } else {
            // no image select
            $fields = array(
                'app_id' => $row_app->onesignal_app_id,
                'included_segments' => array('All'),
                'data' => array("foo" => "bar", "type" => $type, "id" => $id, "sub_id" => $sub_id, "title" => $title, "external_link" => $external_link),
                'headings' => array("en" => $notification_title),
                'contents' => array("en" => $notification_msg),
            );
        }

        $fields = json_encode($fields);
        /*print("\nJSON sent:\n");
        print($fields);*/

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . $row_app->onesignal_rest_key
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);

        curl_close($ch);

        $message = array('message' => $this->lang->line('notification_msg'), 'class' => 'success');
        $this->session->set_flashdata('response_msg', $message);

        redirect(base_url() . 'admin/notification', 'refresh');
    }

    public function direct_send_notification()
    {

        $row_app = $this->Setting_model->get_android_details();

        $type = $this->input->post('type');
        $id = strval($this->input->post('id'));
        $sub_id = strval($this->input->post('sub_id'));
        $title = $this->input->post('title');

        $image = $this->input->post('image');

        if ($image == '') {
            $fields = array(
                'app_id' => $row_app->onesignal_app_id,
                'included_segments' => array('All'),
                'data' => array("foo" => "bar", "type" => $type, "id" => $id, "sub_id" => $sub_id, "title" => $title, "external_link" => false),
                'headings' => array("en" => $this->app_name),
                'contents' => array("en" => $title),
            );
        } else {
            $fields = array(
                'app_id' => $row_app->onesignal_app_id,
                'included_segments' => array('All'),
                'data' => array("foo" => "bar", "type" => $type, "id" => $id, "sub_id" => $sub_id, "title" => $title, "external_link" => false),
                'headings' => array("en" => $this->app_name),
                'contents' => array("en" => $title),
                'big_picture' => $image
            );
        }

        $fields = json_encode($fields);
        /*print("\nJSON sent:\n");
        print($fields);*/

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . $row_app->onesignal_rest_key
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);

        curl_close($ch);

        $message = array('message' => $this->lang->line('notification_msg'), 'status' => '1', 'class' => 'success');
        echo json_encode($message);
        exit;
    }

    public function save_profile()
    {
        $data = array();

        $this->load->model('Admin_model');

        $user_id=$this->session->userdata('id');
        $row = $this->Admin_model->get_data($user_id);

        if ($_FILES['file_name']['error'] != 4) {

            $config['upload_path'] =  'assets/images/';
            $config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

            $image = date('dmYhis') . '_' . rand(0, 99999) . '_' . $_FILES["file_name"]['name'];

            $config['file_name'] = $image;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file_name')) {
                $message = array('message' => $this->upload->display_errors(), 'class' => 'error');
                $this->session->set_flashdata('response_msg', $message);

                redirect(base_url() . 'admin/profile', 'refresh');// . $id
            }

            if (file_exists('assets/images/' . $row->user_image)) {
                unlink('assets/images/' . $row->user_image);
            }
        } else {
            $image = $row->user_image;
        }

        //$user_id=$this->session->userdata('id');
        $data = array(
            'user_name' => $this->input->post('username'),
            'user_email' => $this->input->post('email'),
            'user_image' => $image
        );

        if ($this->input->post('password') != "") {
            $data = array_merge($data, array("password" => md5($this->input->post('password'))));
        }

        $data = $this->security->xss_clean($data);

        if ($this->common_model->update($data, $user_id, 'tbl_partner')) {
            $message = array('message' => 'Profile updated...', 'class' => 'success');
            $this->session->set_flashdata('response_msg', $message);
        }

        redirect(base_url() . 'admin/profile', 'refresh');
    }

    public function save_setting()
    {
        $data = array();

        $action_for = $this->input->post('action_for');

        $data_setting = $this->Setting_model->get_details();

        switch ($action_for) {

            case 'web_general_settings':

                $data_setting = array();
                $data_setting = $this->Setting_model->get_web_details();

                $data = array(
                    'site_name'  =>  trim($this->input->post('site_name')),
                    'site_description'  =>  trim($this->input->post('site_description')),
                    'site_keywords'  =>  trim($this->input->post('site_keywords')),
                    'copyright_text'  =>  trim($this->input->post('copyright_text')),
                    'libraries_load_from'  =>  trim($this->input->post('libraries_load_from')),
                    'header_code'  =>  htmlentities(trim($this->input->post('header_code'))),
                    'footer_code'  =>  htmlentities(trim($this->input->post('footer_code'))),
                );

                if ($_FILES['web_logo_1']['error'] != 4) {
                    if (file_exists('assets/images/' . $data_setting->web_logo_1)) {
                        unlink('assets/images/' . $data_setting->web_logo_1);
                    }

                    $config['upload_path'] =  'assets/images/';
                    $config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

                    $image = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['web_logo_1']['name'], PATHINFO_EXTENSION);

                    $config['file_name'] = $image;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('web_logo_1')) {
                        $message = array('message' => $this->upload->display_errors(), 'class' => 'error');
                        $this->session->set_flashdata('response_msg', $message);

                        redirect(base_url() . 'admin/web-settings', 'refresh');
                    }

                    $data = array_merge($data, array("web_logo_1" => $image));
                }

                if ($_FILES['web_logo_2']['error'] != 4) {
                    if (file_exists('assets/images/' . $data_setting->web_logo_2)) {
                        unlink('assets/images/' . $data_setting->web_logo_2);
                    }

                    $config['upload_path'] =  'assets/images/';
                    $config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

                    $image = date('dmYhis') . '_' . rand(0, 99999) . "2." . pathinfo($_FILES['web_logo_2']['name'], PATHINFO_EXTENSION);

                    $config['file_name'] = $image;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('web_logo_2')) {
                        $message = array('message' => $this->upload->display_errors(), 'class' => 'error');
                        $this->session->set_flashdata('response_msg', $message);

                        redirect(base_url() . 'admin/web-settings', 'refresh');
                    } else {
                        $upload_data = $this->upload->data();
                        $image2 = $upload_data['file_name'];
                    }

                    $data = array_merge($data, array("web_logo_2" => $image2));
                }

                if ($_FILES['web_favicon']['error'] != 4) {
                    if (file_exists('assets/images/' . $data_setting->web_favicon)) {
                        unlink('assets/images/' . $data_setting->web_favicon);
                    }

                    $config['upload_path'] =  'assets/images/';
                    $config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

                    $image = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['web_favicon']['name'], PATHINFO_EXTENSION);

                    $config['file_name'] = $image;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('web_favicon')) {
                        $message = array('message' => $this->upload->display_errors(), 'class' => 'error');
                        $this->session->set_flashdata('response_msg', $message);

                        redirect(base_url() . 'admin/settings', 'refresh');
                    }


                    // Configuration
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/images/' . $image;
                    $config['new_image'] = 'assets/images/' . $image;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 16;
                    $config['height'] = 16;

                    $this->load->library('image_lib', $config);

                    // handle if there is any problem
                    if (!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors();
                    }

                    $data = array_merge($data, array("web_favicon" => $image));
                }

                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_web_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }

                redirect(base_url() . 'admin/web-settings', 'refresh');

                break;

            case 'general_settings':

                $data = array(
                    'app_order_email'  =>  $this->input->post('app_order_email'),
                    'app_name'  =>  $this->input->post('app_name'),
                    'app_email'  =>  $this->input->post('app_email'),
                    'app_author'  =>  $this->input->post('app_author'),
                    'app_description'  =>  $this->input->post('app_description'),
                    'app_version'  =>  $this->input->post('app_version'),
                    'app_contact'  =>  $this->input->post('app_contact'),
                    'app_website'  =>  $this->input->post('app_website'),
                    'app_developed_by'  =>  $this->input->post('app_developed_by'),
                    'app_currency_code'  =>  trim($this->input->post('app_currency_code')),
                    'app_currency_html_code'  =>  trim($this->input->post('app_currency_html_code')),
                    'email_otp_op_status'  => $this->input->post('email_otp_op_status') ? $this->input->post('email_otp_op_status') : 'false',
                    'facebook_url'  => trim($this->input->post('facebook_url')),
                    'twitter_url'  => trim($this->input->post('twitter_url')),
                    'youtube_url'  => trim($this->input->post('youtube_url')),
                    'instagram_url'  => trim($this->input->post('instagram_url'))
                );

                if ($_FILES['app_logo']['error'] != 4) {
                    if (file_exists('assets/images/' . $data_setting->app_logo)) {
                        unlink('assets/images/' . $data_setting->app_logo);
                    }

                    $config['upload_path'] =  'assets/images/';
                    $config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

                    $image = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['app_logo']['name'], PATHINFO_EXTENSION);

                    $config['file_name'] = $image;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('app_logo')) {
                        $message = array('message' => $this->upload->display_errors(), 'class' => 'error');
                        $this->session->set_flashdata('response_msg', $message);

                        redirect(base_url() . 'admin/settings', 'refresh');
                    }

                    $data = array_merge($data, array("app_logo" => $image));
                }

                if ($_FILES['web_favicon']['error'] != 4) {
                    if (file_exists('assets/images/' . $data_setting->web_favicon)) {
                        unlink('assets/images/' . $data_setting->web_favicon);
                    }

                    $config['upload_path'] =  'assets/images/';
                    $config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

                    $image = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['web_favicon']['name'], PATHINFO_EXTENSION);

                    $config['file_name'] = $image;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('web_favicon')) {
                        $message = array('message' => $this->upload->display_errors(), 'class' => 'error');
                        $this->session->set_flashdata('response_msg', $message);

                        redirect(base_url() . 'admin/settings', 'refresh');
                    }


                    // Configuration
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/images/' . $image;
                    $config['new_image'] = 'assets/images/' . $image;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 16;
                    $config['height'] = 16;

                    $this->load->library('image_lib', $config);

                    // handle if there is any problem
                    if (!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors();
                    }

                    $data = array_merge($data, array("web_favicon" => $image));
                }

                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }

                redirect(base_url() . 'admin/settings', 'refresh');

                break;

            case 'home_content':
                $data = array(
                    'home_slider_opt'  => $this->input->post('home_slider_opt') ? $this->input->post('home_slider_opt') : 'false',
                    'home_brand_opt'  => $this->input->post('home_brand_opt') ? $this->input->post('home_brand_opt') : 'false',
                    'home_category_opt'  => $this->input->post('home_category_opt') ? $this->input->post('home_category_opt') : 'false',
                    'home_offer_opt'  => $this->input->post('home_offer_opt') ? $this->input->post('home_offer_opt') : 'false',
                    'home_flase_opt'  => $this->input->post('home_flase_opt') ? $this->input->post('home_flase_opt') : 'false',
                    'home_latest_opt'  => $this->input->post('home_latest_opt') ? $this->input->post('home_latest_opt') : 'false',
                    'home_top_rated_opt'  => $this->input->post('home_top_rated_opt') ? $this->input->post('home_top_rated_opt') : 'false',
                    'min_rate'  => $this->input->post('min_rate'),
                    'home_cat_wise_opt'  => $this->input->post('home_cat_wise_opt') ? $this->input->post('home_cat_wise_opt') : 'false',
                    'home_recent_opt'  => $this->input->post('home_recent_opt') ? $this->input->post('home_recent_opt') : 'false',

                    'app_home_slider_opt'  => $this->input->post('app_home_slider_opt') ? $this->input->post('app_home_slider_opt') : 'false',
                    'app_home_brand_opt'  => $this->input->post('app_home_brand_opt') ? $this->input->post('app_home_brand_opt') : 'false',
                    'app_home_category_opt'  => $this->input->post('app_home_category_opt') ? $this->input->post('app_home_category_opt') : 'false',
                    'app_home_offer_opt'  => $this->input->post('app_home_offer_opt') ? $this->input->post('app_home_offer_opt') : 'false',
                    'app_home_flase_opt'  => $this->input->post('app_home_flase_opt') ? $this->input->post('app_home_flase_opt') : 'false',
                    'app_home_latest_opt'  => $this->input->post('app_home_latest_opt') ? $this->input->post('app_home_latest_opt') : 'false',
                    'app_home_top_rated_opt'  => $this->input->post('app_home_top_rated_opt') ? $this->input->post('app_home_top_rated_opt') : 'false',
                    'app_home_cat_wise_opt'  => $this->input->post('app_home_cat_wise_opt') ? $this->input->post('app_home_cat_wise_opt') : 'false',
                    'app_home_recent_opt'  => $this->input->post('app_home_recent_opt') ? $this->input->post('app_home_recent_opt') : 'false',
                );

                $data_cat = array('set_on_home' => 0);

                $this->common_model->updateByids($data_cat, array('set_on_home' => 1), 'tbl_category');

                $data_cat = array('set_on_home' => 1);

                $this->common_model->updateByIn($data_cat, $this->input->post('home_category'), 'tbl_category');

                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }
                redirect(base_url() . 'admin/settings', 'refresh');
                break;

            case 'about_content':
                $data = array(
                    'about_page_title'  => addslashes($this->input->post('about_page_title')),
                    'about_content'  => addslashes($this->input->post('about_content')),
                    'about_status'  => $this->input->post('about_status') ? $this->input->post('about_status') : 'false',
                );

                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_web_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }
                redirect(base_url() . 'admin/web-settings?page_settings&page=about_us', 'refresh');
                break;

            case 'contact_content':
                $data = array(
                    'contact_page_title'  => trim($this->input->post('contact_page_title')),
                    'address'  => trim($this->input->post('address')),
                    'contact_number'  => trim($this->input->post('contact_number')),
                    'contact_email'  => trim($this->input->post('contact_email')),
                    'android_app_url'  => trim($this->input->post('android_app_url')),
                    'ios_app_url'  => trim($this->input->post('ios_app_url'))
                );

                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_web_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }

                redirect(base_url() . 'admin/web-settings?page_settings&page=contact_us', 'refresh');

                break;

            case 'terms_of_use':
                $data = array(
                    'terms_of_use_page_title'  => addslashes($this->input->post('terms_of_use_page_title')),
                    'terms_of_use_content'  => addslashes($this->input->post('terms_of_use_content')),
                    'terms_of_use_page_status'  => $this->input->post('terms_of_use_page_status') ? $this->input->post('terms_of_use_page_status') : 'false'
                );

                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_web_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }
                redirect(base_url() . 'admin/web-settings?page_settings&page=terms_of_use', 'refresh');
                break;

            case 'privacy':
                $data = array(
                    'privacy_page_title'  => addslashes($this->input->post('privacy_page_title')),
                    'privacy_content'  => addslashes($this->input->post('privacy_content')),
                    'privacy_page_status'  => $this->input->post('privacy_page_status') ? $this->input->post('privacy_page_status') : 'false'
                );

                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_web_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }
                redirect(base_url() . 'admin/web-settings?page_settings&page=privacy', 'refresh');
                break;

            case 'cancellation':
                $data = array(
                    'cancellation_page_title'  => addslashes($this->input->post('cancellation_page_title')),
                    'cancellation_content'  => addslashes($this->input->post('cancellation_content')),
                    'cancellation_page_status'  => $this->input->post('cancellation_page_status') ? $this->input->post('cancellation_page_status') : 'false'
                );

                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_web_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }
                redirect(base_url() . 'admin/web-settings?page_settings&page=cancellation', 'refresh');
                break;

            case 'refund_return':
                $data = array(
                    'refund_return_policy_page_title'  => addslashes($this->input->post('refund_return_policy_page_title')),
                    'refund_return_policy'  => addslashes($this->input->post('refund_return_policy')),
                    'refund_return_policy_status'  => $this->input->post('refund_return_policy_status') ? $this->input->post('refund_return_policy_status') : 'false'
                );

                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_web_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }
                redirect(base_url() . 'admin/web-settings?page_settings&page=refund_return', 'refresh');
                break;

            case 'payment_settings':

                $data = array(
                    'cod_status'  =>  $this->input->post('cod_status') ? $this->input->post('cod_status') : 'false',
                    'paypal_status'  =>  $this->input->post('paypal_status') ? $this->input->post('paypal_status') : 'false',
                    'paypal_mode'  => trim($this->input->post('paypal_mode')),
                    'paypal_client_id'  => trim($this->input->post('paypal_client_id')),
                    'paypal_secret_key'  => trim($this->input->post('paypal_secret_key')),
                    'stripe_status'  =>  $this->input->post('stripe_status') ? $this->input->post('stripe_status') : 'false',
                    'stripe_key'  => trim($this->input->post('stripe_key')),
                    'stripe_secret'  => trim($this->input->post('stripe_secret')),
                    'razorpay_status'  =>  $this->input->post('razorpay_status') ? $this->input->post('razorpay_status') : 'false',
                    'razorpay_key'  => trim($this->input->post('razorpay_key')),
                    'razorpay_secret'  => trim($this->input->post('razorpay_secret')),
                    'razorpay_theme_color'  => trim($this->input->post('razorpay_theme_color'))
                );
                break;

            case 'login_settings':

                $data = array(
                    'google_login_status'  =>  $this->input->post('google_login_status') ? $this->input->post('google_login_status') : 'false',
                    'google_client_id'  => trim($this->input->post('google_client_id')),
                    'google_secret_key'  => trim($this->input->post('google_secret_key')),
                    'facebook_status'  =>  $this->input->post('facebook_status') ? $this->input->post('facebook_status') : 'false',
                    'facebook_app_id'  => trim($this->input->post('facebook_app_id')),
                    'facebook_app_secret'  => trim($this->input->post('facebook_app_secret'))
                );


                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }
                redirect(base_url() . 'admin/web-settings', 'refresh');

                break;

            case 'google_recaptcha':

                $data = array(
                    'g_captcha'  =>  $this->input->post('g_captcha') ? $this->input->post('g_captcha') : 'false',
                    'g_captcha_site_key'  => trim($this->input->post('g_captcha_site_key')),
                    'g_captcha_secret_key'  => trim($this->input->post('g_captcha_secret_key'))
                );


                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_web_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }
                redirect(base_url() . 'admin/web-settings', 'refresh');

                break;

            case 'smtp_settings':

                $data_setting = array();
                $data_setting = $this->Setting_model->get_smtp_settings();

                $key = ($this->input->post('smtpIndex') == 'gmail') ? '0' : '1';

                $password = '';
                if ($this->input->post('smtp_password')[$key] != '') {
                    $password = $this->input->post('smtp_password')[$key];
                } else {
                    if ($key == 0) {
                        $password = $data_setting->smtp_gpassword;
                    } else {
                        $password = $data_setting->smtp_password;
                    }
                }

                if ($key == 0) {

                    $data = array(
                        'smtp_library' => $this->input->post('smtp_library'),
                        'smtp_type'  =>  'gmail',
                        'smtp_ghost' => $this->input->post('smtp_host')[$key],
                        'smtp_gemail' => $this->input->post('smtp_email')[$key],
                        'smtp_gpassword'  =>  $password,
                        'smtp_gsecure' => $this->input->post('smtp_secure')[$key],
                        'gport_no' => $this->input->post('port_no')[$key]
                    );
                } else {

                    $data = array(
                        'smtp_library' => $this->input->post('smtp_library'),
                        'smtp_type'  =>  'server',
                        'smtp_host' => $this->input->post('smtp_host')[$key],
                        'smtp_email' => $this->input->post('smtp_email')[$key],
                        'smtp_password'  =>  $password,
                        'smtp_secure' => $this->input->post('smtp_secure')[$key],
                        'port_no' => $this->input->post('port_no')[$key]
                    );
                }

                $data = $this->security->xss_clean($data);

                if ($this->common_model->get_count_by_ids(array('id' => '1'), 'tbl_smtp_settings')) {
                    if ($this->common_model->update($data, '1', 'tbl_smtp_settings')) {
                        $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                        $this->session->set_flashdata('response_msg', $message);
                    }
                } else {
                    if ($this->common_model->insert($data, 'tbl_smtp_settings')) {
                        $message = array('message' => $this->lang->line('add_msg'), 'class' => 'success');
                        $this->session->set_flashdata('response_msg', $message);
                    }
                }

                redirect(base_url() . 'admin/settings', 'refresh');

                break;

            case 'ads_place':

                $data = array(
                    'home_ad'  =>  $this->input->post('home_ad') ? $this->input->post('home_ad') : 'false',
                    'home_banner_ad'  => htmlentities(trim($this->input->post('home_banner_ad'))),
                    'product_ad'  =>  $this->input->post('product_ad') ? $this->input->post('product_ad') : 'false',
                    'product_banner_ad'  => htmlentities(trim($this->input->post('product_banner_ad')))
                );

                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_web_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }
                redirect(base_url() . 'admin/web-settings?page_settings&page=ads_place', 'refresh');

                break;

            default:

                break;
        }

        $data = $this->security->xss_clean($data);

        if ($this->common_model->update($data, '1', 'tbl_settings')) {
            $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
            $this->session->set_flashdata('response_msg', $message);
        }

        redirect(base_url() . 'admin/settings', 'refresh');
    }


    public function save_app_setting()
    {
        $data = array();

        $action_for = $this->input->post('action_for');

        $data_setting = $this->Setting_model->get_android_details();

        switch ($action_for) {

            case 'admob_settings':

                $data = array(
                    'publisher_id'  => trim($this->input->post('publisher_id')),
                    'banner_ad'  =>  $this->input->post('banner_ad') ? $this->input->post('banner_ad') : 'false',
                    'banner_ad_type'  => trim($this->input->post('banner_ad_type')),
                    'banner_ad_id'  => trim($this->input->post('banner_ad_id')),
                    'banner_facebook_id'  => trim($this->input->post('banner_facebook_id')),
                    'interstital_ad'  =>  $this->input->post('interstital_ad') ? $this->input->post('interstital_ad') : 'false',
                    'interstital_ad_type'  => trim($this->input->post('interstital_ad_type')),
                    'interstital_ad_id'  => trim($this->input->post('interstital_ad_id')),
                    'interstital_facebook_id'  => trim($this->input->post('interstital_facebook_id')),
                    'interstital_ad_click'  => trim($this->input->post('interstital_ad_click'))
                );
                break;

            case 'api_settings':

                $data = array(
                    'api_home_limit'  => trim($this->input->post('api_home_limit')),
                    'api_page_limit'  => trim($this->input->post('api_page_limit')),
                    'api_cat_order_by'  => trim($this->input->post('api_cat_order_by')),
                    'api_cat_post_order_by'  => trim($this->input->post('api_cat_post_order_by')),
                    'api_all_order_by'  => trim($this->input->post('api_all_order_by'))
                );
                break;

            case 'notification_settings':

                $data = array(
                    'onesignal_app_id'  => trim($this->input->post('onesignal_app_id')),
                    'onesignal_rest_key'  => trim($this->input->post('onesignal_rest_key'))
                );

                $data = $this->security->xss_clean($data);

                if ($this->common_model->update($data, '1', 'tbl_android_settings')) {
                    $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
                    $this->session->set_flashdata('response_msg', $message);
                }

                redirect(base_url() . 'admin/notification', 'refresh');

                break;

            case 'app_update_popup':

                $data = array(
                    'app_update_status'  =>  $this->input->post('app_update_status') ? $this->input->post('app_update_status') : 'false',
                    'app_new_version'  => trim($this->input->post('app_new_version')),
                    'app_update_desc'  => trim($this->input->post('app_update_desc')),
                    'app_redirect_url'  => trim($this->input->post('app_redirect_url')),
                    'cancel_update_status'  =>  $this->input->post('cancel_update_status') ? $this->input->post('cancel_update_status') : 'false',
                );
                break;

            default:

                break;
        }


        $data = $this->security->xss_clean($data);

        if ($this->common_model->update($data, '1', 'tbl_android_settings')) {
            $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
            $this->session->set_flashdata('response_msg', $message);
        }

        redirect(base_url() . 'admin/android-settings', 'refresh');
    }


    public function save_verify_purchase()
    {
        $data = array();

        $action_for = $this->input->post('action_for');

        $data_setting = $this->Setting_model->get_android_details();

        switch ($action_for) {

            case 'website_purchase':

                $data = array(
                    'web_envato_buyer_name'  => trim($this->input->post('web_envato_buyer_name')),
                    'web_envato_purchase_code'  => trim($this->input->post('web_envato_purchase_code'))
                );
                break;

            case 'android_purchase':
                {
                    $envato_buyer_name=trim($this->input->post('android_envato_buyer_name'));
                    $purchase_code=trim($this->input->post('android_envato_purchase_code'));
                    $package_name=trim($this->input->post('package_name'));

                    $envato_buyer = verify_envato_purchase_code($purchase_code);

                    if(!empty($envato_buyer))
                    {
                        if($envato_buyer_name!='' AND strcasecmp($envato_buyer->buyer, $envato_buyer_name) == 0)
                        {

                            $data = array(
                                'android_envato_buyer_name'  => $envato_buyer_name,
                                'android_envato_purchase_code'  => $purchase_code,
                                'package_name'  => $package_name,
                                'android_envato_purchased_status' => 1
                            );

                            $this->db->where(array('id' => 1));
                            $this->db->update('tbl_verify', $data);

                            $admin_url=base_url().'admin';

                            verify_data_on_server($envato_buyer->item->id,$envato_buyer->buyer,$purchase_code,1,$admin_url);

                            $message = array('message' => $this->lang->line('envato_verify_success_lbl'), 'class' => 'success');

                            $this->session->set_flashdata('response_msg', $message);
                            redirect(base_url() . 'admin/verify-purchase', 'refresh');
                        }
                        else{

                            // invalid envato buyer name

                            $data = array(
                                'android_envato_buyer_name'  => $envato_buyer_name,
                                'android_envato_purchase_code'  => $purchase_code,
                                'package_name'  => $package_name,
                                'android_envato_purchased_status' => 0
                            );

                            $this->db->where(array('id' => 1));
                            $this->db->update('tbl_verify', $data);

                            $message = array('message' => $this->lang->line('envato_buyer_wrong_lbl'), 'class' => 'error');

                            $this->session->set_flashdata('response_msg', $message);
                            redirect(base_url() . 'admin/verify-purchase', 'refresh');
                        }
                    }
                    else{
                        // invalid envato purchase code

                        $message = array('message' => $this->lang->line('envato_purchase_code_wrong_lbl'), 'class' => 'error');
                        $this->session->set_flashdata('response_msg', $message);

                        redirect(base_url() . 'admin/verify-purchase', 'refresh');
                    }                    
                }
                break;

            default:

                break;
        }


        $data = $this->security->xss_clean($data);

        if ($this->common_model->update($data, '1', 'tbl_verify')) {
            $message = array('message' => $this->lang->line('update_msg'), 'class' => 'success');
            $this->session->set_flashdata('response_msg', $message);
        }

        redirect(base_url() . 'admin/verify-purchase', 'refresh');
    }


    public function perform_multipe()
    {
        $data = array();

        $action = $this->input->post('for_action');

        $table = $this->input->post('table');

        $ids = $this->input->post('ids');

        if ($action == 'enable') {

            $data = array(
                'status' => 1
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->updateByIn($data, $ids, $table);
        } else if ($action == 'disable') {

            $data = array(
                'status' => 0
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->updateByIn($data, $ids, $table);
        } else if ($action == 'delete') {

            switch ($table) {
                case 'tbl_users':
                    $this->load->model('Users_model');

                    foreach ($ids as $key => $value) {
                        $this->Users_model->delete($value);
                    }

                    break;

                case 'tbl_product':
                    $this->load->model('Product_model');

                    foreach ($ids as $key => $value) {
                        $this->Product_model->delete($value);
                    }

                    break;

                case 'tbl_order_details':
                    $this->load->model('Order_model');

                    foreach ($ids as $key => $value) {
                        $this->Order_model->delete($value);
                    }

                    break;

                default:
                    # code...
                    break;
            }
        } else if ($action == 'set_today_deal') {
            

            $data = array(
                'today_deal' => 1,
                'today_deal_date' => strtotime(date('d-m-Y h:i:s A', now()))
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->updateByIn($data, $ids, 'tbl_product');
        } else if ($action == 'remove_today_deal') {
            

            $data = array(
                'today_deal' => 0,
                'today_deal_date' => 0,
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->updateByIn($data, $ids, 'tbl_product');
        }


        echo json_encode(array('status' => 1, 'msg' => 'Done'));
    }

    public function faq_payment_delete($id)
    {
        $this->common_model->delete($id, 'tbl_faq');
        echo 'success';
    }


    public function export_transaction()
    {
        //error_reporting(0);

        $currency_code = $this->common_model->selectByidParam('1', 'tbl_settings', 'app_currency_html_code');

        $fileName = date('dmyhis') . '_transactions.xls';


        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $table_columns = array("Sr.", "Order ID", "Email", "Amount", "Payment Mode", "Payment ID", "Date");

        $column = 0;

        foreach ($table_columns as $field) {
            $sheet->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $seller_id=$this->session->userdata('id');

        $this->db->select('transaction.*');
        $this->db->from('tbl_transaction transaction');
        $this->db->join('tbl_order_items order_items','order_items.order_id= transaction.order_id','LEFT');
        $where=array('transaction.status' => '1', 'order_items.vid'=>$seller_id);
        $this->db->where($where);
        $this->db->order_by('transaction.id', 'DESC');
        $query = $this->db->get();
        $row_data  = $query->result();
        //$row_data = $this->common_model->select('tbl_transaction', 'DESC');

        $excel_row = 2;

        $no = 1;

        foreach ($row_data as $row) {
            $sheet->setCellValueByColumnAndRow(0, $excel_row, $no++);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, $row->order_unique_id);
            $sheet->setCellValueByColumnAndRow(2, $excel_row, $row->email);
            $sheet->setCellValueByColumnAndRow(3, $excel_row, $currency_code . $row->payment_amt);
            $sheet->setCellValueByColumnAndRow(4, $excel_row, strtoupper($row->gateway));
            $sheet->setCellValueByColumnAndRow(5, $excel_row, $row->payment_id);
            $sheet->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y h:i A', $row->date));
            $excel_row++;
        }

         $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
  
    }

    public function export_refund()
    {

       // echo "aaa";
       // die;
       // error_reporting(0);

        $currency_code = $this->common_model->selectByidParam('1', 'tbl_settings', 'app_currency_html_code');

        $fileName = date('dmyhis') . '_refunds.xls';

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        //$this->load->library("excel");
        //$object = new PHPExcel();

        //$object->setActiveSheetIndex(0);

        $table_columns = array("Sr.", "Order ID", "Product", "Refund Amount", "Reason", "Status", "Date");

        $column = 0;

        foreach ($table_columns as $field) {
            $sheet->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $row_data = $this->api_model->get_refund_data();

        $excel_row = 2;

        $no = 1;

        foreach ($row_data as $row) {

            switch ($row->request_status) {
                case '0':
                    $status = 'Pending';
                    break;
                case '2':
                    $status = 'Process';
                    break;
                case '1':
                    $status = 'Completed';
                    break;
                case '-1':
                    $status = 'Wating for claim';
                    break;

                default:
                    $_bnt_class = 'btn-danger';
                    break;
            }

            $sheet->setCellValueByColumnAndRow(0, $excel_row, $no++);
            $sheet->setCellValueByColumnAndRow(1, $excel_row, $row->order_unique_id);
            $sheet->setCellValueByColumnAndRow(2, $excel_row, $row->product_title);
            $sheet->setCellValueByColumnAndRow(3, $excel_row, $currency_code . $row->refund_pay_amt);
            $sheet->setCellValueByColumnAndRow(4, $excel_row, $row->refund_reason);
            $sheet->setCellValueByColumnAndRow(5, $excel_row, $status);
            $sheet->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y h:i A', $row->last_updated));
            $excel_row++;
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
       header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
       $writer->save('php://output');

        /*
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $fileName);
        ob_end_clean();
        $object_writer->save('php://output');*/
    }

    public function backup()
    {
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');

        //load database
        $this->load->dbutil();

        $sql_file=$this->db->database.'.sql';

        //create format
        $db_format=array('format'=>'zip','filename'=>$sql_file);

        $backup=& $this->dbutil->backup($db_format);

        $dbname='backup-on-'.date('d-m-y H:i').'_ecommerce_app_db.zip';
        write_file(FCPATH . '/downloads/' . $dbname, $backup);
        
        force_download($dbname,$backup);
    }

    public function number_format_short($n, $precision = 1)
    {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }

        if ( $precision > 0 ) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }
        return $n_format . $suffix;
    }
    
    public function vendor_comm()
    {
        $order_item = $this->db->get_where('tbl_order_items',array('pro_order_status'=>4))->result();

        $this->db->select('order_items.id AS order_main_id');
        $this->db->select('product.product_title,product.product_mrp,,product.insert_id');
        $this->db->select('cat.vendor_percentage');
        $this->db->select('order_detail.order_unique_id');
        $this->db->select('vendor.user_name,vendor.user_email,vendor.bankacno,vendor.ifsc');
        $this->db->from('tbl_order_items order_items');
        $this->db->join('tbl_product product','product.id = order_items.product_id','LEFT');
        $this->db->join('tbl_category cat','cat.id = product.category_id','LEFT');
        $this->db->join('tbl_order_details order_detail','order_detail.id = order_items.order_id','LEFT');
        $this->db->join('tbl_partner vendor','vendor.id = product.insert_id','LEFT');
        $this->db->where('product.insert_id <>',1);
        $this->db->where('order_items.vendor_status',0);
        $this->db->where('order_items.pro_order_status',4);
        $resultSet=$this->db->get()->result();

        if(!empty($resultSet))
        {
            foreach ($resultSet as $key => $value) 
            {
                if($value->insert_id != '' && $value->insert_id != 0)
                {
                    $product_mrp = 0;
                    $product_percentage = 0;
                    if($value->product_mrp != 0)
                    {
                        if($value->vendor_percentage != '')
                        {
                            $product_mrp = floatval($value->product_mrp) - floatval($value->product_mrp) * floatval($value->vendor_percentage) / 100;
                            $product_percentage = floatval($value->vendor_percentage);

                        }
                        else
                        {
                            $product_mrp = floatval($value->product_mrp);
                            $product_percentage = 0;
                        }
                    }
                    $data = array(
                        'vendor_id'=>$value->insert_id,
                        'vendor_name'=>$value->user_name,
                        'vendor_email'=>$value->user_email,
                        'vendor_account'=>$value->bankacno,
                        'vendor_ifsc'=>$value->ifsc,
                        'product_title'=>$value->product_title,
                        'order_id'=>$value->order_unique_id,
                        'amount'=>$value->product_mrp,
                        'commission_paid'=>$product_mrp,
                        'commission_percentage'=>$product_percentage,
                        'created_at' => strtotime(date('d-m-Y h:i:s A',now())),
                    );

                    $inserted = $this->db->insert('tbl_vendor_commission',$data);

                    $dataupdate = array(
                        'vendor_status' => 1,
                    );

                    $this->db->where('id',$value->order_main_id);
                    $this->db->update('tbl_order_items',$dataupdate);
                    
                }
                
            }
            /*if($inserted)
            {
                return true;
            }
            else
            {
                return false;
            } */
        }else{
            return false;
        } 
    }

    public function vendor_commission()
    {

        $data = array();
        $data['page_title'] = 'Vendor Commission';
        $data['current_page'] = 'Vendor Commission';
        $this->vendor_comm();
        if($this->input->get('search_value')!='')
        {
            $keyword=addslashes(trim($this->input->get('search_value')));
        }
        else{
            $keyword='';
        }

        $row = $this->api_model->vendor_commission('','',$keyword);

        $config = array();
        $config["base_url"] = base_url() . 'admin/vendor_commission';
        $config["total_rows"] = count($row);
        $config["per_page"] = 12;

        $config['num_links'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;

        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = FALSE;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '';
        $config['next_tag_open'] = '<span class="nextlink">';
        $config['next_tag_close'] = '</span>';

        $config['prev_link'] = '';
        $config['prev_tag_open'] = '<span class="prevlink">';
        $config['prev_tag_close'] = '</span>';

        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $config['num_tag_open'] = '<li style="margin:3px">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;

        $page = ($page - 1) * $config["per_page"];

        $data["links"] = $this->pagination->create_links();
        $row = $this->api_model->vendor_commission2($config["per_page"], $page,$keyword);

        $data['commission'] = $row;


        $this->template->load('admin/template', 'admin/page/vendor_commission', $data); // :blush:

    }

    public function order_summary($order_no)
    {

        
            $data['page_title'] = $this->lang->line('ord_list_lbl');
            $data['current_page'] = $this->lang->line('ord_summary_lbl');

            $this->db->select('*');
            $this->db->from('tbl_order_details');
            //$this->db->where('order_unique_id', $order_no); 
            $this->db->where('id', $order_no); 
            $this->db->limit(1);
            $query = $this->db->get();

            $data['order_data'] = $query->result();

            $this->template->load('admin/template', 'admin/page/view_order2', $data); // :blush:
        
    }

    public function commission_paid($id)
    {
        $this->form_validation->set_rules('transaction', 'transaction', 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $data['page_title'] = 'Vendor Commission';
            $this->db->where('id',$id);
            $data['users'] = $this->db->get('tbl_vendor_commission')->result();


            $data['current_page'] = 'Paid Commission';
            
            $this->template->load('admin/template', 'admin/page/commission_paid', $data);
        }
        else
        {
        

            $this->load->helper("date");

            $data = array(
                'status'  => 1,
                'transaction'  => $this->input->post('transaction'),
                'paid_type'  => $this->input->post('paid_type'),
                'paid_date'  => strtotime(date('d-m-Y h:i:s A',now())),
            );

            $data = $this->security->xss_clean($data);

            if($this->common_model->update($data, $id,'tbl_vendor_commission')){
                $messge = array('message' => $this->lang->line('update_msg'),'class' => 'success');
                $this->session->set_flashdata('response_msg', $messge);
            }
            else{
                $messge = array('message' => $this->lang->line('update_error'),'class' => 'error');
                $this->session->set_flashdata('response_msg', $messge);
            } 
            redirect(base_url() . 'admin/vendor_commission', 'refresh');
        }
        
    }
    
    public function report()
    {
        $data = array();
        $data['page_title'] = 'Report';
        $data['current_page'] = 'Report';
        $data['cat_cnt'] = count($this->common_model->select('tbl_category'));
        $data['sub_cat_cnt'] = count($this->common_model->select('tbl_sub_category'));
        $data['product_cnt'] = count($this->common_model->select('tbl_product'));
        $data['user_cnt'] = count($this->common_model->select('tbl_users'));
        $data['vendor_cnt'] = count($this->common_model->select('tbl_partner'));
        $data['order_cnt'] = count($this->common_model->selectByids(array('order_status <> ' => '-1'), 'tbl_order_details'));
        $data['transaction_cnt'] = count($this->common_model->selectByids(array('status' => '1'), 'tbl_transaction'));
        $data['pending_refund_cnt'] = count($this->common_model->selectByids(array('gateway <>' => 'cod'), 'tbl_refund'));

        $data['top_selling_products'] = $this->api_model->top_selling_products();

        $data['todays_orders'] = $this->api_model->todays_orders();
        $data['out_stock'] = $this->common_model->selectByids(array('product_quantity <' => '1'), 'tbl_product');

        $countStr = $countStrOrd = '';

        $no_data_status = false;
        $count = $countOrd = $monthCount = 0;

        for ($mon = 1; $mon <= 12; $mon++) {
            
            $monthCount++;

            if ($this->input->get('order_filter') != '') {

                $year = $this->input->get('order_filter');
                $month = date('M', mktime(0, 0, 0, $mon, 1, date('Y')));

                $total_orders = count($this->common_model->selectByids(array("order_status <>" => "-1", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%Y') =" => $year), 'tbl_order_details'));

                $pending_order = count($this->common_model->selectByids(array("order_status >=" => "1", "order_status <" => "4", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%Y') =" => $year), "tbl_order_details"));

                $deliver_order = count($this->common_model->selectByids(array("order_status" => "4", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%Y') =" => $year), "tbl_order_details"));

                $cancel_order = count($this->common_model->selectByids(array("order_status" => "5", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%Y') =" => $year), "tbl_order_details"));
            } else {

                $month = date('M', mktime(0, 0, 0, $mon, 1, date('Y')));

                $total_orders = count($this->common_model->selectByids(array("order_status <>" => "-1", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon), 'tbl_order_details'));

                $pending_order = count($this->common_model->selectByids(array("order_status >=" => "1", "order_status <" => "4", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon), "tbl_order_details"));

                $deliver_order = count($this->common_model->selectByids(array("order_status" => "4", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon), "tbl_order_details"));

                $cancel_order = count($this->common_model->selectByids(array("order_status" => "5", "DATE_FORMAT(FROM_UNIXTIME(`order_date`), '%c') =" => $mon), "tbl_order_details"));
            }


            if ($this->input->get('transaction_filter') != '') {

                $year = $this->input->get('transaction_filter');
                $month = date('M', mktime(0, 0, 0, $mon, 1, $year));

                $rowTransactions = $this->common_model->selectByids(array('status' => '1', "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`date`), '%Y') =" => $year), 'tbl_transaction');

                $total_payment = 0;

                foreach ($rowTransactions as $key => $value) {

                    $total_payment += $value->payment_amt;
                }

                $data['total_payment'] = $total_payment;

                $rowCod = $this->common_model->selectByids(array("status" => "1", "gateway" => "cod", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`date`), '%Y') =" => $year), "tbl_transaction");

                $cod_payment = 0;

                foreach ($rowCod as $key => $value) {

                    $cod_payment += $value->payment_amt;
                }

                $rowPayPal = $this->common_model->selectByids(array("status" => "1", "gateway" => "paypal", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`date`), '%Y') =" => $year), "tbl_transaction");

                $paypal_payment = 0;

                foreach ($rowPayPal as $key => $value) {

                    $paypal_payment += $value->payment_amt;
                }

                $rowStripe = $this->common_model->selectByids(array("status" => "1", "gateway" => "stripe", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`date`), '%Y') =" => $year), "tbl_transaction");

                $stripe_payment = 0;

                foreach ($rowStripe as $key => $value) {

                    $stripe_payment += $value->payment_amt;
                }

                $rowRazorpay = $this->common_model->selectByids(array("status" => "1", "gateway" => "razorpay", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon, "DATE_FORMAT(FROM_UNIXTIME(`date`), '%Y') =" => $year), "tbl_transaction");

                $razorpay_payment = 0;

                foreach ($rowRazorpay as $key => $value) {

                    $razorpay_payment += $value->payment_amt;
                }
            } else {

                $month = date('M', mktime(0, 0, 0, $mon, 1, date('Y')));

                $rowTransactions = $this->common_model->selectByids(array('status' => '1', "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon), 'tbl_transaction');

                $total_payment = 0;
                
                /*if(!empty($rowTransactions))
                {
                    foreach ($rowTransactions as $key => $value) {

                        $total_payment += $value->payment_amt;
                    }
                }*/
                $data['total_payment'] = $total_payment;

                $rowCod = $this->common_model->selectByids(array("status" => "1", "gateway" => "cod", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon), "tbl_transaction");

                $cod_payment = 0;
                /*if(!empty($rowCod))
                {
                    foreach ($rowCod as $key => $value) {

                        $cod_payment += $value->payment_amt;
                    }
                }*/

                $rowPayPal = $this->common_model->selectByids(array("status" => "1", "gateway" => "paypal", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon), "tbl_transaction");

                $paypal_payment = 0;
                /*if(!empty($rowPayPal))
                {
                    foreach ($rowPayPal as $key => $value) {

                        $paypal_payment += $value->payment_amt;
                    }
                } */   
                $rowStripe = $this->common_model->selectByids(array("status" => "1", "gateway" => "stripe", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon), "tbl_transaction");

                $stripe_payment = 0;
                /*if(!empty($rowStripe))
                {
                    foreach ($rowStripe as $key => $value) {

                        $stripe_payment += $value->payment_amt;
                    }
                }*/

                $rowRazorpay = $this->common_model->selectByids(array("status" => "1", "gateway" => "razorpay", "DATE_FORMAT(FROM_UNIXTIME(`date`), '%c') =" => $mon), "tbl_transaction");

                $razorpay_payment = 0;
                /*if(!empty($rowRazorpay))
                {
                    foreach ($rowRazorpay as $key => $value) {

                        $razorpay_payment += $value->payment_amt;
                    }
                }*/
            }

            $countStr .= "['" . $month . "', " . $total_payment . ", " . $cod_payment . ", " . $paypal_payment . ", " . $stripe_payment . ", " . $razorpay_payment . "], ";

            $countStrOrd .= "['" . $month . "', " . $total_orders . ", " . $pending_order . ", " . $deliver_order . ", " . $cancel_order . "], ";

            if ($total_payment != 0) {
                $count++;
            }

            if ($total_orders != 0) {
                $countOrd++;
            }
        }

        $countStr = rtrim($countStr, ", ");
        $countStrOrd = rtrim($countStrOrd, ", ");

        $data['countStr'] = $countStr;
        $data['countStrOrd'] = $countStrOrd;

        if ($count != 0) {
            $data['no_data_status'] = false;
        } else {
            $data['no_data_status'] = true;
        }

        if ($countOrd != 0) {
            $data['order_no_data_status'] = false;
        } else {
            $data['order_no_data_status'] = true;
        }

        
        $this->template->load('admin/template', 'admin/page/report', $data); // :blush:

    }



}
