        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">GSB</div>
            </a>
            <!-- Intitulé de la section -->
            <hr class="sidebar-divider my-0">

            <!-- Menu - Tableau de Bord -->
            <li <?php if ($page == 1) { $active = " active"; } else { $active = NULL; } ?> class="nav-item<?= $active; ?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de Bord</span></a>
            </li>

            <!-- Séparation -->
            <hr class="sidebar-divider">

            <!-- Intitulé de la section -->
            <div class="sidebar-heading">
                Consultation
            </div>

            <!-- Menu - Page Factures -->
            <li <?php if ($page == 2) { $active = " active"; } else { $active = NULL; } ?> class="nav-item<?= $active; ?>">
                <a class="nav-link" href="mes-fiches-frais.php">
                    <i class="fas fa-clone fa-chart-area"></i>
                    <span>Mes fiches frais</span></a>
            </li>
            <li <?php if ($page == 2) { $active = " active"; } else { $active = NULL; } ?> class="nav-item<?= $active; ?>">
                <a class="nav-link" href="mes-fiches-frais.php">
                    <i class="fas fa-plus fa-chart-area"></i>
                    <span>Ajouter Frais Forfait</span></a>
            </li>
            <li <?php if ($page == 2) { $active = " active"; } else { $active = NULL; } ?> class="nav-item<?= $active; ?>">
                <a class="nav-link" href="mes-fiches-frais.php">
                    <i class="fas fa-plus fa-chart-area"></i>
                    <span>Ajouter Frais Hors Forfait</span></a>
            </li>

            <!-- Séparation -->
            <hr class="sidebar-divider">


            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div align="right">
                        <p>Date du jour : <? date("d/m/Y"); ?></p>
                    </div>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $prenom . ' ' .$nom; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Mon profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>