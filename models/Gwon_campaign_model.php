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
class Gwon_campaign_model extends CI_Model
{

    private  $table = "gwon_campaign_act";
    private  $table_wait = "gwon_campaign_wait";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }



    function  insert_wait($param)
    {
        $this->db->insert($this->table_wait,$param);
        return $this->db->insert_id();

    }

    function  update_wait($param,$id){
        $this->db->where('w_num', $id);
        if(  $this->db->update($this->table_wait, $param)){
            return true;
        }else{
            return false;
        }


    }

    function  delete_wait($id){
        $this->db->where('w_num', $id);
        $this->db->delete($this->table_wait);
    }



    function  insert($param)
    {
        $this->db->insert($this->table,$param);
        return $this->db->insert_id();

    }

    function  update($param,$id){
        $this->db->where('p_num', $id);
        $this->db->update($this->table, $param);


    }

    function  delete($id){
        $this->db->where('p_num', $id);
        $this->db->delete($this->table);
    }




    function set_status($status,$id){

        $this->db->where('p_num', $id);
        $param = array("status"=>$status);
        $this->db->update($this->table, $param);


    }



    /**
     * 켐페인  리스트  가져오기
     *
     * @param string $status  상태
     * @param string $offset 시작번호
     * @param string $limit 갯수

     * @return array
     */
    //공개된 모집 공고
    function  get_list($status,$category_id,$offset='', $limit='',$type)
    {
        $result = false;
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("state",$status);

        if($category_id){
            $this->db->where("cate_id",$category_id);
        }


        $date = date("Y-m-d");
        //모집기간 내 지원사업
        $this->db->where('start_date <=', $date);
        $this->db->where('end_date >=', $date);
        //메인 노출 허용한 것만
        $this->db->where('admin_check', 0);

        $this->db->order_by("p_num", "desc");

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

        }else{
            //게시물 리스트 반환
            $query = $this->db->get();
            if($query->num_rows() > 0) $result = $query->result();
        }

        return $result;
    }
    //작성중인 모집 공고
    function  get_list_wait($category_id2,$offset='', $limit='',$type,$area="",$admin_check='')
    {
        $result = false;
        $this->db->select("*");
        $this->db->from($this->table_wait);

        if($category_id2){
            //$this->db->like("cate_info2","'".$category_id2."'");
            $this->db->like("cate_info2",$category_id2);
        }
        if($area){
            $this->db->like("client_address",$area);
        }

        if($admin_check){
            $this->db->where("admin_check",$admin_check);
        }


        $this->db->order_by("w_num", "desc");

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

        }
        else
        {
            //게시물 리스트 반환
            $query = $this->db->get();
            if($query->num_rows() > 0) $result = $query->result();
        }



        return $result;
    }

    //이벤트에 연결된 사연 보기
    function  get_list_event($status,$p_nums,$offset='', $limit='')
    {
        $result = false;
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("state",$status);

        if($p_nums){
            $this->db->where_in("p_num",$p_nums);
        }
        if ( $limit != '')
        {
            //페이징이 있을 경우의 처리
            $this->db->limit($limit, $offset);
        }


        $date = date("Y-m-d");

        $this->db->where('start_date <=', $date);
        $this->db->where('end_date >=', $date);

        $this->db->order_by("p_num", "desc");

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

        }
        else
        {
            //게시물 리스트 반환
            $query = $this->db->get();
            if($query->num_rows() > 0) $result = $query->result();
        }



        return $result;
    }


    /**
     * 캠페인 상세보기 가져오기
     *
     * @param string $id 캠페인 번호
     * @return array
     */
    function get_view($id)
    {
        $this->db->from($this->table);
        $this->db->where("p_num",$id);
        $this->db->order_by('p_num','ASC');
        $this->db->limit(1);
        $query1=$this->db->get();
        if ($query1->num_rows()){
            foreach ($query1->result_array() as $row1)
            {
                $sql = "SELECT * FROM  {$this->table} WHERE p_num = ?";
                $query = $this->db->query($sql, array($id));

                //게시물 내용 반환
                $result =  $query->result();
            }
        }else{
            $result =  'n';
        }


        return $result;
    }

    function get_wnum_from_act($p_num)
    {
        $this->db->from('sg_campaign_act');
        $this->db->where("p_num",$p_num);
        $this->db->limit(1);
        $query1=$this->db->get();
        if ($query1->num_rows()){
            foreach ($query1->result_array() as $row1)
            {
                //print_r($row1);
                
                $result= $row1['w_num'];
            }
        }


        return $result;
    }



    /**
     * 캠페인 상세보기 가져오기
     *
     * @param string $id 캠페인 번호
     * @return array
     */
    function get_view_wait($id)
    {



        $sql = "SELECT * FROM  sg_campaign_wait WHERE w_num = ?";
        $query = $this->db->query($sql, array($id));

        //게시물 내용 반환
        $result = $query->row();

        return $result;
    }

    //카테고리별 정보 보기 - 주제별 보기
    function  get_cate1($table){
        $i=0;
        $ret=array();
        $this->db->from('project_category');
        $this->db->where("field_group","주제별");
        $this->db->order_by('field_name','ASC');
        $query1=$this->db->get();
        if ($query1->num_rows()){
            foreach ($query1->result_array() as $row1)
            {
                //print_r($row1);

                $ret[$i]['table'] = $table;
                
                $ret[$i]['cate_id'] = $row1['cate_id'];
                $ret[$i]['field_name'] = $row1['field_name'];
                $field_name = $row1['field_name'];
                $ret[$i]['field_group'] = $row1['field_group'];
                $ret[$i]['admin_check'] = $row1['admin_check'];

                $date = date("Y-m-d");
                $this->db->from($table);
                $this->db->where('start_date <=', $date);
                $this->db->where('end_date >=', $date);
                $this->db->like("cate_info2",$field_name);
                $ret[$i]['count'] = $this->db->count_all_results();

                $i++;
            }
        }
        return  $ret;
    }

    //카테고리별 정보 보기 - 세대별 보기
    function  get_cate2($table){

        $i=0;
        $this->db->from('project_category');
        $this->db->where("field_group","세대별");
        $this->db->order_by('field_name','ASC');
        $query1=$this->db->get();
        if ($query1->num_rows()){
            foreach ($query1->result_array() as $row1)
            {
                //print_r($row1);

                $ret[$i]['table'] = $table;
                
                $ret[$i]['cate_id'] = $row1['cate_id'];
                $ret[$i]['field_name'] = $row1['field_name'];
                $cate_secur = $row1['cate_secur'];
                $ret[$i]['field_group'] = $row1['field_group'];
                $ret[$i]['admin_check'] = $row1['admin_check'];


                $this->db->from($table);
                $date = date("Y-m-d");
                $this->db->where('start_date <=', $date);
                $this->db->where('end_date >=', $date);
                $this->db->like("cate_info1",$cate_secur);
                $ret[$i]['count'] = $this->db->count_all_results();

                $i++;
            }
        }
        return  $ret;
    }
    function  get_tag($w_num){
        $this->db->from('gwon_tag_page');
        $this->db->join('gwon_tag_info', 'gwon_tag_info.tg_id = gwon_tag_page.tg_id');
        $this->db->where('gwon_tag_page.w_num', $w_num);
        $this->db->order_by('gwon_tag_page.tg_id','desc');
        $query = $this->db->get();


        return $query->result();

    }

    function  get_all_tag(){
        $this->db->from('gwon_tag_info');
        $this->db->join('gwon_tag_page', 'gwon_tag_info.tg_id = gwon_tag_page.tg_id');
        $this->db->order_by('gwon_tag_page.tg_id','desc');
        $query = $this->db->get();
        return $query->result();
    }

    //사회복지사 정보 가져오기
    function  get_sworker($w_num){

        $i=0;
        $this->db->from('sg_project_member');
        $this->db->where("p_num",$w_num);
        $this->db->where("aceept_state",2);
        $this->db->order_by('date','ASC');
        $query1=$this->db->get();
        if ($query1->num_rows()){
            foreach ($query1->result_array() as $row1)
            {
                //print_r($row1);

                
                $ret[$i]['user_id'] = $row1['user_id'];
                $user_id = $row1['user_id'];

                $this->db->from('sg_users');
                $this->db->where("id",$user_id);
                $this->db->order_by('id','ASC');
                 $this->db->limit(1);
                $query2=$this->db->get();
                if ($query2->num_rows()){
                    foreach ($query2->result_array() as $row2)
                    {
                        //print_r($row1);

                        
                        $ret[$i]['id_secur'] = $row2['id_secur'];
                        $ret[$i]['username'] = $row2['username'];
                        $ret[$i]['nick_name'] = $row2['nick_name'];
                        $ret[$i]['photo_fb'] = $row2['photo_fb'];
                        $ret[$i]['email'] = $row2['email'];
                        
                    }
                }

                $this->db->from('sg_sworker_info');
                $this->db->where("user_id",$user_id);
                $this->db->order_by('date','ASC');
                 $this->db->limit(1);
                $query2=$this->db->get();
                if ($query2->num_rows()){
                    foreach ($query2->result_array() as $row2)
                    {
                        //print_r($row1);

                        
                        $ret[$i]['sworker_workplace'] = $row2['sworker_workplace'];
                        $ret[$i]['sworker_phone'] = $row2['sworker_phone'];
                        $ret[$i]['sworker_descript'] = $row2['sworker_descript'];
                        $ret[$i]['sworker_state'] = $row2['sworker_state'];
                        
                    }
                }else{
                    $ret[$i]['sworker_workplace'] = '';
                    $ret[$i]['sworker_phone'] = '';
                    $ret[$i]['sworker_descript'] = '';
                    $ret[$i]['sworker_state'] = '';
                }


                $i++;
            }
        }
        return  $ret;
    }




}