<?php
//ignore php errors
//error_reporting(E_ERROR | E_PARSE);
// variables
$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "library_invoices_db";
$dbname = "library_manucop_db";

$con = mysqli_connect($servername, $username, $password);
$db_selected = mysqli_select_db($con, $dbname);

if (!$db_selected) {
    $createDb = "CREATE DATABASE $dbname";
    mysqli_query($con, $createDb);
    include 'create_empty_db.php';
}
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo 'Failed to connect to database' . mysqli_connect_error();
}

// current date
//$date = date("Y-m-d");
//$date = date('Y-m-d H:i:s', '1299762201428');
$date = date('Y-m-d H:i:s', time());

// days List
$days = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");

//months List
$months = array("محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأولى", "جمادى الثانية", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة");

//cabinet names
$cabinet_names = array("العامة", "أبو بكر الوارجلاني", "محمد حواش", "اطفيش");

//font styles List
$w_font_styles = array("المبسوط", "المجوهر", "المسند (الزمامي)", "المدمج", "الثلث المغربي", "الكوفي المغربي",);
$e_font_styles = array("النسخ", "الثلث", "الكوفي", "التعليق", "الديواني", "الرقعة");

//motifs List
$motifs = array("دائرة منقطة", "فواصل", "وريدات", "مراوح", "براعم", "فصوص");

//ink colors List
$ink_colors = array("البني", "الأسود", "الأحمر", "الآجوري", "البنفسجي", "الوردي", "البرتقالي", "الأصفر", "الأخضر", "الأزرق", "المذهب",);

//manu types List
$manu_types = array("تصحيح", "تصويب", "مقابلة", "تعليق");

//arabic lang chars
mysqli_set_charset($conn, 'utf8');