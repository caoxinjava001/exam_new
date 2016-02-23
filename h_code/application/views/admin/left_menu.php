 <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>考试系统</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i><?php if ($login_role_id == MANGER_ROLE_INFO ) { echo '管理员';} else { echo '代理商';}?></a>
                    <ul class="sub-menu">
					<li><a href="/manage/index"><i class="icon-font">&#xe008;</i>管理员管理</a></li>
					<li><a href="/card/index"><i class="icon-font">&#xe008;</i>充值卡管理</a></li>
					<?php if ($login_role_id == MANGER_ROLE_INFO ) { ?>
					<li><a href="/classcate/index"><i class="icon-font">&#xe008;</i>年&nbsp级&nbsp;类&nbsp;目</a></li>
					<li><a href="/kemucate/index"><i class="icon-font">&#xe008;</i>科&nbsp目&nbsp;类&nbsp;目</a></li>
					<li><a href="/classify/index"><i class="icon-font">&#xe008;</i>类&nbsp型&nbsp;类&nbsp;目</a></li>
					<li><a href="/exam/index"><i class="icon-font">&#xe008;</i>试&nbsp卷&nbsp;管&nbsp;理</a></li>
					<?php } ?>
                    </ul>
            </li>
         </ul>
        </div>
    </div>
