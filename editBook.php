<?php
include 'check.php';
include 'header.php';

// GET values from booksList.php
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $prev_id = $_GET['book_id'];

    // Search query
    $searchQry = "SELECT * 
    FROM a_books 
    WHERE book_id = '$book_id'";

    $searchResult = mysqli_query($conn, $searchQry);
    while ($row = mysqli_fetch_array($searchResult)) {
        $book_id = $row['book_id'];
        $book_title = $row['book_title'];
    }
}
// Edit book
if (isset($_POST['editBook'])) {
    $book_id = $_POST['book_id'];
    $book_title = $_POST['book_title'];
    $last_edit_date = $date;

    $editCopierQry = "UPDATE a_books set book_id = '$book_id', book_title='$book_title', last_edit_date='$last_edit_date' WHERE book_id = '$prev_id'";

    if (mysqli_query($conn, $editCopierQry) and mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('تم تعديل معلومات الكتاب: $book_title بنجاح')</script>";
        echo "<script> window.location.href= 'editBook.php?book_id=$book_id'</script>";
    } else {
        echo "<script>alert('فشلت عملية تعديل معلومات الكتاب')</script>";
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Edit</title>
</head>

<body class="my_bg">
    <?php include "sideBar.php" ?>

    <div class="col-10 my_mr_sidebar pt-3">
        <div class="alert alert-warning text-center h4" role="alert">
            تعديل معلومات الكتاب
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <!-- 1st row -->
            <div class="row mt-3">
                <div class="col-md-2">
                    <label for="book_id" class="form-label">رقم الكتاب</label>
                    <input type="text" class="form-control text-center" value="<?php echo $book_id ?>" name="book_id"
                        id="book_id" required>
                </div>
            </div>
            <!-- 2nd row -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label for="book_title" class="form-label">عنوان الكتاب</label>
                    <input type="text" class="form-control" value="<?php echo $book_title ?>" name="book_title"
                        id="book_title" required>
                </div>
            </div>

            <div class="form-row justify-content-end mt-4">
                <div class="form-group my_col_btn">
                    <button type="button" class="btn btn-danger btn-block btn-lg rounded-pill"
                        onclick="window.history.go(-1);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                        </svg>
                        رجوع
                    </button>
                </div>
                <div class="form-group my_col_btn">
                    <button type="submit" name="editBook"
                        class="btn btn-success btn-block btn-lg rounded-pill">تحديث</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>