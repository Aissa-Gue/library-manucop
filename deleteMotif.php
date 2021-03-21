<?php
include 'check.php';

if (isset($_GET['manu_id'])) {
    $manu_id = $_GET['manu_id'];
    $motif_id = $_GET['motif_id'];

    $deleteMotifQry = "DELETE FROM j_manuscripts_motifs WHERE (manu_id = '$manu_id' and motif_id = '$motif_id')";
    if (!mysqli_query($conn, $deleteMotifQry)) echo "ERR> " . mysqli_error($conn);
}
header('location: editForm.php?manu_id=' . $manu_id);