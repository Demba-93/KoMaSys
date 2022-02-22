<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>KoMaSys - Fehlermeldungen</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://d3js.org/d3.v5.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">KoMaSys</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Hauptmenü
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Angemeldet als:<br/>Username <a href="./login.html">Ausloggen</a></div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="row">
                            <h1 class="mt-4 col-8">Fehlermeldungen</h1>
                            <a href="./newerror.html" class="col-3 mt-4 mb-4 btn btn-secondary" role="button"><i class="fa fa-plus-circle"></i> Neue Fehlermeldung</a>
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
                                        <tr>
                                            <td><a href="./answer.html">23</a></td>
                                            <td>IPWA01</td>
                                            <td>PDF Skript</td>
                                            <td>2011/04/25</td>
                                            <td>offen</td>
                                        </tr>
                                        <tr>
                                            <td><a href="./archive.html">27</a></td>
                                            <td>IOBP</td>
                                            <td>Online Test</td>
                                            <td>2011/07/25</td>
                                            <td>abgeschlossen</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <p><a href="#" class="col-3 mt-4 mb-4" role="button">Archiv <span class="badge badge-secondary">1</span></a></p>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; KoMaSys GmbH 2022</div>
                            <div>
                                <a href="https://login.iubh.de/policy/impressum_de.pdf" target="blank">Impressum</a>
                                &middot;
                                <a href="https://login.iubh.de/policy/privacy_policy_de.pdf" target="blank">DAtenschutzerklärung</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<script>
    $(document).ready(function() {
        console.log( "ready!" );
        d3.csv("/data/errormessages.csv/", function(data) {
            for (var i = 0; i < data.length; i++) {
                console.log(data[i].ID);
                console.log(data[i].module);
                console.log(data[i].source);
                console.log(data[i].createdDate);
            }
        });

        $('#datatablesSimple').DataTable( {
            language: {
                url: 'dataTables.german.json'
            }
        } );
    } );

</script>