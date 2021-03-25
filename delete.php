<?php
include 'check.php';

// Delete book
if (isset($_GET['del_book_id'])) {
    $book_id = $_GET['del_book_id'];
    $book_title = $_GET['book_title'];

    $deleteBookQry1 = "DELETE FROM f_books_subjects WHERE book_id='$book_id'";
    $deleteBookQry2 = "DELETE FROM g_books_authors WHERE book_id='$book_id'";
    $deleteBookQry3 = "DELETE FROM a_books WHERE book_id='$book_id'";

    //START TRANSACTION 
    mysqli_query($conn, "START TRANSACTION");
    // COMMIT OR ROLLBACK
    $R1 = mysqli_query($conn, $deleteBookQry1);
    $R2 = mysqli_query($conn, $deleteBookQry2);
    $R3 = mysqli_query($conn, $deleteBookQry3);
    if ($R1 and $R2 and $R3) {
        mysqli_query($conn, "COMMIT");
        echo "<script> alert('تم حذف الكتاب $book_id => $book_title بنجاح') </script>";
        echo "<script> window.location.href= 'booksList.php#booksList'</script>";
    } else {
        mysqli_query($conn, "ROLLBACK");
        echo "<script> alert('حدثت مشكلة: لم يتم حذف الكتاب .. تأكد من كون الكتاب لا توجد له منسوخات !') </script>";
        echo "<script> window.location.href= 'booksList.php#booksList'</script>";
    }
}

// Delete Author
if (isset($_GET['del_auth_id'])) {
    $auth_id = $_GET['del_auth_id'];
    $auth_name = $_GET['auth_name'];

    $deleteAuthorQry = "DELETE FROM c_authors WHERE auth_id='$auth_id'";

    if (mysqli_query($conn, $deleteAuthorQry)) {
        echo "<script> alert('تم حذف المؤلف $auth_id => $auth_name بنجاح') </script>";
        echo "<script> window.location.href= 'authorsList.php#authorsList'</script>";
    } else {
        echo "<script> alert('حدثت مشكلة: لم يتم حذف المؤلف .. تأكد من كون المؤلف لا توجد له كتب !') </script>";
        echo "<script> window.location.href= 'authorsList.php#authorsList'</script>";
    }
}

// Delete copier
if (isset($_GET['del_cop_id'])) {
    $cop_id = $_GET['del_cop_id'];
    $full_name = $_GET['full_name'];
    $last_name = $_GET['last_name'];

    $deleteCopierQry = "DELETE FROM d_copiers WHERE cop_id='$cop_id'";
    if (mysqli_query($conn, $deleteCopierQry)) {
        echo "<script> alert('تم حذف الناسخ $full_name $last_name بنجاح') </script>";
        echo "<script> window.location.href= 'copiersList.php#copiersList'</script>";
    } else {
        echo "<script> alert('حدثت مشكلة: لم يتم حذف الناسخ!!') </script>";
        echo "<script> window.location.href= 'copiersList.php#copiersList'</script>";
    }
}

// Delete Manuscript
if (isset($_GET['del_manu_id'])) {
    $manu_id = $_GET['del_manu_id'];
    $book_title = $_GET['book_title'];

    $deleteManuQry1 = "DELETE FROM h_manuscripts_copiers WHERE manu_id='$manu_id'";
    $deleteManuQry2 = "DELETE FROM j_manuscripts_colors WHERE manu_id='$manu_id'";
    $deleteManuQry3 = "DELETE FROM j_manuscripts_manutypes WHERE manu_id='$manu_id'";
    $deleteManuQry4 = "DELETE FROM j_manuscripts_motifs WHERE manu_id='$manu_id'";
    $deleteManuQry5 = "DELETE FROM i_cop_fm WHERE manu_id='$manu_id'";
    $deleteManuQry6 = "DELETE FROM e_manuscripts WHERE manu_id='$manu_id'";

    // START TRANSACTION 
    mysqli_query($conn, "START TRANSACTION");
    $R1 = mysqli_query($conn, $deleteManuQry1);
    $R2 = mysqli_query($conn, $deleteManuQry2);
    $R3 = mysqli_query($conn, $deleteManuQry3);
    $R4 = mysqli_query($conn, $deleteManuQry4);
    $R5 = mysqli_query($conn, $deleteManuQry5);
    $R6 = mysqli_query($conn, $deleteManuQry6);

    // COMMIT OR ROLLBACK
    if ($R1 and $R2 and $R3 and $R4 and $R5 and $R6) {
        mysqli_query($conn, "COMMIT");
        echo "<script> alert('تم حذف الاستمارة $manu_id => $book_title بنجاح') </script>";
        echo "<script> window.location.href= 'formsList.php#formsList'</script>";
    } else {
        mysqli_query($conn, "ROLLBACK");
        echo "<script> alert('حدثت مشكلة: لم يتم حذف الاستمارة!!') </script>";
        echo mysqli_error($conn);
        echo "<script> window.location.href= 'formsList.php#formsList'</script>";
    }
}

// Delete country
if (isset($_GET['del_count_id'])) {
    $count_id = $_GET['del_count_id'];
    $count_name = $_GET['count_name'];

    $deleteCountQry = "DELETE FROM countries WHERE count_id='$count_id'";
    if (mysqli_query($conn, $deleteCountQry)) {
        echo "<script> alert('تم حذف البلد $count_id => $count_name بنجاح') </script>";
        echo "<script> window.location.href= 'insertCountry.php#insertCountry'</script>";
    } else {
        echo "<script> alert('حدثت مشكلة: لم يتم حذف البلد ... تأكد من كونه غير موجود في استمارة !') </script>";
        echo "<script> window.location.href= 'insertCountry.php#insertCountry'</script>";
    }
}

// Delete City
if (isset($_GET['del_city_id'])) {
    $city_id = $_GET['del_city_id'];
    $city_name = $_GET['city_name'];

    $deleteCityQry = "DELETE FROM cities WHERE city_id='$city_id'";
    if (mysqli_query($conn, $deleteCityQry)) {
        echo "<script> alert('تم حذف المدينة $city_id => $city_name بنجاح') </script>";
        echo "<script> window.location.href= 'insertCountry.php#insertCountry'</script>";
    } else {
        echo "<script> alert('حدثت مشكلة: لم يتم حذف المدينة ... تأكد من كونها غير موجودة في استمارة !') </script>";
        echo "<script> window.location.href= 'insertCountry.php#insertCountry'</script>";
    }
}