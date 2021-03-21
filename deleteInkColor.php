<?php
include 'check.php';

if (isset($_GET['manu_id'])) {
    $manu_id = $_GET['manu_id'];
    $color_id = $_GET['color_id'];

    $deleteInkColorQry = "DELETE FROM j_manuscripts_colors WHERE (manu_id = '$manu_id' and color_id = '$color_id')";
    if (!mysqli_query($conn, $deleteInkColorQry)) echo "ERR> " . mysqli_error($conn);
}
header('location: editForm.php?manu_id=' . $manu_id);