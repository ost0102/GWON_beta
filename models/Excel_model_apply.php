<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Excel_model_apply extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    //항목 정보 가져오기
    function get_campaign_info($w_num){
      $i=0;
      $ret = array();
      $this->db->from('gwon_form_set_info');
      $this->db->where('w_num',$w_num);
      $this->db->order_by('key','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          $ret[$i]['w_num'] = $row['w_num'];
          $ret[$i]['key'] = $row['key'];
          $ret[$i]['item_id'] = $row['item_id'];
          $ret[$i]['display_name'] = $row['display_name'];
          $ret[$i]['field_type'] = $row['field_type'];
          $ret[$i]['options'] = $row['options'];
          $ret[$i]['use'] = $row['use'];
          $ret[$i]['memo'] = $row['memo'];
          $ret[$i]['date'] = $row['date'];
          $i++;
        }
      }
      return  $ret;
    }

    function  get_form_set_info($w_num){
      $i=0;
      $this->db->from('gwon_form_set_info');
      $this->db->where('w_num',$w_num);
      $this->db->order_by('key','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        $ret = array();
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          $ret[$i]['w_num'] = $row['w_num'];
          $ret[$i]['key'] = $row['key'];
          $ret[$i]['item_id'] = $row['item_id'];
          $ret[$i]['display_name'] = $row['display_name'];
          $ret[$i]['field_type'] = $row['field_type'];
          $ret[$i]['options'] = $row['options'];
          $ret[$i]['use'] = $row['use'];
          $ret[$i]['memo'] = $row['memo'];
          $ret[$i]['date'] = $row['date'];
          $i++;
        }
      }else{
        $ret = '';
      }
      return  $ret;
    
   }

    //항목 정보 가져오기
    function get_form_apply_info($w_num){
      $i=0;
      $ret = array();
      $this->db->from('gwon_form_user_info');
      $this->db->where('w_num',$w_num);
      $this->db->group_by('user_id');
      $this->db->order_by('date','desc');
      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          //$ret[$i]['w_num'] = $row['w_num'];
          $user_id = $row['user_id'];

          $this->db->from('gwon_users');
          $this->db->where('id',$user_id);
          $this->db->order_by('id','ASC');
          $this->db->limit(1);  
          $query2=$this->db->get();
          if ($query2->num_rows()){
            foreach ($query2->result_array() as $row1)
            {
              $id_secur = $row1['id_secur'];
              $username = $row1['username'];
            }
          }else{
            $id_secur= '';
            $username= '';
          }
          $date ='';

          $this->db->from('gwon_form_set_info');
          $this->db->where('w_num',$w_num);
          $this->db->order_by('key','ASC');
          $query3=$this->db->get();
          if ($query3->num_rows()){
            $num = 0;
            foreach ($query3->result_array() as $row3)
            {
              $w_num = $row3['w_num'];
              $key = $row3['key'];
              $field_type = $row3['field_type'];

              $ret[$i][$num]['w_num'] = $row3['w_num'];
              $ret[$i][$num]['key'] = $row3['key'];
              $ret[$i][$num]['item_id'] = $row3['item_id'];
              $ret[$i][$num]['display_name'] = $row3['display_name'];
              $ret[$i][$num]['field_type'] = $row3['field_type'];
              $ret[$i][$num]['id_secur'] = $id_secur;
              $ret[$i][$num]['username'] = $username;

              $this->db->from('gwon_form_user_info');
              $this->db->where('w_num',$w_num);
              $this->db->where('user_id',$user_id);
              $this->db->where('key',$key);
              $this->db->order_by('key','ASC');
              $this->db->limit(1);  
              $query4=$this->db->get();
              if ($query4->num_rows()){
                foreach ($query4->result_array() as $row4)
                {
                  $ret[$i][$num]['item_value'] = $row4['item_value'];
                  $ret[$i][$num]['user_id'] = $row4['user_id'];
                  $ret[$i][$num]['date'] = $row4['date'];
                  $date = $row4['date'];
                }
              }else{
                  $ret[$i][$num]['item_value'] = '';
                  $ret[$i][$num]['user_id'] = $user_id;
                  $ret[$i][$num]['date'] = $date;
              }
              //서명정보 가져오기
              $this->db->from('gwon_form_user_signature');
              $this->db->where('w_num',$w_num);
              $this->db->where('user_id',$user_id);
              $this->db->order_by('w_num','ASC');
              $this->db->limit(1);  
              $query5=$this->db->get();
              if ($query5->num_rows()){
                foreach ($query5->result_array() as $row5)
                {
                  $sig = $row5['sig'];
                }
              }else{
                $sig= '';
              }

              $ret[$i][$num]['sig'] = $sig;
              $num++;
            }
            $i++;
          }
        }
      }else{
        $ret = 0;
      }
      return  $ret;
    }

    function  get_form_user_info_list_final($w_num){
      $i=0;
      $ret = array();
      $this->db->from('gwon_form_user_signature');
      $this->db->where('w_num',$w_num);
      $this->db->order_by('date','asc');
      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          $w_num= $row['w_num'];
          $sig= $row['sig'];
          $form_set= $row['form_set'];
          $form_data= $row['form_data'];
          $user_id= $row['user_id'];
          $date= $row['date'];

          $this->db->from('gwon_users');
          $this->db->where('id',$user_id);
          $this->db->order_by('id','ASC');
          $this->db->limit(1);  
          $query2=$this->db->get();
          if ($query2->num_rows()){
            foreach ($query2->result_array() as $row1)
            {
              $id_secur = $row1['id_secur'];
              $username = $row1['username'];
            }
          }else{
            $id_secur= '';
            $username= '';
          }

          //입력항목 총 합계
          $this->db->where('w_num', $w_num);
          $this->db->where('user_id',$user_id);
          $this->db->from('gwon_form_user_info');
          $total_user_insert_data = $this->db->count_all_results();


            $ret[$i]['w_num'] = $w_num;
            $ret[$i]['user_id'] = $user_id;
            $ret[$i]['id_secur'] = $id_secur;
            $ret[$i]['username'] = $username;
            $ret[$i]['form_set'] = $form_set;
            $ret[$i]['form_data'] = $form_data;
            $ret[$i]['total_user_insert_data'] = $total_user_insert_data;
            $ret[$i]['sig'] = $sig;
            $ret[$i]['date'] = $date;
            $i++;

        }
      }else{
        $ret = 0;
      }
      return  $ret;
   }
    
}
