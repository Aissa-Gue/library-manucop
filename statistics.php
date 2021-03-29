<?php
include 'header.php';
// By Country
$byCountryQry = "SELECT COUNT(manu_id) as manu_nbr, count_name, e_manuscripts.count_id 
FROM e_manuscripts
LEFT JOIN countries ON countries.count_id = e_manuscripts.count_id
GROUP BY e_manuscripts.count_id
ORDER BY e_manuscripts.count_id DESC";

$byCountryResult = mysqli_query($conn, $byCountryQry);

// By City
$byCityQry = "SELECT COUNT(manu_id) as manu_nbr_city, city_name 
FROM e_manuscripts
LEFT JOIN cities ON cities.city_id = e_manuscripts.city_id
GROUP BY e_manuscripts.city_id
ORDER BY e_manuscripts.city_id DESC";

$byCityResult = mysqli_query($conn, $byCityQry);

// By Subject
$bySubjectQry = "SELECT COUNT(manu_id) as manu_nbr, subj_name 
FROM e_manuscripts
LEFT JOIN f_books_subjects ON e_manuscripts.book_id = f_books_subjects.book_id
LEFT JOIN b_subjects ON b_subjects.subj_id = f_books_subjects.subj_id
GROUP BY f_books_subjects.subj_id
ORDER BY f_books_subjects.subj_id DESC";

$bySubjectResult = mysqli_query($conn, $bySubjectQry);

// By Signing
$bySigningQry = "SELECT COUNT(manu_id) as manu_nbr, signing
FROM `e_manuscripts`
GROUP BY signing
ORDER BY signing DESC";

$bySigningResult = mysqli_query($conn, $bySigningQry);

// By Cabinet
$byCabinetQry = "SELECT COUNT(manu_id) as manu_nbr, cabinet_name
FROM `e_manuscripts`
LEFT JOIN `cabinets` ON e_manuscripts.cabinet_id = cabinets.cabinet_id
GROUP BY cabinet_name
ORDER BY cabinet_name DESC";

$byCabinetResult = mysqli_query($conn, $byCabinetQry);

// By paper size
$byPaperSizeQry = "SELECT COUNT(manu_id) as manu_nbr, paper_size
FROM `e_manuscripts`
GROUP BY paper_size
ORDER BY paper_size DESC";

$byPaperSizeResult = mysqli_query($conn, $byPaperSizeQry);

// By manu type
$byManuTypeQry = "SELECT COUNT(manu_id) as manu_nbr, manu_type
FROM `e_manuscripts`
GROUP BY manu_type
ORDER BY manu_type DESC";

$byManuTypeResult = mysqli_query($conn, $byManuTypeQry);

// By font
$byFontQry = "SELECT COUNT(manu_id) as manu_nbr, font
FROM `e_manuscripts`
GROUP BY font
ORDER BY font DESC";

$byFontResult = mysqli_query($conn, $byFontQry);

// By font style
$byFontStyleQry = "SELECT COUNT(manu_id) as manu_nbr, font_style
FROM `e_manuscripts`
GROUP BY font_style
ORDER BY font_style DESC";

$byFontStyleResult = mysqli_query($conn, $byFontStyleQry);

// By manu level
$byManuLevelQry = "SELECT COUNT(manu_id) as manu_nbr, manu_level
FROM `e_manuscripts`
GROUP BY manu_level
ORDER BY manu_level DESC";

$byManuLevelResult = mysqli_query($conn, $byManuLevelQry);

// By cop level
$byCopLevelQry = "SELECT COUNT(manu_id) as manu_nbr, cop_level
FROM `e_manuscripts`
GROUP BY cop_level
ORDER BY cop_level DESC";

$byCopLevelResult = mysqli_query($conn, $byCopLevelQry);

// By RostCompletion
$byRostCompletionQry = "SELECT COUNT(manu_id) as manu_nbr, rost_completion
FROM `e_manuscripts`
GROUP BY rost_completion
ORDER BY rost_completion DESC";

$byRostCompletionResult = mysqli_query($conn, $byRostCompletionQry);

$manuTotalNbrQry = "SELECT count(manu_id) as manu_total_nbr 
FROM e_manuscripts
GROUP BY manu_id";
$manuTotalNbrResult = mysqli_query($conn, $manuTotalNbrQry);
$manuTotalNbr = mysqli_num_rows($manuTotalNbrResult);

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
                <div class="tab-pane fade mt-3" id="statistics">

                    <div class="alert alert-info text-center" role="alert">
                        <h4>إحصائيات وتقارير</h4>
                    </div>

                    <div class="alert alert-warning text-center" role="alert">
                        <strong>عدد المنسوخات الإجمالي : </strong>
                        <strong class="text-danger"><?php echo $manuTotalNbr ?></strong>
                    </div>

                    <div class="row">
                        <div class="accordion col-md-6" id="accordion1">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#byCountryCity" aria-expanded="true">
                                            #1 حسب البلد والمدينة</button>
                                    </h2>
                                </div>

                                <div id="byCountryCity" class="collapse show" data-parent="#accordion1">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">البلد</th>
                                                    <th scope="col" class="text-center">عدد المنسوخات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($countryRows = mysqli_fetch_array($byCountryResult)) {
                                                    $count_id = $countryRows['count_id']; ?>
                                                <tr>
                                                    <th scope="row">
                                                        <a href="#byCity<?php echo $count_id ?>" data-toggle="collapse"
                                                            role="button" aria-expanded="false">
                                                            <?php
                                                                if ($countryRows['count_name'] == NULL) echo '(غير مصنف)';
                                                                else echo $countryRows['count_name']; ?>
                                                        </a>
                                                    </th>
                                                    <td class="text-center">
                                                        <?php echo $countryRows['manu_nbr'] ?>
                                                </tr>

                                                <?php
                                                    // By City
                                                    if ($countryRows['count_name'] == NULL) $count_idQry = "e_manuscripts.count_id IS NULL";
                                                    else $count_idQry = "e_manuscripts.count_id = '$count_id'";

                                                    $byCityQry = "SELECT COUNT(manu_id) as manu_nbr_city, city_name 
                                                        FROM e_manuscripts
                                                        LEFT JOIN cities ON cities.city_id = e_manuscripts.city_id
                                                        WHERE $count_idQry
                                                        GROUP BY e_manuscripts.city_id
                                                        ORDER BY e_manuscripts.city_id DESC";
                                                    $byCityResult = mysqli_query($conn, $byCityQry);

                                                    while ($cityRows = mysqli_fetch_array($byCityResult)) { ?>
                                                <tr id="byCity<?php echo $count_id ?>" class="collapse">
                                                    <td scope="row">
                                                        <?php
                                                                if ($cityRows['city_name'] == NULL) echo '- ' . ' (غير مصنف)';
                                                                else echo "- " . $cityRows['city_name']; ?>
                                                    </td>
                                                    <td><?php echo '[ ' . $cityRows['manu_nbr_city'] . ' ]' ?>
                                                    </td>
                                                </tr>
                                                <?php } //end city rows
                                                } //end country rows
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!--  END 1st CARD -->

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#byCabinet" aria-expanded="false">
                                            #2 حسب الخزانة
                                        </button>
                                    </h2>
                                </div>
                                <div id="byCabinet" class="collapse" data-parent="#accordion1">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">اسم الخزانة</th>
                                                    <th scope="col" class="text-center">عدد المنسوخات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($cabinetRows = mysqli_fetch_array($byCabinetResult)) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php
                                                            if ($cabinetRows['cabinet_name'] == NULL) echo '(غير مصنف)';
                                                            else echo $cabinetRows['cabinet_name']; ?>
                                                    </th>
                                                    <td class="text-center"><?php echo $cabinetRows['manu_nbr'] ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!--  END 2nd CARD -->

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#byManuType" aria-expanded="false">
                                            #3 حسب نوع النسخة
                                        </button>
                                    </h2>
                                </div>
                                <div id="byManuType" class="collapse" data-parent="#accordion1">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">نوع النسخة</th>
                                                    <th scope="col" class="text-center">عدد المنسوخات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($manuTypeRows = mysqli_fetch_array($byManuTypeResult)) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php
                                                            if ($manuTypeRows['manu_type'] == NULL) echo '(غير مصنف)';
                                                            elseif ($manuTypeRows['manu_type'] == "مص") echo 'مصحف';
                                                            elseif ($manuTypeRows['manu_type'] == "مج") echo 'مجلد';
                                                            elseif ($manuTypeRows['manu_type'] == "دغ") echo 'دون غلاف'; ?>
                                                    </th>
                                                    <td class="text-center"><?php echo $manuTypeRows['manu_nbr'] ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!--  END 3rd CARD -->

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#byManuLevel" aria-expanded="false">
                                            #4 حسب مستوى النسخة
                                        </button>
                                    </h2>
                                </div>
                                <div id="byManuLevel" class="collapse" data-parent="#accordion1">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">مستوى النسخة</th>
                                                    <th scope="col" class="text-center">عدد المنسوخات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($manuLevelRows = mysqli_fetch_array($byManuLevelResult)) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php
                                                            if ($manuLevelRows['manu_level'] == NULL) echo '(غير مصنف)';
                                                            else echo $manuLevelRows['manu_level']; ?>
                                                    </th>
                                                    <td class="text-center"><?php echo $manuLevelRows['manu_nbr'] ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!--  END 4th CARD -->

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#byCopLevel" aria-expanded="false">
                                            #5 حسب مستوى ضبط الناسخ
                                        </button>
                                    </h2>
                                </div>
                                <div id="byCopLevel" class="collapse" data-parent="#accordion1">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">مستوى ضبط الناسخ</th>
                                                    <th scope="col" class="text-center">عدد المنسوخات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($copLevelRows = mysqli_fetch_array($byCopLevelResult)) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php
                                                            if ($copLevelRows['cop_level'] == NULL) echo '(غير مصنف)';
                                                            else echo $copLevelRows['cop_level']; ?>
                                                    </th>
                                                    <td class="text-center"><?php echo $copLevelRows['manu_nbr'] ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!--  END 5th CARD -->
                        </div><!--  END Accourdion -->


                        <div class="accordion col-md-6" id="accordion2">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#bySubject" aria-expanded="true">
                                            #6 حسب المواضيع</button>
                                    </h2>
                                </div>

                                <div id="bySubject" class="collapse show" data-parent="#accordion2">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">الموضوع</th>
                                                    <th scope="col" class="text-center">عدد المنسوخات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($subjRows = mysqli_fetch_array($bySubjectResult)) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php
                                                            if ($subjRows['subj_name'] == NULL) echo '(غير مصنف)';
                                                            else echo $subjRows['subj_name']; ?>
                                                    </th>
                                                    <td class="text-center"><?php echo $subjRows['manu_nbr'] ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!--  END 6th CARD -->

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#byPaperSize" aria-expanded="false">
                                            #7 حسب مقاس الورق </button>
                                    </h2>
                                </div>
                                <div id="byPaperSize" class="collapse" data-parent="#accordion2">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">مقاس الورق</th>
                                                    <th scope="col" class="text-center">عدد المنسوخات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($paperSizeRows = mysqli_fetch_array($byPaperSizeResult)) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php
                                                            if ($paperSizeRows['paper_size'] == 1) echo "القطع الكبير";
                                                            elseif ($paperSizeRows['paper_size'] == 2) echo 'القطع المتوسط';
                                                            elseif ($paperSizeRows['paper_size'] == 3) echo 'القطع الصغير';
                                                            else echo '(غير مصنف)';
                                                            ?>
                                                    </th>
                                                    <td class="text-center"><?php echo $paperSizeRows['manu_nbr'] ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!--  END 7th CARD -->

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#byFont" aria-expanded="false">
                                            #8 حسب نوع الخط
                                        </button>
                                    </h2>
                                </div>
                                <div id="byFont" class="collapse" data-parent="#accordion2">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">نوع الخط</th>
                                                    <th scope="col" class="text-center">عدد المنسوخات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($fontRows = mysqli_fetch_array($byFontResult)) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php
                                                            if ($fontRows['font'] == NULL) echo '(غير مصنف)';
                                                            else echo $fontRows['font']; ?>
                                                    </th>
                                                    <td class="text-center"><?php echo $fontRows['manu_nbr'] ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!--  END 8th CARD -->

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#bySigning" aria-expanded="false">
                                            #9 حسب التوقيع
                                        </button>
                                    </h2>
                                </div>
                                <div id="bySigning" class="collapse" data-parent="#accordion2">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">نوع النسخة</th>
                                                    <th scope="col" class="text-center">عدد المنسوخات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($signingRows = mysqli_fetch_array($bySigningResult)) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php
                                                            if ($signingRows['signing'] == NULL) echo '(غير مصنف)';
                                                            elseif ($signingRows['signing'] == 1) echo 'موقعة';
                                                            elseif ($signingRows['signing'] == 0) echo 'بالمقارنة';
                                                            ?>
                                                    </th>
                                                    <td class="text-center"><?php echo $signingRows['manu_nbr'] ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!--  END 9th CARD -->

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#byRostCompletion"
                                            aria-expanded="false">
                                            #10 حسب الترميم والإتمام
                                        </button>
                                    </h2>
                                </div>
                                <div id="byRostCompletion" class="collapse" data-parent="#accordion2">
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">نوع النسخة</th>
                                                    <th scope="col" class="text-center">عدد المنسوخات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($rostCompletionRows = mysqli_fetch_array($byRostCompletionResult)) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php
                                                            if ($rostCompletionRows['rost_completion'] == NULL) echo '(غير مصنف)';
                                                            elseif ($rostCompletionRows['rost_completion'] == 1) echo 'مرممة ومتممة';
                                                            elseif ($rostCompletionRows['rost_completion'] == 0) echo 'غير مرممة';
                                                            ?>
                                                    </th>
                                                    <td class="text-center">
                                                        <?php echo $rostCompletionRows['manu_nbr'] ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!--  END 10th CARD -->
                        </div><!--  END Accourdion -->
                    </div><!-- END row -->
                </div>
            </div>
        </div>
    </div>
</body>

<script>
scrollTop();
storeSelectedTab();
</script>

</html>