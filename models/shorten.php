<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  recomand
 *
 * This model represents user recommand URL data. It operates the following tables:
 * - ithnkso_short_data
 * 
 * - ithnkso_short_user
 * 
 * 
 */
class Shorten extends CI_Model{
	
	public function __construct(){
		 // Call the Model constructor
            parent::__construct();
	     }
	function shor_data($short1,$short2,$short3)
	{
		$sql="select * from ithnkso_short_data where short IN ( ? , ? ,? )";
		$query=$this->db->query($sql, array($short1,$short2,$short3) );
		return $query;
	}
	
	function short_data($shorts)
	{
		$this->db->where_in('short', $shorts);
		$query = $this->db->get('ithnkso_short_data');
		return $query;
	}
	
	function user_base_recommand($user_id){
		$sql="select * from ithnkso_short_user where short NOT IN (select short from ithnkso_short_user where uid_user = ?) group by short order by rand() limit 3";
		// $sql="select * from ithnkso_short_user where uid_user != ? group by short order by rand() limit 3";
		$query=$this->db->query($sql, array($user_id) );
		$shorts=array();
		foreach ($query->result_array() as $row){
			array_push($shorts,$row['short']);
		}
		return $shorts;		
	}
	     
	function gen_short(){
					$BASECODE = array();
					$BASECODE['items'] = 62;
					$BASECODE[0]='0';
					$BASECODE[1]='1';
					$BASECODE[2]='2';
					$BASECODE[3]='3';
					$BASECODE[4]='4';
					$BASECODE[5]='5';
					$BASECODE[6]='6';
					$BASECODE[7]='7';
					$BASECODE[8]='8';
					$BASECODE[9]='9';
					$BASECODE[10]='a';
					$BASECODE[11]='b';
					$BASECODE[12]='c';
					$BASECODE[13]='d';
					$BASECODE[14]='e';
					$BASECODE[15]='f';
					$BASECODE[16]='g';
					$BASECODE[17]='h';
					$BASECODE[18]='i';
					$BASECODE[19]='j';
					$BASECODE[20]='k';
					$BASECODE[21]='l';
					$BASECODE[22]='m';
					$BASECODE[23]='n';
					$BASECODE[24]='o';
					$BASECODE[25]='p';
					$BASECODE[26]='q';
					$BASECODE[27]='r';
					$BASECODE[28]='s';
					$BASECODE[29]='t';
					$BASECODE[30]='u';
					$BASECODE[31]='v';
					$BASECODE[32]='w';
					$BASECODE[33]='x';
					$BASECODE[34]='y';
					$BASECODE[35]='z';
					$BASECODE[36]='A';
					$BASECODE[37]='B';
					$BASECODE[38]='C';
					$BASECODE[39]='D';
					$BASECODE[40]='E';
					$BASECODE[41]='F';
					$BASECODE[42]='G';
					$BASECODE[43]='H';
					$BASECODE[44]='I';
					$BASECODE[45]='J';
					$BASECODE[46]='K';
					$BASECODE[47]='L';
					$BASECODE[48]='M';
					$BASECODE[49]='N';
					$BASECODE[50]='O';
					$BASECODE[51]='P';
					$BASECODE[52]='Q';
					$BASECODE[53]='R';
					$BASECODE[54]='S';
					$BASECODE[55]='T';
					$BASECODE[56]='U';
					$BASECODE[57]='V';
					$BASECODE[58]='W';
					$BASECODE[59]='X';
					$BASECODE[60]='Y';
					$BASECODE[61]='Z';
					$query=$this->db->query("select count(*) from ithnkso_short_key");
					$row = $query->row_array();
					$num= $row["count(*)"]+1;

	
					for ($i=0;$i<20;$i++){			
						$result[$i]=$num%62;
						if ($num<62){
							break;
						}
						$num=floor($num/62);			
					}
					$shor='';
					foreach ($result as $formula){
						$shor=$BASECODE[$formula].$shor;
					}
					return $shor;
	}     	
	     
	function fetch_title($url)	{  //해당 URL이 유요한지 확인하고, 제목값을 가져오는 함수 url은 변수로 받음.
	    if (!preg_match('~^https?://~i', $url))
	    {
	        trigger_error('Invalid URL given in ' . __FUNCTION__, E_USER_NOTICE);
	        return false;
	    }
	
	    if (!$content = @file_get_contents($url))
	    {
	        return false;
	    }
	    else if (!preg_match('~<title>(.*?)</title>~si', $content, $title))
	    {
	        return false;
	    }
	
	    return $title[1];
	}  

	
	
	
	function ss1(){
		$aurl= substr($_SERVER['REQUEST_URI'],1);
		$now_user=$this->session->userdata('user_id'); //현재 로그인한 아이디를 변수에 대입. 쿼리문에 &this->session 형태로 안 들어감!
		$user_no=$this->session->userdata('mem_str'); //현재 로그인한 회원번호를 변수에 대입. 쿼리문에 &this->session 형태로 안 들어감!
		$viewpage='share';
				
		$query = $this->db->query("select * from trialp_input where source_url='$aurl' and User_id = '$now_user' limit 1 "); 
		//이전에 지금 로그인한 이 사람이 같은걸 공유한적 있는지 찾아보는 구문  
   		if ($query->num_rows()){
   			$row0=$query->row();
   			$surve['title']=$row0->source_title;
   			$surve['shorten']=$row0->short;
			$query1 = $this->db->query("select User_id from trialp_input where source_url='$aurl' and User_id != '$now_user' order by input_time desc");
			$making_str="'";
   			if ($query1->result()){
					// 쿼리 결과값이 있으면, 쿼리결과랑 loged변수 값을 3로 해서 share에 전달. 
					foreach($query1->result() as $item){
								$making_str=$making_str.$item->User_id."', '";
					}
   					$com_str=substr($making_str,0,-3); // 나와 같은 정보를 공유한 사람들의 아이디. 
					//$sql = "select * from (SELECT * FROM `trialp_input` WHERE `user_id` IN (".$com_str.") group by User_id) a where 'source_title' IS NOT NULL order by a.input_time desc limit 3";
					$sql = "select * from (select * from `trialp_input` WHERE `user_id` IN (".$com_str.") ) a where a.source_title IS NOT NULL group by a.user_id order by a.input_time desc";
					$query3 = $this->db->query($sql); // 같은 정보를 공유한 사람들이 공유한 단축주소들.
					$i=0;
					foreach ($query3->result() as $row){  //공유한 내용을 변수에 담는 과정.
						   $surve['data']['User_id'][$i]=$row->User_id;
						   $surve['data']['source_url'][$i]=$row->source_url;
						   $surve['data']['short'][$i]=$row->short;
						   $surve['data']['source_title'][$i]=$row->source_title;
						   $i++;
					}
   					$tridaytime=time()-259200;
					$sql = "select * from `trialp_input` WHERE source_title IS NOT NULL and User_id != '$now_user' group by User_id order by rand() limit 3";
					$query3 = $this->db->query($sql); // 아이디별로, 랜덤값을 3일이 안된 값 3개를 가져오거랏!
					foreach ($query3->result() as $row){  //공유한 내용을 변수에 담는 과정.
							$surve['data']['User_id'][$i]=$row->User_id;
							$surve['data']['source_url'][$i]=$row->source_url;
							$surve['data']['short'][$i]=$row->short;
							$surve['data']['source_title'][$i]=$row->source_title;
							$i++;
					}
					$surve['loop']=$i; //전체 내용이 몇개가 전달되었다고 표현하는 함수.
   			}
   			else {
				$tridaytime=time()-777777;
				$sql = "select * from `trialp_input` WHERE input_time > '$tridaytime' and User_id != '$now_user' group by User_id order by rand() limit 4";
					$query3 = $this->db->query($sql); // 아이디별로, 랜덤값을 3일이 안된 값 3개를 가져오거랏!
					$i=0;
					foreach ($query3->result() as $row){  //공유한 내용을 변수에 담는 과정.
						   $surve['data']['User_id'][$i]=$row->User_id;
						   $surve['data']['source_url'][$i]=$row->source_url;
						   $surve['data']['short'][$i]=$row->short;
						   $surve['data']['source_title'][$i]=$row->source_title;
						   $i++;
					}
					$surve['loop']=$i; //전체 내용이 몇개가 전달되었다고 표현하는 함수.
			}
   			$this->db->order_by("time", "desc"); 
			$query4=$this->db->get_where('trialp_comment',array('source_url'=>$aurl));
			$surve["comments"]=$query4;
			$surve['loged']=3; //loged변수값을 3으로 share에 전달  
			
			$viewpage='shared';	
    	}
    	else {
    		// 제목 뽑아오는 함수 시작 
    			$content = file_get_contents("http://".$aurl);
				if ($content !== false) {
					$str2 = strtolower($content); // 문자를 소문자로 변경.
					preg_match('~<title>(.*?)</title>~si', $str2, $title);
					$surve['title']=$title[1]; // <title>을 기준으로 자른 내용을 변수에 넣어라.
			} else {
   					$surve['title']="원하는 제목을 입력해 주세요.";
			}
			
			//	$surve['title']="원하는 제목을 입력해 주세요.";						
			// find the heighest ID
			$query2 = $this->db->query("select MAX(Uid) from trialp_input");
			$row=$query2->row_array();
			$shortURL = base_convert($row['MAX(Uid)']+1, 10, 36); 
			

			if ($this->session->userdata('logged_in')){
						// loged변수 값을 1로 해서 share에 전달. 	
						$surve['loged']=1;
			}
			else {
				// 로그인 안한 상태에서 공유한거면, loged 번수 값을 0으로 해서 share에 전달.
				$now_user=NULL;
				$surve['loged']=0;
			}
    		$input_data= array('session_id'=>$this->session->userdata('session_id'),
							   'User_id'=>$now_user,
							   'user_no'=>$user_no,
		        	           'access_ip'=>$this->session->userdata('ip_address'),
		            	       'input_time'=>time(),
		                	   'source_url'=>$_SERVER['REQUEST_URI'],
							   'source_title'=>$surve['title'],
							   'short'=>$shortURL);

			$this->db->insert('trialp_input', $input_data);  
			// 세션아이디, 로그인한 아이디, 접속한 아이피, 넣은 시간, 공유한 URL등을 DB에 넣는 작업(쿼리핼퍼이용) 
			$surve['shorten']=$shortURL; 
	
    	
    	}
		$surve['original']=$aurl; 
		$this->load->view($viewpage,$surve);
	}
	     
	function ss2(){
		
	/*			       				

			// 제목 뽑아오는 함수 시작.
	        // we can't treat it as an XML document because some sites aren't valid XHTML
	        // so, we have to use the classic file reading functions and parse the page manually
	        $fh = fopen("http://".$exploded_url[1], "r");
	        $str = fread($fh, 7500);  // read the first 7500 characters, it's gonna be near the top
	        fclose($fh);
	        $str2 = strtolower($str); // 문자를 소문자로 변경.
	        $start = strpos($str2, "<title>")+7; //자를 시작지점 지정.
	        $len   = strpos($str2, "</title>") - $start; //자를 끝지점 지정.
	        $surve['title']=substr($str, $start, $len); // <title>을 기준으로 자른 내용을 변수에 넣어라.
		
 
			
 

	*/	
	}



}
?>