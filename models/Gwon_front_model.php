<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  Inputs
 *
 * This model represents user recommand URL data. It operates the following tables:
 * - ithnkso_short_data
 *
 * - ithnkso_short_user
 *
 *
 */
class Gwon_front_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    // 카테고리 정보 가져오기
   function  get_sg_cate_info(){
    //프로젝트에 연결된 정보 URL이 있는지 확인
    $i=0;
    $ret=array();
    $this->db->from('project_category');
    $this->db->order_by('cate_id','ASC');
    $query1=$this->db->get();
    if ($query1->num_rows()){
        foreach ($query1->result_array() as $row1)
        {
          //print_r($row1);
          $ret[$i]['cate_id'] = $row1['cate_id'];
          $ret[$i]['cate_secur'] = $row1['cate_secur'];
          $ret[$i]['field_name'] = $row1['field_name'];
          $ret[$i]['field_group'] = $row1['field_group'];
          $ret[$i]['admin_check'] = $row1['admin_check'];
          $i++;
        }
      }
      return  $ret;

   }



    //campaign_wait 정보 가져오기
    function  get_campaign_wait_page_secur($page_secur){
        $this->db->from('gwon_campaign_wait');
        $this->db->where('gwon_campaign_wait.page_secur',$page_secur);
        $this->db->order_by('w_num','ASC');
        $this->db->limit(1);  
        $query1=$this->db->get();
        if ($query1->num_rows()){
            foreach ($query1->result_array() as $row)
            {
                //print_r($row1);
                $ret['w_num'] = $row['w_num'];
                $ret['page_secur'] = $row['page_secur'];
                $ret['title'] = $row['title'];
                $ret['summary'] = $row['summary'];
                $ret['con_txt'] = $row['con_txt'];
                $ret['apply_txt'] = $row['apply_txt'];
                $ret['logo'] = $row['logo'];
                $ret['domain'] = $row['domain'];
                $ret['contact'] = $row['contact'];
                $ret['cate_id'] = $row['cate_id'];
                $ret['start_date'] = $row['start_date'];
                $ret['end_date'] = $row['end_date'];
                $ret['start_time'] = $row['start_time'];
                $ret['end_time'] = $row['end_time'];
                $ret['file_attachment'] = $row['file_attachment'];
                $ret['css'] = $row['css'];
                $ret['css_m'] = $row['css_m'];
                $ret['javascript'] = $row['javascript'];
                $ret['javascript_m'] = $row['javascript_m'];
                $ret['html_type'] = $row['html_type'];


            }
        }
        return  $ret;
    }

    //공고사업 정보가져오기
    function  get_campaign_act_page_secur($w_num){
        $this->db->from('gwon_campaign_act');
        $this->db->where('w_num',$w_num);
        $this->db->order_by('w_num','ASC');
        $this->db->limit(1);  
        $query1=$this->db->get();
        if ($query1->num_rows()){
            foreach ($query1->result_array() as $row)
            {
                //print_r($row1);
                $ret['w_num'] = $row['w_num'];
                $ret['page_secur'] = $row['page_secur'];
                $ret['title'] = $row['title'];
                $ret['summary'] = $row['summary'];
                $ret['con_txt'] = $row['con_txt'];
                $ret['apply_txt'] = $row['apply_txt'];
                $ret['logo'] = $row['logo'];
                $ret['domain'] = $row['domain'];
                $ret['contact'] = $row['contact'];
                $ret['cate_id'] = $row['cate_id'];
                $ret['start_date'] = $row['start_date'];
                $ret['end_date'] = $row['end_date'];
                $ret['start_time'] = $row['start_time'];
                $ret['end_time'] = $row['end_time'];
                $ret['file_attachment'] = $row['file_attachment'];
                $ret['css'] = $row['css'];
                $ret['css_m'] = $row['css_m'];
                $ret['javascript'] = $row['javascript'];
                $ret['javascript_m'] = $row['javascript_m'];
                $ret['html_type'] = $row['html_type'];


            }
        }
        return  $ret;
    }
    //해당 프로젝트와 연관된 URL 정보 가져오기
   function  check_project_access($w_num,$user){
      $this->db->from('gwon_project_member');
      $this->db->where('w_num',$w_num);
      $this->db->where('user_id',$user);
      $this->db->where('aceept_state','2');
      $this->db->order_by('date','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        $ret= true;
      }else{
        $ret= false;
      }
      return  $ret;
    
   }


   //캠페인을같이 관리하는프로젝트 멤버 리스트
   function  check_project_member($w_num, $user_id){
      $i=0;
      $this->db->from('gwon_project_member');
      $this->db->join('gwon_users', 'gwon_users.id = gwon_project_member.user_id');
      $this->db->where('gwon_project_member.w_num',$w_num);
      if($user_id!=''){
        $this->db->where('gwon_project_member.user_id',$user_id);
      }
      $this->db->where('gwon_project_member.aceept_state','2');
      $this->db->order_by('date','ASC');
      $query1=$this->db->get();
      if ($query1->num_rows()){
        $ret = array();
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          $ret['team_member'][$i]['user_id'] = $row['user_id'];
          $ret['team_member'][$i]['position'] = $row['position'];
          $ret['team_member'][$i]['username'] = $row['username'];
          $i++;
        }
      }else{
        $ret = '';
      }
      return  $ret;
    
   }


   //캠페인을같이 관리하는프로젝트 멤버 리스트
   function  check_project_team($w_num){
      $this->db->from('gwon_project_team');
      $this->db->join('gwon_team_info', 'gwon_team_info.t_id = gwon_project_team.t_id');
      $this->db->where('w_num',$w_num);
      $this->db->where('aceept_state','2');
      $this->db->order_by('date','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        $i=0;
        $ret = array();
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          $ret['team_info'][$i]['t_id'] = $row['t_id'];
          $ret['team_info'][$i]['position'] = $row['position'];
          $ret['team_info'][$i]['t_name'] = $row['t_name'];
          $ret['team_info'][$i]['t_script'] = $row['t_script'];
          $i++;
        }
      }else{
        $ret = '';
      }
      return  $ret;
    
   }
    //해당 프로젝트와 연관된 URL 정보 가져오기
   function  get_form_set_info($w_num){
      $i=0;
      $ret = array();
      $this->db->from('gwon_form_set_info');
      $this->db->where('w_num',$w_num);
      $this->db->order_by('key','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          /*$ret['form_set_info'][$i]['w_num'] = $row['w_num'];
          $ret['form_set_info'][$i]['key'] = $row['key'];
          $ret['form_set_info'][$i]['item_id'] = $row['item_id'];
          $ret['form_set_info'][$i]['display_name'] = $row['display_name'];
          $ret['form_set_info'][$i]['field_type'] = $row['field_type'];
          $ret['form_set_info'][$i]['options'] = $row['options'];
          $ret['form_set_info'][$i]['use'] = $row['use'];
          $ret['form_set_info'][$i]['memo'] = $row['memo'];
          $ret['form_set_info'][$i]['date'] = $row['date'];
          */

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
    //지원 사용자 정보 가져오기
   function  get_user_info($user){
      $ret = array();
      $this->db->from('gwon_users');
      $this->db->where('id',$user);
      $this->db->limit(1);  
      $this->db->order_by('id','ASC');
      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          /*$ret['form_set_info'][$i]['w_num'] = $row['w_num'];
          $ret['form_set_info'][$i]['key'] = $row['key'];
          $ret['form_set_info'][$i]['item_id'] = $row['item_id'];
          $ret['form_set_info'][$i]['display_name'] = $row['display_name'];
          $ret['form_set_info'][$i]['field_type'] = $row['field_type'];
          $ret['form_set_info'][$i]['options'] = $row['options'];
          $ret['form_set_info'][$i]['use'] = $row['use'];
          $ret['form_set_info'][$i]['memo'] = $row['memo'];
          $ret['form_set_info'][$i]['date'] = $row['date'];
          */

          $ret['user_id'] = $row['id'];
          $ret['id_secur'] = $row['id_secur'];
          $ret['username'] = $row['username'];
          $ret['email'] = $row['email'];
          $ret['phone'] = $row['phone'];
          $ret['user_type'] = $row['user_type'];
          $ret['mail_list'] = $row['mail_list'];
          $ret['u_group'] = $row['u_group'];
          $ret['photo'] = $row['photo'];
          $ret['description'] = $row['description'];
          $ret['ip_address'] = $row['ip_address'];
          $ret['user_agent'] = $row['user_agent'];

        }
      }
      return  $ret;
   }

   //지원 사용자 정보 가져오기2 
   function  get_user_info_u_secure($user_secur){
      $ret = array();
      $this->db->from('gwon_users');
      $this->db->where('id_secur',$user_secur);
      $this->db->limit(1);  
      $this->db->order_by('id','ASC');
      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          /*$ret['form_set_info'][$i]['w_num'] = $row['w_num'];
          $ret['form_set_info'][$i]['key'] = $row['key'];
          $ret['form_set_info'][$i]['item_id'] = $row['item_id'];
          $ret['form_set_info'][$i]['display_name'] = $row['display_name'];
          $ret['form_set_info'][$i]['field_type'] = $row['field_type'];
          $ret['form_set_info'][$i]['options'] = $row['options'];
          $ret['form_set_info'][$i]['use'] = $row['use'];
          $ret['form_set_info'][$i]['memo'] = $row['memo'];
          $ret['form_set_info'][$i]['date'] = $row['date'];
          */

          $ret['user_id'] = $row['id'];
          $ret['id_secur'] = $row['id_secur'];
          $ret['username'] = $row['username'];
          $ret['email'] = $row['email'];
          $ret['phone'] = $row['phone'];
          $ret['user_type'] = $row['user_type'];
          $ret['mail_list'] = $row['mail_list'];
          $ret['u_group'] = $row['u_group'];
          $ret['photo'] = $row['photo'];
          $ret['description'] = $row['description'];
          $ret['ip_address'] = $row['ip_address'];
          $ret['user_agent'] = $row['user_agent'];

        }
      }
      return  $ret;
   }


    //해당 프로젝트와 연관된 URL 정보 가져오기
   function  get_form_set_info_user($w_num,$start_key,$last_key,$user){
      $i=0;
      $ret = array();
      $this->db->from('gwon_form_set_info');
      $this->db->where('w_num',$w_num);
      if($start_key!=''){
        $this->db->where('key >=',$start_key);
      }
      if($last_key!=''){
        $this->db->where('key <=',$last_key);
      }
      $this->db->order_by('key','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          /*$ret['form_set_info'][$i]['w_num'] = $row['w_num'];
          $ret['form_set_info'][$i]['key'] = $row['key'];
          $ret['form_set_info'][$i]['item_id'] = $row['item_id'];
          $ret['form_set_info'][$i]['display_name'] = $row['display_name'];
          $ret['form_set_info'][$i]['field_type'] = $row['field_type'];
          $ret['form_set_info'][$i]['options'] = $row['options'];
          $ret['form_set_info'][$i]['use'] = $row['use'];
          $ret['form_set_info'][$i]['memo'] = $row['memo'];
          $ret['form_set_info'][$i]['date'] = $row['date'];
          */

          $ret[$i]['w_num'] = $row['w_num'];
          $ret[$i]['key'] = $row['key'];
          $ret[$i]['item_id'] = $row['item_id'];
          $key = $row['key'];
          $item_id = $row['item_id'];
          $ret[$i]['display_name'] = $row['display_name'];
          $ret[$i]['field_type'] = $row['field_type'];
          $ret[$i]['options'] = $row['options'];
          $ret[$i]['use'] = $row['use'];
          $ret[$i]['memo'] = $row['memo'];
          $ret[$i]['date'] = $row['date'];

          $this->db->from('gwon_form_user_info');
          $this->db->where('w_num',$w_num);
          $this->db->where('user_id',$user);
          $this->db->where('item_id',$item_id);
          $this->db->order_by('item_id','ASC');
          $this->db->limit(1);  
          $query2=$this->db->get();
          if ($query2->num_rows()){
            foreach ($query2->result_array() as $row1)
            {
              $ret[$i]['item_value'] = $row1['item_value'];
            }
          }else{
            $ret[$i]['item_value'] = '';
          }
          $i++;
        }
      }
      return  $ret;
   }


   //해당 프로젝트와 연관된 URL 정보 가져오기
   function  check_project_link($w_num){
      $i=0;
      $this->db->from('linked_project');
      $this->db->where('w_num',$w_num);
      $this->db->where('expiration',1);
      $this->db->order_by('date','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){

        $ret = array();
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          $ret[$i]['link_title'] = $row['link_title'];
          $ret[$i]['link_url'] = $row['link_url'];
          $ret[$i]['link_txt'] = $row['link_txt'];
          $ret[$i]['in_out'] = $row['in_out'];
          $i++;
        }
      }else{
        $ret='';
      }
      return  $ret;
    
   }

   //해당 프로젝트의 양식 정보 가져오기
   function  get_formset_info($w_num){
      $i=0;
      $ret = array();
      $this->db->from('gwon_form_set_info');
      $this->db->where('w_num',$w_num);
      $this->db->order_by('key','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        
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
      }
      return  $ret;
    
   }

   //사용자 입력정보 배열로 가져오기 - 최정 정보 저장용
   function  get_form_user_info2($w_num,$user){
      $i=0;
      $ret = array();
      $this->db->from('gwon_form_user_info');
      $this->db->where('w_num',$w_num);
      $this->db->where('user_id',$user);
      $this->db->order_by('key','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          $ret[$i]['w_num'] = $row['w_num'];
          $ret[$i]['key'] = $row['key'];
          $ret[$i]['display_name'] = $row['display_name'];
          $ret[$i]['item_id'] = $row['item_id'];
          $ret[$i]['item_value'] = $row['item_value'];
          $ret[$i]['user_id'] = $row['user_id'];
          $ret[$i]['date'] = $row['date'];
          $i++;
        }
      }
      return  $ret;
    
   }

   //작성중인 접수자 리스트 가져오기
   function  get_yet_user_info($w_num){
      $i=0;
      $ret = array();
      //print_r($row1);
      $this->db->from('gwon_form_user_info');
      $this->db->join('gwon_users', 'gwon_form_user_info.user_id = gwon_users.id');
      $this->db->where('gwon_form_user_info.w_num',$w_num);
      $this->db->group_by('gwon_form_user_info.user_id');
      $this->db->order_by('gwon_form_user_info.date','desc');
      $query1=$this->db->get();
      if ($query1->num_rows()){
        $num = 0;
        foreach ($query1->result_array() as $row)
        {
            $user_id = $row['id'];
            $email = $row['email'];
            $id_secur = $row['id_secur'];
            $username = $row['username'];
            $date = $row['date'];

            $this->db->where('item_value !=', "");
            $this->db->where('w_num', $w_num);
            $this->db->where('user_id', $user_id);
            $this->db->from('gwon_form_user_info');
            $count_data  = $this->db->count_all_results();

            $this->db->from('gwon_form_user_signature');
            $this->db->where('w_num',$w_num);
            $this->db->where('user_id',$user_id);
            $this->db->order_by('date','ASC');
            $this->db->limit(1);  
            $query2=$this->db->get();
           if ($query2->num_rows()){
              foreach ($query2->result_array() as $row2)
              {
                $sig = $row2['sig'];
                $date = $row2['date'];
              }
            }else{
              $sig= '';
              $ret[$i]['w_num'] = $w_num;
              $ret[$i]['id_secur'] = $id_secur;
              $ret[$i]['user_id'] = $user_id;
              $ret[$i]['email'] = $email;
              $ret[$i]['username'] = $username;
              $ret[$i]['total_user_insert_data'] = $count_data;
              $ret[$i]['sig'] = $sig;
              $ret[$i]['date'] = $date;
              $i++;
            }
        }
      }else{
        $ret = 0;
      }
      return  $ret;
    
   }

   //서명 정보 가져오기
   function  get_signature($w_num,$user){
    //프로젝트에 연결된 정보 URL이 있는지 확인
    $ret='';
    $this->db->from('gwon_form_user_signature');
    $this->db->where('w_num',$w_num);
    $this->db->where('user_id',$user);
    $this->db->order_by('w_num','desc');
    $this->db->limit(1);
    $query1=$this->db->get();
    if ($query1->num_rows()){
        foreach ($query1->result_array() as $row1)
        {
          //print_r($row1);
          $ret = $row1['sig'];
        }
      }
      return  $ret;

   }

   //생성된 양식의 사용자 입력정보 가져오기
   function  get_form_user_info($w_num,$u_id){
      $i=0;
      if($u_id==''){  
        $start='';
        $u_id='';
      }else if($u_id=='start'){  
        $start='start';
        $u_id='';
      }else if($u_id=='all'){  
        $start='all';
        $u_id='';
      }else{
        $start='no';
      }
      $ret = array();
      $this->db->from('gwon_form_user_info');
      $this->db->where('w_num',$w_num);
      if($u_id!=''){  
        $this->db->where('user_id',$u_id);
      }
      $this->db->group_by('user_id');
      $this->db->order_by('date','desc');
      if($start=='start'){  
        $this->db->limit(5); 
      }
      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          $user_id= $row['user_id'];

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

   //접수 배제한 사용자 입력정보 가져오기
   function  get_form_user_info_reject($w_num,$u_id){
      $i=0;
      if($u_id==''){  
        $start='';
        $u_id='';
      }else if($u_id=='start'){  
        $start='start';
        $u_id='';
      }else if($u_id=='all'){  
        $start='all';
        $u_id='';
      }else{
        $start='no';
      }
      $ret = array();
      $this->db->from('gwon_form_out_info');
      $this->db->where('w_num',$w_num);
      if($u_id!=''){  
        $this->db->where('user_id',$u_id);
      }
      $this->db->group_by('user_id');
      $this->db->order_by('date','desc');
      if($start=='start'){  
        $this->db->limit(5); 
      }
      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          $user_id= $row['user_id'];

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

              $this->db->from('gwon_form_out_info');
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
              $this->db->from('gwon_form_out_signature');
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

   //접수 리스트 - 타입별
   function  get_form_user_info_type_list($w_num,$type){
      $i=0;
      $ret = array();

      /*
      1. 항목, 입력수, 등록일정보 가져와야함.
      2. all일경우 
      */

      if($type=='all'){  
        //전체 리스트
        $this->db->from('gwon_form_user_info');
        $this->db->join('gwon_users', 'gwon_form_user_info.user_id = gwon_users.id');
        $this->db->where('gwon_form_user_info.w_num',$w_num);
        $this->db->group_by('gwon_form_user_info.user_id');
        $this->db->order_by('gwon_form_user_info.date','desc');
        $query1=$this->db->get();
        if ($query1->num_rows()){
          $num = 0;
          foreach ($query1->result_array() as $row)
          {
              $user_id = $row['id'];
              $id_secur = $row['id_secur'];
              $username = $row['username'];
              $date = $row['date'];

              //총합
              //$this->db->where('key', 1);
              $this->db->where('item_value !=', "");
              $this->db->where('w_num', $w_num);
              $this->db->where('user_id', $user_id);
              $this->db->from('gwon_form_user_info');
              $count_data  = $this->db->count_all_results();


              $this->db->from('gwon_form_user_signature');
              $this->db->where('w_num',$w_num);
              $this->db->where('user_id',$user_id);
              $this->db->order_by('date','ASC');
              $this->db->limit(1);  
              $query2=$this->db->get();
             if ($query2->num_rows()){
                foreach ($query2->result_array() as $row2)
                {
                  $sig = $row2['sig'];
                  $date = $row2['date'];
                }
              }else{
                $sig= '';
              }


              $ret[$i]['w_num'] = $w_num;
              $ret[$i]['id_secur'] = $id_secur;
              $ret[$i]['user_id'] = $user_id;
              $ret[$i]['username'] = $username;
              $ret[$i]['total_user_insert_data'] = $count_data;
              $ret[$i]['sig'] = $sig;
              $ret[$i]['date'] = $date;

              $i++;
          }
        }else{
          $ret = 0;
        }
      }else if($type=='done'){  
        //작성완료
        $this->db->from('gwon_form_user_info');
        $this->db->join('gwon_users', 'gwon_form_user_info.user_id = gwon_users.id');
        $this->db->where('gwon_form_user_info.w_num',$w_num);
        $this->db->group_by('gwon_form_user_info.user_id');
        $this->db->order_by('gwon_form_user_info.date','desc');
        $query1=$this->db->get();
        if ($query1->num_rows()){
          $num = 0;
          foreach ($query1->result_array() as $row)
          {
              $user_id = $row['id'];
              $id_secur = $row['id_secur'];
              $username = $row['username'];
              $date = $row['date'];

              //총합
              //$this->db->where('key', 1);
              $this->db->where('item_value !=', "");
              $this->db->where('w_num', $w_num);
              $this->db->where('user_id', $user_id);
              $this->db->from('gwon_form_user_info');
              $count_data  = $this->db->count_all_results();

              
              $this->db->from('gwon_form_user_signature');
              $this->db->where('w_num',$w_num);
              $this->db->where('user_id',$user_id);
              $this->db->order_by('date','ASC');
              $this->db->limit(1);  
              $query2=$this->db->get();
             if ($query2->num_rows()){
                foreach ($query2->result_array() as $row2)
                {
                  $sig = $row2['sig'];
                  $date = $row2['date'];

                  $ret[$i]['w_num'] = $w_num;
                  $ret[$i]['id_secur'] = $id_secur;
                  $ret[$i]['user_id'] = $user_id;
                  $ret[$i]['username'] = $username;
                  $ret[$i]['total_user_insert_data'] = $count_data;
                  $ret[$i]['sig'] = $sig;
                  $ret[$i]['date'] = $date;

                  $i++;
                }
              }else{
                $sig= '';
              }
          }
        }else{
          $ret = 0;
        }
      }else if($type=='yet'){  
        //작성중
        $this->db->from('gwon_form_user_info');
        $this->db->join('gwon_users', 'gwon_form_user_info.user_id = gwon_users.id');
        $this->db->where('gwon_form_user_info.w_num',$w_num);
        $this->db->group_by('gwon_form_user_info.user_id');
        $this->db->order_by('gwon_form_user_info.date','desc');
        $query1=$this->db->get();
        if ($query1->num_rows()){
          $num = 0;
          foreach ($query1->result_array() as $row)
          {
              $user_id = $row['id'];
              $id_secur = $row['id_secur'];
              $username = $row['username'];
              $date = $row['date'];

              //총합
              //$this->db->where('key', 1);
              $this->db->where('item_value !=', "");
              $this->db->where('w_num', $w_num);
              $this->db->where('user_id', $user_id);
              $this->db->from('gwon_form_user_info');
              $count_data  = $this->db->count_all_results();


              $this->db->from('gwon_form_user_signature');
              $this->db->where('w_num',$w_num);
              $this->db->where('user_id',$user_id);
              $this->db->order_by('date','ASC');
              $this->db->limit(1);  
              $query2=$this->db->get();
             if ($query2->num_rows()){
                foreach ($query2->result_array() as $row2)
                {
                  $sig = $row2['sig'];
                  $date = $row2['date'];
                }
              }else{
                $sig= '';
                $ret[$i]['w_num'] = $w_num;
                $ret[$i]['id_secur'] = $id_secur;
                $ret[$i]['user_id'] = $user_id;
                $ret[$i]['username'] = $username;
                $ret[$i]['total_user_insert_data'] = $count_data;
                $ret[$i]['sig'] = $sig;
                $ret[$i]['date'] = $date;
                $i++;
              }
          }
        }else{
          $ret = 0;
        }
      }else if($type=='reject'){  
        //작성중
        $this->db->from('gwon_form_out_info');
        $this->db->join('gwon_users', 'gwon_form_out_info.user_id = gwon_users.id');
        $this->db->where('gwon_form_out_info.w_num',$w_num);
        $this->db->group_by('gwon_form_out_info.user_id');
        $this->db->order_by('gwon_form_out_info.date','desc');
        $query1=$this->db->get();
        if ($query1->num_rows()){
          $num = 0;
          foreach ($query1->result_array() as $row)
          {
              $user_id = $row['id'];
              $id_secur = $row['id_secur'];
              $username = $row['username'];
              $date = $row['date'];

              //총합
              //$this->db->where('key', 1);
              $this->db->where('item_value !=', "");
              $this->db->where('w_num', $w_num);
              $this->db->where('user_id', $user_id);
              $this->db->from('gwon_form_out_info');
              $count_data  = $this->db->count_all_results();


              $this->db->from('gwon_form_out_signature');
              $this->db->where('w_num',$w_num);
              $this->db->where('user_id',$user_id);
              $this->db->order_by('date','ASC');
              $this->db->limit(1);  
              $query2=$this->db->get();
             if ($query2->num_rows()){
                foreach ($query2->result_array() as $row2)
                {
                  $sig = $row2['sig'];
                  $date = $row2['date'];
                }
              }else{
                $sig= '';
              }
              $ret[$i]['w_num'] = $w_num;
              $ret[$i]['id_secur'] = $id_secur;
              $ret[$i]['user_id'] = $user_id;
              $ret[$i]['username'] = $username;
              $ret[$i]['total_user_insert_data'] = $count_data;
              $ret[$i]['sig'] = $sig;
              $ret[$i]['date'] = $date;

              $i++;
          }
        }else{
          $ret = 0;
        }
      }
      return  $ret;
   }

   //생성된 양식의 사용자 입력정보의 요약 정보 가져오기
   function  get_form_user_info_list($w_num){
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
                $sig = 'y';
              }
            }else{
              $sig= '';
            }

            $ret[$i]['w_num'] = $w_num;
            $ret[$i]['user_id'] = $user_id;
            $ret[$i]['username'] = $username;
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

   //생성된 양식의 사용자 입력정보의 요약 정보 가져오기
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

   //사용자 지원사업 신청 정보 가져오기
   function  get_apply_user_info($u_id){
      $i=0;
      $ret = array();
      $this->db->from('gwon_form_user_info');
      $this->db->where('user_id',$u_id);
      $this->db->group_by('w_num');
      $this->db->order_by('date','desc');
      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          //print_r($row);
          //$ret[$i]['w_num'] = $row['w_num'];
          $w_num = $row['w_num'];
          $user_id = $row['user_id'];
          $date = $row['date'];

          $this->db->from('gwon_campaign_act');
          $this->db->where('w_num',$w_num);
          $this->db->order_by('w_num','ASC');
          $this->db->limit(1);  
          $query2=$this->db->get();
          if ($query2->num_rows()){
            foreach ($query2->result_array() as $row1)
            {
              $page_secur = $row1['page_secur'];
              $title = $row1['title'];
              $domain = $row1['domain'];
            }
          }

          $ret[$i]['w_num'] = $w_num;
          $ret[$i]['page_secur'] = $page_secur;
          $ret[$i]['title'] = $title;
          $ret[$i]['domain'] = $domain;
          $ret[$i]['date'] = $date;

          $i++;
        }
      }else{
        $ret = 0;
      }
      return  $ret;
   }


   //사용자 지원사업 신청 정보 가져오기
   function  get_eva_user_info($u_id){
      $i=0;
      $ret = array();
      $this->db->from('gwon_eva_member');
      $this->db->where('user_id',$u_id);
      $this->db->group_by('w_num');
      $this->db->order_by('date','desc');
      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          //print_r($row);
          //$ret[$i]['w_num'] = $row['w_num'];
          $w_num = $row['w_num'];
          $step = $row['step'];
          $user_id = $row['user_id'];
          $email = $row['email'];
          $date = $row['date'];

          $this->db->from('gwon_campaign_act');
          $this->db->where('w_num',$w_num);
          $this->db->order_by('w_num','ASC');
          $this->db->limit(1);  
          $query2=$this->db->get();
          if ($query2->num_rows()){
            foreach ($query2->result_array() as $row1)
            {
              $page_secur = $row1['page_secur'];
              $title = $row1['title'];
              $domain = $row1['domain'];
            }
          }

          $ret[$i]['w_num'] = $w_num;
          $ret[$i]['page_secur'] = $page_secur;
          $ret[$i]['step'] = $step;
          $ret[$i]['title'] = $title;
          $ret[$i]['domain'] = $domain;
          $ret[$i]['date'] = $date;

          $i++;
        }
      }else{
        $ret = 0;
      }
      return  $ret;
   }


   //사용자 지원사업 신청 정보 가져오기
   function  get_bookmark_user_info($u_id){
      $i=0;
      $ret = array();
      $this->db->from('gwon_support_project');
      $this->db->group_by('p_num');
      $this->db->where('user_id',$u_id);
      $this->db->order_by('date','desc');
      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          //$ret[$i]['w_num'] = $row['w_num'];
          $p_num = $row['p_num'];
          $user_id = $row['user_id'];
          $date = $row['date'];

          $this->db->from('gwon_campaign_act');
          $this->db->where('p_num',$p_num);
          $this->db->order_by('w_num','ASC');
          $this->db->limit(1);  
          $query2=$this->db->get();
          if ($query2->num_rows()){
            foreach ($query2->result_array() as $row1)
            {
              $w_num = $row1['w_num'];
              $page_secur = $row1['page_secur'];
              $title = $row1['title'];
              $domain = $row1['domain'];
            }
          }

          $ret[$i]['w_num'] = $w_num;
          $ret[$i]['page_secur'] = $page_secur;
          $ret[$i]['title'] = $title;
          $ret[$i]['domain'] = $domain;
          $ret[$i]['date'] = $date;

          $i++;
        }
      }else{
        $ret = 0;
      }
      return  $ret;
   }
   //선정 단계 설정 정보 가져오기
   function  get_form_eva_step($w_num){
      $i=0;
      $ret = array();
      $this->db->from('gwon_eva_step');
      $this->db->where('w_num',$w_num);
      $this->db->where('use_check',1);
      $this->db->order_by('step','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          $ret[$i]['w_num'] = $row['w_num'];
          $ret[$i]['step'] = $row['step'];
          $ret[$i]['step_title'] = $row['step_title'];
          $ret[$i]['field_type'] = $row['field_type'];
          $ret[$i]['step_txt'] = $row['step_txt'];
          $ret[$i]['step_attach'] = $row['step_attach'];
          $ret[$i]['start_date'] = $row['start_date'];
          $ret[$i]['end_date'] = $row['end_date'];
          $ret[$i]['date'] = $row['date'];

          $ret[$i]['field_type_txt'] = $this ->get_field_type_txt($row['field_type']);
          $i++;
        }
      }
      return  $ret;
    
   }

    //선정 단계 설정 정보 및 접근권한 정보 가져오기
   function  get_form_eva_step_with_member($w_num,$user){
      $i=0;
      $ret = array();
      $this->db->from('gwon_eva_step');
      $this->db->where('w_num',$w_num);
      $this->db->where('use_check',1);
      $this->db->order_by('step','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          $ret[$i]['w_num'] = $row['w_num'];
          $now_step = $row['step'];
          $ret[$i]['step'] = $row['step'];
          $ret[$i]['step_title'] = $row['step_title'];
          $ret[$i]['field_type'] = $row['field_type'];
          $ret[$i]['step_txt'] = $row['step_txt'];
          $ret[$i]['step_attach'] = $row['step_attach'];
          $ret[$i]['start_date'] = $row['start_date'];
          $ret[$i]['end_date'] = $row['end_date'];
          $ret[$i]['start_time'] = $row['start_time'];
          $ret[$i]['end_time'] = $row['end_time'];
          $ret[$i]['date'] = $row['date'];
          $ret[$i]['field_type_txt'] = $this ->get_field_type_txt($row['field_type']);

          //접근권한
          $this->db->from('gwon_eva_member');
          $this->db->where('w_num',$w_num);
          $this->db->where('step',$now_step);
          $this->db->where('user_id',$user);
          $this->db->order_by('step','ASC');
          $this->db->limit(1);
          $query2=$this->db->get();
          if ($query2->num_rows()){
            foreach ($query2->result_array() as $row)
            {
              //print_r($row1);
              $ret[$i]['eva_access_info'] = 'y';
            }
          }else{
            $ret[$i]['eva_access_info'] = 'n';
          }

          
          $i++;
        }
      }
      return  $ret;
   }

   //선정 단계 텍스트 정보 가져오기
   function  get_field_type_txt($field_type){
      if($field_type=== 'type1'){
          $ret = ' 자체 선정';
      }else if($field_type=== 'type2'){
          $ret = ' 심사위원 구성';
      }
      return  $ret;
   }

   //해당 프로젝트의 선정 양식 정보 가져오기
   function  get_eval_formset_info($w_num,$step){
      $i=0;
      $ret = array();
      $this->db->from('gwon_eva_form_set_info');
      $this->db->where('w_num',$w_num);
      $this->db->where('step',$step);
      $this->db->order_by('key','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          $ret[$i]['w_num'] = $row['w_num'];
          $ret[$i]['step'] = $row['step'];
          $ret[$i]['key'] = $row['key'];
          $ret[$i]['item_id'] = $row['item_id'];
          $ret[$i]['display_name'] = $row['display_name'];
          $ret[$i]['field_type'] = $row['field_type'];
          $ret[$i]['options'] = $row['options'];
          $ret[$i]['score'] = $row['score'];
          $ret[$i]['memo'] = $row['memo'];
          $ret[$i]['date'] = $row['date'];
          $i++;
        }
      }
      return  $ret;
    
   }


   //해당 프로젝트의 선정 양식 정보 가져오기
   function  get_eval_member($w_num,$step){
      $i=0;
      $ret = array();
      $this->db->from('gwon_eva_member');
      $this->db->where('w_num',$w_num);
      $this->db->where('step',$step);
      $this->db->order_by('email','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          $ret[$i]['w_num'] = $row['w_num'];
          $ret[$i]['step'] = $row['step'];
          $ret[$i]['user_id'] = $row['user_id'];
          $ret[$i]['email'] = $row['email'];
          $ret[$i]['date'] = $row['date'];
          $user_id = $row['user_id'];

          if($user_id!=''){
            $this->db->from('gwon_users');
            $this->db->where('id',$user_id);
            $this->db->order_by('id','ASC');
            $this->db->limit(1);
            $query2=$this->db->get();
            if ($query2->num_rows()){
              
              foreach ($query2->result_array() as $row1)
              {
                //print_r($row1);
                $ret[$i]['id_secur'] = $row1['id_secur'];
                $ret[$i]['username'] = $row1['username'];
              }
            }else{
                $ret[$i]['id_secur'] = '';
                $ret[$i]['username'] = '';
            }
          }
          $i++;
        }
      }else{
        $ret = '';
      }
      return  $ret;
    
   }
   
   //초대받은 리스트
   function  get_eval_invite_list($email){
      $i=0;
      $ret = array();
      $this->db->from('gwon_eva_member');
      $this->db->where('email',$email);
      $this->db->where('user_id',0);
      $this->db->order_by('date','ASC');
      $query1=$this->db->get();
      if ($query1->num_rows()){
        
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          $ret[$i]['w_num'] = $row['w_num'];
          $ret[$i]['step'] = $row['step'];
          $ret[$i]['date'] = $row['date'];
          $w_num = $row['w_num'];

          if($w_num!=''){
            $this->db->from('gwon_campaign_wait');
            $this->db->where('w_num',$w_num);
            $this->db->order_by('w_num','ASC');
            $this->db->limit(1);
            $query2=$this->db->get();
            if ($query2->num_rows()){
              
              foreach ($query2->result_array() as $row1)
              {
                //print_r($row1);
                $ret[$i]['title'] = $row1['title'];
              }
            }
          }
          $i++;
        }
      }else{
        $ret = '';
      }
      return  $ret;
    
   }

   //선정 단계 설정 정보 가져오기
   function  get_eva_step_info($w_num,$step){
      $ret = array();
      $this->db->from('gwon_eva_step');
      $this->db->where('w_num',$w_num);
      $this->db->where('step',$step);
      $this->db->where('use_check',1);
      $this->db->order_by('w_num','ASC'); //참여한 날짜순으로 정렬
      $this->db->limit(1);  
      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          $ret['w_num'] = $row['w_num'];
          $ret['step'] = $row['step'];
          $ret['step_title'] = $row['step_title'];
          $ret['field_type'] = $row['field_type'];
          $ret['step_txt'] = $row['step_txt'];
          $ret['step_attach'] = $row['step_attach'];
          $ret['start_date'] = $row['start_date'];
          $ret['end_date'] = $row['end_date'];
          $ret['start_time'] = $row['start_time'];
          $ret['end_time'] = $row['end_time'];
          $ret['date'] = $row['date'];

          $ret['field_type_txt'] = $this ->get_field_type_txt($row['field_type']);
        }
      }

      return  $ret;
    
   }

   //평가 대상 정보 가져오기
   function  get_evar_target_info($w_num,$step,$score_type){
      $i=0;
      $ret = array();
      //step이 1단계면 전체 접수자 정보 가져오기
      if($step==1){
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

            $ret[$i]['user_id'] = $row['user_id'];

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
            $ret[$i]['id_secur'] = $id_secur;
            $ret[$i]['username'] = $username;

            //점수 합계
            $eva_user=$this->session->userdata('gwon_users');
            $score_sum=0;

            
            //선정 여부 정보 가져오기
             if($score_type=='all'){
              $this->db->from('gwon_eva_selected');
              $this->db->where('w_num',$w_num);
              $this->db->where('step',$step);
              $this->db->where('user_id',$user_id);
              $query_selected=$this->db->get();
              if ($query_selected->num_rows()){
                //선정됨
                 $ret[$i]['selected_type'] = 'y';
              }else{
                //미선정됨
                 $ret[$i]['selected_type'] = 'n';
              }
            }

            $this->db->from('gwon_eva_form_score_info');
            $this->db->where('w_num',$w_num);
            $this->db->where('step',$step);
            $this->db->where('target_user_id',$user_id);
            if($score_type!='all'){
              //개별 평가자의 점수 합계가 필요한 경우
              $this->db->where('user_id',$eva_user);
            }
            $query_sum=$this->db->get();
            if ($query_sum->num_rows()){
              foreach ($query_sum->result_array() as $row2)
              {
                $now_score = $row2['item_value'];
                $score_sum= $score_sum+$now_score;
              }
            }

            $ret[$i]['score_sum'] = $score_sum;
            


            $i++;
          }
        }else{
          $ret = 0;
        }
      }else{
        if($step==0){
          //최종선정 단계일 경우 
          $this->db->from('gwon_eva_step');
          $this->db->where('w_num',$w_num);
          $this->db->where('use_check',1);
          $this->db->order_by('step','DESC');
          $this->db->limit(1);  
          $query_sum=$this->db->get();
          if ($query_sum->num_rows()){
            foreach ($query_sum->result_array() as $row2)
            {
              $last_step = $row2['step'];
              $before_step =$last_step;
            }
          }
        }else{
          $before_step = $step-1;
        }
        
        //step이 2단계 이상이면 이전 단계 선정자 정보 가져오기
        $this->db->from('gwon_eva_selected');
        $this->db->where('w_num',$w_num);
        $this->db->where('step',$before_step);
        $this->db->order_by('date','asc');
        $query1=$this->db->get();
        if ($query1->num_rows()){
          foreach ($query1->result_array() as $row)
          {
            //$ret[$i]['w_num'] = $row['w_num'];
            $user_id = $row['user_id'];
            $ret[$i]['user_id'] = $row['user_id'];

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
            $ret[$i]['id_secur'] = $id_secur;
            $ret[$i]['username'] = $username;


            //최종 선정에서는 기존 단계 점수 가져오기
            if($step==0){
              $this->db->from('gwon_eva_step');
              $this->db->where('w_num',$w_num);
              $this->db->order_by('step','desc');
              $this->db->limit(1);  
              $query_last_step=$this->db->get();
              if ($query_last_step->num_rows()){
                foreach ($query_last_step->result_array() as $row)
                {
                 $last_step = $row['step'];
                }
              }
            }

            //점수 합계
            $eva_user=$this->session->userdata('gwon_users');
            $score_sum=0;

            $this->db->from('gwon_eva_form_score_info');
            $this->db->where('w_num',$w_num);
            if($step==0){
              $this->db->where('step',$last_step);
            }else{
              $this->db->where('step',$step);
            }
            $this->db->where('target_user_id',$user_id);
            if($score_type!='all'){
              //개별 평가자의 점수 합계가 필요한 경우
              $this->db->where('user_id',$eva_user);
            }
            $query_sum=$this->db->get();
            if ($query_sum->num_rows()){
              foreach ($query_sum->result_array() as $row2)
              {
                $now_score = $row2['item_value'];
                $score_sum= $score_sum+$now_score;
              }
            }

            $ret[$i]['score_sum'] = $score_sum;

            //선정 여부 정보 가져오기
             if($score_type=='all'){
              $this->db->from('gwon_eva_selected');
              $this->db->where('w_num',$w_num);
              $this->db->where('step',$step);
              $this->db->where('user_id',$user_id);
              $query_selected=$this->db->get();
              if ($query_selected->num_rows()){
                //선정됨
                 $ret[$i]['selected_type'] = 'y';
              }else{
                //미선정됨
                 $ret[$i]['selected_type'] = 'n';
              }
            }
            
            $i++;
          }
        }else{
          $ret = 0;
        }

      }
        
      return  $ret;
   }

   //평가표 가져오기
   function  get_eva_form_set_info_user($w_num,$step,$target_user_id,$user){
      $i=0;
      $ret = array();
      $this->db->from('gwon_eva_form_set_info');
      $this->db->where('w_num',$w_num);
      $this->db->where('step',$step);
      $this->db->order_by('key','ASC');

      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          //print_r($row1);
          /*$ret['form_set_info'][$i]['w_num'] = $row['w_num'];
          $ret['form_set_info'][$i]['key'] = $row['key'];
          $ret['form_set_info'][$i]['item_id'] = $row['item_id'];
          $ret['form_set_info'][$i]['display_name'] = $row['display_name'];
          $ret['form_set_info'][$i]['field_type'] = $row['field_type'];
          $ret['form_set_info'][$i]['options'] = $row['options'];
          $ret['form_set_info'][$i]['use'] = $row['use'];
          $ret['form_set_info'][$i]['memo'] = $row['memo'];
          $ret['form_set_info'][$i]['date'] = $row['date'];
          */

          $ret[$i]['w_num'] = $row['w_num'];
          $ret[$i]['key'] = $row['key'];
          $ret[$i]['item_id'] = $row['item_id'];
          $item_id = $row['item_id'];
          $ret[$i]['display_name'] = $row['display_name'];
          $ret[$i]['field_type'] = $row['field_type'];
          $ret[$i]['options'] = $row['options'];
          $ret[$i]['score'] = $row['score'];
          $ret[$i]['memo'] = $row['memo'];
          $ret[$i]['date'] = $row['date'];

          
          if($user==''){
            //전체 평가 정보를 가져오려면..
            //항목별 평균 평점, 합계 점수, 개별점수, 평가의견 정보 가져오기
            $total_sum = 0;
            $t=0;
            $scrore_info=array();
            $cmt_info=array();
            $comment_info=array();
            //총 점수 가져오기
            $this->db->from('gwon_eva_form_score_info');
            $this->db->where('w_num',$w_num);
            $this->db->where('step',$step);
            $this->db->where('target_user_id',$target_user_id);
            $this->db->where('item_id',$item_id);
            $this->db->order_by('item_id','ASC');
            $query2=$this->db->get();
            if ($query2->num_rows()){
              
              foreach ($query2->result_array() as $row1)
              {
                $now_score = $row1['item_value'];
                $now_comment= $row1['comment'];
                $total_sum = $total_sum+$now_score;
                $scrore_info[$t] = $now_score;
                $comment_info[$t] = $now_comment;
                $t++;
              }
            }
            if($total_sum!=0){
              $score_average = $total_sum/$t;
            }else{
              $score_average = $total_sum;
            }
            

            $ret[$i]['total_sum'] = $total_sum;
            $ret[$i]['score_average'] = $score_average;
            $ret[$i]['scrore_info'] = $scrore_info;
            $ret[$i]['comment_info'] = $comment_info;

          }else{
            //개별 평가위원의 평가 정보를 가져오려면..
            $this->db->from('gwon_eva_form_score_info');
            $this->db->where('w_num',$w_num);
            $this->db->where('step',$step);
            $this->db->where('user_id',$user);
            $this->db->where('target_user_id',$target_user_id);
            $this->db->where('item_id',$item_id);
            $this->db->order_by('item_id','ASC');
            $this->db->limit(1);  
            $query2=$this->db->get();
            if ($query2->num_rows()){
              foreach ($query2->result_array() as $row1)
              {
                $ret[$i]['item_value'] = $row1['item_value'];
                $ret[$i]['comment'] = $row1['comment'];
              }
            }else{
              $ret[$i]['item_value'] = '';
              $ret[$i]['comment'] = '';
            }
          }

          
          $i++;
        }
      }
      return  $ret;
   }

   //선정 여부 가져오기
    //지원 사용자 정보 가져오기
   function  check_eva_selected($w_num,$step,$target_user_id){
      $ret =0;
      $this->db->from('gwon_eva_selected');
      $this->db->where('w_num',$w_num);
      $this->db->where('step',$step);
      $this->db->where('user_id',$target_user_id);
      $this->db->limit(1);  
      $query1=$this->db->get();
      if ($query1->num_rows()){
        $ret = 1;
      }
      return  $ret;
   }

   //선정 정보가 등록되었는지 확인
   function  check_passer_info($w_num,$step){
      $ret =0;
      $this->db->from('gwon_eva_step');
      $this->db->where('w_num',$w_num);
      $this->db->where('comment_selected !=','');
      if($step!=''){
        $this->db->where('step',$step);
        $this->db->limit(1);  
      }
      $query1=$this->db->get();
      if ($query1->num_rows()){
        //선정자 등록이 되어 있고, 문구 설정이 되어 있다면..
        $ret = 1;
      }else{
        $ret = 0;
      }
      return  $ret;
   }

   //선정자 정보가 등록되었는지 확인하기
   function  check_passer_result($w_num,$target_user_id){
      $ret = array();
      $i=0;
      $check_last_step = 'n';
      $this->db->from('gwon_eva_step');
      $this->db->where('w_num',$w_num);
      $this->db->where('comment_selected !=','');
      $this->db->where('use_check','1');
      $this->db->order_by('step','ASC');
      //$this->db->limit(1);  
      $query2=$this->db->get();
      if ($query2->num_rows()){
        foreach ($query2->result_array() as $row1)
        {
          $step = $row1['step'];
          //결과 공지 합격자 등록 여부 확인하기. 글은 등록되었는데, 합격자가 한명도 입력안되어 있으면, 아직 선정전
          $this->db->where('w_num', $w_num);
          $this->db->where('step',$step);
          $this->db->from('gwon_eva_selected');
          $total_user_selected = $this->db->count_all_results();

          if($step==0){
            $check_last_step = 'y';
            $last_step = $row1['step'];
            $last_step_title = $row1['step_title'];
            $last_comment_selected = $row1['comment_selected'];
            $last_comment_drop = $row1['comment_drop'];
            //선정 정보가 적어도 1개 이상있어야 함.
            if($total_user_selected>0){
              $this->db->from('gwon_eva_selected');
              $this->db->where('w_num',$w_num);
              $this->db->where('step',$step);
              $this->db->where('user_id',$target_user_id);
              $this->db->limit(1);  
              $query1=$this->db->get();
              if ($query1->num_rows()){
                //합격자 정보에 있음
                $last_check_user_passer = 'yes';
              }else{
                $last_check_user_passer = 'no';
              }
            }else{
              $last_check_user_passer = 'not yet';
            }
          }else{
            $ret[$i]['step'] = $row1['step'];
            $ret[$i]['step_title'] = $row1['step_title'];
            $ret[$i]['comment_selected'] = $row1['comment_selected'];
            $ret[$i]['comment_drop'] = $row1['comment_drop'];

            if($total_user_selected>0){
              $this->db->from('gwon_eva_selected');
              $this->db->where('w_num',$w_num);
              $this->db->where('step',$step);
              $this->db->where('user_id',$target_user_id);
              $this->db->limit(1);  
              $query1=$this->db->get();
              if ($query1->num_rows()){
                //합격자 정보에 있음
                $ret[$i]['check_user_passer'] = 'yes';
              }else{
                $ret[$i]['check_user_passer']= 'no';
              }
            }else{
              $ret[$i]['check_user_passer'] = 'not yet';
            }
          }
          $i++;
        }
        //최종 선발 내역이 있으면 출력하기
        if($check_last_step=='y'){
          $ret[$i]['step'] = $last_step;
          $ret[$i]['step_title'] = $last_step_title;
          $ret[$i]['comment_selected'] = $last_comment_selected;
          $ret[$i]['comment_drop'] = $last_comment_drop;
          $ret[$i]['check_user_passer'] = $last_check_user_passer;
        }
      }

      return  $ret;
   }

   //외부 도메인이 있는지 체크하기 - 당장은 사용안함
   function  get_domain_url(){
      $hostname=$_SERVER["HTTP_HOST"];
      $hostname2 = str_replace("www.", "", $hostname);
      
      $this->db->from('gwon_domain_attach');
      $this->db->where('domain_url',$hostname2);
      $this->db->order_by('domain_url','ASC');
      $this->db->limit(1);  
      //$this->db->select('description');
      $query1=$this->db->get();
      if ($query1->num_rows()){
        foreach ($query1->result_array() as $row)
        {
          //print_r($row);
          $w_num = $row['w_num'];

          $this->db->from('gwon_campaign_act');
          $this->db->where('w_num',$w_num);
          $this->db->order_by('w_num','ASC');
          $this->db->limit(1);  
          //$this->db->select('description');
          $query2=$this->db->get();
          if ($query2->num_rows()){
            foreach ($query2->result_array() as $row2)
            {
              //print_r($row);
              $ret = $row2['domain'];
            }
          }else{
            $ret ='';
          }
        }
      }else{
        $ret ='';
      }
      return  $ret;
   }
}