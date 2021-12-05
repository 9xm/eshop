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

        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('insert_id',$this->session->userdata('id'));
        
        $query = $this->db->get();
        $row=$query->result();  

        $data['product_cnt'] = count($row);

        $countStr = $countStrOrd = '';

        $no_data_status = false;
        $count = $countOrd = $monthCount = 0;

        $this->template->load('vendor/template', 'vendor/page/dashboard', $data); // :blush:

    }

    // admin profile

    public function profile()
    {

        $this->load->model('Adm_model');

        $data = array();
        $data['page_title'] = 'Admin Profile';
        $data['current_page'] = 'Admin Profile';
        $data['row'] = $this->Adm_model->get_data($this->session->userdata('id'));

        $this->template->load('vendor/template', 'vendor/page/profile', $data); // :blush:

    }

    public function save_profile()
    {
        $data = array();

        $pass = $this->input->post('pass');
        $user_name  = $this->input->post('user_name');
        $user_email    = $this->input->post('user_email');
        $user_phone     = $this->input->post('user_phone');
        $gstno  = $this->input->post('gstno');
        $bankacno   = $this->input->post('bankacno');
        $ifsc   = $this->input->post('ifsc');
        $branchname = $this->input->post('branchname');
        $in_date = date('d-m-Y');

        $gstdoc = '';
        if($_FILES['gstdoc']['name']!='')
        {
            $config['upload_path']    = './upload/vendor';
            $config['allowed_types']  = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe';
            $config['max_size']       = '2000000';
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if($this->upload->do_upload('gstdoc'))
            {   
                $upload_data = $this->upload->data(); 
                $gstdoc=$upload_data['file_name'];
            }
        }
        if($gstdoc == '')
        {
            $gstdoc = $row[0]->gstdoc;
        }
            
        $bankdoc = '';
        if($_FILES['bankdoc']['name']!='')
        {
            $config['upload_path']    = './upload/vendor';
            $config['allowed_types']  = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe';
            $config['max_size']       = '2000000';
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if($this->upload->do_upload('bankdoc'))
            {   
                $upload_data = $this->upload->data(); 
                $bankdoc=$upload_data['file_name'];
            }
        }
        if($bankdoc == '')
        {
            $bankdoc = $row[0]->bankdoc;
        }

        $data = array(
            'user_name'=>$user_name,
            'user_email'=>$user_email,
            'user_phone'=>$user_phone,
            'gstno'=>$gstno,
            'gstdoc'=>$gstdoc,
            'bankacno'=>$bankacno,
            'ifsc'=>$ifsc,
            'branchname'=>$branchname,
            'bankdoc'=>$bankdoc,
        );


        if ($this->input->post('pass') != "") {
            $data = array_merge($data, array("user_password" => md5($this->input->post('pass'))));
        }

        $data = $this->security->xss_clean($data);

        if ($this->common_model->update($data, $this->session->userdata('id'), 'tbl_partner')) {
            $message = array('message' => 'Profile updated...', 'class' => 'success');
            $this->session->set_flashdata('response_msg', $message);
        }

        redirect(base_url() . 'vendor/pages/profile', 'refresh');
    }
    
    public function vendor_commission()
    {

        $data = array();
        $data['page_title'] = 'Vendor Commission';
        $data['current_page'] = 'Vendor Commission';

        if($this->input->get('search_value')!='')
        {
            $keyword=addslashes(trim($this->input->get('search_value')));
        }
        else{
            $keyword='';
        }

        $row = $this->api_model->vendor_commission2('','',$keyword);

        $config = array();
        $config["base_url"] = base_url() . 'vendor/pages/vendor_commission';
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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

        $page = ($page - 1) * $config["per_page"];

        $data["links"] = $this->pagination->create_links();
        $row = $this->api_model->vendor_commission2($config["per_page"], $page,$keyword);

        $data['commission'] = $row;


        $this->template->load('vendor/template', 'vendor/page/vendor_commission', $data); // :blush:

    }

    public function order_summary($order_no)
    {

        
            $data['page_title'] = $this->lang->line('ord_list_lbl');
            $data['current_page'] = $this->lang->line('ord_summary_lbl');

            $this->db->select('*');
            $this->db->from('tbl_order_details');
            $this->db->where('order_unique_id', $order_no); 
            $this->db->limit(1);
            $query = $this->db->get();

            $data['order_data'] = $query->result();


            $this->template->load('vendor/template', 'vendor/page/view_order2', $data); // :blush:
        
    }
}
