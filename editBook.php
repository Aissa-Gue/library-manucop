<?php
include 'header.php';
include 'lists.php';

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

    // book Authors list
    $authorsQry = "SELECT g_books_authors.auth_id, auth_name 
    FROM g_books_authors
    INNER JOIN c_authors
    ON g_books_authors.auth_id = c_authors.auth_id
    WHERE g_books_authors.book_id = '$book_id'";
    $authorsResult = mysqli_query($conn, $authorsQry);

    // book subjects list
    $subjectsQry = "SELECT f_books_subjects.subj_id, subj_name 
    FROM f_books_subjects
    INNER JOIN b_subjects
    ON f_books_subjects.subj_id = b_subjects.subj_id
    WHERE f_books_subjects.book_id = '$book_id'";
    $subjectsResult = mysqli_query($conn, $subjectsQry);
}
// Edit book
if (isset($_POST['editBook'])) {
    $editBookErrs = array("ERRORS >>: <br>");

    $book_id = $_POST['book_id'];
    $book_title = $_POST['book_title'];
    $last_edit_date = $date;

    $editBookQry = "UPDATE a_books set book_id = '$book_id', book_title='$book_title', last_edit_date='$last_edit_date' WHERE book_id = '$prev_id'";

    //********** Update Books_Subjects Queries **********/
    if (isset($_POST['subj_name1']) and $_POST['subj_name1'] !== "") {
        $subj_explode = explode(' # ', $_POST['subj_name1']);
        $subj_name1 = $subj_explode[0]; // multi
        $updateSubjQry1 = "INSERT INTO f_books_subjects (book_id, subj_id) VALUES('$book_id', '$subj_name1') ON DUPLICATE KEY UPDATE subj_id = '$subj_name1'";
    } else $updateSubjQry1 = "SELECT 1";

    if (isset($_POST['subj_name2']) and $_POST['subj_name2'] !== "") {
        $subj_explode = explode(' # ', $_POST['subj_name2']);
        $subj_name2 = $subj_explode[0]; // multi
        $updateSubjQry2 = "INSERT INTO f_books_subjects (book_id, subj_id) VALUES('$book_id', '$subj_name2') ON DUPLICATE KEY UPDATE subj_id = '$subj_name2'";
    } else $updateSubjQry2 = "SELECT 1";

    if (isset($_POST['subj_name3']) and $_POST['subj_name3'] !== "") {
        $subj_explode = explode(' # ', $_POST['subj_name3']);
        $subj_name3 = $subj_explode[0]; // multi
        $updateSubjQry3 = "INSERT INTO f_books_subjects (book_id, subj_id) VALUES('$book_id', '$subj_name3') ON DUPLICATE KEY UPDATE subj_id = '$subj_name3'";
    } else $updateSubjQry3 = "SELECT 1";

    if (isset($_POST['subj_name4']) and $_POST['subj_name4'] !== "") {
        $subj_explode = explode(' # ', $_POST['subj_name4']);
        $subj_name4 = $subj_explode[0]; // multi
        $updateSubjQry4 = "INSERT INTO f_books_subjects (book_id, subj_id) VALUES('$book_id', '$subj_name4') ON DUPLICATE KEY UPDATE subj_id = '$subj_name4'";
    } else $updateSubjQry4 = "SELECT 1";

    if (isset($_POST['subj_name5']) and $_POST['subj_name5'] !== "") {
        $subj_explode = explode(' # ', $_POST['subj_name5']);
        $subj_name5 = $subj_explode[0]; // multi
        $updateSubjQry5 = "INSERT INTO f_books_subjects (book_id, subj_id) VALUES('$book_id', '$subj_name5') ON DUPLICATE KEY UPDATE subj_id = '$subj_name5'";
    } else $updateSubjQry5 = "SELECT 1";


    //********** Update Books_Authors Queries **********/
    $auth_explode = explode(' # ', $_POST['auth_name1']);
    $auth_name1 = $auth_explode[0]; // multi
    $updateAuthQry1 = "INSERT INTO g_books_authors(book_id, auth_id) VALUES('$book_id', '$auth_name1') ON DUPLICATE KEY UPDATE auth_id = '$auth_name1'";

    if (isset($_POST['auth_name2']) and $_POST['auth_name2'] !== "") {
        $auth_explode = explode(' # ', $_POST['auth_name2']);
        $auth_name2 = $auth_explode[0]; // multi
        $updateAuthQry2 = "INSERT INTO g_books_authors(book_id, auth_id) VALUES('$book_id', '$auth_name2') ON DUPLICATE KEY UPDATE auth_id = '$auth_name2'";
    } else $updateAuthQry2 = "SELECT 1";

    if (isset($_POST['auth_name3']) and $_POST['auth_name3'] !== "") {
        $auth_explode = explode(' # ', $_POST['auth_name3']);
        $auth_name3 = $auth_explode[0]; // multi
        $updateAuthQry3 = "INSERT INTO g_books_authors(book_id, auth_id) VALUES('$book_id', '$auth_name3') ON DUPLICATE KEY UPDATE auth_id = '$auth_name3'";
    } else $updateAuthQry3 = "SELECT 1";

    //********** Update a_books **********/
    if (!mysqli_query($conn, $editBookQry)) array_push($editBookErrs, "<br> a_books >> " . mysqli_error($conn));


    //********** Update Books_Subjects **********/
    if (!mysqli_query($conn, $updateSubjQry1)) array_push($editBookErrs, "<br> Books_Subjects#1 >> " . mysqli_error($conn));
    //echo "<br> Books_Subjects#1 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $updateSubjQry2)) array_push($editBookErrs, "<br> Books_Subjects#2 >> " . mysqli_error($conn));
    //echo "<br> Books_Subjects#2 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $updateSubjQry3)) array_push($editBookErrs, "<br> Books_Subjects#3 >> " . mysqli_error($conn));
    //echo "<br> Books_Subjects#3 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $updateSubjQry4)) array_push($editBookErrs, "<br> Books_Subjects#4 >> " . mysqli_error($conn));
    //echo "<br> Books_Subjects#4 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $updateSubjQry5)) array_push($editBookErrs, "<br> Books_Subjects#5 >> " . mysqli_error($conn));
    //echo "<br> Books_Subjects#5 >> " . mysqli_error($conn);


    //********** Update Books_Authors **********/
    if (!mysqli_query($conn, $updateAuthQry1)) array_push($editBookErrs, "<br> Books_Authors#1 >> " . mysqli_error($conn));
    //echo "<br> Books_Authors#1 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $updateAuthQry2)) array_push($editBookErrs, "<br> Books_Authors#2 >> " . mysqli_error($conn));
    //echo "<br> Books_Authors#2 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $updateAuthQry3)) array_push($editBookErrs, "<br> Books_Authors#3 >> " . mysqli_error($conn));
    //echo "<br> Books_Authors#2 >> " . mysqli_error($conn);




    if (count($editBookErrs) == 1) {
        echo "<script>alert('تم تعديل معلومات الكتاب: $book_title بنجاح')</script>";
        echo "<script> window.location.href= 'editBook.php?book_id=$book_id'</script>";
    } else {
        echo "<script>alert('فشلت عملية تعديل معلومات الكتاب')</script>";
        echo print_r($editBookErrs);
        echo mysqli_errno($conn);
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
                <div class="col-md-9">
                    <label for="book_title" class="form-label">عنوان الكتاب</label>
                    <input type="text" class="form-control" value="<?php echo $book_title ?>" name="book_title"
                        id="book_title">
                </div>
            </div>

            <!-- 2nd row -->
            <div class="row mt-3">
                <div class="col-md-9">
                    <label for="author" class="form-label">المؤلفين</label>
                    <?php
                    $a = 1;
                    while ($row = mysqli_fetch_array($authorsResult)) {
                    ?>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span>
                                <a class="btn btn-outline-danger"
                                    href="deleteBookAuth.php?book_id=<?php echo $book_id ?>&auth_id=<?php echo $row['auth_id']  ?>"
                                    onclick="return confirm('هل أنت متأكد من حذف المؤلف؟')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </a>
                            </span>
                        </div>

                        <input list="authors" class="form-control mb-2" name="auth_name<?php echo $a ?>"
                            value="<?php echo $row['auth_id'] . ' # ' . $row['auth_name']; ?>" id="author"
                            placeholder="أدخل مؤلف">
                        <datalist id="authors">
                            <?php
                                for ($i = 0; $i <= $lastAuthKey; $i++) { ?>
                            <option
                                value="<?php print_r($rowsAuth[$i]['auth_id']) ?> # <?php print_r($rowsAuth[$i]['auth_name']); ?>">
                                <?php  } ?>
                        </datalist>
                    </div>

                    <?php
                        $a++;
                    }
                    ?>
                    <!-- add input if nbr of authors under 3  -->
                    <?php if ($a < 4) {
                        for ($a; $a < 4; $a++) {
                    ?>
                    <input list="authors" class="form-control mb-2" name="auth_name<?php echo $a ?>" id="author"
                        placeholder="أدخل مؤلف">
                    <datalist id="authors">
                        <?php
                                for ($i = 0; $i <= $lastAuthKey; $i++) { ?>
                        <option
                            value="<?php print_r($rowsAuth[$i]['auth_id']) ?> # <?php print_r($rowsAuth[$i]['auth_name']); ?>">
                            <?php  } ?>
                    </datalist>
                    <?php
                        }
                    } ?>
                </div>
            </div>

            <!-- 3rd row -->
            <label for="subject_name" class="form-label mt-3">المواضيع</label>
            <div class="row">
                <?php
                $b = 1;
                while ($row = mysqli_fetch_array($subjectsResult)) {
                ?>
                <div class="col-md-3">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span>
                                <a class="btn btn-outline-danger"
                                    href="deleteBookSubj.php?book_id=<?php echo $book_id ?>&subj_id=<?php echo $row['subj_id']  ?>"
                                    onclick="return confirm('هل أنت متأكد من حذف الموضوع؟')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </a>
                            </span>
                        </div>

                        <input list="subjects" class="form-control" name="subj_name<?php echo $b ?>" id="subject"
                            value="<?php echo  $row['subj_id'] . ' # ' . $row['subj_name']; ?>"
                            placeholder="أدخل موضوع">
                        <datalist id="subjects">
                            <?php
                                for ($i = 0; $i <= $lastSubjKey; $i++) { ?>
                            <option
                                value="<?php print_r($rowsSubj[$i]['subj_id']); ?> # <?php print_r($rowsSubj[$i]['subj_name']); ?>">
                                <?php  } ?>
                        </datalist>
                    </div>

                </div>
                <?php
                    $b++;
                }
                ?>
                <!-- add input if nbr of subjects under 5  -->
                <?php if ($b < 6) {
                    for ($b; $b < 6; $b++) {
                ?>
                <div class="col-md-3">
                    <input list="subjects" class="form-control" name="subj_name<?php echo $b ?>" id="subject"
                        placeholder="أدخل موضوع">
                    <datalist id="subjects">
                        <?php
                                for ($i = 0; $i <= $lastSubjKey; $i++) { ?>
                        <option
                            value="<?php print_r($rowsSubj[$i]['subj_id']); ?> # <?php print_r($rowsSubj[$i]['subj_name']); ?>">
                            <?php  } ?>
                    </datalist>
                </div>
                <?php
                    } // END add input if nbr of subjects under 5
                } ?>
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
    <script src="js/main.js"></script>
</body>

</html>