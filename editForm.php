<?php
include 'header.php';
include 'lists.php';

// GET values from clientsList.php
$manu_id_get = $_GET['manu_id'];

// select manu book / country / city ...
$manuSubQry1 = "SELECT e_manuscripts.manu_id, e_manuscripts.book_id, book_title, 
cop_day, cop_day_nbr, cop_month, cop_syear, cop_eyear, date_type, cop_place,
signing, cabinets.cabinet_id, cabinet_name, cabinet_nbr, manu_type, index_nbr,
font, font_style, regular_lines, lines_notes, paper_size, 
copied_from, copied_to, manu_level, cop_level, rost_completion, e_manuscripts.city_id, city_name , e_manuscripts.count_id, count_name,
notes, e_manuscripts.creation_date, e_manuscripts.last_edit_date
FROM e_manuscripts
INNER JOIN a_books ON a_books.book_id = e_manuscripts.book_id
LEFT JOIN countries ON countries.count_id = e_manuscripts.count_id
LEFT JOIN cities ON cities.city_id = e_manuscripts.city_id 
LEFT JOIN cabinets ON cabinets.cabinet_id = e_manuscripts.cabinet_id
WHERE e_manuscripts.manu_id = '$manu_id_get'";

$manuSubQry1Result = mysqli_query($conn, $manuSubQry1);
while ($row = mysqli_fetch_array($manuSubQry1Result)) {
    $manu_id = $row['manu_id'];

    $book_id = $row['book_id'];
    $book_title = $row['book_title'];

    $cop_day = $row['cop_day'];
    $cop_day_nbr = $row['cop_day_nbr'];
    $cop_month = $row['cop_month'];
    $cop_syear = $row['cop_syear'];
    $cop_eyear = $row['cop_eyear'];
    $date_type = $row['date_type'];
    $cop_place = $row['cop_place'];

    $signing = $row['signing'];
    $cabinet_id = $row['cabinet_id'];
    $cabinet_name = $row['cabinet_name'];
    $cabinet_nbr = $row['cabinet_nbr'];
    $manu_type = $row['manu_type'];
    $index_nbr = $row['index_nbr'];
    $font = $row['font'];
    $font_style = $row['font_style'];

    $regular_lines = $row['regular_lines'];

    $lines_notes = $row['lines_notes'];

    $paper_size = $row['paper_size'];

    $copied_from = $row['copied_from'];
    $copied_to = $row['copied_to'];
    $manu_level = $row['manu_level'];
    $cop_level = $row['cop_level'];

    $rost_completion = $row['rost_completion'];

    $city_id = $row['city_id'];
    $city_name = $row['city_name'];
    $count_id = $row['count_id'];
    $count_name = $row['count_name'];
    $notes = $row['notes'];

    $creation_date = $row['creation_date'];
    $last_edit_date = $row['last_edit_date'];
}

// select all manu copiers
$manuSubQry2 = "SELECT d_copiers.cop_id, full_name, name_in_manu
FROM d_copiers
INNER JOIN h_manuscripts_copiers ON h_manuscripts_copiers.cop_id = d_copiers.cop_id
WHERE h_manuscripts_copiers.manu_id = '$manu_id_get'";

$manuSubQry2Result = mysqli_query($conn, $manuSubQry2);

// select all book authors
$manuSubQry3 = "SELECT c_authors.auth_id, auth_name
FROM c_authors
LEFT JOIN g_books_authors ON g_books_authors.auth_id = c_authors.auth_id
WHERE book_id = '$book_id'";

$manuSubQry3Result = mysqli_query($conn, $manuSubQry3);

// select all book subjects
$manuSubQry4 = "SELECT b_subjects.subj_id, subj_name
FROM b_subjects
LEFT JOIN f_books_subjects ON f_books_subjects.subj_id = b_subjects.subj_id
WHERE book_id = '$book_id'";

$manuSubQry4Result = mysqli_query($conn, $manuSubQry4);

// select all copiers fm
$manuSubQry5 = "SELECT i_cop_fm.cop_id, cop_fm, full_name
FROM i_cop_fm
INNER JOIN d_copiers ON i_cop_fm.cop_fm = d_copiers.cop_id
WHERE manu_id = $manu_id_get";

$manuSubQry5Result = mysqli_query($conn, $manuSubQry5);

// select manu motifs
$manuSubQry6 = "SELECT j_manuscripts_motifs.motif_id, motif_name
FROM e_manuscripts
INNER JOIN j_manuscripts_motifs ON e_manuscripts.manu_id = j_manuscripts_motifs.manu_id
INNER JOIN d_motifs ON j_manuscripts_motifs.motif_id = d_motifs.motif_id
WHERE e_manuscripts.manu_id = '$manu_id_get'";
$manuSubQry6Result = mysqli_query($conn, $manuSubQry6);

// select manu colors
$manuSubQry7 = "SELECT j_manuscripts_colors.color_id, color_name
FROM e_manuscripts
INNER JOIN j_manuscripts_colors ON e_manuscripts.manu_id = j_manuscripts_colors.manu_id
INNER JOIN d_colors ON j_manuscripts_colors.color_id = d_colors.color_id
WHERE e_manuscripts.manu_id = '$manu_id_get'";
$manuSubQry7Result = mysqli_query($conn, $manuSubQry7);


// select manu Types
$manuSubQry8 = "SELECT j_manuscripts_manuTypes.type_id, type_name
FROM e_manuscripts
INNER JOIN j_manuscripts_manuTypes ON e_manuscripts.manu_id = j_manuscripts_manuTypes.manu_id
INNER JOIN d_manuTypes ON j_manuscripts_manuTypes.type_id = d_manuTypes.type_id
WHERE e_manuscripts.manu_id = '$manu_id_get'";
$manuSubQry8Result = mysqli_query($conn, $manuSubQry8);


// Edit form
if (isset($_POST['editForm'])) {
    $editManuErrs = array("ERRORS >>: <br>");
    $manu_id = $_POST['manu_id'];
    $prev_manu_id = $manu_id_get;

    $book_explode = explode(' # ', $_POST['book_title']);
    $book_id = $book_explode[0]; // multi


    //********** Insert into Manuscriptions_Copiers Queries **********/
    $cop_id1_explode = explode(' # ', $_POST['full_name1']);
    $cop_id1 = $cop_id1_explode[0]; // multi
    $name_in_manu1 = $_POST['name_in_manu1'];
    $editCopQry1 = "INSERT INTO h_manuscripts_copiers(manu_id, cop_id, name_in_manu) VALUES('$manu_id', '$cop_id1', '$name_in_manu1') ON DUPLICATE KEY UPDATE cop_id = '$cop_id1', name_in_manu= '$name_in_manu1'";

    if (isset($_POST['full_name2']) and $_POST['full_name2'] != "" and $_POST['name_in_manu2'] != "") {
        $cop_id2_explode = explode(' # ', $_POST['full_name2']);
        $cop_id2 = $cop_id2_explode[0]; // multi
        $name_in_manu2 = $_POST['name_in_manu2'];
        $editCopQry2 = "INSERT INTO h_manuscripts_copiers(manu_id, cop_id, name_in_manu) VALUES('$manu_id', '$cop_id2', '$name_in_manu2') ON DUPLICATE KEY UPDATE cop_id = '$cop_id2', name_in_manu= '$name_in_manu2'";
    } else $editCopQry2 = "SELECT 1";

    if (isset($_POST['full_name3']) and $_POST['full_name3'] != "" and $_POST['name_in_manu3'] != "") {
        $cop_id3_explode = explode(' # ', $_POST['full_name3']);
        $cop_id3 = $cop_id3_explode[0]; // multi
        $name_in_manu3 = $_POST['name_in_manu3'];
        $editCopQry3 = "INSERT INTO h_manuscripts_copiers(manu_id, cop_id, name_in_manu) VALUES('$manu_id', '$cop_id3', '$name_in_manu3') ON DUPLICATE KEY UPDATE cop_id = '$cop_id3', name_in_manu= '$name_in_manu3'";
    } else $editCopQry3 = "SELECT 1";

    if (isset($_POST['full_name4']) and $_POST['full_name4'] != "" and $_POST['name_in_manu4'] != "") {
        $cop_id4_explode = explode(' # ', $_POST['full_name4']);
        $cop_id4 = $cop_id4_explode[0]; // multi
        $name_in_manu4 = $_POST['name_in_manu4'];
        $editCopQry4 = "INSERT INTO h_manuscripts_copiers(manu_id, cop_id, name_in_manu) VALUES('$manu_id', '$cop_id4', '$name_in_manu4') ON DUPLICATE KEY UPDATE cop_id = '$cop_id4', name_in_manu= '$name_in_manu4'";
    } else $editCopQry4 = "SELECT 1";

    //********** Insert into Manuscriptions **********/
    if (isset($_POST['cop_day'])) $cop_day = $_POST['cop_day'];
    else $cop_day = "";

    if (isset($_POST['cop_day_nbr']) and $_POST['cop_day_nbr'] != NULL) $cop_day_nbr = $_POST['cop_day_nbr'];
    else $cop_day_nbr = "NULL";

    if (isset($_POST['cop_month'])) $cop_month = $_POST['cop_month'];
    else $cop_month = "";

    if (isset($_POST['cop_eyear']) and $_POST['cop_eyear'] != NULL) $cop_eyear = $_POST['cop_eyear'];
    else $cop_eyear = "NULL";

    if (isset($_POST['cop_syear']) and $_POST['cop_syear'] != NULL) {
        $cop_syear = $_POST['cop_syear'];
        if (!isset($_POST['cop_eyear'])) $cop_eyear = $cop_syear;
    } else $cop_syear = "NULL";

    if (isset($_POST['date_type']) and $_POST['date_type'] != NULL) $date_type = $_POST['date_type'];

    //set null value to date_type if date not added
    if ((!isset($_POST['cop_eyear']) and $_POST['cop_syear'] == NULL and $_POST['cop_month'] == NULL  and $_POST['cop_day'] == NULL)
        or (isset($_POST['cop_eyear'])  and $_POST['cop_eyear'] == NULL and $_POST['cop_syear'] == NULL)
    ) {
        $date_type = "NULL";
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

    $editManuQry = "UPDATE e_manuscripts SET manu_id= '$manu_id', book_id= '$book_id', cop_day= '$cop_day', cop_day_nbr= $cop_day_nbr, cop_month= '$cop_month', cop_syear= $cop_syear, cop_eyear= $cop_eyear, date_type= $date_type, cop_place= '$cop_place', signing=  $signing, cabinet_id= $cabinet_id, cabinet_nbr= $cabinet_nbr, manu_type= '$manu_type', index_nbr= $index_nbr, font= '$font', font_style= '$font_style', regular_lines= $regular_lines, lines_notes= '$lines_notes', paper_size= $paper_size, copied_from= '$copied_from', copied_to= '$copied_to', manu_level= '$manu_level', cop_level= '$cop_level', rost_completion= $rost_completion, count_id= $count_id, city_id= $city_id, notes= '$notes', last_edit_date= '$last_edit_date' WHERE manu_id= $prev_manu_id";


    //********** Insert into j_manuscripts_motifs **********/
    if (isset($_POST['motif1']) and $_POST['motif1'] != "") {
        $motif_id1_explode = explode(' # ', $_POST['motif1']);
        $motif_id1 = $motif_id1_explode[0]; // multi
        $insertMotifQry1 = "INSERT INTO j_manuscripts_motifs VALUES($manu_id, $motif_id1) ON DUPLICATE KEY UPDATE manu_id = '$manu_id', motif_id= '$motif_id1'";
    } else $insertMotifQry1 = "SELECT 1";

    if (isset($_POST['motif2']) and $_POST['motif2'] != "") {
        $motif_id2_explode = explode(' # ', $_POST['motif2']);
        $motif_id2 = $motif_id2_explode[0]; // multi
        $insertMotifQry2 = "INSERT INTO j_manuscripts_motifs VALUES($manu_id, $motif_id2) ON DUPLICATE KEY UPDATE manu_id = '$manu_id', motif_id= '$motif_id2'";
    } else $insertMotifQry2 = "SELECT 1";

    if (isset($_POST['motif3']) and $_POST['motif3'] != "") {
        $motif_id3_explode = explode(' # ', $_POST['motif3']);
        $motif_id3 = $motif_id3_explode[0]; // multi
        $insertMotifQry3 = "INSERT INTO j_manuscripts_motifs VALUES($manu_id, $motif_id3) ON DUPLICATE KEY UPDATE manu_id = '$manu_id', motif_id= '$motif_id3'";
    } else $insertMotifQry3 = "SELECT 1";

    if (isset($_POST['motif4']) and $_POST['motif4'] != "") {
        $motif_id4_explode = explode(' # ', $_POST['motif4']);
        $motif_id4 = $motif_id4_explode[0]; // multi
        $insertMotifQry4 = "INSERT INTO j_manuscripts_motifs VALUES($manu_id, $motif_id4) ON DUPLICATE KEY UPDATE manu_id = '$manu_id', motif_id= '$motif_id4'";
    } else $insertMotifQry4 = "SELECT 1";


    //********** Insert into j_manuscripts_colors **********/
    if (isset($_POST['inkColor1']) and $_POST['inkColor1'] != "") {
        $color_id1_explode = explode(' # ', $_POST['inkColor1']);
        $color_id1 = $color_id1_explode[0]; // multi
        $insertInkColorQry1 = "INSERT INTO j_manuscripts_colors VALUES($manu_id, $color_id1) ON DUPLICATE KEY UPDATE manu_id = '$manu_id', color_id= '$color_id1'";
    } else $insertInkColorQry1 = "SELECT 1";

    if (isset($_POST['inkColor2']) and $_POST['inkColor2'] != "") {
        $color_id2_explode = explode(' # ', $_POST['inkColor2']);
        $color_id2 = $color_id2_explode[0]; // multi
        $insertInkColorQry2 = "INSERT INTO j_manuscripts_colors VALUES($manu_id, $color_id2) ON DUPLICATE KEY UPDATE manu_id = '$manu_id', color_id= '$color_id2'";
    } else $insertInkColorQry2 = "SELECT 1";

    if (isset($_POST['inkColor3']) and $_POST['inkColor3'] != "") {
        $color_id3_explode = explode(' # ', $_POST['inkColor3']);
        $color_id3 = $color_id3_explode[0]; // multi
        $insertInkColorQry3 = "INSERT INTO j_manuscripts_colors VALUES($manu_id, $color_id3) ON DUPLICATE KEY UPDATE manu_id = '$manu_id', color_id= '$color_id3'";
    } else $insertInkColorQry3 = "SELECT 1";

    if (isset($_POST['inkColor4']) and $_POST['inkColor4'] != "") {
        $color_id4_explode = explode(' # ', $_POST['inkColor4']);
        $color_id4 = $color_id4_explode[0]; // multi
        $insertInkColorQry4 = "INSERT INTO j_manuscripts_colors VALUES($manu_id, $color_id4) ON DUPLICATE KEY UPDATE manu_id = '$manu_id', color_id= '$color_id4'";
    } else $insertInkColorQry4 = "SELECT 1";


    //********** Insert into j_manuscripts_manuTypes **********/
    if (isset($_POST['manu_types1']) and $_POST['manu_types1'] != "") {
        $type_id1_explode = explode(' # ', $_POST['manu_types1']);
        $type_id1 = $type_id1_explode[0]; // multi
        $insertManuTypeQry1 = "INSERT INTO j_manuscripts_manuTypes VALUES($manu_id, $type_id1) ON DUPLICATE KEY UPDATE manu_id = '$manu_id', type_id= '$type_id1'";
    } else $insertManuTypeQry1 = "SELECT 1";

    if (isset($_POST['manu_types2']) and $_POST['manu_types2'] != "") {
        $type_id2_explode = explode(' # ', $_POST['manu_types2']);
        $type_id2 = $type_id2_explode[0]; // multi
        $insertManuTypeQry2 = "INSERT INTO j_manuscripts_manuTypes VALUES($manu_id, $type_id2) ON DUPLICATE KEY UPDATE manu_id = '$manu_id', type_id= '$type_id2'";
    } else $insertManuTypeQry2 = "SELECT 1";

    if (isset($_POST['manu_types3']) and $_POST['manu_types3'] != "") {
        $type_id3_explode = explode(' # ', $_POST['manu_types3']);
        $type_id3 = $type_id3_explode[0]; // multi
        $insertManuTypeQry3 = "INSERT INTO j_manuscripts_manuTypes VALUES($manu_id, $type_id3) ON DUPLICATE KEY UPDATE manu_id = '$manu_id', type_id= '$type_id3'";
    } else $insertManuTypeQry3 = "SELECT 1";

    if (isset($_POST['manu_types4']) and $_POST['manu_types4'] != "") {
        $type_id4_explode = explode(' # ', $_POST['manu_types4']);
        $type_id4 = $type_id4_explode[0]; // multi
        $insertManuTypeQry4 = "INSERT INTO j_manuscripts_manuTypes VALUES($manu_id, $type_id4) ON DUPLICATE KEY UPDATE manu_id = '$manu_id', type_id= '$type_id4'";
    } else $insertManuTypeQry4 = "SELECT 1";

    //********** Insert into i_cop_fm Queries **********/
    if (isset($_POST['cop_fm1']) and isset($_POST['cop_match1']) and $_POST['cop_fm1'] != "" and $_POST['cop_match1'] != "") {
        $cop_match1 = $_POST['cop_match1'];
        $cop_fm1_explode = explode(' # ', $_POST['cop_fm1']);
        $cop_fm1 = $cop_fm1_explode[0]; // multi
        $editCopFMQry1 = "INSERT INTO i_cop_fm(cop_id, cop_fm, manu_id)
        SELECT $cop_match1, $cop_fm1, $manu_id
        FROM i_cop_fm
        WHERE EXISTS (SELECT 1 FROM h_manuscripts_copiers 
        WHERE (h_manuscripts_copiers.cop_id = $cop_match1 AND h_manuscripts_copiers.manu_id= $manu_id)) LIMIT 1
        ON DUPLICATE KEY UPDATE cop_id = '$cop_match1', cop_fm= '$cop_fm1', manu_id= '$manu_id'";
    } else $editCopFMQry1 = "SELECT 1";

    if (isset($_POST['cop_fm2']) and isset($_POST['cop_match2']) and $_POST['cop_fm2'] != "" and $_POST['cop_match2'] != "") {
        $cop_match2 = $_POST['cop_match2'];
        $cop_fm2_explode = explode(' # ', $_POST['cop_fm2']);
        $cop_fm2 = $cop_fm2_explode[0]; // multi
        $editCopFMQry2 = "INSERT INTO i_cop_fm(cop_id, cop_fm, manu_id)
        SELECT $cop_match2, $cop_fm2, $manu_id
        FROM i_cop_fm
        WHERE EXISTS (SELECT 1 FROM h_manuscripts_copiers 
        WHERE (h_manuscripts_copiers.cop_id = $cop_match2 AND h_manuscripts_copiers.manu_id= $manu_id)) LIMIT 1
        ON DUPLICATE KEY UPDATE cop_id = '$cop_match2', cop_fm= '$cop_fm2', manu_id= '$manu_id'";
    } else $editCopFMQry2 = "SELECT 1";

    if (isset($_POST['cop_fm3']) and isset($_POST['cop_match3']) and $_POST['cop_fm3'] != "" and $_POST['cop_match3'] != "") {
        $cop_match3 = $_POST['cop_match3'];
        $cop_fm3_explode = explode(' # ', $_POST['cop_fm3']);
        $cop_fm3 = $cop_fm3_explode[0]; // multi
        $editCopFMQry3 = "INSERT INTO i_cop_fm(cop_id, cop_fm, manu_id)
        SELECT $cop_match3, $cop_fm3, $manu_id
        FROM i_cop_fm
        WHERE EXISTS (SELECT 1 FROM h_manuscripts_copiers 
        WHERE (h_manuscripts_copiers.cop_id = $cop_match3 AND h_manuscripts_copiers.manu_id= $manu_id)) LIMIT 1
        ON DUPLICATE KEY UPDATE cop_id = '$cop_match3', cop_fm= '$cop_fm3', manu_id= '$manu_id'";
    } else $editCopFMQry3 = "SELECT 1";

    if (isset($_POST['cop_fm4']) and isset($_POST['cop_match4']) and $_POST['cop_fm4'] != "" and $_POST['cop_match4'] != "") {
        $cop_match4 = $_POST['cop_match4'];
        $cop_fm4_explode = explode(' # ', $_POST['cop_fm4']);
        $cop_fm4 = $cop_fm4_explode[0]; // multi
        $editCopFMQry4 = "INSERT INTO i_cop_fm(cop_id, cop_fm, manu_id)
        SELECT $cop_match4, $cop_fm4, $manu_id
        FROM i_cop_fm
        WHERE EXISTS (SELECT 1 FROM h_manuscripts_copiers 
        WHERE (h_manuscripts_copiers.cop_id = $cop_match4 AND h_manuscripts_copiers.manu_id= $manu_id)) LIMIT 1
        ON DUPLICATE KEY UPDATE cop_id = '$cop_match4', cop_fm= '$cop_fm4', manu_id= '$manu_id'";
    } else $editCopFMQry4 = "SELECT 1";

    //START TRANSACTION 
    mysqli_query($conn, "START TRANSACTION");

    //********** Insert into e_manuscripts **********/
    $R = mysqli_query($conn, $editManuQry);
    if ($R == false) array_push($editManuErrs, "<br> e_manuscripts >> " . mysqli_error($conn));

    //********** Insert into Manuscriptions_Copiers **********/
    $R1 = mysqli_query($conn, $editCopQry1);
    $R2 = mysqli_query($conn, $editCopQry2);
    $R3 = mysqli_query($conn, $editCopQry3);
    $R4 = mysqli_query($conn, $editCopQry4);

    if ($R1 == false) array_push($editManuErrs, "<br> Manuscriptions_Copiers#1 >> " . mysqli_error($conn));
    if ($R2 == false) array_push($editManuErrs, "<br> Manuscriptions_Copiers#2 >> " . mysqli_error($conn));
    if ($R3 == false) array_push($editManuErrs, "<br> Manuscriptions_Copiers#3 >> " . mysqli_error($conn));
    if ($R4 == false) array_push($editManuErrs, "<br> Manuscriptions_Copiers#4 >> " . mysqli_error($conn));

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

    if ($R9 == false) array_push($insManuErrs, "<br> j_manuscripts_colors#1 >> " . mysqli_error($conn));
    if ($R10 == false) array_push($insManuErrs, "<br> j_manuscripts_colors#2 >> " . mysqli_error($conn));
    if ($R11 == false) array_push($insManuErrs, "<br> j_manuscripts_colors#3 >> " . mysqli_error($conn));
    if ($R12 == false) array_push($insManuErrs, "<br> j_manuscripts_colors#4 >> " . mysqli_error($conn));

    //********** Insert into j_manuscripts_manuTypes **********/
    $R13 = mysqli_query($conn, $insertManuTypeQry1);
    $R14 = mysqli_query($conn, $insertManuTypeQry2);
    $R15 = mysqli_query($conn, $insertManuTypeQry3);
    $R16 = mysqli_query($conn, $insertManuTypeQry4);

    if ($R13 == false) array_push($insManuErrs, "<br> j_manuscripts_manuTypes#1 >> " . mysqli_error($conn));
    if ($R14 == false) array_push($insManuErrs, "<br> j_manuscripts_manuTypes#2 >> " . mysqli_error($conn));
    if ($R15 == false) array_push($insManuErrs, "<br> j_manuscripts_manuTypes#3 >> " . mysqli_error($conn));
    if ($R16 == false) array_push($insManuErrs, "<br> j_manuscripts_manuTypes#4 >> " . mysqli_error($conn));

    //********** Insert into i_cop_fm **********/
    $R17 = mysqli_query($conn, $editCopFMQry1);
    $R18 = mysqli_query($conn, $editCopFMQry2);
    $R19 = mysqli_query($conn, $editCopFMQry3);
    $R20 = mysqli_query($conn, $editCopFMQry4);

    if ($R17 == false) array_push($editManuErrs, "<br> i_cop_fm#1 >> " . mysqli_error($conn));
    if ($R18 == false) array_push($editManuErrs, "<br> i_cop_fm#2 >> " . mysqli_error($conn));
    if ($R19 == false) array_push($editManuErrs, "<br> i_cop_fm#3 >> " . mysqli_error($conn));
    if ($R20 == false) array_push($editManuErrs, "<br> i_cop_fm#4 >> " . mysqli_error($conn));

    // COMMIT OR ROLLBACK QUERIES
    if ($R and $R1 and $R2 and $R3 and $R4 and $R5 and $R6 and $R7 and $R8 and $R9 and $R10 and $R11 and $R12 and $R13 and $R14 and $R15 and $R16 and $R17 and $R18 and $R19 and $R20) {
        mysqli_query($conn, "COMMIT");
        echo "<script>alert('تم تعديل الاستمارة رقم: $manu_id بنجاح')</script>";
        echo '<script>window.location.href = "editForm.php?manu_id=' . $manu_id . '"</script>';
    } else {
        mysqli_query($conn, "ROLLBACK");
        echo "<script>alert('فشلت عملية تعديل الاستمارة')</script>";
        echo print_r($editManuErrs);
        echo '<script>window.location.href = "editForm.php?manu_id=' . $manu_id . '"</script>';
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

            <div class="col-10 my_mr_sidebar pt-3">

                <div class="alert alert-primary text-center" role="alert">
                    <h4>تعديل الاستمارة</h4>
                </div>
                <form action="" method="post">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">معلومات الناسخ</legend>

                        <!-- ************ START COP NAME / name in manu -->
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="full_name">اسم الناسخ</label>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="name_in_manu">اسم الناسخ الوارد في النسخة</label>
                            </div>
                        </div>
                        <?php
                        $a = 1;
                        while ($row = mysqli_fetch_array($manuSubQry2Result)) {
                            $cop_id = $row['cop_id'];
                            $full_name = $row['full_name'];
                            $name_in_manu = $row['name_in_manu'];
                        ?>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span>
                                            <a class="btn btn-outline-danger"
                                                href="deleteManuCop.php?manu_id=<?php echo $manu_id ?>&cop_id=<?php echo $row['cop_id']  ?>"
                                                onclick="return confirm('هل أنت متأكد من حذف الناسخ من النسخة؟')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </a>
                                        </span>
                                    </div>

                                    <input list="copiers" class="form-control mb-2" name="full_name<?php echo $a ?>"
                                        value="<?php echo $cop_id . ' # ' . $full_name ?>" id="full_name"
                                        placeholder="حدد ناسخ">
                                    <datalist id="copiers">
                                        <?php
                                            for ($i = 0; $i <= $lastKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rows[$i]['cop_id']) ?> # <?php print_r($rows[$i]['full_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                            </div><!-- form-group col-md-5 -->

                            <div class="form-group col-md-7">
                                <input type="text" class="form-control" name="name_in_manu<?php echo $a ?>"
                                    id="name_in_manu" value="<?php echo $name_in_manu ?>"
                                    placeholder="أدخل اسم الناسخ كما ورد في النسخة" required>
                            </div><!-- form-group col-md-7 -->
                        </div><!-- END form-row -->
                        <?php $a++;
                        } ?>

                        <!-- add input if nbr of copiers under 4  -->
                        <?php if ($a < 5) {
                            for ($a; $a < 5; $a++) {
                        ?>
                        <div class="form-row">
                            <div class="col-md-5">
                                <input list="copiers" class="form-control mb-2" name="full_name<?php echo $a ?>"
                                    id="full_name" placeholder="حدد ناسخ">
                                <datalist id="copiers">
                                    <?php
                                            for ($i = 0; $i <= $lastKey; $i++) { ?>
                                    <option
                                        value="<?php print_r($rows[$i]['cop_id']) ?> # <?php print_r($rows[$i]['full_name']); ?>">
                                        <?php  } ?>
                                </datalist>
                            </div><!-- col-md-5 -->
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="name_in_manu<?php echo $a ?>"
                                    id="name_in_manu" placeholder="أدخل اسم الناسخ كما ورد في النسخة">
                            </div><!-- col-md-7 -->
                        </div><!-- form-row -->
                        <?php
                            }
                        } ?>
                        <!-- ************ END COP_NAME & NAME_IN_MANU -->

                        <!-- ************ START COP_FM  -->
                        <div class="form-row mt-4">
                            <div class="form-group col-md-auto">
                                <label for="cop_match">رقم الناسخ (من الاستمارة أعلاه)</label>
                            </div>

                            <div class="form-group col-md-9">
                                <label for="cop_fm">تشابه خط الناسخ بغيره من الناسخين</label>
                            </div>
                        </div>


                        <?php
                        $c = 1;
                        while ($row = mysqli_fetch_array($manuSubQry5Result)) {
                            $cop_id = $row['cop_id'];
                            $cop_fm = $row['cop_fm'];
                            $fm_full_name = $row['full_name'];
                        ?>
                        <div class="form-row">
                            <div class="form-group col-md-auto">
                                <input type="text" class="form-control text-center" name="cop_match<?php echo $c ?>"
                                    value="<?php echo $cop_id ?>" id="cop_match" placeholder="أدخل رقم الناسخ">
                            </div>
                            =>
                            <div class="form-group col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span>
                                            <a class="btn btn-outline-danger"
                                                href="deleteManuFmCop.php?manu_id=<?php echo $manu_id ?>&cop_id=<?php echo $cop_id  ?>&cop_fm=<?php echo $cop_fm  ?>"
                                                onclick="return confirm('هل أنت متأكد من حذف الناسخ المشابه من النسخة؟')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </a>
                                        </span>
                                    </div>

                                    <input list="copiers" class="form-control" name="cop_fm<?php echo $c ?>"
                                        value="<?php echo $cop_fm . ' # ' . $fm_full_name ?>" id="cop_fm"
                                        placeholder="أدخل الناسخ المشابه">
                                    <datalist id="copiers">
                                        <?php
                                            for ($i = 0; $i <= $lastKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rows[$i]['cop_id']) ?> # <?php print_r($rows[$i]['full_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <?php
                            $c++;
                        } ?>


                        <!-- add input if nbr of copiers under 4  -->
                        <?php if ($c < 6) {
                            for ($c; $c < 6; $c++) {
                        ?>
                        <div class="form-row">
                            <div class="form-group col-md-auto">
                                <input type="text" class="form-control text-center" name="cop_match<?php echo $c ?>"
                                    id="cop_match" placeholder="أدخل رقم الناسخ">
                            </div>
                            =>
                            <div class="form-group col-md-9">
                                <div class="input-group">
                                    <input list="copiers" class="form-control" name="cop_fm<?php echo $c ?>" id="cop_fm"
                                        placeholder="أدخل الناسخ المشابه">
                                    <datalist id="copiers">
                                        <?php
                                                for ($i = 0; $i <= $lastKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rows[$i]['cop_id']) ?> # <?php print_r($rows[$i]['full_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        } ?>
                        <!-- ************ END COP_FM -->

                    </fieldset>

                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">معلومات النسخة</legend>
                        <div class="form-row">
                            <div class="form-group col-md-auto">
                                <label for="manu_id">رقم الاستمارة</label>
                                <input type="number" class="form-control text-center" name="manu_id"
                                    value="<?php echo $manu_id ?>" id="manu_id" placeholder="أدخل رقم الاستمارة"
                                    required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="title">عنوان الكتاب</label>

                                <input list="books" class="form-control mb-2" name="book_title"
                                    value="<?php echo $book_id . ' # ' . $book_title ?>" id="title"
                                    placeholder="حدد عنوان الكتاب" required>
                                <datalist id="books">
                                    <?php
                                    for ($i = 0; $i <= $lastBookKey; $i++) { ?>
                                    <option
                                        value="<?php print_r($rowsBooks[$i]['book_id']) ?> # <?php print_r($rowsBooks[$i]['book_title']); ?>">
                                        <?php  } ?>
                                </datalist>
                            </div>
                        </div>

                        <div class="form-row" id="cop_date">
                            <?php if ($cop_syear == $cop_eyear) { ?>
                            <div class="form-group col-md-2">
                                <label for="cop_day">تاريخ النسخ</label>
                                <select name="cop_day" id="cop_day" class="custom-select">
                                    <option value="">-أدخل اليوم-</option>
                                    <?php
                                        for ($i = 0; $i <= 6; $i++) { ?>
                                    <option value="<?php echo $days[$i]; ?>"
                                        <?php if ($cop_day == $days[$i]) echo "selected"; ?>>
                                        <?php echo $days[$i]; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="cop_day_nbr">&nbsp;</label>
                                <select name="cop_day_nbr" id="cop_day_nbr" class="custom-select">
                                    <option value="">- أدخل اليوم -</option>
                                    <?php for ($i = 1; $i <= 31; $i++) { ?>
                                    <option value="<?php echo $i ?>" <?php if ($cop_day_nbr == $i) echo "selected" ?>>
                                        <?php echo $i ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="cop_month">&nbsp;</label>
                                <select name="cop_month" id="cop_month" class="custom-select">
                                    <option value="">-أدخل الشهر-</option>
                                    <?php for ($i = 0; $i <= 23; $i++) { ?>
                                    <option value="<?php echo $months[$i]; ?>"
                                        <?php if ($cop_month == $months[$i]) echo "selected"; ?>>
                                        <?php echo $months[$i]; ?>
                                    </option>
                                    <?php if ($i == 11) echo "<option disabled>──────────</option>" ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cop_syear">&nbsp;</label>
                                <input type="number" class="form-control" name="cop_syear" id="cop_syear"
                                    placeholder="أدخل السنة" value="<?php echo $cop_syear ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="date_type">نوع التقويم</label>
                                <select name="date_type" id="date_type" class="custom-select">
                                    <option value="1" <?php if ($date_type == 1) echo "selected" ?>>ميلادي
                                    </option>
                                    <option value="0" <?php if ($date_type == 0) echo "selected" ?>>هجري</option>
                                </select>
                            </div>

                            <!-- add input dinamically -->
                            <div id="replaceCopDate" class="form-group col-md-auto"
                                style="cursor: pointer; margin-top: 37px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                    class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                    <path
                                        d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                    <path fill-rule="evenodd"
                                        d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                </svg>
                                غير معروف؟
                            </div>
                            <!-- END add input dinamically -->

                            <?php } else { ?>
                            <div class="form-group col-md-2">
                                <label for="cop_date">تاريخ النسخ [أدخل نطاق]</label>
                                <input type="text" class="form-control" name="cop_syear" id="cop_date"
                                    value="<?php echo $cop_syear ?>" placeholder="من السنة">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cop_date">&nbsp;</label>
                                <input type="text" class="form-control" name="cop_eyear" id="cop_date"
                                    value="<?php echo $cop_eyear ?>" placeholder="إلى السنة">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="date_type">نوع التقويم</label>
                                <select name="date_type" id="date_type" class="custom-select">
                                    <option value="1" <?php if ($date_type == 1) echo "selected" ?>>ميلادي
                                    </option>
                                    <option value="0" <?php if ($date_type == 0) echo "selected" ?>>هجري</option>
                                </select>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cop_place">مكان النسخ</label>
                                <input type="text" class="form-control" name="cop_place" id="cop_place"
                                    placeholder="أدخل مكان النسخ" value="<?php echo $cop_place ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="city_name">المدينة</label>
                                <input list="cities" class="form-control" name="city_name"
                                    value="<?php if ($city_id != '') echo $city_id . ' # ' . $city_name ?>"
                                    id="city_name" placeholder="أدخل مدينة النسخ">
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
                                <input list="countries" class="form-control" name="count_name"
                                    value="<?php if ($count_id != '') echo $count_id . ' # ' . $count_name ?>"
                                    id="count_name" placeholder="أدخل بلد النسخ">
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
                                    <option value="">- اختر نوع النسخة -</option>
                                    <option value="1" <?php if ($signing == 1) echo "selected" ?>>موقعة</option>
                                    <option value="0" <?php if ($signing == 0 and $signing != null) echo "selected" ?>>
                                        بالمقارنة</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-7">
                                <label for="cabinet_name">اسم الخزانة</label>
                                <input list="cabinet_names" class="form-control" name="cabinet_name"
                                    value="<?php if ($cabinet_id != '') echo $cabinet_id . ' # ' . $cabinet_name ?>"
                                    id="cabinet_name" placeholder="أدخل اسم الخزانة">
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
                                    placeholder="أدخل الرقم في الخزانة" value="<?php echo $cabinet_nbr ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="manu_type">نوع النسخة</label>
                                <select name="manu_type" id="manu_type" class="custom-select">
                                    <option value="">-أدخل نوع النسخة-</option>
                                    <option value="مج" <?php if ($manu_type == 'مج') echo "selected"; ?>>مجلد</option>
                                    <option value="مص" <?php if ($manu_type == 'مص') echo "selected"; ?>>مصحف</option>
                                    <option value="دغ" <?php if ($manu_type == 'دغ') echo "selected"; ?>>دون غلاف
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="index_nbr">الرقم في الفهرس</label>
                                <input type="number" class="form-control" name="index_nbr" id="index_nbr"
                                    placeholder="أدخل الرقم في الفهرس" value="<?php echo $index_nbr ?>">
                            </div>
                        </div>

                        <h5 class="my_line"><span>تفاصيل النسخة</span></h5>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="font">الخط</label>
                                <select name="font" id="font" class="custom-select">
                                    <option value="">- اختر خط -</option>
                                    <option value="مغربي" <?php if ($font == 'مغربي') echo "selected"; ?>>مغربي</option>
                                    <option value="مشرقي" <?php if ($font == 'مشرقي') echo "selected"; ?>>مشرقي</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="font_style">نوع الخط</label>
                                <select name="font_style" id="font_style" class="custom-select">
                                    <option value="">- اختر نوع الخط -</option>
                                    <?php for ($i = 0; $i <= 5; $i++) { ?>
                                    <option value="<?php echo $w_font_styles[$i]; ?>"
                                        <?php if ($font_style == $w_font_styles[$i]) echo "selected"; ?>>
                                        <?php echo $w_font_styles[$i]; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="regular_lines">نوع المسطرة</label>
                                <select name="regular_lines" id="regular_lines" class="custom-select">
                                    <option value="">- اختر نوع المسطرة -</option>
                                    <option value="1" <?php if ($regular_lines == 1) echo "selected"; ?>>
                                        منتظمة
                                    </option>
                                    <option value="0"
                                        <?php if ($regular_lines == 0 and $regular_lines != null) echo "selected"; ?>>
                                        غير منتظمة
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lines_notes">ملاحظات على المسطرة</label>
                                <input type="text" class="form-control" name="lines_notes" id="lines_notes"
                                    value="<?php echo $lines_notes ?>" placeholder="أدخل ملاحظات المسطرة">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="paper_size">مقاس الورق</label>
                                <select name="paper_size" id="paper_size" class="custom-select">
                                    <option value="">- اختر مقاس الورق -</option>
                                    <option value="1" <?php if ($paper_size == 1) echo "selected"; ?>>القطع الكبير
                                    </option>
                                    <option value="2" <?php if ($paper_size == 2) echo "selected"; ?>>القطع المتوسط
                                    </option>
                                    <option value="3" <?php if ($paper_size == 3) echo "selected"; ?>>القطع الصغير
                                    </option>
                                </select>
                            </div>
                        </div>

                        <label for="motifs">الزخارف</label><br>
                        <div class="form-row">
                            <?php
                            $b = 1;
                            while ($row = mysqli_fetch_array($manuSubQry6Result)) {  ?>
                            <div class="form-group col-md-auto">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span>
                                            <a class="btn btn-outline-danger"
                                                href="deleteMotif.php?manu_id=<?php echo $manu_id ?>&motif_id=<?php echo $row['motif_id']  ?>"
                                                onclick="return confirm('هل أنت متأكد من حذف الزخرفة؟')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </a>
                                        </span>
                                    </div>

                                    <input list="motifs" class="form-control" name="motif<?php echo $b ?>"
                                        value="<?php echo  $row['motif_id'] . ' # ' . $row['motif_name']; ?>" id="motif"
                                        placeholder="أدخل زخرفة">
                                    <datalist id="motifs">
                                        <?php
                                            for ($i = 0; $i <= $lastMotifKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rowsMotif[$i]['motif_id']); ?> # <?php print_r($rowsMotif[$i]['motif_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                            </div>
                            <?php
                                $b++;
                            } ?>

                            <!-- add input if nbr of motifs under 4  -->
                            <?php if ($b < 5) {
                                for ($b; $b < 5; $b++) {
                            ?>
                            <div class="col-md-3">
                                <input list="motifs" class="form-control" name="motif<?php echo $b ?>" id="motif"
                                    placeholder="أدخل زخرفة">
                                <datalist id="motifs">
                                    <?php
                                            for ($i = 0; $i <= $lastMotifKey; $i++) { ?>
                                    <option
                                        value="<?php print_r($rowsMotif[$i]['motif_id']); ?> # <?php print_r($rowsMotif[$i]['motif_name']); ?>">
                                        <?php  } ?>
                                </datalist>
                            </div>
                            <?php
                                } // END add input if nbr of motifs under 4
                            } ?>
                        </div>

                        <label for="ink_colors">ألوان الحبر</label><br>
                        <div class="form-row">
                            <?php
                            $d = 1;
                            while ($row = mysqli_fetch_array($manuSubQry7Result)) {
                            ?>
                            <div class="form-group col-md-2">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span>
                                            <a class="btn btn-outline-danger"
                                                href="deleteInkColor.php?manu_id=<?php echo $manu_id ?>&color_id=<?php echo $row['color_id']  ?>"
                                                onclick="return confirm('هل أنت متأكد من حذف اللون؟')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </a>
                                        </span>
                                    </div>

                                    <input list="inkColors" class="form-control" name="inkColor<?php echo $d ?>"
                                        value="<?php echo  $row['color_id'] . ' # ' . $row['color_name']; ?>"
                                        id="inkColor" placeholder="أدخل لون">
                                    <datalist id="inkColors">
                                        <?php
                                            for ($i = 0; $i <= $lastColorKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rowsColor[$i]['color_id']); ?> # <?php print_r($rowsColor[$i]['color_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                            </div>
                            <?php $d++;
                            } ?>

                            <!-- add input if nbr of colors under 4  -->
                            <?php if ($d < 5) {
                                for ($d; $d < 5; $d++) {
                            ?>
                            <div class="col-md-3">
                                <input list="inkColors" class="form-control" name="inkColor<?php echo $d ?>"
                                    id="inkColor" placeholder="أدخل لون">
                                <datalist id="inkColors">
                                    <?php
                                            for ($i = 0; $i <= $lastColorKey; $i++) { ?>
                                    <option
                                        value="<?php print_r($rowsColor[$i]['color_id']); ?> # <?php print_r($rowsColor[$i]['color_name']); ?>">
                                        <?php  } ?>
                                </datalist>
                            </div>
                            <?php
                                } // END add input if nbr of colors under 4
                            } ?>
                        </div>


                        <h5 class="my_line"><span>محتوى النسخة</span></h5>

                        <label for="manu_types">عمل الناسخ عدا نقل المحتوى</label><br>
                        <div class="form-row">
                            <?php
                            $e = 1;
                            while ($row = mysqli_fetch_array($manuSubQry8Result)) {
                            ?>
                            <div class="form-group col-md-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span>
                                            <a class="btn btn-outline-danger"
                                                href="deleteManuTypes.php?manu_id=<?php echo $manu_id ?>&type_id=<?php echo $row['type_id']  ?>"
                                                onclick="return confirm('هل أنت متأكد من حذف العنصر')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </a>
                                        </span>
                                    </div>

                                    <input list="manu_types" class="form-control" name="manu_types<?php echo $e ?>"
                                        value="<?php echo  $row['type_id'] . ' # ' . $row['type_name']; ?>"
                                        id="manu_type" placeholder="أدخل عنصر">
                                    <datalist id="manu_types">
                                        <?php
                                            for ($i = 0; $i <= $lastManuTypeKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rowsManuType[$i]['type_id']); ?> # <?php print_r($rowsManuType[$i]['type_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                            </div>
                            <?php $e++;
                            } ?>

                            <!-- add input if nbr of ManuTypes under 4  -->
                            <?php if ($e < 5) {
                                for ($e; $e < 5; $e++) {
                            ?>
                            <div class="col-md-3">
                                <input list="manu_types" class="form-control" name="manu_types<?php echo $e ?>"
                                    id="manu_type" placeholder="أدخل عنصر">
                                <datalist id="manu_types">
                                    <?php
                                            for ($i = 0; $i <= $lastManuTypeKey; $i++) { ?>
                                    <option
                                        value="<?php print_r($rowsManuType[$i]['type_id']); ?> # <?php print_r($rowsManuType[$i]['type_name']); ?>">
                                        <?php  } ?>
                                </datalist>
                            </div>
                            <?php
                                } // END add input if nbr of ManuTypes under 4
                            } ?>
                        </div>

                        <div class="form-row mt-4">
                            <div class="form-group col-md-auto">
                                <label for="manu_level">مستوى النسخة من حيث الجودة والضبط</label>
                                <select name="manu_level" id="manu_level" class="custom-select mt-2">
                                    <option value="">- اختر مستوى -</option>
                                    <option value="جيد" <?php if ($manu_level == 'جيد') echo "selected"; ?>>جيد</option>
                                    <option value="حسن" <?php if ($manu_level == 'حسن') echo "selected"; ?>>حسن</option>
                                    <option value="متوسط" <?php if ($manu_level == 'متوسط') echo "selected"; ?>>متوسط
                                    </option>
                                    <option value="رديء" <?php if ($manu_level == 'رديء') echo "selected"; ?>>رديء
                                    </option>
                                </select>
                            </div>
                        </div>

                        <h5 class="my_line"><span>الملاحظات</span></h5>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="copied_from">الأصل المنسوخ منه</label>
                                <input type="text" class="form-control" name="copied_from" id="copied_from"
                                    value="<?php echo $copied_from ?>" placeholder="أدخل الأصل المنسوخ منه">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="copied_to">المنسوخ له</label>
                                <input type="text" class="form-control" name="copied_to" id="copied_to"
                                    value="<?php echo $copied_to ?>" placeholder="أدخل المنسوخ له بأوصافه">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="cop_level">مستوى ضبط الناسخ</label>
                                <select name="cop_level" id="cop_level" class="custom-select">
                                    <option value="">- اختر مستوى -</option>
                                    <option value="جيد" <?php if ($cop_level == 'جيد') echo "selected"; ?>>جيد</option>
                                    <option value="حسن" <?php if ($cop_level == 'حسن') echo "selected"; ?>>حسن</option>
                                    <option value="متوسط" <?php if ($cop_level == 'متوسط') echo "selected"; ?>>متوسط
                                    </option>
                                    <option value="رديء" <?php if ($cop_level == 'رديء') echo "selected"; ?>>رديء
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="rost_completion">ترميم وإتمام</label>
                                <select name="rost_completion" id="rost_completion" class="custom-select">
                                    <option value="">- اختر خيار -</option>
                                    <option value="1" <?php if ($rost_completion == 1) echo "selected"; ?>>نعم
                                    </option>
                                    <option value="0"
                                        <?php if ($rost_completion == 0 and $rost_completion != null) echo "selected"; ?>>
                                        لا
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-7">
                                <label for="notes">ملاحظات أخرى</label>
                                <textarea class="form-control" name="notes" id="notes" rows="3"
                                    placeholder="أدخل ملاحظات أخرى"><?php echo $notes ?></textarea>
                            </div>
                        </div>

                        <div class="form-row justify-content-end">
                            <div class="form-group col-md-2">
                                <button type="submit" name="editForm"
                                    class="btn btn-success btn-block btn-lg rounded-pill">تعديل</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
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