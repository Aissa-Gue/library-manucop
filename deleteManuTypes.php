<?php
include 'check.php';

if (isset($_GET['manu_id'])) {
    $manu_id = $_GET['manu_id'];
    $type_id = $_GET['type_id'];

    $deleteManuTypesQry = "DELETE FROM j_manuscripts_manutypes WHERE (manu_id = '$manu_id' and type_id = '$type_id')";
    if (!mysqli_query($conn, $deleteManuTypesQry)) echo "ERR> " . mysqli_error($conn);
}
header('location: editForm.php?manu_id=' . $manu_id);