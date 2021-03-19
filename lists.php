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
$selectsubjQry = "SELECT subj_id, subj_name FROM b_subjects";
$subjListResult = mysqli_query($conn, $selectsubjQry);
$rowsSubj = mysqli_fetch_all($subjListResult, MYSQLI_ASSOC);
$lastSubjKey = key(array_slice($rowsSubj, -1, 1, true));

// days List
$days = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");

//months List
$months = array("محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأولى", "جمادى الثانية", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة");

//cabinet names
$cabinet_names = array("العامة", "أبو بكر الوارجلاني", "محمد حواش", "اطفيش");

//font styles List
$w_font_styles = array("المبسوط", "المجوهر", "المسند (الزمامي)", "المدمج", "الثلث المغربي", "الكوفي المغربي",);
$e_font_styles = array("النسخ", "الثلث", "الكوفي", "التعليق", "الديواني", "الرقعة");

//motifs List
$motifs = array("دائرة منقطة", "فواصل", "وريدات", "مراوح", "براعم", "فصوص");

//ink colors List
$ink_colors = array("البني", "الأسود", "الأحمر", "الآجوري", "البنفسجي", "الوردي", "البرتقالي", "الأصفر", "الأخضر", "الأزرق", "المذهب",);

//manu types List
$manu_types = array("تصحيح", "تصويب", "مقابلة", "تعليق");