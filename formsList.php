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

// init sessions
function initSessions()
{
    $_SESSION['book_title'] = "";
    $_SESSION['manu_id'] = "";
    $_SESSION['subj_name'] = "";
    $_SESSION['name_in_manu'] = "";
    $_SESSION['auth_name'] = "";
    $_SESSION['type_name'] = "";
    $_SESSION['copied_from'] = "";
    $_SESSION['copied_to'] = "";
    $_SESSION['manu_type'] = "";
    $_SESSION['cop_place'] = "";
    $_SESSION['city_name'] = "";
    $_SESSION['count_name'] = "";
    $_SESSION['font'] = "";
    $_SESSION['font_style'] = "";
    $_SESSION['color_name'] = "";
    $_SESSION['manu_level'] = "";
    $_SESSION['cop_level'] = "";
    $_SESSION['paper_size'] = "";
    $_SESSION['regular_lines'] = "";
    $_SESSION['signing'] = "";
    $_SESSION['rost_completion'] = "";
    $_SESSION['cabinet_name'] = "";
    $_SESSION['cabinet_nbr'] = "";
    $_SESSION['index_nbr'] = "";
    $_SESSION['cop_syear'] = "";
    $_SESSION['cop_eyear'] = "";
    $_SESSION['date_type'] = "";
}
initSessions();


if (isset($_GET['initSessions'])) {
    initSessions();
    echo "<script>window.location.href='formsList.php#formsList'</script>";
}
//input values
if (isset($_POST['manuSearch']) or isset($_POST['prev_page']) or isset($_POST['next_page'])) {
    $book_title = $_SESSION['book_title'] = $_POST['book_title'];
    $manu_id = $_SESSION['manu_id'] = $_POST['manu_id'];
    $subj_name = $_SESSION['subj_name'] =  $_POST['subj_name'];
    $name_in_manu = $_SESSION['name_in_manu'] = $_POST['name_in_manu'];
    $auth_name = $_SESSION['auth_name'] = $_POST['auth_name'];
    $type_name = $_SESSION['type_name'] = $_POST['type_name'];
    $copied_from = $_SESSION['copied_from'] = $_POST['copied_from'];
    $copied_to = $_SESSION['copied_to'] = $_POST['copied_to'];
    $manu_type = $_SESSION['manu_type'] = $_POST['manu_type'];
    $cop_place = $_SESSION['cop_place'] = $_POST['cop_place'];
    $city_name = $_SESSION['city_name'] = $_POST['city_name'];
    $count_name = $_SESSION['count_name'] = $_POST['count_name'];
    $font = $_SESSION['font'] = $_POST['font'];
    $font_style = $_SESSION['font_style'] = $_POST['font_style'];
    $color_name = $_SESSION['color_name'] = $_POST['color_name'];
    $manu_level = $_SESSION['manu_level'] = $_POST['manu_level'];
    $cop_level = $_SESSION['cop_level'] = $_POST['cop_level'];
    $paper_size = $_SESSION['paper_size'] = $_POST['paper_size'];
    $regular_lines = $_SESSION['regular_lines'] = $_POST['regular_lines'];
    $signing = $_SESSION['signing'] = $_POST['signing'];
    $rost_completion = $_SESSION['rost_completion'] = $_POST['rost_completion'];
    $cabinet_name = $_SESSION['cabinet_name'] = $_POST['cabinet_name'];
    $cabinet_nbr = $_SESSION['cabinet_nbr'] = $_POST['cabinet_nbr'];
    $index_nbr = $_SESSION['index_nbr'] = $_POST['index_nbr'];
    $cop_syear  = $_SESSION['cop_syear'] = $_POST['cop_syear'];
    $cop_eyear = $_SESSION['cop_eyear'] = $_POST['cop_eyear'];
    $date_type = $_SESSION['date_type'] = $_POST['date_type'];


    //test input (!= NULL)
    if ($manu_id != '') $manu_idQry = "AND e_manuscripts.manu_id =" . $manu_id;
    if ($subj_name != '') $subj_nameQry = "AND subj_name LIKE" . "'%$subj_name%'";
    if ($name_in_manu != '') $cop_nameQry = "AND (name_in_manu LIKE '%$name_in_manu%' OR full_name LIKE '%$name_in_manu%' OR descent1 LIKE '%$name_in_manu%' OR descent2 LIKE '%$name_in_manu%' OR descent3 LIKE '%$name_in_manu%' OR descent4 LIKE '%$name_in_manu%' OR descent5 LIKE '%$name_in_manu%' OR last_name LIKE '%$name_in_manu%' OR nickname LIKE '%$name_in_manu%' OR other_name1 LIKE '%$name_in_manu%' OR other_name2 LIKE '%$name_in_manu%' OR other_name3 LIKE '%$name_in_manu%' OR other_name4 LIKE '%$name_in_manu%')";
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

$searchResult = mysqli_query($conn, $searchQry);

// search num rows
$search_num_rows = mysqli_num_rows($searchResult);

//************* Start pagination ********************//
$results_per_page = 10;
//determine the total number of pages available  
$number_of_page = ceil($search_num_rows / $results_per_page);

if (!isset($_POST['next_page'])) {
    $page = 1;
} else {
    $pageExplode = explode(' / ', $_POST['page']);
    $page = $pageExplode[0];
    if ($page < $number_of_page) $page++;
    $page_first_result = ($page - 1) * $results_per_page;
}
if (isset($_POST['prev_page'])) {
    $pageExplode = explode(' / ', $_POST['page']);
    $page = $pageExplode[0];
    if ($page > 1) $page--;
    $page_first_result = ($page - 1) * $results_per_page;
}
//determine the sql LIMIT starting number for the results on the displaying page  
$page_first_result = ($page - 1) * $results_per_page;

$setLimit = " LIMIT " . $page_first_result . "," . $results_per_page;
$searchQry = $searchQry . $setLimit;

$searchResult = mysqli_query($conn, $searchQry);
//************* END pagination ********************//

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
    <div class="container-fluid mt-5 py-2">

        <?php include "sideBar.php" ?>

        <div class="col-10 my_mr_sidebar">
            <div class="tab-content" id="tabContent">
                <!-- clients list -->
                <div class="tab-pane fade mt-3" id="formsList">
                    <a href="formsList.php?initSessions=true">
                        <div class="alert alert-info text-center" role="alert">
                            <h4>قائمة الاستمارات</h4>
                        </div>
                    </a>


                    <form action="" method="post" id="searchForm">
                        <div class="accordion" id="accordion1">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            بحث بسيط </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordion1">
                                    <div class="card-body">
                                        <div class="form-row mb-2">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">رقم الاستمارة</span>
                                                    </div>
                                                    <input type="number" name="manu_id" class="form-control text-center"
                                                        placeholder="أدخل رقم الاستمارة"
                                                        value="<?php echo $_SESSION['manu_id'] ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">عنوان الكتاب</span>
                                                    </div>
                                                    <input type="text" name="book_title" class="form-control"
                                                        placeholder="أدخل عنوان الكتاب"
                                                        value="<?php echo $_SESSION['book_title'] ?>">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-info" name="manuSearch"
                                                            type="submit">بحث</button>
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
                                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            #2 بحث مخصص </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordion1">
                                    <div class="card-body">
                                        <div class="form-row mb-2">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">اسم النــــاسخ</span>
                                                    </div>
                                                    <input list="copiers" name="name_in_manu" class="form-control"
                                                        value="<?php echo $_SESSION['name_in_manu'] ?>">
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
                                                    <input list="authors" name="auth_name" class="form-control"
                                                        value="<?php echo $_SESSION['auth_name'] ?>">
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
                                                    <input list="manu_types" class="form-control" name="type_name"
                                                        value="<?php echo $_SESSION['type_name'] ?>">
                                                    <datalist id="manu_types">
                                                        <?php
                                                        for ($i = 0; $i <= $lastManuTypeKey; $i++) { ?>
                                                        <option
                                                            value="<?php print_r($rowsManuType[$i]['type_name']); ?>">
                                                            <?php  } ?>
                                                    </datalist>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">الموضوع</span>
                                                    </div>
                                                    <input list="subjects" name="subj_name" class="form-control"
                                                        value="<?php echo $_SESSION['subj_name'] ?>">
                                                    <datalist id="subjects">
                                                        <?php
                                                        for ($i = 0; $i <= $lastSubjKey; $i++) { ?>
                                                        <option value="<?php print_r($rowsSubj[$i]['subj_name']) ?>">
                                                            <?php  } ?>
                                                    </datalist>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mb-2">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">المنسوخ منه</span>
                                                    </div>
                                                    <input type="text" name="copied_from" class="form-control"
                                                        value="<?php echo $_SESSION['copied_from'] ?>">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">المنسوخ له</span>
                                                    </div>
                                                    <input type="text" name="copied_to" class="form-control"
                                                        value="<?php echo $_SESSION['copied_to'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mb-2">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">مكـــان النسخ</span>
                                                    </div>
                                                    <input type="text" name="cop_place" class="form-control"
                                                        value="<?php echo $_SESSION['cop_place'] ?>">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">مدينة النسخ</span>
                                                    </div>
                                                    <input list="cities" name="city_name" class="form-control"
                                                        value="<?php echo $_SESSION['city_name'] ?>">
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
                                                    <input list="countries" name="count_name" class="form-control"
                                                        value="<?php echo $_SESSION['count_name'] ?>">
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
                                                        <option value=""></option>
                                                        <option value="مغربي"
                                                            <?php if ($_SESSION['font'] == 'مغربي') echo 'Selected' ?>>
                                                            مغربي</option>
                                                        <option value="مشرقي"
                                                            <?php if ($_SESSION['font'] == 'مشرقي') echo 'Selected' ?>>
                                                            مشرقي</option>
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
                                                        <option value=""></option>
                                                        <?php for ($i = 0; $i <= 5; $i++) { ?>
                                                        <option value="<?php echo $w_font_styles[$i]; ?>"
                                                            <?php if ($_SESSION['font_style'] == $w_font_styles[$i]) echo 'Selected' ?>>
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
                                                    <input list="inkColors" name="color_name" class="form-control"
                                                        value="<?php echo $_SESSION['color_name'] ?>">
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
                                                        <option value=""></option>
                                                        <option value="جيد"
                                                            <?php if ($_SESSION['manu_level'] == 'جيد') echo 'Selected' ?>>
                                                            جيد</option>
                                                        <option value="حسن"
                                                            <?php if ($_SESSION['manu_level'] == 'حسن') echo 'Selected' ?>>
                                                            حسن</option>
                                                        <option value="متوسط"
                                                            <?php if ($_SESSION['manu_level'] == 'متوسط') echo 'Selected' ?>>
                                                            متوسط</option>
                                                        <option value="رديء"
                                                            <?php if ($_SESSION['manu_level'] == 'رديء') echo 'Selected' ?>>
                                                            رديء</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">مستوى الناسخ</span>
                                                    </div>
                                                    <select name="cop_level" class="custom-select">
                                                        <option value=""></option>
                                                        <option value="جيد"
                                                            <?php if ($_SESSION['cop_level'] == 'جيد') echo 'Selected' ?>>
                                                            جيد</option>
                                                        <option value="حسن"
                                                            <?php if ($_SESSION['cop_level'] == 'حسن') echo 'Selected' ?>>
                                                            حسن</option>
                                                        <option value="متوسط"
                                                            <?php if ($_SESSION['cop_level'] == 'متوسط') echo 'Selected' ?>>
                                                            متوسط</option>
                                                        <option value="رديء"
                                                            <?php if ($_SESSION['cop_level'] == 'رديء') echo 'Selected' ?>>
                                                            رديء</option>
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
                                                        <option value="1"
                                                            <?php if ($_SESSION['paper_size'] == 1) echo 'Selected' ?>>
                                                            القطع الكبير</option>
                                                        <option value="2"
                                                            <?php if ($_SESSION['paper_size'] == 2) echo 'Selected' ?>>
                                                            القطع المتوسط</option>
                                                        <option value="3"
                                                            <?php if ($_SESSION['paper_size'] == 3) echo 'Selected' ?>>
                                                            القطع الصغير</option>
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
                                                        <option value=""></option>
                                                        <option value="1"
                                                            <?php if ($_SESSION['regular_lines'] == 1) echo 'Selected' ?>>
                                                            منتظمة</option>
                                                        <option value="0"
                                                            <?php if ($_SESSION['regular_lines'] == 0 and $_SESSION['regular_lines'] != null) echo 'Selected' ?>>
                                                            غير منتظمة</option>
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
                                                        <option value=""></option>
                                                        <option value="1"
                                                            <?php if ($_SESSION['signing'] == 1) echo 'Selected' ?>>
                                                            موقعة</option>
                                                        <option value="0"
                                                            <?php if ($_SESSION['signing'] == 0 and $_SESSION['signing'] != null) echo 'Selected' ?>>
                                                            بالمقارنة</option>
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
                                                        <option value=""></option>
                                                        <option value="1"
                                                            <?php if ($_SESSION['rost_completion'] == 1) echo 'Selected' ?>>
                                                            نعم</option>
                                                        <option value="0"
                                                            <?php if ($_SESSION['rost_completion'] == 0 and $_SESSION['rost_completion'] != null) echo 'Selected' ?>>
                                                            لا</option>
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
                                                    <input list="cabinet_names" class="form-control" name="cabinet_name"
                                                        id="cabinet_name"
                                                        value="<?php echo $_SESSION['cabinet_name'] ?>">
                                                    <datalist id="cabinet_names">
                                                        <?php
                                                        for ($i = 0; $i <= $lastCabinetKey; $i++) { ?>
                                                        <option
                                                            value="<?php print_r($rowsCabinet[$i]['cabinet_name']); ?>">
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
                                                    <input type="number" name="cabinet_nbr" class="form-control"
                                                        value="<?php echo $_SESSION['cabinet_nbr'] ?>">

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
                                                    <input type="number" name="index_nbr" class="form-control"
                                                        value="<?php echo $_SESSION['index_nbr'] ?>">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">نوع النسخة</span>
                                                    </div>
                                                    <select name="manu_type" class="custom-select">
                                                        <option value=""></option>
                                                        <option value="مج"
                                                            <?php if ($_SESSION['manu_type'] == 'مج') echo 'Selected' ?>>
                                                            مجلد</option>
                                                        <option value="مص"
                                                            <?php if ($_SESSION['manu_type'] == 'مص') echo 'Selected' ?>>
                                                            مصحف</option>
                                                        <option value="دغ"
                                                            <?php if ($_SESSION['manu_type'] == 'دغ') echo 'Selected' ?>>
                                                            دون غلاف</option>
                                                    </select>
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
                                                    <input type="number" name="cop_syear" class="form-control"
                                                        placeholder="من سنة"
                                                        value="<?php echo $_SESSION['cop_syear'] ?>">
                                                    <input type="number" name="cop_eyear" class="form-control"
                                                        placeholder="إلى سنة"
                                                        value="<?php echo $_SESSION['cop_eyear'] ?>">


                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">نوع التقويـــم</span>
                                                    </div>
                                                    <select name="date_type" id="date_type" class="custom-select">
                                                        <option value=""></option>
                                                        <option value="1"
                                                            <?php if ($_SESSION['date_type'] == 1) echo 'Selected' ?>>
                                                            ميلادي</option>
                                                        <option value="0"
                                                            <?php if ($_SESSION['date_type'] == 0 and $_SESSION['date_type'] != null) echo 'Selected' ?>>
                                                            هجري</option>
                                                    </select>

                                                    <div class="input-group-append">
                                                        <button class="btn btn-info" name="manuSearch"
                                                            type="submit">بحث</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END card body -->
                                </div>
                            </div>
                        </div>
                        <!-- </form> -->

                        <div class="alert alert-warning text-center mt-2" role="alert">
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
                                        <a class="btn btn-outline-danger"
                                            href="previewForm.php?manu_id=<?php echo $row['manu_id'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-danger"
                                            href="editForm.php?manu_id=<?php echo $row['manu_id'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-danger"
                                            href="delete.php?del_manu_id=<?php echo $row['manu_id'] ?>&book_title=<?php echo $row['book_title'] ?>"
                                            onclick="return confirm('هل أنت متأكد؟')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <!-- START pagination -->
                        <!-- <form action="" method="post" id="prev_pageForm"> -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <button type="submit" name="prev_page" onclick="submitPrev_page()"
                                        class="btn btn-info">الصفحة
                                        السابقة</button>
                                </li>
                                <li class="page-item">
                                    <input type="text" name="page" class="page-link text-center bg-light text-info"
                                        aria-disabled="true" value="<?php echo $page . ' / ' . $number_of_page ?>"
                                        readonly>
                                </li>
                                <li class="page-item">
                                    <button type="submit" name="next_page" onclick="submitNext_page()"
                                        class="btn btn-info">الصفحة
                                        التالية</button>
                                </li>
                            </ul>
                        </nav>
                    </form>
                    <!-- END pagination -->
                </div><!-- END tab -->
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