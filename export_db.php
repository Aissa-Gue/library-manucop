<?php
include 'config.php';

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'library_manucop_db';
$path = 'D:/' . $dbname . '.sql';

$command = "C:/xampp/mysql/bin/mysqldump.exe -u root library_manucop_db >" . $path;
exec($command . ' 2>&1', $output);

if (count($output) == 0) {
    echo "<script>alert('تم استخراج قاعدة البيانات بنجاح، تفقد القرص المحلي (D)');</script>";
    echo "<script> window.location.href= 'settings.php#settings'</script>";
} else {
    echo "<script>alert('حدثت مشكلة لم يتم استخراج قاعدة البيانات !');</script>";
    echo "<script> window.location.href= 'settings.php#settings'</script>";
}
//exec($command);
//exec($command . ' 2>&1', $output);
//var_dump($output);