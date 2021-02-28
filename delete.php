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

// Delete Order
if (isset($_GET['del_order_id'])) {
    $order_id = $_GET['del_order_id'];

    $deleteOrderQry = "DELETE FROM c_orders WHERE order_id='$order_id'";
    if (mysqli_query($conn, $deleteOrderQry)) {
        echo "<script> alert('تم حذف الفاتورة $order_id بنجاح') </script>";
        echo "<script> window.location.href= 'home.php#ordersList'</script>";
    } else {
        echo "<script> alert('حدثت مشكلة: لم يتم حذف الفاتورة!!') </script>";
        echo "<script> window.location.href= 'home.php#ordersList'</script>";
    }
}

// Delete book from Order
if (isset($_GET['del_order_book_id'])) {
    $order_book_id = $_GET['del_order_book_id'];
    $title = $_GET['title'];
    $order_id = $_GET['order_id'];

    $deleteOrderBookQry = "DELETE FROM d_orders_books WHERE order_id='$order_id' AND book_id = '$order_book_id'";
    if (mysqli_query($conn, $deleteOrderBookQry)) {
        echo "<script> alert('تم حذف الكتاب $title من الفاتورة بنجاح') </script>";
        //echo "<script> window.location.href= 'home.php#ordersList'</script>";
    } else {
        echo "<script> alert('حدثت مشكلة: لم يتم حذف الكتاب من الفاتورة!!') </script>";
        //echo "<script> window.location.href= 'home.php#ordersList'</script>";
    }
}