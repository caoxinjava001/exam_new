<?php

/**
 * Exam 
 * 
 * @uses MY
 * @uses _Controller
 * @package 
 * @version $Id$
 * @author jackcao <caoxin@159jh.com> 
 */
class Exam extends MY_Controller{
    private $where; //where条件
    private $perpage=10; //每页条数
    private $login_role;
    private $member_id;
	private $answer_name_character = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F');//答案选项字
	private $answer_default_character =4;

    public function __construct(){
        parent::__construct();
        $this->load->model('exam_tag_kemu_model');
        $this->load->model('exam_tag_class_model');

        $this->load->model('exam_stem_model');
        $this->load->model('exam_model');
        $this->load->model('exam_tag_model');
        $this->page=$this->input->get('page')>=1?$this->input->get('page'):0;
        $this->login_role=$this->member_info['login_role_id'];
        $this->member_id=$this->member_info['id'];
    }


    /**
     * 列表页面
     */
    public function index(){
		$exam_tag_where['dele_status'] = NO_DELETE_STATUS;
		$exam_tag_list=$this->exam_tag_model->select('*',$exam_tag_where);

		$exam_class_tag_where['dele_status'] = NO_DELETE_STATUS;
		$exam_class_tag_list=$this->exam_tag_class_model->select('*',$exam_class_tag_where);

		$exam_kemu_tag_where['dele_status'] = NO_DELETE_STATUS;
		$exam_kemu_tag_list=$this->exam_tag_kemu_model->select('*',$exam_kemu_tag_where);


        $this->where= 'dele_status = '.NO_DELETE_STATUS;    //未删除的

        $select_id=$this->input->get_post('select_id'); //选择的卡状态
        if(strlen($select_id)>0){
            $select_id=intval($select_id);
            $this->where.= ' and cate_id = '.$select_id;
        }else{
            $select_id=null;
        }

        $class_select_id=$this->input->get_post('class_select_id'); //选择的卡状态
        if(strlen($class_select_id)>0){
            $class_select_id=intval($class_select_id);
            $this->where.= ' and class_cate_id = '.$class_select_id;
        }else{
            $class_select_id=null;
        }


        $kemu_select_id=$this->input->get_post('kemu_select_id'); //选择的卡状态
        if(strlen($kemu_select_id)>0){
            $kemu_select_id=intval($kemu_select_id);
            $this->where.= ' and kemu_cate_id = '.$kemu_select_id;
        }else{
            $kemu_select_id=null;
        }


        $s_name=$this->input->get_post('s_name'); //填写的代理商名字
        if($s_name){
            $this->where .= " and exam_name like '%{$s_name}%'";    //检索代理商
        }

        $start_time=trim($this->input->get_post('start_time')); //开始时间
        $end_time=trim($this->input->get_post('end_time')); //结束时间
        if($start_time){
            $s_time=str_replace('/','-',$start_time);
            $this->where.= " and created_time >='{$s_time}'";
        }
        if($end_time){
            $e_time=str_replace('/','-',$end_time);
            $this->where.= " and created_time <= '{$e_time}'";
        }

        $exam_list=$this->exam_model->list_info('*',$this->where,$this->page,$this->perpage);
		$exam_list = is_array($exam_list) ? $exam_list : array();
		foreach($exam_list as $key=>$val) {
			$where_tag['id'] = $val['class_cate_id'];
			$tmp_exam_tag_list=$this->exam_tag_class_model->get_one('*',$where_tag);
			$exam_list[$key]['class_tag_list'] = $tmp_exam_tag_list;

			$where_tag['id'] = $val['kemu_cate_id'];
			$tmp_exam_tag_list=$this->exam_tag_model->get_one('*',$where_tag);
			$exam_list[$key]['kemu_tag_list'] = $tmp_exam_tag_list;

			$where_tag['id'] = $val['cate_id'];
			$tmp_exam_tag_list=$this->exam_tag_model->get_one('*',$where_tag);
			$exam_list[$key]['tag_list'] = $tmp_exam_tag_list;
		}

        $data['start_time']=$start_time;
        $data['end_time']=$end_time;
        $data['class_select_id']=$class_select_id;
        $data['kemu_select_id']=$kemu_select_id;
        $data['select_id']=$select_id;
        $data['s_name']=$s_name;
        $data['exam_tag_list']=$exam_tag_list;
        $data['exam_class_tag_list']=$exam_class_tag_list;
        $data['exam_kemu_tag_list']=$exam_kemu_tag_list;
        $data['exam_list']=$exam_list;
        $data['pages']=pages($this->exam_model->getCount($this->where),$this->page,$this->perpage);
        $this->rendering_admin_template($data,'exam','exam_list');
    }

    /**
     * 创建信息
     */
    public function create(){
        $data=array();
		$id = $this->input->get_post('id');
		$id = intval($id);
		if ($id) {
			$exam_list = $this->exam_model->get_one("*",array("id"=>$id));
		}

		$exam_tag_where['dele_status'] = NO_DELETE_STATUS;
		$exam_tag_list=$this->exam_tag_model->select('*',$exam_tag_where);


		$exam_class_tag_where['dele_status'] = NO_DELETE_STATUS;
		$exam_class_tag_list=$this->exam_tag_class_model->select('*',$exam_class_tag_where);

		$exam_kemu_tag_where['dele_status'] = NO_DELETE_STATUS;
		$exam_kemu_tag_list=$this->exam_tag_kemu_model->select('*',$exam_kemu_tag_where);

		$data['data_info'] = $exam_list;
		$data['exam_tag_list'] = $exam_tag_list;
		$data['exam_class_tag_list'] = $exam_class_tag_list;
		$data['exam_kemu_tag_list'] = $exam_kemu_tag_list;
		$data['id'] = $id;
        $this->rendering_admin_template($data,'exam','exam_create');
    }

    public function createTwo(){
        $data=array();
		$id = $this->input->get_post('id');
		$id = intval($id);
		if (!$id) {
			$message = "非法操作";
			show_message($message);
		}
		$where_exam_stem['dele_status'] = NO_DELETE_STATUS;
		$where_exam_stem['exam_id'] = $id;
		$exam_stem_list = $this->exam_stem_model->select("*",$where_exam_stem,500,'id asc');
		$exam_stem_list = is_array($exam_stem_list) ? $exam_stem_list : array();
		$single_list = array();
		$judge_list = array();
		$more_list = array();
		foreach($exam_stem_list as $val) {
			$question_type= intval($val['stem_cate_id']);

			switch($question_type) {
				case EXAM_SINGLE:
					$single_list[]=$val;
					break;
				case EXAM_JUDGE:
					$judge_list[]=$val;
					break;
				case EXAM_MORE:
					$more_list[]=$val;
					break;
			}
		}
		$data['single_list'] = $single_list;
		$data['judge_list'] = $judge_list;
		$data['more_list'] = $more_list;
		$data['id'] = $id;
        $this->rendering_admin_template($data,'exam','exam_create_two');
    }

	private function addMoreQuestion($id,$question_type,$question_id=0){
		$list_detail['title'] = $this->input->post('title');//题干
		$answer = $this->input->post('answer');//答案选项
		if($answer){
			foreach($answer as $key => $value){
				if(empty($value)){
					break;
				}
				$answer_n[$key] = getSafeString($value,'<img>');
			}
		}
		$vv  =$this->input->post('correct_answer');//正确答案
		$list_detail['correct_answer'] = implode(',',$vv);
		$list_detail['correct_desc'] = trim($this->input->post('desc'));	 //答案解析
		$list_detail['answer'] = serialize($answer_n);
		$list_detail['stem_cate_id'] = $question_type;
		$list_detail['exam_id'] = $id;
		$now_date = date("Y-m-d H:i:s", time());
		$list_detail["modify_by"] = $this->member_id;
		$list_detail["modify_time"] = $now_date;

		if ($question_id) {
			$ret_id = $this->exam_stem_model->update($list_detail, array("id"=>$question_id));
		}else {
			$ret_id = $this->exam_stem_model->insert($list_detail,true);
		}

		$ret["status"] = 0;
		$ret["msg"] = $ret_id;
		createDomainAjax($ret["msg"], $ret["status"]);
	}

	private function addSigleQuestion($id,$question_type,$question_id=0){
		$list_detail['title'] = $this->input->post('title');//题干
		$answer = $this->input->post('answer');//答案选项
		if($answer){
			foreach($answer as $key => $value){
				if(empty($value)){
					break;
				}
				$answer_n[$key] = getSafeString($value,'<img>');
			}
		}
		$vv  =$this->input->post('correct_answer');//正确答案
		$list_detail['correct_answer'] = $vv[0];
		$list_detail['correct_desc'] = trim($this->input->post('desc'));	 //答案解析
		$list_detail['answer'] = serialize($answer_n);
		$list_detail['stem_cate_id'] = $question_type;
		$list_detail['exam_id'] = $id;
		$now_date = date("Y-m-d H:i:s", time());
		$list_detail["modify_by"] = $this->member_id;
		$list_detail["modify_time"] = $now_date;
		if ($question_id) {
			//var_dump($list_detail,$question_id);exit;
			$ret_id = $this->exam_stem_model->update($list_detail, array("id"=>$question_id));
		}else {
			$ret_id = $this->exam_stem_model->insert($list_detail,true);
		}

		$ret["status"] = 0;
		$ret["msg"] = $ret_id;
		createDomainAjax($ret["msg"], $ret["status"]);
	}

	private function addJudgeQuestion($id,$question_type,$question_id=0){
		
		$list_detail['title'] = $this->input->post('title');//题干
		$vv  =$this->input->post('correct_answer');//正确答案
		$list_detail['correct_answer'] = $vv[0];
		$list_detail['correct_desc'] = trim($this->input->post('desc'));	 //答案解析
		$list_detail['stem_cate_id'] = $question_type;
		$list_detail['exam_id'] = $id;
		$now_date = date("Y-m-d H:i:s", time());
		$list_detail["modify_by"] = $this->member_id;
		$list_detail["modify_time"] = $now_date;

		if ($question_id) {
//			var_dump($list_detail,$question_id);exit;
			$ret_id = $this->exam_stem_model->update($list_detail, array("id"=>$question_id));
		}else {
		$ret_id = $this->exam_stem_model->insert($list_detail,true);
		}
		$ret["status"] = 0;
		$ret["msg"] = $ret_id;
		createDomainAjax($ret["msg"], $ret["status"]);
	}

	public function addQuestionAjaxAction() {
		$id = $this->input->post('id');
		$question_type = $this->input->post('question_type');
		$question_id = $this->input->post('question_id_val');
		$question_id = intval($question_id);
		if (empty($id) || empty($question_type)) {
			$message = "非法操作";
			show_message($message);
		}
		switch($question_type) {
			case EXAM_SINGLE:
				$this->addSigleQuestion($id,$question_type,$question_id);
				break;
			case EXAM_JUDGE:
				$this->addJudgeQuestion($id,$question_type,$question_id);
				break;
			case EXAM_MORE:
				$this->addMoreQuestion($id,$question_type,$question_id);
				break;
		}
		exit;
		
	}

	public function oneUpdateAjaxAction() {
		$id = $this->input->post('s_id');                 // 视频名字
		$id = intval($id);
		if (!$id) {
			$ret["status"] = -6;
			$ret["msg"] = "非法操作[id不存在]";
			createDomainAjax($ret["msg"], $ret["status"]);
			exit;
		}
		$exam_name = $this->input->post('exam_name');
		$cate_id = $this->input->post('cate_id');
		$now_date = date("Y-m-d H:i:s", time());
		if (!$exam_name) {
			$ret["status"] = -1;
			$ret["msg"] = "请填名考试名称";
			createDomainAjax($ret["msg"], $ret["status"]);
			exit;
		}
		if (!$cate_id) {
			$ret["status"] = -2;
			$ret["msg"] = "请选择考试分类";
			createDomainAjax($ret["msg"], $ret["status"]);
			exit;
		}


		$class_cate_id = $this->input->post('class_cate_id');
		$kemu_cate_id = $this->input->post('kemu_cate_id');

		if (!$class_cate_id) {
			$ret["status"] = -9;
			$ret["msg"] = "请选择考试年级分类";
			createDomainAjax($ret["msg"], $ret["status"]);
			exit;
		}

		if (!$kemu_cate_id) {
			$ret["status"] = -10;
			$ret["msg"] = "请选择考试科目分类";
			createDomainAjax($ret["msg"], $ret["status"]);
			exit;
		}



		$content_ret["exam_name"] = $exam_name;
		$content_ret["class_cate_id"] = $class_cate_id;
		$content_ret["kemu_cate_id"] = $kemu_cate_id;
		$content_ret["cate_id"] = $cate_id;
		$content_ret["modify_by"] = $this->member_id;
		$content_ret["modify_time"] = $now_date;
		$ret_id = $this->exam_model->update($content_ret, array("id"=>$id));
		$ret["status"] = 0;
		$ret["msg"] = $id;
		createDomainAjax($ret["msg"], $ret["status"]);
	}

	public function oneAddAjaxAction() {
		$exam_name = $this->input->post('exam_name');
		$class_cate_id = $this->input->post('class_cate_id');
		$kemu_cate_id = $this->input->post('kemu_cate_id');

		if (!$class_cate_id) {
			$ret["status"] = -9;
			$ret["msg"] = "请选择考试年级分类";
			createDomainAjax($ret["msg"], $ret["status"]);
			exit;
		}

		if (!$kemu_cate_id) {
			$ret["status"] = -10;
			$ret["msg"] = "请选择考试科目分类";
			createDomainAjax($ret["msg"], $ret["status"]);
			exit;
		}


		$cate_id = $this->input->post('cate_id');
		$now_date = date("Y-m-d H:i:s", time());
		if (!$exam_name) {
			$ret["status"] = -1;
			$ret["msg"] = "请填名考试名称";
			createDomainAjax($ret["msg"], $ret["status"]);
			exit;
		}
		if (!$cate_id) {
			$ret["status"] = -2;
			$ret["msg"] = "请选择考试类型分类";
			createDomainAjax($ret["msg"], $ret["status"]);
			exit;
		}
		$content_ret["exam_name"] = $exam_name;
		$content_ret["class_cate_id"] = $class_cate_id;
		$content_ret["kemu_cate_id"] = $kemu_cate_id;
		$content_ret["cate_id"] = $cate_id;
		$content_ret["status"] = NO_DELETE_STATUS;
		$content_ret["created_time"] = $now_date;
		$content_ret["modify_by"] = $this->member_id;
		$content_ret["modify_time"] = $now_date;
		$content_ret["dele_status"] = NO_DELETE_STATUS;
		$ret_id = $this->exam_model->insert($content_ret, true);
		$ret["status"] = 0;
		$ret["msg"] = $ret_id;
		createDomainAjax($ret["msg"], $ret["status"]);
	}



	public function getQuestioninfoTpl() {
		$ret['status'] = 0;
		$ret['msg'] = '非法数据';
		$question_type = empty($_REQUEST['q_type_id'])?0:intval($_REQUEST['q_type_id']);//题型id
		if(empty($question_type)){
			echo  json_encode($ret);
			exit;
		}
		switch($question_type) {
			case EXAM_SINGLE:
				$result = 'admin/exam/single_exam';
				break;
			case EXAM_JUDGE:
				$result = 'admin/exam/judge_exam';
				break;
			case EXAM_MORE:
				$result = 'admin/exam/more_exam';
				break;
		}
		//$result = $this ->getTemplateByType($question_type);
		$content = $this->load->view($result,array(),true);
		//var_dump($content);exit;
		if($content){
			$ret['status'] = 1;
			$ret['msg'] = '有效数据';
			$ret['data'] = $content;
			echo  json_encode($ret);
			exit;
		}else{
			$ret['status'] = -1;
			$ret['msg'] = '非法数据.';
			echo  json_encode($ret);
			exit;
		}
	}




	public function delQuestion() {
		$ret['status'] = 0;
		$ret['msg'] = '非法数据';
		$id = empty($_REQUEST['id'])?0:intval($_REQUEST['id']);//题型id
		if(empty($id)){
			echo  json_encode($ret);
			exit;
		}
		$content_ret['dele_status'] = DELETE_STATUS;
		$ret_id = $this->exam_stem_model->update($content_ret, array("id"=>$id));
		$ret['status'] = 1;
		$ret['msg'] = '删除成功';
		$ret['data'] = $content;
		echo  json_encode($ret);
		exit;
	}


	public function updateQuestion() {
		$ret['status'] = 0;
		$ret['msg'] = '非法数据';
		$id = empty($_REQUEST['id'])?0:intval($_REQUEST['id']);//题型id
		if(empty($id)){
			echo  json_encode($ret);
			exit;
		}
		$exam_stem_list = $this->exam_stem_model->get_one("*",array("id"=>$id));
		$data['datas']['question_title'] = $exam_stem_list['title'];
		$data['datas']['correct_answer'] = $exam_stem_list['correct_answer'];
		$data['detail']['correct_desc'] = $exam_stem_list['correct_desc'];

		if(isset($exam_stem_list['answer'])&&!empty($exam_stem_list['answer'])){//
			$data['detail']['answer_array'] = unserialize($exam_stem_list['answer']);
			$data['detail']['answer_length'] = count($data['detail']['answer_array']);
			$data['detail']['answer_name_array'] = array_slice(array_slice($this ->answer_name_character,0,$data['detail']['answer_length']),$this->answer_default_character);
		}
		
		//var_dump($data);exit;
		$question_type = $exam_stem_list['stem_cate_id'];
		switch($question_type) {
			case EXAM_SINGLE:
			$xuan_list = '<option value="0">请选择</option><option value="'. EXAM_SINGLE.'"  selected="selected">单选题</option>
				<option value="'. EXAM_JUDGE.'">判断题</option>
				<option value="'.EXAM_MORE.'">多选题</option>';
				$result = 'admin/exam/single_exam';
				break;
			case EXAM_JUDGE:
			$xuan_list = '<option value="0">请选择</option><option value="'. EXAM_SINGLE.'"  >单选题</option>
				<option value="'. EXAM_JUDGE.'" selected="selected">判断题</option>
				<option value="'.EXAM_MORE.'">多选题</option>';
				$result = 'admin/exam/judge_exam';
				break;
			case EXAM_MORE:

				$data['datas']['correct_answer_array'] = explode(',',$exam_stem_list['correct_answer']);
			$xuan_list = '<option value="0">请选择</option><option value="'. EXAM_SINGLE.'"  >单选题</option>
				<option value="'. EXAM_JUDGE.'">判断题</option>
				<option value="'.EXAM_MORE.'"  selected="selected">多选题</option>';
				$result = 'admin/exam/more_exam';
				break;
		}
		$data['stem_list'] = $exam_stem_list;
			//$result = $this ->getTemplateByType($question_type);
		$content = $this->load->view($result,$data,true);
		//var_dump($content);exit;
		if($content){
			$ret['status'] = 1;
			$ret['msg'] = '有效数据';
			$ret['data'] = $content;
			$ret['xuan_list'] = $xuan_list;
			echo  json_encode($ret);
			exit;
		}else{
			$ret['status'] = -1;
			$ret['msg'] = '非法数据.';
			echo  json_encode($ret);
			exit;
		}
	}


    public function deleteAgent(){
        if($this->login_role_id!=MANGER_ROLE_INFO){
            $info = array(
                'status' => 0,
                'msg' => '无权限操作！',
            );
            exit(json_encode($info));
        }


        $id=$this->input->get_post('id')?$this->input->get_post('id'):0;


        $info = array(
            'status' => 0,
            'msg' => '删除失败',
        );

        if(!$id){
            exit(json_encode($info));
        }

        $where="id in ({$id}) ";
        $data['dele_status']=DELETE_STATUS;
        $bool=$this->exam_model->update($data,$where);

        if($bool){
            $info = array(
                'status' => 1,
                'msg' => '删除成功',
            );
            exit(json_encode($info));
        }
        exit(json_encode($info));
    }

}
