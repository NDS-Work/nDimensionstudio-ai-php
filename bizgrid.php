<?php
$activePage = 'bizgrid';
$pageTitle = 'BizGRID | Custom AI Business Systems';
$metaDescription = 'BizGRID connects data, dashboards, workflows and AI agents around the way your business actually operates.';
$ogTitle = 'BizGRID | nDimensions.ai';
$ogDescription = 'Build the business system your software never gave you with BizGRID.';
$canonicalUrl = 'https://ndimensions.ai/ai/bizgrid';
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';

$bizLayers = [
    ['Connect the data', 'Every source, in one grid.', 'bi-database', ['CRM and ERP integrations', 'Marketing, sales and ops data', 'Spreadsheet + database connections', 'API integrations', 'Automated data cleaning', 'Data synchronisation']],
    ['See the business', 'Dashboards leadership actually opens.', 'bi-graph-up', ['Executive dashboards', 'Sales + marketing reporting', 'Operations dashboards', 'Finance + performance views', 'Automated alerts', 'Exception reporting']],
    ['Automate the workflow', 'Cross-team handoffs that do not drop the ball.', 'bi-diagram-3', ['Task creation + assignment', 'Approval workflows', 'Notifications + reminders', 'Cross-team handoffs', 'Escalation logic', 'Scheduled reports']],
    ['Put knowledge to work', 'Answers where the work happens.', 'bi-lightbulb', ['Internal knowledge assistants', 'SOP + policy search', 'Document Q&A', 'Employee-support agents', 'Research agents', 'Reporting agents']],
    ['Build what does not exist', 'Production-ready AI, not experiments.', 'bi-tools', ['Custom AI agents', 'AI MVP development', 'Internal tools', 'Customer-facing interfaces', 'Document intelligence', 'Classification + extraction']],
];

$bizUseCases = [
    ['Unified leadership dashboard', 'Sales, marketing, ops and finance in one live view.', 'Daily sync', 'Consolidate + normalise', 'Anomaly threshold', 'Board-ready view every morning', 'bi-graph-up'],
    ['Lead-to-delivery handoff', 'Won deals cascading straight into onboarding.', 'Deal closed-won', 'Create project + assign', 'Account owner sign-off', '0-touch kickoff in 24h', 'bi-lightning-charge'],
    ['Marketing &times; finance reconciliation', 'Ad spend, CAC, pipeline attribution.', 'Monthly close', 'Reconcile spend vs. pipeline', 'Finance review', 'Attribution report auto-generated', 'bi-database'],
    ['Approval + escalation workflow', 'Any request, any team, with SLAs.', 'Request submitted', 'Route + notify approver', 'Human decision', 'SLA-tracked resolution', 'bi-diagram-3'],
    ['Proposal + report generation', 'Brand-locked docs generated from data.', 'Opportunity qualified', 'Assemble proposal from CRM', 'Sales review', 'Send-ready doc in minutes', 'bi-file-earmark-text'],
    ['Internal SOP assistant', 'One place to answer how do we do X?', 'Employee query', 'Search SOPs + policies', 'Cite sources', 'Answer with references', 'bi-lightbulb'],
    ['Customer-support knowledge agent', 'Faster tickets. Consistent voice.', 'Ticket opened', 'Draft response + suggest steps', 'Agent review', 'Higher CSAT, lower AHT', 'bi-chat-dots'],
    ['AI MVP for internal tool', 'Prototype to production, engineered.', 'Business hypothesis', 'Build, evaluate, deploy', 'Governance review', 'Live in weeks, not quarters', 'bi-cpu'],
];
?>

<main class="bizgrid-page">
    <section class="section-dark position-relative overflow-hidden py-5">
        <div class="nd-dot-grid position-absolute top-0 start-0 w-100 h-100 opacity-50"></div>
        <div class="container position-relative py-lg-5">
            <div class="row g-md-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <p class="eyebrow text-info">BizGRID &middot; Custom AI Business System</p>
                    <h1 class="bg-hero-title mt-4">
                        <span class="d-block">Build the business</span>
                        <span class="d-block">system your software</span>
                        <span class="d-block fst-italic fw-normal text-secondary">never gave you.</span>
                    </h1>
                    <p class="lead text-light-emphasis mt-4 mb-4">BizGRID connects data, dashboards, workflows, documents and AI agents around the way your business actually operates.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a class="btn btn-light rounded-pill px-4 py-2" href="#contact">Map Your BizGRID <i class="bi bi-arrow-up-right"></i></a>
                        <a class="btn btn-outline-light rounded-pill px-4 py-2" href="#contact">Book Automation Audit <i class="bi bi-arrow-up-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card-dark border rounded-4 p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="eyebrow text-info">Grid &middot; Live snapshot</span>
                            <span class="font-mono small text-success"><span class="nd-dot bg-success d-inline-block me-1"></span> all-green</span>
                        </div>
                        <div class="bg-white rounded-4 p-2">
                            <div class="bg-workflow-canvas">
                                <svg class="position-absolute top-0 start-0 w-100 h-100" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                                    <?php foreach ([[14, 24, 74, 26], [46, 12, 74, 26], [74, 26, 26, 64], [74, 26, 88, 66], [26, 64, 56, 78], [56, 78, 88, 66]] as $lineIndex => $line): ?>
                                        <line class="bg-workflow-line"
                                              x1="<?= $line[0] ?>" y1="<?= $line[1] ?>"
                                              x2="<?= $line[2] ?>" y2="<?= $line[3] ?>"
                                              pathLength="1"
                                              style="--bg-flow-delay:<?= 0.25 + ($lineIndex * 0.1) ?>s"></line>
                                    <?php endforeach; ?>
                                </svg>

                                <?php
                                $workflowNodes = [
                                    ['CRM', 'bi-database', 14, 24],
                                    ['Sheets', 'bi-file-earmark-text', 46, 12],
                                    ['AI Agent', 'bi-robot', 74, 26],
                                    ['Slack', 'bi-chat-dots', 26, 64],
                                    ['Team', 'bi-people', 56, 78],
                                    ['Dashboard', 'bi-lightning-charge', 88, 66],
                                ];
                                ?>
                                <?php foreach ($workflowNodes as $nodeIndex => $node): ?>
                                    <div class="bg-workflow-node d-flex align-items-center gap-2"
                                         style="left:<?= $node[2] ?>%;top:<?= $node[3] ?>%;--bg-flow-delay:<?= 0.12 + ($nodeIndex * 0.1) ?>s">
                                        <span class="bg-primary-subtle text-biz rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <i class="bi <?= $node[1] ?>"></i>
                                        </span>
                                        <small class="fw-semibold text-nowrap"><?= $node[0] ?></small>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="marquee-section marquee-dark" data-aos="fade-up">
        <div class="marquee-mask">
            <div class="marquee-track" aria-hidden="true">
                <?php for ($repeat = 0; $repeat < 2; $repeat++): ?>
                    <?php foreach (['Data', 'Dashboards', 'Workflows', 'Documents', 'Agents', 'Decisions'] as $item): ?>
                        <span class="marquee-item h-display"><span class="marquee-dot"></span><?= $item ?></span>
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row g-md-5 align-items-end mb-5">
                <div class="col-lg-7" data-aos="fade-right">
                    <p class="eyebrow">The invisible work</p>
                    <h2 class="nd-page-title mt-4">Your business is held<br><span class="fst-italic fw-normal text-secondary">together by manual handoffs.</span></h2>
                </div>
                <div class="col-lg-5" data-aos="fade-left">
                    <p class="lead text-muted">Someone downloads the report. Someone updates the spreadsheet. Someone sends the reminder. Someone knows where the document lives. Someone explains the process whenever a new person joins.</p>
                    <p class="lead fw-semibold mb-0">That works until volume grows, someone leaves, or leadership needs an answer now.</p>
                </div>
            </div>
            <div class="row g-md-4">
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="card-soft p-4 p-md-5 h-100">
                        <p class="eyebrow text-secondary">Before</p>
                        <h3 class="display-6 fw-bold mt-2">Everyone is the API</h3>
                        <ol class="list-unstyled d-grid gap-3 mt-4 mb-0">
                            <?php foreach (['Sales exports CSV from CRM', 'Ops pastes into spreadsheet', 'Finance formats the report', 'Someone messages a summary at 11pm', 'Leadership asks: is this right?'] as $index => $item): ?>
                                <li class="d-flex gap-3 text-muted"><span class="font-mono small">0<?= $index + 1 ?></span><?= $item ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-dark p-4 p-md-5 h-100">
                        <p class="eyebrow text-info">After &middot; BizGRID</p>
                        <h3 class="display-6 fw-bold mt-2">The system is the API</h3>
                        <ul class="list-unstyled d-grid gap-3 mt-4 mb-0">
                            <?php foreach (['Data unified across CRM + tools', 'Workflows trigger on real events', 'Reports arrive automatically', 'Exceptions escalate to humans', 'Leadership sees it live'] as $item): ?>
                                <li class="d-flex gap-3 text-light-emphasis"><i class="bi bi-check-circle-fill text-biz"></i><?= $item ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-soft border-top border-bottom">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-9" data-aos="fade-up">
                    <p class="eyebrow">The BizGRID model</p>
                    <h2 class="nd-page-title mt-4">One intelligent grid<br><span class="fst-italic fw-normal text-secondary">connecting data, work and decisions.</span></h2>
                </div>
            </div>
            <div class="row g-md-4">
                <div class="col-lg-4">
                    <div class="nav nav-pills flex-column gap-2 bg-layer-tabs" role="tablist">
                        <?php foreach ($bizLayers as $index => $layer): ?>
                            <button class="nav-link text-start border p-3 p-md-4 <?= $index === 0 ? 'active' : '' ?>"
                                    id="bg-layer-tab-<?= $index ?>"
                                    data-bs-toggle="pill"
                                    data-bs-target="#bg-layer-<?= $index ?>"
                                    type="button"
                                    role="tab"
                                    aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                                <span class="d-flex align-items-center gap-3">
                                    <span class="nd-icon-box nd-icon-box-biz"><i class="bi <?= $layer[2] ?>"></i></span>
                                    <span><small class="d-block font-mono text-uppercase opacity-75">Layer 0<?= $index + 1 ?></small><strong class="d-block fs-5 mt-1"><?= $layer[0] ?></strong></span>
                                </span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content h-100">
                        <?php foreach ($bizLayers as $index => $layer): ?>
                            <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?> h-100" id="bg-layer-<?= $index ?>" role="tabpanel">
                                <div class="card-soft p-4 p-md-5 h-100" data-aos="fade-up">
                                    <h3 class="display-6 fw-bold mb-4"><?= $layer[1] ?></h3>
                                    <div class="row g-md-4">
                                        <div class="col-md-7">
                                            <ul class="list-unstyled d-grid gap-3 mb-0">
                                                <?php foreach ($layer[3] as $item): ?>
                                                    <li class="d-flex gap-2"><i class="bi bi-check-circle-fill text-biz"></i><?= $item ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="border rounded-4 overflow-hidden h-100">
                                                <div class="bg-dark text-light d-flex align-items-center gap-1 px-3 py-2">
                                                    <span class="rounded-circle bg-danger" style="width:7px;height:7px"></span>
                                                    <span class="rounded-circle bg-warning" style="width:7px;height:7px"></span>
                                                    <span class="rounded-circle bg-success" style="width:7px;height:7px"></span>
                                                    <span class="font-mono text-secondary ms-1" style="font-size:9px">bizgrid &middot; leadership view</span>
                                                </div>
                                                <div class="bg-white p-2">
                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <div class="bg-light rounded-3 p-2 h-100">
                                                                <p class="font-mono text-secondary mb-1" style="font-size:9px">Pipeline (30d)</p>
                                                                <div class="h5 fw-bold mb-0">$1.42M</div>
                                                                <svg class="w-100 mt-1" height="28" viewBox="0 0 100 30" preserveAspectRatio="none" aria-hidden="true">
                                                                    <polyline class="gs-dashboard-line" fill="none" stroke="#2563eb" stroke-width="1.8" points="0,22 12,18 24,20 36,12 48,14 60,8 72,10 84,4 100,6"></polyline>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="bg-light rounded-3 p-2 h-100">
                                                                <p class="font-mono text-secondary mb-1" style="font-size:9px">Ops throughput</p>
                                                                <div class="h5 fw-bold text-biz mb-0">+38%</div>
                                                                <div class="d-flex align-items-end gap-1 mt-1" style="height:28px">
                                                                    <?php foreach ([40, 55, 45, 70, 62, 85, 90] as $barIndex => $height): ?>
                                                                        <span class="gs-event-bar bg-biz flex-grow-1 rounded-top"
                                                                              style="--gs-event-target:<?= $height ?>%;--gs-progress-delay:<?= 0.18 + ($barIndex * 0.06) ?>s"></span>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="bg-light rounded-3 p-2">
                                                                <p class="font-mono text-secondary mb-2" style="font-size:9px">Live workflows</p>
                                                                <?php foreach ([['Lead &rarr; CRM &rarr; Sales Slack alert', 'ok'], ['Weekly leadership report', 'ok'], ['Invoice OCR &rarr; Finance queue', 'run']] as $workflowIndex => $workflow): ?>
                                                                    <div class="gs-dashboard-workflow d-flex align-items-center gap-2 <?= $workflowIndex ? 'mt-1' : '' ?>"
                                                                         style="font-size:10px;--gs-progress-delay:<?= 0.48 + ($workflowIndex * 0.12) ?>s">
                                                                        <i class="bi bi-check-circle-fill text-success"></i>
                                                                        <span class="text-truncate flex-grow-1"><?= $workflow[0] ?></span>
                                                                        <span class="font-mono text-secondary" style="font-size:9px"><?= $workflow[1] ?></span>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row g-md-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <p class="eyebrow">Built around the process</p>
                    <h2 class="nd-page-title mt-4">
                        <span class="d-block">Your business</span>
                        <span class="d-block">shouldn&rsquo;t</span>
                        <span class="d-block fst-italic fw-normal text-secondary">adapt to another</span>
                        <span class="d-block fst-italic fw-normal text-secondary">generic tool.</span>
                    </h2>
                    <p class="lead text-muted mt-4">We begin with how the work actually happens &mdash; the teams involved, the information they need, the exceptions requiring judgment, and the repetitive steps that shouldn&rsquo;t stay manual.</p>
                    <p class="lead fw-semibold">Then we build the system around it.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="bg-workflow-canvas bg-workflow-standalone">
                        <svg class="position-absolute top-0 start-0 w-100 h-100" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                            <?php foreach ([[14, 24, 74, 26], [46, 12, 74, 26], [74, 26, 26, 64], [74, 26, 88, 66], [26, 64, 56, 78], [56, 78, 88, 66]] as $lineIndex => $line): ?>
                                <line class="bg-workflow-line"
                                      x1="<?= $line[0] ?>" y1="<?= $line[1] ?>"
                                      x2="<?= $line[2] ?>" y2="<?= $line[3] ?>"
                                      pathLength="1"
                                      style="--bg-flow-delay:<?= 0.25 + ($lineIndex * 0.1) ?>s"></line>
                            <?php endforeach; ?>
                        </svg>

                        <?php
                        $processNodes = [
                            ['CRM', 'bi-database', 14, 24],
                            ['Sheets', 'bi-file-earmark-text', 46, 12],
                            ['AI Agent', 'bi-robot', 74, 26],
                            ['Slack', 'bi-chat-dots', 26, 64],
                            ['Team', 'bi-people', 56, 78],
                            ['Dashboard', 'bi-lightning-charge', 88, 66],
                        ];
                        ?>
                        <?php foreach ($processNodes as $nodeIndex => $node): ?>
                            <div class="bg-workflow-node d-flex align-items-center gap-2"
                                 style="left:<?= $node[2] ?>%;top:<?= $node[3] ?>%;--bg-flow-delay:<?= 0.12 + ($nodeIndex * 0.1) ?>s">
                                <span class="bg-primary-subtle text-biz rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <i class="bi <?= $node[1] ?>"></i>
                                </span>
                                <small class="fw-semibold text-nowrap"><?= $node[0] ?></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-dark position-relative overflow-hidden">
        <div class="nd-dot-grid position-absolute top-0 start-0 w-100 h-100 opacity-25"></div>
        <div class="container position-relative">
            <div class="row mb-5">
                <div class="col-lg-8" data-aos="fade-up">
                    <p class="eyebrow text-light-emphasis">Use cases</p>
                    <h2 class="nd-page-title mt-4">Real scenarios.<br><span class="fst-italic fw-normal text-secondary">Working systems, not slides.</span></h2>
                </div>
            </div>
            <div class="row g-3">
                <?php foreach ($bizUseCases as $index => $useCase): ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $index * 40 ?>">
                        <article class="biz-use-card card-lift p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="biz-use-icon d-inline-flex align-items-center justify-content-center"><i class="bi <?= $useCase[6] ?>"></i></span>
                                <small class="biz-use-index font-mono text-secondary">USE / 0<?= $index + 1 ?></small>
                            </div>
                            <h3 class="h-display fs-4 fw-bold mb-2"><?= $useCase[0] ?></h3>
                            <p class="small text-light-emphasis mb-0"><?= $useCase[1] ?></p>
                            <dl class="biz-use-meta font-mono mb-0 mt-4 d-grid gap-1">
                                <?php foreach (['Trigger', 'Action', 'Human', 'Outcome'] as $rowIndex => $label): ?>
                                    <div class="d-flex gap-2">
                                        <dt class="biz-use-key text-secondary fw-normal"><?= $label ?></dt>
                                        <dd class="mb-0 <?= $rowIndex === 3 ? 'text-biz' : '' ?>"><?= $useCase[$rowIndex + 2] ?></dd>
                                    </div>
                                <?php endforeach; ?>
                            </dl>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php $integrationGrid = ['CRM', 'ERP', 'Finance', 'Marketing', 'Databases', 'Email', 'Spreadsheets', 'Documents', 'Project mgmt', 'Internal apps', 'APIs']; ?>
    <section class="section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-9" data-aos="fade-up">
                    <p class="eyebrow">Integration grid</p>
                    <h2 class="nd-page-title mt-4">Connect the systems<br><span class="fst-italic fw-normal text-secondary">already running the business.</span></h2>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 gap-md-3">
                <?php foreach ($integrationGrid as $index => $item): ?>
                    <span class="bg-white border rounded-pill px-4 py-3 fw-semibold d-inline-flex align-items-center gap-2" data-aos="fade-up" data-aos-delay="<?= ($index % 6) * 30 ?>"><span class="nd-dot bg-biz"></span><?= $item ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php $bizSteps = ['Process Discovery', 'Friction Audit', 'System Blueprint', 'Pilot Build', 'Integration & Testing', 'Scale']; ?>
    <section class="section section-soft border-top border-bottom">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8" data-aos="fade-up">
                    <p class="eyebrow">Implementation</p>
                    <h2 class="nd-page-title mt-4">Six stages<br><span class="fst-italic fw-normal text-secondary">from process to platform.</span></h2>
                </div>
            </div>
            <div class="row g-3">
                <?php foreach ($bizSteps as $index => $step): ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= ($index % 3) * 50 ?>">
                        <div class="card-soft p-4 p-md-4 h-100">
                            <p class="font-mono small text-uppercase text-secondary mb-3">Stage 0<?= $index + 1 ?></p>
                            <div class="display-5 fw-bold text-biz">0<?= $index + 1 ?></div>
                            <h3 class="h5 fw-bold mt-3 mb-0"><?= $step ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php $bizOutcomes = ['Less repetitive manual work', 'Faster access to reliable information', 'Fewer handoff mistakes', 'Better operational visibility', 'More consistent processes', 'Reduced spreadsheet dependency', 'Faster reporting', 'Custom AI capability without replacing the stack']; ?>
    <section class="section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-9" data-aos="fade-up">
                    <p class="eyebrow">Outcomes</p>
                    <h2 class="nd-page-title mt-4">What changes when<br><span class="fst-italic fw-normal text-secondary">the business works as one grid?</span></h2>
                </div>
            </div>
            <div class="row g-3">
                <?php foreach ($bizOutcomes as $index => $outcome): ?>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?= ($index % 4) * 40 ?>">
                        <div class="bg-white border rounded-4 p-4 d-flex gap-3 h-100">
                            <span class="font-mono small text-biz">0<?= $index + 1 ?></span>
                            <h3 class="h4 fw-bold mb-0"><?= $outcome ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php $bizFit = ['B2B companies operating across disconnected tools', 'Leadership teams depending on manual reports', 'Businesses with spreadsheet-heavy processes', 'Teams repeating the same document + approval tasks', 'Companies wanting internal AI agents', 'Businesses with a valuable AI prototype needing productionisation', 'Operations teams requiring custom workflows + dashboards']; ?>
    <section class="section section-dark">
        <div class="container">
            <div class="row g-md-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <p class="eyebrow text-light-emphasis">Who it&rsquo;s for</p>
                    <h2 class="nd-page-title mt-4">BizGRID fits<br><span class="fst-italic fw-normal text-secondary">if any of this is true.</span></h2>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <?php foreach ($bizFit as $index => $item): ?>
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?= ($index % 2) * 40 ?>">
                                <div class="card-dark border rounded-4 p-4 h-100">
                                    <p class="font-mono small text-secondary mb-2">0<?= $index + 1 ?></p>
                                    <h3 class="h5 fw-bold mb-0"><?= $item ?></h3>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    $bizFaqs = [
        ['Is BizGRID a software platform?', 'No. BizGRID is a productised custom-build capability. We design, engineer, integrate and operate the system inside your business, using your existing stack where it works.'],
        ['Can it work with our current applications?', 'Yes. We connect via native integrations, APIs and lightweight adapters. If a source does not have an integration path, our engineering team builds one.'],
        ['Do you build custom dashboards?', 'Yes. Dashboards are designed around the actual decisions your leadership needs to make. They are live, drillable and permissioned.'],
        ['Can you create internal AI agents?', 'Yes. Employee-support agents, SOP search, research agents, reporting agents and customer-facing assistants, each with evaluations, guardrails and observability.'],
        ['What is an AI MVP?', 'A production-ready first slice of an AI capability. We scope narrowly, ship in weeks, evaluate against real data, then extend once it earns its keep.'],
        ['Can we automate only one process initially?', 'Yes. That is the recommended way to start. One high-friction workflow, done end-to-end, becomes the foundation for the wider grid.'],
        ['How do you manage permissions and human approvals?', 'Role-based access, human-in-the-loop where judgment matters, and full audit trails. Everything is traceable.'],
    ];
    ?>
    <section class="section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8" data-aos="fade-up">
                    <p class="eyebrow">BizGRID &middot; FAQ</p>
                    <h2 class="nd-page-title mt-4">Questions we hear<br><span class="fst-italic fw-normal text-secondary">from operations leaders.</span></h2>
                </div>
            </div>
            <div class="accordion accordion-flush" id="bizFaq">
                <?php foreach ($bizFaqs as $index => $faq): ?>
                    <div class="accordion-item bg-transparent" data-aos="fade-up">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed gs-faq-question h-display fs-2 bg-transparent px-3 px-md-4 py-5" type="button" data-bs-toggle="collapse" data-bs-target="#bizFaq<?= $index ?>" aria-expanded="false" aria-controls="bizFaq<?= $index ?>">
                                <span class="font-mono small text-secondary me-4">0<?= $index + 1 ?></span><?= $faq[0] ?>
                            </button>
                        </h3>
                        <div id="bizFaq<?= $index ?>" class="accordion-collapse collapse" data-bs-parent="#bizFaq">
                            <div class="accordion-body lead text-muted ps-5 pb-4"><?= $faq[1] ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section pt-0">
        <div class="container">
            <div class="bg-cta-panel text-light p-4 p-md-5 overflow-hidden" data-aos="fade-up">
                <p class="eyebrow text-info">Ready to build</p>
                <h2 class="nd-page-title mt-4 lh-sm">Don&rsquo;t add<br>another tool.<br><span class="fst-italic fw-normal text-info lh-sm">Connect what you have.</span></h2>
                <p class="lead mt-4 text-white">Start with one high-friction process and build the grid around it.</p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a class="btn btn-light rounded-pill px-4 py-2" href="#contact">Map Your BizGRID <i class="bi bi-arrow-up-right"></i></a>
                    <a class="btn btn-outline-light rounded-pill px-4 py-2" href="<?= url('growstack.php') ?>">Explore GrowSTACK <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
