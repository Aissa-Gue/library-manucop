<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP 4.5 / icons -->
    <link rel="stylesheet" href="bootstrap-4.5.3/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="bootstrap-4.5.3/bootstrap-icons-1.2.1/font/bootstrap-icons.css">

    <!-- my styles -->
    <link rel="stylesheet" href="css/style.css">

    <!-- FONTS -->
    <link rel="stylesheet" href="css/fonts.css">

    <title><?php echo $ProjTitle ?></title>
</head>
<style>
.login-form-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 1000px;
    height: 550px;
    margin: 0 auto;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0px 0px 47px 0px rgba(0, 0, 0, 0.47);
    margin-top: 45px;
    background: #fff;

    background-image: url(img/login.jpg);
    background-size: contain;
    background-repeat: no-repeat;
    object-fit: cover;
}

.title {
    text-align: center;
    margin-top: 80px;
    color: #292929;
    line-height: 30px;
    margin-bottom: 30px;
}



.form input[type=text],
.form input[type=password] {
    width: 300px;
    padding: 12px 9px;
    border-radius: 30px;
    border: 1px solid #ddd;
    margin-bottom: 15px;
    outline: none;
    box-shadow: 0px 0px 42px #d4d4d4;
}

.form input[type="submit"] {
    display: inline-block;
    border: none;
    width: 170px;
    padding: 10px;
    border-radius: 30px;
    cursor: pointer;
    margin: 20px 0px;
    transition: 0.3s all ease-in-out;
}

.form input[type="submit"]:focus {
    outline: none;
}

.form input[type="submit"]:hover {
    background: #111;
}

.my_logo {
    position: relative;
    transform: scale(0.34);
    bottom: -65px;
    right: -195px;
}
</style>

<body class="my_bg">
    <div class="login-form-wrap">
        <div class="col-md-7 align-self-end">
            <div class="my_logo">
                <a href="" data-toggle="modal" data-target="#info">
                    <img src="./img/aissaGue.png" alt="Developped By Aissa.Gue">
                </a>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="info" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">برنامج نساخ المخطوطات</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-right">
                            <p><span class="font-weight-bold">Developped By: </span> Aissa Guellil</p>
                            <p><span class="font-weight-bold">Phone: </span> +213554005029</p>
                            <p><span class="font-weight-bold">Email: </span> AissaStarDz@gmail.com</p>
                            <p class="text-left"><span>- </span>march 2021<span> -</span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">إغلاق</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="title mb-5">
                <h1>مرحبا !</h1>
            </div>
            <div class="form text-center">
                <form class="" action="check.php" method="post">
                    <input type="text" name="username" placeholder="أدخل اسم المستخدم">
                    <input type="password" name="password" placeholder="أدخل كلمة المرور">
                    <input type="submit" name="login" class="btn btn-info" value="تسجيل الدخول">
                </form>
            </div>
        </div>
    </div>

    <script src="bootstrap-4.5.3/jquery-3.3.1.js"></script>
    <script src="bootstrap-4.5.3/bootstrap.bundle.min.js"></script>
</body>

</html>