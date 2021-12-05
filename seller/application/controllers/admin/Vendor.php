<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor extends CI_Controller {

    private $redirectUrl=NULL;

    public function __construct(){
        parent::__construct();
        check_login_user();
        $this->load->helper('image'); 
        $this->load->model('common_model');
        $this->load->model('Vendor_model');
        $this->load->model('Product_model');
        $this->load->model('Api_model','api_model');

        $this->load->library('user_agent');

        $this->load->library("CompressImage");

        $currentURL = current_url();
        $params   = $_SERVER['QUERY_STRING'];
        $this->redirectUrl = (!empty($params)) ? $currentURL . '?' . $params : $currentURL;
    }

    function index()
    {
        $data = array();
        $data['page_title'] = 'Vendor';
        $data['current_page'] = 'Vendor';

        if($this->input->get('search_value')!='')
        {
            $keyword=addslashes(trim($this->input->get('search_value')));
        }
        else{
            $keyword='';
        }

        $row=$this->Vendor_model->user_list('id', 'DESC', '', '', $keyword);

        $config = array();
        $config["base_url"] = base_url() . 'admin/vendor';
        $config["total_rows"] = count($row);
        $config["per_page"] = 12;

        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';

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

        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;

        $page=($page-1) * $config["per_page"];

        $data["links"] = $this->pagination->create_links();
        $data['user_list'] = $this->Vendor_model->user_list('id', 'DESC', $config["per_page"], $page, $keyword);
        
        $data["redirectUrl"] = $this->redirectUrl;
        
        $this->template->load('admin/template', 'admin/page/vendor', $data); // :blush:
    } 

    

    public function user_form()
    {
        $data = array();

        $id =  $this->uri->segment(4);

        $data['page_title'] = 'Vendor';
        if($id=='')
        {
            $data['current_page'] = 'Vendor';
        }
        else{
            $data['users'] = $this->Vendor_model->single_user($id);

            $data['current_page'] = $this->lang->line('edit_user_lbl');
        }
        $this->template->load('admin/template', 'admin/page/user_form', $data); // :blush:
    }

    public function add()
    {
        $this->form_validation->set_rules('user_name', $this->lang->line('name_place_lbl'), 'trim|required');
        $this->form_validation->set_rules('user_email', $this->lang->line('email_place_lbl'), 'trim|required');
        $this->form_validation->set_rules('user_phone', $this->lang->line('phone_no_place_lbl'), 'trim|required');
        $this->form_validation->set_rules('user_password', $this->lang->line('password_place_lbl'), 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $data['page_title'] = 'Vendor';
            $data['current_page'] = 'Add Vendor';
            $messge = array('message' => $this->lang->line('input_required'),'class' => 'error');
            $this->session->set_flashdata('response_msg', $messge);
            $this->template->load('admin/template', 'admin/page/vendor_form', $data);
            
        }
        else
        {

            $row_usr=$this->common_model->selectByids(array('user_email' => $this->input->post('user_email')), 'tbl_partner');

            //-- if valid
            if(empty($row_usr)){
                $this->load->helper("date");

                $data = array(
                    'user_name'  => $this->input->post('user_name'),
                    'user_email'  => $this->input->post('user_email'),
                    'user_phone'  => $this->input->post('user_phone'),
                    'user_password'  => md5($this->input->post('user_password')),
                    'created_at'  =>  strtotime(date('d-m-Y h:i:s A'))
                );

                $data = $this->security->xss_clean($data);

                if($this->common_model->insert($data, 'tbl_partner')){
                    $messge = array('message' => $this->lang->line('add_msg'),'class' => 'success');
                    $this->session->set_flashdata('response_msg', $messge);

                }
                else{
                    $messge = array('message' => $this->lang->line('add_error'),'class' => 'error');
                    $this->session->set_flashdata('response_msg', $messge);
                }
            }
            else{
                $messge = array('message' => $this->lang->line('email_exist_error'),'class' => 'error');
                $this->session->set_flashdata('response_msg', $messge);
            }

            
            redirect(base_url() . 'admin/vendor/add', 'refresh');
            
        }
    }
    
    public function edit($id)
    {
        $this->form_validation->set_rules('user_name', $this->lang->line('name_place_lbl'), 'trim|required');
        $this->form_validation->set_rules('user_email', $this->lang->line('email_place_lbl'), 'trim|required');
        $this->form_validation->set_rules('user_phone', $this->lang->line('phone_no_place_lbl'), 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $data['page_title'] = 'Vendor';
            $data['users'] = $this->Vendor_model->single_user($id);

            $data['current_page'] = 'Edit Vendor';

            $messge = array('message' => $this->lang->line('input_required'),'class' => 'error');
            $this->session->set_flashdata('response_msg', $messge);
                
            
            $this->template->load('admin/template', 'admin/page/vendor_form', $data);
        }
        else
        {

            $data = $this->Vendor_model->single_user($id);

            $row_usr=$this->common_model->selectByids(array('id <>' => $id,'user_email' => $this->input->post('user_email')), 'tbl_partner');

            if(empty($row_usr))
            {
                $this->load->helper("date");

                $password='';
                if($this->input->post('user_password')!=''){
                    $password=md5($this->input->post('user_password'));
                }
                else{
                    $password=$data[0]->user_password;
                }

                $data = array(
                    'user_name'  => $this->input->post('user_name'),
                    'user_email'  => $this->input->post('user_email'),
                    'user_phone'  => $this->input->post('user_phone'),
                    'user_password'  => $password
                );

                $data = $this->security->xss_clean($data);

                if($this->common_model->update($data, $id,'tbl_partner')){
                    $messge = array('message' => $this->lang->line('update_msg'),'class' => 'success');
                    $this->session->set_flashdata('response_msg', $messge);
                }
                else{
                    $messge = array('message' => $this->lang->line('update_error'),'class' => 'error');
                    $this->session->set_flashdata('response_msg', $messge);
                }
            }
            else
            {
                $messge = array('message' => $this->lang->line('email_exist_error'),'class' => 'error');
                $this->session->set_flashdata('response_msg', $messge);
            }

            if(isset($_GET['redirect'])){
                redirect($redirect, 'refresh');
            }
            else{
                redirect(base_url() . 'admin/vendor/edit/'.$id, 'refresh');
            }
        }
        
    }

    //-- update users info
    

    
    //-- active user
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id,'tbl_partner');
        $response = array('message' => $this->lang->line('enable_msg'),'status' => '1','class' => 'success');
                            
        echo json_encode($response);
        exit;
    }

    //-- deactive user
    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id,'tbl_partner');
        $response = array('message' => $this->lang->line('disable_msg'),'status' => '1','class' => 'success');
                            
        echo json_encode($response);
        exit;
    }

    //-- delete user
    public function delete($id)
    {
        echo $this->Vendor_model->delete($id);
    }

    public function profile()
    {
        $id =  $this->uri->segment(4);

        $data['page_title'] = 'Vendor';
        
        $data['user'] = $this->Vendor_model->single_user($id);

        $data['current_page'] = 'My Profile';

        $this->template->load('admin/template', 'admin/page/vendor_profile', $data); // :blush
    }   

    public function get_status_title($id){
        return $this->common_model->selectByidParam($id,'tbl_status_title','title');
    }
    public function save_profile()
    {

        $data = array();

        //$pass = $this->input->post('pass');
        $user_name  = $this->input->post('user_name');
        //$user_email    = $this->input->post('user_email');
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
            //'user_email'=>$user_email,
            'user_phone'=>$user_phone,
            'gstno'=>$gstno,
            'gstdoc'=>$gstdoc,
            'bankacno'=>$bankacno,
            'ifsc'=>$ifsc,
            'branchname'=>$branchname,
            'bankdoc'=>$bankdoc,
        );


      /*  if ($this->input->post('pass') != "") {
            $data = array_merge($data, array("user_password" => md5($this->input->post('pass'))));
        }*/

        $data = $this->security->xss_clean($data);

        if ($this->common_model->update($data, $this->session->userdata('id'), 'tbl_partner')) {
            $message = array('message' => 'Profile updated...', 'class' => 'success');
            $this->session->set_flashdata('response_msg', $message);
        }

        redirect(base_url('admin/profile'), 'refresh');
       // redirect(base_url() . 'vendor/pages/profile', 'refresh');
    }
    
    

}