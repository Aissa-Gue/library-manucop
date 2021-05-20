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
        echo "<script>alert('فشلت عملية إضافة البلد تحقق من كونه غير موجود مسبقا!')</script>";
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
        echo "<script>alert('فشلت عملية إضافة المدينة تحقق من كونها غير موجودة مسبقا!')</script>";
        echo '<script>window.location.href = "insertCountry.php#insertCountry"</script>';
    }
}

//search for country / city
$count_name = "";
$city_name = "";
if (isset($_POST['search_count'])) {
    $count_name = $_POST['count_name'];
}
if (isset($_POST['search_city'])) {
    $city_name = $_POST['city_name'];
}


// Contries & Cities List
$countListQry = "SELECT count_id, count_name FROM countries
WHERE count_name LIKE '%$count_name%'
ORDER BY count_id DESC";
$countListResult = mysqli_query($conn, $countListQry);

$cityListQry = "SELECT city_id, city_name FROM cities 
WHERE city_name LIKE '%$city_name%'
ORDER BY city_id DESC";
$cityListResult = mysqli_query($conn, $cityListQry);

// search num rows country
$search_num_rows_country = mysqli_num_rows($countListResult);

// search num rows city
$search_num_rows_city = mysqli_num_rows($cityListResult);


$results_per_page = 4;

//************* Start Country pagination ********************//
if (
    !isset($_POST['next_page_country']) or isset($_POST['next_page_country']) or isset($_POST['prev_page_country'])
    and (!isset($_POST['next_page_city']) or !isset($_POST['prev_page_city']))
) {
    //determine the total number of pages available  
    $number_of_page_country = ceil($search_num_rows_country / $results_per_page);

    if (!isset($_POST['next_page_country'])) {
        $page_country = 1;
    } else {
        $pageExplode = explode(' / ', $_POST['page']);
        $page_country = $pageExplode[0];
        if ($page_country < $number_of_page_country) $page_country++;
        $page_first_result = ($page_country - 1) * $results_per_page;
    }
    if (isset($_POST['prev_page_country'])) {
        $pageExplode = explode(' / ', $_POST['page']);
        $page_country = $pageExplode[0];
        if ($page_country > 1) $page_country--;
        $page_first_result = ($page_country - 1) * $results_per_page;
    }
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page_country - 1) * $results_per_page;

    $setLimit = " LIMIT " . $page_first_result . "," . $results_per_page;
    $countListQry = $countListQry . $setLimit;
    $countListResult = mysqli_query($conn, $countListQry);
}

//************* END Country pagination ********************//


//************* Start City pagination ********************//
if (
    !isset($_POST['next_page_city']) or isset($_POST['next_page_city']) or isset($_POST['prev_page_city'])
    and (!isset($_POST['next_page_country']) or !isset($_POST['prev_page_country']))
) {
    //determine the total number of pages available  
    $number_of_page_city = ceil($search_num_rows_city / $results_per_page);

    if (!isset($_POST['next_page_city'])) {
        $page_city = 1;
    } else {
        $pageExplode = explode(' / ', $_POST['page']);
        $page_city = $pageExplode[0];
        if ($page_city < $number_of_page_city) $page_city++;
        $page_first_result = ($page_city - 1) * $results_per_page;
    }
    if (isset($_POST['prev_page_city'])) {
        $pageExplode = explode(' / ', $_POST['page']);
        $page_city = $pageExplode[0];
        if ($page_city > 1) $page_city--;
        $page_first_result = ($page_city - 1) * $results_per_page;
    }
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page_city - 1) * $results_per_page;

    $setLimit = " LIMIT " . $page_first_result . "," . $results_per_page;
    $cityListQry = $cityListQry . $setLimit;
    $cityListResult = mysqli_query($conn, $cityListQry);
}

//************* END City pagination ********************//

?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">

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
                <!-- Insert client -->
                <div class="tab-pane fade mt-3" id="insertCountry">

                    <div class="alert alert-info text-center" role="alert">
                        <h4>إضافة بلد / مدينة</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="post">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">معلومات البلد</legend>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="count_id">رقم البلد</label>
                                            <input type="number" class="form-control text-center"
                                                value="<?php echo $lastCountId + 1 ?>" name="count_id" id="count_id"
                                                placeholder="أدخل رقم البلد" required>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="count_name">اسم البلد</label>
                                            <input list="countries" class="form-control" name="count_name"
                                                id="count_name" placeholder="أدخل اسم البلد" required>
                                            <datalist id="countries">
                                                <?php
                                                for ($i = 0; $i <= $lastCountKey; $i++) { ?>
                                                <option value="<?php print_r($rowsCount[$i]['count_name']) ?>">
                                                    <?php  } ?>
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="form-row justify-content-end">
                                        <div class="form-group col-md-4">
                                            <button type="submit" name="insertCountry"
                                                class="btn btn-success btn-block p-2 rounded-pill">إضافة
                                                البلد</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <form action="" method="post">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">معلومات المدينة</legend>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="city_id">رقم المدينة</label>
                                            <input type="number" class="form-control text-center"
                                                value="<?php echo $lastCityId + 1 ?>" name="city_id" id="city_id"
                                                placeholder="أدخل رقم المدينة" required>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="city_name">اسم المدينة</label>
                                            <input list="cities" class="form-control" name="city_name" id="city_name"
                                                placeholder="أدخل اسم المدينة" required>
                                            <datalist id="cities">
                                                <?php
                                                for ($i = 0; $i <= $lastCityKey; $i++) { ?>
                                                <option value="<?php print_r($rowsCities[$i]['city_name']) ?>">
                                                    <?php  } ?>
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="form-row justify-content-end">
                                        <div class="form-group col-md-auto">
                                            <button type="submit" name="insertCity"
                                                class="btn btn-success btn-block px-3 py-2 rounded-pill">إضافة
                                                المدينة</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div><!-- END row -->

                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3"><strong>=> قائمة البلدان:</strong></h5>
                            <form action="" method="post" id="prev_pageForm">
                                <!-- <div class="input-group mb-3">
                                    <input class="form-control" type="text" name="count_name"
                                        placeholder="أدخل اسم البلد">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" name="search_count">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div> -->


                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col">اسم البلد</th>
                                            <th scope="col" class="text-center">تعديل</th>
                                            <th scope="col" class="text-center">حذف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($countListResult)) { ?>
                                        <tr>
                                            <th scope="row" class="text-center"><?php echo $row['count_id'] ?></th>
                                            <td><?php echo $row['count_name'] ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-outline-primary" data-toggle="modal"
                                                    data-target="#editCountModal<?php echo $row['count_id'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-outline-danger"
                                                    href="delete.php?del_count_id=<?php echo $row['count_id'] ?>&count_name=<?php echo $row['count_name'] ?>"
                                                    onclick="return confirm('هل أنت متأكد من حذف البلد؟')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php include 'edit_country.php' ?>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <!-- START pagination -->
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <button type="submit" name="prev_page_country" onclick="submitPrev_page()"
                                                class="btn btn-info">الصفحة
                                                السابقة</button>
                                        </li>
                                        <li class="page-item">
                                            <input type="text" name="page"
                                                class="page-link text-center bg-light text-info" aria-disabled="true"
                                                value="<?php echo $page_country . ' / ' . $number_of_page_country ?>"
                                                readonly>
                                        </li>
                                        <li class="page-item">
                                            <button type="submit" name="next_page_country" onclick="submitNext_page()"
                                                class="btn btn-info">الصفحة
                                                التالية</button>
                                        </li>
                                    </ul>
                                </nav>
                            </form>
                            <!-- END pagination -->

                        </div>

                        <div class="col-md-6">
                            <h5 class="mb-3"><strong>=> قائمة المدن:</strong></h5>
                            <form action="" method="post" id="prev_pageForm">
                                <!-- <div class="input-group mb-3">
                                    <input class="form-control" type="text" name="city_name"
                                        placeholder="أدخل اسم المدينة">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" name="search_city">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div> -->
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col">اسم المدينة</th>
                                            <th scope="col" class="text-center">تعديل</th>
                                            <th scope="col" class="text-center">حذف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($cityListResult)) { ?>
                                        <tr>
                                            <th scope="row" class="text-center"><?php echo $row['city_id'] ?></th>
                                            <td><?php echo $row['city_name'] ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-outline-primary" data-toggle="modal"
                                                    data-target="#editCityModal<?php echo $row['city_id'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-outline-danger"
                                                    href="delete.php?del_city_id=<?php echo $row['city_id'] ?>&city_name=<?php echo $row['city_name'] ?>"
                                                    onclick="return confirm('هل أنت متأكد من حذف المدينة؟')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php include 'edit_city.php' ?>
                                        <?php } ?>
                                    </tbody>
                                </table>


                                <!-- START pagination -->
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <button type="submit" name="prev_page_city" onclick="submitPrev_page()"
                                                class="btn btn-info">الصفحة
                                                السابقة</button>
                                        </li>
                                        <li class="page-item">
                                            <input type="text" name="page"
                                                class="page-link text-center bg-light text-info" aria-disabled="true"
                                                value="<?php echo $page_city . ' / ' . $number_of_page_city ?>"
                                                readonly>
                                        </li>
                                        <li class="page-item">
                                            <button type="submit" name="next_page_city" onclick="submitNext_page()"
                                                class="btn btn-info">الصفحة
                                                التالية</button>
                                        </li>
                                    </ul>
                                </nav>
                            </form>
                            <!-- END pagination -->

                        </div>
                    </div><!-- END row -->

                </div>
                <!-- End tab -->
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