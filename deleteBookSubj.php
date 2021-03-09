<?php
include 'header.php';

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $subj_id = $_GET['subj_id'];

    $deleteBookAuthQry = "DELETE FROM f_books_subjects WHERE (book_id= '$book_id' and subj_id= '$subj_id')";
    if (!mysqli_query($conn, $deleteBookAuthQry)) echo "ERR> " . mysqli_error($conn);
}
header('location: editBook.php?book_id=' . $book_id);