<?php
include 'header.php';
include 'lists.php';

// init sessions
function initSessions()
{
    $_SESSION['cop_id'] = "";
    $_SESSION['full_name'] = "";
    $_SESSION['city_name'] = "";
    $_SESSION['count_name'] = "";
    $_SESSION['from_year'] = "";
    $_SESSION['type_name'] = "";
    $_SESSION['to_year'] = "";
    $_SESSION['date_type'] = "";
}
initSessions();

if (isset($_GET['initSessions'])) {
    initSessions();
    echo "<script>window.location.href='copiersList.php#copiersList'</script>";
}

// input values
$from_yearQry = "";
$to_yearQry = "";
$date_typeQry = "";

if (isset($_POST['clientSearch']) or isset($_POST['prev_page']) or isset($_POST['next_page'])) {
    $cop_id = $_SESSION['cop_id'] = $_POST['cop_id'];
    $full_name = $_SESSION['full_name'] = $_POST['full_name'];
    $city_name = $_SESSION['city_name'] = $_POST['city_name'];
    $count_name = $_SESSION['count_name'] = $_POST['count_name'];
    $from_year = $_SESSION['from_year'] = $_POST['from_year'];
    $to_year = $_SESSION['to_year'] = $_POST['to_year'];
    $date_type = $_SESSION['date_type'] = $_POST['date_type'];

    if ($from_year != '') $from_yearQry = 'AND e_manuscripts.cop_syear >=' . $from_year;
    if ($to_year != '') $to_yearQry = 'AND e_manuscripts.cop_eyear <=' . $to_year;
    if ($date_type != '') $date_typeQry = 'AND date_type = ' . $date_type;
} else {
    $cop_id = "";
    $full_name = "";
    $city_name = "";
    $count_name = "";
}

if ($city_name !== "") {
    $city_nameQry = "AND (city_name LIKE '%$city_name%')";
} else {
    $city_nameQry = "";
}

if ($count_name !== "") {
    $count_nameQry = "AND (count_name LIKE '%$count_name%')";
} else {
    $count_nameQry = "";
}

// Search query
$searchQry = "SELECT count(e_manuscripts.manu_id) as manu_nbr, d_copiers.cop_id, full_name, last_name, other_name1, other_name2, other_name3, other_name4, city_name, count_name
FROM d_copiers 
LEFT JOIN countries ON countries.count_id = d_copiers.count_id
LEFT JOIN cities ON cities.city_id = d_copiers.city_id
LEFT JOIN h_manuscripts_copiers ON h_manuscripts_copiers.cop_id =  d_copiers.cop_id
LEFT JOIN e_manuscripts ON e_manuscripts.manu_id =  h_manuscripts_copiers.manu_id
WHERE 
(d_copiers.cop_id LIKE '%$cop_id%')
AND (full_name LIKE '%$full_name%'
OR last_name LIKE '%$full_name%'
OR other_name1 LIKE '%$full_name%'
OR other_name2 LIKE '%$full_name%'
OR other_name3 LIKE '%$full_name%'
OR other_name4 LIKE '%$full_name%')
$from_yearQry
$to_yearQry
$date_typeQry
$city_nameQry
$count_nameQry
GROUP BY d_copiers.cop_id
ORDER BY d_copiers.last_edit_date DESC";

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
    $page = $_POST['page'];
    if ($page < $number_of_page) $page++;
    $page_first_result = ($page - 1) * $results_per_page;
}
if (isset($_POST['prev_page'])) {
    $page = $_POST['page'];
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

<body class="my_bg">
    <!-- START row -->
    <div class="container-fluid mt-5">
        <div class="row">

            <?php include "sideBar.php" ?>

            <div class="col-10 my_mr_sidebar">
                <div class="tab-content" id="tabContent">
                    <!-- clients list -->
                    <div class="tab-pane fade mt-3" id="copiersList">

                        <a href="copiersList.php?initSessions=true">
                            <div class="alert alert-primary text-center" role="alert">
                                <h4>قائمة النساخ</h4>
                            </div>
                        </a>

                        <form action="" method="post">
                            <div class="form-row justify-content-md-center mb-1">
                                <div class="input-group col-md-10">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">رقم الناسخ</span>
                                    </div>
                                    <input type="number" name="cop_id" class="form-control col-md-3 text-center"
                                        placeholder="أدخل رقم الناسخ" value="<?php echo $_SESSION['cop_id'] ?>">


                                    <div class="input-group-prepend">
                                        <span class="input-group-text">اسم الناسخ</span>
                                    </div>
                                    <input list="copiers" name="full_name" class="form-control"
                                        placeholder="أدخل اسم الناسخ ، نسبته ، لقبه ، كنيته ..."
                                        value="<?php echo $_SESSION['full_name'] ?>">
                                    <datalist id="copiers">
                                        <?php
                                        for ($i = 0; $i <= $lastKey; $i++) { ?>
                                        <option value="<?php print_r($rows[$i]['full_name']); ?>">
                                            <?php  } ?>
                                    </datalist>

                                </div>
                            </div>

                            <div class="form-row justify-content-md-center mb-2">
                                <div class="input-group col-md-10">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">المديـنـــــة</span>
                                    </div>
                                    <input list="cities" name="city_name" class="form-control col-md-3"
                                        placeholder="أدخل مدينة الناسخ" value="<?php echo $_SESSION['city_name'] ?>">
                                    <datalist id="cities">
                                        <?php
                                        for ($i = 0; $i <= $lastCityKey; $i++) { ?>
                                        <option value="<?php print_r($rowsCities[$i]['city_name']); ?>">
                                            <?php  } ?>
                                    </datalist>

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">بلد النــاسخ</span>
                                    </div>
                                    <input list="countries" name="count_name" class="form-control"
                                        placeholder="أدخل بلد الناسخ" value="<?php echo $_SESSION['count_name'] ?>">
                                    <datalist id="countries">
                                        <?php
                                        for ($i = 0; $i <= $lastCountKey; $i++) { ?>
                                        <option value="<?php print_r($rowsCount[$i]['count_name']); ?>">
                                            <?php  } ?>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-row justify-content-md-center mb-4">
                                <div class="input-group col-md-8">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">فترة النسخ</span>
                                    </div>
                                    <input type="number" name="from_year" class="form-control" placeholder="من سنة ..."
                                        value="<?php echo $_SESSION['from_year'] ?>">
                                    <input type="number" name="to_year" class="form-control" placeholder="إلى سنة ..."
                                        value="<?php echo $_SESSION['to_year'] ?>">

                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="date_type">نوع التقويم</label>
                                    </div>
                                    <select class="custom-select" name="date_type" id="date_type">
                                        <option value="">- اختر نوع التقويم -</option>
                                        <option value="1" <?php if ($_SESSION['date_type'] == 1) echo 'Selected' ?>>
                                            ميلادي
                                        </option>
                                        <option value="0"
                                            <?php if ($_SESSION['date_type'] == 0 and $_SESSION['date_type'] != null) echo 'Selected' ?>>
                                            هجري</option>
                                    </select>

                                    <div class="input-group-append">
                                        <button class="btn btn-primary" name="clientSearch" type="submit">بحث</button>
                                    </div>
                                </div>
                            </div>
                            <!-- </form> -->

                            <div class="alert alert-warning text-center" role="alert">
                                <strong> عدد النتائج = </strong>
                                <?php echo $search_num_rows ?>
                            </div>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">رقم الناسخ</th>
                                        <th scope="col">اسم الناسخ</th>
                                        <th scope="col">اللقب</th>
                                        <th scope="col" class="text-center">عدد المنسوخات</th>
                                        <th scope="col" class="text-center">تفاصيل</th>
                                        <th scope="col" class="text-center">تعديل</th>
                                        <th scope="col" class="text-center">حذف</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($searchResult)) { ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?php echo $row['cop_id'] ?></th>
                                        <td><?php echo $row['full_name'] ?>
                                        </td>
                                        <td><?php echo $row['last_name'] ?></td>
                                        <td class="text-center"><?php echo $row['manu_nbr'] ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-outline-danger"
                                                href="previewCopier.php?cop_id=<?php echo $row['cop_id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-person-lines-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                                </svg>
                                            </a>
                                        </td>

                                        <td class="text-center">
                                            <a class="btn btn-outline-danger"
                                                href="editCopier.php?cop_id=<?php echo $row['cop_id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                </svg>
                                            </a>
                                        </td>

                                        <td class="text-center">
                                            <a class="btn btn-outline-danger"
                                                href="delete.php?del_cop_id=<?php echo $row['cop_id'] ?>&full_name=<?php echo $row['full_name'] ?>&last_name=<?php echo $row['last_name'] ?>"
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
                                            class="btn btn-success">الصفحة
                                            السابقة</button>
                                    </li>
                                    <li class="page-item">
                                        <input type="text" name="page"
                                            class="page-link text-center bg-light text-danger" aria-disabled="true"
                                            value="<?php echo $page ?>" readonly>
                                    </li>
                                    <li class="page-item"><a class="page-link"><?php echo ' / ' . $number_of_page ?></a>
                                    </li>
                                    <li class="page-item">
                                        <button type="submit" name="next_page" onclick="submitNext_page()"
                                            class="btn btn-success">الصفحة
                                            التالية</button>
                                    </li>
                                </ul>
                            </nav>
                        </form>
                        <!-- END pagination -->
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