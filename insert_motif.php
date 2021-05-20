<?php
include 'check.php';

$lastMotifIdQry = "SELECT max(motif_id) FROM `d_motifs`";
$lastMotifIdResult = mysqli_query($conn, $lastMotifIdQry);
$rowMotifId = mysqli_fetch_row($lastMotifIdResult);
$lastMotifIdKey = $rowMotifId[0];

if (isset($_POST['insertMotif'])) {
    $motif_id = $_POST['motif_id'];
    $motif_name = $_POST['motif_name'];
    $insertMotifQry = "INSERT INTO d_motifs VALUES($motif_id,'$motif_name')";
    if (mysqli_query($conn, $insertMotifQry)) {
        echo "<script>alert('تم إضافة الزخرفة: $motif_name بنجاح')</script>";
        echo '<script>window.location.href = "settings.php#settings"</script>';
    } else {
        echo "<script>alert('فشلت عملية إضافة الزخرفة!')</script>";
        echo '<script>window.location.href = "settings.php#settings"</script>';
    }
}
?>
<!-- Modal -->
<div class="modal fade" id="addMotif" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة زخرفة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="insert_motif.php" method="post">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="motif_id" id="motif_id"
                        value="<?php echo $lastMotifIdKey + 1 ?>" readonly>
                    <div class="form-group">
                        <label for="motif_name">اسم الزخرفة</label>
                        <input type="text" class="form-control" name="motif_name" id="motif_name"
                            placeholder="أدخل اسم الزخرفة" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" name="insertMotif" class="btn btn-success">إضافة</button>
                </div>
            </form>
        </div>
    </div>
</div>