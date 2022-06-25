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
class Sl_model extends CI_Model{
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	//page_id 존재여부 확인하기
	function check_page_id($p_url='0')
	{
		$this->db->from('sl_page_info');
		$this->db->where('url',$p_url);
		$this->db->order_by('p_id','DESC ');
		$this->db->limit(1);	

		$query1=$this->db->get();
		if ($query1->num_rows()){
			foreach ($query1->result_array() as $row)
			{
			//print_r($row);
			return $row['p_id'];
			}
		}else{
			return "not_found";
		}
	}
	//page_id 존재여부 확인하기
	function check_page_id_from_title($title='0')
	{
		$this->db->from('sl_page_info');
		$this->db->where('title',$title);
		$this->db->order_by('p_id','DESC ');
		$this->db->limit(1);	

		$query1=$this->db->get();
		if ($query1->num_rows()){
			foreach ($query1->result_array() as $row)
			{
			//print_r($row);
			return $row['p_id'];
			}
		}else{
			return "not_found";
		}
	}

	function get_p_id($p_url)
	{
		$this->db->from('sl_page_info');
		$this->db->where('url',$p_url);
		$this->db->order_by('p_id','DESC ');
		$this->db->limit(1);	

		$query1=$this->db->get();
		if ($query1->num_rows()){
			foreach ($query1->result_array() as $row)
			{
			//print_r($row);
			return $row['p_id'];
			}
		}else{
			//삭제한 정보에 포함되어 있진 않은지 체크하기
			$this->db->from('sl_page_info_del');
			$this->db->where('url',$p_url);
			$this->db->order_by('p_id','DESC ');
			$query1=$this->db->get();
			if ($query1->num_rows()){
				foreach ($query1->result_array() as $row)
				{
				//print_r($row);
				return $row['p_id'];
				}
			}else{
				//삭제 리스트에도 없을 때, 실행하기
				//url 삽입하기
				$this->db->insert('sl_page_info',array('url'=>$p_url));

				//p_id 가져오기
				$this->db->from('sl_page_info');
				$this->db->where('url', $p_url);
				$this->db->order_by('p_id','DESC ');
				$this->db->limit(1);	

				$query1=$this->db->get();
				if ($query1->num_rows()){
					foreach ($query1->result_array() as $row)
					{
						$p_id = $row['p_id'];
						//단축주소 저장
						$short_char = $this->trans_short($p_id);
						$page_data["short_char"]= $short_char;
						$this->db->where('p_id', $p_id);
						$this->db->update('sl_page_info', $page_data);

						//print_r($row);
						return $row['p_id'];
					}
				}
			}
		}
	}

	//link값중 불필요한 요소 제외하기
	function link_filter($data_link)
	{
		$data_link = str_replace("http://", "", $data_link);
		$data_link = str_replace("https://", "", $data_link);
		//$data_link = str_replace("www.", "", $data_link);
		//특수문자를 변환하기 && 기호를 &amp; 형태로 변경 등..
		$data_link = htmlspecialchars($data_link);
		return $data_link;
	}
	//link값중 불필요한 요소 제외하기
	function link_filter_decode($data_link)
	{
		//특수문자를 변환하기 && 기호를 &amp; 형태로 변경 등..한번돌려서 안되는 것들이 있음
		$data_link = htmlspecialchars_decode($data_link);
		$data_link = htmlspecialchars_decode($data_link);
		return $data_link;
	}
	function txt_filter($txt=''){
		$txt = str_replace("\"", " ", $txt);
		$txt = str_replace("'", " ", $txt);
		return $txt;

	}

	function title_filter($title=''){
		$title = str_replace("<strong>", "", $title);
		$title = str_replace("</strong>", "", $title);
		$title = str_replace("<b>", "", $title);
		$title = str_replace("</b>", "", $title);
		$title = str_replace("\"", " ", $title);
		$title = str_replace("'", " ", $title);
		
		$title = str_replace('  ','' , $title);
		$title = str_replace('	','' , $title);
		$title = str_replace('
','' , $title);
		return $title;

	}

	//link값중 불필요한 요소 제외하기
	function get_domain($data_link='0')
	{
		$domain_explode = explode('/',$data_link);
		$domain = $domain_explode[0];
		return $domain;
	}

	function get_domain_id($p_url)
	{
		$domain_explode = explode('/',$p_url);
		$domain = $domain_explode[0];
		
		//blog 검색하기
		if(strpos($p_url, "blog.naver.com") !== false) {  
		    $domain = $domain_explode[0]."/".$domain_explode[1];
		}

		//블로그 사이트들은 별도 처리하기


		$this->db->from('sl_domain_info');
		$this->db->where('domain',$domain);
		$this->db->order_by('d_id','DESC ');
		$this->db->limit(1);	

		$query1=$this->db->get();
		if ($query1->num_rows()){
			foreach ($query1->result_array() as $row)
			{
			//print_r($row);
			return $row['d_id'];
			}
		}else{
			$domain_info = array('domain'=>$domain);
			//도메인 추가하기
			$this->db->insert('sl_domain_info',$domain_info);

			//p_id 가져오기
			$this->db->from('sl_domain_info');
			$this->db->where('domain', $domain);
			$this->db->order_by('d_id','DESC ');
			$this->db->limit(1);	

			$query1=$this->db->get();
			if ($query1->num_rows()){
				foreach ($query1->result_array() as $row)
				{
				//print_r($row);

				$d_secur = do_hash($row['d_id']);
				$page_data = array(
				'd_secur'=>$d_secur
				 );
				$this->db->where('d_id', $row['d_id']);
				$this->db->update('sl_domain_info', $page_data);
				return $row['d_id'];
				}
			}
		}
	}

	//등록된 경우만 가져오기
	function get_domain_id2($p_url)
	{
		$domain_explode = explode('/',$p_url);
		$domain = $domain_explode[0];
		
		//blog 검색하기
		if(strpos($p_url, "blog.naver.com") !== false) {  
		    $domain = $domain_explode[0]."/".$domain_explode[1];
		}

		//블로그 사이트들은 별도 처리하기


		$this->db->from('sl_domain_info');
		$this->db->where('domain',$domain);
		$this->db->order_by('d_id','DESC ');
		$this->db->limit(1);	

		$query1=$this->db->get();
		if ($query1->num_rows()){
			foreach ($query1->result_array() as $row)
			{
			//print_r($row);
			return $row['d_id'];
			}
		}else{
			return 0;
		}
	}

	//페이지 정보 업데이트
	function update_page_info($page_info)
	{
		if(isset($page_info) && isset($page_info['domain'])){
			if(isset($page_info['title'])){
				$title = $page_info['title'];
				$page_data["title"]= $page_info['title'];
				//카테고리 값 체크하기
				$this->check_cate($title, 2);
				$this->title_filter($title);
				$page_data["title"]= $title;
			}
			if(isset($page_info['domain'])){
				$domain = $page_info['domain'];
				$page_data["domain"]= $page_info['domain'];
			}
			if(isset($page_info['site_cate'])){
				$site_cate = $page_info['site_cate'];
				$page_data["site_cate"]= $page_info['site_cate'];
			}
			if(isset($page_info['sl_cate'])){
				$site_cate = $page_info['sl_cate'];
				$page_data["sl_cate"]= $page_info['sl_cate'];
			}
			if(isset($page_info['summary'])){
				$summary = $page_info['summary'];
				$page_data["summary"]= $page_info['summary'];
			}
			if(isset($page_info['date'])){
				$date = $page_info['date'];
				$page_data["date"]= $page_info['date'];
			}
			if(isset($page_info['p_id'])){
				$p_id = $page_info['p_id'];
				$page_data["p_id"]= $page_info['p_id'];
			}
			//Title 가져오기
			if(isset($site_cate)){
				//카테고리 값 체크하기
				$sl_cate= $this->check_cate($site_cate, 1);
				if($sl_cate==''){
					$sl_cate= $this->check_cate($title, 2);
				}
			}else if(isset($title)){
				//카테고리 값 체크하기
				$sl_cate= $this->check_cate($title, 2);
			}
			if($sl_cate!=''){
				$page_data["sl_cate"]= $sl_cate;
			}

			$page_data["page_secur"]= do_hash($p_id);
			$this->db->where('p_id', $p_id);
			$this->db->update('sl_page_info', $page_data);
		}
	}

	//category 필터링 - title 규칙도 추가하기
	function cate_filtering($category, $title, $domain)
	{
		$sl_cate = '';
		if($category !=''){
			//사이트 카테고리 값이 있다면,
			$sl_cate= $this->check_cate($category, 1);
		}
		if(isset($domain) && $domain == 2){
			//benefit의 정보라면..
			$sl_cate= 5;
		}
		if($sl_cate=='' && isset($title)){
			//카테고리 값 체크하기
			$sl_cate= $this->check_cate($title, 2);
		}
		if(isset($domain) && $domain == 3){
			//덩프로듀셔-뉴스
			$sl_cate= 5;
		}
		if(isset($domain) && $domain == 4){
			//더나은 미래의 정보라면..뉴스로 보내기
			$sl_cate= 5;
		}
		if(isset($domain) && $domain == 7){
			//개발 마케팅 연구소의 정보라면..뉴스로 보내기
			$sl_cate= 10;
		}
		
		if(isset($domain) && $domain == 5){
			//사람바이러스-뉴스
			$sl_cate= 5;
		}
		if(isset($domain) && $domain == 6){
			//시민운동 플랜B..칼럼
			$sl_cate= 10;
		}
		if(isset($domain) && $domain == 15){
			//벤처스퀘어 - 스타트업 정보
			$sl_cate= 11;
		}
		if(isset($domain) && $domain == 16){
			//바람 - 뉴스
			$sl_cate= 5;
		}
		if(isset($domain) && $domain == 18){
			//세상 - 뉴스
			$sl_cate= 1;
		}
		if(isset($domain) && $domain == 20){
			//갭이어 - 사람들
			$sl_cate= 8;
		}
		if(isset($domain) && $domain == 21){
			//세상 블로그 - 뉴스
			$sl_cate= 5;
		}
		if(isset($domain) && $domain == 22){
			//슬로워크 - 칼럼
			$sl_cate= 10;
		}
		if(isset($domain) && $domain == 23){
			//서울엔피오지원센터 - 뉴스
			$sl_cate= 5;
		}
		if(isset($domain) && $domain == 24){
			//진저프로젝트
			$sl_cate= 3;
		}
		if(isset($domain) && $domain == 25){
			//벤처스퀘어 - 스타트업 정보
			$sl_cate= 11;
		}
		if(isset($domain) && $domain == 26){
			//체인지그라운드 - 뉴스
			$sl_cate= 5;
		}
		if(isset($domain) && $domain == 28){
			//careers.un.org 채용정보
			$sl_cate= 2;
		}
		
		if($sl_cate==''){
			$sl_cate= '';
		}
		return $sl_cate;
	}

	//cate 정보 가져오기
	function check_cate($value, $state)
	{
		if($state==1){
			//site 카테고리 정보로 구분할 수 있는 거라면..
			if($value=="입찰 공고"){
				$sl_cate = 4;
			}else if($value=="채용"){
				$sl_cate = 2;
			}else if($value=="나눔교육"){
				$sl_cate = 3;
			}else if($value=="교육"){
				$sl_cate = 3;
			}else if($value=="사업개발자 역량강화"){
				$sl_cate = 3;
			}else if($value=="사람들"){
				$sl_cate = 8;
			}else if($value=="행사"){
				$sl_cate = 7;
			}else if($value=="봉사활동"){
				$sl_cate = 9;
			}else if($value=="국제기구공고"){
				$sl_cate = 2;
			}else if($value=="채용공고 - 국내 외국계 기업"){
				$sl_cate = 2;
			}else if($value=="채용공고 - 아시아 태평양"){
				$sl_cate = 2;
			}else if($value=="채용공고 - 미주/구미주 외"){
				$sl_cate = 2;
			}else if($value=="채용공고 - 기타"){
				$sl_cate = 2;
			}else{
				$sl_cate = '';
			}
		}else if($state==2){
			//타이틀에 포함된 키워드로 분류할 수 있는지 확인하기
			if(strpos($value, "아카데미") !== false) {  
			    $sl_cate = 3;
			}
			if(strpos($value, "지원사업") !== false) {  
			    $sl_cate = 1;
			}
			if(strpos($value, "공고") !== false) {  
			    $sl_cate = 4;
			}
			if(strpos($value, "채용") !== false) {  
			   $sl_cate = 2;
			}
			if(strpos($value, "용역") !== false) {  
			   $sl_cate = 4;
			}
			if(strpos($value, "입찰") !== false) {  
			    $sl_cate = 4;
			}
			if(strpos($value, "교육") !== false) {  
			   $sl_cate = 3;
			}
			if(strpos($value, "공채") !== false) {  
			    $sl_cate = 2;
			}
			if(strpos($value, "공모") !== false) {  
			    $sl_cate = 1;
			}
			if(strpos($value, "봉사단 모집") !== false) {  
			    $sl_cate = 9;
			}
			if(strpos($value, "자원봉사") !== false) {  
			    $sl_cate = 9;
			}

			if(!isset($sl_cate)){
				$sl_cate = '';
			}
		}
		return $sl_cate;
	}

	//count 정보 가져오기
	function count_page_attempts($p_id='')
	{
		$this->db->where('p_id', $p_id);
		$this->db->from('sl_page_attempts');
		$p_count= $this->db->count_all_results();
		return $p_count;
	}
	//페이지와 연관된 태그 정보 가져오기
	function page_tag_info($p_id='')
	{	
		$pt_array= array();
		$this->db->from('sl_tag_page');
		$this->db->join('sl_tag_info', 'sl_tag_info.tg_id = sl_tag_page.tg_id');
		$this->db->where('sl_tag_page.p_id',$p_id);
		$this->db->order_by('sl_tag_page.tg_id','desc');
		$query1=$this->db->get();
		if ($query1->num_rows()){
			$t = 0;
			foreach ($query1->result_array() as $row)
			{
				//print_r($row);
				//class_no가 없을 경우 최근 값을 가져와라
				$pt_array[$t]['tg_title'] = $row['tg_title'];
				$t++;
			}
		}
		return $pt_array;
	}
	//페이지 category 가져오기
	function page_cate_info($sl_cate='')
	{	
		$this->db->from('sl_category');
		$this->db->where('cate_id',$sl_cate);
		$this->db->order_by('cate_id','desc');
		$query1=$this->db->get();
		if ($query1->num_rows()){
			foreach ($query1->result_array() as $row)
			{
				//print_r($row);
				//class_no가 없을 경우 최근 값을 가져와라
				$cate_id = $row['field_name'];
			}
		}
		return $cate_id;
	}

	function tag_auto_filtering($p_id,$title,$tag_where)
	{
		$count=0;
		
		//blog 검색하기
		if(strpos($title, "지원사업") !== false) {  
		    $this->add_tag($p_id,"지원사업",$tag_where);
		}
		if(strpos($title, "공고") !== false) {  
		    $this->add_tag($p_id,"공고",$tag_where);
		}
		if(strpos($title, "안내") !== false) {  
		    $this->add_tag($p_id,"안내",$tag_where);
		}
		if(strpos($title, "사회적기업") !== false) {  
			$title_filter = str_replace("사회적기업진흥원", "", $title);
		    if(strpos($title_filter, "사회적기업") !== false) {  
		    	$this->add_tag($p_id,"사회적기업",$tag_where);
			}
		}
		if(strpos($title, "채용") !== false) {  
		   $this->add_tag($p_id,"채용",$tag_where);
		}
		if(strpos($title, "용역") !== false) {  
		    $this->add_tag($p_id,"용역",$tag_where);
		}
		if(strpos($title, "입찰") !== false) {  
		    $this->add_tag($p_id,"입찰",$tag_where);
		}
		if(strpos($title, "콘서트") !== false) {  
		    $this->add_tag($p_id,"콘서트",$tag_where);
		}
		if(strpos($title, "교육") !== false) {  
		    $this->add_tag($p_id,"교육",$tag_where);
		}
		if(strpos($title, "공채") !== false) {  
		    $this->add_tag($p_id,"공채",$tag_where);
		}
		if(strpos($title, "적정기술") !== false) {  
		    $this->add_tag($p_id,"적정기술",$tag_where);
		}
		if(strpos($title, "기부") !== false) {  
		    $this->add_tag($p_id,"기부",$tag_where);
		}
		if(strpos($title, "다문화") !== false) {  
		    $this->add_tag($p_id,"다문화",$tag_where);
		}
		if(strpos($title, "공동체") !== false) {  
		    $this->add_tag($p_id,"공동체",$tag_where);
		}
		if(strpos($title, "CSR") !== false) {  
		    $this->add_tag($p_id,"CSR",$tag_where);
		}
		if(strpos($title, "사회공헌") !== false) {  
		    $this->add_tag($p_id,"사회공헌",$tag_where);
		}
		if(strpos($title, "공모") !== false) {  
		    $this->add_tag($p_id,"공모",$tag_where);
		}
		if(strpos($title, "개발협력") !== false) {  
		    $this->add_tag($p_id,"개발협력",$tag_where);
		}
		if(strpos($title, "ODA") !== false) {  
		    $this->add_tag($p_id,"ODA",$tag_where);
		}
		if(strpos($title, "자원봉사") !== false) {  
		    $sl_cate = 9;
		}
	}

	//tag 정보 가져와서 자동 분류하기
	function tag_auto_filtering_from_rss($p_id,$tags){

		$tags=explode(",",$tags); 
		for($i=0; $i<sizeof($tags); $i++) 
		{ 
			$tag_title = $tags[$i];
			$this->add_tag($p_id,$tag_title,1);
		}
	}

	//카테고리 정보에서 기본 태그 분류하기
	function tag_auto_filtering_from_cate($p_id,$cate_title){
		$tags = '';
		if($cate_title=="입찰 공고"){
			$tag_txt = '입찰';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="채용"){
			$tag_txt = '채용';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="나눔교육"){
			$tag_txt = '나눔교육';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="교육"){
			$tag_txt = '교육';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="사업개발자 역량강화"){
			$tag_txt = '역량 강화';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="사람들"){
			$tag_txt = '화제의 인물';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="행사"){
			$tag_txt = '행사';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="공고"){
			$tag_txt = '공고';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="봉사활동"){
			$tag_txt = '봉사활동';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="국제기구공고"){
			$tag_txt = '채용,국제기구공고';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="채용공고 - 국내 외국계 기업"){
			$tag_txt = '채용,국내 외국계 기업';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="채용공고 - 아시아 태평양"){
			$tag_txt = '채용,아시아 태평양';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="채용공고 - 미주/구미주 외"){
			$tag_txt = '채용,미주/구미주 외';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="채용공고 - 기타"){
			$tag_txt = '채용';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="ODAwatch - 뉴스레터"){
			$tag_txt = '뉴스레터,PDF,ODA watch';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="ODA watch - 자료마당"){
			$tag_txt = '자료집, PDF, ODA watch';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="ODA KOREA - 정책 및 연구자료"){
			$tag_txt = '연구자료,PDF,정책,보고서';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="ODA KOREA - 이야기"){
			$tag_txt = '자료집,PDF,이야기';
			$tags = $tags.",".$tag_txt;
		}else if($cate_title=="Spark 이야기"){
			$tag_txt = 'facebook page-spark,이야기';
			$tags = $tags.",".$tag_txt;
		}else{
			$tag_txt = '';
		}

		$tags=explode(",",$tags); 
		for($i=0; $i<sizeof($tags); $i++) 
		{ 
			$tag_title = $tags[$i];
			$this->add_tag($p_id,$tag_title,1);
		}
	}

	function get_title($url){

		$content = file_get_contents("http://".$aurl);
			if ($content !== false) {
				$str2 = strtolower($content); // 문자를 소문자로 변경.
				preg_match('~<title>(.*?)</title>~si', $str2, $title);
				$surve['title']=$title[1]; // <title>을 기준으로 자른 내용을 변수에 넣어라.
		} else {
					$surve['title']="원하는 제목을 입력해 주세요.";
		}
	}

	function add_tag($p_id,$title,$tag_where){
		if($title==''){

		}else{
			$this->db->from('sl_tag_info');
			$this->db->where('tg_title',$title);
			$this->db->order_by('tg_id','desc');
			$this->db->limit(1);	
			$query_search=$this->db->get();
			if ($query_search->num_rows()){
				//기존 태그가 있으면 태그값 받기
				foreach ($query_search->result_array() as $row)
				{
					//print_r($row);
					$tg_id = $row['tg_id'];
				}
			}else{
				//등록되지 않은 태그 정보라면, 기록하고 태그 아이디 받기
				$new_tag=array(
				'tg_title'=>$title
					);
			
				$this->db->insert('sl_tag_info',$new_tag);

				//new tag_id 가져오기
				$this->db->from('sl_tag_info');
				$this->db->where('tg_title',$title);
				$this->db->order_by('tg_id','desc');
				$this->db->limit(1);	
				$query_search=$this->db->get();
				if ($query_search->num_rows()){
					//기존 태그가 있으면 태그값 받기
					foreach ($query_search->result_array() as $row)
					{
						//print_r($row);
						$tg_id = $row['tg_id'];
					}
				}
			}

			//tag와 페이지 혹은 도메인 정보 연결하기
			//해당하는 tag_id가 기존에 등록되어 있다면 열외하기
			$this->db->from('sl_tag_page');
			$this->db->where('tg_id',$tg_id);
			if($tag_where==1){
				$this->db->where('p_id',$p_id);
			}else if($tag_where==2){
				$this->db->where('d_id',$p_id);
			}
			$this->db->where('check_where',$tag_where);
			$this->db->order_by('tg_id','desc');
			$this->db->limit(1);	
			$query_search=$this->db->get();
			if ($query_search->num_rows()){
				//기존에 등록된 값이 있으니, 제외하기
				//echo "기존 태그 정보가 있습니다.";
			}else{
				//신규 정보 입력하기
				if($tag_where==1){
					$new_tag=array(
					'tg_id'=>$tg_id,
					'p_id'=>$p_id,
					'check_where'=>$tag_where
						);
				
					$this->db->insert('sl_tag_page',$new_tag);
				}else if($tag_where==2){
					$new_tag=array(
					'tg_id'=>$tg_id,
					'd_id'=>$p_id,
					'check_where'=>$tag_where
						);
				
					$this->db->insert('sl_tag_page',$new_tag);
				}
				//echo "신규 태그 정보를 입력했습니다.";
			}
		}
	}

	//최근 한달 태그정보 중 중복 이상 사용된 태그들을 변수로 만들기
	function get_hot_tags_array(){
		$week_ago = date("Y-m-d H:i:s", strtotime("-7 days")); //10분전
		//최근 한주 정보 분포 - 카테고리별
		$this->db->from('sl_tag_page');
		$this->db->join('sl_tag_info', 'sl_tag_info.tg_id = sl_tag_page.tg_id');
		$this->db->select('count(sl_tag_page.tg_id), sl_tag_page.tg_id, sl_tag_info.tg_title, sl_tag_page.p_id, sl_tag_page.d_id');
		$this->db->where('sl_tag_page.date >=', $week_ago);
		$this->db->group_by('sl_tag_page.tg_id');
		$this->db->order_by('count(sl_tag_page.tg_id)','desc');
		//$this->db->where('admin_check',0);
		$query1=$this->db->get();
		$i = 0;
		if ($query1->num_rows()){
			foreach ($query1->result_array() as $row)
			{
				$tg_id = $row['tg_id'];
				$tg_title = $row['tg_title'];
				$p_id = $row['p_id'];
				$d_id = $row['d_id'];
				$tag_count = $row['count(sl_tag_page.tg_id)'];
				//글자 수 계산하기 - 글자 수가 1개면 등록 안되도록.. 그래야 오류값이 없을 듯
				$title_len = mb_strlen($tg_title, 'utf-8');

				//tag가 중복 이상 된 것들만 출력하기
				if($tag_count>2 && $title_len > 1){
					$tag_info[$i]['tg_id'] = $tg_id;
					$tag_info[$i]['tg_title'] = $tg_title;
					$tag_info[$i]['count']= $tag_count;

					//echo $tg_title."(".$tag_count."),&nbsp;";
					$i++;
				}
			}
		}
		return $tag_info;
	}

	//tag 정보 가져와서 자동 분류하기
	function tag_auto_filtering_from_db($p_id,$keyword,$tag_info){

		for($k=0; $k<sizeof($tag_info); $k++) 
		{ 
			$check_keyword = $tag_info[$k]['tg_title'];
			$title_len = mb_strlen($check_keyword, 'utf-8');
			if(strpos($keyword, $check_keyword) !== false) {  
			    $this->add_tag($p_id, $check_keyword ,1);
			    //echo '탐색됨 -'.$check_keyword.'글자 크기'.$title_len.'<br/>';
			}
		}
	}

	//단축주소값 찾기
	function get_short_id_db($p_id)
	{
		$this->db->from('sl_page_info');
		if($p_id !=''){
			$this->db->where('p_id',$p_id);
		}
		$this->db->order_by('p_id','DESC ');
		$this->db->limit(1);	
		$query1=$this->db->get();
		if ($query1->num_rows()){
			foreach ($query1->result_array() as $row)
			{
			//print_r($row);
			return $row['p_id'];
			}
		}
			
	}
	//단축주소 만들기
	function trans_short($short_id)
	{
		$base=array_combine(range(0,9),range('0','9'))+array_combine(range(10,35),range('a','z'))+array_combine(range(36,61),range('A','Z'));		
		//기본 단축 후 다음 단축주소 생성때부턴 이걸 쓰도록$short_id++;
		for ($i=0;$i<20;$i++){			
			$result[$i]=$short_id%62;
			if ($short_id<62){
				break;
			}
			$short_id=floor($short_id/62);			
		}
		$short_char='';
		foreach ($result as $formula){
			$short_char=$base[$formula].$short_char;
		}
		return $short_char;
	}

}
?>