<div class="main-wrap">

    <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">考试列表</span></div>
    </div>
    <div class="search-wrap">
        <div class="search-content">
            <form method="get">
                <table class="search-tab">
                    <tr>
                        <th width="60">试卷名称:</th>
                        <td>
                            <input type="text" name="s_name" id="s_name" value="<?echo $s_name; ?>" /> 
                        </td>

                        <th width="60">年级分类:</th>
                        <td>
                            <select name="class_select_id">
                                <option value="" >所有</option>
								<?php foreach($exam_class_tag_list as $val) { ?>
                                <option value="<?php echo  $val['id'];?>" <?php echo (strlen($class_select_id)>0&&$class_select_id==$val['id'])?'selected':'';?>><?php echo $val['cate_name']; ?></option>
								<?php } ?>
                            </select>
                        </td>

                        <th width="60">科目分类:</th>
                        <td>
                            <select name="kemu_select_id">
                                <option value="" >所有</option>
								<?php foreach($exam_kemu_tag_list as $val) { ?>
                                <option value="<?php echo  $val['id'];?>" <?php echo (strlen($kemu_select_id)>0&&$kemu_select_id==$val['id'])?'selected':'';?>><?php echo $val['cate_name']; ?></option>
								<?php } ?>
                            </select>
                        </td>

                        <th width="60">类型分类:</th>
                        <td>
                            <select name="select_id">
                                <option value="" >所有</option>
								<?php foreach($exam_tag_list as $val) { ?>
                                <option value="<?php echo  $val['id'];?>" <?php echo (strlen($select_id)>0&&$select_id==$val['id'])?'selected':'';?>><?php echo $val['cate_name']; ?></option>
								<?php } ?>
                            </select>
                        </td>

                        <th width="100">开始/结束时间:</th>
                        <td>
                            <input type="text" name="start_time" id="s_date_start" class="xx_time"  value="<?echo $start_time; ?>" />
                        </td>
                        <td>
                            <input type="text" name="end_time" id="s_date_end" class="xx_time" value="<?echo $end_time; ?>" />
                        </td>
                        <td>
                            <input class="btn btn-primary btn2" value="查询" type="submit">
                        </td>

                        <td>
                            <a id="updateOrd" href="/exam/create" class="btn btn-primary btn2"><i class="icon-font"></i>增加试卷</a>
                        </td>

                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="result-wrap">
        <form name="myform" id="myform" method="post">
<!--            <a id="dele_select_agents" class="btn btn-primary btn2" href="javascript:;" >批量删除</a>-->
            <div class="result-content">
                <table class="result-tab" width="100%">
                    <tr>
<!--                        <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>-->
                        <th>ID</th>
                        <th>试卷名称</th>
                        <th>年级分类</th>
                        <th>科目分类</th>
                        <th>类型分类</th>
                        <th>创建时间</th>
                        <th>修改时间</th>
                        <th>操作</th>
                    </tr>
                    <?php foreach($exam_list as $v){?>
                        <tr>
<!--                            <td class="tc"><input name="ids"  type="checkbox" rel="--><?php //echo $v['id'];?><!--"></td>-->
                            <td><?php echo $v['id']?></td>
                            <td><?php echo $v['exam_name']?></td>
                            <td><?php echo $v['class_tag_list']['cate_name'];?></td>
                            <td><?php echo $v['kemu_tag_list']['cate_name'];?></td>
                            <td><?php echo $v['tag_list']['cate_name'];?></td>
                            <td><?php echo $v['created_time']?></td>
                            <td><?php echo $v['modify_time']?></td>
                            <td>
                                <a class="audit" href="/exam/create?id=<?php echo $v['id']; ?>" >修改</a>
                                <a class="dele_Agent" href="javascript:;" rel="<?php echo $v['id'];?>" >删除</a>
<!--                                <a class="dele_Agent" href="javascript:;" rel="--><?php //echo $v['id'];?><!--" >删除</a>-->
                            </td>
                        </tr>
                    <?php }?>
                </table>
                <div class="list-page"> <?php echo $pages;?></div>
            </div>
        </form>
    </div>
</div>
<link href="<?php echo STATICS_PATH;?>/css/ui/jquery-ui-custom.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo STATICS_PATH;?>/css/ui/jquery-ui-timepicker-addon.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo STATICS_PATH;?>/js/ui/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="<?php echo STATICS_PATH;?>/js/ui/jquery.ui.datepicker-zh.js"></script>
<script type="text/javascript" src="<?php echo STATICS_PATH;?>/js/ui/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo STATICS_PATH;?>/js/ui/jquery-ui-timepicker-zh-CN.js"></script>
<script>

        var url=config.domain.wf+'/exam/deleteAgent';
    $(document).ready(function() {
        /****日历 start***/
        $('#s_date_start').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel:true,
            closeText:"关闭",
            onSelect:function(selectedDate){
                //当选择开始日期后，设置结束日期的最小值
                $( "#s_date_end" ).datepicker( "option", "minDate", selectedDate );
            }
        });

        $('#s_date_end').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            closeText: "关闭",
            onSelect:function(selectedDate){
                //当开选择开始日期后，设置结束日期的最小值
                $( "#date_start" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
        /***日历 end***/
        //单个删除
        $('.dele_Agent').bind('click',function(){
            var obj={},data={},_msg={};
            var _id= $(this).attr('rel');
            var _s='';

            data.id=_id;
            obj.data=data;
            obj.type='post';
            obj.url=url;

            _util.ajax(obj,function(d){
                _msg.msg= d.msg;
                _msg.callback=function(){
                    window.location.reload();
                }
                _show_msg(_msg,2000);
            });
        })


    });
</script>
<!--/main-->
