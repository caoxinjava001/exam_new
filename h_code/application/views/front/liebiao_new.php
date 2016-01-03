<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0033)http://www.mokaoba.com/zhengquan/ -->
<HTML><HEAD><TITLE>学科考试</TITLE>
<META content="text/html; charset=UTF-8" http-equiv=Content-Type>
<META name=Description content=学科考试>
<META name=keywords content=学科考试>
<LINK rel=stylesheet type=text/css href="<?php echo STATICS_PATH;?>/shiti_two/in/mokaoba.css">

<style>

.in_tit{ font-size:12px; color:#fd7460; text-decoration:none;}
.in_tit a{ font-size:12px; color:#fd7460; text-decoration:none;}
.in_tit a:hover{ font-size:12px; color:#fd7460; text-decoration: underline;}



</style>

<META name=GENERATOR content="MSHTML 8.00.6001.23580"></HEAD>
<BODY>
<?php 

    $user_id= $this->input->get_post("user_id");;
    $user_name= $this->input->get_post("user_name");
?>
<DIV class=minNav><!--mini导航-->
<DIV class=navInner>
	<SPAN class=homeIco>
		<A class=myTest href="/examination/examLogList?user_name=<?php echo $user_name; ?>&user_id=<?php echo $user_id; ?>" >考试中心</A> | 
		<A class=myTest href="http://www.qingdawangxiao.com/member" >会员中心</A>
		<A class=sina href="http://www.qingdawangxiao.com/member/" ></A> </SPAN><SPAN id=ks110_LoginView class=login><?php echo $this->input->get_post('user_name');?>欢迎来到清大网校<!--<A href="#">登录</A><A href="#" >免费注册</A> -->
</SPAN></DIV>
</DIV>
<DIV class="banner ">


<form action="<?php echo MAIN_PATH;?>/examination/examListNew" method="get">
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="420"><img src="<?php echo STATICS_PATH;?>/shiti_two/in/logo.jpg" width="420" height="115"></td>
    <td width="540">
	
	<table width="364" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="300" background="<?php echo STATICS_PATH;?>/shiti_two/in/s5.jpg" style="padding-left:10px;">
				
				
                  <input  name="s_word" type="text" style="width:280px; border:1px solid #FFFFFF; color:#7f7f7f" value="<?php echo $s_word?>" size="45"  placeholder="请输入关键词" />
           </td>
                <td width="81" align="center">
				<input type="image" src="<?php echo STATICS_PATH;?>/liebiao_files/s4.jpg" width="52" height="30" />
<?php /*
<img src="<?php echo STATICS_PATH;?>/shiti_two/in/s4.jpg" width="52" height="30" />
*/ ?>
	</td>
              </tr>
      </table>
</form>
	
	
	
	</td>
  </tr>
</table>

<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td>
	<style>
	
	.dayi-nav {
	PADDING-BOTTOM: 6px; MARGIN: 0px auto; PADDING-LEFT: 5px; WIDTH: 960px; BACKGROUND: url(<?php echo STATICS_PATH;?>/shiti_two/in/wxlm-qt-zj-11-04-a7.png) no-repeat 50% bottom; HEIGHT: 42px; _background: url(<?php echo STATICS_PATH;?>/shiti_two/in/wxlm-qt-zj-11-04-a7.png) no-repeat center 6px}
	
A.shi-ti-sy-9-20 {
	TEXT-ALIGN: center; LINE-HEIGHT: 46px; WIDTH: 89px; DISPLAY: inline-block; BACKGROUND: url(<?php echo STATICS_PATH;?>/shiti_two/in/ls-zj-9-21-st-a3.png) no-repeat 50% top; HEIGHT: 46px; COLOR: #fff; FONT-SIZE: 14px; FONT-WEIGHT: bold
}
A.shi-ti-sy-9-20-a3 {
	TEXT-ALIGN: center; LINE-HEIGHT: 46px; WIDTH: 89px; DISPLAY: inline-block; HEIGHT: 46px; COLOR: #0d507a; FONT-SIZE: 14px; FONT-WEIGHT: bold
}
A.shi-ti-sy-9-20-a3:hover {
	BACKGROUND: url(<?php echo STATICS_PATH;?>/shiti_two/in/ls-zj-9-21-st-a3.png) no-repeat 50% top; COLOR: #fff; TEXT-DECORATION: none
}
A.shi-ti-sy-9-20-a1 {
	TEXT-ALIGN: center; LINE-HEIGHT: 46px; WIDTH: 70px; DISPLAY: inline-block; HEIGHT: 46px; COLOR: #0d507a; FONT-SIZE: 14px; FONT-WEIGHT: bold
}
A.shi-ti-sy-9-20-a4 {
	TEXT-ALIGN: center; LINE-HEIGHT: 46px; WIDTH: 70px; DISPLAY: inline-block; BACKGROUND: url(<?php echo STATICS_PATH;?>/shiti_two/in/wxlm-qt-zj-11-04-a8.png) no-repeat 50% top; HEIGHT: 46px; COLOR: #fff; FONT-SIZE: 14px; FONT-WEIGHT: bold
}
A.shi-ti-sy-9-20-a1:hover {
	BACKGROUND: url(<?php echo STATICS_PATH;?>/shiti_two/in/wxlm-qt-zj-11-04-a8.png) no-repeat 50% top; COLOR: #fff; TEXT-DECORATION: none
}
A.shi-ti-sy-9-20-a2 {
	TEXT-ALIGN: center; LINE-HEIGHT: 46px; WIDTH: 56px; DISPLAY: inline-block; HEIGHT: 46px; COLOR: #0d507a; FONT-SIZE: 14px; FONT-WEIGHT: bold
}
A.shi-ti-sy-9-20-a5 {
	TEXT-ALIGN: center; LINE-HEIGHT: 46px; WIDTH: 56px; DISPLAY: inline-block; BACKGROUND: url(<?php echo STATICS_PATH;?>/shiti_two/in/wxlm-qt-zj-11-04-a9.png) no-repeat 50% top; HEIGHT: 46px; COLOR: #fff; FONT-SIZE: 14px; FONT-WEIGHT: bold
}
A.shi-ti-sy-9-20-a2:hover {
	BACKGROUND: url(<?php echo STATICS_PATH;?>/shiti_two/in/wxlm-qt-zj-11-04-a9.png) no-repeat 50% top; COLOR: #fff; TEXT-DECORATION: none
}
	</style>
	<DIV class="dayi-nav clear">
	<A class=shi-ti-sy-9-20 href="#">考试首页</A> 
	<?php foreach($exam_class_tag_list as $val) { ?>
		<A class=shi-ti-sy-9-20-a1 href="/examination/examListNew?c_id=<?php echo  $val['id']; ?>&user_id=<?php echo $user_id ?>&user_name=<?php echo $user_name ?>"><?php echo $val['cate_name']; ?></A> 
	<?php } ?>
	</td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td><table width="960" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCCCCC;">
      <tr>
        <td width="100" height="40" align="center" style="border-bottom:1px solid  #CCCCCC;"><table width="80" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="30" align="center" background="<?php echo STATICS_PATH;?>/shiti_two/in/a2.png" style="color:#fd901a; font-weight:bold;">按学科</td>
            </tr>
        </table></td>
        <td width="858" align="left" style="border-bottom:1px solid  #CCCCCC; font-size:12px; color:#fd7460"  class="in_tit">
			<span style="float:left;color:#4c7d9c;">全科</span>
			<?php foreach($exam_kemu_tag_list as $val) { ?>
			&nbsp;|&nbsp;<a href="/examination/examListNew?k_id=<?php echo  $val['id']; ?>&user_id=<?php echo $user_id ?>&user_name=<?php echo $user_name ?>"><?php echo $val['cate_name']; ?></a>
				<?php } ?>
		</td>
      </tr>
      <tr>
        <td height="40" align="center"><table width="80" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="30" align="center" background="<?php echo STATICS_PATH;?>/shiti_two/in/a2.png" style="color:#2cc4e9; font-weight:bold">按类型</td>
          </tr>
        </table></td>
        <td align="left" style="font-size:12px; color:#fd7460" class="in_tit">
			<span style=" float:left;color:#4c7d9c;">全部类型</span>
			<?php foreach($tags as $val) { ?>
			&nbsp;|&nbsp;<a href="/examination/examListNew?t_id=<?php echo  $val['id']; ?>&user_id=<?php echo $user_id ?>&user_name=<?php echo $user_name ?>"><?php echo $val['cate_name']; ?></a>
			<?php } ?>
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
 
</table>




</DIV>
<DIV class=lc>
<DIV><SPAN class=n1>1.选择试题</SPAN><SPAN class=n2>2.注册/登陆</SPAN><SPAN 
class=n3>3.开始答题</SPAN><SPAN class=n4>4.提交试卷</SPAN><SPAN 
class=n5>5.查看成绩</SPAN><SPAN class=n6>6.答案解析</SPAN></DIV></DIV>
<DIV class=bread><SPAN>您的位置：</SPAN>
<?php if($c_id) { ?>
&nbsp;&gt;<A href="#"><?php echo $class_name; ?></A>
<?php } ?>
<?php if($k_id) { ?>
&nbsp;&gt; <A href="#"><?php echo $kemu_name; ?></A>
<?php } ?>
<?php if($curr_id) { ?>
 &nbsp;&gt;<A href="#"><?php echo $tag_name; ?></A> 
<?php } ?>

</DIV>


<DIV class="mainContent m2"><!--主体内容-->
<DIV class=mainList>


<DIV class=sjTitle>
<DIV class=cs><SPAN></SPAN> <SPAN>进入考试</SPAN></DIV>
<DIV class=bt><SPAN>试卷标题</SPAN> </DIV></DIV>
<DIV class=sjList>
<UL>
 
  
<?php foreach($res as $v){?>
  <LI>
  <DIV>
  <DIV class=newtitle ><SPAN class=mKemu></SPAN><A class=mTitle href="<?php echo MAIN_PATH;?>/examination/index?id=<?php echo $v['id'];?>&user_name=<?php echo $user_name;?>&user_id=<?php echo $user_id;?>" target=_blank><?php echo $v['exam_name'];?></A></DIV>
  <SPAN class=time><SPAN style="COLOR: #c00">&nbsp;</SPAN></SPAN>
  <DIV class=paper_btn align="right"><A class=exam_btn  href="<?php echo MAIN_PATH;?>/examination/index?id=<?php echo $v['id'];?>&user_name=<?php echo $user_name;?>&user_id=<?php echo $user_id;?>" target=_blank>进入考试</A></DIV></DIV></LI>
<?php }?> 

  
  
  </UL>
<DIV class=page>
                <?php echo $pages;?>
</DIV></DIV></DIV>

</DIV>








<table width="960" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr><td height="10"></td></tr>
  <tr>
    <td align="center" style="line-height:25px; border-top:1px solid #CCCCCC; padding-top:10px; "><a style="color:#000000;" href="#">如何成为VIP会员</a>&nbsp;&nbsp;<a style="color:#000000;"  href="#" >联系我们</a>&nbsp;&nbsp;<a style="color:#000000;"  href="#" >版权说明</a>&nbsp;&nbsp;<a style="color:#000000;"  href="#" >帮助中心</a><br>
	地址：北京市海淀区中关村大街<br>
咨询热线：400-610-8958 交流合作：400-6108958 传真：010-82168668<br>

清大网校版权所有 - 备案号：京ICP备15017468</td>
  </tr>
</table>

<script>
    var user_id="<?php echo $this->input->get_post("user_id");?>";
    var user_name="<?php echo $this->input->get_post("user_name");?>";

    if(!user_id||user_name.length<1){
        alert('用户未登录！')
    }
</script>

</BODY></HTML>

