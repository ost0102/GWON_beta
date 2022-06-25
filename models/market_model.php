<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Market_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
    
    //마켓 카테고리 정보 가져오기
    function get_category($id){
        
        if($id!=""){
         $sql='select * from mk_market_category where id = ?';
         
         $market_query=$this->db->query($sql,$id); 
           return $market_query->result_array();  
        }else{
         $sql='select * from mk_market_category order by id desc ';
       
         $market_query=$this->db->query($sql); 
           return $market_query->result();           
        }
    }

    //페이지 활성화 여부 정보 가져오기
    function get_status($id){
         $sql="SELECT state FROM `ipg_page_info_wait` WHERE w_num='$id'";
         $market_query=$this->db->query($sql);
         $result =$market_query->result();
            
         return $result[0]->state; 
 
    }

    //활성화된 사이트 정보 가져오기
    function get_site($id){
        
         $sql="SELECT * FROM `ipg_page_info_act` WHERE w_num='$id'";
         $market_query=$this->db->query($sql); 
         return $market_query->result();  
    }

    //제작 중인 사이트 정보 가져오기
    function get_site_wait($id){
         
         $sql="SELECT * FROM `ipg_page_info_wait` WHERE w_num='$id'";
         
         $market_query=$this->db->query($sql); 
         return $market_query->result();  
    }
    
    //마켓 정보 가져오기
    function get_market($id){
      	$sql = "SELECT * FROM mk_market  WHERE mk_idx = ?";
		$query = $this->db->query($sql, array($id));
		$result = $query->row();
		return $result;
    }

    //생성된 모듈 정보 가져오기
    function set_market_config($data){
        	$this->db->insert('intropage_module.intro_module',$data);
            return $this->db->insert_id();
    }

    //생성된 모듈 정보의 값 업데이트
    function update_market_config($data,$id){         
            $this->db->where('id', $id);
        	$this->db->update('intropage_module.intro_module',$data);
            return ($this->db->affected_rows() != 1) ? false : true;
    }
			
    //선택한 페이지의 모듈 정보 가져오기
    function get_module($wnum){
         $sql="SELECT * FROM   intropage_module.intro_module WHERE w_num='$wnum'";
         
         echo "<!--".$sql."-->";
         $market_query=$this->db->query($sql); 
         return $market_query->result();  
        
    }

    //모듈 id로 모듈 정보 가져오기
    function get_module_info($id){
        
         $sql="SELECT * FROM   intropage_module.intro_module WHERE id='$id'";
         $market_query=$this->db->query($sql); 
         return $market_query->result();  
        
        
    }		
    
    //마켓 정보에 해당하는 페이지와 연관된 모듈 정보 가져오기
    function get_user_site_module($mk_idx){
        
        $user= $this->session->userdata('ipg_users');
        $sql="SELECT * FROM intropage.ipg_page_info_act WHERE state=1 and w_num IN(SELECT w_num FROM intropage_module.intro_module WHERE mk_idx='$mk_idx' ) order by intropage.ipg_page_info_act.w_num DESC limit 2 ";
         
         $market_query=$this->db->query($sql);
         return $market_query->result();
        
        
    }
     /**
     * 리스트  
     */
     //마켓 리스트 가져오기
    function get_list( $type='', $offset='', $limit='', $search_sel='', $search_word='',$search_tag='',$search_category='',$search_type,$w_num)
	{

		$result = false;
	    $user= $this->session->userdata('ipg_users');
		
            
        
           if($search_type=="use"){
            $select = array('a.mk_idx','a.mk_title','a.mk_content','a.mk_tag','a.mk_category','a.mk_controll','a.mk_dir','a.mk_icon','a.mk_view','a.mk_date','ue.id','ue.mk_count','ue.module_sort');
		    $this->db->join('intropage_module.intro_module ue', 'ue.mk_idx = a.mk_idx', 'left');
        	$this->db->where('w_num',$w_num);
	       }else{
	    	$select = array('a.mk_idx','a.mk_title','a.mk_content','a.mk_tag','a.mk_category','a.mk_dir','a.mk_icon','a.mk_view','a.mk_date');       
	       }
           
           $this->db->select($select);
	    	$this->db->from('intropage.mk_market a');

		if ( $search_word != '' )
		{
			//검색어가 있을 경우의 처리
		 
				$this->db->like('a.mk_title', $search_word);
				$this->db->or_like('a.mk_content', $search_word);
		 
		 
		}
        
        if($search_tag !=''){
            	$this->db->like('a.mk_tag', $search_tag);
        }
        
        if($search_category !=''){
            	$this->db->like('a.mk_category', $search_category);
        }
    
        
		$this->db->order_by("a.mk_idx", "desc");

		if ( $limit != '' OR $offset != '' )
		{
			//페이징이 있을 경우의 처리
			$this->db->limit($limit, $offset);
		}


		if ( $type == 'count' )
		{
			//리스트를 반환하는 것이 아니라 전체 게시물의 갯수를 반환
			//$result = $query->num_rows();
			$result = $this->db->count_all_results();
			//$this->db->count_all($table);
		}
		else
		{
			//게시물 리스트 반환
			$query = $this->db->get();
			if($query->num_rows() > 0) $result = $query->result();
		}
	
      //  echo  $this->db->last_query();
		return $result;
	}

    function get_member($w_num){
        /*
         * 사이트 관련 회원 정보 가져오기
         * */
        //해당 프로젝트 팀원의 총 수 구하기
        $this->db->where('ipg_project_member.p_num',$w_num);
        $this->db->where('ipg_project_member.aceept_state','2');
        $this->db->where('ipg_users.u_group !=',1);
        $this->db->from('ipg_project_member');
        $this->db->join('ipg_users', 'ipg_users.id = ipg_project_member.user_id');
        $count_basic_user = $this->db->count_all_results();



        //해당 프로젝트 멤버 정보 확인
        $this->db->from('ipg_project_member');
        $this->db->join('ipg_users', 'ipg_users.id = ipg_project_member.user_id');
        $this->db->where('ipg_project_member.p_num',$w_num);
        $this->db->where('ipg_project_member.aceept_state','2');
        $this->db->order_by('date','ASC');
        $m=0;
        //$this->db->limit(1);
        //$this->db->select('description');
        $query1=$this->db->get();
        if ($query1->num_rows()){
            foreach ($query1->result_array() as $row)
            {
                $user_id = $row['user_id'];
                $u_group = $row['u_group'];
                $u_secur = do_hash($user_id);
                $email = $row['email'];
                $username = $row['username'];
                $aceept_state = $row['aceept_state'];
                $photo_fb = $row['photo_fb'];
                $position = $row['position'];

                //해당 프로젝트의 팀원 중 인트로 페이지 관리자만 있고, 일반 사용자가 팀 멤버로 없는 경우
                if($count_basic_user == 0){
                    ////print_r($row);
                    $surve['team_member'][$m]['user_id'] = $row['user_id'];
                    $surve['team_member'][$m]['position'] = $row['position'];
                    $surve['team_member'][$m]['username'] = $row['username'];
                    $surve['team_member'][$m]['photo_fb'] = $row['photo_fb'];
                    //팀원의 이름 등 정보 가져오기
                    $m++;
                }else{
                    //일반 프로젝트 팀원이 있는 경우, 관리자들은 빼기
                    if($u_group != 1){
                        ////print_r($row);
                        $surve['team_member'][$m]['user_id'] = $row['user_id'];
                        $surve['team_member'][$m]['position'] = $row['position'];
                        $surve['team_member'][$m]['username'] = $row['username'];
                        $surve['team_member'][$m]['photo_fb'] = $row['photo_fb'];
                        //팀원의 이름 등 정보 가져오기
                        $m++;
                    }
                }
            }
        }

        //해당 프로젝트와 연관된 팀 정보 가져오기
        $this->db->from('ipg_project_team');
        $this->db->join('ipg_team_info', 'ipg_team_info.t_id = ipg_project_team.t_id');
        $this->db->where('p_num',$w_num);
        $this->db->where('aceept_state','2');
        $this->db->order_by('date','ASC');
        $t=0;
        //$this->db->limit(1);
        //$this->db->select('description');
        $query1=$this->db->get();
        if ($query1->num_rows()){
            foreach ($query1->result_array() as $row)
            {
                //print_r($row);
                $surve['team_info'][$t]['t_id'] = $row['t_id'];
                $surve['team_info'][$t]['position'] = $row['position'];
                $surve['team_info'][$t]['t_name'] = $row['t_name'];
                $surve['team_info'][$t]['t_script'] = $row['t_script'];
                //팀원의 이름 등 정보 가져오기
                $t++;
            }
        }

        return $surve;

    }
}
     