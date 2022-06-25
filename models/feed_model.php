<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * rss 의 기본 기능 모듈을 담고 있음
 * 
 */
class Feed_model extends CI_Model{
	
	function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	//page_id 존재여부 확인하기
	function getFeedArticles($db_name='ipg_page_info_act')
	{

		$i=0;
		$table_info = array();



		$this->db->from($db_name);
		$this->db->where('state',1);
		$this->db->order_by('edit_time','desc');
		$this->db->limit(100);	
		$query1=$this->db->get();
		if ($query1->num_rows()){
			//변수가 넘어온 경우(정보 수정시)
			foreach ($query1->result_array() as $row)
			{
				//print_r($row);
				$table_info[$i]['ARTICLE_URL'] =  'http://'.$this->config->item('intro_url').'/'.$row['domain'];
				$table_info[$i]['domain'] = $row['domain'];
				$table_info[$i]['title'] = $row['title'];
				//html 코드제거
				$bo_content = '';
				$bo_content = strip_tags($row['summary']);
				$table_info[$i]['summary'] = mb_substr($bo_content,0,300).'...';
				$table_info[$i]['edit_time'] = $row['edit_time'];
				$i++;
			}
		}

		return $table_info;

	}
	

}