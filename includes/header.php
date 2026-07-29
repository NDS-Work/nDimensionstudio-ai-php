
<header class="site-header sticky-top">
  <nav class="navbar navbar-expand-xl container py-3">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= url() ?>" aria-label="nDimensions.ai home">
      <span class="brand-mark">n</span>
      <span class="fw-bold">nDimensions<span class="text-muted">.ai</span></span>
    </a>
    <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteNav" aria-controls="siteNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <div class="collapse navbar-collapse justify-content-center" id="siteNav">
      <ul class="navbar-nav align-items-lg-center gap-lg-1">

        <!-- Products Mega Menu -->
        <li class="nav-item mega-parent">
          <a class="nav-link mega-trigger <?= in_array($activePage ?? '', ['home','growstack','bizgrid']) ? 'active' : '' ?>" href="#" aria-expanded="false">
            Products
            <svg class="mega-chevron" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M3 5l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
          <div class="mega-menu">
            <div class="mega-menu-inner">
              <a class="mega-card" href="<?= url('growstack.php') ?>">
                <div class="mega-card-icon mega-icon-grow">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <div class="mega-card-arrow">↗</div>
                <div class="mega-card-label">AI GROWTH SYSTEM</div>
                <div class="mega-card-title">GrowSTACK</div>
                <div class="mega-card-desc">One connected system for visibility, demand, nurturing and pipeline.</div>
                <div class="mega-card-link mega-link-grow">Explore GrowSTACK ↗</div>
              </a>
              <a class="mega-card" href="<?= url('bizgrid.php') ?>">
                <div class="mega-card-icon mega-icon-biz">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                </div>
                <div class="mega-card-arrow">↗</div>
                <div class="mega-card-label">CUSTOM AI BUSINESS SYSTEMS</div>
                <div class="mega-card-title">BizGRID</div>
                <div class="mega-card-desc">Connect business data, workflows, decisions and internal AI agents.</div>
                <div class="mega-card-link mega-link-biz">Explore BizGRID ↗</div>
              </a>
              <a class="mega-card" href="<?= url('index.php#products') ?>">
                <div class="mega-card-icon mega-icon-cre">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <div class="mega-card-arrow">↗</div>
                <div class="mega-card-label">AI-ASSISTED CREATIVE PRODUCTION</div>
                <div class="mega-card-title">Cre8LAB</div>
                <div class="mega-card-desc">Turn strategy into campaign-ready creative — visuals, video, variations.</div>
                <div class="mega-card-link mega-link-cre">Explore Cre8LAB ↗</div>
              </a>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">AI Agents</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Use Cases</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Industries</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Insights</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Explore Our Systems</a>
        </li>
      </ul>
    </div>
    <!-- Hamburger -->
<button class="hamburger" id="hamburger" aria-label="Toggle menu" aria-expanded="false">
  <span></span>
  <span></span>
  <span></span>
</button>
    <a class="btn btn-dark rounded-pill px-4 ms-3 flex-shrink-0" href="#contact">Book AI Growth Audit ↗</a>
  </nav>
</header>
<div class="mobile-nav" id="mobileNav">
  <button class="mobile-products-toggle" id="mobProductsToggle">
    Products
    <svg class="mob-chevron" width="16" height="16" viewBox="0 0 14 14" fill="none">
      <path d="M3 5l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </button>
  <div class="mobile-products-panel" id="mobProductsPanel">
    <a class="mobile-mega-card" href="<?= url('growstack.php') ?>">
      <div class="mob-icon mob-icon-grow">⚡</div>
      <div><div class="mob-card-label">AI Growth System</div><div class="mob-card-title">GrowSTACK</div><div class="mob-card-desc">One connected system for visibility, demand, nurturing and pipeline.</div></div>
    </a>
    <a class="mobile-mega-card" href="<?= url('bizgrid.php') ?>">
      <div class="mob-icon mob-icon-biz">⊞</div>
      <div><div class="mob-card-label">Custom AI Business Systems</div><div class="mob-card-title">BizGRID</div><div class="mob-card-desc">Connect business data, workflows, decisions and internal AI agents.</div></div>
    </a>
    <a class="mobile-mega-card" href="<?= url('index.php#products') ?>">
      <div class="mob-icon mob-icon-cre">✦</div>
      <div><div class="mob-card-label">AI-Assisted Creative Production</div><div class="mob-card-title">Cre8LAB</div><div class="mob-card-desc">Turn strategy into campaign-ready creative — visuals, video, variations.</div></div>
    </a>
  </div>
  <a class="mobile-nav-link" href="#">AI Agents <span>→</span></a>
  <a class="mobile-nav-link" href="#">Use Cases <span>→</span></a>
  <a class="mobile-nav-link" href="#">Industries <span>→</span></a>
  <a class="mobile-nav-link" href="#">Insights <span>→</span></a>
  <a class="mobile-nav-link" href="#">About <span>→</span></a>
  <a class="mobile-nav-link" href="#">Explore Our Systems <span>→</span></a>
  <a class="mobile-cta" href="#contact">Book AI Growth Audit ↗</a>
</div>