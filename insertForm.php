<?php
include 'header.php';

// select all copiers
$selectCopQry = "SELECT cop_id, full_name FROM d_copiers";
$copListResult = mysqli_query($conn, $selectCopQry);
$rows = mysqli_fetch_all($copListResult, MYSQLI_ASSOC);
$lastKey = key(array_slice($rows, -1, 1, true));

//Select all books
$selectBooksQry = "SELECT book_id, book_title FROM a_books";
$booksListResult = mysqli_query($conn, $selectBooksQry);
$rowsBooks = mysqli_fetch_all($booksListResult, MYSQLI_ASSOC);
$lastBookKey = key(array_slice($rowsBooks, -1, 1, true));

//insert form
if (isset($_POST['insertForm'])) {
    $insManuErrs = array("ERRORS >>: <br>");

    // Turn autocommit off
    //mysqli_autocommit($conn, FALSE);

    $manu_id = $_POST['manu_id'];

    $book_explode = explode(' # ', $_POST['book_title']);
    $book_id = $book_explode[0]; // multi


    //********** Insert into Manuscriptions_Copiers Queries **********/
    $cop_id1_explode = explode(' # ', $_POST['full_name1']);
    $cop_id1 = $cop_id1_explode[0]; // multi
    $insertCopQry1 = "INSERT INTO h_manuscripts_copiers Values('$manu_id','$cop_id1')";

    if (isset($_POST['full_name2']) and $_POST['full_name2'] !== "") {
        $cop_id2_explode = explode(' # ', $_POST['full_name2']);
        $cop_id2 = $cop_id2_explode[0]; // multi
        $insertCopQry2 = "INSERT INTO h_manuscripts_copiers Values('$manu_id','$cop_id2')";
    } else $insertCopQry2 = "SELECT 1";

    if (isset($_POST['full_name3']) and $_POST['full_name3'] !== "") {
        $cop_id3_explode = explode(' # ', $_POST['full_name3']);
        $cop_id3 = $cop_id3_explode[0]; // multi
        $insertCopQry3 = "INSERT INTO h_manuscripts_copiers Values('$manu_id','$cop_id3')";
    } else $insertCopQry3 = "SELECT 1";

    if (isset($_POST['full_name4']) and $_POST['full_name4'] !== "") {
        $cop_id4_explode = explode(' # ', $_POST['full_name4']);
        $cop_id4 = $cop_id4_explode[0]; // multi
        $insertCopQry4 = "INSERT INTO h_manuscripts_copiers Values('$manu_id','$cop_id4')";
    } else $insertCopQry4 = "SELECT 1";

    //********** Insert into Manuscriptions **********/
    $cop_name = $_POST['cop_name'];
    if (isset($_POST['cop_day'])) $cop_day = $_POST['cop_day'];
    else $cop_day = "";

    if (isset($_POST['cop_month'])) $cop_month = $_POST['cop_month'];
    else $cop_month = "";

    if (isset($_POST['cop_syear'])) $cop_syear = $_POST['cop_syear'];
    else $cop_syear = "";

    if (isset($_POST['cop_eyear'])) $cop_eyear = $_POST['cop_eyear'];
    else $cop_eyear = $cop_syear;

    if (isset($_POST['cop_place'])) $cop_place = $_POST['cop_place'];
    else $cop_place = "";

    if (isset($_POST['cop_city'])) $cop_city = $_POST['cop_city'];
    else $cop_city = "";

    if (isset($_POST['cop_country'])) $cop_country = $_POST['cop_country'];
    else $cop_country = "";

    if (isset($_POST['signing'])) $signing = $_POST['signing'];
    else $signing = "";

    if (isset($_POST['cabinet_name'])) $cabinet_name = $_POST['cabinet_name'];
    else $cabinet_name = "";

    if (isset($_POST['cabinet_nbr'])) $cabinet_nbr = $_POST['cabinet_nbr'];
    else $cabinet_nbr = "";

    if (isset($_POST['manu_type'])) $manu_type = $_POST['manu_type'];
    else $manu_type = "";

    if (isset($_POST['index_nbr'])) $index_nbr = $_POST['index_nbr'];
    else $index_nbr = "";

    if (isset($_POST['font'])) $font = $_POST['font'];
    else $font = "";

    if (isset($_POST['font_style'])) $font_style = $_POST['font_style'];
    else $font_style = "";

    if (isset($_POST['regular_lines'])) $regular_lines = $_POST['regular_lines'];
    else $regular_lines = "";

    if (isset($_POST['lines_notes'])) $lines_notes = $_POST['lines_notes'];
    else $lines_notes = "";

    if (isset($_POST['paper_size'])) $paper_size = $_POST['paper_size'];
    else $paper_size = "";

    if (isset($_POST['motifs'])) {
        $motifs = $_POST['motifs']; /// array
        $motifsList = "";
        foreach ($motifs as $motif) {
            $motifsList .= $motif . ",";
        }
    } else {
        $motifsList = "";
    }

    if (isset($_POST['ink_colors'])) {
        $ink_colors = $_POST['ink_colors']; // array
        $inksList = "";
        foreach ($ink_colors as $ink) {
            $inksList .= $ink . ",";
        }
    } else {
        $inksList = "";
    }

    if (isset($_POST['manu_types'])) {
        $manu_types = $_POST['manu_types']; // array
        $manuTypesList = "";
        foreach ($manu_types as $manu) {
            $manuTypesList .= $manu . ",";
        }
    } else {
        $manuTypesList = "";
    }

    if (isset($_POST['manu_level'])) $manu_level = $_POST['manu_level'];
    else $manu_level = "";

    $copied_from = $_POST['copied_from'];
    $copied_to = $_POST['copied_to'];

    if (isset($_POST['cop_level'])) $cop_level = $_POST['cop_level']; //multi
    else $cop_level = "";

    if (isset($_POST['rost_completion'])) $rost_completion = $_POST['rost_completion']; //multi
    else $rost_completion = "";

    $notes = $_POST['notes'];
    $creation_date = $date;
    $last_edit_date = $date;

    $insertManuQry = "INSERT INTO e_manuscripts values('$manu_id','$book_id','$cop_name','$cop_day','$cop_month','$cop_syear','$cop_eyear','$cop_place','$cop_city','$cop_country','$signing','$cabinet_name','$cabinet_nbr','$manu_type','$index_nbr','$font','$font_style','$regular_lines','$lines_notes','$paper_size','$inksList','$motifsList','$manuTypesList','$copied_from','$copied_to','$manu_level','$cop_level','$rost_completion','$notes','$creation_date','$last_edit_date')";

    //********** Insert into i_cop_fm Queries **********/
    if (isset($_POST['cop_fm1']) and isset($_POST['cop_match1']) and $_POST['cop_fm1'] !== "" and $_POST['cop_match1'] !== "") {
        $cop_match1 = $_POST['cop_match1'];
        $cop_fm1_explode = explode(' # ', $_POST['cop_fm1']);
        $cop_fm1 = $cop_fm1_explode[0]; // multi
        $insertCopFMQry1 = "INSERT INTO i_cop_fm VALUES('$cop_match1','$cop_fm1','$manu_id')";
    } else $insertCopFMQry1 = "SELECT 1";

    if (isset($_POST['cop_fm2']) and isset($_POST['cop_match2']) and $_POST['cop_fm2'] !== "" and $_POST['cop_match2'] !== "") {
        $cop_match2 = $_POST['cop_match2'];
        $cop_fm2_explode = explode(' # ', $_POST['cop_fm2']);
        $cop_fm2 = $cop_fm2_explode[0]; // multi
        $insertCopFMQry2 = "INSERT INTO i_cop_fm VALUES('$cop_match2','$cop_fm2','$manu_id')";
    } else $insertCopFMQry2 = "SELECT 1";

    if (isset($_POST['cop_fm3']) and isset($_POST['cop_match3']) and $_POST['cop_fm3'] !== "" and $_POST['cop_match3'] !== "") {
        $cop_match3 = $_POST['cop_match3'];
        $cop_fm3_explode = explode(' # ', $_POST['cop_fm3']);
        $cop_fm3 = $cop_fm3_explode[0]; // multi
        $insertCopFMQry3 = "INSERT INTO i_cop_fm VALUES('$cop_match3','$cop_fm3','$manu_id')";
    } else $insertCopFMQry3 = "SELECT 1";

    if (isset($_POST['cop_fm4']) and isset($_POST['cop_match4']) and $_POST['cop_fm4'] !== "" and $_POST['cop_match4'] !== "") {
        $cop_match4 = $_POST['cop_match4'];
        $cop_fm4_explode = explode(' # ', $_POST['cop_fm4']);
        $cop_fm4 = $cop_fm4_explode[0]; // multi
        $insertCopFMQry4 = "INSERT INTO i_cop_fm VALUES('$cop_match4','$cop_fm4','$manu_id')";
    } else $insertCopFMQry4 = "SELECT 1";


    if (!mysqli_query($conn, $insertManuQry)) array_push($insManuErrs, "<br> e_manuscripts >> " . mysqli_error($conn));
    //echo "<br> e_manuscripts >> " . mysqli_error($conn);

    //********** Insert into Manuscriptions_Copiers **********/
    if (!mysqli_query($conn, $insertCopQry1)) array_push($insManuErrs, "<br> Manuscriptions_Copiers#1 >> " . mysqli_error($conn));
    //echo "<br> Manuscriptions_Copiers#1 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $insertCopQry2)) array_push($insManuErrs, "<br> Manuscriptions_Copiers#2 >> " . mysqli_error($conn));
    // echo "<br> Manuscriptions_Copiers#2 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $insertCopQry3)) array_push($insManuErrs, "<br> Manuscriptions_Copiers#3 >> " . mysqli_error($conn));
    //echo "<br> Manuscriptions_Copiers#3 >> " . mysqli_error($conn);
    if (!mysqli_query($conn, $insertCopQry4)) array_push($insManuErrs, "<br> Manuscriptions_Copiers#4 >> " . mysqli_error($conn));
    //echo "<br> Manuscriptions_Copiers#4 >> " . mysqli_error($conn);

    //********** Insert into i_cop_fm **********/
    if (!mysqli_query($conn, $insertCopFMQry1)) array_push($insManuErrs, "<br> i_cop_fm#1 >> " . mysqli_error($conn));
    if (!mysqli_query($conn, $insertCopFMQry2)) array_push($insManuErrs, "<br> i_cop_fm#2 >> " . mysqli_error($conn));
    if (!mysqli_query($conn, $insertCopFMQry3)) array_push($insManuErrs, "<br> i_cop_fm#3 >> " . mysqli_error($conn));
    if (!mysqli_query($conn, $insertCopFMQry4)) array_push($insManuErrs, "<br> i_cop_fm#4 >> " . mysqli_error($conn));



    if (count($insManuErrs) == 1) {
        echo "<script>alert('تم إضافة الاستمارة رقم: $manu_id بنجاح')</script>";
        echo '<script>window.location.href = "insertForm.php#insertForm"</script>';
    } else {
        echo "<script>alert('فشلت عملية إضافة الاستمارة')</script>";
        echo print_r($insManuErrs);
        echo '<script>window.location.href = "insertForm.php#insertForm"</script>';
    }

    // Commit transaction
    // if (!mysqli_commit($conn)) {
    //     echo "Commit transaction failed";
    //     exit();
    // } else {
    //     echo "manuscript added successfully";
    // }
}


?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Form</title>
</head>

<body class="my_bg">

    <!-- START row -->
    <div class="container-fluid">
        <div class="row">

            <?php include "sideBar.php" ?>

            <div class="col-10 my_mr_sidebar">
                <div class="tab-content" id="tabContent">
                    <!-- Insert Form -->
                    <div class="tab-pane fade mt-3" id="insertForm">

                        <div class="alert alert-primary text-center" role="alert">
                            <h4>إضافة استمارة</h4>
                        </div>
                        <form action="" method="post">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">معلومات الناسخ</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <label for="full_name">اسم الناسخ</label>
                                        <input list="copiers" class="form-control" name="full_name1" id="full_name"
                                            placeholder="أدخل اسم الناسخ 1" required>
                                        <datalist id="copiers">
                                            <?php
                                            for ($i = 0; $i <= $lastKey; $i++) { ?>
                                            <option
                                                value="<?php print_r($rows[$i]['cop_id']); ?> # <?php print_r($rows[$i]['full_name']); ?>">
                                                <?php  } ?>
                                        </datalist>
                                    </div>
                                    <!-- add input dinamically -->
                                    <div id="addCopier" class="form-group col-md-auto"
                                        style="cursor: pointer; margin-top: 37px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                                            <path
                                                d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                        </svg>
                                    </div>
                                    <!-- END add input dinamically -->
                                </div>
                            </fieldset>

                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">معلومات النسخة</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="manu_id">رقم الاستمارة</label>
                                        <input type="number" class="form-control" name="manu_id" id="manu_id"
                                            placeholder="أدخل رقم الاستمارة" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label for="cop_name">اسم الناسخ الوارد في النسخة</label>
                                        <input type="text" class="form-control" name="cop_name" id="cop_name"
                                            placeholder="أدخل اسم الناسخ كما ورد في النسخة">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label for="title">عنوان الكتاب</label>
                                        <input list="books" class="form-control" name="book_title" id="title"
                                            placeholder="أدخل عنوان الكتاب" required>
                                        <datalist id="books">
                                            <?php
                                            for ($i = 0; $i <= $lastBookKey; $i++) { ?>
                                            <option
                                                value="<?php print_r($rowsBooks[$i]['book_id']); ?> # <?php print_r($rowsBooks[$i]['book_title']); ?>">
                                                <?php  } ?>
                                        </datalist>
                                    </div>
                                </div>

                                <div class="form-row" id="cop_date">
                                    <div class="form-group col-md-2">
                                        <label for="cop_day">تاريخ النسخ</label>
                                        <select name="cop_day" id="cop_day" class="form-control">
                                            <option value="" disabled selected>-أدخل اليوم-</option>
                                            <?php for ($i = 0; $i <= 6; $i++) { ?>
                                            <option value="<?php echo $days[$i]; ?>"><?php echo $days[$i]; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="cop_month">&nbsp;</label>
                                        <select name="cop_month" id="cop_month" class="form-control">
                                            <option value="" disabled selected>-أدخل الشهر-</option>
                                            <?php for ($i = 0; $i <= 11; $i++) { ?>
                                            <option value="<?php echo $months[$i]; ?>"><?php echo $months[$i]; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="cop_syear">&nbsp;</label>
                                        <input type="number" class="form-control" name="cop_syear" id="cop_syear"
                                            placeholder="أدخل السنة">
                                    </div>
                                    <!-- add input dinamically -->
                                    <div id="replaceCopDate" class="form-group col-md-auto"
                                        style="cursor: pointer; margin-top: 37px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                            <path
                                                d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                            <path fill-rule="evenodd"
                                                d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                        </svg>
                                        غير معروف؟
                                    </div>
                                    <!-- END add input dinamically -->
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cop_place">مكان النسخ</label>
                                        <input type="text" class="form-control" name="cop_place" id="cop_place"
                                            placeholder="أدخل مكان النسخ">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="cop_city">المدينة</label>
                                        <input type="text" class="form-control" name="cop_city" id="cop_city"
                                            placeholder="أدخل المدينة">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="cop_country">البلد حاليا</label>
                                        <select name="cop_country" id="cop_country" class="form-control">
                                            <option value="" disabled selected>-اختر بلد-</option>
                                            <?php for ($i = 0; $i <= 6; $i++) { ?>
                                            <option value="<?php echo $countries[$i]; ?>"><?php echo $countries[$i]; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="signing">موقعة أو بالمقارنة</label>
                                        <select name="signing" id="signing" class="form-control">
                                            <option value="" disabled selected>-اختر نوع النسخة-</option>
                                            <option value="1">موقعة</option>
                                            <option value="0">بالمقارنة</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cabinet_name">اسم الخزانة</label>
                                        <select name="cabinet_name" id="cabinet_name" class="form-control">
                                            <option value="" disabled selected>-أدخل اسم الخزانة-</option>
                                            <?php for ($i = 0; $i <= 3; $i++) { ?>
                                            <option value="<?php echo $cabinet_names[$i]; ?>">
                                                <?php echo $cabinet_names[$i]; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-auto">
                                        <label for="cabinet_nbr">الرقم في الخزانة</label>
                                        <input type="number" class="form-control" name="cabinet_nbr" id="cabinet_nbr"
                                            placeholder="أدخل الرقم في الخزانة">
                                    </div>
                                    <div class="form-group col-md-auto">
                                        <label for="manu_type">نوع النسخة</label>
                                        <select name="manu_type" id="manu_type" class="form-control">
                                            <option value="" disabled selected>-أدخل نوع النسخة-</option>
                                            <option value="">مجلد</option>
                                            <option value="مص">مصحف</option>
                                            <option value="دغ">دون غلاف</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="index_nbr">الرقم في الفهرس</label>
                                        <input type="number" class="form-control" name="index_nbr" id="index_nbr"
                                            placeholder="أدخل الرقم في الفهرس">
                                    </div>
                                </div>

                                <h5 class="my_line"><span>تفاصيل النسخة</span></h5>

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="font">الخط</label>
                                        <select name="font" id="font" class="form-control">
                                            <option value="" disabled selected>- اختر خط -</option>
                                            <option value="مغربي">مغربي</option>
                                            <option value="مشرقي">مشرقي</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="font_style">نوع الخط</label>
                                        <select name="font_style" id="font_style" class="form-control">
                                            <option value="" disabled selected>- اختر نوع الخط -</option>
                                            <?php for ($i = 0; $i <= 5; $i++) { ?>
                                            <option value="<?php echo $w_font_styles[$i]; ?>">
                                                <?php echo $w_font_styles[$i]; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="regular_lines">نوع المسطرة</label>
                                        <select name="regular_lines" id="regular_lines" class="form-control">
                                            <option value="" disabled selected>- اختر نوع المسطرة -</option>
                                            <option value="1">منتظمة</option>
                                            <option value="0">غير منتظمة</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="lines_notes">ملاحظات على المسطرة</label>
                                        <input type="text" class="form-control" name="lines_notes" id="lines_notes"
                                            placeholder="أدخل ملاحظات المسطرة">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="paper_size">مقاس الورق</label>
                                        <select name="paper_size" id="paper_size" class="form-control">
                                            <option value="" disabled selected required>- اختر مقاس الورق -</option>
                                            <option value="1">القطع الكبير</option>
                                            <option value="2">القطع المتوسط</option>
                                            <option value="3">القطع الصغير</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-auto">
                                        <label for="motifs">الزخارف</label><br>
                                        <?php for ($i = 0; $i <= 5; $i++) { ?>
                                        <div class="form-check form-check-inline mt-2">
                                            <input class="form-check-input" type="checkbox" name="motifs[]"
                                                id="<?php echo $motifs[$i] ?>" value="<?php echo $motifs[$i] ?>">
                                            <label class="form-check-label"
                                                for="<?php echo $motifs[$i] ?>"><?php echo $motifs[$i] ?></label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-auto">
                                        <label for="ink_colors">ألوان الحبر</label><br>
                                        <?php for ($i = 0; $i <= 10; $i++) { ?>
                                        <div class="form-check form-check-inline mt-2">
                                            <input class="form-check-input" type="checkbox" name="ink_colors[]"
                                                id="<?php echo $ink_colors[$i] ?>"
                                                value="<?php echo $ink_colors[$i] ?>">
                                            <label class="form-check-label"
                                                for="<?php echo $ink_colors[$i] ?>"><?php echo $ink_colors[$i] ?></label>
                                            <?php ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <h5 class="my_line"><span>عمل الناسخ عدا نقل المحتوى</span></h5>

                                <div class="form-row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="manu_types[]"
                                            id="correction1" value="تصحيح">
                                        <label class="form-check-label" for="correction1">تصحيح</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="manu_types[]"
                                            id="correction2" value="تصويب">
                                        <label class="form-check-label" for="correction2">تصويب</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="manu_types[]"
                                            id="matching" value="مقابلة">
                                        <label class="form-check-label" for="matching">مقابلة</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="manu_types[]" id="comment"
                                            value="تعليق">
                                        <label class="form-check-label" for="comment">تعليق</label>
                                    </div>
                                </div>

                                <h5 class="my_line"><span>مستوى النسخة من حيث الجودة والضبط</span></h5>

                                <div class="form-row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="manu_level" id="excelent"
                                            value="جيد">
                                        <label class="form-check-label" for="excelent">جيد</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="manu_level" id="good"
                                            value="حسن">
                                        <label class="form-check-label" for="good">حسن</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="manu_level" id="moyenne"
                                            value="متوسط">
                                        <label class="form-check-label" for="moyenne">متوسط</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="manu_level" id="bad"
                                            value="رديء">
                                        <label class="form-check-label" for="bad">رديء (مبتدئ)</label>
                                    </div>
                                </div>

                                <h5 class="my_line"><span>الملاحظات</span></h5>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="copied_from">الأصل المنسوخ منه</label>
                                        <input type="text" class="form-control" name="copied_from" id="copied_from"
                                            placeholder="أدخل الأصل المنسوخ منه">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="copied_to">المنسوخ له</label>
                                        <input type="text" class="form-control" name="copied_to" id="copied_to"
                                            placeholder="أدخل المنسوخ له بأوصافه">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="cop_match">رقم الناسخ (من الاستمارة أعلاه)</label>
                                        <input type="number" class="form-control" name="cop_match1" id="cop_match"
                                            placeholder="أدخل رقم الناسخ">
                                    </div>

                                    <div class="form-group col-md-7">
                                        <label for="cop_fm">تشابه خط الناسخ بغيره من الناسخين</label>
                                        <input list="copFontMatch" class="form-control" name="cop_fm1" id="cop_fm"
                                            placeholder="اختر الناسخ المشابه له في الخط 1">
                                        <datalist id="copFontMatch">
                                            <?php
                                            for ($i = 0; $i <= $lastKey; $i++) { ?>
                                            <option
                                                value="<?php print_r($rows[$i]['cop_id']); ?> # <?php print_r($rows[$i]['full_name']); ?>">
                                                <?php  } ?>
                                        </datalist>
                                    </div>

                                    <!-- add input dinamically -->
                                    <div id="addFontMatch" class="form-group col-md-auto"
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
                                    <div class="form-group col-md-3">
                                        <label for="cop_level">مستوى ضبط الناسخ</label>
                                        <select name="cop_level" id="cop_level" class="form-control">
                                            <option disabled selected value="">- اختر مستوى -</option>
                                            <option value="جيد">جيد</option>
                                            <option value="جيد">حسن</option>
                                            <option value="جيد">متوسط</option>
                                            <option value="جيد">رديء</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="rost_completion">ترميم وإتمام</label>
                                        <select name="rost_completion" id="rost_completion" class="form-control">
                                            <option value="" disabled selected>- اختر خيار -</option>
                                            <option value="1">نعم</option>
                                            <option value="0">لا</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <label for="notes">ملاحظات أخرى</label> <textarea class="form-control"
                                            name="notes" id="notes" rows="3" placeholder="أدخل ملاحظات أخرى"></textarea>
                                    </div>
                                </div>
                    </div>
                    </fieldset>
                    <div class="form-row justify-content-end">
                        <div class="form-group col-md-2">
                            <button type="submit" name="insertForm"
                                class="btn btn-success btn-block btn-lg rounded-pill">إضافة</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

<script src="js/main.js?<?php echo time() ?>"></script>
<script>
scrollTop();
storeSelectedTab();
</script>

</html>