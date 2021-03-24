<?php
include 'check.php';

// DROP ALL Tables
if (isset($_POST['drop'])) {
    $dropSql = "DROP DATABASE $dbname";

    if (mysqli_query($conn, $dropSql)) {
        echo '<br><br>
    <h3 align= "center" style="color:white; background:green;padding:15px"> تم حذف قاعدة البيانات بنجاح </h3>';
        header("refresh:1.5; url=logout.php");
    } else {
        echo '<br><br>
        <h3 align= "center" style="color:white; background:red;padding:15px"> حدثت مشكلة ! لم يتم حذف قاعدة البيانات </h3>' . mysqli_error($conn);
        header("refresh:1.5; url=settings.php#settings");
    }
}