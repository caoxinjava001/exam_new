<div class="crumb-wrap">
    <div class="crumb-list"><i class="icon-font"></i><a href="/admin">首页</a><span class="crumb-step">&gt;</span><a href="/manage/index"><span class="crumb-name">试卷信息</span></a></div>
</div>
<link href="<?php echo STATICS_PATH;?>/css/ui/jquery-ui-custom.min.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo STATICS_PATH;?>/css/b_reg.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo STATICS_PATH;?>/js/ui/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="<?php echo STATICS_PATH_JS;  ?>/jhh-common.js"></script>
<div class="xu" id="xu">
    <div class="cont_left">
        <div class="cont_demand">
            <p class="demand_p1"><?php echo '增加试卷';?></p>
        </div>
		<?php
		$url_action = "/exam/oneAddAjaxAction";
		if ($id) {
			$url_action = "/exam/oneUpdateAjaxAction";
		}   
		?> 
			<iframe name="myupfile" border=0 hidden='yes' width=0 height=0></iframe>
			<form method="post" id="add_student_form"  action="<?php echo $url_action; ?>" target="myupfile">
            <input type="hidden" name="s_id" value="<?php echo $data_info['id'];?>"/>
            <div class="demand_text">
                <div class="text">
                    <span class="floatL span1"><i>*</i>试卷名称:</span>
                    <input type="text" class="sect_1 floatL" name="exam_name" placeholder="请填写试卷名称" value="<?php echo !empty($data_info['exam_name'])?$data_info['exam_name']:'';?>">
                    <span class="span2 floatL">请填写试卷名称</span>
                </div>
				<div class="text">
                    <span class="floatL span1"><i>*</i>试卷分类:</span>
                    <select  class="sect_1 floatL" name="cate_id">
					<option value="" >请选择</option>
                        <?php foreach($exam_tag_list as $v){?>
                            <option <?php if($v['id']== $data_info['cate_id']) echo 'selected="selected"';?> value="<?php echo $v['id'];?>"><?php echo $v['cate_name'];?></option>
                        <?php }?>
                    </select>
                    <span class="span2 floatL">请选择用户角色</span>
                </div>
                <div class="text">
                    <span class="floatL span1"></span>
                    <input type="submit" class="btn btn-blue" id="createManager" value="确 定">
                </div>
            </div>
        </form>
    </div>
</div>


<script>

document.domain="<?php echo MAIN_DOMAIN_INFO;?>";
function getShow(statu,msg) {
	if (statu == 0) {
		location.href="/exam/createTwo?id="+msg;
	} else {
		$.jhh.cm.show_dialog({msg:msg,width:300,height:100});
	}
	return false;
}
</script>
