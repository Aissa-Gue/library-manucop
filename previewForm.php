<?php
include 'header.php';

// GET values from clientsList.php
$manu_id_get = $_GET['manu_id'];

// select manu book / country / city ...
$manuSubQry1 = "SELECT e_manuscripts.manu_id, e_manuscripts.book_id, book_title,
cop_day, cop_day_nbr, cop_month, cop_syear, cop_eyear, date_type, cop_place,
signing, cabinet_name, cabinet_nbr, manu_type, index_nbr,
font, font_style, regular_lines, lines_notes, paper_size,
copied_from, copied_to, manu_level, cop_level, rost_completion, city_name , count_name,
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
    if ($date_type == 1) $date_type = "ميلادي";
    elseif ($date_type == 0 and $date_type != null) $date_type = "هجري";

    $cop_place = $row['cop_place'];

    $signing = $row['signing'];
    if ($signing == 1) $signing = "موقعة";
    elseif ($signing == 0 and $signing != null) $signing = "بالمقارنة";

    $cabinet_name = $row['cabinet_name'];
    $cabinet_nbr = $row['cabinet_nbr'];
    $manu_type = $row['manu_type'];
    $index_nbr = $row['index_nbr'];
    $font = $row['font'];
    $font_style = $row['font_style'];

    $regular_lines = $row['regular_lines'];
    if ($regular_lines == 1) $regular_lines = "منتظمة";
    elseif ($regular_lines == 0 and $regular_lines != null) $regular_lines = "غير منتظمة";

    $lines_notes = $row['lines_notes'];

    $paper_size = $row['paper_size'];
    if ($paper_size == 1) $paper_size = "القطع الكبير";
    elseif ($paper_size == 2) $paper_size = "القطع المتوسط";
    else $paper_size = "القطع الصغير";

    // $ink_colors = $row['ink_colors'];
    // $inkColors_explode = explode(',', $ink_colors);

    $copied_from = $row['copied_from'];
    $copied_to = $row['copied_to'];
    $manu_level = $row['manu_level'];
    $cop_level = $row['cop_level'];

    $rost_completion = $row['rost_completion'];
    if ($rost_completion == 1) $rost_completion = "نعم";
    elseif ($rost_completion == 0 and $rost_completion != null) $rost_completion = "لا";

    $city_name = $row['city_name'];
    $count_name = $row['count_name'];
    $notes = $row['notes'];

    $creation_date = $row['creation_date'];
    $last_edit_date = $row['last_edit_date'];
}

// select manu copiers
$manuSubQry2 = "SELECT d_copiers.cop_id, full_name, name_in_manu, descent1, descent2, descent3, descent4, descent5, last_name, nickname, other_name1, other_name2, other_name3, other_name4, count_name, city_name
FROM d_copiers
INNER JOIN h_manuscripts_copiers ON h_manuscripts_copiers.cop_id = d_copiers.cop_id
LEFT JOIN countries ON countries.count_id = d_copiers.count_id
LEFT JOIN cities ON cities.city_id = d_copiers.city_id
WHERE h_manuscripts_copiers.manu_id = '$manu_id_get'";

$manuSubQry2Result = mysqli_query($conn, $manuSubQry2);

// select book authors
$manuSubQry3 = "SELECT c_authors.auth_id, auth_name
FROM c_authors
LEFT JOIN g_books_authors ON g_books_authors.auth_id = c_authors.auth_id
WHERE book_id = '$book_id'";

$manuSubQry3Result = mysqli_query($conn, $manuSubQry3);

// select book subjects
$manuSubQry4 = "SELECT b_subjects.subj_id, subj_name
FROM b_subjects
LEFT JOIN f_books_subjects ON f_books_subjects.subj_id = b_subjects.subj_id
WHERE book_id = '$book_id'";

$manuSubQry4Result = mysqli_query($conn, $manuSubQry4);

// select copiers fm
$manuSubQry5 = "SELECT i_cop_fm.cop_id, cop_fm, full_name
FROM i_cop_fm
INNER JOIN d_copiers ON i_cop_fm.cop_fm = d_copiers.cop_id
WHERE manu_id = $manu_id_get";

$manuSubQry5Result = mysqli_query($conn, $manuSubQry5);

// select manu motifs
$manuSubQry6 = "SELECT motif_name
FROM e_manuscripts
INNER JOIN j_manuscripts_motifs ON e_manuscripts.manu_id = j_manuscripts_motifs.manu_id
INNER JOIN d_motifs ON j_manuscripts_motifs.motif_id = d_motifs.motif_id
WHERE e_manuscripts.manu_id = '$manu_id_get'";
$manuSubQry6Result = mysqli_query($conn, $manuSubQry6);

// select manu colors
$manuSubQry7 = "SELECT color_name
FROM e_manuscripts
INNER JOIN j_manuscripts_colors ON e_manuscripts.manu_id = j_manuscripts_colors.manu_id
INNER JOIN d_colors ON j_manuscripts_colors.color_id = d_colors.color_id
WHERE e_manuscripts.manu_id = '$manu_id_get'";
$manuSubQry7Result = mysqli_query($conn, $manuSubQry7);


// select manu Types
$manuSubQry8 = "SELECT type_name
FROM e_manuscripts
INNER JOIN j_manuscripts_manuTypes ON e_manuscripts.manu_id = j_manuscripts_manuTypes.manu_id
INNER JOIN d_manuTypes ON j_manuscripts_manuTypes.type_id = d_manuTypes.type_id
WHERE e_manuscripts.manu_id = '$manu_id_get'";
$manuSubQry8Result = mysqli_query($conn, $manuSubQry8);


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
                    <h4>معلومات الاستمارة</h4>
                </div>
                <form action="" method="post">

                    <?php
                    $ci = 0;
                    while ($row = mysqli_fetch_array($manuSubQry2Result)) {
                        $ci++;
                    ?>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">معلومات الناسخ <?php if ($ci > 1) echo $ci ?></legend>
                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">الرقم: </h5>
                            </div>
                            <div class="col-md-1">
                                <p><?php echo $row['cop_id'] ?></p>
                            </div>
                            <div class="col-md-auto">
                                <h5 class="text-danger">الاسم الكامل: </h5>
                            </div>
                            <div class="col-md-7">
                                <p><?php echo $row['full_name'] ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">الاسم الوارد في النسخة: </h5>
                            </div>
                            <div class="col-md-auto">
                                <p><?php echo $row['name_in_manu'] ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">النسبة (1): </h5>
                            </div>
                            <div class="col-md-2">
                                <?php if ($row['descent1']) { ?>
                                <p><?php echo $row['descent1']; ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                            <div class="col-md-auto">
                                <h5 class="text-danger">النسبة (2): </h5>
                            </div>
                            <div class="col-md-2">
                                <?php if ($row['descent2']) { ?>
                                <p><?php echo $row['descent2']; ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                            <div class="col-md-auto">
                                <h5 class="text-danger">النسبة (3): </h5>
                            </div>
                            <div class="col-md-2">
                                <?php if ($row['descent3']) { ?>
                                <p><?php echo $row['descent3']; ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">النسبة (4): </h5>
                            </div>
                            <div class="col-md-2">
                                <?php if ($row['descent4']) { ?>
                                <p><?php echo $row['descent4']; ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>

                            <div class="col-md-auto">
                                <h5 class="text-danger">النسبة (5): </h5>
                            </div>
                            <div class="col-md-2">
                                <?php if ($row['descent5']) { ?>
                                <p><?php echo $row['descent5']; ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">اللقب (اسم الشهرة): </h5>
                            </div>
                            <div class="col-md-3">
                                <?php if ($row['last_name']) { ?>
                                <p><?php echo $row['last_name']; ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                            <div class="col-md-auto">
                                <h5 class="text-danger">الكنية (5): </h5>
                            </div>
                            <div class="col-md-2">
                                <?php if ($row['nickname']) { ?>
                                <p><?php echo $row['nickname']; ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">بلد الناسخ: </h5>
                            </div>
                            <div class="col-md-4">
                                <?php if ($row['count_name']) { ?>
                                <p><?php echo $row['count_name']; ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                            <div class="col-md-auto">
                                <h5 class="text-danger">مدينة الناسخ: </h5>
                            </div>
                            <div class="col-md-4">
                                <?php if ($row['city_name']) { ?>
                                <p><?php echo $row['city_name']; ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <?php if ($row['other_name1'] != "") { ?>
                        <div class="row">
                            <div class="col-md-3">
                                <h5 class="text-danger">صيغ أخرى لاسم الناسخ: </h5>
                            </div>
                            <div class="col-md-auto">
                                <p><?php echo $row['other_name1'] ?></p>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if ($row['other_name2'] != "") { ?>
                        <div class="row">
                            <div class="col-md-3">
                                <h5 class="text-danger"></h5>
                            </div>
                            <div class="col-md-auto">
                                <p><?php echo $row['other_name2'] ?></p>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if ($row['other_name3'] != "") { ?>
                        <div class="row">
                            <div class="col-md-3">
                                <h5 class="text-danger"></h5>
                            </div>
                            <div class="col-md-auto">
                                <p><?php echo $row['other_name3'] ?></p>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if ($row['other_name4'] != "") { ?>
                        <div class="row">
                            <div class="col-md-3">
                                <h5 class="text-danger"></h5>
                            </div>
                            <div class="col-md-auto">
                                <p><?php echo $row['other_name4'] ?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </fieldset>
                    <?php } ?>


                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">معلومات النسخة</legend>
                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">الرقم: </h5>
                            </div>
                            <div class="col-md-1">
                                <p><?php echo $manu_id ?></p>
                            </div>
                            <div class="col-md-auto">
                                <h5 class="text-danger">عنوان الكتاب: </h5>
                            </div>
                            <div class="col-md-auto">
                                <p><?php echo $book_title ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <h5 class="text-danger">المؤلفين: </h5>
                            </div>

                            <?php if (mysqli_num_rows($manuSubQry3Result) == 0) { ?>
                            <div class="col-md-auto">
                                <p class="text-success">/ / /</p>
                            </div>

                            <?php } else {
                                $i = 0;
                                while ($row = mysqli_fetch_array($manuSubQry3Result)) {
                                    $i++;

                                ?>
                            <?php if ($i == 1) { ?>
                            <div class="col-md-10">
                                <p><?php echo $row['auth_name'] ?></p>
                            </div>
                            <?php } else { ?>
                            <div class="col-md-2">
                                <p class="text-success"></p>
                            </div>
                            <div class="col-md-10">
                                <p><?php echo $row['auth_name'] ?></p>
                            </div>
                            <?php } ?>
                            <?php }
                            } ?>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <h5 class="text-danger">المواضيع: </h5>
                            </div>

                            <?php if (mysqli_num_rows($manuSubQry4Result) == 0) { ?>
                            <div class="col-md-auto">
                                <p class="text-success">/ / /</p>
                            </div>

                            <?php } else {
                                while ($row = mysqli_fetch_array($manuSubQry4Result)) {
                                ?>
                            <div class="col-md-auto">
                                <p><?php echo $row['subj_name'] .  ' /' ?></p>
                            </div>
                            <?php }
                            } ?>
                        </div>

                        <div class="row">
                            <?php if ($cop_syear == $cop_eyear) { ?>
                            <div class="col-md-2">
                                <h5 class="text-danger">تاريخ النسخ: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($cop_day or $cop_day_nbr or $cop_month or $cop_syear or $cop_eyear) { ?>
                                <p>
                                    <?php echo $cop_day . ' ' . $cop_day_nbr . ' ' . $cop_month . ' ' . $cop_syear . ' / ' . $date_type  ?>
                                </p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>

                            <?php } else { ?>
                            <div class="col-md-2">
                                <h5 class="text-danger">فترة النسخ: </h5>
                            </div>
                            <div class="col-md-auto">
                                <p>
                                    <?php echo ' من سنة: ' . $cop_syear . ' إلى سنة: ' . $cop_eyear . ' / ' . $date_type  ?>
                                </p>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">مكان النسخ: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($cop_place) { ?>
                                <p><?php echo $cop_place ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                            <div class="col-md-auto">
                                <h5 class="text-danger">المدينة: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($city_name) { ?>
                                <p><?php echo $city_name ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                            <div class="col-md-auto">
                                <h5 class="text-danger">البلد حاليا: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($count_name) { ?>
                                <p><?php echo $count_name ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">نوع النسخة: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($signing) { ?>
                                <p><?php echo $signing ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">اسم الخزانة: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($cabinet_name) { ?>
                                <p><?php echo $cabinet_name ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                            <div class="col-md-auto">
                                <h5 class="text-danger">الرقم في الخزانة: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($cabinet_nbr or $manu_type) { ?>
                                <p><?php echo $cabinet_nbr;
                                        if ($manu_type != "مج") echo ' ' . $manu_type ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                            <div class="col-md-auto">
                                <h5 class="text-danger">الرقم في الفهرس: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($index_nbr) { ?>
                                <p><?php echo $index_nbr ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <h5 class="my_line"><span>تفاصيل النسخة</span></h5>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">الخط: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($font) { ?>
                                <p><?php echo $font ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>

                            <div class="col-md-auto">
                                <h5 class="text-danger">نوعه: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($font_style) { ?>
                                <p><?php echo $font_style ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">مقاس الورق: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($paper_size) { ?>
                                <p><?php echo $paper_size ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">نوع المسطرة: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($regular_lines) { ?>
                                <p><?php echo $regular_lines; ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>

                            <div class="col-md-auto">
                                <h5 class="text-danger">ملاحظات على المسطرة: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($lines_notes) { ?>
                                <p><?php echo $lines_notes ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">نوع الزخارف: </h5>
                            </div>
                            <?php if (mysqli_num_rows($manuSubQry6Result) == 0) { ?>
                            <div class="col-md-auto">
                                <p class="text-success">/ / /</p>
                            </div>
                            <?php } ?>
                            <div class="col-md-auto">
                                <p><?php
                                    while ($row = mysqli_fetch_array($manuSubQry6Result)) {
                                        echo $row['motif_name'] . ' / ';
                                    } ?>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">ألوان الحبر: </h5>
                            </div>
                            <?php if (mysqli_num_rows($manuSubQry7Result) == 0) { ?>
                            <div class="col-md-auto">
                                <p class="text-success">/ / /</p>
                            </div>
                            <?php } ?>
                            <div class="col-md-auto">
                                <p><?php
                                    while ($row = mysqli_fetch_array($manuSubQry7Result)) {
                                        echo $row['color_name'] . ' / ';
                                    } ?>
                                </p>
                            </div>
                        </div>


                        <h5 class="my_line"><span>محتوى النسخة</span></h5>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">عمل الناسخ عدا نقل المحتوى: </h5>
                            </div>
                            <?php if (mysqli_num_rows($manuSubQry8Result) == 0) { ?>
                            <div class="col-md-auto">
                                <p class="text-success">/ / /</p>
                            </div>
                            <?php } ?>
                            <div class="col-md-auto">
                                <p><?php while ($row = mysqli_fetch_array($manuSubQry8Result)) {
                                        echo $row['type_name'] . ' / ';
                                    } ?>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">مستوى النسخة من حيث الجودة والضبط: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($manu_level) { ?>
                                <p><?php echo $manu_level; ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>


                        <h5 class="my_line"><span>الملاحظات</span></h5>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">الأصل المنسوخ منه: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($copied_from) { ?>
                                <p><?php echo $copied_from ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">المنسوخ له: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($copied_to) { ?>
                                <p><?php echo $copied_to ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <?php
                        if (mysqli_num_rows($manuSubQry5Result) > 0) {

                            while ($row = mysqli_fetch_array($manuSubQry5Result)) {
                                $cop_id = $row['cop_id'];
                                $cop_fm = $row['cop_fm'];
                                $fm_full_name = $row['full_name'];
                        ?>
                        <div class="row">
                            <div class="col-md-auto">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-danger text-center">رقم الناسخ (من الاستمارة
                                                أعلاه): </th>
                                            <th scope="col" class="text-danger">الناسخ المشابه له في الخط:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-center"><?php echo $cop_id ?></th>
                                            <td><?php echo '[ ' . $cop_fm . ' ] => ' . $fm_full_name ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php }
                        } ?>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">مستوى ضبط الناسخ: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($cop_level) { ?>
                                <p><?php echo $cop_level ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">ترميم وإتمام: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($rost_completion) { ?>
                                <p><?php echo $rost_completion ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-auto">
                                <h5 class="text-danger">ملاحظات أخرى: </h5>
                            </div>
                            <div class="col-md-auto">
                                <?php if ($notes) { ?>
                                <p><?php echo $notes ?></p>
                                <?php } else { ?>
                                <p class="text-success">/ / /</p>
                                <?php } ?>
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