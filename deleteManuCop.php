<?php
include 'header.php';

if (isset($_GET['manu_id'])) {
    $manu_id = $_GET['manu_id'];
    $cop_id = $_GET['cop_id'];

    $deleteManuCopQry = "DELETE FROM h_manuscripts_copiers WHERE (manu_id= '$manu_id' and cop_id= '$cop_id')";
    if (!mysqli_query($conn, $deleteManuCopQry)) echo "ERR> " . mysqli_error($conn);
}
header('location: editForm.php?manu_id=' . $manu_id);