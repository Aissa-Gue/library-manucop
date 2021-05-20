<?php
include 'check.php';

if (isset($_POST['editMotif'])) {
    $motif_id = $_POST['motif_id'];
    $motif_name = $_POST['motif_name'];
    $editMotifQry = "UPDATE d_motifs set motif_name = '$motif_name' WHERE motif_id = '$motif_id'";

    if (mysqli_query($conn, $editMotifQry)) {
        echo "<script>alert('تم تعديل اسم الزخرفة: $motif_name بنجاح')</script>";
        echo '<script>window.location.href = "settings.php#settings"</script>';
    } else {
        echo "<script>alert('فشلت عملية تعديل اسم الزخرفة!')</script>";
        echo '<script>window.location.href = "settings.php#settings"</script>';
    }
}
?>
<!-- Modal -->
<div class="modal fade" id="editMotif<?php echo $row['motif_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل اسم الزخرفة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="edit_motif.php" method="post">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="motif_id" id="motif_id"
                        value="<?php echo $row['motif_id'] ?>" readonly>
                    <div class="form-group">
                        <label for="motif_name">اسم الزخرفة</label>
                        <input type="text" class="form-control" name="motif_name" id="motif_name"
                            placeholder="أدخل اسم الزخرفة" value="<?php echo $row['motif_name'] ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" name="editMotif" class="btn btn-success">تعديل</button>
                </div>
            </form>
        </div>
    </div>
</div>