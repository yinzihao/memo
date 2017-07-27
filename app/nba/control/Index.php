<?php
namespace app\nba\control;
use dog\Control;
class Index {
	public function index(){
		
		$nab_data = [
				'2017' => 
					[
						'DJ5'   => 'http://sportswebapi.qq.com/kbs/matchStat?from=nba_database&selectParams=teamRank,periodGoals,playerStats,nbaPlayerMatchTotal,maxPlayers&mid=100000:1470064&_=1495761499386',
						'G1' 	=> 'http://sportswebapi.qq.com/kbs/matchStat?from=nba_database&selectParams=teamRank,periodGoals,playerStats,nbaPlayerMatchTotal,maxPlayers&mid=100000:1470067&_=1496365647437',
						'G2'    => 'http://sportswebapi.qq.com/kbs/matchStat?from=nba_database&selectParams=teamRank,periodGoals,playerStats,nbaPlayerMatchTotal,maxPlayers&mid=100000:1470068&_=1496622817388',
					 	'G3'    => 'http://sportswebapi.qq.com/kbs/matchStat?from=nba_database&selectParams=teamRank,periodGoals,playerStats,nbaPlayerMatchTotal,maxPlayers&mid=100000:1470069&_=1496885406873'				
					]
		];
		$url = $nab_data[$_REQUEST['year']][$_REQUEST['match']];
		
		//字符串不足自动补充
		/* $str = ' abc ';
		$newStr= str_pad($str, 10, " ", STR_PAD_RIGHT);
		echo $newStr; */
		$now_date = date('Y-m-d H:i:s');
		echo "系统当前时为：".date('Y-m-d H:i:s').'<br/><br/>';
		$last_date = !empty($_REQUEST['date'])?$_REQUEST['date']:'';
		echo "上次刷新时间为：".$last_date.'<br/><br/>';


		//$url = 'http://sportswebapi.qq.com/kbs/matchStat?from=nba_database&selectParams=teamRank,periodGoals,playerStats,nbaPlayerMatchTotal,maxPlayers&mid=100000:1470064&callback=jQuery11130795900823682751_1495761499385&_=1495761499386';
		//初始化
	    $curl = curl_init();
	    //设置抓取的url
	    curl_setopt($curl, CURLOPT_URL, $url);
	    //设置头文件的信息作为数据流输出
	    //curl_setopt($curl, CURLOPT_HEADER, 1);
	    //模拟火狐浏览器头部
	    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0');
	    //设置获取的信息以文件流的形式返回，而不是直接输出。
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    //执行命令
	    $data = curl_exec($curl);
	    //关闭URL请求
	    curl_close($curl);
	    //显示获得的数据
	    echo '<pre>';
	   $data = json_decode($data,true);
	    
	   $players = $data['data']['playerStats'];
	   
	   
	   
	   
	   $str = '<table>';
	   foreach ($players['left'] as $value){
	   	if(isset($value['head'])){
	   		$str.= '<tr><td>'. implode('</td><td>', $value['head']).'</td></tr>';
	   	}else{
	   		$str.='<tr><td>'.implode('</td><td>', $value['row']).'</td></tr>';
	   	}
	   }
	   $str.='<tr><td colspan="20"><hr/></td></tr>';
	   

	   foreach ($players['right'] as $value){
	   	if(isset($value['head'])){
	   		$str.= '<tr><td>'. implode('</td><td>', $value['head']).'</td></tr>';
	   	}else{
	   		$str.='<tr><td>'.implode('</td><td>', $value['row']).'</td></tr>';
	   	}
	   }
	   $str.='</table><br/>';
	   echo $str;
	   

	   //<!--JS 页面自动刷新 -->
	   echo ("<script type=\"text/javascript\">");
	   echo ("function fresh_page()");
	   echo ("{");
	   echo ("window.location.href='$_SERVER[PHP_SELF]?year=$_REQUEST[year]&match=$_REQUEST[match]&date=$now_date';");
	   echo ("}");
	   echo ("setTimeout('fresh_page()',60000);");
	   echo ("</script>");
	   
	}
}