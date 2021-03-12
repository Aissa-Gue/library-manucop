<?php
include 'header.php';

// GET values from clientsList.php
$manu_id_get = $_GET['manu_id'];

// select manu book / country / city ...
$manuSubQry1 = "SELECT e_manuscripts.manu_id, e_manuscripts.book_id, book_title, cop_name, 
cop_day, cop_month, cop_syear, cop_eyear, cop_place,
signing, cabinet_name, cabinet_nbr, manu_type, index_nbr,
font, font_style, regular_lines, lines_notes, paper_size, ink_colors, motifs, 
manu_types, copied_from, copied_to, manu_level, cop_level, rost_completion, city_name , count_name,
notes, e_manuscripts.creation_date, e_manuscripts.last_edit_date
FROM e_manuscripts
INNER JOIN a_books ON a_books.book_id = e_manuscripts.book_id
LEFT JOIN countries ON countries.count_id = e_manuscripts.count_id
LEFT JOIN cities ON cities.city_id = e_manuscripts.city_id 
WHERE e_manuscripts.manu_id = '$manu_id_get'";

$manuSubQry1Result = mysqli_query($conn, $manuSubQry1);

while ($row = mysqli_fetch_array($manuSubQry1Result)) {
    $manu_id = $row['manu_id'];

    $book_id = $row['book_id'];
    $book_title = $row['book_title'];

    $cop_name = $row['cop_name'];
    $cop_day = $row['cop_day'];
    $cop_month = $row['cop_month'];
    $cop_syear = $row['cop_syear'];
    $cop_eyear = $row['cop_eyear'];
    $cop_place = $row['cop_place'];

    $signing = $row['signing'];
    if ($signing == 1) $signing = "موقعة";
    else $signing = "بالمقارنة";

    $cabinet_name = $row['cabinet_name'];
    $cabinet_nbr = $row['cabinet_nbr'];
    $manu_type = $row['manu_type'];
    $index_nbr = $row['index_nbr'];
    $font = $row['font'];
    $font_style = $row['font_style'];

    $regular_lines = $row['regular_lines'];
    if ($regular_lines == 1) $regular_lines = "منتظمة";
    else $regular_lines = "غير منتظمة";

    $lines_notes = $row['lines_notes'];

    $paper_size = $row['paper_size'];
    if ($paper_size == 1) $paper_size = "القطع الكبير";
    elseif ($paper_size == 2) $paper_size = "القطع المتوسط";
    else $paper_size = "القطع الصغير";

    $ink_colors = $row['ink_colors'];
    $inkColors_explode = explode(',', $ink_colors);


    $motifs = $row['motifs'];
    $motifs_explode = explode(',', $motifs);

    $manu_types = $row['manu_types'];
    $manuTypes_explode = explode(',', $manu_types);

    $copied_from = $row['copied_from'];
    $copied_to = $row['copied_to'];
    $manu_level = $row['manu_level'];
    $cop_level = $row['cop_level'];

    $rost_completion = $row['rost_completion'];
    if ($rost_completion == 1) $rost_completion = "نعم";
    else $rost_completion = "لا";

    $city_name = $row['city_name'];
    $count_name = $row['count_name'];
    $notes = $row['notes'];

    $creation_date = $row['creation_date'];
    $last_edit_date = $row['last_edit_date'];
}

// select all manu copiers
$manuSubQry2 = "SELECT d_copiers.cop_id, full_name
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
$manuSubQry5 = "SELECT cop_fm, full_name
FROM d_copiers
LEFT JOIN i_cop_fm ON i_cop_fm.cop_fm = d_copiers.cop_id
WHERE manu_id = '$manu_id_get'";

$manuSubQry5Result = mysqli_query($conn, $manuSubQry5);


?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Form</title>
</head>

<body class="my_bg">

    <!-- START row -->
    <div class="container-fluid">
        <div class="row">

            <?php include "sideBar.php" ?>

            <div class="col-10 my_mr_sidebar pt-3">

                <div class="alert alert-primary text-center" role="alert">
                    <h4>معلومات الاستمارة</h4>
                </div>
                <form action="" method="post">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">معلومات الناسخ</legend>
                        <div class="form-row">
                            <div class="form-group col-md-7">
                                <label for="full_name">اسم الناسخ</label>
                                <?php
                                while ($row = mysqli_fetch_array($manuSubQry2Result)) {
                                    $cop_id = $row['cop_id'];
                                    $full_name = $row['full_name'];
                                ?>
                                <input type="text" class="form-control mb-2"
                                    value="<?php echo $cop_id . ' # ' . $full_name ?>" id="full_name">
                                <?php } ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">معلومات النسخة</legend>
                        <div class="form-row">
                            <div class="form-group col-md-auto">
                                <label for="manu_id">رقم الاستمارة</label>
                                <input type="number" class="form-control text-center" value="<?php echo $manu_id ?>"
                                    id="manu_id">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="cop_name">اسم الناسخ الوارد في النسخة</label>
                                <input type="text" class="form-control" id="cop_name" value="<?php echo $cop_name ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="title">عنوان الكتاب</label>
                                <input type="text" class="form-control" id="title" value="<?php echo $book_title ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="auth_name">المؤلفين</label>
                                <?php
                                while ($row = mysqli_fetch_array($manuSubQry3Result)) {
                                    $auth_id = $row['auth_id'];
                                    $auth_name = $row['auth_name'];
                                ?>
                                <input type="text" class="form-control mb-2" id="auth_name"
                                    value="<?php echo $auth_id . ' # ' . $auth_name ?>">
                                <?php } ?>
                            </div>
                        </div>

                        <label for="subj_name">المواضيع</label>
                        <div class="form-row">
                            <?php
                            while ($row = mysqli_fetch_array($manuSubQry4Result)) {
                                $subj_id = $row['subj_id'];
                                $subj_name = $row['subj_name'];
                            ?>
                            <div class="form-group col-md-auto">
                                <input type="text" class="form-control mb-2" id="subj_name"
                                    value="<?php echo $subj_name ?>">
                            </div>
                            <?php } ?>
                        </div>

                        <div class="form-row" id="cop_date">
                            <?php if ($cop_syear == $cop_eyear) { ?>
                            <div class="form-group col-md-2">
                                <label for="cop_day">تاريخ النسخ</label>
                                <input type="text" class="form-control" id="cop_day" value="<?php echo $cop_day ?>"
                                    readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cop_month">&nbsp;</label>
                                <input type="text" class="form-control" id="cop_month" value="<?php echo $cop_month ?>"
                                    readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cop_syear">&nbsp;</label>
                                <input type="number" class="form-control" id="cop_syear"
                                    value="<?php echo $cop_syear ?>" readonly>
                            </div>
                            <?php } else { ?>
                            <div class="form-group col-md-2">
                                <label for="cop_day">فترة النسخ ( بالتقدير )</label>
                                <input type="text" class="form-control" id="cop_day"
                                    value="<?php echo $cop_syear . ' - ' . $cop_eyear ?>" readonly>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cop_place">مكان النسخ</label>
                                <input type="text" class="form-control" id="cop_place" value="<?php echo $cop_place ?>"
                                    readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="city_name">المدينة</label>
                                <input type="text" class="form-control" id="city_name" value="<?php echo $city_name ?>"
                                    readonly>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="count_name">البلد حاليا</label>

                                <input type="text" class="form-control" id="count_name"
                                    value="<?php echo $count_name ?>" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="signing">موقعة أو بالمقارنة</label>
                                <input type="text" class="form-control" id="signing" value="<?php echo $signing ?>"
                                    readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cabinet_name">اسم الخزانة</label>
                                <input type="text" class="form-control" id="cabinet_name"
                                    value="<?php echo $cabinet_name ?>" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cabinet_nbr">الرقم في الخزانة</label>
                                <input type="text" class="form-control" id="cabinet_nbr"
                                    value="<?php echo $cabinet_nbr . ' ' . $manu_type ?>" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="index_nbr">الرقم في الفهرس</label>
                                <input type="text" class="form-control" id="index_nbr" value="<?php echo $index_nbr ?>"
                                    readonly>
                            </div>
                        </div>

                        <h5 class="my_line"><span>تفاصيل النسخة</span></h5>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="font">الخط</label>
                                <input type="text" class="form-control" id="font" value="<?php echo $font ?>" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="font_style">نوع الخط</label>
                                <input type="text" class="form-control" id="font_style"
                                    value="<?php echo $font_style ?>" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="regular_lines">نوع المسطرة</label>
                                <input type="text" class="form-control" id="regular_lines"
                                    value="<?php echo $regular_lines ?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lines_notes">ملاحظات على المسطرة</label>
                                <input type="text" class="form-control" id="lines_notes"
                                    value="<?php echo $lines_notes ?>" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="paper_size">مقاس الورق</label>
                                <input type="text" class="form-control" id="paper_size"
                                    value="<?php echo $paper_size ?>" readonly>
                            </div>
                        </div>

                        <label for="motifs">الزخارف</label><br>
                        <div class="form-row">
                            <?php
                            for ($i = 0; $i < sizeof($motifs_explode) - 1; $i++) {
                            ?>
                            <div class="form-group col-md-auto">
                                <input type="text" class="form-control" id="motifs"
                                    value="<?php echo $motifs_explode[$i]; ?>" readonly>
                            </div>
                            <?php } ?>
                        </div>

                        <label for="ink_colors">ألوان الحبر</label><br>
                        <div class="form-row">
                            <?php
                            for ($i = 0; $i < sizeof($inkColors_explode) - 1; $i++) {
                            ?>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="ink_colors"
                                    value="<?php echo $inkColors_explode[$i]; ?>" readonly>
                            </div>
                            <?php } ?>
                        </div>

                        <h5 class="my_line"><span>محتوى النسخة</span></h5>

                        <label for="manu_types">عمل الناسخ عدا نقل المحتوى</label><br>
                        <div class="form-row">
                            <?php
                            for ($i = 0; $i < sizeof($manuTypes_explode) - 1; $i++) {
                            ?>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="manu_types"
                                    value="<?php echo $manuTypes_explode[$i]; ?>" readonly>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="form-row mt-4">
                            <div class="form-group col-md-auto">
                                <label for="manu_level">مستوى النسخة من حيث الجودة والضبط</label>
                                <input type="text" class="form-control" id="manu_level"
                                    value="<?php echo $manu_level ?>" readonly>
                            </div>
                        </div>

                        <h5 class="my_line"><span>الملاحظات</span></h5>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="copied_from">الأصل المنسوخ منه</label>
                                <input type="text" class="form-control" id="copied_from"
                                    value="<?php echo $copied_from ?>" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="copied_to">المنسوخ له</label>
                                <input type="text" class="form-control" id="copied_to" value="<?php echo $copied_to ?>"
                                    readonly>
                            </div>
                        </div>
                        <?php

                        if (mysqli_num_rows($manuSubQry5Result) > 0) {
                        ?>
                        <div class="form-row">
                            <div class="form-group col-md-auto">
                                <label for="cop_match">رقم الناسخ (من الاستمارة أعلاه)</label>
                                <?php
                                    // redefine
                                    $manuSubQry2Result = mysqli_query($conn, $manuSubQry2);
                                    while ($row = mysqli_fetch_array($manuSubQry2Result)) {
                                        $cop_id = $row['cop_id'];
                                        $full_name = $row['full_name'];
                                    ?>
                                <input type="text" class="form-control text-center mb-2" value="<?php echo $cop_id ?>"
                                    id="cop_match" readonly>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-7">
                                <label for="cop_fm">تشابه خط الناسخ بغيره من الناسخين</label>
                                <?php
                                    while ($rowFm = mysqli_fetch_array($manuSubQry5Result)) {
                                        $full_nameFm = $rowFm['full_name'];
                                    ?>
                                <input type="text" class="form-control mb-2" id="cop_fm"
                                    value="<?php echo $full_nameFm ?>" readonly>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="cop_level">مستوى ضبط الناسخ</label>
                                <input type="text" class="form-control" id="cop_level" value="<?php echo $cop_level ?>"
                                    readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="rost_completion">ترميم وإتمام</label>
                                <input type="text" class="form-control" id="rost_completion"
                                    value="<?php echo $rost_completion ?>" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-7">
                                <label for="notes">ملاحظات أخرى</label>
                                <textarea class="form-control" name="notes" id="notes" rows="3"
                                    readonly><?php echo $notes ?></textarea>
                            </div>
                        </div>
                    </fieldset>
                </form>
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