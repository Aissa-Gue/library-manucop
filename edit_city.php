<?php
include 'check.php';

if (isset($_POST['editCity'])) {
    $city_id = $_POST['city_id'];
    $city_name = $_POST['city_name'];

    $editCityQry = "UPDATE cities set city_name = '$city_name' WHERE city_id = '$city_id'";
    if (mysqli_query($conn, $editCityQry)) {
        echo "<script>alert('تم تعديل اسم المدينة: $city_name بنجاح')</script>";
        echo '<script>window.location.href = "insertCountry.php#insertCountry"</script>';
    } else {
        echo "<script>alert('فشلت عملية تعديل اسم المدينة!')</script>";
        echo '<script>window.location.href = "insertCountry.php#insertCountry"</script>';
    }
}
?>
<!-- START Modal City Edit -->
<div class="modal fade" id="editCityModal<?php echo $row['city_id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل اسم المدينة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal form -->
            <form action="edit_city.php" method="post" class="col-md-9">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $row['city_id'] ?>" name="city_id">
                    <div class="mb-2">
                        <label for="city" class="form-label">المدينة</label>
                        <input type="text" name="city_name" class="form-control mb-2"
                            value="<?php echo $row['city_name'] ?>" placeholder="أدخل مدينة" required
                            autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" name="editCity" class="btn btn-success">تعديل</button>
                </div>
            </form>
            <!-- END Modal form -->
        </div>
    </div>
</div>
<!-- END Modal City Edit -->