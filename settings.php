<?php
include 'header.php';
$motifsQry = "SELECT * FROM d_motifs";
$motifsResult = mysqli_query($conn, $motifsQry);
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
                <!-- clients list -->
                <div class="tab-pane fade mt-3" id="settings">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="nav_database-tab" data-toggle="tab" href="#nav_database"
                                role="tab" aria-selected="false">إدارة قاعدة البيانات</a>
                            <a class="nav-link" id="nav_account-tab" data-toggle="tab" href="#nav_account" role="tab"
                                aria-selected="true">إعدادات الحساب</a>
                            <a class="nav-link" id="nav_motifs-tab" data-toggle="tab" href="#nav_motifs" role="tab"
                                aria-selected="true">الزخارف</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav_database" role="tabpanel">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h4>إدارة قاعدة بيانات البرنامج</h4>
                                    <hr>

                                    <form method="post" action="import_db.php" enctype="multipart/form-data">
                                        <div class="form-group row mb-3">
                                            <div class="input-group mb-3">
                                                <label class="col-md-3">أدخل النسخة الاحتياطية (SQL) </label>
                                                <div class="custom-file col-md-5">
                                                    <input type="file" class="form-control-file" name="db" accept=".sql"
                                                        id="db" required>
                                                    <label class="custom-file-label" for="db">اختر ملف قاعدة
                                                        البيانات</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <input type="submit" name="importDb" class="btn btn-info"
                                                        value="إدخال">
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <form method="post" action="export_db.php" enctype="multipart/form-data">
                                        <!-- Third row -->
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3">استخراج قاعدة البيانات</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <input type="submit" name="export" class="btn btn-success"
                                                        value="استخراج قاعدة البيانات">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END Third row -->
                                    <!-- Forth row -->
                                    <form method="post" action="drop_db.php" enctype="multipart/form-data">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3">حذف قاعدة البيانات</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <input type="submit" name="drop" class="btn btn-danger"
                                                        value="   حذف قاعدة البيانات   "
                                                        onclick="return confirm('انتبه، هل أنت متأكد؟ سيتم حذف جميع البيانات ولن يتم استرجاعها مجددا')">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Forth row -->
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav_account" role="tabpanel">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h4>تغيير إعدادات تسجيل الدخول</h4>
                                    <hr>
                                    <form method="post" action="editAccount.php">
                                        <!-- First row -->
                                        <div class="form-group row mb-3">
                                            <div class="input-group">
                                                <label class="col-md-2">كلمة المرور القديمة</label>
                                                <div class="col-md-4">
                                                    <input type="password" name="oldPwd" class="form-control"
                                                        placeholder="أدخل كلمة المرور القديمة" required />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END First row -->

                                        <!-- Second row -->
                                        <div class="form-group row mb-3">
                                            <div class="input-group">
                                                <label class="col-md-2">اسم المستخدم الجديد</label>
                                                <div class="col-md-4">
                                                    <input type="text" name="newUsername" class="form-control"
                                                        placeholder="أدخل اسم المستخدم الجديد" required />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END second row -->

                                        <!-- Third row -->
                                        <div class="form-group row mb-3">
                                            <label class="col-md-2">كلمة المرور الجديدة</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <input type="password" name="newPwd1" class="form-control"
                                                        placeholder="أدخل كلمة المرور الجديدة">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Third row -->
                                        <!-- Forth row -->
                                        <div class="form-group row mb-3">
                                            <label class="col-md-2">تأكيد كلمة المرور</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <input type="password" name="newPwd2" class="form-control"
                                                        placeholder="أعد إدخال كلمة المرور الجديدة">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Forth row -->
                                        <div class="form-group row mb-3">
                                            <label class="col-md-2"></label>
                                            <div class="col-sm-4">
                                                <input type="submit" name="editAcc"
                                                    class="btn btn-success btn-block rounded-pill p-2"
                                                    value="تغيير الحساب">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="nav_motifs" role="tabpanel">
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#addMotif">
                                        إضافة زخرفة</button>
                                    <?php include 'insert_motif.php' ?>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <table class="table table-hover col-md-5">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">الزخرفة</th>
                                            <th scope="col" class="text-center">تعديل</th>
                                            <th scope="col" class="text-center">حذف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($motifsResult)) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $row['motif_id'] ?></th>
                                            <td><?php echo $row['motif_name'] ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-outline-primary" data-toggle="modal"
                                                    data-target="#editMotif<?php echo $row['motif_id'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <?php include 'edit_motif.php' ?>

                                            <td class="text-center">
                                                <a class="btn btn-outline-danger"
                                                    href="delete.php?del_motif_id=<?php echo $row['motif_id'] ?>&motif_name=<?php echo $row['motif_name'] ?>"
                                                    onclick="return confirm('هل أنت متأكد؟')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
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
        </div>
    </div>
</body>
<script src="main.js"></script>
<script>
scrollTop();
storeSelectedTab();
</script>

</html>