<?php
include 'header.php';
include 'lists.php';

// Select last (manu_id)
$lastManuIdQry = "SELECT max(manu_id) FROM `e_manuscripts`";
$lastManuIdResult = mysqli_query($conn, $lastManuIdQry);
$rowManuId = mysqli_fetch_row($lastManuIdResult);
$lastManuIdKey = $rowManuId[0];


//insert form
if (isset($_POST['insertForm'])) {
    $insManuErrs = array("ERRORS >>: <br>");

    $manu_id = $_POST['manu_id'];

    $book_explode = explode(' # ', $_POST['book_title']);
    $book_id = $book_explode[0]; // multi


    //********** Insert into Manuscriptions_Copiers Queries **********/
    $cop_id1_explode = explode(' # ', $_POST['full_name1']);
    $cop_id1 = $cop_id1_explode[0]; // multi
    $name_in_manu1 = $_POST['name_in_manu1'];
    $insertCopQry1 = "INSERT INTO h_manuscripts_copiers Values($manu_id, $cop_id1, '$name_in_manu1')";

    if (isset($_POST['full_name2']) and $_POST['full_name2'] !== "" and $_POST['name_in_manu2'] != "") {
        $cop_id2_explode = explode(' # ', $_POST['full_name2']);
        $cop_id2 = $cop_id2_explode[0]; // multi
        $name_in_manu2 = $_POST['name_in_manu2'];
        $insertCopQry2 = "INSERT INTO h_manuscripts_copiers Values($manu_id, $cop_id2, '$name_in_manu2')";
    } else $insertCopQry2 = "SELECT 1";

    if (isset($_POST['full_name3']) and $_POST['full_name3'] !== "" and $_POST['name_in_manu3'] != "") {
        $cop_id3_explode = explode(' # ', $_POST['full_name3']);
        $cop_id3 = $cop_id3_explode[0]; // multi
        $name_in_manu3 = $_POST['name_in_manu3'];
        $insertCopQry3 = "INSERT INTO h_manuscripts_copiers Values($manu_id, $cop_id3, '$name_in_manu3')";
    } else $insertCopQry3 = "SELECT 1";

    if (isset($_POST['full_name4']) and $_POST['full_name4'] !== "" and $_POST['name_in_manu4'] != "") {
        $cop_id4_explode = explode(' # ', $_POST['full_name4']);
        $cop_id4 = $cop_id4_explode[0]; // multi
        $name_in_manu4 = $_POST['name_in_manu4'];
        $insertCopQry4 = "INSERT INTO h_manuscripts_copiers Values($manu_id, $cop_id4, '$name_in_manu4')";
    } else $insertCopQry4 = "SELECT 1";



    //********** Insert into Manuscriptions **********/
    //higri date
    if ($_POST['cop_syear_range'] != NULL and $_POST['cop_eyear_range'] != NULL) {
        //==> range
        $cop_day = "";
        $cop_day_nbr = "NULL";
        $cop_month = "";
        $cop_syear = $_POST['cop_syear_range'];
        $cop_eyear = $_POST['cop_eyear_range'];
    } else {
        // Exact date
        $cop_day = $_POST['cop_day'];

        if ($_POST['cop_day_nbr'] != "") $cop_day_nbr = $_POST['cop_day_nbr'];
        else $cop_day_nbr = "NULL";

        $cop_month = $_POST['cop_month'];

        if ($_POST['cop_syear'] != NULL) {
            $cop_syear = $_POST['cop_syear'];
            $cop_eyear = $cop_syear;
        } else {
            $cop_syear = "NULL";
            $cop_eyear = $cop_syear;
        }
    }

    //miladi date
    if ($_POST['cop_syear_range_m'] != NULL and $_POST['cop_eyear_range_m'] != NULL) {
        //==> range
        $cop_day_m = "";
        $cop_day_nbr_m = "NULL";
        $cop_month_m = "";
        $cop_syear_m = $_POST['cop_syear_range_m'];
        $cop_eyear_m = $_POST['cop_eyear_range_m'];
    } else {
        // Exact date
        $cop_day_m = $_POST['cop_day_m'];

        if ($_POST['cop_day_nbr_m'] != "") $cop_day_nbr_m = $_POST['cop_day_nbr_m'];
        else $cop_day_nbr_m = "NULL";

        $cop_month_m = $_POST['cop_month_m'];

        if ($_POST['cop_syear_m'] != NULL) {
            $cop_syear_m = $_POST['cop_syear_m'];
            $cop_eyear_m = $cop_syear_m;
        } else {
            $cop_syear_m = "NULL";
            $cop_eyear_m = $cop_syear_m;
        }
    }


    if (isset($_POST['cop_place'])) $cop_place = $_POST['cop_place'];
    else $cop_place = "";

    if (isset($_POST['signing']) and $_POST['signing'] != "") $signing = $_POST['signing'];
    else $signing = "NULL";

    if (isset($_POST['cabinet_name']) and $_POST['cabinet_name'] != "") {
        $cabinet_id_explode = explode(' # ', $_POST['cabinet_name']);
        $cabinet_id = $cabinet_id_explode[0]; // multi
    } else $cabinet_id = "NULL";

    if (isset($_POST['cabinet_nbr']) and $_POST['cabinet_nbr'] != "") $cabinet_nbr = $_POST['cabinet_nbr'];
    else $cabinet_nbr = "NULL";

    if (isset($_POST['manu_type'])) $manu_type = $_POST['manu_type'];
    else $manu_type = "";

    if (isset($_POST['index_nbr']) and $_POST['index_nbr'] != "") $index_nbr = $_POST['index_nbr'];
    else $index_nbr = "NULL";

    if (isset($_POST['font'])) $font = $_POST['font'];
    else $font = "";

    if (isset($_POST['font_style'])) $font_style = $_POST['font_style'];
    else $font_style = "";

    if (isset($_POST['regular_lines']) and $_POST['regular_lines'] != "") $regular_lines = $_POST['regular_lines'];
    else $regular_lines = "NULL";

    if (isset($_POST['lines_notes'])) $lines_notes = $_POST['lines_notes'];
    else $lines_notes = "";

    if (isset($_POST['paper_size']) and $_POST['paper_size'] != "") $paper_size = $_POST['paper_size'];
    else $paper_size = "NULL";


    if (isset($_POST['manu_level'])) $manu_level = $_POST['manu_level'];
    else $manu_level = "";

    $copied_from = $_POST['copied_from'];
    $copied_to = $_POST['copied_to'];

    if (isset($_POST['cop_level'])) $cop_level = $_POST['cop_level']; //multi
    else $cop_level = "";

    if (isset($_POST['rost_completion']) and $_POST['rost_completion'] != "") $rost_completion = $_POST['rost_completion']; //multi
    else $rost_completion = "NULL";

    if (isset($_POST['count_name']) and $_POST['count_name'] != "") {
        $count_id_explode = explode(' # ', $_POST['count_name']);
        $count_id = $count_id_explode[0]; // multi
    } else $count_id = "NULL";

    if (isset($_POST['city_name']) and $_POST['city_name'] != "") {
        $city_id_explode = explode(' # ', $_POST['city_name']);
        $city_id = $city_id_explode[0]; // multi
    } else $city_id = "NULL";

    $notes = $_POST['notes'];
    $creation_date = $date;
    $last_edit_date = $date;

    $insertManuQry = "INSERT INTO e_manuscripts values('$manu_id', '$book_id', '$cop_day', $cop_day_nbr, '$cop_month', $cop_syear, $cop_eyear, '$cop_day_m', $cop_day_nbr_m, '$cop_month_m', $cop_syear_m, $cop_eyear_m, '$cop_place', $signing, $cabinet_id, $cabinet_nbr,'$manu_type', $index_nbr, '$font', '$font_style', $regular_lines, '$lines_notes', $paper_size, '$copied_from', '$copied_to', '$manu_level', '$cop_level', $rost_completion, $count_id, $city_id, '$notes','$creation_date','$last_edit_date')";

    //********** Insert into j_manuscripts_motifs **********/
    if (isset($_POST['motif1']) and $_POST['motif1'] != "") {
        $motif_id1_explode = explode(' # ', $_POST['motif1']);
        $motif_id1 = $motif_id1_explode[0]; // multi
        $insertMotifQry1 = "INSERT INTO j_manuscripts_motifs VALUES($manu_id, $motif_id1)";
    } else $insertMotifQry1 = "SELECT 1";

    if (isset($_POST['motif2']) and $_POST['motif2'] != "") {
        $motif_id2_explode = explode(' # ', $_POST['motif2']);
        $motif_id2 = $motif_id2_explode[0]; // multi
        $insertMotifQry2 = "INSERT INTO j_manuscripts_motifs VALUES($manu_id, $motif_id2)";
    } else $insertMotifQry2 = "SELECT 1";

    if (isset($_POST['motif3']) and $_POST['motif3'] != "") {
        $motif_id3_explode = explode(' # ', $_POST['motif3']);
        $motif_id3 = $motif_id3_explode[0]; // multi
        $insertMotifQry3 = "INSERT INTO j_manuscripts_motifs VALUES($manu_id, $motif_id3)";
    } else $insertMotifQry3 = "SELECT 1";

    if (isset($_POST['motif4']) and $_POST['motif4'] != "") {
        $motif_id4_explode = explode(' # ', $_POST['motif4']);
        $motif_id4 = $motif_id4_explode[0]; // multi
        $insertMotifQry4 = "INSERT INTO j_manuscripts_motifs VALUES($manu_id, $motif_id4)";
    } else $insertMotifQry4 = "SELECT 1";


    //********** Insert into j_manuscripts_colors **********/
    if (isset($_POST['inkColor1']) and $_POST['inkColor1'] != "") {
        $color_id1_explode = explode(' # ', $_POST['inkColor1']);
        $color_id1 = $color_id1_explode[0]; // multi
        $insertInkColorQry1 = "INSERT INTO j_manuscripts_colors VALUES($manu_id, $color_id1)";
    } else $insertInkColorQry1 = "SELECT 1";

    if (isset($_POST['inkColor2']) and $_POST['inkColor2'] != "") {
        $color_id2_explode = explode(' # ', $_POST['inkColor2']);
        $color_id2 = $color_id2_explode[0]; // multi
        $insertInkColorQry2 = "INSERT INTO j_manuscripts_colors VALUES($manu_id, $color_id2)";
    } else $insertInkColorQry2 = "SELECT 1";

    if (isset($_POST['inkColor3']) and $_POST['inkColor3'] != "") {
        $color_id3_explode = explode(' # ', $_POST['inkColor3']);
        $color_id3 = $color_id3_explode[0]; // multi
        $insertInkColorQry3 = "INSERT INTO j_manuscripts_colors VALUES($manu_id, $color_id3)";
    } else $insertInkColorQry3 = "SELECT 1";

    if (isset($_POST['inkColor4']) and $_POST['inkColor4'] != "") {
        $color_id4_explode = explode(' # ', $_POST['inkColor4']);
        $color_id4 = $color_id4_explode[0]; // multi
        $insertInkColorQry4 = "INSERT INTO j_manuscripts_colors VALUES($manu_id, $color_id4)";
    } else $insertInkColorQry4 = "SELECT 1";


    //********** Insert into j_manuscripts_manuTypes **********/
    if (isset($_POST['manu_types1']) and $_POST['manu_types1'] != "") {
        $type_id1_explode = explode(' # ', $_POST['manu_types1']);
        $type_id1 = $type_id1_explode[0]; // multi
        $insertManuTypeQry1 = "INSERT INTO j_manuscripts_manuTypes VALUES($manu_id, $type_id1)";
    } else $insertManuTypeQry1 = "SELECT 1";

    if (isset($_POST['manu_types2']) and $_POST['manu_types2'] != "") {
        $type_id2_explode = explode(' # ', $_POST['manu_types2']);
        $type_id2 = $type_id2_explode[0]; // multi
        $insertManuTypeQry2 = "INSERT INTO j_manuscripts_manuTypes VALUES($manu_id, $type_id2)";
    } else $insertManuTypeQry2 = "SELECT 1";

    if (isset($_POST['manu_types3']) and $_POST['manu_types3'] != "") {
        $type_id3_explode = explode(' # ', $_POST['manu_types3']);
        $type_id3 = $type_id3_explode[0]; // multi
        $insertManuTypeQry3 = "INSERT INTO j_manuscripts_manuTypes VALUES($manu_id, $type_id3)";
    } else $insertManuTypeQry3 = "SELECT 1";

    if (isset($_POST['manu_types4']) and $_POST['manu_types4'] != "") {
        $type_id4_explode = explode(' # ', $_POST['manu_types4']);
        $type_id4 = $type_id4_explode[0]; // multi
        $insertManuTypeQry4 = "INSERT INTO j_manuscripts_manuTypes VALUES($manu_id, $type_id4)";
    } else $insertManuTypeQry4 = "SELECT 1";


    //********** Insert into i_cop_fm Queries **********/
    if (isset($_POST['cop_fm1']) and isset($_POST['cop_match1']) and $_POST['cop_fm1'] != "" and $_POST['cop_match1'] != "") {
        $cop_match1 = $_POST['cop_match1'];
        $cop_fm1_explode = explode(' # ', $_POST['cop_fm1']);
        $cop_fm1 = $cop_fm1_explode[0]; // multi
        //$insertCopFMQry1 = "INSERT INTO i_cop_fm VALUES('$cop_match1','$cop_fm1','$manu_id')";
        $insertCopFMQry1 = "INSERT INTO i_cop_fm(cop_id, cop_fm, manu_id)
        SELECT $cop_match1, $cop_fm1, $manu_id
        FROM i_cop_fm
        WHERE EXISTS (SELECT 1 FROM h_manuscripts_copiers 
        WHERE (h_manuscripts_copiers.cop_id = $cop_match1 AND h_manuscripts_copiers.manu_id= $manu_id)) LIMIT 1";
    } else $insertCopFMQry1 = "SELECT 1";

    if (isset($_POST['cop_fm2']) and isset($_POST['cop_match2']) and $_POST['cop_fm2'] != "" and $_POST['cop_match2'] != "") {
        $cop_match2 = $_POST['cop_match2'];
        $cop_fm2_explode = explode(' # ', $_POST['cop_fm2']);
        $cop_fm2 = $cop_fm2_explode[0]; // multi
        //$insertCopFMQry2 = "INSERT INTO i_cop_fm VALUES('$cop_match2','$cop_fm2','$manu_id')";
        $insertCopFMQry2 = "INSERT INTO i_cop_fm(cop_id, cop_fm, manu_id)
        SELECT $cop_match2, $cop_fm2, $manu_id
        FROM i_cop_fm
        WHERE EXISTS (SELECT 1 FROM h_manuscripts_copiers 
        WHERE (h_manuscripts_copiers.cop_id = $cop_match2 AND h_manuscripts_copiers.manu_id= $manu_id)) LIMIT 1";
    } else $insertCopFMQry2 = "SELECT 1";

    if (isset($_POST['cop_fm3']) and isset($_POST['cop_match3']) and $_POST['cop_fm3'] != "" and $_POST['cop_match3'] != "") {
        $cop_match3 = $_POST['cop_match3'];
        $cop_fm3_explode = explode(' # ', $_POST['cop_fm3']);
        $cop_fm3 = $cop_fm3_explode[0]; // multi
        //$insertCopFMQry3 = "INSERT INTO i_cop_fm VALUES('$cop_match3','$cop_fm3','$manu_id')";
        $insertCopFMQry3 = "INSERT INTO i_cop_fm(cop_id, cop_fm, manu_id)
        SELECT $cop_match3, $cop_fm3, $manu_id
        FROM i_cop_fm
        WHERE EXISTS (SELECT 1 FROM h_manuscripts_copiers 
        WHERE (h_manuscripts_copiers.cop_id = $cop_match3 AND h_manuscripts_copiers.manu_id= $manu_id)) LIMIT 1";
    } else $insertCopFMQry3 = "SELECT 1";

    if (isset($_POST['cop_fm4']) and isset($_POST['cop_match4']) and $_POST['cop_fm4'] != "" and $_POST['cop_match4'] != "") {
        $cop_match4 = $_POST['cop_match4'];
        $cop_fm4_explode = explode(' # ', $_POST['cop_fm4']);
        $cop_fm4 = $cop_fm4_explode[0]; // multi
        //$insertCopFMQry4 = "INSERT INTO i_cop_fm VALUES('$cop_match4','$cop_fm4','$manu_id')";
        $insertCopFMQry4 = "INSERT INTO i_cop_fm(cop_id, cop_fm, manu_id)
        SELECT $cop_match4, $cop_fm4, $manu_id
        FROM i_cop_fm
        WHERE EXISTS (SELECT 1 FROM h_manuscripts_copiers 
        WHERE (h_manuscripts_copiers.cop_id = $cop_match4 AND h_manuscripts_copiers.manu_id= $manu_id)) LIMIT 1";
    } else $insertCopFMQry4 = "SELECT 1";

    //******** TEST ********/
    include 'test_insert-edit_form.php';
    //******** END TEST ********/

    /* Tell mysqli to throw an exception if an error occurs */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    /* Start transaction */
    mysqli_begin_transaction($conn);

    try {
        //********** Insert into e_manuscripts **********/
        $R = mysqli_query($conn, $insertManuQry);
        if ($R == false) array_push($insManuErrs, "<br> e_manuscripts >> " . mysqli_error($conn));

        //********** Insert into Manuscriptions_Copiers **********/
        $R1 = mysqli_query($conn, $insertCopQry1);
        $R2 = mysqli_query($conn, $insertCopQry2);
        $R3 = mysqli_query($conn, $insertCopQry3);
        $R4 = mysqli_query($conn, $insertCopQry4);

        if ($R1 == false) array_push($insManuErrs, "<br> Manuscriptions_Copiers#1 >> " . mysqli_error($conn));
        if ($R2 == false) array_push($insManuErrs, "<br> Manuscriptions_Copiers#2 >> " . mysqli_error($conn));
        if ($R3 == false) array_push($insManuErrs, "<br> Manuscriptions_Copiers#3 >> " . mysqli_error($conn));
        if ($R4 == false) array_push($insManuErrs, "<br> Manuscriptions_Copiers#4 >> " . mysqli_error($conn));

        //********** Insert into j_manuscripts_motifs **********/
        $R5 = mysqli_query($conn, $insertMotifQry1);
        $R6 = mysqli_query($conn, $insertMotifQry2);
        $R7 = mysqli_query($conn, $insertMotifQry3);
        $R8 = mysqli_query($conn, $insertMotifQry4);

        if ($R5 == false) array_push($insManuErrs, "<br> j_manuscripts_motifs#1 >> " . mysqli_error($conn));
        if ($R6 == false) array_push($insManuErrs, "<br> j_manuscripts_motifs#2 >> " . mysqli_error($conn));
        if ($R7 == false) array_push($insManuErrs, "<br> j_manuscripts_motifs#3 >> " . mysqli_error($conn));
        if ($R8 == false) array_push($insManuErrs, "<br> j_manuscripts_motifs#4 >> " . mysqli_error($conn));

        //********** Insert into j_manuscripts_colors **********/
        $R9 = mysqli_query($conn, $insertInkColorQry1);
        $R10 = mysqli_query($conn, $insertInkColorQry2);
        $R11 = mysqli_query($conn, $insertInkColorQry3);
        $R12 = mysqli_query($conn, $insertInkColorQry4);

        if ($R9 = false) array_push($insManuErrs, "<br> j_manuscripts_colors#1 >> " . mysqli_error($conn));
        if ($R10 = false) array_push($insManuErrs, "<br> j_manuscripts_colors#2 >> " . mysqli_error($conn));
        if ($R11 = false) array_push($insManuErrs, "<br> j_manuscripts_colors#3 >> " . mysqli_error($conn));
        if ($R12 = false) array_push($insManuErrs, "<br> j_manuscripts_colors#4 >> " . mysqli_error($conn));

        //********** Insert into j_manuscripts_manuTypes **********/
        $R13 = mysqli_query($conn, $insertManuTypeQry1);
        $R14 = mysqli_query($conn, $insertManuTypeQry2);
        $R15 = mysqli_query($conn, $insertManuTypeQry3);
        $R16 = mysqli_query($conn, $insertManuTypeQry4);

        if ($R13 = false) array_push($insManuErrs, "<br> j_manuscripts_manuTypes#1 >> " . mysqli_error($conn));
        if ($R14 = false) array_push($insManuErrs, "<br> j_manuscripts_manuTypes#2 >> " . mysqli_error($conn));
        if ($R15 = false) array_push($insManuErrs, "<br> j_manuscripts_manuTypes#3 >> " . mysqli_error($conn));
        if ($R16 = false) array_push($insManuErrs, "<br> j_manuscripts_manuTypes#4 >> " . mysqli_error($conn));

        //********** Insert into i_cop_fm **********/
        $R17 = mysqli_query($conn, $insertCopFMQry1);
        $R18 = mysqli_query($conn, $insertCopFMQry2);
        $R19 = mysqli_query($conn, $insertCopFMQry3);
        $R20 = mysqli_query($conn, $insertCopFMQry4);

        if ($R17 = false) array_push($insManuErrs, "<br> i_cop_fm#1 >> " . mysqli_error($conn));
        if ($R18 = false) array_push($insManuErrs, "<br> i_cop_fm#2 >> " . mysqli_error($conn));
        if ($R19 = false) array_push($insManuErrs, "<br> i_cop_fm#3 >> " . mysqli_error($conn));
        if ($R20 = false) array_push($insManuErrs, "<br> i_cop_fm#4 >> " . mysqli_error($conn));

        mysqli_commit($conn);
        echo "<script>alert('تم إضافة الاستمارة رقم: $manu_id بنجاح')</script>";
        echo '<script>window.location.href = "previewForm.php?manu_id=' . $manu_id . '"</script>';
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($conn);
        //throw $exception;
        echo "<script>alert('فشلت عملية إضافة الاستمارة')</script>";
        echo print_r($insManuErrs);
        echo '<script>window.location.href = "insertForm.php#insertForm"</script>';
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
    <div class="container-fluid mt-5 py-2">

        <?php include "sideBar.php" ?>

        <div class="col-10 my_mr_sidebar">
            <div class="tab-content" id="tabContent">
                <!-- Insert Form -->
                <div class="tab-pane fade mt-3" id="insertForm">

                    <div class="alert alert-info text-center" role="alert">
                        <h4>إضافة استمارة</h4>
                    </div>
                    <form action="" method="post">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">معلومات الناسخ</legend>
                            <div class="form-row mb-3">
                                <div class="form-group col-md-5">
                                    <label for="full_name">اسم الناسخ (من القائمة)</label>
                                    <input list="copiers" class="form-control" name="full_name1" id="full_name"
                                        placeholder="حدد اسم الناسخ 1" required>
                                    <datalist id="copiers">
                                        <?php
                                        for ($i = 0; $i <= $lastKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rows[$i]['cop_id']) ?> # <?php print_r($rows[$i]['full_name']) ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name_in_manu">اسم الناسخ الوارد في النسخة</label>
                                    <input type="text" class="form-control" name="name_in_manu1" id="name_in_manu"
                                        placeholder="أدخل اسم الناسخ 1 كما ورد في النسخة" required>
                                </div>
                                <!-- add input dinamically -->
                                <div id="addCopier" class="form-group col-md-auto"
                                    style="cursor: pointer; margin-top: 37px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                        class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                    </svg>
                                </div>
                                <!-- END add input dinamically -->
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="cop_match">رقم الناسخ</label>
                                    <input type="number" class="form-control text-center" name="cop_match1"
                                        id="cop_match" placeholder="أدخل رقم الناسخ">
                                </div>

                                <div class="form-group col-md-9">
                                    <label for="cop_fm">تشابه خط الناسخ بغيره من الناسخين</label>
                                    <input list="copFontMatch" class="form-control" name="cop_fm1" id="cop_fm"
                                        placeholder="حدد الناسخ المشابه له في الخط 1">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                        class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
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
                                <div class="form-group col-md-auto">
                                    <label for="manu_id">رقم الاستمارة</label>
                                    <input type="number" class="form-control text-center" name="manu_id"
                                        value="<?php echo $lastManuIdKey + 1; ?>" id="manu_id"
                                        placeholder="أدخل رقم الاستمارة" required>
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
                                            value="<?php print_r($rowsBooks[$i]['book_id']) ?> # <?php print_r($rowsBooks[$i]['book_title']) ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                            </div>

                            <div class="form-row" id="copDate_exact">
                                <div class="form-group col-md-2">
                                    <label for="cop_day">تاريخ النسخ</label>
                                    <select name="cop_day" id="cop_day" class="custom-select">
                                        <option value="" selected>-أدخل اليوم-</option>
                                        <?php for ($i = 0; $i <= 6; $i++) { ?>
                                        <option value="<?php echo $days[$i]; ?>"><?php echo $days[$i]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="cop_day_nbr">&nbsp;</label>
                                    <select name="cop_day_nbr" id="cop_day_nbr" class="custom-select">
                                        <option value="" selected>- أدخل اليوم -</option>
                                        <?php for ($i = 1; $i <= 31; $i++) { ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="cop_month">&nbsp;</label>
                                    <select name="cop_month" id="cop_month" class="custom-select">
                                        <option value="" selected>-أدخل الشهر-</option>
                                        <?php for ($i = 0; $i <= 11; $i++) { ?>
                                        <option value="<?php echo $months[$i] ?>"><?php echo $months[$i]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="cop_syear">&nbsp;</label>
                                    <input type="number" class="form-control" name="cop_syear" id="cop_syear"
                                        placeholder="أدخل السنة">
                                </div>
                                <div class="form-group col-md-2 mt-2">
                                    <label for="date_type">&nbsp;</label>
                                    <p>[هجري]</p>
                                </div>
                            </div>

                            <!-- START Miladi date -->
                            <div class="form-row" id="copDate_exact_m">
                                <div class="form-group col-md-2">
                                    <select name="cop_day_m" id="cop_day" class="custom-select">
                                        <option value="" selected>-أدخل اليوم-</option>
                                        <?php for ($i = 0; $i <= 6; $i++) { ?>
                                        <option value="<?php echo $days[$i]; ?>"><?php echo $days[$i]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select name="cop_day_nbr_m" id="cop_day_nbr" class="custom-select">
                                        <option value="" selected>- أدخل اليوم -</option>
                                        <?php for ($i = 1; $i <= 31; $i++) { ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select name="cop_month_m" id="cop_month" class="custom-select">
                                        <option value="" selected>-أدخل الشهر-</option>
                                        <?php for ($i = 0; $i <= 11; $i++) { ?>
                                        <option value="<?php echo $months_m[$i] ?>"><?php echo $months_m[$i]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="number" class="form-control" name="cop_syear_m" id="cop_syear"
                                        placeholder="أدخل السنة">
                                </div>
                                <div class="form-group col-md-2 mt-2">
                                    <p>[ميلادي]</p>
                                </div>
                            </div>
                            <!-- END miladi date -->


                            <div class="form-row" id="copDate_range">
                                <div class="form-group col-md-auto">
                                    <label for="cop_date">تاريخ النسخ [أدخل نطاق]</label>
                                    <input type="number" class="form-control" name="cop_syear_range" id="cop_date"
                                        placeholder="من سنة">
                                </div>
                                <div class="form-group col-md-auto">
                                    <label for="cop_date">&nbsp;</label>
                                    <input type="number" class="form-control" name="cop_eyear_range" id="cop_date"
                                        placeholder="إلى سنة">
                                </div>
                                <div class="form-group col-md-2 mt-2">
                                    <label for="date_type">&nbsp;</label>
                                    <p>[هجري]</p>
                                </div>
                            </div>

                            <!--miladi date range-->
                            <div class="form-row" id="copDate_range_m">
                                <div class="form-group col-md-auto">
                                    <input type="number" class="form-control" name="cop_syear_range_m" id="cop_date"
                                        placeholder="من سنة">
                                </div>
                                <div class="form-group col-md-auto">
                                    <input type="number" class="form-control" name="cop_eyear_range_m" id="cop_date"
                                        placeholder="إلى سنة">
                                </div>
                                <div class="form-group col-md-2 mt-2">
                                    <p>[ميلادي]</p>
                                </div>
                            </div>
                            <!--END miladi date range -->

                            <div class="mb-2">
                                <button type="button" class="btn btn-info rounded-pill" id="hide_Exact">تاريخ
                                    محدد</button>
                                <button type="button" class="btn btn-info rounded-pill" id="hide_range">فترة
                                    زمنية</button>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cop_place">مكان النسخ</label>
                                    <input type="text" class="form-control" name="cop_place" id="cop_place"
                                        placeholder="أدخل مكان النسخ">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="city_name">المدينة</label>
                                    <input list="cities" class="form-control" name="city_name" id="city_name"
                                        placeholder="حدد مدينة النسخ">
                                    <datalist id="cities">
                                        <?php
                                        for ($i = 0; $i <= $lastCityKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rowsCities[$i]['city_id']) ?> # <?php print_r($rowsCities[$i]['city_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="count_name">البلد حاليا</label>

                                    <input list="countries" class="form-control" name="count_name" id="count_name"
                                        placeholder="حدد بلد النسخ">
                                    <datalist id="countries">
                                        <?php
                                        for ($i = 0; $i <= $lastCountKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rowsCount[$i]['count_id']) ?> # <?php print_r($rowsCount[$i]['count_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="signing">موقعة أو بالمقارنة</label>
                                    <select name="signing" id="signing" class="custom-select">
                                        <option value="" selected>-اختر نوع النسخة-</option>
                                        <option value="1">موقعة</option>
                                        <option value="0">بالمقارنة</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <label for="cabinet_name">اسم الخزانة</label>
                                    <input list="cabinet_names" class="form-control" name="cabinet_name"
                                        id="cabinet_name" placeholder="حدد اسم الخزانة">
                                    <datalist id="cabinet_names">
                                        <?php
                                        for ($i = 0; $i <= $lastCabinetKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rowsCabinet[$i]['cabinet_id']) ?> # <?php print_r($rowsCabinet[$i]['cabinet_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>

                                <div class="form-group col-md-auto">
                                    <label for="cabinet_nbr">الرقم في الخزانة</label>
                                    <input type="number" class="form-control" name="cabinet_nbr" id="cabinet_nbr"
                                        placeholder="أدخل الرقم في الخزانة">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="manu_type">نوع النسخة</label>
                                    <select name="manu_type" id="manu_type" class="custom-select">
                                        <option value="" selected>-اختر نوع النسخة-</option>
                                        <option value="مج">مجلد</option>
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
                                    <select name="font" id="font" class="custom-select">
                                        <option value="" selected>- اختر خط -</option>
                                        <option value="مغربي">مغربي</option>
                                        <option value="مشرقي">مشرقي</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="font_style">نوع الخط</label>
                                    <select name="font_style" id="font_style" class="custom-select">
                                        <option value="" selected>- اختر نوع الخط -</option>
                                        <?php for ($i = 0; $i <= 5; $i++) { ?>
                                        <option value="<?php echo $w_font_styles[$i]; ?>">
                                            <?php echo $w_font_styles[$i]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="regular_lines">نوع المسطرة</label>
                                    <select name="regular_lines" id="regular_lines" class="custom-select">
                                        <option value="" selected>- اختر نوع المسطرة -</option>
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
                                    <select name="paper_size" id="paper_size" class="custom-select">
                                        <option value="" selected>- اختر مقاس الورق -</option>
                                        <option value="1">القطع الكبير</option>
                                        <option value="2">القطع المتوسط</option>
                                        <option value="3">القطع الصغير</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div id="motifs_row" class="form-group col-md-auto">
                                    <label for="motif">نوع الزخارف</label>
                                    <input list="motifs" class="form-control" name="motif1" id="motif"
                                        placeholder="أدخل الزخرفة 1">
                                    <datalist id="motifs">
                                        <?php
                                        for ($i = 0; $i <= $lastMotifKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rowsMotif[$i]['motif_id']); ?> # <?php print_r($rowsMotif[$i]['motif_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                                <!-- add input dinamically -->
                                <div id="addMotif" class="form-group col-md-auto"
                                    style="cursor: pointer; margin-top: 37px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                        class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                    </svg>
                                </div>
                                <!-- END add input dinamically -->
                            </div>

                            <div class="form-row">
                                <div id="inkColors_row" class="form-group col-md-auto">
                                    <label for="inkColor">لون الحبر</label>
                                    <input list="inkColors" class="form-control" name="inkColor1" id="inkColor"
                                        placeholder="أدخل اللون 1">
                                    <datalist id="inkColors">
                                        <?php
                                        for ($i = 0; $i <= $lastColorKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rowsColor[$i]['color_id']); ?> # <?php print_r($rowsColor[$i]['color_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                                <!-- add input dinamically -->
                                <div id="addInkColor" class="form-group col-md-auto"
                                    style="cursor: pointer; margin-top: 37px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                        class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                    </svg>
                                </div>
                                <!-- END add input dinamically -->
                            </div>

                            <h5 class="my_line"><span>محتوى النسخة</span></h5>

                            <div class="form-row">
                                <div id="ManuTypes_row" class="form-group col-md-auto">
                                    <label for="manu_type">عمل الناسخ عدا نقل المحتوى</label>
                                    <input list="manu_types" class="form-control" name="manu_types1" id="manu_type"
                                        placeholder="أدخل العنصر 1">
                                    <datalist id="manu_types">
                                        <?php
                                        for ($i = 0; $i <= $lastManuTypeKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rowsManuType[$i]['type_id']); ?> # <?php print_r($rowsManuType[$i]['type_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                                <!-- add input dinamically -->
                                <div id="addManuTypes" class="form-group col-md-auto"
                                    style="cursor: pointer; margin-top: 37px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                        class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                    </svg>
                                </div>
                                <!-- END add input dinamically -->
                            </div>

                            <div class="form-row mt-3">
                                <div class="form-group col-md-4">
                                    <label for="cop_level">مستوى النسخة من حيث الجودة والضبط</label>
                                    <select name="cop_level" id="cop_level" class="custom-select">
                                        <option selected value="">- اختر مستوى -</option>
                                        <option value="جيد">جيد</option>
                                        <option value="حسن">حسن</option>
                                        <option value="متوسط">متوسط</option>
                                        <option value="رديء">رديء</option>
                                    </select>
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
                                <div class="form-group col-md-4">
                                    <label for="manu_level">مستوى النسخة من حيث الوضوح والرداءة</label>
                                    <select name="manu_level" id="manu_level" class="custom-select mt-2">
                                        <option selected value="">- اختر مستوى -</option>
                                        <option value="جيد">جبد</option>
                                        <option value="حسن">حسن</option>
                                        <option value="متوسط">متوسط</option>
                                        <option value="رديء">رديء</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="rost_completion">ترميم وإتمام</label>
                                    <select name="rost_completion" id="rost_completion" class="custom-select">
                                        <option value="" selected>- اختر خيار -</option>
                                        <option value="1">نعم</option>
                                        <option value="0">لا</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <label for="notes">ملاحظات أخرى</label> <textarea class="form-control" name="notes"
                                        id="notes" rows="3" placeholder="أدخل ملاحظات أخرى"></textarea>
                                </div>
                            </div>
                            <div class="form-row justify-content-end">
                                <div class="form-group col-md-2">
                                    <button type="submit" name="insertForm"
                                        class="btn btn-success btn-block btn-lg rounded-pill">إضافة</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="js/main.js"></script>
<script>
scrollTop();
storeSelectedTab();
</script>

</html>