<?php

if (!isset($cop_id1)) $cop_id1 = "";
if (!isset($cop_id2)) $cop_id2 = "";
if (!isset($cop_id3)) $cop_id3 = "";
if (!isset($cop_id4)) $cop_id4 = "";

//******* TEST and ERR Messeges *****/
// exact date Or Range
if ($_POST['cop_syear_range'] !== '' and $_POST['cop_eyear_range'] !== '' and ($_POST['cop_syear'] != '' or $_POST['cop_month'] != '' or $_POST['cop_day'] != '' or $_POST['cop_day_nbr'] != '')) {
    echo "<script>alert('انتبه، لقد حددت فترة زمنية وتاريخ محدد في نفس الوقت، سيتم تسجيل الفترة الزمنية فقط !')</script>";
} elseif (
    $_POST['cop_syear_range'] !== '' and ($_POST['cop_syear'] != '' or $_POST['cop_month'] != '' or $_POST['cop_day'] != '' or $_POST['cop_day_nbr'] != '')
    or $_POST['cop_eyear_range'] !== '' and ($_POST['cop_syear'] != '' or $_POST['cop_month'] != '' or $_POST['cop_day'] != '' or $_POST['cop_day_nbr'] != '')
) {
    echo "<script>alert('انتبه، لقد حددت فترة زمنية وتاريخ محدد في نفس الوقت، سيتم تسجيل التاريخ المحدد فقط !')</script>";
}
// if copFm not exist in manu_copiers table
$cop_fm_Err = "<script>alert('انتبه، أحد النساخ الذي أدخلت مشابها له في الخط غير ناسخ للمخطوط سيتم تجاهله !')</script>";
if (isset($_POST['cop_match1'])) {
    if ($_POST['cop_match1'] == $cop_id1 or $_POST['cop_match1'] == $cop_id2 or $_POST['cop_match1'] == $cop_id3 or $_POST['cop_match1'] == $cop_id4) {
        echo 1;
    } else echo $cop_fm_Err;
}
if (isset($_POST['cop_match2'])) {
    if ($_POST['cop_match2'] == $cop_id1 or $_POST['cop_match2'] == $cop_id2 or $_POST['cop_match2'] == $cop_id3 or $_POST['cop_match2'] == $cop_id4) {
        echo 1;
    } else echo $cop_fm_Err;
}
if (isset($_POST['cop_match3'])) {
    if ($_POST['cop_match3'] == $cop_id1 or $_POST['cop_match3'] == $cop_id2 or $_POST['cop_match3'] == $cop_id3 or $_POST['cop_match3'] == $cop_id4) {
        echo 1;
    } else echo $cop_fm_Err;
}
if (isset($_POST['cop_match4'])) {
    if ($_POST['cop_match4'] == $cop_id1 or $_POST['cop_match4'] == $cop_id2 or $_POST['cop_match4'] == $cop_id3 or $_POST['cop_match4'] == $cop_id4) {
        echo 1;
    } else echo $cop_fm_Err;
}

//***** END TEST & Err msges ********/