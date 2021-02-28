<?php
include 'header.php';

// input values
if (isset($_POST['manuSearch'])) {
    $manu_id = $_POST['manu_id'];
    $book_title = $_POST['book_title'];
} else {
    $manu_id = "";
    $book_title = "";
}

// Search query
$searchQry = "SELECT manu_id, book_title 
FROM e_manuscripts, a_books 
WHERE e_manuscripts.book_id = a_books.book_id
AND manu_id LIKE '%$manu_id%'
AND book_title LIKE '%$book_title%'";

$searchResult = mysqli_query($conn, $searchQry);

// search num rows
$search_num_rows = mysqli_num_rows($searchResult);

?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manu List</title>
</head>

<body class="my_bg">
    <!-- START row -->
    <div class="container-fluid">
        <div class="row">

            <?php include "sideBar.php" ?>

            <div class="col-10 my_mr_sidebar">
                <div class="tab-content" id="tabContent">
                    <!-- clients list -->
                    <div class="tab-pane fade mt-3" id="formsList">

                        <div class="alert alert-primary text-center" role="alert">
                            <h4>قائمة الاستمارة</h4>
                        </div>

                        <form action="" method="post">
                            <div class="form-row justify-content-md-center mb-4">
                                <div class="input-group col-md-9">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">رقم الاستمارة</span>
                                    </div>
                                    <input type="text" name="manu_id" class="form-control col-md-3"
                                        placeholder="أدخل رقم الاستمارة">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">عنوان الكتاب</span>
                                    </div>
                                    <input type="text" name="book_title" class="form-control"
                                        placeholder="أدخل عنوان الكتاب">

                                    <div class="input-group-append">
                                        <button class="btn btn-primary" name="manuSearch" type="submit">بحث</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="alert alert-warning text-center" role="alert">
                            <strong> عدد النتائج = </strong>
                            <?php echo $search_num_rows ?>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">رقم الاستمارة</th>
                                    <th scope="col">عنوان الكتاب</th>
                                    <th scope="col" class="text-center">تفاصيل</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($searchResult)) { ?>
                                <tr>
                                    <th scope="row" class="text-center"><?php echo $row['manu_id'] ?></th>
                                    <td><?php echo $row['book_title'] ?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-danger"
                                            href="previewManu.php?manu_id=<?php echo $row['manu_id'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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