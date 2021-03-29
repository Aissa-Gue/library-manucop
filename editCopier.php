<?php
include 'header.php';
include 'lists.php';

// GET values from clientsList.php
if (isset($_GET['cop_id'])) {
    $cop_id = $_GET['cop_id'];
    $prev_id = $_GET['cop_id'];

    // Search query
    $searchQry = "SELECT *
    FROM d_copiers
    LEFT JOIN countries ON countries.count_id = d_copiers.count_id
    LEFT JOIN cities ON cities.city_id = d_copiers.city_id 
    WHERE cop_id = '$cop_id'";

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

        $city_id = $row['city_id'];
        $city_name = $row['city_name'];

        $count_id = $row['count_id'];
        $count_name = $row['count_name'];
    }
}
// Edit copier
//********** Update d_copier Queries **********/
if (isset($_POST['editCopier'])) {
    $editCopErrs = array("ERRORS >>: <br>");

    $cop_id = $_POST['cop_id'];
    $full_name = $_POST['full_name'];

    $descent1 = $_POST['descent1'];
    $descent2 = $_POST['descent2'];
    $descent3 = $_POST['descent3'];
    $descent4 = $_POST['descent4'];
    $descent5 = $_POST['descent5'];

    $last_name = $_POST['last_name'];
    $nickname = $_POST['nickname'];

    $other_name1 = $_POST['other_name1'];
    $other_name2 = $_POST['other_name2'];
    $other_name3 = $_POST['other_name3'];
    $other_name4 = $_POST['other_name4'];

    if (isset($_POST['count_name']) and $_POST['count_name'] != "") {
        $count_id_explode = explode(' # ', $_POST['count_name']);
        $count_id = $count_id_explode[0]; // multi
    } else $count_id = "NULL";

    if (isset($_POST['city_name']) and $_POST['city_name'] != "") {
        $city_id_explode = explode(' # ', $_POST['city_name']);
        $city_id = $city_id_explode[0]; // multi
    } else $city_id = "NULL";

    $last_edit_date = $date;

    $editCopierQry = "UPDATE d_copiers set cop_id = '$cop_id', full_name='$full_name', descent1='$descent1', descent2='$descent2', descent3='$descent3', descent4='$descent4', descent5='$descent5', last_name='$last_name', nickname='$nickname', other_name1='$other_name1', other_name2='$other_name2', other_name3='$other_name3', other_name4='$other_name4', count_id= $count_id, city_id= $city_id, last_edit_date='$last_edit_date' WHERE cop_id = '$prev_id'";

    //********** Update d_copier **********/
    if (!mysqli_query($conn, $editCopierQry)) array_push($editCopErrs, "<br> d_copier >> " . mysqli_error($conn));
    //echo "<br> d_copier >> " . mysqli_error($conn);


    if (count($editCopErrs) == 1 and mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('تم تعديل معلومات الناسخ: $full_name بنجاح')</script>";
        echo "<script> window.location.href= 'editCopier.php?cop_id=$cop_id'</script>";
    } else {
        echo "<script>alert('فشلت عملية تعديل معلومات الناسخ')</script>";
        //echo mysqli_error($conn);
        echo print_r($editCopErrs);
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
    <div class="container-fluid mt-5">
        <?php include "sideBar.php" ?>

        <div class="col-10 my_mr_sidebar pt-3">
            <div class="alert alert-info text-center h4" role="alert">
                تعديل معلومات الناسخ
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <!-- 1st row -->
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="cop_id" class="form-label">رقم الناسخ</label>
                        <input type="text" class="form-control text-center" value="<?php echo $cop_id ?>" name="cop_id"
                            id="cop_id" placeholder="أدخل رقم الناسخ" required>
                    </div>
                </div>
                <!-- 2nd row -->
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="full_name" class="form-label">الإسم الكامل</label>
                        <input type="text" class="form-control" value="<?php echo $full_name ?>" name="full_name"
                            id="full_name" placeholder="أدخل اسم الناسخ" required>
                    </div>
                    <div class="col-md-auto">
                        <label for="last_name" class="form-label">اللقب (اسم الشهرة)</label>
                        <input type="text" class="form-control" value="<?php echo $last_name ?>" name="last_name"
                            id="last_name" placeholder="أدخل لقب الناسخ">
                    </div>
                    <div class="col-md-auto">
                        <label for="nickname" class="form-label">الكنية</label>
                        <input type="text" class="form-control" value="<?php echo $nickname ?>" name="nickname"
                            id="nickname" placeholder="أدخل كنية الناسخ">
                    </div>
                </div>
                <!-- 3rd row -->
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="descent1" class="form-label">النسبة 1</label>
                        <input type="text" class="form-control" value="<?php echo $descent1 ?>" name="descent1"
                            id="descent1" placeholder="أدخل نسبة">
                    </div>
                    <div class="col-md-2">
                        <label for="descent2" class="form-label">النسبة 2</label>
                        <input type="text" class="form-control" value="<?php echo $descent2 ?>" name="descent2"
                            id="descent2" placeholder="أدخل نسبة">
                    </div>
                    <div class="col-md-2">
                        <label for="descent3" class="form-label">النسبة 3</label>
                        <input type="text" class="form-control" value="<?php echo $descent3 ?>" name="descent3"
                            id="descent3" placeholder="أدخل نسبة">
                    </div>
                    <div class="col-md-2">
                        <label for="descent4" class="form-label">النسبة 4</label>
                        <input type="text" class="form-control" value="<?php echo $descent4 ?>" name="descent4"
                            id="descent4" placeholder="أدخل نسبة">
                    </div>
                    <div class="col-md-2">
                        <label for="descent5" class="form-label">النسبة 5</label>
                        <input type="text" class="form-control" value="<?php echo $descent5 ?>" name="descent5"
                            id="descent5" placeholder="أدخل نسبة">
                    </div>
                </div>

                <!-- 4th row -->
                <div class="row mt-3">
                    <div class="col-md-7">
                        <label for="other_name1" class="form-label">صيغ أخرى لاسم الناسخ</label>
                        <input type="text" class="form-control" value="<?php echo $other_name1 ?>" name="other_name1"
                            id="other_name1" placeholder="أدخل صيغة أخرى لاسم الناسخ">
                        <input type="text" class="form-control mt-1" value="<?php echo $other_name2 ?>"
                            name="other_name2" id="other_name2" placeholder="أدخل صيغة أخرى لاسم الناسخ">
                        <input type="text" class="form-control mt-1" value="<?php echo $other_name3 ?>"
                            name="other_name3" id="other_name3" placeholder="أدخل صيغة أخرى لاسم الناسخ">
                        <input type="text" class="form-control mt-1" value="<?php echo $other_name4 ?>"
                            name="other_name4" id="other_name4" placeholder="أدخل صيغة أخرى لاسم الناسخ">
                    </div>

                    <div class="col-md-3 mt-4">
                        <label for="city_name" class="form-label">المدينة</label>
                        <input list="cities" class="form-control" name="city_name"
                            value="<?php if ($city_id != '') echo $city_id . ' # ' . $city_name ?>" id="city_name"
                            placeholder="أدخل مدينة الناسخ">
                        <datalist id="cities">
                            <?php
                            for ($i = 0; $i <= $lastCityKey; $i++) { ?>
                            <option
                                value="<?php print_r($rowsCities[$i]['city_id']) ?> # <?php print_r($rowsCities[$i]['city_name']); ?>">
                                <?php  } ?>
                        </datalist>

                        <div class="mt-3"></div>
                        <label for="count_name">البلد</label>
                        <input list="countries" class="form-control" name="count_name"
                            value="<?php if ($count_id != '') echo $count_id . ' # ' . $count_name ?>" id="count_name"
                            placeholder="أدخل بلد الناسخ">
                        <datalist id="countries">
                            <?php
                            for ($i = 0; $i <= $lastCountKey; $i++) { ?>
                            <option
                                value="<?php print_r($rowsCount[$i]['count_id']) ?> # <?php print_r($rowsCount[$i]['count_name']); ?>">
                                <?php  } ?>
                        </datalist>
                    </div>
                </div>

                <div class="form-row justify-content-end">
                    <div class="form-group my_col_btn">
                        <button type="button" class="btn btn-danger btn-block btn-lg rounded-pill"
                            onclick="window.history.go(-1);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                            </svg>
                            رجوع
                        </button>
                    </div>
                    <div class="form-group my_col_btn">
                        <button type="submit" name="editCopier"
                            class="btn btn-success btn-block btn-lg rounded-pill">تحديث</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>