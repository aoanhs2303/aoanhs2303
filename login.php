<?php require_once("include/DB.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Function.php"); ?>

<?php 
    if(isset($_POST['register-submit'])) {
        $nameRes = $_POST['usernameRes'];
        $pass1 = $_POST['passwordRes'];
        $pass2 = $_POST['passwordRes2'];
        $code = $_POST['code'];
        
        if(strlen($nameRes) < 4) {
            
        }
        if($code == 'aoanhs2303' && $pass1 == $pass2) {
            global $Connection;
            $ResQuery = "INSERT INTO admin(username, password, permission) VALUES('$nameRes', '$pass1', 0)";
            $Execute = mysqli_query($Connection, $ResQuery);
            $_SESSION['SuccessMessage'] = 'Đăng ký thành công';
        }
        
    }

    if(isset($_POST['login-submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];        
        
        if(empty($username) || empty($password)) {
            $_SESSION["ErrorMessage"] = "Nhớ điền tài khoản / mật khẩu nhé bro !";
            Redirect_to('login.php');
        } else {
            $admin = Login_Attemp($username, $password);
            if ($admin) {
                $_SESSION["User_id"] = $admin["id"];
                $_SESSION["Username"] = $admin["username"];
                $_SESSION["SuccessMessage"] = "Chào mừng, {$_SESSION["Username"]}";
                Redirect_to("dashboard.php");
            } else {
                $_SESSION["ErrorMessage"] = "Tài khoản / Mật khẩu đéo hợp lệ";
                Redirect_to("login.php");
            }
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> AoAnhs2303's Blog </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="images/favicon.ico" />
    <script type="text/javascript" src="vendor/bootstrap.js"></script>
    <script type="text/javascript" src="vendor/angular.js"></script>
    <script type="text/javascript" src="vendor/angular-route.js"></script>
    <script type="text/javascript" src="login.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap.css">
    <link rel="stylesheet" href="vendor/font-awesome.css">
    <link rel="stylesheet" href="style-login.css">
    
</head>
<body>
    <div class="container">
        <div class="row"> 
            <div class="col-sm-4 panel-login">

                <div class="panel-head">
                    <div class="row">
                        <div class="col-6 text-center active">
                            <a href="">Đăng nhập</a>
                        </div>
                        <div class="col-6 text-center">
                            <a href="">Đăng ký</a>
                        </div>    
                    </div>  
                    <h5 class="display-4 text-center" style="padding: 10px 0px"><span style="color: #e67e22">A</span>o<span style="color: #e67e22">A</span>nhs2303</h5>  
                </div>
             
                <div class="panel-body mt-2">
                    <div class="col-12">
            
                        <div class="login-form active form-dangnhap">
                            <form action="#" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" style="width: 35px"><i class="fa fa-user"></i></span>
                                    <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" value="">
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" style="width: 35px"><i class="fa fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu">

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <input type="submit" name="login-submit" class="form-control btn btn-login" value="Vào thôi">
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>

                        
                        <div class="register-form form-dangnhap">
                            <form action="#" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="width: 35px"><i class="fa fa-user"></i></span>
                                        <input type="text" name="usernameRes" class="form-control" placeholder="Tên đăng nhập" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="width: 35px"><i class="fa fa-lock"></i></span>
                                        <input type="password" name="passwordRes" class="form-control" placeholder="Mật khẩu" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="width: 35px"><i class="fa fa-repeat"></i></span>
                                        <input type="password" name="passwordRes2" class="form-control" placeholder="Nhập lại mật khẩu" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="width: 35px"><i class="fa fa-check-circle"></i></span>
                                        <input type="password" name="code" class="form-control" placeholder="Code từ admin" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" class="form-control btn btn-login" value="Log In">
                                        </div>
                                    </div>
                                </div>    
                                
                            </form>
                            
                        </div>
                    </div>
                    <?php 
                    //Xuat thong bao
                    echo Success();
                    echo Error();
                    ?>
                </div>
            </div>    
        </div>

    </div>
</body>
</html>
