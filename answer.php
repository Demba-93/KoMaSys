<?php
include("db.php");
$db= $conn;
$tableName="error_messages";
$columns= ['id', 'study_course','course','source','fault',"suggestion", "created_at", "in_process", "corrected", "rejected", "answer", "read_at"];
$condition="id = ".$_GET['id'];
$data = fetch_data($db, $tableName, $columns, $condition)[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['corrected'])) {
        $sql = "UPDATE error_messages SET corrected=1, rejected=0, answer='".$_REQUEST['answer']."' WHERE id=".$_GET['id'];
    } else {
        $sql = "UPDATE error_messages SET corrected=0, rejected=1, answer='".$_REQUEST['answer']."' WHERE id=".$_GET['id'];
    }
    $res = insert_data($db, $sql);
    if($res === 'success'){
        echo "<script>window.location = 'http://" . $_SERVER['HTTP_HOST'] . "/index.php'</script>";
    } else {
        echo $res;
    }
} else {
    if (!isset($data['read_at'])){
        $sql = "UPDATE error_messages SET read_at ='".date("Y-m-d")."' WHERE id=".$_GET['id']."AND tutor_user_id = 2"; //session.userid
        insert_data($db, $sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>KoMaSys - Fehlermeldung</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">KoMaSys</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Hauptmenü
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Angemeldet als:<br/>Username <a href="./login.php">Ausloggen</a></div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card-header">
                        <a href="javascript:history.back()"><i class="fas fa-arrow-left"></i></a>
                        Fehlermeldung
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-4">ID</label>
                            <label class="col-8"><?php echo $data['id'];?></label>
                        </div>
                        <div class="row">
                            <label class="col-4">Kurs</label>
                            <label class="col-8"><?php echo $data['course'];?></label>
                        </div>
                        <div class="row">
                            <label class="col-4">Fehlerquelle</label>
                            <label class="col-8"><?php echo $data['source'];?></label>
                        </div>
                        <div class="row">
                            <label class="col-4">Meldedatum</label>
                            <label class="col-8"><?php echo $data['created_at'];?></label>
                        </div>
                        <div class="row">
                            <label class="col-4">Fehlerbeschreibung</label>
                            <label class="col-8"><?php echo $data['fault'];?></label>
                        </div>
                        <div class="row">
                            <label class="col-4">Korrekturvorschlag</label>
                            <label class="col-8"><?php echo $data['suggestion'];?></label>
                        </div>
                        <?php if ($data['corrected'] === '1' || $data['rejected'] === '1') { ?>
                            <div class="row">
                                <label class="col-4">Antwort</label>
                                <label class="col-8"><?php echo $data['answer'];?></label>
                            </div>
                        <?php } else  { ?>
                            <form method=POST>
                                <div class="form-group row">
                                    <label for="note" class="col-4">Antwort</label>
                                    <textarea class="form-control col-8" name="answer" id="answer"></textarea>
                                </div>
                                <input type="submit" name="corrected" value="Abgeschlossen" class="btn btn-success mt-2">
                                <input type="submit" name="reject" value="Ablehnen" class="btn btn-danger mt-2">
                            </form>
                        <?php } ?>
                    </div>
                </main>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; KoMaSys Group 2022</div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
