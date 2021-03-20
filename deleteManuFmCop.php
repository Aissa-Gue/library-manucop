<?php
include 'header.php';

if (isset($_GET['manu_id'])) {
    $manu_id = $_GET['manu_id'];
    $cop_id = $_GET['cop_id'];
    $cop_fm = $_GET['cop_fm'];

    $deleteManuFmCopQry = "DELETE FROM i_cop_fm WHERE (manu_id = '$manu_id' and cop_id = '$cop_id' and cop_fm = '$cop_fm')";
    if (!mysqli_query($conn, $deleteManuFmCopQry)) echo "ERR> " . mysqli_error($conn);
}
header('location: editForm.php?manu_id=' . $manu_id);