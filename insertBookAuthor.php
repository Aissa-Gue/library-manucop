<?php
include 'header.php';
include 'lists.php';

// Select last (auth_id)
$lastAuthIdQry = "SELECT max(auth_id) FROM `c_authors`";
$lastAuthIdResult = mysqli_query($conn, $lastAuthIdQry);
$rowAuthId = mysqli_fetch_row($lastAuthIdResult);
$lastAuthId = $rowAuthId[0];

// Select last (book_id)
$lastBookIdQry = "SELECT max(book_id) FROM `a_books`";
$lastBookIdResult = mysqli_query($conn, $lastBookIdQry);
$rowBookId = mysqli_fetch_row($lastBookIdResult);
$lastBookId = $rowBookId[0];

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

    // START TRANSACTION 
    mysqli_query($conn, "START TRANSACTION");

    //********** Insert into Books **********/
    $R1 = mysqli_query($conn, $insertBookQry);
    if ($R1 == false) array_push($insBookErrs, "<br> Books >> " . mysqli_error($conn));

    //********** Insert into Books_Subjects **********/
    $R2 = mysqli_query($conn, $insertSubjQry1);
    $R3 = mysqli_query($conn, $insertSubjQry2);
    $R4 = mysqli_query($conn, $insertSubjQry3);
    $R5 = mysqli_query($conn, $insertSubjQry4);
    $R6 = mysqli_query($conn, $insertSubjQry5);

    if ($R2 == false) array_push($insBookErrs, "<br> Books_Subjects#1 >> " . mysqli_error($conn));
    if ($R3 == false) array_push($insBookErrs, "<br> Books_Subjects#2 >> " . mysqli_error($conn));
    if ($R4 == false) array_push($insBookErrs, "<br> Books_Subjects#3 >> " . mysqli_error($conn));
    if ($R5 == false) array_push($insBookErrs, "<br> Books_Subjects#4 >> " . mysqli_error($conn));
    if ($R6 == false) array_push($insBookErrs, "<br> Books_Subjects#5 >> " . mysqli_error($conn));


    //********** Insert into Books_Authors **********/
    $R7 = mysqli_query($conn, $insertAuthQry1);
    $R8 = mysqli_query($conn, $insertAuthQry2);
    $R9 = mysqli_query($conn, $insertAuthQry3);

    if ($R7 == false) array_push($insBookErrs, "<br> Books_Authors#1 >> " . mysqli_error($conn));
    if ($R8 == false) array_push($insBookErrs, "<br> Books_Authors#2 >> " . mysqli_error($conn));
    if ($R9 == false) array_push($insBookErrs, "<br> Books_Authors#3 >> " . mysqli_error($conn));

    // COMMIT OR ROLLBACK
    if ($R1 and $R2 and $R3 and $R4 and $R5 and $R6 and $R7 and $R8 and $R9) {
        mysqli_query($conn, "COMMIT");
        echo "<script>alert('تم إضافة الكتاب: $book_title بنجاح')</script>";
        echo '<script>window.location.href = "previewBook.php?book_id=' . $book_id . '"</script>';
    } else {
        mysqli_query($conn, "ROLLBACK");
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
        echo '<script>window.location.href = "previewAuthor.php?auth_id=' . $auth_id . '"</script>';
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
    <title><?php echo $ProjTitle ?></title>
</head>

<body class="my_bg">
    <!-- START row -->
    <div class="container-fluid mt-5">
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
                                        <input type="number" class="form-control text-center"
                                            value="<?php echo $lastAuthId + 1 ?>" name="auth_id" id="auth_id"
                                            placeholder="أدخل رقم المؤلف" required>
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
                                        <input type="number" class="form-control text-center"
                                            value="<?php echo $lastBookId + 1 ?>" name="book_id" id="book_id"
                                            placeholder="أدخل رقم الكتاب" required>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                                            <path
                                                d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                                            <path
                                                d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
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