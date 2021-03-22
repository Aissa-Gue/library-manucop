<?php
include 'header.php';
include 'lists.php';

// Select last (count_id)
$lastCountIdQry = "SELECT max(count_id) FROM `countries`";
$lastCountIdResult = mysqli_query($conn, $lastCountIdQry);
$rowCountId = mysqli_fetch_row($lastCountIdResult);
$lastCountId = $rowCountId[0];

// Select last (city_id)
$lastCityIdQry = "SELECT max(city_id) FROM `cities`";
$lastCityIdResult = mysqli_query($conn, $lastCityIdQry);
$rowCityId = mysqli_fetch_row($lastCityIdResult);
$lastCityId = $rowCityId[0];

////////////////////////////////////////////// Insert Country //////////////////////////////////////////////
if (isset($_POST['insertCountry'])) {
    $count_id = $_POST['count_id'];
    $count_name = $_POST['count_name'];

    $insertCountryQry = "INSERT INTO countries VALUES ('$count_id', '$count_name')";

    if (mysqli_query($conn, $insertCountryQry)) {
        echo "<script>alert('تم إضافة البلد: $count_name بنجاح')</script>";
        echo '<script>window.location.href = "insertCountry.php#insertCountry"</script>';
    } else {
        echo "<script>alert('فشلت عملية إضافة البلد تحقق من كونه موجود مسبقا!')</script>";
        echo '<script>window.location.href = "insertCountry.php#insertCountry"</script>';
    }
}


////////////////////////////////////////////// Insert City //////////////////////////////////////////////
if (isset($_POST['insertCity'])) {
    $city_id = $_POST['city_id'];
    $city_name = $_POST['city_name'];

    $insertCityQry = "INSERT INTO cities VALUES ('$city_id', '$city_name')";

    if (mysqli_query($conn, $insertCityQry)) {
        echo "<script>alert('تم إضافة المدينة: $city_name بنجاح')</script>";
        echo '<script>window.location.href = "insertCountry.php#insertCountry"</script>';
    } else {
        echo "<script>alert('فشلت عملية إضافة المدينة تحقق من كونها موجودة مسبقا!')</script>";
        echo '<script>window.location.href = "insertCountry.php#insertCountry"</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Country & City</title>
</head>

<body class="my_bg">
    <!-- START row -->
    <div class="container-fluid mt-5">
        <div class="row">

            <?php include "sideBar.php" ?>

            <div class="col-10 my_mr_sidebar">
                <div class="tab-content" id="tabContent">
                    <!-- Insert client -->
                    <div class="tab-pane fade mt-3" id="insertCountry">

                        <div class="alert alert-primary text-center" role="alert">
                            <h4>إضافة بلد / مدينة</h4>
                        </div>
                        <form action="" method="post">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">معلومات البلد</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="count_id">رقم البلد</label>
                                        <input type="number" class="form-control text-center"
                                            value="<?php echo $lastCountId + 1 ?>" name="count_id" id="count_id"
                                            placeholder="أدخل رقم البلد" required>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <label for="count_name">اسم البلد</label>
                                        <input type="text" class="form-control" name="count_name" id="count_name"
                                            placeholder="أدخل اسم البلد" required>
                                    </div>
                                </div>

                                <div class="form-row justify-content-end">
                                    <div class="form-group col-md-2">
                                        <button type="submit" name="insertCountry"
                                            class="btn btn-success btn-block btn-lg rounded-pill">إضافة البلد</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                        <form action="" method="post">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">معلومات المدينة</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="city_id">رقم المدينة</label>
                                        <input type="number" class="form-control text-center"
                                            value="<?php echo $lastCityId + 1 ?>" name="city_id" id="city_id"
                                            placeholder="أدخل رقم المدينة" required>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <label for="city_name">اسم المدينة</label>
                                        <input type="text" class="form-control" name="city_name" id="city_name"
                                            placeholder="أدخل اسم المدينة" required>
                                    </div>
                                </div>

                                <div class="form-row justify-content-end">
                                    <div class="form-group col-md-2">
                                        <button type="submit" name="insertCity"
                                            class="btn btn-success btn-block btn-lg rounded-pill">إضافة المدينة</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- End tab -->
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