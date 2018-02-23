<?php require("../common/config.php")?>
<!DOCTYPE html>
<html>

<head>
<?php include("part_head.php");?>
</head>

<body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 class="font-bold">Esqueceu a senha?</h2>

                    <p>
                        Coloque o seu e-mail que uma mensagem para resetar sua senha será enviada.
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form" action="login.php">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" required="">
                                </div>

                                <button type="submit" class="btn btn-primary block full-width m-b">Resetar password</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                <a href="http://www.foi.tech">Foi.Tech</a>
            </div>
            <div class="col-md-6 text-right">
               <small>© 2016</small>
            </div>
        </div>
    </div>

</body>

</html>
