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
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <font face="myFirstFont">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">
                                        <?php
                                        echo $_SESSION['nickname'];
                                        ?>
                                    </strong>
                             </span>
                                <span class="text-muted text-xs block">
                                    <?php
                                    switch ($_SESSION['securitylvl'])
                                    {
                                        case "a":
                                            echo "Administrator";
                                            break;
                                        case "d":
                                            echo "مدخلي البيانات";
                                            break;
                                        default:
                                            echo "Nothing here...";
                                    }
                                    ?>
                                    <b class="caret"></b>
                                </span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li class="divider"></li>
                            <li><a href="php/logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <font color="red">PIC</font>AB<br><small>ref</small>
                    </div>
                </li>
				<li class="<?php active('index.php');?>">
						<a href="index.php">
							<i class="menu-icon fa fa-home"></i>
							<span class="menu-text"> الصفحة الرئيسية </span>
						</a>
						<b class="arrow"></b>
					</li>
				<li class="<?php active('index.php');?>">
						<a href="sarki.php">
							<i class="menu-icon fa fa-sticky-note-o"></i>
							<span class="menu-text"> السراكي </span>
						</a>
						<b class="arrow"></b>
					</li>
				<li class="<?php active('index.php');?>">
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
				<li class="<?php active('index.php');?>">
						<a href="dataentry.php">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> مدخلي البيانات </span>
						</a>
						<b class="arrow"></b>
					</li>
					<?PHP } ?>
					<?php
						if($securitylvl == "a"){ ?>
				<li class="<?php active('index.php');?>">
						<a href="pros.php">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> النيابات </span>
						</a>
						<b class="arrow"></b>
					</li>
					<?PHP } ?>
            </ul>
        </font>
    </div>
</nav>