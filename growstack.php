<?php
$activePage = 'growstack';
$pageTitle = 'GrowSTACK | AI Growth System';
$metaDescription = 'GrowSTACK is nDimensions.ai’s AI growth system for visibility, demand, nurture and pipeline.';
$ogTitle = 'GrowSTACK | nDimensions.ai';
$ogDescription = 'Build an AI-powered growth engine that connects search, content, campaign, nurture and CRM.';
$canonicalUrl = 'https://ndimensions.ai/ai/growstack';
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';
?>

<main>
<section class="gs-hero container" data-aos="fade-up">
  <div class="row align-items-center g-md-5">

    <!-- LEFT: Copy -->
    <div class="col-lg-6">
      <p class="gs-eyebrow">
        <span class="gs-eyebrow-dot"></span>
        GROWSTACK · AI MARKETING, LEAD NURTURING & REVENUE AUTOMATION
      </p>
      <h1 class="gs-headline mt-3">
        Turn Marketing Activity Into 
        <span class="gs-headline-italic">Measurable Revenue.</span>
      </h1>
      <p class="gs-subtext mt-4">
        GrowSTACK connects search, content, campaigns, lead capture, WhatsApp, nurturing, CRM and reporting around one outcome: more qualified sales opportunities.
      </p>
      <div class="gs-actions mt-4">
        <a class="gs-btn-primary" href="<?= url('contact-us.php') ?>">Book a Demo ↗</a>
        <a class="gs-btn-secondary d-none" href="<?= url('contact-us.php') ?>">Book AI Growth Audit ↗</a>
      </div>
    </div>

    <!-- RIGHT: Homepage growth-system visual -->
    <div class="col-12 col-lg-6 hw-wrapper">
      <div class="row g-3">
        <div class="col-12" data-aos="fade-up" data-aos-delay="100" data-aos-duration="700">
          <div class="hw-card hw-card-search p-3 p-md-4">
            <div class="hw-window-header d-flex align-items-center mb-3">
              <div class="hw-window-dots d-flex gap-2">
                <span class="hw-dot hw-dot-danger"></span>
                <span class="hw-dot hw-dot-warning"></span>
                <span class="hw-dot hw-dot-success"></span>
              </div>
              <span class="hw-window-title ms-3 hw-font-mono">ai-search-visibility &middot; google + perplexity</span>
            </div>

            <div class="hw-search-input d-flex align-items-center mb-4">
              <svg class="hw-search-icon me-2" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
              <span class="hw-search-text">best b2b workflow automation platform</span>
            </div>

            <div class="hw-search-metrics d-flex flex-column gap-3">
              <?php foreach ([
                ['Google &middot; AI Overview', '82%', '0.2s', 'cited'],
                ['Perplexity', '65%', '0.35s', 'cited'],
                ['ChatGPT &middot; Web', '48%', '0.5s', 'mentioned'],
                ['Google &middot; SERP', '78%', '0.65s', 'position 2'],
              ] as $metric): ?>
                <div class="hw-metric-row d-flex align-items-center">
                  <span class="hw-metric-label"><?= $metric[0] ?></span>
                  <div class="hw-track flex-grow-1 mx-3">
                    <div class="hw-bar hw-bar-accent" style="--hw-target-width:<?= $metric[1] ?>;--hw-delay:<?= $metric[2] ?>"></div>
                  </div>
                  <span class="hw-metric-status hw-font-mono"><?= $metric[3] ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="200" data-aos-duration="700">
          <div class="hw-card hw-card-dark p-3 p-md-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <div class="d-flex align-items-center gap-2">
                <div class="hw-avatar d-flex align-items-center justify-content-center">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="#10b981" aria-hidden="true">
                    <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984 0 1.764.459 3.483 1.33 5.001L2 22l5.127-1.332a9.96 9.96 0 0 0 4.885 1.282h.004c5.507 0 9.99-4.478 9.99-9.985 0-2.667-1.037-5.176-2.922-7.062A9.92 9.92 0 0 0 12.012 2z"></path>
                  </svg>
                </div>
                <div>
                  <h6 class="mb-0 fw-bold text-white fs-6">WhatsApp Nurture</h6>
                  <span class="hw-font-mono hw-text-muted small">drip &middot; behaviour-triggered</span>
                </div>
              </div>
              <span class="hw-live-badge hw-font-mono">&bull; live</span>
            </div>

            <hr class="hw-divider my-3">

            <div class="hw-chat-list d-flex flex-column gap-2">
              <div class="hw-chat-bubble hw-bubble-in">Hi Priya &mdash; saw you downloaded the pipeline playbook.</div>
              <div class="hw-chat-bubble hw-bubble-out ms-auto">Yes, wanted to see the CRM setup <i class="bi bi-gear-fill ms-1" aria-hidden="true"></i></div>
              <div class="hw-chat-bubble hw-bubble-in">Perfect. Booking you a 20-min walkthrough &mdash; Tue 3pm?</div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="300" data-aos-duration="700">
          <div class="hw-card hw-card-pipeline p-3 p-md-4 h-100">
            <div class="d-flex align-items-start justify-content-between mb-3">
              <div>
                <span class="hw-font-mono text-muted text-uppercase small">Pipeline</span>
                <h4 class="fw-bold text-dark mb-0">$1.42M in play</h4>
              </div>
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ff4d2d" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="7" y1="17" x2="17" y2="7"></line>
                <polyline points="7 7 17 7 17 17"></polyline>
              </svg>
            </div>

            <div class="hw-pipeline-metrics d-flex flex-column gap-2 mt-3">
              <?php foreach ([
                ['gray', 'New', '85%', '0.3s', '42'],
                ['light', 'Qualified', '60%', '0.45s', '28'],
                ['mid', 'Proposal', '32%', '0.6s', '14'],
                ['dark', 'Won', '18%', '0.75s', '6'],
              ] as $stage): ?>
                <div class="hw-pipeline-row d-flex align-items-center">
                  <span class="hw-pipeline-label"><span class="hw-status-dot hw-status-dot-<?= $stage[0] ?>"></span><?= $stage[1] ?></span>
                  <div class="hw-track flex-grow-1 mx-2">
                    <div class="hw-bar hw-bar-<?= $stage[0] ?>" style="--hw-target-width:<?= $stage[2] ?>;--hw-delay:<?= $stage[3] ?>"></div>
                  </div>
                  <span class="hw-pipeline-val"><?= $stage[4] ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

    <section class="gs-funnel-gaps overflow-hidden text-light pt-5 pb-4" aria-labelledby="gs-gaps-title">
        <div class="container pt-lg-3">
            <p class="font-mono small text-secondary text-uppercase d-flex align-items-center gap-2 gs-gaps-tracking mb-0" data-aos="fade-up">
                <span class="gs-gaps-dot gs-gaps-dot-lg"></span>
                THE REVENUE ATTRIBUTION GAP
            </p>

            <div class="row gx-lg-5 mt-4 pt-1 align-items-end">
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="50">
                    <h2 class="gs-gaps-title fw-bold text-white mb-0" id="gs-gaps-title">
                        <span class="d-block">Which Marketing Channel is</span>
                        <!-- <span class="d-block">Leads without follow-</span> -->
                        <!-- <span class="d-block">up.</span> -->
                        <span class="d-block gs-gaps-title-italic fst-italic fw-medium">Driving Revenue?
</span>
                    </h2>
                </div>

                <div class="col-lg-5 mt-4 mt-lg-0 pb-1" data-aos="fade-up" data-aos-delay="120">
                    <div class="gs-gaps-description fs-5 lh-lg">
                        <p class="mb-3" style="color: #d4d4d8;">SEO shows rankings. Ads show leads. CRM shows deals. But when these systems are disconnected, you cannot see which keyword, campaign, message or follow-up created the sale.</p>
                        <p class="fw-bold mb-0">GrowSTACK connects every customer touchpoint from first search to closed revenue.</p>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-5 pt-lg-4">
                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="80">
                    <article class="gs-gap-card h-100 border p-4">
                        <p class="font-mono small text-secondary text-uppercase gs-gaps-tracking mb-3">SEO</p>
                        <h3 class="fs-3 fw-bold text-white mb-0">rankings</h3>
                        <p class="font-mono small text-secondary d-flex align-items-center gap-2 mt-4 mb-0">
                            <span class="gs-gaps-dot"></span>measured alone
                        </p>
                    </article>
                </div>

                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="140">
                    <article class="gs-gap-card h-100 border p-4">
                        <p class="font-mono small text-secondary text-uppercase gs-gaps-tracking mb-3">Content</p>
                        <h3 class="fs-3 fw-bold text-white mb-0">volume</h3>
                        <p class="font-mono small text-secondary d-flex align-items-center gap-2 mt-4 mb-0">
                            <span class="gs-gaps-dot"></span>output-only
                        </p>
                    </article>
                </div>

                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <article class="gs-gap-card h-100 border p-4">
                        <p class="font-mono small text-secondary text-uppercase gs-gaps-tracking mb-3">Ads</p>
                        <h3 class="fs-3 fw-bold text-white mb-0">leads</h3>
                        <p class="font-mono small text-secondary d-flex align-items-center gap-2 mt-4 mb-0">
                            <span class="gs-gaps-dot"></span>no attribution
                        </p>
                    </article>
                </div>

                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="260">
                    <article class="gs-gap-card h-100 border p-4">
                        <p class="font-mono small text-secondary text-uppercase gs-gaps-tracking mb-3">Sales</p>
                        <h3 class="fs-3 fw-bold text-white mb-0">closes</h3>
                        <p class="font-mono small text-secondary d-flex align-items-center gap-2 mt-4 mb-0">
                            <span class="gs-gaps-dot"></span>no context
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <?php
    $growLayers = [
        ['Get Found', 'From Search Intent to Sales Conversation.', 'bi-search', ['Technical and on-page SEO', 'AI search visibility through AEO and GEO', 'Buyer-intent keyword research', 'Competitor visibility tracking', 'Authority and reputation signals',], 'search'],
        ['Earn attention', 'Content that plants intent, not just impressions.', 'bi-file-earmark-text', ['B2B content strategy', 'Thought leadership', 'Search-led articles', 'Decision-stage landing pages', 'Email and newsletters', 'Content repurposing engine'], 'content'],
        ['Capture demand', 'Convert intent into named opportunities.', 'bi-bullseye', ['Paid acquisition', 'B2B landing pages', 'Lead magnets', 'Outbound targeting', 'Conversion tracking', 'Meta CAPI + ad-data integrations'], 'capture'],
        ['Nurture intent', 'Behaviour-triggered follow-up on the channels buyers use.', 'bi-chat-dots', ['Email nurturing', 'WhatsApp automation', 'Lead qualification + scoring', 'Behaviour-based follow-ups', 'Meeting journeys', 'Lead reactivation'], 'nurture'],
        ['Move & measure pipeline', 'One number the whole team owns: qualified pipeline.', 'bi-graph-up-arrow', ['CRM integration', 'Lead routing', 'Pipeline-stage automation', 'Sales notifications', 'Multi-touch attribution', 'Funnel + revenue dashboards'], 'pipeline'],
    ];
    ?>

    <section class="section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8" data-aos="fade-up">
                    <p class="eyebrow">The GrowSTACK model</p>
                    <h2 class="nd-page-title mt-4">From first search<br><span class="fst-italic fw-normal text-secondary">to sales-ready opportunity.</span></h2>
                </div>
            </div>

            <div class="row g-md-4">
                <div class="col-lg-4">
                    <div class="nav nav-pills flex-column gap-2 gs-layer-tabs" role="tablist">
                        <?php foreach ($growLayers as $index => $layer): ?>
                            <button class="nav-link text-start border p-3 p-md-4 <?= $index === 0 ? 'active' : '' ?>"
                                    id="gs-layer-tab-<?= $index ?>"
                                    data-bs-toggle="pill"
                                    data-bs-target="#gs-layer-<?= $index ?>"
                                    type="button"
                                    role="tab"
                                    aria-controls="gs-layer-<?= $index ?>"
                                    aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                                <span class="d-flex align-items-center gap-3">
                                    <span class="nd-icon-box"><i class="bi <?= $layer[2] ?>"></i></span>
                                    <span>
                                        <small class="d-block font-mono text-uppercase opacity-75">Layer 0<?= $index + 1 ?></small>
                                        <strong class="d-block fs-5 mt-1"><?= $layer[0] ?></strong>
                                    </span>
                                </span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="tab-content h-100">
                        <?php foreach ($growLayers as $index => $layer): ?>
                            <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?> h-100"
                                 id="gs-layer-<?= $index ?>"
                                 role="tabpanel"
                                 aria-labelledby="gs-layer-tab-<?= $index ?>">
                                <div class="card-soft p-4 p-md-5 h-100" data-aos="fade-up">
                                    <h3 class="display-6 fw-bold mb-4"><?= $layer[1] ?></h3>
                                    <div class="row g-md-4">
                                        <div class="col-md-7">
                                            <ul class="list-unstyled d-grid gap-3 mb-0">
                                                <?php foreach ($layer[3] as $item): ?>
                                                    <li class="d-flex gap-2">
                                                        <i class="bi bi-check-circle-fill text-grow"></i>
                                                        <span><?= $item ?></span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="bg-light border rounded-4 p-3 h-100">
                                                <?php if ($layer[4] === 'search'): ?>
                                                    <p class="font-mono small text-uppercase text-secondary mb-3">AI search visibility</p>
                                                    <div class="bg-white border rounded-3 p-2 small d-flex align-items-center gap-2 mb-3">
                                                        <i class="bi bi-search text-secondary"></i>
                                                        <span>best b2b workflow platform</span>
                                                    </div>
                                                    <?php foreach ([['Google AI', 88, 'cited'], ['Perplexity', 76, 'cited'], ['ChatGPT', 62, 'mentioned'], ['Search', 48, '#2']] as $metricIndex => $metric): ?>
                                                        <div class="mb-3">
                                                            <div class="d-flex justify-content-between small mb-1">
                                                                <span><?= $metric[0] ?></span><span class="font-mono text-secondary"><?= $metric[2] ?></span>
                                                            </div>
                                                            <div class="progress" style="height:6px">
                                                                <div class="progress-bar bg-grow gs-live-progress"
                                                                     style="--gs-progress-target:<?= $metric[1] ?>%;--gs-progress-delay:<?= 0.15 + ($metricIndex * 0.12) ?>s"></div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>

                                                <?php elseif ($layer[4] === 'content'): ?>
                                                    <p class="font-mono small text-uppercase text-secondary mb-3">Content pipeline</p>
                                                    <?php foreach ([['Idea', 24, 90], ['Draft', 12, 55], ['Editor', 6, 32], ['Live', 8, 40]] as $metricIndex => $metric): ?>
                                                        <div class="row align-items-center g-2 mb-3">
                                                            <div class="col-3 small fw-semibold"><?= $metric[0] ?></div>
                                                            <div class="col-7">
                                                                <div class="progress" style="height:7px">
                                                                    <div class="progress-bar bg-grow gs-live-progress"
                                                                         style="--gs-progress-target:<?= $metric[2] ?>%;--gs-progress-delay:<?= 0.15 + ($metricIndex * 0.12) ?>s"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-2 text-end font-mono small text-secondary"><?= $metric[1] ?></div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <div class="border-top pt-3 mt-2 small text-secondary">
                                                        <i class="bi bi-arrow-repeat text-grow me-2"></i>Repurposing engine active
                                                    </div>

                                                <?php elseif ($layer[4] === 'capture'): ?>
                                                    <p class="font-mono small text-uppercase text-secondary mb-3">Capture &middot; 30-day cohort</p>
                                                    <div class="row g-2 mb-3">
                                                        <div class="col-6">
                                                            <div class="bg-white border rounded-3 p-2 h-100">
                                                                <small class="font-mono text-secondary">Landing &rarr; Lead</small>
                                                                <div class="h4 fw-bold mb-0">4.3%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="bg-white border rounded-3 p-2 h-100">
                                                                <small class="font-mono text-secondary">Cost / Lead</small>
                                                                <div class="h4 fw-bold mb-0">$38</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bg-white border rounded-3 p-3">
                                                        <small class="font-mono text-secondary">Meta CAPI &middot; events</small>
                                                        <div class="d-flex align-items-end gap-1 mt-3" style="height:72px">
                                                            <?php foreach ([30, 55, 45, 70, 62, 85, 90, 75, 92] as $barIndex => $height): ?>
                                                                <span class="gs-event-bar bg-grow flex-grow-1 rounded-top"
                                                                      style="--gs-event-target:<?= $height ?>%;--gs-progress-delay:<?= 0.1 + ($barIndex * 0.05) ?>s"></span>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>

                                                <?php elseif ($layer[4] === 'nurture'): ?>
                                                    <div class="bg-dark text-light rounded-4 p-3 h-100">
                                                        <div class="d-flex align-items-center gap-2 border-bottom border-secondary pb-3 mb-3">
                                                            <span class="bg-success bg-opacity-25 text-success rounded-circle d-inline-flex align-items-center justify-content-center" style="width:32px;height:32px"><i class="bi bi-whatsapp"></i></span>
                                                            <span><strong class="d-block small">WhatsApp Nurture</strong><small class="text-secondary">behaviour-triggered</small></span>
                                                            <small class="text-success ms-auto font-mono">live</small>
                                                        </div>
                                                        <div class="gs-tab-message bg-secondary bg-opacity-25 rounded-3 p-2 small mb-2" style="--gs-progress-delay:.12s">Hi Priya &mdash; saw you downloaded the pipeline playbook.</div>
                                                        <div class="gs-tab-message bg-success rounded-3 p-2 small mb-2 ms-4" style="--gs-progress-delay:.28s">Yes, wanted to see the CRM setup.</div>
                                                        <div class="gs-tab-message bg-secondary bg-opacity-25 rounded-3 p-2 small" style="--gs-progress-delay:.44s">Perfect. Booking you a 20-min walkthrough &mdash; Tue 3pm?</div>
                                                    </div>

                                                <?php else: ?>
                                                    <div class="d-flex justify-content-between align-items-start mb-4">
                                                        <span><small class="font-mono text-secondary">Pipeline</small><strong class="d-block h4 mb-0">$1.42M in play</strong></span>
                                                        <i class="bi bi-arrow-up-right text-success fs-4"></i>
                                                    </div>
                                                    <?php foreach ([['New', 85, 42], ['Qualified', 65, 28], ['Proposal', 38, 14], ['Won', 18, 6]] as $metricIndex => $metric): ?>
                                                        <div class="row align-items-center g-2 mb-3">
                                                            <div class="col-4 small fw-semibold"><?= $metric[0] ?></div>
                                                            <div class="col-6">
                                                                <div class="progress" style="height:7px">
                                                                    <div class="progress-bar bg-grow gs-live-progress"
                                                                         style="--gs-progress-target:<?= $metric[1] ?>%;--gs-progress-delay:<?= 0.15 + ($metricIndex * 0.12) ?>s"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-2 text-end font-mono small text-secondary"><?= $metric[2] ?></div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
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

    <section class="section section-soft border-top border-bottom">
        <div class="container">
            <div class="row g-md-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <p class="eyebrow">Not a collection of services</p>
                    <h2 class="nd-page-title mt-4">One growth system.<br><span class="fst-italic fw-normal text-secondary">Shared context at every stage.</span></h2>
                    <p class="lead text-muted mt-4">The content team knows what buyers are searching for. Campaigns know which messages create intent. Nurturing responds to behaviour. Sales receives history, score and next action. Reporting shows what actually created movement &mdash; not just activity.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card-soft overflow-hidden">
                        <div class="bg-dark text-light d-flex align-items-center gap-2 px-3 py-2">
                            <span class="rounded-circle bg-danger" style="width:8px;height:8px"></span>
                            <span class="rounded-circle bg-warning" style="width:8px;height:8px"></span>
                            <span class="rounded-circle bg-success" style="width:8px;height:8px"></span>
                            <span class="font-mono text-secondary ms-1" style="font-size:10px">bizgrid &middot; leadership view</span>
                        </div>

                        <div class="bg-white p-3 p-md-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="bg-light rounded-4 p-3 h-100">
                                        <p class="font-mono text-secondary mb-1" style="font-size:10px">Pipeline (30d)</p>
                                        <div class="h3 fw-bold mb-1">$1.42M</div>
                                        <svg class="w-100 mt-1" height="36" viewBox="0 0 100 30" preserveAspectRatio="none" aria-hidden="true">
                                            <polyline class="gs-dashboard-line" fill="none" stroke="#2563eb" stroke-width="1.8" points="0,22 12,18 24,20 36,12 48,14 60,8 72,10 84,4 100,6"></polyline>
                                        </svg>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="bg-light rounded-4 p-3 h-100">
                                        <p class="font-mono text-secondary mb-1" style="font-size:10px">Ops throughput</p>
                                        <div class="h3 fw-bold text-biz mb-1">+38%</div>
                                        <div class="d-flex align-items-end gap-1 mt-1" style="height:36px">
                                            <?php foreach ([40, 55, 45, 70, 62, 85, 90] as $barIndex => $height): ?>
                                                <span class="gs-event-bar bg-biz flex-grow-1 rounded-top"
                                                      style="--gs-event-target:<?= $height ?>%;--gs-progress-delay:<?= 0.18 + ($barIndex * 0.06) ?>s"></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="bg-light rounded-4 p-3">
                                        <p class="font-mono text-secondary mb-2" style="font-size:10px">Live workflows</p>
                                        <?php foreach ([['Lead &rarr; CRM &rarr; Sales Slack alert', 'ok'], ['Weekly leadership report', 'ok'], ['Invoice OCR &rarr; Finance queue', 'run']] as $workflowIndex => $workflow): ?>
                                            <div class="gs-dashboard-workflow d-flex align-items-center gap-2 small <?= $workflowIndex ? 'mt-2' : '' ?>"
                                                 style="--gs-progress-delay:<?= 0.48 + ($workflowIndex * 0.12) ?>s">
                                                <i class="bi bi-check-circle-fill text-success"></i>
                                                <span class="text-truncate flex-grow-1"><?= $workflow[0] ?></span>
                                                <span class="font-mono text-secondary" style="font-size:10px"><?= $workflow[1] ?></span>
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
    </section>

    <?php
    $growIntegrations = [
        ['CRM', ['HubSpot', 'Salesforce', 'Zoho', 'Pipedrive']],
        ['Comms', ['WhatsApp', 'Email']],
        ['Advertising', ['Meta', 'Google Ads']],
        ['Analytics', ['GA4', 'Looker Studio']],
        ['CMS', ['WordPress', 'Webflow']],
        ['Commerce', ['Shopify']],
        ['Data', ['Sheets', 'Databases']],
    ];
    ?>
    <section class="section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8" data-aos="fade-up">
                    <p class="eyebrow">Integrations</p>
                    <h2 class="nd-page-title mt-4">Connect the stack<br><span class="fst-italic fw-normal text-secondary">you already use.</span></h2>
                </div>
            </div>
            <div class="row g-3">
                <?php foreach ($growIntegrations as $index => $integration): ?>
                    <div class="col-6 col-md-4 col-lg" data-aos="fade-up" data-aos-delay="<?= $index * 40 ?>">
                        <div class="card-soft p-3 p-md-4 h-100">
                            <p class="eyebrow text-grow mb-3"><?= $integration[0] ?></p>
                            <ul class="list-unstyled small fw-semibold mb-0 d-grid gap-2">
                                <?php foreach ($integration[1] as $item): ?>
                                    <li class="d-flex align-items-center gap-2"><span class="nd-dot bg-grow"></span><?= $item ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="marquee-section" data-aos="fade-up">
        <div class="marquee-mask">
            <div class="marquee-track" aria-hidden="true">
                <?php for ($repeat = 0; $repeat < 2; $repeat++): ?>
                    <?php foreach (['Search', 'Content', 'Demand', 'Nurture', 'CRM', 'Pipeline', 'Revenue'] as $item): ?>
                        <span class="marquee-item"><span class="marquee-dot"></span><?= $item ?></span>
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <?php
    $growOutcomes = ['Stronger search and AI visibility', 'More consistent demand creation', 'Faster response to enquiries', 'Better-qualified sales conversations', 'Fewer leads lost between systems', 'Cleaner CRM ownership', 'Clearer source-to-pipeline reporting', 'A growth system that improves over time'];
    ?>
    <section class="section section-dark">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8" data-aos="fade-up">
                    <p class="eyebrow text-light-emphasis">Outcomes</p>
                    <h2 class="nd-page-title mt-4">What changes when<br><span class="fst-italic fw-normal text-secondary">the stack works together?</span></h2>
                </div>
            </div>
            <div class="row g-3">
                <?php foreach ($growOutcomes as $index => $outcome): ?>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?= ($index % 4) * 40 ?>">
                        <div class="card-dark rounded-4 p-4 d-flex align-items-start gap-3 h-100">
                            <span class="font-mono small text-grow">0<?= $index + 1 ?></span>
                            <h3 class="h4 fw-bold mb-0"><?= $outcome ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php $growSteps = ['Growth Audit', 'Buyer & Funnel Mapping', 'Stack Architecture', 'Workflow Deployment', 'Growth Operations', 'Continuous Improvement']; ?>
    <section class="section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8" data-aos="fade-up">
                    <p class="eyebrow">Implementation</p>
                    <h2 class="nd-page-title mt-4">The path from<br><span class="fst-italic fw-normal text-secondary">audit to running system.</span></h2>
                </div>
            </div>
            <div class="row g-3">
                <?php foreach ($growSteps as $index => $step): ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= ($index % 3) * 50 ?>">
                        <div class="card-soft p-4 p-md-4 h-100">
                            <p class="font-mono small text-uppercase text-secondary mb-4">Step 0<?= $index + 1 ?></p>
                            <div class="display-6 fw-bold text-grow">0<?= $index + 1 ?></div>
                            <h3 class="h5 fw-bold mt-3 mb-0"><?= $step ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    $growFit = ['B2B companies running disconnected growth channels', 'Businesses generating leads but losing them during follow-up', 'Companies investing in content without pipeline attribution', 'Sales teams working with incomplete CRM data', 'Brands building visibility across Google and AI search', 'Founders and CMOs seeking one accountable growth partner'];
    ?>
    <section class="section section-soft border-top border-bottom">
        <div class="container">
            <div class="row g-md-5 align-items-start">
                <div class="col-lg-5" data-aos="fade-right">
                    <p class="eyebrow">Who it&rsquo;s for</p>
                    <h2 class="nd-page-title mt-4">GrowSTACK fits<br><span class="fst-italic fw-normal text-secondary">if any of this is true.</span></h2>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <?php foreach ($growFit as $index => $item): ?>
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?= ($index % 2) * 40 ?>">
                                <div class="bg-white border rounded-4 p-4 h-100">
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
    $growFaqs = [
        ['Does GrowSTACK replace our existing CRM?', 'No. GrowSTACK connects around your existing CRM. If it is not serving the business, we will say so, but the default is to make what you already own work harder.'],
        ['Can we start with lead nurturing only?', 'Yes. Most engagements start with the single most painful layer. Nurture-first setups go live in weeks and immediately compound the rest of the funnel.'],
        ['Does GrowSTACK include SEO, AEO and GEO?', 'Yes. Get Found covers traditional SEO plus visibility inside AI answer engines, the fast-emerging surface where B2B research is starting.'],
        ['Can it connect WhatsApp with our CRM?', 'Yes. Two-way sync covers conversations, contacts, behaviour and score signals, with human handoff when it matters.'],
        ['Can you manage the system after launch?', 'Yes. Ongoing operation includes content, campaigns, nurturing, CRM health and reporting.'],
        ['How do you measure pipeline impact?', 'Multi-touch attribution is modelled on your buyer journey, from first known touch through opportunity and closed-won, reported in one dashboard.'],
    ];
    ?>
    <section class="section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8" data-aos="fade-up">
                    <p class="eyebrow">GrowSTACK &middot; FAQ</p>
                    <h2 class="nd-page-title mt-4">Questions we hear<br><span class="fst-italic fw-normal text-secondary">from B2B leaders.</span></h2>
                </div>
            </div>
            <div class="accordion accordion-flush" id="growFaq">
                <?php foreach ($growFaqs as $index => $faq): ?>
                    <div class="accordion-item bg-transparent" data-aos="fade-up">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed gs-faq-question h-display fs-2 bg-transparent px-3 px-md-4 py-5" type="button" data-bs-toggle="collapse" data-bs-target="#growFaq<?= $index ?>" aria-expanded="false" aria-controls="growFaq<?= $index ?>">
                                <span class="font-mono small text-secondary me-4">0<?= $index + 1 ?></span><?= $faq[0] ?>
                            </button>
                        </h3>
                        <div id="growFaq<?= $index ?>" class="accordion-collapse collapse" data-bs-parent="#growFaq">
                            <div class="accordion-body lead text-muted ps-5 pb-4"><?= $faq[1] ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section pt-0">
        <div class="container">
            <div class="gs-cta-panel text-light p-4 p-md-5 p-lg-5 overflow-hidden" data-aos="fade-up">
                <p class="eyebrow text-light">Ready to build</p>
                <h2 class="nd-page-title mt-4 lh-sm">Build demand that<br>doesn&rsquo;t disappear at<br><span class="fst-italic fw-normal text-white-50 lh-sm">the handoff.</span></h2>
                <div class="d-flex flex-wrap gap-3 mt-5">
                    <a class="btn btn-light rounded-pill px-4 py-2" href="<?= url('contact-us.php') ?>">Consult Now <i class="bi bi-arrow-up-right"></i></a>
                    <a class="btn btn-outline-light rounded-pill px-4 py-2 d-none" href="<?= url('bizgrid.php') ?>">Explore BizGRID <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
