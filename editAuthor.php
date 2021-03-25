<?php
include 'check.php';
include 'header.php';

// GET values from authorsList.php
if (isset($_GET['auth_id'])) {
    $auth_id = $_GET['auth_id'];
    $prev_id = $_GET['auth_id'];

    // Search query
    $searchQry = "SELECT * 
    FROM c_authors 
    WHERE auth_id = '$auth_id'";

    $searchResult = mysqli_query($conn, $searchQry);
    while ($row = mysqli_fetch_array($searchResult)) {
        $auth_id = $row['auth_id'];
        $auth_name = $row['auth_name'];
    }
}
// Edit Author
if (isset($_POST['editAuthor'])) {
    $auth_id = $_POST['auth_id'];
    $auth_name = $_POST['auth_name'];
    $last_edit_date = $date;

    $editAuthorQry = "UPDATE c_authors set auth_id = '$auth_id', auth_name='$auth_name', last_edit_date='$last_edit_date' WHERE auth_id = '$prev_id'";

    if (mysqli_query($conn, $editAuthorQry) and mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('تم تعديل معلومات المؤلف: $auth_name بنجاح')</script>";
        echo "<script> window.location.href= 'editAuthor.php?auth_id=$auth_id'</script>";
    } else {
        echo "<script>alert('فشلت عملية تعديل معلومات المؤلف')</script>";
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $ProjTitle ?></title>
</head>

<body class="my_bg">
    <div class="container-fluid mt-5">

        <?php include "sideBar.php" ?>

        <div class="col-10 my_mr_sidebar pt-3">
            <div class="alert alert-warning text-center h4" role="alert">
                تعديل معلومات المؤلف
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <!-- 1st row -->
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="auth_id" class="form-label">رقم المؤلف</label>
                        <input type="text" class="form-control text-center" value="<?php echo $auth_id ?>" name="auth_id" id="auth_id" required>
                    </div>
                </div>
                <!-- 2nd row -->
                <div class="row mt-3">
                    <div class="col-md-9">
                        <label for="auth_name" class="form-label">اسم المؤلف</label>
                        <input type="text" class="form-control" value="<?php echo $auth_name ?>" name="auth_name" id="auth_name" required>
                    </div>
                </div>

                <div class="form-row justify-content-end mt-4">
                    <div class="form-group my_col_btn">
                        <button type="button" class="btn btn-danger btn-block btn-lg rounded-pill" onclick="window.history.go(-1);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                            </svg>
                            رجوع
                        </button>
                    </div>
                    <div class="form-group my_col_btn">
                        <button type="submit" name="editAuthor" class="btn btn-success btn-block btn-lg rounded-pill">تحديث</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>