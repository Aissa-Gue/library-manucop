<?php
include 'header.php';
include 'lists.php';

// init vars
$book_title = "";
$manu_idQry = "";
$subj_nameQry = "";
$cop_nameQry = "";
$auth_nameQry = "";
$type_nameQry = "";
$copied_fromQry = "";
$copied_toQry = "";
$manu_typeQry = "";
$cop_placeQry = "";
$city_nameQry = "";
$count_nameQry = "";
$fontQry = "";
$font_styleQry = "";
$color_nameQry = "";
$manu_levelQry = "";
$cop_levelQry = "";
$paper_sizeQry = "";
$regular_linesQry = "";
$signingQry = "";
$rost_completionQry = "";
$cabinet_nameQry = "";
$cabinet_nbrQry = "";
$index_nbrQry = "";
$cop_syearQry = "";
$cop_eyearQry = "";
$date_typeQry = "";

// input values
if (isset($_POST['manuSearch'])) {
    $book_title = $_POST['book_title'];
    $manu_id = $_POST['manu_id'];
    $subj_name =  $_POST['subj_name'];
    $cop_name = $_POST['cop_name'];
    $auth_name = $_POST['auth_name'];
    $type_name = $_POST['type_name'];
    $copied_from = $_POST['copied_from'];
    $copied_to = $_POST['copied_to'];
    $manu_type = $_POST['manu_type'];
    $cop_place = $_POST['cop_place'];
    $city_name = $_POST['city_name'];
    $count_name = $_POST['count_name'];
    $font = $_POST['font'];
    $font_style = $_POST['font_style'];
    $color_name = $_POST['color_name'];
    $manu_level = $_POST['manu_level'];
    $cop_level = $_POST['cop_level'];
    $paper_size = $_POST['paper_size'];
    $regular_lines = $_POST['regular_lines'];
    $signing = $_POST['signing'];
    $rost_completion = $_POST['rost_completion'];
    $cabinet_name = $_POST['cabinet_name'];
    $cabinet_nbr = $_POST['cabinet_nbr'];
    $index_nbr = $_POST['index_nbr'];
    $cop_syear = $_POST['cop_syear'];
    $cop_eyear = $_POST['cop_eyear'];
    $date_type = $_POST['date_type'];


    //test input (!= NULL)
    if ($manu_id != '') $manu_idQry = "AND e_manuscripts.manu_id =" . $manu_id;
    if ($subj_name != '') $subj_nameQry = "AND subj_name LIKE" . "'%$subj_name%'";
    if ($cop_name != '') $cop_nameQry = "AND (cop_name LIKE '%$cop_name%' OR full_name LIKE '%$cop_name%' OR descent1 LIKE '%$cop_name%' OR descent2 LIKE '%$cop_name%' OR descent3 LIKE '%$cop_name%' OR descent4 LIKE '%$cop_name%' OR descent5 LIKE '%$cop_name%' OR last_name LIKE '%$cop_name%' OR nickname LIKE '%$cop_name%' OR other_name1 LIKE '%$cop_name%' OR other_name2 LIKE '%$cop_name%' OR other_name3 LIKE '%$cop_name%' OR other_name4 LIKE '%$cop_name%')";
    if ($auth_name != '') $auth_nameQry = "AND auth_name LIKE" . "'%$auth_name%'";
    if ($type_name != '') $type_nameQry = "AND type_name LIKE" . "'%$type_name%'";
    if ($copied_from != '') $copied_fromQry = "AND copied_from LIKE" . "'%$copied_from%'";
    if ($copied_to != '') $copied_toQry = "AND copied_to LIKE" . "'%$copied_to%'";
    if ($manu_type != '') $manu_typeQry = "AND manu_type LIKE" . "'%$manu_type%'";
    if ($cop_place != '') $cop_placeQry = "AND cop_place LIKE" . "'%$cop_place%'";
    if ($city_name != '') $city_nameQry = "AND city_name LIKE" . "'%$city_name%'";
    if ($count_name != '') $count_nameQry = "AND count_name LIKE" . "'%$count_name%'";
    if ($font != '') $fontQry = "AND font LIKE" . "'%$font%'";
    if ($font_style != '') $font_styleQry = "AND font_style LIKE" . "'%$font_style%'";
    if ($color_name != '') $color_nameQry = "AND color_name LIKE" . "'%$color_name%'";
    if ($manu_level != '') $manu_levelQry = "AND manu_level LIKE" . "'%$manu_level%'";
    if ($cop_level != '') $cop_levelQry = "AND cop_level LIKE" . "'%$cop_level%'";
    if ($paper_size != '') $paper_sizeQry = "AND paper_size LIKE" . "'%$paper_size%'";
    if ($regular_lines != '') $regular_linesQry = "AND regular_lines LIKE" . "'%$regular_lines%'";
    if ($signing != '') $signingQry = "AND signing LIKE" . "'%$signing%'";
    if ($rost_completion != '') $rost_completionQry = "AND rost_completion LIKE" . "'%$rost_completion%'";
    if ($cabinet_name != '') $cabinet_nameQry = "AND cabinet_name LIKE" . "'%$cabinet_name%'";
    if ($cabinet_nbr != '') $cabinet_nbrQry = "AND cabinet_nbr = " . $cabinet_nbr;
    if ($index_nbr != '') $index_nbrQry = "AND index_nbr = " . $index_nbr;
    if ($cop_syear != '') $cop_syearQry = "AND cop_syear >=" . "$cop_syear";
    if ($cop_eyear != '') $cop_eyearQry = "AND cop_eyear <=" . "$cop_eyear";
    if ($date_type != '') $date_typeQry = "AND date_type =" . "$date_type";
}

// **** Search query *****

$searchQry = "SELECT e_manuscripts.manu_id, book_title, full_name, auth_name, subj_name, 
e_manuscripts.cop_place, count_name, city_name, cop_syear, cop_eyear, copied_from, copied_to,
motif_name, color_name, type_name, cabinet_name
FROM e_manuscripts
LEFT JOIN h_manuscripts_copiers ON  h_manuscripts_copiers.manu_id = e_manuscripts.manu_id
LEFT JOIN d_copiers ON d_copiers.cop_id = h_manuscripts_copiers.cop_id
LEFT JOIN a_books ON a_books.book_id = e_manuscripts.book_id
LEFT JOIN g_books_authors ON g_books_authors.book_id = a_books.book_id
LEFT JOIN c_authors ON c_authors.auth_id = g_books_authors.auth_id
LEFT JOIN f_books_subjects ON f_books_subjects.book_id = a_books.book_id
LEFT JOIN b_subjects ON b_subjects.subj_id = f_books_subjects.subj_id
LEFT JOIN countries ON countries.count_id = e_manuscripts.count_id
LEFT JOIN cities ON cities.city_id = e_manuscripts.city_id
LEFT JOIN j_manuscripts_motifs ON j_manuscripts_motifs.manu_id = e_manuscripts.manu_id
LEFT JOIN d_motifs ON d_motifs.motif_id = j_manuscripts_motifs.motif_id
LEFT JOIN j_manuscripts_colors ON j_manuscripts_colors.manu_id = e_manuscripts.manu_id
LEFT JOIN d_colors ON d_colors.color_id = j_manuscripts_colors.color_id
LEFT JOIN j_manuscripts_manutypes ON j_manuscripts_manutypes.manu_id = e_manuscripts.manu_id
LEFT JOIN d_manutypes ON d_manutypes.type_id = j_manuscripts_manutypes.type_id
LEFT JOIN cabinets ON cabinets.cabinet_id = e_manuscripts.cabinet_id

WHERE book_title LIKE '%$book_title%'
$manu_idQry
$cop_nameQry
$subj_nameQry
$auth_nameQry
$type_nameQry
$copied_fromQry
$copied_toQry
$manu_typeQry
$cop_placeQry
$city_nameQry
$count_nameQry
$fontQry
$font_styleQry
$color_nameQry
$manu_levelQry
$cop_levelQry
$paper_sizeQry
$regular_linesQry
$signingQry
$rost_completionQry
$cabinet_nameQry
$cabinet_nbrQry
$index_nbrQry
$cop_syearQry
$cop_eyearQry
$date_typeQry
GROUP BY e_manuscripts.manu_id
ORDER BY e_manuscripts.last_edit_date DESC";
//$qry = "AND (cop_name LIKE '%$cop_name%' OR full_name LIKE '%$cop_name%' OR descent1 LIKE '%$cop_name%' OR descent2 LIKE '%$cop_name%' OR descent3 LIKE '%$cop_name%' OR descent4 LIKE '%$cop_name%' OR descent5 LIKE '%$cop_name%' OR last_name LIKE '%$cop_name%' OR nickname LIKE '%$cop_name%' OR other_name1 LIKE '%$cop_name%' OR other_name2 LIKE '%$cop_name%' OR other_name3 LIKE '%$cop_name%' OR other_name4 LIKE '%$cop_name%')
//$qry = "AND CONCAT_WS('', cop_name, full_name, descent1, descent2, descent3, descent4, descent5, last_name, nickname, other_name1, other_name2, other_name3, other_name4) LIKE '%$cop_name%'

$searchResult = mysqli_query($conn, $searchQry);

// search num rows
$search_num_rows = mysqli_num_rows($searchResult);

?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $ProjTitle ?></title>
</head>
<style>
    .card-header {
        padding: 3px 3px;
    }

    .input-group-text {
        width: 140px;
    }
</style>

<body class="my_bg">

    <!-- START row -->
    <div class="container-fluid mt-5">
        <div class="row">

            <?php include "sideBar.php" ?>

            <div class="col-10 my_mr_sidebar">
                <div class="tab-content" id="tabContent">
                    <!-- clients list -->
                    <div class="tab-pane fade mt-3" id="formsList">

                        <div class="alert alert-primary text-center" role="alert">
                            <h4>قائمة الاستمارات</h4>
                        </div>

                        <form action="" method="post">
                            <div class="accordion" id="accordion1">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                بحث بسيط </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion1">
                                        <div class="card-body">
                                            <div class="form-row mb-2">
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">رقم الاستمارة</span>
                                                        </div>
                                                        <input type="number" name="manu_id" class="form-control" placeholder="أدخل رقم الاستمارة">
                                                    </div>
                                                </div>

                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">عنوان الكتاب</span>
                                                        </div>
                                                        <input type="text" name="book_title" class="form-control" placeholder="أدخل عنوان الكتاب">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" name="manuSearch" type="submit">بحث</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                #2 بحث مخصص </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion1">
                                        <div class="card-body">
                                            <div class="form-row mb-2">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">اسم النــــاسخ</span>
                                                        </div>
                                                        <input list="copiers" name="cop_name" class="form-control">
                                                        <datalist id="copiers">
                                                            <?php
                                                            for ($i = 0; $i <= $lastKey; $i++) { ?>
                                                                <option value="<?php print_r($rows[$i]['full_name']); ?>">
                                                                <?php  } ?>
                                                        </datalist>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">اسم المؤلف</span>
                                                        </div>
                                                        <input list="authors" name="auth_name" class="form-control">
                                                        <datalist id="authors">
                                                            <?php
                                                            for ($i = 0; $i <= $lastAuthKey; $i++) { ?>
                                                                <option value="<?php print_r($rowsAuth[$i]['auth_name']); ?>">
                                                                <?php  } ?>
                                                        </datalist>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">عمل الناسخ</span>
                                                        </div>
                                                        <input list="manu_types" class="form-control" name="type_name">
                                                        <datalist id="manu_types">
                                                            <?php
                                                            for ($i = 0; $i <= $lastManuTypeKey; $i++) { ?>
                                                                <option value="<?php print_r($rowsManuType[$i]['type_name']); ?>">
                                                                <?php  } ?>
                                                        </datalist>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">نوع النسخة</span>
                                                        </div>
                                                        <select name="manu_type" class="custom-select">
                                                            <option value="" selected></option>
                                                            <option value="مج">مجلد</option>
                                                            <option value="مص">مصحف</option>
                                                            <option value="دغ">دون غلاف</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">المنسوخ منه</span>
                                                        </div>
                                                        <input type="text" name="copied_from" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">المنسوخ له</span>
                                                        </div>
                                                        <input type="text" name="copied_to" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">مكـــان النسخ</span>
                                                        </div>
                                                        <input type="text" name="cop_place" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">مدينة النسخ</span>
                                                        </div>
                                                        <input list="cities" name="city_name" class="form-control">
                                                        <datalist id="cities">
                                                            <?php
                                                            for ($i = 0; $i <= $lastCityKey; $i++) { ?>
                                                                <option value="<?php print_r($rowsCities[$i]['city_name']); ?>">
                                                                <?php  } ?>
                                                        </datalist>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">بـــلد النسخ</span>
                                                        </div>
                                                        <input list="countries" name="count_name" class="form-control">
                                                        <datalist id="countries">
                                                            <?php
                                                            for ($i = 0; $i <= $lastCountKey; $i++) { ?>
                                                                <option value="<?php print_r($rowsCount[$i]['count_name']); ?>">
                                                                <?php  } ?>
                                                        </datalist>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">خط
                                                                النــــــاسخ</span>
                                                        </div>
                                                        <select name="font" id="font" class="custom-select">
                                                            <option value="" selected></option>
                                                            <option value="مغربي">مغربي</option>
                                                            <option value="مشرقي">مشرقي</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">نــوع الخــــط</span>
                                                        </div>
                                                        <select name="font_style" id="font_style" class="custom-select">
                                                            <option value="" selected></option>
                                                            <?php for ($i = 0; $i <= 5; $i++) { ?>
                                                                <option value="<?php echo $w_font_styles[$i]; ?>">
                                                                    <?php echo $w_font_styles[$i]; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">لــــون الحبر</span>
                                                        </div>
                                                        <input list="inkColors" name="color_name" class="form-control">
                                                        <datalist id="inkColors">
                                                            <?php
                                                            for ($i = 0; $i <= $lastColorKey; $i++) { ?>
                                                                <option value="<?php print_r($rowsColor[$i]['color_name']); ?>">
                                                                <?php  } ?>
                                                        </datalist>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">مستوى النسخة</span>
                                                        </div>
                                                        <select name="manu_level" class="custom-select">
                                                            <option selected value=""></option>
                                                            <option value="جيد">جيد</option>
                                                            <option value="حسن">حسن</option>
                                                            <option value="متوسط">متوسط</option>
                                                            <option value="رديء">رديء</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">مستوى الناسخ</span>
                                                        </div>
                                                        <select name="cop_level" class="custom-select">
                                                            <option selected value=""></option>
                                                            <option value="جيد">جيد</option>
                                                            <option value="حسن">حسن</option>
                                                            <option value="متوسط">متوسط</option>
                                                            <option value="رديء">رديء</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">مقاس الورق</span>
                                                        </div>
                                                        <select name="paper_size" class="custom-select">
                                                            <option value="" selected></option>
                                                            <option value="1">القطع الكبير</option>
                                                            <option value="2">القطع المتوسط</option>
                                                            <option value="3">القطع الصغير</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">نـوع
                                                                المسطـــرة</span>
                                                        </div>
                                                        <select name="regular_lines" class="custom-select">
                                                            <option value="" selected></option>
                                                            <option value="1">منتظمة</option>
                                                            <option value="0">غير منتظمة</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">توقيع النسخة</span>
                                                        </div>
                                                        <select name="signing" class="custom-select">
                                                            <option value="" selected></option>
                                                            <option value="1">موقعة</option>
                                                            <option value="0">بالمقارنة</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">الترميم
                                                                والإتمام</span>
                                                        </div>
                                                        <select name="rost_completion" class="custom-select">
                                                            <option value="" selected></option>
                                                            <option value="1">نعم</option>
                                                            <option value="0">لا</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">اسم
                                                                الخزانــــــــة</span>
                                                        </div>
                                                        <input list="cabinet_names" class="form-control" name="cabinet_name" id="cabinet_name">
                                                        <datalist id="cabinet_names">
                                                            <?php
                                                            for ($i = 0; $i <= $lastCabinetKey; $i++) { ?>
                                                                <option value="<?php print_r($rowsCabinet[$i]['cabinet_name']); ?>">
                                                                <?php  } ?>
                                                        </datalist>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">الرقم في
                                                                الخزانة</span>
                                                        </div>
                                                        <input type="text" name="cabinet_nbr" class="form-control">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">الرقم في
                                                                الفهرس</span>
                                                        </div>
                                                        <input type="text" name="index_nbr" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">الموضوع</span>
                                                        </div>
                                                        <input list="subjects" name="subj_name" class="form-control">
                                                        <datalist id="subjects">
                                                            <?php
                                                            for ($i = 0; $i <= $lastSubjKey; $i++) { ?>
                                                                <option value="<?php print_r($rowsSubj[$i]['subj_name']) ?>">
                                                                <?php  } ?>
                                                        </datalist>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="form-row mb-2 justify-content-md-center">
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">فتــــرة
                                                                النســـــخ</span>
                                                        </div>
                                                        <input type="text" name="cop_syear" class="form-control" placeholder="من سنة">
                                                        <input type="text" name="cop_eyear" class="form-control" placeholder="إلى سنة">


                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">نوع التقويـــم</span>
                                                        </div>
                                                        <select name="date_type" id="date_type" class="custom-select">
                                                            <option value="" selected></option>
                                                            <option value="1">ميلادي</option>
                                                            <option value="0">هجري</option>
                                                        </select>

                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" name="manuSearch" type="submit">بحث</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END card body -->
                                    </div>
                                </div>
                            </div>
                        </form>



                        <div class="alert alert-warning text-center" role="alert">
                            <strong> عدد النتائج = </strong>
                            <?php echo $search_num_rows ?>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">رقم الاستمارة</th>
                                    <th scope="col">عنوان الكتاب</th>
                                    <th scope="col" class="text-center">تفاصيل</th>
                                    <th scope="col" class="text-center">تعديل</th>
                                    <th scope="col" class="text-center">حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($searchResult)) { ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?php echo $row['manu_id'] ?></th>
                                        <td><?php echo $row['book_title'] ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-outline-danger" href="previewForm.php?manu_id=<?php echo $row['manu_id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-outline-danger" href="editForm.php?manu_id=<?php echo $row['manu_id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-outline-danger" href="delete.php?del_manu_id=<?php echo $row['manu_id'] ?>&book_title=<?php echo $row['book_title'] ?>" onclick="return confirm('هل أنت متأكد؟')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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