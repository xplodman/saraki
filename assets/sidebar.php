<?php
function active($currect_page){
    $url=strtok($_SERVER["REQUEST_URI"],'?');
    $url_array =  explode('/', $url) ;
    $url = end($url_array);
    if($currect_page == $url){
        echo 'active'; //class name in css
    }
}
?>
<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>
				<ul class="nav nav-list">
					<li class="<?php active('adminindex.php'); active('userindex.php');?>">
						<a href="index.php">
							<i class="menu-icon fa fa-home"></i>
							<span class="menu-text"> الصفحة الرئيسية </span>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php active('sarki.php')?>">
						<a href="sarki.php">
							<i class="menu-icon fa fa-sticky-note-o"></i>
							<span class="menu-text"> السراكي </span>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="<?php active('advancedsearch.php'); active('search.php');?>">
						<?php
						if($securitylvl == "a")
							{?>
								<a href="advancedsearch.php">
								<?php
							}else
							{?>
								<a href="search.php">
						<?php }; ?>
							<i class="menu-icon fa fa-search"></i>
							<span class="menu-text">البحث </span>
						</a>
						<b class="arrow"></b>
					</li>
					<?php
						if($securitylvl == "a"){ ?>
					<li class="<?php active('users.php')?>">
						<a href="users.php">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> المستخدمين </span>
						</a>
						<b class="arrow"></b>
					</li>
					<?PHP } ?>
					<?php
						if($securitylvl == "a"){ ?>
					<li class="<?php active('pros.php')?>">
						<a href="pros.php">
							<i class="menu-icon fa fa-university"></i>
							<span class="menu-text"> النيابات </span>
						</a>
						<b class="arrow"></b>
					</li>
					<?PHP } ?>
					<?php
					if($securitylvl == "a"){ ?>
						<li class="<?php active('court_session.php')?>">
							<a href="court_session.php">
								<i class="menu-icon fa fa-gavel"></i>
								<span class="menu-text"> الجلسات </span>
							</a>
							<b class="arrow"></b>
						</li>
					<?PHP } ?>
					<li class="<?php active('actions.php')?>">
						<a href="actions.php">
							<i class="menu-icon fa fa-trophy"></i>
							<span class="menu-text"> التصرفات </span>
						</a>
						<b class="arrow"></b>
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>