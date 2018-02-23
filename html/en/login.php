<?php require("../common/config.php")?>
<?php 

switch($action = _any("action")) {
	case "login":
		if($userId = $dao['users']->checkLogin(_any("email"), _any("pass"))) {
			$_SESSION[$cfgPrefix.'_isLogged'] = true;
			$_SESSION[$cfgPrefix.'_userId'] = $userId;
			header("location: main.php?first=true");
		}
		else {
			$msgError = "Credenciais inválidas!";
		}
		break;
	default:
		unset($_SESSION[$cfgPrefix.'_isLogged']);
		unset($_SESSION[$cfgPrefix.'_userId']);
		break;
}
?>
<!DOCTYPE html>
<html>

<head>
<?php include("part_head.php");?>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><?php echo $cfgTitle?></h1>

            </div>
            <h3>Bem-vindo ao ERP!</h3>
            <p>O sistema de gestão de projetos!
            </p>
            <p>Entre com seu email e senha.</p>
<?php include("part_msghandling.php");?>            
            <form class="m-t" name="loginFrm" role="form" method="post" action="login.php">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="pass" class="form-control" placeholder="Senha" required="">
                </div>
                <button type="submit" name="action" value="login" class="btn btn-primary block full-width m-b">Entrar</button>

                <a href="forgot_password.php"><small>Esqueceu a senha?</small></a>
                <p class="text-muted text-center"><small>Não tem conta?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.php">Criar uma conta</a>
            </form>
            <p class="m-t"> <small><a href="http://www.foi.tech">Foi.Tech</a> &copy; <?php echo date('Y')?></small> </p>
        </div>
    </div>
<?php include('part_scripts.php')?>
</body>

</html>
