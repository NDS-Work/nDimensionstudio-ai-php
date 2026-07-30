<section class="section home-how-work" id="how-we-work">
    <div class="container">
        <div class="row g-4 align-items-end mb-5">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="eyebrow">From opportunity to operating system</div>
                <h2 class="home-section-title h-display mt-4 mb-0">
                    <span class="d-block">We don&rsquo;t begin with AI.</span>
                    <span class="d-block fst-italic fw-normal text-secondary">We begin with the business problem.</span>
                </h2>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ([
                ['01', 'Diagnose', 'Identify where demand, data, decisions or production are losing momentum.'],
                ['02', 'Architect', 'Map workflows, data, tools, integrations, approvals and measurable outcomes.'],
                ['03', 'Build', 'Engineers, growth operators and creatives build the working system.'],
                ['04', 'Integrate', 'Connect CRM, website, WhatsApp, advertising platforms and internal tools.'],
                ['05', 'Operate', 'Monitor workflows, correct gaps and maintain execution.'],
                ['06', 'Improve', 'Use performance data to strengthen the next cycle.']
            ] as $index => $step): ?>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                    <article class="home-step-card border bg-white p-4 p-md-5 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="font-mono text-secondary small">Chapter <?= $step[0] ?></span>
                            <i class="bi bi-arrow-up-right text-secondary" aria-hidden="true"></i>
                        </div>
                        <div class="home-step-number h-display fw-bold mt-4"><?= $step[0] ?></div>
                        <h3 class="h-display h4 fw-bold mt-2 mb-0"><?= $step[1] ?></h3>
                        <p class="small text-muted mt-3 mb-0"><?= $step[2] ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-dark position-relative overflow-hidden home-team-advantage">
    <div class="nd-dot-grid position-absolute top-0 start-0 w-100 h-100 opacity-25"></div>
    <div class="container position-relative">
        <div class="row g-4 align-items-end mb-5">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="eyebrow text-secondary">Why nDimensions</div>
                <h2 class="home-section-title h-display mt-4 mb-0">
                    <span class="d-block">Engineers build it.</span>
                    <span class="d-block">Operators steer it.</span>
                    <span class="d-block fst-italic fw-normal text-secondary">Creatives make it land.</span>
                </h2>
            </div>
        </div>
        <div class="row g-3">
            <?php foreach ([
                ['AI Engineering', 'Custom workflows, integrations, agents, dashboards and production-ready AI systems.', '#2563eb', '#1e2f5c', 'bi-robot'],
                ['Growth Strategy', 'Search, content, demand generation, nurturing, CRM and revenue measurement.', '#ff5722', '#3a1a10', 'bi-graph-up-arrow'],
                ['Creative Execution', 'Campaign concepts, advertising assets, product visuals, video and creative variations.', '#9333ea', '#2c1745', 'bi-magic']
            ] as $index => $team): ?>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="<?= $index * 80 ?>">
                    <article class="home-team-card border p-4 p-md-5 h-100" style="--team-accent:<?= $team[2] ?>;--team-soft:<?= $team[3] ?>">
                        <span class="home-team-icon d-inline-grid mb-4"><i class="bi <?= $team[4] ?>" aria-hidden="true"></i></span>
                        <h3 class="h-display fs-2 fw-bold mb-0"><?= $team[0] ?></h3>
                        <p class="mt-3 mb-0"><?= $team[1] ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
        <p class="lead text-secondary mt-5 mb-0" data-aos="fade-up" data-aos-delay="240">
            No handoffs between disconnected partners.<br>
            No account layer translating the problem between teams.
        </p>
    </div>
</section>

<section class="section section-light home-problem-selector" id="problem-selector">
    <div class="container">
        <div class="row g-4 align-items-end mb-5">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="eyebrow">Where do you want to start</div>
                <h2 class="home-section-title h-display mt-4 mb-0">
                    <span class="d-block">Choose the problem</span>
                    <span class="d-block fst-italic fw-normal text-secondary">slowing the business down.</span>
                </h2>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="problem-list" id="problemList">
                    <?php foreach ([
                        'We need more qualified B2B demand',
                        'Our brand is missing from Google and AI search',
                        'Leads are coming in but follow-ups are inconsistent',
                        'WhatsApp and CRM aren&rsquo;t connected',
                        'Reporting takes days of manual work',
                        'Teams depend on scattered spreadsheets',
                        'Internal knowledge is difficult to access',
                        'Campaign production can&rsquo;t keep up',
                        'We have an AI idea but no production-ready system'
                    ] as $index => $problem): ?>
                        <div>
                            <button class="problem-option text-start h-100 w-100 <?= $index === 0 ? 'active' : '' ?>"
                                    type="button" data-index="<?= $index ?>">
                                <span class="problem-option-index font-mono d-block mb-1">0<?= $index + 1 ?></span>
                                <span class="h-display fs-5 fw-bold d-block"><?= $problem ?></span>
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-5" data-aos="fade-left">
                <aside class="problem-recommendation p-4 p-md-5">
                    <div class="eyebrow text-secondary">Recommended system</div>
                    <h3 class="h-display mt-3 mb-0" id="rec-title">GrowSTACK</h3>
                    <p class="mt-3 mb-0" id="rec-desc">GrowSTACK builds demand at the top of the funnel and connects it to sales.</p>
                    <div class="recommendation-box border mt-4 mb-0">
                        <div class="eyebrow text-secondary mb-1">Suggested first step</div>
                        <div class="recommendation-title" id="rec-step">Buyer + funnel mapping</div>
                    </div>
                    <a class="btn btn-light rounded-pill px-4 py-3 fw-semibold mt-4" href="#contact">Start with an audit <i class="bi bi-arrow-up-right ms-2"></i></a>
                </aside>
            </div>
        </div>
    </div>
</section>

<section class="section home-proof" id="proof">
    <div class="container">
        <div class="row g-4 align-items-end mb-5">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="eyebrow">Experience behind the systems</div>
                <h2 class="home-section-title h-display mt-4 mb-0">
                    <span class="d-block">Built on experience.</span>
                    <span class="d-block fst-italic fw-normal text-secondary">Designed for what comes next.</span>
                </h2>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ([
                ['17+', 'years across technology, digital marketing, branding and creative execution.', 'var(--ink)'],
                ['300+', 'clients across startups, growing businesses and enterprise teams.', 'var(--grow)'],
                ['1&times;', 'one integrated team: AI engineers, marketers, strategists, content specialists and creatives.', 'var(--biz)']
            ] as $index => $proof): ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $index * 80 ?>">
                    <article class="home-proof-card border bg-white p-4 p-md-5 h-100">
                        <div class="proof-value h-display" style="color:<?= $proof[2] ?>"><?= $proof[0] ?></div>
                        <p class="text-muted mt-4 mb-0"><?= $proof[1] ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row g-4 mt-5">
            <?php foreach ([
                ['Case Study &middot; SaaS', 'How a B2B SaaS achieved a connected pipeline by rebuilding lead-to-sales handoff.', 'var(--grow)'],
                ['Case Study &middot; Manufacturing', 'How an industrial team achieved reliable reporting by rebuilding data operations.', 'var(--biz)'],
                ['Case Study &middot; Services', 'How a services brand achieved consistent output by rebuilding creative production.', 'var(--cre)']
            ] as $index => $story): ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $index * 80 ?>">
                    <article class="home-story-card p-4 p-md-5 h-100">
                        <div class="story-tag" style="color:<?= $story[2] ?>"><?= $story[0] ?></div>
                        <h3 class="h-display h4 fw-bold mt-4 mb-0"><?= $story[1] ?></h3>
                        <span class="d-inline-flex align-items-center gap-2 small fw-semibold mt-4">Read the story <i class="bi bi-arrow-up-right"></i></span>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="marquee-section home-proof-marquee" data-aos="fade-up">
    <div class="marquee-mask">
        <div class="marquee-track" aria-hidden="true">
            <?php for ($repeat = 0; $repeat < 2; $repeat++): ?>
                <?php foreach (['AI Growth', 'Business Automation', 'Creative Production', 'Search Visibility', 'Pipeline Intelligence', 'Custom AI Agents'] as $item): ?>
                    <span class="marquee-item"><span class="marquee-dot"></span><?= $item ?></span>
                <?php endforeach; ?>
            <?php endfor; ?>
        </div>
    </div>
</section>

<section class="section section-soft border-top border-bottom home-faq-section" id="faq">
    <div class="container">
        <div class="row g-4 align-items-end mb-5">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="eyebrow">Common questions</div>
                <h2 class="home-section-title h-display mt-4 mb-0">
                    <span class="d-block">Everything you&rsquo;d</span>
                    <span class="d-block fst-italic fw-normal text-secondary">ask on a first call.</span>
                </h2>
            </div>
        </div>
        <div class="accordion accordion-flush" id="faqAccordion">
            <?php foreach ([
                ['Are GrowSTACK, BizGRID and Cre8LAB software products?', 'No. They are productised systems delivered through expert strategy, engineering, integration and operation. You get the working system, not just software to configure yourself.'],
                ['Can we begin with only one system?', 'Yes. Most engagements start with the single most painful bottleneck. We architect that one system fully &mdash; then extend into the others as value compounds.'],
                ['Can you work with our existing CRM and tools?', 'Yes. We connect around your CRM (HubSpot, Salesforce, Zoho, Pipedrive), your communication stack, ad platforms and internal tools. We only replace what genuinely blocks progress.'],
                ['Do we need an AI strategy before starting?', 'No. We start with the business problem &mdash; where demand, data, decisions or production are losing momentum &mdash; and build the AI into the workflow where it earns its keep.'],
                ['Can you take an AI prototype into production?', 'Yes. BizGRID&rsquo;s engineering team specialises in taking prototypes through evaluation, guardrails, integrations, UI and observability into production-ready systems.'],
                ['How long does implementation take?', 'First working slices typically go live in 4&ndash;8 weeks depending on scope. We favour thin, useful releases over long invisible builds.'],
                ['Do you continue operating the system after launch?', 'Yes. Ongoing operation is a first-class option &mdash; monitoring workflows, closing gaps, improving prompts and evolving the system as the business changes.']
            ] as $index => $faq): ?>
                <div class="accordion-item bg-transparent" data-aos="fade-up" data-aos-delay="<?= $index * 60 ?>">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed bg-transparent px-0 py-4 home-faq-question" type="button"
                                data-bs-toggle="collapse" data-bs-target="#homeFaq<?= $index ?>"
                                aria-expanded="false" aria-controls="homeFaq<?= $index ?>">
                            <span class="font-mono small text-secondary me-4">0<?= $index + 1 ?></span>
                            <span class="h-display fw-bold"><?= $faq[0] ?></span>
                        </button>
                    </h3>
                    <div id="homeFaq<?= $index ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body lead text-muted ps-5 pe-4 pb-5"><?= $faq[1] ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section final-cta-section">
    <div class="container">
        <div class="home-final-cta position-relative overflow-hidden text-light" data-aos="fade-up">
            <div class="nd-dot-grid position-absolute top-0 start-0 w-100 h-100 opacity-25"></div>
            <div class="position-relative">
                <div class="eyebrow text-secondary">Ready to build</div>
                <h2 class="home-final-title h-display mt-4 mb-0">
                    <span class="d-block">Stop running growth,</span>
                    <span class="d-block">operations and creative</span>
                    <span class="d-block fst-italic fw-normal text-secondary">in pieces.</span>
                </h2>
                <p class="lead mt-4 text-light-emphasis home-final-copy">Start with an AI Growth Audit. We&rsquo;ll identify the system that can create the fastest measurable impact &mdash; and show you how to build it.</p>
                <div class="d-flex flex-wrap gap-3 mt-5">
                    <a class="btn btn-light rounded-pill px-4 py-3 fw-semibold" href="<?= url('contact-us.php') ?>">Book AI Growth Audit <i class="bi bi-arrow-up-right ms-2"></i></a>
                    <a class="btn btn-outline-light rounded-pill px-4 py-3 fw-semibold" href="#products">Explore Our Systems <i class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
