<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model
{

    public function user_list($sortBy='id', $sort='ASC', $limit='', $start='', $keyword=''){

      $this->db->select('*');
      $this->db->from('tbl_partner'); 
      if($limit!=''){
        $this->db->limit($limit, $start);
      }
      if($keyword!=''){
        $this->db->like('user_name',$keyword);
        $this->db->or_like('user_email',$keyword);
        $this->db->or_like('user_phone',$keyword);
      }

      $this->db->order_by($sortBy,$sort);
      return $this->db->get()->result();
    }

    public function single_user($id){

      $this->db->select('*');
      $this->db->from('tbl_partner');
      $this->db->where('id', $id); 
      $this->db->limit(1);
      $query = $this->db->get();
      if($query -> num_rows() == 1){                 
          return $query->result();
      }
      else{
          return false;
      }
    }

    public function delete($id){

      $this->db->select('*');
      $this->db->from('tbl_partner');
      $this->db->where('id', $id); 
      $this->db->limit(1);
      $query = $this->db->get();
      if($query -> num_rows() == 1){                 
          $row=$query->result();

          $this->db->where('id', $id);
          $this->db->delete('tbl_partner');
          return 'success';
      }
      else{
          return 'failed';
      }
      
    }

    //-- check valid user
    function validate_user(){            
        
        $this->db->select('*');
        $this->db->from('tbl_partner');
        $this->db->where('user_email', $this->input->post('email')); 
        $this->db->where('user_password', md5($this->input->post('password')));
        $this->db->limit(1);
        $query = $this->db->get();   
        
        if($query->num_rows() == 1){                 
           return $query->result();
        }
        else{
            return false;
        }
    }

}