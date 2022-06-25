<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');


      function  get_module_content_index_top($module ,$order){
          /*
            모듈 호출할때 뷰페이지 쓸 펑션 라이브러리
            module_sort=> 순서  최상단 0
            $div_con =>  1 최상단

          */



            $i=0;
            $in = false;
            
          


            foreach($module as $key=>$item){
                $order_key=$order-1;
                
                $split = explode("-",$item->module_sort);
  
                if($split[1]!=""){
                  if( (int)$order == (int)$split[0] && (int)$split[1] ==1 ){

                      $ret[$i]= $key;
                      $in = true;
                      $i++;
                  }
                  }
              }

           
            if($in){
                return $ret;
            }else{
                return false;
            }



      }
         function  get_module_content_index_bottom($module ,$order){
          /*
            모듈 호출할때 뷰페이지 쓸 펑션 라이브러리
            module_sort=> 순서  최상단 0
            $div_con =>  1 최상단

          */



            $i=0;
            $in = false;
            
          


            foreach($module as $key=>$item){
                $order_key=$order-1;
                
                $split = explode("-",$item->module_sort);
              
                if($split[1]!=""){
                  if( (int)$order == (int)$split[0] && (int)$split[1] ==2 ){

                      $ret[$i]= $key;
                      $in = true;
                      $i++;
                  }
                  }
              }

           
            if($in){
                return $ret;
            }else{
                return false;
            }



      }
      function  get_module_index($module ,$order){
          /*
            모듈 호출할때 뷰페이지 쓸 펑션 라이브러리
            module_sort=> 순서  최상단 0
            $div_con =>  1 최상단

          */
            $i=0;
            $in = false;
            
            foreach($module as $key=>$item){
              $order_key=$order-1;

              if(strlen($item->module_sort)<3){
                  if( (int)$item->module_sort == (int)$order_key){

                      $ret[$i]= $key;
                      $in = true;
                      $i++;
                  }
              }

            }
            if($in){
                return $ret;
            }else{
                return false;
            }



      }

     function get_member_check($team,$id)

     {

         $ret =false;
         foreach ($team as $item) {
                if($item[user_id] == $id){

                    $ret = true;

                }

         }

      return $ret;



     }




?>
