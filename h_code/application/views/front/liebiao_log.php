<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0034)http://www.mokaoba.com/usercenter/ -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>会员中心-清大网校</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type><LINK 
rel=Stylesheet type=text/css href="<?php echo STATICS_PATH;?>/houtai_files/usercenter.css">

<script type="text/javascript" src="<?php echo STATICS_PATH_BACKEND_JS; ?>/libs/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo STATICS_PATH_BACKEND_JS; ?>/libs/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo STATICS_PATH; ?>/js/util.js"></script>




<META name=GENERATOR content="MSHTML 8.00.6001.23580"></HEAD>
<BODY>

<TABLE border=0 cellSpacing=0 cellPadding=0 width="100%" height="100%">
  <TBODY>
  <TR><!--标题栏-->
    <TD id=hd_nav colSpan=2><SPAN id=user_menu><STRONG><A 
      style="FONT-SIZE: large" href="#">清大网校</A></STRONG> 
      <SPAN style="COLOR: #ff7500; FONT-WEIGHT: bold" 
      id=top_UserName><?php echo $user_name;?></SPAN> 你好！</SPAN> 
      </TD></TR>
  <TR>
    <TD id=left_menu height="100%" vAlign=top>
      <DIV id=my_menu class=sdmenu>
      <DIV class=mhd></DIV>
      <DIV class=lmenucon>
      <DIV class=collapsed><SPAN><A 
      onclick="kaoshi110_ajaxloginconfirm('#')" 
      target=iframe_right>我的会员中心</A></SPAN> </DIV></DIV>
      <DIV class=lmenucon>
      <DIV class=collapsed><SPAN onclick='ShowMenu("leftNav1")'>我的模拟考试</SPAN> 
      <DIV id=leftNav1><A class=menu_l href="/examination/examListNew?user_id=<?php echo $user_id; ?>&user_name=<?php echo $user_name; ?>" 
      target=_blank>在线模拟考场</A> 
	  <A class=menu_l 
	  href="/examination/examLogList?user_id=<?php echo $user_id; ?>&user_name=<?php echo $user_name; ?>" 
      target=iframe_right>我的考卷</A> 

	  <A class=menu_l 
	  href="/examination/examLogListNew?user_id=<?php echo $user_id; ?>&user_name=<?php echo $user_name; ?>" 
      target=iframe_right>我的错题库</A> 
	  </DIV>
      </DIV></DIV>
      <DIV class=lmenucon>
      <DIV class=collapsed><SPAN onclick='ShowMenu("leftNav2")'>我的资料信息</SPAN> 
      <DIV id=leftNav2><A class=menu_l 
      href="http://www.qingdawangxiao.com/member/edit_baseinfo.php" 
      target=_blank>修改我的资料</A> <A class=menu_l 
      href="http://www.qingdawangxiao.com/member/edit_baseinfo.php" 
      target=_blank>修改密码</A> </DIV></DIV></DIV>
    
     
      <DIV class=mbd></DIV></DIV></TD>
    <TD style="WIDTH: 100%" id=right vAlign=top>
	
	
	
	<DIV class=content>
<DIV class=rhd></DIV>
<H1>会员中心</H1>
<TABLE class=tabwz border=0 cellSpacing=0 cellPadding=0 width="100%">
  <TBODY>
  <TR><!--左上角小图标-->
    <TD class=td_form vAlign=top align=left>
      <TABLE border=0 cellSpacing=0 cellPadding=0 width="93%" height=174>
        <TBODY>
        <TR>
          <TD style="BORDER-BOTTOM: #efefef 1px solid" class=Pswgary height=30 
          colSpan=3>登录名称：<?php echo $user_name; ?> </TD>
          <TD style="BORDER-BOTTOM: #efefef 1px solid" class=Pswgary 
            height=30><SPAN style="BORDER-BOTTOM: #efefef 1px solid" 
            class=Pswgary><A  href="http://www.qingdawangxiao.com/member/edit_baseinfo.php"><U><IMG   src="<?php echo STATICS_PATH;?>/houtai_files/kszxgrxx.gif" width=24 
            height=15>修改个人信息</U></A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          </SPAN></TD></TR>
        <TR>
          <TD class=mkaoshi110_3 width="17%" align=left><STRONG>帐户等级：</STRONG> 
          </TD>
          <TD class=mkaoshi110_3 height=30 width="15%" align=left><FONT 
            style="COLOR: #c00; FONT-WEIGHT: bold">普通会员 </FONT></TD>
          <TD class=mkaoshi110_3 width="27%" align=left><A 
            href="#" target=_blank><IMG border=0 
            alt=升级VIP src="<?php echo STATICS_PATH;?>/houtai_files/cz2.gif"></A> </TD>
          <TD class=mkaoshi110_3 align=left>&nbsp; </TD></TR>
        </TBODY></TABLE>
      <DIV style="MARGIN-LEFT: 0px" class=xxk>
      <DIV class=bt1>我的考卷</DIV>
      <DIV class=bld></DIV>
      
      <DIV class=bld></DIV></DIV>
      <TABLE class=mkaoshi110_3 border=0 width="94%">
        <TBODY>
        <TR>

          <TD class=mkaoshi110_2 height=28 width="5%" 
            align=left><input type="checkbox" name="checkbox" class='allChoose'> 全选</TD>

          <TD class=mkaoshi110_2 height=28 width="50%" 
            align=left><B>&nbsp;&nbsp;&nbsp;试题名称列表</B> </TD>
          <TD class=mkaoshi110_2 width="6%" align=middle><B>做卷记录</B> </TD>
          <TD class=mkaoshi110_2 width="6%" align=middle><B>操作</B> </TD>
          
          </TR>
		<?php foreach ($res as $val) { ?>
        <TR>

          <TD class=mkaoshi110_2 width="5%" 
            align=left><label>
            <input name="checkbox2" type="checkbox" value='<?php echo $val['id'];?>'    rel="<?php echo $val['id'];?>">
          </label></TD>

          <TD class=mkaoshi110_2 height=28 width="50%" 
            align=left>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $val['exam_name']; ?>
</TD>
          <TD class=mkaoshi110_2 width="6%" align=middle><A 
            href="/examination/result?id=<?php echo $val['id'];?>&user_name=<?php echo $user_name; ?>&user_id=<?php echo $user_id; ?>" 
            target=_blank><IMG alt=查看试卷 src="<?php echo STATICS_PATH;?>/houtai_files/btn-ck.gif"></A> </TD>
          <TD class=mkaoshi110_2 width="6%" align=middle><A style="COLOR: red" 
            href="/examination/index?id=<?php echo $val['exam_id'];?>&user_name=<?php echo $user_name; ?>&user_id=<?php echo $user_id; ?>" 
            target=_blank>重考一遍</A> </TD>
          </TR>
		<?php } ?>

          <TR>
          <TD colspan='3'>
                <?php echo $pages;?>
          </TD>
          </TR>
          </TBODY></TABLE>
      <TABLE class=mkaoshi110_3 border=0 width="94%">
        <TBODY>

    <td align="left"><input type="button" id="dele_select_agents" name="Submit2" value="删除所选"></td>
	  
	  </TBODY></TABLE>
<script>
    $(function(){
        var url=config.domain.wf+'/examination/deleteExam';
        //批量删除
        $('#dele_select_agents').bind('click',function(){
            var obj={},data={},checkbox2='',_msg={};
            var _dom= $("input:checkbox[name='checkbox2']:checked");
            var _len=_dom.length;
            var i=1;

            _dom.each(function () {
				//alert($(this).val());
                checkbox2+=$(this).val();
				//alert(checkbox2);
                if(i<_len){
                    checkbox2+=',';
                }
                i+=1;
            });

            data.id=checkbox2;

            obj.data=data;
            obj.type='post';
            obj.url=url;

            _util.ajax(obj,function(d){
                _msg.msg= d.msg;
                //_msg.callback=function(){
				if (d.status == 1) {
                    window.location.href ="/examination/examLogListNew?user_name=<?php echo $_REQUEST['user_name']; ?>&user_id=<?php echo $_REQUEST['user_id']; ?>";
					}
				alert(_msg.msg);
                //_show_msg(_msg,2000);
            });
        })
    })


    //全选
    $('.allChoose').bind('click',function(){
        var _this_status=$(this).attr('checked');
        if(_this_status=='checked'){
            $("input[name='checkbox2']").attr('checked',true);
        }else{
            $("input[name='checkbox2']").attr('checked',false);
        }
    })
</script>




<DIV class=rbd></DIV></DIV>
	
		
	
	</TD></TR></TBODY></TABLE></BODY></HTML>

