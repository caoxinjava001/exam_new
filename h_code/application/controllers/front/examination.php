<?php
/**
 * Created by PhpStorm.
 * User: YJ
 * Date: 2015/11/6
 * Time: 20:00
 */

class Examination extends MY_Controller{
    private $perpage=10; //每页条数
    private $page;
    private $user_id;   //登录用户id，暂时没有，用get传参，之后可从session或cookie中获取

    public function __construct(){
        parent::__construct('frontend');

		$this->load->model('exam_tag_kemu_model');
		 $this->load->model('exam_tag_class_model');

        $this->load->model('exam_model');
        $this->load->model('exam_tag_model');
        $this->load->model('exam_stem_model');
        $this->load->model('member_exam_model');

        $this->page=$this->input->get('page')>=1?$this->input->get('page'):0;
        $this->user_id=$this->input->get_post('user_id');
        $this->user_name=$this->input->get_post('user_name');
    }

    /**
     *  检测用户名和用户id是否存在否则
     */
    public function checkError(){
        $data=array();
        if(strlen($this->user_name)<1||!$this->user_id){
            redirect(MAIN_PATH.'/examination/errorPage');
        }
    }

    /**
     * 错误页面
     */
    public function errorPage(){
        $data=array();
        $data['user_name'] = $this->user_name;
        $data['user_id'] = $this->user_id;
        $this->load->view('/front/error',$data);
    }

    /**
     * 考试页面
     */
    public function index(){
        $this->checkError();

        $data=array();
        $id=$this->input->get_post('id')?$this->input->get_post('id'):0;
        $where['dele_status']=NO_DELETE_STATUS;
        $where['exam_id']=$id;

        $where_e['dele_status']=NO_DELETE_STATUS;
        $where_e['status']=1;
        $where_e['id']=$id;
        $exam=$this->exam_model->get_one('exam_name',$where_e);

        if(!empty($exam)) {
            //单选
            $where['stem_cate_id'] = EXAM_SINGLE;
            $data['single'] = $this->turnTo($this->exam_stem_model->select('*', $where));

            //判断
            $where['stem_cate_id'] = EXAM_JUDGE;
            $data['judge'] = $this->turnTo($this->exam_stem_model->select('*', $where));

            //多选
            $where['stem_cate_id'] = EXAM_MORE;
            $data['more'] = $this->turnTo($this->exam_stem_model->select('*', $where));


            $data['e_id'] = $id;
            $data['exam_name'] = $exam['exam_name'];
            $data['user_name'] = $this->user_name;
            $data['user_id'] = $this->user_id;
        }

        $this->load->view('/front/shiti',$data);	// 导入 主体部分 视图模板
    }

    /**
     * 考试结果
     */
    public function result(){
        $this->checkError();

        $data=array();
        $eid =$this->input->get_post('eid')?$this->input->get_post('eid'):0;
        $id =$this->input->get_post('id')?$this->input->get_post('id'):0;

        $where['user_id']=$this->user_id;
        if($eid) {
            $where['exam_id'] = $eid;
        }else{
            $where['id'] = $id;
        }
        $where['dele_status']=NO_DELETE_STATUS;
        $data = $this->member_exam_model->get_one('*', $where);

        $data['use_dec_v'] = unserialize($data['use_dec_v']);
        $data['quest_num']=count($data['use_dec_v']['judge'])+count($data['use_dec_v']['single'])+count($data['use_dec_v']['more']);
        $data['user_id']=$this->user_id;
        $data['user_name']=$this->user_name;
        
        $where_e['dele_status']=NO_DELETE_STATUS;
        $where_e['status']=1;
        $where_e['id']=$eid?$eid:$data['exam_id'];
        $exam=$this->exam_model->get_one('exam_name',$where_e);

        $data['exam_name'] = $exam['exam_name'];

        $this->load->view('/front/daan',$data);	// 导入 主体部分 视图模板
    }

    /**
     * 考试列表
     */
    public function examList(){
        $data=array();
        $where['dele_status']=NO_DELETE_STATUS;
        $tags=$this->exam_tag_model->select('*',$where,500,'view_order asc');

        $tid=$this->input->get_post('t_id')?$this->input->get_post('t_id'):$tags[0]['id'];
        $s_word=$this->input->get_post('s_word')?$this->input->get_post('s_word'):'';

        $page_where="cate_id ={$tid} and dele_status=".NO_DELETE_STATUS;
        if(strlen(trim($s_word))>0){
            $page_where.=" and exam_name like'%{$s_word}%'";
        }

        $res=$this->exam_model->list_info('*',$page_where,$this->page,$this->perpage);

        $data['pages']=pages($this->exam_model->getCount($page_where),$this->page,$this->perpage);
        $data['res']=$res;
        $data['tags']=$tags;
        $data['curr_id']=$tid;
        $data['s_word']=$s_word;
        $data['user_id']=$this->user_id;
        $data['user_name']=$this->user_name;

        $this->load->view('/front/liebiao',$data);	// 导入 主体部分 视图模板
    }

    /**
     * 处理交卷数据
     */
    public function anwserOver(){
        $content=$this->input->get_post('data')?$this->input->get_post('data'):array();
        $uid =$this->user_id;
        $eid =$this->input->get_post('eid')?$this->input->get_post('eid'):0;
        $data_arr=array();

        if(!$uid){
            $info = array(
                'status' => 0,
                'msg' => '没有登录！',
            );
            exit(json_encode($info));
        }

        if(empty($content)){
            $info = array(
                'status' => 0,
                'msg' => '数据错误！',
            );
            exit(json_encode($info));
        }
		//var_dump($content);exit;
		$error_count = 0;
		$shiti_count = 0;
		$curr_num = 0;
		$data_arr_right = array();
		$data_arr_error = array();
        foreach($content as $v){
            if(!$v['id']){
                continue;
            }
			
            if($v['type']==EXAM_SINGLE){
				$curr_num++;
				$shiti_count++;
                $v['exam']=$this->getExam($v['id']);

				array_multisort($v['answer']);	
				$c_a=explode(',',$v['exam']['correct_answer']);
				array_multisort($c_a);
				if($v['answer']==$c_a){
					$data_arr_right[$curr_num] = $v;
				} else {
					$error_count ++;
					$data_arr_error[$curr_num] = $v;
				}

                $data_arr['single'][]=$v;

            }
            if($v['type']==EXAM_JUDGE){
				$curr_num++;
				$shiti_count++;
                $v['exam']=$this->getExam($v['id']);

				array_multisort($v['answer']);	
				$c_a=explode(',',$v['exam']['correct_answer']);
				array_multisort($c_a);
				if($v['answer']==$c_a){
					$data_arr_right[$curr_num] = $v;
				} else {
					$error_count ++;
					$data_arr_error[$curr_num] = $v;
				}

                $data_arr['judge'][]=$v;
            }
            if($v['type']==EXAM_MORE){
				$curr_num++;
				$shiti_count++;
                $v['exam']=$this->getExam($v['id']);

				array_multisort($v['answer']);	
				$c_a=explode(',',$v['exam']['correct_answer']);
				array_multisort($c_a);
				if($v['answer']==$c_a){
					$data_arr_right[$curr_num] = $v;
				} else {
					$error_count ++;
					$data_arr_error[$curr_num] = $v;
				}

                $data_arr['more'][]=$v;
            }
        }
		//var_dump($curr_num,$shiti_count);exit;
        $insert['error_count']=$error_count;
        $insert['shiti_count']=$shiti_count;
        $insert['use_dec_error']=serialize($data_arr_error);
        $insert['use_dec_right']=serialize($data_arr_right);

        $insert['use_dec_v']=serialize($data_arr);
        $insert['exam_id']=$eid;
        $insert['user_id']=$uid;

        $id=$this->member_exam_model->insert($insert,true);
        if($id){
            $info = array(
                'status' => 1,
                'msg' => '交卷成功！',
            );
        }else{
            $info = array(
                'status' => 0,
                'msg' => '交卷超时,请重试！',
            );
        }

        exit(json_encode($info));
    }
    /**
     * 转化数据
     * @param array $data
     * @return array
     */
    protected function turnTo($data=array()){
        if(empty($data)){
            return $data;
        }
        foreach($data as $k => $v){
            if(!$v['answer']){
                continue;
            }
            $data[$k]['answer']=unserialize($v['answer']);
        }
        return $data;
    }

    /**
     * 根据id获取问题信息
     * @param int $id
     * @return array
     */
    protected function getExam($id){
        if(!$id){
            return array();
        }
        $where['dele_status']=NO_DELETE_STATUS;
        $where['id']=$id;

        $res=$this->exam_stem_model->get_one('*',$where);
        $res['answer']=unserialize($res['answer']);
        return $res;
    }

    public function examLogList(){
        $this->checkError();
        $data=array();
        $page_where['user_id']=$this->user_id;
        $page_where['dele_status']=NO_DELETE_STATUS;

        $res=$this->member_exam_model->list_info('id,exam_id',$page_where,$this->page,$this->perpage);
        foreach ($res as $key=>$val) {
            $where_e['id']=$val['exam_id'];
            $exam_info=$this->exam_model->get_one('exam_name',$where_e);
            $res[$key]['exam_name'] = $exam_info['exam_name'];
        }


        $data['pages']=pages($this->member_exam_model->getCount($page_where),$this->page,$this->perpage);
        $data['res']=$res;
        $data['user_id']=$this->user_id;
        $data['user_name']=$this->user_name;
        $this->load->view('/front/liebiao_log',$data);  // 导入 主体部分 视图模板
    }



    public function result_err(){
        $this->checkError();

        $data=array();
        $eid =$this->input->get_post('eid')?$this->input->get_post('eid'):0;
        $id =$this->input->get_post('id')?$this->input->get_post('id'):0;

        $where['user_id']=$this->user_id;
        if($eid) {
            $where['exam_id'] = $eid;
        }else{
            $where['id'] = $id;
        }
        $where['dele_status']=NO_DELETE_STATUS;
        $data = $this->member_exam_model->get_one('*', $where);

        $data['use_dec_error'] = unserialize($data['use_dec_error']);
        $data['use_dec_right'] = unserialize($data['use_dec_right']);
        $data['quest_num']=$data['shiti_count'];
        $data['error_count']=$data['error_count'];
        $data['user_id']=$this->user_id;
        $data['user_name']=$this->user_name;
        
        $where_e['dele_status']=NO_DELETE_STATUS;
        $where_e['status']=1;
        $where_e['id']=$eid?$eid:$data['exam_id'];
        $exam=$this->exam_model->get_one('*',$where_e);

        $data['exam_name'] = $exam['exam_name'];


		$exam_tag_where['id'] = $exam['cate_id'];
		$exam_tag_list=$this->exam_tag_model->get_one('*',$exam_tag_where);
		$data['tag_list'] = $exam_tag_list;
	


		$exam_class_tag_where['id'] = $exam['class_cate_id'];
		$exam_class_tag_list=$this->exam_tag_class_model->get_one('*',$exam_class_tag_where);
		$data['class_tag_list'] = $exam_class_tag_list;

		$exam_kemu_tag_where['id'] = $exam['kemu_cate_id'];
		$exam_kemu_tag_list=$this->exam_tag_kemu_model->get_one('*',$exam_kemu_tag_where);
		$data['kemu_tag_list'] = $exam_kemu_tag_list;
//var_dump($data['kemu_tag_list'],$exam['kemu_cate_id'],$exam_class_tag_where);exit;

        $this->load->view('/front/result_err',$data);	// 导入 主体部分 视图模板
    }

    public function examLogListNew(){
        $this->checkError();
        $data=array();
        $page_where['user_id']=$this->user_id;
        $page_where['dele_status']=NO_DELETE_STATUS;

        $res=$this->member_exam_model->list_info('id,exam_id,error_count,shiti_count',$page_where,$this->page,$this->perpage);
        foreach ($res as $key=>$val) {
            $where_e['id']=$val['exam_id'];
            $exam_info=$this->exam_model->get_one('*',$where_e);
            $res[$key]['exam_name'] = $exam_info['exam_name'];
            $res[$key]['right_count'] = intval($val['shiti_count']) - intval($val['error_count']);
        }

        $data['pages']=pages($this->member_exam_model->getCount($page_where),$this->page,$this->perpage);
        $data['res']=$res;
        $data['user_id']=$this->user_id;
        $data['user_name']=$this->user_name;
        $this->load->view('/front/liebiao_log_new',$data);  // 导入 主体部分 视图模板
    }

	public function deleteExam(){

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
        $bool=$this->member_exam_model->update($data,$where);

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
