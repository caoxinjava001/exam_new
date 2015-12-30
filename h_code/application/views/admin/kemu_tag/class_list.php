<div class="main-wrap">

    <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">试卷科目分类列表</span></div>
    </div>
    <div class="search-wrap">
        <div class="search-content">
            <form method="get">
                <table class="search-tab">
                    <tr>

                        <th width="100">科目分类名称:</th>
                        <td>
                            <input type="text" name="s_name" id="s_name" value="<?echo $s_name; ?>" /> 
                        </td>

                        <td>
                            <input class="btn btn-primary btn2" value="查询" type="submit">
                        </td>
                        <td></td>
                        <td>
                            <a id="updateOrd" href="/kemucate/create" class="btn btn-primary btn2"><i class="icon-font"></i>增加科目分类</a>
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>
    <div class="result-wrap">
        <form name="myform" id="myform" method="post">
            <?php /*?>
            <a id="dele_select_agents" class="btn btn-primary btn2" href="javascript:;" >批量删除</a>
            <?php */?>

            <div class="result-content">
                <table class="result-tab" width="100%">
                    <tr>
                        <?php /*?>
                        <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                        <?php */?>

                        <th>ID</th>
                        <th>名称</th>
                        <th>使用时间</th>
                        <th>操作</th>
                    </tr>
                    <?php foreach($data as $v){?>
                        <tr>
                            <?php /*?>
                            <td class="tc"><input name="ids"  type="checkbox" rel="<?php echo $v['id'];?>"></td>
                            <?php */?>
                            <td><?php echo $v['id']?></td>
                            <td><?php echo $v['cate_name']?></td>
                            <td><?php echo $v['modify_time']?$v['modify_time']:$v['created_time']?></td>
                            <td>
                                <a class="audit" href="<?php MAIN_PATH;?>/kemucate/edit?id=<?php echo $v['id'];?>" >修改</a>
                                <a class="dele_Agent" href="javascript:;" rel="<?php echo $v['id'];?>" >删除</a>
                            </td>
                        </tr>
                    <?php }?>
                </table>
                <div class="list-page"> <?php echo $pages;?></div>
            </div>
        </form>
    </div>
</div>

<script>
    /**
     * 删除和批量删除
     * Created By YJ 2015-11-7
     */
    $(function(){
        var url=config.domain.wf+'/kemucate/deleteAgent';
        //批量删除
        $('#dele_select_agents').bind('click',function(){
            var obj={},data={},ids='',_msg={};
            var _dom= $("input:checkbox[name='ids']:checked");
            var _len=_dom.length;
            var i=1;

            _dom.each(function () {
                ids+=$(this).parent().next().html();
                if(i<_len){
                    ids+=',';
                }
                i+=1;
            });

            data.id=ids;

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
    })


    //全选
    $('.allChoose').bind('click',function(){
        var _this_status=$(this).attr('checked');
        if(_this_status=='checked'){
            $("input[name='ids']").attr('checked',true);
        }else{
            $("input[name='ids']").attr('checked',false);
        }
    })
</script>
<!--/main-->
