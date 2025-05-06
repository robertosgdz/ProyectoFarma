<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand ms-3" href="index.php">
        <span class="fs-4">PFarma</span>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list fs-1"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">

        <li class="nav-item me-0 me-lg-5">
                <a href="index.php?controlador=pedidos&action=home" class="nav-link d-flex flex-column align-items-center">
                    <i class="bi bi-bag-check fs-2 mb-2"></i>
                    <span class="d-none d-sm-block">Pedidos</span>
                </a>
            </li>


            <li class="nav-item me-0 me-lg-5">
                <a href="index.php?controlador=productos&action=home" class="nav-link d-flex flex-column align-items-center">
                    <i class="bi bi-grid-3x3-gap fs-2 mb-2"></i>
                    <span class="d-none d-sm-block">Productos</span>
                </a>
            </li>

           



            <?php if (isset($_SESSION['nombre'])): ?>
                <li class="nav-item me-0 me-lg-5">
                    <a href="#" class="nav-link d-flex flex-column align-items-center">
                        <i class="bi bi-plus-circle fs-2 mb-2"></i>
                        <span class="d-none d-sm-block">Insertar producto</span>
                    </a>
                </li>
                <li class="nav-item me-0 me-lg-5">
                    <a href="index.php?controlador=usuarios&action=desconectar" class="nav-link d-flex flex-column align-items-center text-danger">
                        <i class="bi bi-box-arrow-right fs-2 mb-2"></i>
                        <span class="d-none d-sm-block">Desconectar</span>
                    </a>
                </li>
            <?php else: ?>
                <li class="nav-item me-0 me-lg-5">
                    <a href="index.php?controlador=usuarios&action=login" class="nav-link d-flex flex-column align-items-center">
                        <i class="bi bi-person-circle fs-2 mb-2"></i>
                        <span class="d-none d-sm-block">Cuenta</span>
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</nav>
