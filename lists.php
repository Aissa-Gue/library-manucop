<?php
include 'check.php';

//Select all countries
$selectCountQry = "SELECT count_id, count_name FROM countries";
$countListResult = mysqli_query($conn, $selectCountQry);
$rowsCount = mysqli_fetch_all($countListResult, MYSQLI_ASSOC);
$lastCountKey = key(array_slice($rowsCount, -1, 1, true));

//Select all cities
$selectCitiesQry = "SELECT city_id, city_name FROM cities";
$countListResult = mysqli_query($conn, $selectCitiesQry);
$rowsCities = mysqli_fetch_all($countListResult, MYSQLI_ASSOC);
$lastCityKey = key(array_slice($rowsCities, -1, 1, true));

// select all copiers
$selectCopQry = "SELECT cop_id, full_name FROM d_copiers";
$copListResult = mysqli_query($conn, $selectCopQry);
$rows = mysqli_fetch_all($copListResult, MYSQLI_ASSOC);
$lastKey = key(array_slice($rows, -1, 1, true));

//select all authors
$selectAuthQry = "SELECT auth_id, auth_name FROM c_authors";
$authListResult = mysqli_query($conn, $selectAuthQry);
$rowsAuth = mysqli_fetch_all($authListResult, MYSQLI_ASSOC);
$lastAuthKey = key(array_slice($rowsAuth, -1, 1, true));

//Select all books
$selectBooksQry = "SELECT book_id, book_title FROM a_books";
$booksListResult = mysqli_query($conn, $selectBooksQry);
$rowsBooks = mysqli_fetch_all($booksListResult, MYSQLI_ASSOC);
$lastBookKey = key(array_slice($rowsBooks, -1, 1, true));

//select all subjects
$selectSubjQry = "SELECT subj_id, subj_name FROM b_subjects";
$subjListResult = mysqli_query($conn, $selectSubjQry);
$rowsSubj = mysqli_fetch_all($subjListResult, MYSQLI_ASSOC);
$lastSubjKey = key(array_slice($rowsSubj, -1, 1, true));

//select all motifs
$selectMotifsQry = "SELECT motif_id, motif_name FROM d_motifs";
$motifsListResult = mysqli_query($conn, $selectMotifsQry);
$rowsMotif = mysqli_fetch_all($motifsListResult, MYSQLI_ASSOC);
$lastMotifKey = key(array_slice($rowsMotif, -1, 1, true));

//select all colors
$selectColorsQry = "SELECT color_id, color_name FROM d_colors";
$colorsListResult = mysqli_query($conn, $selectColorsQry);
$rowsColor = mysqli_fetch_all($colorsListResult, MYSQLI_ASSOC);
$lastColorKey = key(array_slice($rowsColor, -1, 1, true));

//select all manuTypes
$selectManuTypesQry = "SELECT type_id, type_name FROM d_manuTypes";
$manuTypesListResult = mysqli_query($conn, $selectManuTypesQry);
$rowsManuType = mysqli_fetch_all($manuTypesListResult, MYSQLI_ASSOC);
$lastManuTypeKey = key(array_slice($rowsManuType, -1, 1, true));

//select all cabinets
$selectCabinetsQry = "SELECT cabinet_id, cabinet_name FROM cabinets";
$cabinetsListResult = mysqli_query($conn, $selectCabinetsQry);
$rowsCabinet = mysqli_fetch_all($cabinetsListResult, MYSQLI_ASSOC);
$lastCabinetKey = key(array_slice($rowsCabinet, -1, 1, true));

// days List
$days = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");

//months List
$months = array(
    "محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأولى", "جمادى الثانية", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة",
);
$months_m = array(
    "جانفي", "فيفري", "مارس", "أفريل", "ماي", "جوان", "جويلية", "أوت", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
);

//font styles List
$w_font_styles = array("المبسوط", "المجوهر", "المسند (الزمامي)", "المدمج", "الثلث المغربي", "الكوفي المغربي",);
$e_font_styles = array("النسخ", "الثلث", "الكوفي", "التعليق", "الديواني", "الرقعة");