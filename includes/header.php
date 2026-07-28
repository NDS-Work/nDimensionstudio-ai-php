<header class="site-header sticky-top">
    <nav class="navbar navbar-expand-lg container py-3">
        <a class="navbar-brand d-flex align-items-center gap-2" href="<?= url() ?>" aria-label="nDimensions.ai home">
            <span class="brand-mark">n</span>
            <span class="fw-bold">nDimensions<span class="text-muted">.ai</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteNav" aria-controls="siteNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="siteNav">
            <ul class="navbar-nav align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link <?= activeClass('home', $activePage ?? '') ?>" href="<?= url() ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeClass('growstack', $activePage ?? '') ?>" href="<?= url('growstack.php') ?>">GrowSTACK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeClass('bizgrid', $activePage ?? '') ?>" href="<?= url('bizgrid.php') ?>">BizGRID</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('index.php#products') ?>">Products</a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-dark rounded-pill px-4" href="#contact">Book AI Growth Audit</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
