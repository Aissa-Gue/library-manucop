<?php
include 'header.php';
include 'lists.php';

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
$manuSubQry5 = "SELECT i_cop_fm.cop_id, cop_fm, full_name
FROM i_cop_fm
INNER JOIN d_copiers ON i_cop_fm.cop_fm = d_copiers.cop_id
WHERE manu_id = $manu_id_get";

$manuSubQry5Result = mysqli_query($conn, $manuSubQry5);


?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form</title>
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
                                $a = 1;
                                while ($row = mysqli_fetch_array($manuSubQry2Result)) {
                                    $cop_id = $row['cop_id'];
                                    $full_name = $row['full_name'];
                                ?>
                                <div class="input-group mb-2">
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
                                        placeholder="أدخل ناسخ">
                                    <datalist id="copiers">
                                        <?php
                                            for ($i = 0; $i <= $lastKey; $i++) { ?>
                                        <option
                                            value="<?php print_r($rows[$i]['cop_id']) ?> # <?php print_r($rows[$i]['full_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                                <?php $a++;
                                } ?>

                                <!-- add input if nbr of copiers under 4  -->
                                <?php if ($a < 5) {
                                    for ($a; $a < 5; $a++) {
                                ?>
                                <input list="copiers" class="form-control mb-2" name="full_name<?php echo $a ?>"
                                    id="full_name" placeholder="أدخل ناسخ">
                                <datalist id="copiers">
                                    <?php
                                            for ($i = 0; $i <= $lastKey; $i++) { ?>
                                    <option
                                        value="<?php print_r($rows[$i]['cop_id']) ?> # <?php print_r($rows[$i]['full_name']); ?>">
                                        <?php  } ?>
                                </datalist>
                                <?php
                                    }
                                } ?>
                            </div><!-- form-group col-md-7 -->
                        </div><!-- END form-row -->

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
                                <label for="cop_name">اسم الناسخ الوارد في النسخة</label>
                                <input type="text" class="form-control" name="cop_name" id="cop_name"
                                    value="<?php echo $cop_name ?>" placeholder="أدخل اسم الناسخ كما ورد في النسخة">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="title">عنوان الكتاب</label>

                                <input list="books" class="form-control mb-2" name="book_title"
                                    value="<?php echo $book_id . ' # ' . $book_title ?>" id="title"
                                    placeholder="أدخل عنوان الكتاب" required>
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
                                <select name="cop_day" id="cop_day" class="form-control">
                                    <option value="">-أدخل اليوم-</option>
                                    <option value="<?php echo $cop_day ?>" selected><?php echo $cop_day ?></option>
                                    <?php for ($i = 0; $i <= 6; $i++) { ?>
                                    <option value="<?php echo $days[$i]; ?>"><?php echo $days[$i]; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cop_month">&nbsp;</label>
                                <select name="cop_month" id="cop_month" class="form-control">
                                    <option value="">-أدخل الشهر-</option>
                                    <option value="<?php echo $cop_month ?>" selected><?php echo $cop_month ?></option>
                                    <?php for ($i = 0; $i <= 11; $i++) { ?>
                                    <option value="<?php echo $months[$i]; ?>"><?php echo $months[$i]; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cop_syear">&nbsp;</label>
                                <input type="number" class="form-control" name="cop_syear" id="cop_syear"
                                    placeholder="أدخل السنة" value="<?php echo $cop_syear ?>">
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
                            <?php } ?>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cop_place">مكان النسخ</label>
                                <input type="text" class="form-control" id="cop_place" value="<?php echo $cop_place ?>">
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
                                <select name="signing" id="signing" class="form-control">
                                    <option value="">-اختر نوع النسخة-</option>
                                    <option value="<?php echo $signing ?>" selected><?php echo $signing ?></option>
                                    <option value="1">موقعة</option>
                                    <option value="0">بالمقارنة</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cabinet_name">اسم الخزانة</label>
                                <select name="cabinet_name" id="cabinet_name" class="form-control">
                                    <option value="">-أدخل اسم الخزانة-</option>
                                    <option value="<?php echo $cabinet_name ?>" selected>
                                        <?php echo $cabinet_name ?>
                                    </option>
                                    <?php for ($i = 0; $i <= 3; $i++) { ?>
                                    <option value="<?php echo $cabinet_names[$i]; ?>">
                                        <?php echo $cabinet_names[$i]; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cabinet_nbr">الرقم في الخزانة</label>
                                <input type="text" class="form-control" name="cabinet_nbr" id="cabinet_nbr"
                                    value="<?php echo $cabinet_nbr ?>">
                            </div>
                            <div class="form-group col-md-auto">
                                <label for="manu_type">نوع النسخة</label>
                                <select name="manu_type" id="manu_type" class="form-control">
                                    <option value="">-أدخل نوع النسخة-</option>
                                    <option value="<?php echo $manu_type ?>" selected><?php echo $manu_type ?></option>
                                    <option value="">مجلد</option>
                                    <option value="مص">مصحف</option>
                                    <option value="دغ">دون غلاف</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="index_nbr">الرقم في الفهرس</label>
                                <input type="text" class="form-control" name="index_nbr" id="index_nbr"
                                    value="<?php echo $index_nbr ?>">
                            </div>
                        </div>

                        <h5 class="my_line"><span>تفاصيل النسخة</span></h5>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="font">الخط</label>
                                <select name="font" id="font" class="form-control">
                                    <option value="">- اختر خط -</option>
                                    <option value="<?php echo $font ?>" selected><?php echo $font ?></option>
                                    <option value="مغربي">مغربي</option>
                                    <option value="مشرقي">مشرقي</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="font_style">نوع الخط</label>
                                <select name="font_style" id="font_style" class="form-control">
                                    <option value="">- اختر نوع الخط -</option>
                                    <option value="<?php echo $font_style ?>" selected>
                                        <?php echo $font_style ?>
                                    </option>
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
                                    <option value="">- اختر نوع المسطرة -</option>
                                    <option value="<?php echo $regular_lines ?>" selected>
                                        <?php echo $regular_lines ?>
                                    </option>
                                    <option value="1">منتظمة</option>
                                    <option value="0">غير منتظمة</option>
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
                                <select name="paper_size" id="paper_size" class="form-control">
                                    <option value="">- اختر مقاس الورق -</option>
                                    <option value="<?php echo $paper_size ?>" selected>
                                        <?php echo $paper_size ?>
                                    </option>
                                    <option value="1">القطع الكبير</option>
                                    <option value="2">القطع المتوسط</option>
                                    <option value="3">القطع الصغير</option>
                                </select>
                            </div>
                        </div>

                        <label for="motifs">الزخارف</label><br>
                        <div class="form-row">
                            <?php
                            for ($i = 0; $i < sizeof($motifs_explode) - 1; $i++) {
                            ?>
                            <div class="form-group col-md-auto">
                                <input type="text" class="form-control" id="motifs"
                                    value="<?php echo $motifs_explode[$i]; ?>">
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
                                    value="<?php echo $inkColors_explode[$i]; ?>">
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
                                    value="<?php echo $manuTypes_explode[$i]; ?>">
                            </div>
                            <?php } ?>
                        </div>

                        <div class="form-row mt-4">
                            <div class="form-group col-md-auto">
                                <label for="manu_level">مستوى النسخة من حيث الجودة والضبط</label>
                                <select name="manu_level" id="manu_level" class="form-control mt-2">
                                    <option value="">- اختر مستوى -</option>
                                    <option selected value="<?php echo $manu_level ?>">
                                        <?php echo $manu_level ?>
                                    </option>
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

                        <?php
                        if (mysqli_num_rows($manuSubQry5Result) > 0) {
                        ?>
                        <div class="form-row">
                            <div class="form-group col-md-auto">
                                <label for="cop_match">رقم الناسخ (من الاستمارة أعلاه)</label>
                            </div>

                            <div class="form-group col-md-9">
                                <label for="cop_fm">تشابه خط الناسخ بغيره من الناسخين</label>
                            </div>
                        </div>

                        <div class="form-row">
                            <?php
                                while ($row = mysqli_fetch_array($manuSubQry5Result)) {
                                    $cop_id = $row['cop_id'];
                                    $cop_fm = $row['cop_fm'];
                                    $fm_full_name = $row['full_name'];
                                ?>
                            <div class="form-group col-md-auto">
                                <input type="text" class="form-control text-center" value="<?php echo $cop_id ?>"
                                    id="cop_match">
                            </div>
                            =>
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" id="cop_fm"
                                    value="<?php echo $cop_fm . ' # ' . $fm_full_name ?>">
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="cop_level">مستوى ضبط الناسخ</label>
                                <input type="text" class="form-control" id="cop_level" value="<?php echo $cop_level ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="rost_completion">ترميم وإتمام</label>
                                <input type="text" class="form-control" id="rost_completion"
                                    value="<?php echo $rost_completion ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-7">
                                <label for="notes">ملاحظات أخرى</label>
                                <textarea class="form-control" name="notes" id="notes"
                                    rows="3"><?php echo $notes ?></textarea>
                            </div>
                        </div>
                    </fieldset>
                </form>
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