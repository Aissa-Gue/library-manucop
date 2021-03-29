<?php
include 'check.php';
//disable validation of form by the browser (header)
header('Cache-Control: no cache');
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP 4.5 / icons -->
    <link rel="stylesheet" href="bootstrap-4.5.3/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="bootstrap-4.5.3/bootstrap-icons-1.2.1/font/bootstrap-icons.css">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/fonts.css">
    <!-- my styles -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- START Navbar -->
    <nav class="navbar navbar-dark bg-info fixed-top">
        <a class="navbar-brand" href="insertForm.php#insertForm">
            <img src="img/logo.JPG" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            <?php echo $ProjTitle ?>
        </a>
        <a class="navbar-brand" href="insertForm.php#insertForm">
            قسم التراث والمكتبة
        </a>
    </nav>
    <!-- END Navbar -->
    <script src="bootstrap-4.5.3/jquery-3.3.1.js"></script>
    <script src="bootstrap-4.5.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>