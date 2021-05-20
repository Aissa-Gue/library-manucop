<?php
include 'check.php';

if (isset($_POST['editCountry'])) {
    $count_id = $_POST['count_id'];
    $count_name = $_POST['count_name'];

    $editCountryQry = "UPDATE countries set count_name = '$count_name' WHERE count_id = '$count_id'";
    if (mysqli_query($conn, $editCountryQry)) {
        echo "<script>alert('تم تعديل اسم البلد: $count_name بنجاح')</script>";
        echo '<script>window.location.href = "insertCountry.php#insertCountry"</script>';
    } else {
        echo "<script>alert('فشلت عملية تعديل اسم البلد!')</script>";
        echo '<script>window.location.href = "insertCountry.php#insertCountry"</script>';
    }
}
?>
<!-- START Modal Country Edit -->
<div class="modal fade" id="editCountModal<?php echo $row['count_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل اسم البلد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal form -->
            <form action="edit_country.php" method="post" class="col-md-9">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $row['count_id'] ?>" name="count_id">
                    <div class="mb-2">
                        <label for="country" class="form-label">البلد</label>
                        <input type="text" name="count_name" class="form-control mb-2"
                            value="<?php echo $row['count_name'] ?>" placeholder="أدخل بلد" required autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" name="editCountry" class="btn btn-success">تعديل</button>
                </div>
            </form>
            <!-- END Modal form -->
        </div>
    </div>
</div>
<!-- END Modal Country Edit -->