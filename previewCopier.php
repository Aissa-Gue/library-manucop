<?php
include 'check.php';
include 'header.php';

// GET values from clientsList.php
$cop_id_get = $_GET['cop_id'];

// Search query
$searchQry = "SELECT *
FROM d_copiers
LEFT JOIN countries ON countries.count_id = d_copiers.count_id
LEFT JOIN cities ON cities.city_id = d_copiers.city_id 
WHERE cop_id = '$cop_id_get'";

$searchResult = mysqli_query($conn, $searchQry);
while ($row = mysqli_fetch_array($searchResult)) {
    $cop_id = $row['cop_id'];

    $creation_date = $row['creation_date'];
    $last_edit_date = $row['last_edit_date'];
    $full_name = $row['full_name'];

    $descent1 = $row['descent1'];
    $descent2 = $row['descent2'];
    $descent3 = $row['descent3'];
    $descent4 = $row['descent4'];
    $descent5 = $row['descent5'];

    $last_name = $row['last_name'];
    $nickname = $row['nickname'];

    $other_name1 = $row['other_name1'];
    $other_name2 = $row['other_name2'];
    $other_name3 = $row['other_name3'];
    $other_name4 = $row['other_name4'];

    $city = $row['city_name'];
    $country = $row['count_name'];
}

// MIN and MAX cop year
$minMaxCopYearQry = "SELECT min(cop_syear) as min_cop_year, MAX(cop_eyear) as max_cop_year 
FROM e_manuscripts
INNER JOIN h_manuscripts_copiers ON e_manuscripts.manu_id = h_manuscripts_copiers.manu_id
WHERE h_manuscripts_copiers.cop_id = '$cop_id_get'";

$minMaxCopYearResult = mysqli_query($conn, $minMaxCopYearQry);
while ($row = mysqli_fetch_array($minMaxCopYearResult)) {
    $min_cop_year = $row['min_cop_year'];
    $max_cop_year = $row['max_cop_year'];
}

// Copier manuscripts List
$copierManuListQry = "SELECT e_manuscripts.manu_id, book_title
FROM ((e_manuscripts
INNER JOIN h_manuscripts_copiers
ON e_manuscripts.manu_id = h_manuscripts_copiers.manu_id)
INNER JOIN a_books
ON e_manuscripts.book_id = a_books.book_id)
WHERE h_manuscripts_copiers.cop_id = $cop_id_get";

// Copier fm List
$copierFmListQry = "SELECT i_cop_fm.cop_id, i_cop_fm.cop_fm, full_name, i_cop_fm.manu_id
FROM i_cop_fm
INNER JOIN d_copiers
ON d_copiers.cop_id = i_cop_fm.cop_fm
INNER JOIN h_manuscripts_copiers 
ON h_manuscripts_copiers.cop_id = i_cop_fm.cop_id
WHERE i_cop_fm.cop_id= $cop_id_get
GROUP BY i_cop_fm.manu_id";


?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $ProjTitle ?></title>
</head>

<body class="my_bg">
    <div class="container-fluid mt-5">
        <?php include "sideBar.php" ?>

        <div class="col-10 my_mr_sidebar pt-3">
            <div class="alert alert-warning text-center h4" role="alert">
                معلومات الناسخ
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <!-- 1st row -->
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="cop_id" class="form-label">رقم الناسخ</label>
                        <input type="text" class="form-control text-center" value="<?php echo $cop_id ?>" id="cop_id"
                            readonly>
                    </div>
                    <div class="col-md-auto">
                        <label for="creation_date" class="form-label">تاريخ الإنشاء</label>
                        <input type="text" class="form-control" value="<?php echo $creation_date ?>" id="creation_date"
                            readonly>
                    </div>
                    <div class="col-md-auto">
                        <label for="last_edit_date" class="form-label">تاريخ آخر تعديل</label>
                        <input type="text" class="form-control" value="<?php echo $last_edit_date ?>"
                            id="last_edit_date" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="min_cop_year" class="form-label">أقدم سنة نسخ</label>
                        <input type="text" class="form-control" value="<?php echo $min_cop_year ?>" id="min_cop_year"
                            readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="max_cop_year" class="form-label">أحدث سنة نسخ</label>
                        <input type="text" class="form-control" value="<?php echo $max_cop_year ?>" id="max_cop_year"
                            readonly>
                    </div>
                </div>
                <!-- 2nd row -->
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="full_name" class="form-label">الإسم الكامل</label>
                        <input type="text" class="form-control" value="<?php echo $full_name ?>" id="full_name"
                            readonly>
                    </div>
                    <div class="col-md-auto">
                        <label for="last_name" class="form-label">اللقب (اسم الشهرة)</label>
                        <input type="text" class="form-control" value="<?php echo $last_name ?>" id="last_name"
                            readonly>
                    </div>
                    <div class="col-md-auto">
                        <label for="nickname" class="form-label">الكنية</label>
                        <input type="text" class="form-control" value="<?php echo $nickname ?>" id="nickname" readonly>
                    </div>
                </div>
                <!-- 3rd row -->
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="descent1" class="form-label">النسبة 1</label>
                        <input type="text" class="form-control" value="<?php echo $descent1 ?>" id="descent1" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="descent2" class="form-label">النسبة 2</label>
                        <input type="text" class="form-control" value="<?php echo $descent2 ?>" id="descent2" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="descent3" class="form-label">النسبة 3</label>
                        <input type="text" class="form-control" value="<?php echo $descent3 ?>" id="descent3" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="descent4" class="form-label">النسبة 4</label>
                        <input type="text" class="form-control" value="<?php echo $descent4 ?>" id="descent4" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="descent5" class="form-label">النسبة 5</label>
                        <input type="text" class="form-control" value="<?php echo $descent5 ?>" id="descent5" readonly>
                    </div>
                </div>

                <!-- 4th row -->
                <div class="row mt-3">
                    <div class="col-md-7">
                        <label for="other_name1" class="form-label">الصيغ الأخرى لاسم الناسخ</label>
                        <input type="text" class="form-control" value="<?php echo $other_name1 ?>" id="other_name1"
                            readonly>
                        <input type="text" class="form-control mt-1" value="<?php echo $other_name2 ?>" id="other_name2"
                            readonly>
                        <input type="text" class="form-control mt-1" value="<?php echo $other_name3 ?>" id="other_name3"
                            readonly>
                        <input type="text" class="form-control mt-1" value="<?php echo $other_name4 ?>" id="other_name4"
                            readonly>
                    </div>
                    <div class="col-md-3 mt-4">
                        <label for="city" class="form-label">المدينة</label>
                        <input type="text" class="form-control" value="<?php echo $city ?>" id="city" readonly>

                        <div class="mt-3"></div>
                        <label for="country" class="form-label">البلد</label>
                        <input type="text" class="form-control" value="<?php echo $country ?>" id="country" readonly>
                    </div>
                </div>

                <button type="submit" onclick="scrollWin()" name="copManuList" class="btn btn-info mt-3 mb-3">عرض قائمة
                    المنسوخات </button>
                <button type="submit" onclick="scrollWin()" name="copFmList" class="btn btn-info mt-3 mb-3">عرض
                    النساخ المشابهين له في الخط </button>
            </form>

            <!-- copier manuscripts LIST -->
            <?php if (isset($_POST['copManuList'])) { ?>
            <div class="row">
                <table class="table table-striped col-md-10">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">رقم الاستمارة</th>
                            <th scope="col">عنوان الكتاب</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $copierManuListResult = mysqli_query($conn, $copierManuListQry);
                            if (mysqli_num_rows($copierManuListResult) > 0) {
                                while ($row = mysqli_fetch_array($copierManuListResult)) {
                            ?>
                        <tr>
                            <th scope="row" class="text-center"><?php echo $row['manu_id'] ?></th>

                            <td>
                                <a
                                    href="previewForm.php?manu_id=<?php echo $row['manu_id'] ?>"><?php echo $row['book_title'] ?></a>
                            </td>
                        </tr>
                        <?php }
                            } else {
                                echo '<th scope="row"></th><td>لا توجد منسوخات لهذا الناسخ</td>';
                            } ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>
            <!-- END copier manuscripts LIST -->

            <!-- copier Fm LIST -->
            <?php if (isset($_POST['copFmList'])) { ?>
            <div class="row">
                <table class="table table-striped col-md-10">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">رقم الناسخ المشابه</th>
                            <th scope="col">اسم الناسخ</th>
                            <th scope="col" class="text-center">التشابه في الاستمارة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $copierFmListResult = mysqli_query($conn, $copierFmListQry);
                            if (mysqli_num_rows($copierFmListResult) > 0) {
                                while ($row = mysqli_fetch_array($copierFmListResult)) {
                            ?>
                        <tr>
                            <th scope="row" class="text-center"><?php echo $row['cop_fm'] ?></th>
                            <td>
                                <a
                                    href="previewCopier.php?cop_id=<?php echo $row['cop_fm'] ?>"><?php echo $row['full_name'] ?></a>
                            </td>

                            <th scope="row" class="text-center">
                                <a href="previewForm.php?manu_id=<?php echo $row['manu_id'] ?>">
                                    <?php echo $row['manu_id'] ?></a>
                            </th>
                        </tr>
                        <?php }
                            } else {
                                echo '<th scope="row"></th><td>لا يوجد نساخ مشابهين له في الخط</td><td></td>';
                            } ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>
            <!-- END copier Fm LIST -->

            <button type="button" class="my_fixed_button1 my_col_btn btn btn-danger btn-lg rounded-pill"
                onclick="window.history.go(-1);">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                </svg>
                رجوع
            </button>

        </div>
    </div>
    <script src="js/main.js"></script>
</body>

</html>