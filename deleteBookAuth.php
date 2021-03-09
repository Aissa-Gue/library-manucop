<?php
include 'header.php';

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $auth_id = $_GET['auth_id'];

    $deleteBookAuthQry = "DELETE FROM g_books_authors WHERE (book_id= '$book_id' and auth_id= '$auth_id')";
    if (!mysqli_query($conn, $deleteBookAuthQry)) echo "ERR> " . mysqli_error($conn);
}
header('location: editBook.php?book_id=' . $book_id);