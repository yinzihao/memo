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
}