<?php
include 'check.php';

// Delete book
if (isset($_GET['del_book_id'])) {
    $book_id = $_GET['del_book_id'];
    $book_title = $_GET['book_title'];

    $deleteBookQry = "DELETE FROM a_books WHERE book_id='$book_id'";
    if (mysqli_query($conn, $deleteBookQry)) {
        echo "<script> alert('تم حذف الكتاب $book_title بنجاح') </script>";
        echo "<script> window.location.href= 'booksList.php#booksList'</script>";
    } else {
        echo "<script> alert('حدثت مشكلة: لم يتم حذف الكتاب!!') </script>";
        echo "<script> window.location.href= 'booksList.php#booksList'</script>";
    }
}

// Delete Author
if (isset($_GET['del_auth_id'])) {
    $auth_id = $_GET['del_auth_id'];
    $auth_name = $_GET['auth_name'];

    $deleteAuthorQry = "DELETE FROM c_authors WHERE auth_id='$auth_id'";
    if (mysqli_query($conn, $deleteAuthorQry)) {
        echo "<script> alert('تم حذف المؤلف $auth_name بنجاح') </script>";
        echo "<script> window.location.href= 'authorsList.php#authorsList'</script>";
    } else {
        echo "<script> alert('حدثت مشكلة: لم يتم حذف المؤلف!!') </script>";
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