<?php
require_once '../../controllers/ZonaController.php';

$zonaController = new ZoneController();
$zonaController->registerZone();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Gestionar Zonas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=xdevice-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/icons">
</head>
<body>
    <!-- SideBar -->
    <section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				Park-Easy <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="./assets/img/avatar.jpg" alt="UserIcon">
					<figcaption class="text-center text-titles">User Name</figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="#!">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
						<a href="#!" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="home.html">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Dashboard
					</a>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administration <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="gestionZonas.html"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Zonas</a>
						</li>
						<li>
							<a href="gestionTarifas.html"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Tarifas</a>
						</li>
						<li>
							<a href="gestionReportes.html"><i class="zmdi zmdi-graduation-cap zmdi-hc-fw"></i> Reportes</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Users <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="admin.html"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Admin</a>
						</li>
						<li>
							<a href="teacher.html"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Usuarios</a>
						</li>
						<li>
							<a href="empresa.html"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Empresas</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i> Payments <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="registration.html"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Registration</a>
						</li>
						<li>
							<a href="payments.html"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Payments</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</section>

    <!-- Content page-->
    <section class="full-box dashboard-contentPage">
        <!-- NavBar -->
        <nav class="full-box dashboard-Navbar">
            <ul class="full-box list-unstyled text-right">
                <li class="pull-left">
                    <a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
                </li>
                <li>
                    <a href="#!" class="btn-Notifications-area">
                        <i class="zmdi zmdi-notifications-none"></i>
                        <span class="badge">7</span>
                    </a>
                </li>
                <li>
                    <a href="#!" class="btn-search">
                        <i class="zmdi zmdi-search"></i>
                    </a>
                </li>
                <li>
                    <a href="#!" class="btn-modal-help">
                        <i class="zmdi zmdi-help-outline"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Content page -->
        <div class="container-fluid">
            <div class="page-header">
                <h1 class="text-titles"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Gestión de Zonas <small>Registro</small></h1>
            </div>
            <p class="lead">Aquí puedes gestionar las zonas de estacionamiento. Agrega, edita o elimina zonas según sea necesario.</p>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                        <li class="active"><a href="#new" data-toggle="tab">Nueva Zona</a></li>
                        <li><a href="#list" data-toggle="tab">Lista de Zonas</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="new">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                                        <form action="gestionar_zonas.php" method="POST">
    
                                            
                                        <div class="form-group label-floating">
                                                <label class="control-label">ID Empresa:</label>
                                                <input class="form-control"  type="number" name="id_empresa" required>
                                            </div>

                                        <div class="form-group label-floating">
                                                <label class="control-label">Nombre de la Zona</label>
                                                <input class="form-control" type="text" id="nombre" name="nombre" required>
                                            </div>

                                            <div class="form-group label-floating">
                                                <label class="control-label">Ubicación</label>
                                                <input class="form-control" type="text"  id="ubicacion" name="ubicacion" required>
                                            </div>

                                            <div class="form-group label-floating">
                                                <label class="control-label">Latitud</label>
                                                <input class="form-control" type="text" name="latitud"  required>
                                            </div>

                                            <div class="form-group label-floating">
                                                <label class="control-label">Longitud</label>
                                                <input class="form-control" type="text" name="longitud" required>
                                            </div>
                                            
                                            <label class="control-label">Capacidad (Número de Espacios):</label>
                                            <input type="number" name="capacidad" class="form-control" required><br>

                                            <p class="text-center">
                                                <button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Agregar Zona</button>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list">
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Ubicación</th>
                                            <th class="text-center">Capacidad</th>
                                            <th class="text-center">Empresa</th>
                                            <th class="text-center">Tarifa</th>
                                            <th class="text-center">Actualizar</th>
                                            <th class="text-center">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($zones as $zone): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($zone['id']); ?></td>
                                            <td><?php echo htmlspecialchars($zone['nombre']); ?></td>
                                            <td><?php echo htmlspecialchars($zone['ubicacion']); ?></td>
                                            <td><?php echo htmlspecialchars($zone['capacidad']); ?></td>
                                            <td><?php echo htmlspecialchars($zone['id_empresa']); ?></td>
                                            <td><?php echo htmlspecialchars($zone['id_tarifa']); ?></td>
                                            <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                                            <td><a href="/admin/zones/delete?id=<?php echo $zone['id']; ?>" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <ul class="pagination pagination-sm">
                                    <li class="disabled"><a href="#!">«</a></li>
                                    <li class="active"><a href="#!">1</a></li>
                                    <li><a href="#!">2</a></li>
                                    <li><a href="#!">3</a></li>
                                    <li><a href="#!">»</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Notifications area -->
    <section class="full-box Notifications-area">
        <div class="full-box Notifications-bg btn-Notifications-area"></div>
        <div class="full-box Notifications-body">
            <div class="Notifications-body-title text-titles text-center">
                Notificaciones <i class="zmdi zmdi-close btn-Notifications-area"></i>
            </div>
            <div class="list-group">
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="zmdi zmdi-alert-triangle"></i>
                    </div>
                    <div class="row-content">
                        <div class="least-content">17m</div>
                        <h4 class="list-group-item-heading">Título con etiqueta</h4>
                        <p class="list-group-item-text">Hecho con éxito.</p>
                    </div>
                </div>
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="zmdi zmdi-alert-octagon"></i>
                    </div>
                    <div class="row-content">
                        <div class="least-content">15m</div>
                        <h4 class="list-group-item-heading">Título con etiqueta</h4>
                        <p class="list-group-item-text">Se produjo un error.</p>
                    </div>
                </div>
                <div class="list-group-separator"></div>
                <div class="list-group-item">
                    <div class="row-action-primary">
                        <i class="zmdi zmdi-help"></i>
                    </div>
                    <div class="row-content">
                        <div class="least-content">10m</div>
                        <h4 class="list-group-item-heading">Título con etiqueta</h4>
                        <p class="list-group-item-text">Necesitas ayuda.</p>
                    </div>
                </div>
                <div class="list-group-separator"></div>
            </div>
        </div>
    </section>

    <!-- Dialog help -->
    <div class="modal fade" tabindex="-1" role="dialog" id="Dialog-Help">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ayuda</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Aquí puedes encontrar información útil sobre cómo gestionar zonas.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!--====== Scripts -->
    <script src="/assets/js/jquery-3.1.1.min.js"></script>
    <script src="/assets/js/sweetalert2.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/material.min.js"></script>
    <script src="/assets/js/ripples.min.js"></script>
    <script src="/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/assets/js/mains.js"></script>
    <script>
        $.material.init();
    </script>
</body>
</html>
