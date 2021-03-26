<?php
include 'header.php';

if (isset($_GET['manu_id'])) {
    $manu_id = $_GET['manu_id'];
    $cop_id = $_GET['cop_id'];
    $selectManuCopsQry = "SELECT cop_id FROM h_manuscripts_copiers WHERE (manu_id= '$manu_id' and cop_id= '$cop_id')";
    $selectManuCopsResult = mysqli_query($conn, $selectManuCopsResult);
    if (mysqli_num_rows($selectManuCopsResult) > 1) {
        $deleteManuCopQry = "DELETE FROM h_manuscripts_copiers WHERE (manu_id= '$manu_id' and cop_id= '$cop_id')";
        if (!mysqli_query($conn, $deleteManuCopQry)) echo "ERR> " . mysqli_error($conn);
    } else {
        echo "<script>alert('فشلت عملية الحذف، انتبه: لا يمكن للنسخة أن تكون بدون ناسخ !')</script>";
    }
}
echo '<script>window.location.href = "editForm.php?manu_id=' . $manu_id . '"</script>';

//header('location: editForm.php?manu_id=' . $manu_id);