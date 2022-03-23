<?php
  include("db.php");
  session_start();
  
  $db = $conn;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studycourse =  $_REQUEST['studycourse'];
    $course = $_REQUEST['course'];
    $source = $_REQUEST['source'];
    $fault =  $_REQUEST['fault'];
    $suggestion = $_REQUEST['suggestion'];
        
    // Performing insert query execution
    $sql = "INSERT INTO error_messages (`created_at`, `created_user_id`, `study_course`, `course`, `source`, `fault`, `suggestion`, `tutor_user_id`) 
        VALUES ( '".date("Y-m-d")."', '".$_SESSION['userid']."', '$studycourse','$course','$source','$fault','$suggestion', 2)";
    $res = insert_data($db, $sql);
    if($res === 'success'){
        echo "<script>window.location = 'http://" . $_SERVER['HTTP_HOST'] . "/index.php'</script>";
    } else {
        echo $res;
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
        <title>KoMaSys - Fehlererfassung</title>
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
                        <div class="small">Angemeldet als:<br/><?php echo $_SESSION['username'];?> <a href="./login.php">Ausloggen</a></div>
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
                        <form action="newerror.php" method="post">
                            <div class="form-group row p-1">
                                <label class="col-4" for="studycourse">Studiengang *</label>
                                <div class="col-8">
                                    <select class="form-control col-8" name ="studycourse" id="studycourse" disabled>
                                        <option>B. Sc. Informatik</option>
                                        <option>B. Sc. Wirtschaftsinformatik</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-4" for="course">Kurs *</label>
                                <div class="col-8">
                                    <select class="form-control col-8" name ="course" id="course" required>
                                        <option>DLBIADPS01	Algorithmen, Datenstrukturen und Programmiersprachen</option>
                                        <option>DLBIBRVS01	Betriebssysteme, Rechnernetze und verteilte Systeme</option>
                                        <option>BBWL01-01	BWL I</option>
                                        <option>BBWL02-01	BWL II</option>
                                        <option>BWCN01	Business Consulting I</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-4" for="source">Fehlerquelle *</label>
                                <div class="col-8">
                                    <select class="form-control" name ="source" id="source" required>
                                    <option>PDF-Skript</option>
                                    <option>Gedrucktes Skript</option>
                                    <option>Online Test</option>
                                    <option>Podcast</option>
                                    <option>Videogalerie</option>
                                    <option>Reader (IU Learn App)</option>
                                    <option>Interactive Quiz (IU Learn App)</option>
                                    <option>KurzVideos (IU Learn App)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label for="fault" class="col-4">Fehlerbeschreibung *</label>
                                <div class="col-8">
                                    <textarea class="form-control" name ="fault" id="fault" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label for="suggestion" class="col-4">Korrekturvorschlag</label>
                                <div class="col-8">
                                    <textarea class="form-control col-8" name ="suggestion" id="suggestion"></textarea>
                                </div>
                            </div>
                            <span class="small">* Pflichtfeld</span><br/>
                            <button type="submit" class="btn btn-info mt-2">Senden</button>
                        </form>
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
