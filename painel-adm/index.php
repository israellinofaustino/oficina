<?php
require_once("../conexao.php");
session_start();

if($_SESSION['nivel_usuario'] == null || $_SESSION['nivel_usuario'] != 'admin'){
    echo "<script language='javascript'> window.location='../index.php' </script>";
}

// RECUPERAR DADOS DO USUARIO
$query = $pdo->query("SELECT * FROM public.usuarios WHERE id = '$_SESSION[id_usuario]'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$nome_usu = $res[0]['nome'];
$cpf_usu = $res[0]['cpf'];
$email_usu = $res[0]['email'];

//variaveis para o menu
$pag = @$_GET["pag"];
$menu1 = "mecanico";
$menu2 = "recepcionistas";
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administrative Panel</title>

    <!-- Custom fonts for this template-->
    <link href="../static/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <link href="../static/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="../static/jquery/jquery.min.js"></script>
    <script src="../static/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="../img/logo-favicon.ico" type="image/x-icon">
    <link rel="icon" href="../img/logo-favicon.ico" type="image/x-icon">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

                <div class="sidebar-brand-text mx-3">Administrator</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Records
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>Employees</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu1 ?>">Mechanic</a>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu2 ?>">Receptionists</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-home"></i>
                    <span>Options</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Datas XX:</h6>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu3 ?>">Menu 3</a>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu4 ?>">Menu 4</a>
                        <a class="collapse-item" href="index.php?pag=<?php echo $menu5 ?>">Menu 5</a>

                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Queries
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?pag=<?php echo $menu6 ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Menu 6</span></a>
            </li>

            <!-- Nav Item - Tables -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <img class="" src="../img/logo2.png" width="80">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $nome_usu; ?> </span>
                                <img class="img-profile rounded-circle" src="../img/sem-foto.jpg">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#ModalPerfil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                                    Edit profile
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                    Exit
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php if (@$pag == null) { 
                        @include_once("home.php"); 
                        
                        } else if (@$pag==$menu1) {
                        @include_once(@$menu1.".php");
                        
                        } else if (@$pag==$menu2) {
                        @include_once(@$menu2.".php");

                        } else {
                        @include_once("home.php");
                        }
                        ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!--  Modal Perfil-->
    <div class="modal fade" id="ModalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form id="form-perfil" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">

                                <div class="form-group">
                                    <label>Name</label>
                                    <input value="<?php echo $nome_usu ?>" type="text" class="form-control" id="nome_usu"
                                        name="nome_usu" placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <label>CPF</label>
                                    <input value="<?php echo $cpf_usu ?>" type="text" class="form-control" id="cpf"
                                        name="cpf_usu" placeholder="CPF">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input value="<?php echo $email_usu ?>" type="email" class="form-control" id="email_usu"
                                        name="email_usu" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input value="" type="password" class="form-control" id="senha_usu" name="senha_usu"
                                        placeholder="Password">
                                </div>
                        <small>
                            <div id="mensagem" class="mr-4">

                            </div>
                        </small>

                    </div>
                    <div class="modal-footer">
                        <input value="<?php echo $_SESSION['id_usuario']; ?>" type="hidden" name="id_usu" id="id_usu">
                        <input value="<?php echo $cpf_usu ?>" type="hidden" name="antigo_usu" id="antigo_usu">

                        <button type="button" id="btn-fechar-perfil" class="btn btn-secondary"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" name="btn-salvar-perfil" id="btn-salvar-perfil"
                            class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM OU SEM IMAGEM -->
<script type="text/javascript">
    $("#form-perfil").submit(function () {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "editar-perfil.php",
            type: 'POST',
            data: formData,

            success: function (mensagem) {
                $('#mensagem').removeClass()
                if (mensagem.trim() == "Saved successfully!") {
                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar-perfil').click();
                    window.location = "index.php";
                } else {
                    $('#mensagem').addClass('text-danger')
                }
                $('#mensagem').text(mensagem)
            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () { // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });
</script>

    <!-- Core plugin JavaScript-->
    <script src="../static/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../static/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../static/datatables/jquery.dataTables.min.js"></script>
    <script src="../static/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <!-- Scripts para mascara -->
    <script src="../js/mascaras.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


</body>
</html>