<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Excel_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    //유입 경로 분석
    function getEvent1($p_num){
        
        $i = 0;
        $in_site = 0;
        $out_site = 0;
        $result = array();
        $this->db->from('gwon_page_attempts');
        $this->db->select('p_num, referer_url, referer_domain, count(referer_domain), date');
        $this->db->group_by('referer_domain');
        $this->db->where('p_num', $p_num);
        $this->db->order_by('count(referer_domain)','DESC');
        //$this->db->select('description');
        $query2=$this->db->get();

        if ($query2->num_rows()){
            foreach ($query2->result_array() as $row1)
            {
                //print_r($row1);
                //echo '<br/>';
                /*
                user_agent 정보를 어떻게 분기해서 보여줄까?
                1. Window, macintosh, iPhone, iPod, iPad,Android, bot 등 분기해서 보여주기
                2. 데스크탑, 모바일 확인하기
                */
                $check_domain = strstr($row1['referer_domain'], $this->config->item('service_url')); // 문자열 비교
                if($check_domain){
                    $in_site = $in_site+(1*$row1['count(referer_domain)']);
                }else{
                    $out_site = $out_site+(1*$row1['count(referer_domain)']);
                }
                /**/
                if($row1['referer_domain']== ''){
                    //리퍼러 값이 없다면, 값에 추가하지 않기(리퍼러 관련 코드 삽입 전)
                }else{
                    //print_r($row1);
                    //title값 가져오기
                    //전체 날짜 보기 관련 변수
                    $result['ref_log'][$i]['p_num']=$row1['p_num'];
                    $result['ref_log'][$i]['referer_domain']=$row1['referer_domain'];
                    $result['ref_log'][$i]['referer_url']=$row1['referer_url'];
                    $result['ref_log'][$i]['referer_count']=$row1['count(referer_domain)'];
                    $result['ref_log'][$i]['date']=$row1['date'];
                    
                    $i++;
                    
                }
            }
        }

        $result['in_site'] = $in_site;
        $result['out_site'] = $out_site;
        return $result;
    }
    //콘텐츠 구독여부
    function getEvent2($p_num){
        $sql    = "SELECT con_read, count(con_read) as count_read FROM gwon_page_attempts WHERE p_num = $p_num GROUP BY con_read  ORDER BY count_read DESC";
        $query  = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        }
        return $result;
    }
    //국가 정보
    function getEvent3($p_num){
        $sql    = "SELECT region, count(country_code) as count_country, country_name, country_code FROM gwon_page_attempts WHERE p_num = $p_num GROUP BY country_code  ORDER BY count_country DESC";
        $query  = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        }
        return $result;
    }

    //채널 공유 횟수-intropage
    function getEvent4($p_num){
        $sql    = "SELECT p_num, count(like_project) as count_like FROM gwon_support_project WHERE p_num = $p_num AND like_project >= 1 GROUP BY like_project ORDER BY count_like DESC";
        $query  = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        }else{
            $result = '';
        }
        return $result;
    }
    //채널 공유 횟수-fb
    function getEvent5($p_num){
        $sql    = "SELECT p_num, count(fb_upload) as count_fb FROM gwon_support_project WHERE p_num = $p_num AND fb_upload >= 1 GROUP BY fb_upload ORDER BY count_fb DESC";
        $query  = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        }else{
            $result = '';
        }
        return $result;
    }
    //채널 공유 횟수-twitter
    function getEvent6($p_num){
        $sql    = "SELECT p_num, count(twt_upload) as count_twt FROM gwon_support_project WHERE p_num = $p_num AND twt_upload >= 1 GROUP BY twt_upload ORDER BY count_twt DESC";
        $query  = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        }else{
            $result = '';
        }
        return $result;
    }
    //채널 공유 횟수-kakao
    function getEvent7($p_num){
        $sql    = "SELECT p_num, count(kakao_upload) as count_kakao FROM gwon_support_project WHERE p_num = $p_num AND kakao_upload >= 1 GROUP BY kakao_upload ORDER BY count_kakao DESC";
        $query  = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        }else{
            $result = '';
        }
        return $result;
    }

    //device 정보
    function getEvent8($p_num){
        $sql    = "SELECT p_num, user_agent, COUNT( user_agent ) AS count_agent, DATE
                    FROM gwon_page_attempts
                    WHERE p_num = $p_num
                    GROUP BY user_agent
                    ORDER BY count_agent DESC";
        $query  = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        }
        return $result;
    }

    //Total
    function getEvent9($p_num){
       //방문자 - total
        $this->db->where('p_num', $p_num);
        $this->db->from('gwon_page_attempts');
        $result = $this->db->count_all_results();
        return $result;
    }
    //Today Count
    function getEvent10($p_num){
       //방문자 - total
        $date_time=date('Y-m-d');
        $this->db->where('p_num', $p_num);
        $this->db->like('date', $date_time);
        $this->db->from('gwon_page_attempts');
        $result = $this->db->count_all_results();
        return $result;
    }
    //날짜별 방문자 정보 - 최근 3개월
    function getEvent11($p_num, $publish_date){
        //최근 한주 방문기록 및 공유 정보 가져오기
        $ymd = date("Ymd");

        $y = substr($ymd, 0, 4);
        $m = substr($ymd, 4, 2);
        $d = substr($ymd, 6, 2);

        $s_y = substr($publish_date, 0, 4);
        $s_m = substr($publish_date, 4, 2);
        $s_d = substr($publish_date, 6, 2);

        for($i=112;$i>-1;$i--){
            $target_date = date("Y-m-d", mktime(0,0,0,$m,$d-$i,$y)); // 전날 YYYYMMDD형식
            if($publish_date<=$target_date){
                $this->db->where('p_num', $p_num);
                $this->db->like('date', $target_date);
                $this->db->from('gwon_page_attempts');
                $result[$i]['date'] = $target_date;
                $result[$i]['count'] = $this->db->count_all_results();

                $this->db->where('p_num', $p_num);
                $this->db->like('date', $target_date);
                $this->db->from('gwon_support_project');
                $result[$i]['shared'] = $this->db->count_all_results();
            }
            
        }
        return $result;
    }
    //시간대별 방문 기록 및 공유 정보
    function getEvent12($p_num){
        
        for($i=0;$i<24;$i++){
            $this->db->select('HOUR(DATE),count(date)');
            $this->db->from('gwon_page_attempts');
            $this->db->where('p_num', $p_num);
            $this->db->where('HOUR(DATE)', $i);
            $this->db->group_by('HOUR( DATE )');
            
            $result[$i]['date'] = $i;
            $result[$i]['count'] = $this->db->count_all_results();

            $this->db->select('count(date)');
            $this->db->where('p_num', $p_num);
            $this->db->where('HOUR(DATE)', $i);
            $this->db->from('gwon_support_project');
            $result[$i]['shared'] = $this->db->count_all_results();
        }


        return $result;
    }
    //시간대별 방문 기록 및 공유 정보
    function getEvent13($p_num){
        $sql    = "SELECT *
                    FROM gwon_project_event_memo
                    WHERE p_num = $p_num AND memo_state = 1
                    ORDER BY event_date asc ";
        $query  = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        }
        return $result;
    }
}
