<?php
namespace app\memo\control;
use dog\Control;
use dog\db\Db;
class Admin extends Base{
	
	public function index(){
		$data = $this->db->select('select * from m_memo');
		$this->assign('data', $data);
		$this->view(__FUNCTION__);
	}
	
	public function memo_edit(){
		$memo_id = $this->get_value('memo_id');
		$data = array('memo_id' => '','memo_title' => '','memo_content' => '','tag_names' => '');
		
		if( !empty($memo_id)){
			$data = $this->db->find('select * from m_memo where memo_id ='.$memo_id);	
		}
		$this->assign('data', $data);
		$this->view(__FUNCTION__);
	}
	
	public function memo_save(){
		$time = time();
		$memo_id = $this->get_value('memo_id');
		if(empty($memo_id)){
			$this->request['add_time'] = $time;
			$this->request['update_time'] = $time;
			$this->request['data_time'] = $time;
			$memo_id = $this->db->insert('m_memo', $this->request);	
			$this->_save_tags($memo_id, $this->request['tag_names']);
		}
		return 'success';
	}
	
	private function _save_tags($memo_id,$tag_names){
		if(!empty($tag_names)){
			$tags = explode(',', trim($tag_names));
			
			foreach ($tags as $key => $value){
				$tags[$key] = ucwords(strtolower($value));
			}
			
			$tags = array_unique($tags);
			
			$tag_ids_arr = [];
			$tag_names_arr = [];
			$this->db->delte('m_tag_map', "memo_id = $memo_id ");
			foreach ($tags as $tag_name){
				$tag_id = $this->db->select("select tag_id from m_tag where tag_name = '".$tag_name."' ");
				if(empty($tag_id)){
					$tag_id = $this->db->insert('m_tag', ['tag_name' => $tag_name,'add_time' => time()]);
				}else{
					$tag_id = $tag_id[0]['tag_id'];
				}
				$tag_ids_arr[] = $tag_id;
				$tag_names_arr[] = $tag_name;
				
				$this->db->insert('m_tag_map', ['tag_id' => $tag_id,'memo_id' => $memo_id]);
			}
			$this->db->update('m_memo', 
					['tag_ids' => implode(',', $tag_ids_arr),
					 'tag_names' => implode(',', $tag_names_arr)
					], 
					'memo_id='.$memo_id);
		}
	}
}