<?php
include 'header.php';
include 'lists.php';

// Select last (cop_id)
$lastCopIdQry = "SELECT max(cop_id) FROM `d_copiers`";
$lastCopIdResult = mysqli_query($conn, $lastCopIdQry);
$rowCopId = mysqli_fetch_row($lastCopIdResult);
$lastCopIdKey = $rowCopId[0];

// Insert Copier
if (isset($_POST['insertCopier'])) {
    $insCopErrs = array("ERRORS >>: <br>");

    $cop_id = $_POST['cop_id'];

    //********** Insert into e_manuscripts Queries **********/
    $full_name = $_POST['full_name'];

    $descent1 = $_POST['descent1'];
    if (isset($_POST['descent2'])) $descent2 = $_POST['descent2'];
    else $descent2 = "";
    if (isset($_POST['descent3'])) $descent3 = $_POST['descent3'];
    else $descent3 = "";
    if (isset($_POST['descent4'])) $descent4 = $_POST['descent4'];
    else $descent4 = "";
    if (isset($_POST['descent5'])) $descent5 = $_POST['descent5'];
    else $descent5 = "";

    $last_name = $_POST['last_name'];
    $nickname = $_POST['nickname'];

    $other_name1 = $_POST['other_name1'];
    if (isset($_POST['other_name2'])) $other_name2 = $_POST['other_name2'];
    else $other_name2 = "";
    if (isset($_POST['other_name3'])) $other_name3 = $_POST['other_name3'];
    else $other_name3 = "";
    if (isset($_POST['other_name4'])) $other_name4 = $_POST['other_name4'];
    else $other_name4 = "";

    if (isset($_POST['count_name']) and $_POST['count_name'] !== "") {
        $count_id_explode = explode(' # ', $_POST['count_name']);
        $count_id = $count_id_explode[0]; // multi
    } else $count_id = "NULL";

    if (isset($_POST['city_name']) and $_POST['city_name'] !== "") {
        $city_id_explode = explode(' # ', $_POST['city_name']);
        $city_id = $city_id_explode[0]; // multi
    } else $city_id = "NULL";

    $creation_date = $date;
    $last_edit_date = $date;

    $insertCopierQry = "INSERT INTO d_copiers VALUES ('$cop_id', '$full_name', '$descent1', '$descent2', '$descent3', '$descent4', '$descent5', '$last_name', '$nickname','$other_name1','$other_name2','$other_name3','$other_name4', $count_id, $city_id, '$creation_date','$last_edit_date')";


    //********** Insert into d_copiers **********/
    if (!mysqli_query($conn, $insertCopierQry)) array_push($insCopErrs, "<br> d_copiers >> " . mysqli_error($conn));


    if (count($insCopErrs) == 1) {
        echo "<script>alert('تم إضافة الناسخ: $full_name بنجاح')</script>";
        echo '<script>window.location.href = "previewCopier.php?cop_id=' . $cop_id . '"</script>';
    } else {
        echo "<script>alert('فشلت عملية إضافة الناسخ')</script>";
        echo mysqli_error($conn);
        echo '<script>window.location.href = "insertCopier.php#insertCopier"</script>';
    }
}
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
                    <!-- Insert client -->
                    <div class="tab-pane fade mt-3" id="insertCopier">

                        <div class="alert alert-primary text-center" role="alert">
                            <h4>إضافة ناسخ</h4>
                        </div>
                        <form action="" method="post">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">معلومات الناسخ</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="cop_id">رقم الناسخ</label>
                                        <input type="number" class="form-control text-center" name="cop_id"
                                            value="<?php echo $lastCopIdKey + 1 ?>" id="cop_id"
                                            placeholder="أدخل رقم الناسخ" required>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <label for="full_name">اسم الناسخ</label>
                                        <input type="text" class="form-control" name="full_name" id="full_name"
                                            placeholder="أدخل اسم الناسخ" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="descent">النسبة</label>
                                        <input type="text" class="form-control" name="descent1" id="descent"
                                            placeholder="أدخل النسبة 1">
                                    </div>
                                    <!-- add input dinamically -->
                                    <div id="addDescent" class="form-group col-md-auto"
                                        style="cursor: pointer; margin-top: 37px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                                            <path
                                                d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                        </svg>
                                    </div>
                                    <!-- END add input dinamically -->
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="last_name">اللقب (اسم الشهرة)</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name"
                                            placeholder="أدخل لقب الناسخ">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="nickname">الكنية</label>
                                        <input type="text" class="form-control" name="nickname" id="nickname"
                                            placeholder="أدخل كنية الناسخ">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="city_name">مدينة الناسخ</label>
                                        <input list="cities" class="form-control" name="city_name" id="city_name"
                                            placeholder="أدخل مدينة الناسخ">
                                        <datalist id="cities">
                                            <?php
                                            for ($i = 0; $i <= $lastCityKey; $i++) { ?>
                                            <option
                                                value="<?php print_r($rowsCities[$i]['city_id']) ?> # <?php print_r($rowsCities[$i]['city_name']); ?>">
                                                <?php  } ?>
                                        </datalist>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="count_name">بلد الناسخ</label>
                                        <input list="countries" class="form-control" name="count_name" id="count_name"
                                            placeholder="أدخل بلد النسخ">
                                        <datalist id="countries">
                                            <?php
                                            for ($i = 0; $i <= $lastCountKey; $i++) { ?>
                                            <option
                                                value="<?php print_r($rowsCount[$i]['count_id']) ?> # <?php print_r($rowsCount[$i]['count_name']); ?>">
                                                <?php  } ?>
                                        </datalist>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <label for="other_name">صيغ أخرى لاسم الناسخ</label>
                                        <input type="text" class="form-control" name="other_name1" id="other_name"
                                            placeholder="أدخل الصيغة 1">
                                    </div>
                                    <!-- add input dinamically -->
                                    <div id="addOther_name" class="form-group col-md-auto"
                                        style="cursor: pointer; margin-top: 37px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                                            <path
                                                d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                        </svg>
                                    </div>
                                    <!-- END add input dinamically -->
                                </div>

                                <div class="form-row justify-content-end">
                                    <div class="form-group col-md-2">
                                        <button type="submit" name="insertCopier"
                                            class="btn btn-success btn-block btn-lg rounded-pill">إضافة</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
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