<?php
namespace app\index\control;
use dog\Control;
class Index extends Base{
	
	public function index(){
		include ROOT_PATH.'sphinxapi.php';
		
		$keyword = empty($_REQUEST['keyword'])?'':$_REQUEST['keyword'];
		
		$data = [];

		if($keyword){

			$sphinx = new \SphinxClient();
			
			//sphinx的主机名和端口
			$sphinx->SetServer ('10.37.2.114',9312);
			
			//设置返回结果集为php数组格式
			$sphinx->SetArrayResult ( true );
			//分词，收集分词任何部分检索的结果
			$sphinx->SetMatchMode(SPH_MATCH_ANY);  
			//匹配结果的偏移量，参数的意义依次为：起始位置，返回结果条数，最大匹配条数
			$sphinx->SetLimits(0, 20, 1000);
			
			//最大搜索时间
			$sphinx->SetMaxQueryTime(10);
			//执行简单的搜索，这个搜索将会查询所有字段的信息，要查询指定的字段请继续看下文
			$index = 'test1';//索引源是配置文件中的 index 类，如果有多个索引源可使用,号隔开：'email,diary' 或者使用'*'号代表全部索引源
			
			$result = $sphinx->Query($keyword, $index);
			
			if(!empty($result['matches'])){
				$data = $result['matches'];
			}
		}

		$this->assign('keyword', $keyword);
		$this->assign('data', $data);
		$this->view(__FUNCTION__);
	}
	
	public function test(){
		echo '<pre>';
		$this->_keywordsMatchSort('red dress');
		$this->_keywordsMatchSort('dress red');
	}
	
	/**
	 * 	例：搜索 	red mini dress
		   完全匹配的词: lace red mini dress，lace up red mini dress等
			模糊匹配: red lace up mini dress, mini mermaid red dress等
			部分匹配:	high waisted red dress， cut out mini dress等
		2.若ABC词库当前匹配出来的设置为显示的词不足8个，则有多少显示多少
		3.如当前搜索词没有相匹配的设置为显示的词，则要隐藏展示位置，当词库里面有设置为显示的词，需要展示出来；
		4.所有展示出来的词不能重复，每次访问随机调取显示（希望随机性能在一段时间内把当前匹配出来的设置为显示的所有关键词都展示到页面上）
	
	 * @param string $keyword
	 * @param number $matchAll
	 * @param number $matchPortion
	 * @param number $matchDim
	 */
	public function _keywordsMatchSort($keyword = '', $matchAll = 10,$matchPortion = 5,$matchDim = 1){
		$data = ['red dress','mini red dress','dress','red mini','dress red'];
		$key_word_array = explode(' ', $keyword);
		
		sort($key_word_array);
		$sort_keyword = implode(' ', $key_word_array);

		$new_data = [];
		
		$new_data_weight = [];
		 foreach ($data as $key => $value){
		 	$value_array = explode(' ', $value);
		 	sort($value_array);
		 	$value_sort = implode(' ', $value_array);
			if($value_sort == $sort_keyword){
				$new_data[$key] = $value;
				$new_data_weight[$key] = $matchAll;
				continue;
			}
			
			if(strstr($value, $keyword)){
				$new_data[$key] = $value;
				$new_data_weight[$key] = $matchPortion;
				continue;
			}else if(strstr($value_sort, $keyword)){
				$new_data[$key] = $value;
				$new_data_weight[$key] = $matchPortion;
				continue;
			}
			
			foreach (explode(' ', $value) as $v){
				if(in_array($v, $key_word_array)){
					$new_data[$key] = $value;
					$new_data_weight[$key] = $matchDim;
					continue;
				}
			}
			
		}
		arsort($new_data_weight);
		print_r($new_data_weight);
		
		foreach ($new_data_weight as $k => $v){
			echo $data[$k].'<br/>';
		}
		
	}
}