<?php
	$profileUser = $dao['users']->getUserbyId($_SESSION[$cfgPrefix.'_userId']);
?>
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/role_<?php echo $profileUser['role']?>.jpg" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $profileUser['name']?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $profileUser['role']?><b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.php">Perfil</a></li>
                                <li><a href="#">Contatos</a></li>
                                <li><a href="#">Notificações</a></li>
                                <li class="divider"></li>
                                <li><a href="login.php">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            HubJur
                        </div>
                    </li>
<?php require_once("../common/menu_builder.php");?>     
