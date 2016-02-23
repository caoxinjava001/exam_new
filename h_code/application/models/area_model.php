<?php
/**
 * Area_Model 
 * 
 * @uses MY
 * @uses _Model
 * @package 
 * @version $Id$
 * @author jackcao <caoxin@159jh.com> 
 */
class Area_Model extends MY_Model{
	public function __construct() {
		parent::__construct();
		$this->_table = "h_area";	// 表名
		$this->initDB();
	}
	
	/**
	 * 获取省份列表
	 */
	public function getProvinceList(){
		//$data = cacheFileGet('city/province_list');
		$data = false;
		if($data === false){
			$where = "parent_id =0 and dele_status=". NO_DELETE_STATUS;
			$list = $this->select('id,name',$where,300);
			if($list){
				$data = array();
				foreach($list as $k=>$v){
					if($v['id'] == 0){continue;}
					$data[$v['id']] = $v;
				}
				ksort($data);
				//cacheFileSave('city/province_list', $data,86400);
			}
		}
		return $data;
	}
	
	/**
	 * 根据省份id获取城市列表
	 */
	public function getCityByPid($pid){
		if(!is_numeric($pid)){
			return array();
		}
		//$data = cacheFileGet('city/city_list_'.$pid);
		$data = false;
		if($data === false){
			$list = $this->select('id,name',array('parent_id'=>$pid),300);
			if($list){
				$data = array();
				foreach($list as $k=>$v){
					if($v['id'] == 0){continue;}
					$data[$v['id']] = $v;
				}
				ksort($data);
				//cacheFileSave('city/city_list_'.$pid, $data,86400);
			}
		}
		return $data?$data:array();
	}
}
