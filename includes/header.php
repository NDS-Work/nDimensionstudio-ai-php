<header class="site-header sticky-top">
    <nav class="navbar navbar-expand-lg container py-3" aria-label="Primary navigation">
        <a class="navbar-brand d-flex align-items-center" href="<?= url() ?>" aria-label="nDimensions.ai home">
            <img class="site-logo" src="assets/images/nds-logo.png" alt="nDimensions.ai">
        </a>

        <div class="d-flex align-items-center gap-2 order-lg-3">
            <a class="btn btn-dark rounded-pill px-4 d-none d-md-inline-flex" href="<?= url('contact-us.php') ?>">Book AI Growth Audit <i class="bi bi-arrow-up-right"></i></a>
            <button class="navbar-toggler border rounded-circle p-2" type="button" data-bs-toggle="collapse" data-bs-target="#siteNav" aria-controls="siteNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-4"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse order-lg-2" id="siteNav">
            <ul class="navbar-nav align-items-lg-center gap-lg-1 mx-lg-auto py-4 py-lg-0">
                <li class="nav-item mega-parent d-none d-lg-block">
                    <button class="nav-link mega-trigger <?= in_array($activePage ?? '', ['home', 'growstack', 'bizgrid', 'cre8lab']) ? 'active' : '' ?>" type="button" aria-expanded="false">
                        Products <i class="bi bi-chevron-down small"></i>
                    </button>
                    <div class="mega-menu">
                        <div class="mega-menu-inner">
                            <a class="mega-card mega-card-grow" href="<?= url('growstack.php') ?>">
                                <span class="pg-dotted-glow" aria-hidden="true"></span>
                                <div class="mega-card-icon mega-icon-grow"><i class="bi bi-lightning-charge"></i></div>
                                <div class="mega-card-arrow"><i class="bi bi-arrow-up-right"></i></div>
                                <div class="mega-card-label">AI Growth System</div>
                                <div class="mega-card-title">GrowSTACK</div>
                                <div class="mega-card-desc">One connected system for visibility, demand, nurturing and pipeline.</div>
                                <div class="mega-card-link mega-link-grow">Explore GrowSTACK <i class="bi bi-arrow-up-right"></i></div>
                            </a>
                            <a class="mega-card mega-card-biz" href="<?= url('bizgrid.php') ?>">
                                <span class="pg-dotted-glow" aria-hidden="true"></span>
                                <div class="mega-card-icon mega-icon-biz"><i class="bi bi-grid-3x3-gap"></i></div>
                                <div class="mega-card-arrow"><i class="bi bi-arrow-up-right"></i></div>
                                <div class="mega-card-label">Custom AI Business Systems</div>
                                <div class="mega-card-title">BizGRID</div>
                                <div class="mega-card-desc">Connect business data, workflows, decisions and internal AI agents.</div>
                                <div class="mega-card-link mega-link-biz">Explore BizGRID <i class="bi bi-arrow-up-right"></i></div>
                            </a>
                            <a class="mega-card mega-card-cre" href="<?= url('coming-soon.php?product=cre8lab') ?>">
                                <span class="pg-dotted-glow" aria-hidden="true"></span>
                                <div class="mega-card-icon mega-icon-cre"><i class="bi bi-stars"></i></div>
                                <div class="mega-card-arrow"><i class="bi bi-arrow-up-right"></i></div>
                                <div class="mega-card-label">AI-Assisted Creative Production</div>
                                <div class="mega-card-title">Cre8LAB</div>
                                <div class="mega-card-desc">Turn strategy into campaign-ready creative: visuals, video and variations.</div>
                                <div class="mega-card-link mega-link-cre">Explore Cre8LAB <i class="bi bi-arrow-up-right"></i></div>
                            </a>
                        </div>
                    </div>
                </li>

                <li class="nav-item d-lg-none mb-3">
                    <p class="eyebrow mb-3">Products</p>
                    <div class="row g-2">
                        <div class="col-md-4"><a class="mobile-mega-card h-100" href="<?= url('growstack.php') ?>"><span><strong class="d-block">GrowSTACK</strong><small>AI Growth System</small></span><i class="bi bi-arrow-up-right"></i></a></div>
                        <div class="col-md-4"><a class="mobile-mega-card h-100" href="<?= url('bizgrid.php') ?>"><span><strong class="d-block">BizGRID</strong><small>Custom AI Business Systems</small></span><i class="bi bi-arrow-up-right"></i></a></div>
                        <div class="col-md-4"><a class="mobile-mega-card h-100" href="<?= url('coming-soon.php?product=cre8lab') ?>"><span><strong class="d-block">Cre8LAB</strong><small>Creative Production</small></span><i class="bi bi-arrow-up-right"></i></a></div>
                    </div>
                </li>

                <li class="nav-item"><a class="nav-link" href="<?= url('index.php#products') ?>">AI Agents</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('index.php#problem-selector') ?>">Use Cases</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('index.php#proof') ?>">Industries</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('index.php#faq') ?>">Insights</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('index.php#operating-model') ?>">About</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= url('index.php#products') ?>">Explore Our Systems</a></li>
                <li class="nav-item d-md-none mt-3"><a class="btn btn-dark rounded-pill w-100" href="<?= url('contact-us.php') ?>">Book AI Growth Audit <i class="bi bi-arrow-up-right"></i></a></li>
            </ul>
        </div>
    </nav>
</header>
