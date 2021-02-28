<?php
include 'header.php';
//select all authors
$selectAuthQry = "SELECT auth_id, auth_name FROM c_authors";
$authListResult = mysqli_query($conn, $selectAuthQry);
$rowsAuth = mysqli_fetch_all($authListResult, MYSQLI_ASSOC);
$lastAuthKey = key(array_slice($rowsAuth, -1, 1, true));

//select all subjects
$selectsubjQry = "SELECT subj_id, subj_name FROM b_subjects";
$subjListResult = mysqli_query($conn, $selectsubjQry);
$rowsSubj = mysqli_fetch_all($subjListResult, MYSQLI_ASSOC);
$lastSubjKey = key(array_slice($rowsSubj, -1, 1, true));

////////////////////////////////////////////// Insert Book //////////////////////////////////////////////
$insBookErrs = array("ERRORS >>: <br>");

if (isset($_POST['insertBook'])) {
    $book_id = $_POST['book_id'];
    $book_title = $_POST['book_title'];

    //********** Insert into Books_Subjects Queries **********/
    if (isset($_POST['subj_name1']) and $_POST['subj_name1'] !== "") {
        $subj_explode = explode(' # ', $_POST['subj_name1']);
        $subj_name1 = $subj_explode[0]; // multi
        $insertSubjQry1 = "INSERT INTO f_books_subjects Values('$book_id','$subj_name1')";
    } else $insertSubjQry1 = "SELECT 1";

    if (isset($_POST['subj_name2']) and $_POST['subj_name2'] !== "") {
        $subj_explode = explode(' # ', $_POST['subj_name2']);
        $subj_name2 = $subj_explode[0]; // multi
        $insertSubjQry2 = "INSERT INTO f_books_subjects Values('$book_id','$subj_name2')";
    } else $insertSubjQry2 = "SELECT 1";

    if (isset($_POST['subj_name3']) and $_POST['subj_name3'] !== "") {
        $subj_explode = explode(' # ', $_POST['subj_name3']);
        $subj_name3 = $subj_explode[0]; // multi
        $insertSubjQry3 = "INSERT INTO f_books_subjects Values('$book_id','$subj_name3')";
    } else $insertSubjQry3 = "SELECT 1";

    if (isset($_POST['subj_name4']) and $_POST['subj_name4'] !== "") {
        $subj_explode = explode(' # ', $_POST['subj_name4']);
        $subj_name4 = $subj_explode[0]; // multi
        $insertSubjQry4 = "INSERT INTO f_books_subjects Values('$book_id','$subj_name4')";
    } else $insertSubjQry4 = "SELECT 1";

    if (isset($_POST['subj_name5']) and $_POST['subj_name5'] !== "") {
        $subj_explode = explode(' # ', $_POST['subj_name5']);
        $subj_name5 = $subj_explode[0]; // multi
        $insertSubjQry5 = "INSERT INTO f_books_subjects Values('$book_id','$subj_name5')";
    } else $insertSubjQry5 = "SELECT 1";

    //********** Insert into Books_Authors Queries **********/
    $auth_explode = explode(' # ', $_POST['auth_name1']);
    $auth_name1 = $auth_explode[0]; // multi
    $insertAuthQry1 = "INSERT INTO g_books_authors Values('$book_id','$auth_name1')";

    if (isset($_POST['auth_name2']) and $_POST['auth_name2'] !== "") {
        $auth_explode = explode(' # ', $_POST['auth_name2']);
        $auth_name2 = $auth_explode[0]; // multi
        $insertAuthQry2 = "INSERT INTO g_books_authors Values('$book_id','$auth_name2')";
    } else $insertAuthQry2 = "SELECT 1";

    if (isset($_POST['auth_name3']) and $_POST['auth_name3'] !== "") {
        $auth_explode = explode(' # ', $_POST['auth_name3']);
        $auth_name3 = $auth_explode[0]; // multi
        $insertAuthQry3 = "INSERT INTO g_books_authors Values('$book_id','$auth_name3')";
    } else $insertAuthQry3 = "SELECT 1";

    //////////
    $creation_date = $date;
    $last_edit_date = $date;

    $insertBookQry = "INSERT INTO a_books VALUES ('$book_id', '$book_title', '$creation_date', '$last_edit_date')";

    //********** Insert into Books **********/
    if (!mysqli_query($conn, $insertBookQry)) array_push($insBookErrs, "<br> Books >> " . mysqli_error($conn));
    //echo "<br> Books >> " . mysqli_error($conn);

    //********** Insert into Books_Subjects **********/
    if (!mysqli_query($conn, $insertSubjQry1)) array_push($insBookErrs, "<br> Books_Subjects#1 >> " . mysqli_error($conn));
    //echo "<br> Books_Subjects#1 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $insertSubjQry2)) array_push($insBookErrs, "<br> Books_Subjects#2 >> " . mysqli_error($conn));
    //echo "<br> Books_Subjects#2 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $insertSubjQry3)) array_push($insBookErrs, "<br> Books_Subjects#3 >> " . mysqli_error($conn));
    //echo "<br> Books_Subjects#3 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $insertSubjQry4)) array_push($insBookErrs, "<br> Books_Subjects#4 >> " . mysqli_error($conn));
    //echo "<br> Books_Subjects#4 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $insertSubjQry5)) array_push($insBookErrs, "<br> Books_Subjects#5 >> " . mysqli_error($conn));
    //echo "<br> Books_Subjects#5 >> " . mysqli_error($conn);


    //********** Insert into Books_Authors **********/
    if (!mysqli_query($conn, $insertAuthQry1)) array_push($insBookErrs, "<br> Books_Authors#1 >> " . mysqli_error($conn));
    //echo "<br> Books_Authors#1 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $insertAuthQry2)) array_push($insBookErrs, "<br> Books_Authors#2 >> " . mysqli_error($conn));
    //echo "<br> Books_Authors#2 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $insertAuthQry3)) array_push($insBookErrs, "<br> Books_Authors#3 >> " . mysqli_error($conn));
    //echo "<br> Books_Authors#2 >> " . mysqli_error($conn);


    if (count($insBookErrs) == 1) {
        echo "<script>alert('تم إضافة الكتاب: $book_title بنجاح')</script>";
        echo '<script>window.location.href = "insertBookAuthor.php#insertBookAuthor"</script>';
    } else {
        echo "<script>alert('فشلت عملية إضافة الكتاب')</script>";
        echo print_r($insBookErrs);
        echo '<script>window.location.href = "insertBookAuthor.php#insertBookAuthor"</script>';
    }
}


////////////////////////////////////////////// Insert Author //////////////////////////////////////////////
if (isset($_POST['insertAuthor'])) {
    $auth_id = $_POST['auth_id'];
    $auth_name = $_POST['auth_name'];

    $creation_date = $date;
    $last_edit_date = $date;

    $insertAuthorQry = "INSERT INTO c_authors VALUES ('$auth_id', '$auth_name', '$creation_date', '$last_edit_date')";

    if (mysqli_query($conn, $insertAuthorQry)) {
        echo "<script>alert('تم إضافة المؤلف: $auth_name بنجاح')</script>";
        echo '<script>window.location.href = "insertBookAuthor.php#insertBookAuthor"</script>';
    } else {
        echo "<script>alert('فشلت عملية إضافة المؤلف')</script>";
        echo mysqli_error($conn);
        echo '<script>window.location.href = "insertBookAuthor.php#insertBookAuthor"</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Book & Author</title>
</head>

<body class="my_bg">
    <!-- START row -->
    <div class="container-fluid">
        <div class="row">

            <?php include "sideBar.php" ?>

            <div class="col-10 my_mr_sidebar">
                <div class="tab-content" id="tabContent">
                    <!-- Insert client -->
                    <div class="tab-pane fade mt-3" id="insertBookAuthor">

                        <div class="alert alert-primary text-center" role="alert">
                            <h4>إضافة كتاب / مؤلف</h4>
                        </div>
                        <form action="" method="post">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">معلومات المؤلف</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="auth_id">رقم المؤلف</label>
                                        <input type="number" class="form-control text-center" name="auth_id"
                                            id="auth_id" placeholder="أدخل رقم المؤلف" required>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="auth_name">اسم المؤلف</label>
                                        <input type="text" class="form-control" name="auth_name" id="auth_name"
                                            placeholder="أدخل اسم المؤلف" required>
                                    </div>
                                </div>

                                <div class="form-row justify-content-end">
                                    <div class="form-group col-md-2">
                                        <button type="submit" name="insertAuthor"
                                            class="btn btn-success btn-block btn-lg rounded-pill">إضافة المؤلف</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                        <form action="" method="post">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">معلومات الكتاب</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="book_id">رقم الكتاب</label>
                                        <input type="number" class="form-control text-center" name="book_id"
                                            id="book_id" placeholder="أدخل رقم الكتاب" required>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="book_title">عنوان الكتاب</label>
                                        <input type="text" class="form-control" name="book_title" id="book_title"
                                            placeholder="أدخل عنوان الكتاب" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div id="authors_row" class="form-group col-md-7">
                                        <label for="author">المؤلف</label>
                                        <input list="authors" class="form-control" name="auth_name1" id="author"
                                            placeholder="أدخل المؤلف 1" required>
                                        <datalist id="authors">
                                            <?php
                                            for ($i = 0; $i <= $lastAuthKey; $i++) { ?>
                                            <option
                                                value="<?php print_r($rowsAuth[$i]['auth_id']) ?> # <?php print_r($rowsAuth[$i]['auth_name']); ?>">
                                                <?php  } ?>
                                        </datalist>
                                    </div>
                                    <!-- add input dinamically -->
                                    <div id="addAuthor" class="form-group col-md-auto"
                                        style="cursor: pointer; margin-top: 37px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </div>
                                    <!-- END add input dinamically -->
                                </div>

                                <div class="form-row">
                                    <div id="subjects_row" class="form-group col-md-auto">
                                        <label for="subject">موضوع الكتاب</label>
                                        <input list="subjects" class="form-control" name="subj_name1" id="subject"
                                            placeholder="أدخل الموضوع 1">
                                        <datalist id="subjects">
                                            <?php
                                            for ($i = 0; $i <= $lastSubjKey; $i++) { ?>
                                            <option
                                                value="<?php print_r($rowsSubj[$i]['subj_id']); ?> # <?php print_r($rowsSubj[$i]['subj_name']); ?>">
                                                <?php  } ?>
                                        </datalist>
                                    </div>
                                    <!-- add input dinamically -->
                                    <div id="addSubject" class="form-group col-md-auto"
                                        style="cursor: pointer; margin-top: 37px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </div>
                                    <!-- END add input dinamically -->
                                </div>

                                <div class="form-row justify-content-end">
                                    <div class="form-group col-md-2">
                                        <button type="submit" name="insertBook"
                                            class="btn btn-success btn-block btn-lg rounded-pill">إضافة الكتاب</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

<script src="js/main.js"></script>
<script>
storeSelectedTab();
scrollTop();
</script>

</html>