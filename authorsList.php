<?php
include 'header.php';

// input values
if (isset($_POST['authorSearch'])) {
    $auth_id = $_POST['auth_id'];
    $auth_name = $_POST['auth_name'];
} else {
    $auth_id = "";
    $auth_name = "";
}

// Author Search query
$searchQry = "SELECT c_authors.auth_id, auth_name, count(a_books.book_id) as books_nbr
FROM c_authors
LEFT JOIN `g_books_authors` on c_authors.auth_id = g_books_authors.auth_id
LEFT JOIN `a_books` on a_books.book_id = g_books_authors.book_id
WHERE c_authors.auth_id LIKE '$auth_id%' AND
auth_name LIKE '%$auth_name%'
GROUP BY c_authors.auth_id
ORDER BY c_authors.last_edit_date DESC";

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

<body class="my_bg">
    <!-- START row -->
    <div class="container-fluid mt-5 py-2">

        <?php include "sideBar.php" ?>

        <div class="col-10 my_mr_sidebar">
            <div class="tab-content" id="tabContent">
                <!-- bokks list -->
                <div class="tab-pane fade mt-3" id="authorsList">

                    <div class="alert alert-info text-center" role="alert">
                        <h4>قائمة المؤلفين</h4>
                    </div>

                    <form action="" method="post">
                        <div class="form-row justify-content-md-center mb-4">
                            <div class="input-group col-md-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">رقم المؤلف</span>
                                </div>
                                <input type="text" name="auth_id" class="form-control col-md-3"
                                    placeholder="أدخل رقم المؤلف">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">اسم المؤلف</span>
                                </div>
                                <input type="text" name="auth_name" class="form-control" placeholder="أدخل اسم المؤلف">
                                <div class="input-group-append">
                                    <button class="btn btn-info" name="authorSearch" type="submit">بحث</button>
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
                                    <th scope="col" class="text-center">رقم المؤلف</th>
                                    <th scope="col">اسم المؤلف</th>
                                    <th scope="col" class="text-center">عدد الكتب</th>
                                    <th scope="col" class="text-center">تفاصيل</th>
                                    <th scope="col" class="text-center">تعديل</th>
                                    <th scope="col" class="text-center">حذف</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($searchResult)) { ?>
                                <tr>
                                    <th scope="row" class="text-center"><?php echo $row['auth_id'] ?></th>
                                    <td>
                                        <?php echo $row['auth_name'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['books_nbr'] ?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-success"
                                            href="previewAuthor.php?auth_id=<?php echo $row['auth_id'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                            </svg>
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        <a class="btn btn-outline-primary"
                                            href="editAuthor.php?auth_id=<?php echo $row['auth_id'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        <a class="btn btn-outline-danger"
                                            href="delete.php?del_auth_id=<?php echo $row['auth_id'] ?>&auth_name=<?php echo $row['auth_name'] ?>"
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