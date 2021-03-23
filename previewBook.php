<?php
include 'check.php';
include 'header.php';

// GET values from booksList.php
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Search query
    $searchQry = "SELECT * 
    FROM a_books 
    WHERE book_id = '$book_id'";

    $searchResult = mysqli_query($conn, $searchQry);
    while ($row = mysqli_fetch_array($searchResult)) {
        $book_id = $row['book_id'];
        $book_title = $row['book_title'];
        $creation_date = $row['creation_date'];
        $last_edit_date = $row['last_edit_date'];
    }

    // Book Authors list
    $authorsQry = "SELECT auth_name 
    FROM g_books_authors
    INNER JOIN c_authors
    ON g_books_authors.auth_id = c_authors.auth_id
    WHERE g_books_authors.book_id = '$book_id'";
    $authorsResult = mysqli_query($conn, $authorsQry);

    // Book subjects list
    $subjectsQry = "SELECT subj_name 
    FROM f_books_subjects
    INNER JOIN b_subjects
    ON f_books_subjects.subj_id = b_subjects.subj_id
    WHERE f_books_subjects.book_id = '$book_id'";
    $subjectsResult = mysqli_query($conn, $subjectsQry);

    // Book manuscripts List
    $bookManuListQry = "SELECT e_manuscripts.manu_id, d_copiers.cop_id, full_name
    FROM e_manuscripts
    INNER JOIN h_manuscripts_copiers
    ON h_manuscripts_copiers.manu_id = e_manuscripts.manu_id
    INNER JOIN d_copiers
    ON d_copiers.cop_id = h_manuscripts_copiers.cop_id
    WHERE e_manuscripts.book_id = $book_id";
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Preview</title>
</head>

<body class="my_bg">
    <div class="container-fluid mt-5">

        <?php include "sideBar.php" ?>

        <div class="col-10 my_mr_sidebar pt-3">
            <div class="alert alert-warning text-center h4" role="alert">
                معلومات الكتاب
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <!-- 1st row -->
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="book_id" class="form-label">رقم الكتاب</label>
                        <input type="text" class="form-control text-center" value="<?php echo $book_id ?>"
                            name="book_id" id="book_id" readonly>
                    </div>
                    <div class="col-md-9">
                        <label for="book_title" class="form-label">عنوان الكتاب</label>
                        <input type="text" class="form-control" value="<?php echo $book_title ?>" name="book_title"
                            id="book_title" readonly>
                    </div>
                </div>

                <!-- 2nd row -->
                <div class="row mt-2">
                    <div class="col-md-9">
                        <label for="author" class="form-label">المؤلفين</label>
                        <?php
                        while ($row = mysqli_fetch_array($authorsResult)) {
                        ?>
                        <input type="text" class="form-control mb-2" value="<?php echo $row['auth_name']; ?>"
                            name="auth_name" id="author" readonly>
                        <?php } ?>
                    </div>
                </div>

                <!-- 3rd row -->
                <label for="subject_name" class="form-label mt-2">المواضيع</label>
                <div class="row">
                    <?php
                    while ($row = mysqli_fetch_array($subjectsResult)) {
                    ?>
                    <div class="col-md-auto">
                        <input type="text" class="form-control mb-1" value="<?php echo  $row['subj_name']; ?>"
                            name="subj_name" id="subject_name" readonly>
                    </div>
                    <?php } ?>
                </div>

                <!-- 4th row -->
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="creation_date" class="form-label">تاريخ الإضافة</label>
                        <input type="text" class="form-control" value="<?php echo $creation_date ?>" id="creation_date"
                            readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="last_edit_date" class="form-label">تاريخ آخر تعديل</label>
                        <input type="text" class="form-control" value="<?php echo $last_edit_date ?>"
                            id="last_edit_date" readonly>
                    </div>
                </div>
                <button type="submit" name="copList" class="btn btn-info mt-3 mb-3">عرض قائمة
                    الاستمارات / النساخ </button>
            </form>

            <!-- Copier manuscripts LIST -->
            <?php if (isset($_POST['copList'])) { ?>
            <div class="row">
                <table class="table table-striped col-md-10">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">رقم الاستمارة</th>
                            <th scope="col" class="text-center">رقم الناسخ</th>
                            <th scope="col">اسم الناسخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $bookManuListResult = mysqli_query($conn, $bookManuListQry);
                            if (mysqli_num_rows($bookManuListResult) > 0) {
                                while ($row = mysqli_fetch_array($bookManuListResult)) {
                            ?>
                        <tr>
                            <th scope="row" class="text-center">
                                <a
                                    href="previewForm.php?manu_id=<?php echo $row['manu_id'] ?>"><?php echo $row['manu_id'] ?></a>
                            </th>
                            <td scope="row" class="text-center"><?php echo $row['cop_id'] ?></td>
                            <td>
                                <a
                                    href="previewCopier.php?cop_id=<?php echo $row['cop_id'] ?>"><?php echo $row['full_name'] ?></a>
                            </td>
                        </tr>
                        <?php }
                            } else {
                                echo '<th scope="row"></th><td>لا توجد منسوخات لهذا الكتاب</td>';
                            } ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>
            <button type="button" class="my_fixed_button1 my_col_btn btn btn-danger btn-lg rounded-pill"
                onclick="window.history.go(-1);">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                </svg>
                رجوع
            </button>

        </div>
    </div>
</body>

</html>