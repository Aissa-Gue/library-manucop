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
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body a {
    color: darkorchid;
    text-decoration: none;
}

.login-form-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 1200px;
    height: 600px;
    margin: 0 auto;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0px 0px 47px 0px rgba(0, 0, 0, 0.47);
    margin-top: 20px;
    background: #fff;

    background-image: url(img/login_form.jpg);
    background-size: cover;
    background-position: 570px 0px;
    object-fit: cover;
}

.welcome-text p {
    font-size: 13px;
}

.left-section {
    width: 450px;
    height: 540px;
    float: left;
}

.right-section {
    width: 750px;
    position: relative;
    height: 100vh;
    background-image: url(img/login.png);
    background-size: cover;
    /* background-position: 750px 0px; */
    object-fit: cover;
}

.welcome-text {
    position: absolute;
    max-width: 750px;
    text-align: center;
    top: 25%;
    color: #9F7833;
    transform: translateY(-50%);
}

.title {
    text-align: center;
    margin-top: 80px;
    color: #292929;
    line-height: 30px;
    margin-bottom: 30px;
}

.form {
    max-width: 260px;
    margin: 0 auto;
    text-align: center;
}

.form input[type=text],
.form input[type=password] {
    width: 300px;
    padding: 14px 12px;
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
    padding: 11px;
    border-radius: 30px;
    cursor: pointer;
    letter-spacing: 2px;
    margin: 20px 0px;
    transition: 0.3s all ease-in-out;
}

.form input[type="submit"]:focus {
    outline: none;
}

.form input[type="submit"]:hover {
    background: #111;
}

.create-account {
    font-weight: 500;
    font-size: 14px;
    color: #424242;
    margin-top: 10px;
}
</style>

<body class="">
    <div class="login-form-wrap">

        <div class="right-section">
            <div class="welcome-text">
                <!-- <h1>برنامج نساخ المخطوطات</h1> -->
            </div>
        </div>

        <div class="left-section">
            <div class="title mb-5">
                <h1>مرحبا !</h1>
            </div>
            <div class="form">
                <form class="" action="check.php" method="post">
                    <input type="text" name="username" placeholder="أدخل اسم المستخدم">
                    <input type="password" name="password" placeholder="أدخل كلمة المرور">
                    <input type="submit" name="login" class="btn btn-info" value="تسجيل الدخول">
                </form>
            </div>
        </div>
    </div>
    <script src="bootstrap-4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap-4.5.3/jquery-3.3.1.js"></script>
</body>

</html>