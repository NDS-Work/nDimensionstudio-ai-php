<?php
session_start();

$activePage = 'contact';
$pageTitle = 'Book an AI Growth Audit';
$metaDescription = 'Tell nDimensions.ai where growth, automation or creative production is slowing down. Start with a focused AI Growth Audit.';
$ogTitle = 'Book an AI Growth Audit | nDimensions.ai';
$ogDescription = 'Start a practical conversation about the system your business needs next.';
$canonicalUrl = 'https://ndimensions.ai/ai/contact-us';

require_once __DIR__ . '/includes/config.php';

if (empty($_SESSION['contact_token'])) {
    $_SESSION['contact_token'] = bin2hex(random_bytes(24));
}

$values = [
    'name' => '',
    'email' => '',
    'company' => '',
    'phone' => '',
    'system' => 'GrowSTACK',
    'timeline' => '',
    'message' => '',
];
$errors = [];
$submitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($values as $field => $value) {
        $values[$field] = trim((string) ($_POST[$field] ?? ''));
    }

    $token = (string) ($_POST['contact_token'] ?? '');
    $honeypot = trim((string) ($_POST['website'] ?? ''));

    if ($honeypot !== '') {
        $submitted = true;
    } elseif (!hash_equals($_SESSION['contact_token'], $token)) {
        $errors['form'] = 'Your session expired. Please refresh the page and try again.';
    } else {
        if ($values['name'] === '') {
            $errors['name'] = 'Please tell us your name.';
        }
        if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Enter a valid work email.';
        }
        if ($values['message'] === '') {
            $errors['message'] = 'Tell us briefly what is slowing the business down.';
        }

        $allowedSystems = ['GrowSTACK', 'BizGRID', 'Cre8LAB', 'Not sure yet'];
        if (!in_array($values['system'], $allowedSystems, true)) {
            $values['system'] = 'Not sure yet';
        }

        if (!$errors) {
            $subject = 'AI Growth Audit request from ' . $values['name'];
            $body = implode("\n", [
                'New AI Growth Audit request',
                '',
                'Name: ' . $values['name'],
                'Email: ' . $values['email'],
                'Company: ' . ($values['company'] ?: 'Not provided'),
                'Phone: ' . ($values['phone'] ?: 'Not provided'),
                'System: ' . $values['system'],
                'Timeline: ' . ($values['timeline'] ?: 'Not provided'),
                '',
                'What is slowing the business down:',
                $values['message'],
            ]);
            if (sendEmailViaBrevo(BREVO_RECIPIENT_EMAIL, $subject, $body, $values['email'], $values['name'])) {
                $submitted = true;
                $_SESSION['contact_token'] = bin2hex(random_bytes(24));
            } else {
                $errors['form'] = 'We could not send the request right now. Please email ' . BREVO_RECIPIENT_EMAIL . '.';
            }
        }
    }
}

function contactValue($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';
?>

<main class="contact-page">
    <section class="contact-hero section-dark position-relative overflow-hidden">
        <div class="nd-dot-grid position-absolute top-0 start-0 w-100 h-100 opacity-25"></div>
        <div class="container position-relative">
            <div class="row g-md-5 align-items-start">
                <div class="col-lg-5" data-aos="fade-right">
                    <p class="eyebrow text-light-emphasis">Book an AI Growth Audit</p>
                    <h1 class="contact-title mt-4 mb-4">Let&rsquo;s find the<br>system your<br><span class="fst-italic fw-normal text-secondary">business needs next.</span></h1>
                    <p class="lead text-light-emphasis mb-5">Tell us where growth, operations or production is slowing down. We&rsquo;ll turn the first conversation into a practical next step.</p>

                    <div class="d-grid gap-4">
                        <?php foreach ([
                            ['01', 'Share the friction', 'A short brief about the problem, process or opportunity.'],
                            ['02', 'Map the system', 'We connect the people, data and outcomes around it.'],
                            ['03', 'Leave with direction', 'You get a clear recommendation and sensible first move.'],
                        ] as $step): ?>
                            <div class="d-flex gap-3" data-aos="fade-up">
                                <span class="contact-step-number font-mono"><?= $step[0] ?></span>
                                <div>
                                    <h2 class="h5 fw-bold mb-1"><?= $step[1] ?></h2>
                                    <p class="small text-light-emphasis mb-0"><?= $step[2] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left" data-aos-delay="100">
                    <div class="contact-form-panel bg-white text-dark p-4 p-md-5" id="audit-form">
                        <?php if ($submitted): ?>
                            <div class="contact-success d-flex flex-column justify-content-center" data-aos="zoom-in">
                                <span class="contact-success-icon d-inline-flex align-items-center justify-content-center mb-4"><i class="bi bi-check-lg"></i></span>
                                <p class="eyebrow text-grow">Request received</p>
                                <h2 class="display-5 fw-bold mt-3">Thanks, <?= contactValue($values['name'] ?: 'there') ?>.</h2>
                                <p class="lead text-muted">Your brief is with our team. We&rsquo;ll reply to <?= contactValue($values['email']) ?> with the next step.</p>
                                <a class="btn btn-dark rounded-pill align-self-start px-4 py-3 mt-3" href="<?= url() ?>">Back to the homepage <i class="bi bi-arrow-right ms-2"></i></a>
                            </div>
                        <?php else: ?>
                            <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
                                <div>
                                    <p class="eyebrow text-grow mb-2">Your audit brief</p>
                                    <h2 class="h2 fw-bold mb-0">Start with the problem.</h2>
                                </div>
                                <span class="contact-form-mark d-inline-flex align-items-center justify-content-center"><i class="bi bi-lightning-charge"></i></span>
                            </div>

                            <?php if (isset($errors['form'])): ?>
                                <div class="alert alert-danger border-0" role="alert"><?= contactValue($errors['form']) ?></div>
                            <?php endif; ?>

                            <form method="post" action="<?= url('contact-us.php') ?>#audit-form" class="row g-4">
                                <input type="hidden" name="contact_token" value="<?= contactValue($_SESSION['contact_token']) ?>">
                                <div class="visually-hidden" aria-hidden="true">
                                    <label for="website">Website</label>
                                    <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold mb-3">Which system feels closest?</label>
                                    <div class="row g-2">
                                        <?php foreach ([
                                            ['GrowSTACK', 'bi-graph-up-arrow'],
                                            ['BizGRID', 'bi-grid-3x3-gap'],
                                            ['Cre8LAB', 'bi-stars'],
                                            ['Not sure yet', 'bi-compass'],
                                        ] as $index => $choice): ?>
                                            <div class="col-6 col-md-3">
                                                <input class="btn-check" type="radio" name="system" id="system-<?= $index ?>" value="<?= $choice[0] ?>" <?= $values['system'] === $choice[0] ? 'checked' : '' ?>>
                                                <label class="contact-choice btn w-100 h-100 p-3 text-start" for="system-<?= $index ?>">
                                                    <i class="bi <?= $choice[1] ?> d-block fs-5 mb-2"></i>
                                                    <span class="small fw-bold"><?= $choice[0] ?></span>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" for="contact-name">Name *</label>
                                    <input class="form-control form-control-lg <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="contact-name" name="name" value="<?= contactValue($values['name']) ?>" autocomplete="name" required>
                                    <?php if (isset($errors['name'])): ?><div class="invalid-feedback"><?= contactValue($errors['name']) ?></div><?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" for="contact-email">Work email *</label>
                                    <input class="form-control form-control-lg <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="contact-email" name="email" type="email" value="<?= contactValue($values['email']) ?>" autocomplete="email" required>
                                    <?php if (isset($errors['email'])): ?><div class="invalid-feedback"><?= contactValue($errors['email']) ?></div><?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" for="contact-company">Company</label>
                                    <input class="form-control form-control-lg" id="contact-company" name="company" value="<?= contactValue($values['company']) ?>" autocomplete="organization">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" for="contact-phone">Phone</label>
                                    <input class="form-control form-control-lg" id="contact-phone" name="phone" type="tel" value="<?= contactValue($values['phone']) ?>" autocomplete="tel">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold" for="contact-timeline">When would you like to start?</label>
                                    <select class="form-select form-select-lg" id="contact-timeline" name="timeline">
                                        <option value="">Choose a timeline</option>
                                        <?php foreach (['As soon as possible', 'Within 30 days', 'This quarter', 'Just exploring'] as $timeline): ?>
                                            <option value="<?= $timeline ?>" <?= $values['timeline'] === $timeline ? 'selected' : '' ?>><?= $timeline ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold" for="contact-message">What is slowing the business down? *</label>
                                    <textarea class="form-control form-control-lg <?= isset($errors['message']) ? 'is-invalid' : '' ?>" id="contact-message" name="message" rows="5" placeholder="A few lines are enough. Tell us what happens today and what should happen instead." required><?= contactValue($values['message']) ?></textarea>
                                    <?php if (isset($errors['message'])): ?><div class="invalid-feedback"><?= contactValue($errors['message']) ?></div><?php endif; ?>
                                </div>
                                <div class="col-12 d-flex flex-column flex-md-row align-items-md-center gap-3">
                                    <button class="btn btn-dark rounded-pill px-4 py-3 fw-semibold" type="submit">Send audit request <i class="bi bi-arrow-up-right ms-2"></i></button>
                                    <span class="small text-muted"><i class="bi bi-lock me-1"></i> Your brief stays private.</span>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
