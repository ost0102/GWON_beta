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
class Gwon_news_model extends CI_Model
{

    private  $table = "sg_board_news";


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }







    function  insert($param)
    {
        $this->db->insert($this->table,$param);
        return $this->db->insert_id();

    }

    function  update($param,$id){
        $this->db->where('bo_id', $id);
        $this->db->update($this->table, $param);


    }

    function  delete($id){
        $this->db->where('bo_id', $id);
        $this->db->delete($this->table);
    }



    /**
     * 켐페인  리스트  가져오기
     *
     * @param string $status  상태
     * @param string $offset 시작번호
     * @param string $limit 갯수

     * @return array
     */

    function  get_list($status,$offset='', $limit='',$type)
    {
        $result = false;
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("is_delete",$status);




        $this->db->order_by("bo_id", "desc");

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



        $sql = "SELECT * FROM  {$this->table} WHERE bo_id = ?";
        $query = $this->db->query($sql, array($id));

        //게시물 내용 반환
        $result = $query->row();

        return $result;
    }

}