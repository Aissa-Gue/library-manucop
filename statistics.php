<?php
include 'header.php';


?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
</head>

<body class="my_bg">
    <!-- START row -->
    <div class="container-fluid">
        <div class="row">

            <?php include "sideBar.php" ?>

            <div class="col-10 my_mr_sidebar">
                <div class="tab-content" id="tabContent">
                    <div class="tab-pane fade mt-3" id="statistics">

                        <div class="alert alert-primary text-center" role="alert">
                            <h4>إحصائيات</h4>
                        </div>

                        <div class="alert alert-warning text-center" role="alert">
                            <strong>عدد المنسوخات</strong>
                        </div>

                        <div class="row">
                            <div class="accordion col-md-6" id="accordion1">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true">
                                                #1 حسب البلد والمدينة</button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne1" class="collapse show" data-parent="#accordion1">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry

                                        </div>
                                    </div>
                                </div><!--  END 1st CARD -->

                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseTwo1"
                                                aria-expanded="false">
                                                Collapsible Group Item #2
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo1" class="collapse" data-parent="#accordion1">
                                        <div class="card-body">
                                            cliche reprehenderit, enim eiusmod high life accusamus terry
                                            VHS.
                                        </div>
                                    </div>
                                </div> <!--  END 2nd CARD -->
                            </div><!--  END Accourdion -->


                            <div class="accordion col-md-6" id="accordion2">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapseOne2" aria-expanded="true">
                                                #1 حسب المواضيع</button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne2" class="collapse show" data-parent="#accordion2">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry

                                        </div>
                                    </div>
                                </div><!--  END 1st CARD -->

                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseTwo2"
                                                aria-expanded="false">
                                                Collapsible Group Item #2
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo2" class="collapse" data-parent="#accordion2">
                                        <div class="card-body">
                                            cliche reprehenderit, enim eiusmod high life accusamus terry
                                            VHS.
                                        </div>
                                    </div>
                                </div> <!--  END 2nd CARD -->
                            </div><!--  END Accourdion -->
                        </div><!-- END row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
scrollTop();
storeSelectedTab();
</script>

</html>