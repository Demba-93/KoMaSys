<?php
include("db.php");
session_start();

if (!isset($_SESSION['userid'])) {
    echo "<script>window.location = 'http://" . $_SERVER['HTTP_HOST'] . "/login.php'</script>";
}

$userid = $_SESSION['userid'];
$db = $conn;
$tableName = "error_messages";
$columns = ['id', 'study_course', 'course', 'source', 'fault', "created_at", "read_at", "in_process", "rejected", "corrected", "archive_read_at"];
$condition = "(created_user_id ='" . $userid . "' OR  tutor_user_id = '" . $userid . "') AND archive = 1";
$fetchData = fetch_data($db, $tableName, $columns, $condition);
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>KoMaSys - Archiv</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://d3js.org/d3.v5.min.js"></script>
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
                            Hauptmenü
                        </a>
                        <a class="nav-link" href="archive.php">
                            Archiv
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Angemeldet als:<br /><?php echo $_SESSION['username']; ?> <a href="./login.php">Ausloggen</a></div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row">
                        <h1 class="mt-4 col-8">Archiv</h1>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kurs</th>
                                        <th>Fehlerquelle</th>
                                        <th>Meldedatum</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kurs</th>
                                        <th>Fehlerquelle</th>
                                        <th>Meldedatum</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    if (is_array($fetchData)) {
                                        $sn = 1;
                                        foreach ($fetchData as $data) {
                                    ?>
                                            <tr style="<?php echo !isset($data['archive_read_at']) && $_SESSION['student'] == '1' ? 'background-color: #DBE8FA' : '' ?>">
                                                <td><a href="./answer.php?id=<?php echo $data['id']; ?>"><?php echo $data['id']; ?></a></td>
                                                <td><?php echo explode(' ', $data['course'])[0]; ?></td>
                                                <td><?php echo $data['source']; ?></td>
                                                <td><?php echo $data['created_at']; ?></td>
                                                <td><?php echo $data['corrected'] === '1' ? 'Abgeschlossen' : 'Abgelehnt'; ?></td>
                                            </tr>
                                        <?php
                                            $sn++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="8">
                                                <?php echo $fetchData; ?>
                                            </td>
                                        <tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; KoMaSys GmbH 2022</div>
                        <div>
                            <a href="https://login.iubh.de/policy/impressum_de.pdf" target="blank">Impressum</a>
                            &middot;
                            <a href="https://login.iubh.de/policy/privacy_policy_de.pdf" target="blank">Datenschutzerklärung</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/simple-datatable.js" ></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>