<?php
require 'db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $db = $conn;
    $tableName = "user";
    $columns = ['id', 'firstname', 'lastname', 'password'];
    $condition = "username = '" . $username . "'";
    $user = fetch_data($db, $tableName, $columns, $condition);
    if ($user !== false && $password === $user[0]['password']) {
        $_SESSION['userid'] = $user[0]['id'];
        $_SESSION['username'] = $username;
        $_SESSION['student'] = $user[0]['id'];
        echo "<script>window.location = 'http://" . $_SERVER['HTTP_HOST'] . "/index.php'</script>";
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }
} else {
    $_SESSION = [];
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>KoMaSys - Login</title>
    <link href="css/styles.css" rel="stylesheet" />
  <script src="alert/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="alert/dist/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-secondary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="username" id="inputEmail" type="text" placeholder="name@example.com" required />
                                            <label for="inputEmail">Benutzername</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" required />
                                            <label for="inputPassword">Passwort</label>
                                        </div>
                                        <?php
                                            if(isset($errorMessage)){
                                                echo "<span class='text-danger'>$errorMessage</span>";
                                            }
                                        ?> 
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="https://identity.iubh.de/service/public/forgottenpassword" target="blank">Passwort vergessen?</a>
                                            <input type="submit" value="Login" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
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
</body>

</html>