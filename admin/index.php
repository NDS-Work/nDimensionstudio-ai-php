<?php
require_once __DIR__ . '/../includes/config.php';

session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
    'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
]);
session_start();

require_once __DIR__ . '/../includes/database.php';

ensureDatabaseSchema();
$pdo = database();

function adminEscape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function adminCsrfToken()
{
    if (empty($_SESSION['admin_csrf'])) {
        $_SESSION['admin_csrf'] = bin2hex(random_bytes(24));
    }
    return $_SESSION['admin_csrf'];
}

function adminCsrfValid()
{
    return isset($_POST['admin_csrf']) && hash_equals(adminCsrfToken(), (string) $_POST['admin_csrf']);
}

function adminAuthenticated()
{
    return !empty($_SESSION['admin_user_id']);
}

function leadStatusClass($status)
{
    $classes = [
        'new' => 'text-bg-primary',
        'contacted' => 'text-bg-info',
        'qualified' => 'text-bg-warning',
        'proposal' => 'text-bg-secondary',
        'won' => 'text-bg-success',
        'lost' => 'text-bg-dark',
    ];
    return $classes[$status] ?? 'text-bg-secondary';
}

function leadUtmTooltip(array $lead)
{
    $touch = !empty($lead['first_utm_source']) ? 'first' : 'last';
    $fields = [
        'Source' => 'utm_source',
        'Medium' => 'utm_medium',
        'Campaign' => 'utm_campaign',
        'Term' => 'utm_term',
        'Content' => 'utm_content',
    ];
    $lines = [];

    foreach ($fields as $label => $field) {
        $value = $lead[$touch . '_' . $field] ?: 'Not captured';
        $lines[] = '<strong>' . $label . ':</strong> ' . adminEscape($value);
    }

    return implode('<br>', $lines);
}

$statuses = ['new', 'contacted', 'qualified', 'proposal', 'won', 'lost'];
$adminCount = (int) $pdo->query('SELECT COUNT(*) FROM admin_users')->fetchColumn();
$error = '';
$openPasswordModal = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = (string) ($_POST['action'] ?? '');

    if (!adminCsrfValid()) {
        $error = 'Your session expired. Refresh the page and try again.';
    } elseif ($action === 'setup' && $adminCount === 0) {
        $username = trim((string) ($_POST['username'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        $confirmation = (string) ($_POST['password_confirmation'] ?? '');

        if (!preg_match('/^[A-Za-z0-9_.-]{3,80}$/', $username)) {
            $error = 'Use at least three letters or numbers for the username.';
        } elseif (strlen($password) < 10) {
            $error = 'Use a password with at least 10 characters.';
        } elseif ($password !== $confirmation) {
            $error = 'The passwords do not match.';
        } else {
            $statement = $pdo->prepare('INSERT INTO admin_users (username, password_hash, last_login_at) VALUES (:username, :password_hash, NOW())');
            $statement->execute(['username' => $username, 'password_hash' => password_hash($password, PASSWORD_DEFAULT)]);
            session_regenerate_id(true);
            $_SESSION['admin_user_id'] = (int) $pdo->lastInsertId();
            $_SESSION['admin_username'] = $username;
            header('Location: ' . url('admin/'));
            exit;
        }
    } elseif ($action === 'login' && $adminCount > 0) {
        $statement = $pdo->prepare('SELECT id, username, password_hash FROM admin_users WHERE username = :username LIMIT 1');
        $statement->execute(['username' => trim((string) ($_POST['username'] ?? ''))]);
        $admin = $statement->fetch();

        if ($admin && password_verify((string) ($_POST['password'] ?? ''), $admin['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_user_id'] = (int) $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $pdo->prepare('UPDATE admin_users SET last_login_at = NOW() WHERE id = :id')->execute(['id' => $admin['id']]);
            header('Location: ' . url('admin/'));
            exit;
        }
        usleep(400000);
        $error = 'The username or password is incorrect.';
    } elseif ($action === 'logout' && adminAuthenticated()) {
        $_SESSION = [];
        session_destroy();
        header('Location: ' . url('admin/'));
        exit;
    } elseif ($action === 'change_password' && adminAuthenticated()) {
        $currentPassword = (string) ($_POST['current_password'] ?? '');
        $newPassword = (string) ($_POST['new_password'] ?? '');
        $confirmation = (string) ($_POST['new_password_confirmation'] ?? '');
        $statement = $pdo->prepare('SELECT password_hash FROM admin_users WHERE id = :id');
        $statement->execute(['id' => (int) $_SESSION['admin_user_id']]);
        $passwordHash = (string) $statement->fetchColumn();

        if (!$passwordHash || !password_verify($currentPassword, $passwordHash)) {
            $error = 'Your current password is incorrect.';
            $openPasswordModal = true;
        } elseif (strlen($newPassword) < 10) {
            $error = 'The new password must contain at least 10 characters.';
            $openPasswordModal = true;
        } elseif ($newPassword !== $confirmation) {
            $error = 'The new passwords do not match.';
            $openPasswordModal = true;
        } else {
            $statement = $pdo->prepare('UPDATE admin_users SET password_hash = :password_hash WHERE id = :id');
            $statement->execute([
                'password_hash' => password_hash($newPassword, PASSWORD_DEFAULT),
                'id' => (int) $_SESSION['admin_user_id'],
            ]);
            session_regenerate_id(true);
            header('Location: ' . url('admin/') . '?password_changed=1');
            exit;
        }
    } elseif ($action === 'delete_lead' && adminAuthenticated()) {
        $leadId = (int) ($_POST['lead_id'] ?? 0);
        if ($leadId > 0) {
            $statement = $pdo->prepare('DELETE FROM leads WHERE id = :id');
            $statement->execute(['id' => $leadId]);
            header('Location: ' . url('admin/') . '?deleted=1');
            exit;
        }
        $error = 'The lead could not be deleted.';
    } elseif ($action === 'update_lead' && adminAuthenticated()) {
        $leadId = (int) ($_POST['lead_id'] ?? 0);
        $status = (string) ($_POST['status'] ?? 'new');
        $notes = trim((string) ($_POST['notes'] ?? ''));
        if ($leadId > 0 && in_array($status, $statuses, true)) {
            $statement = $pdo->prepare('UPDATE leads SET status = :status, notes = :notes WHERE id = :id');
            $statement->execute(['status' => $status, 'notes' => $notes ?: null, 'id' => $leadId]);
            header('Location: ' . url('admin/') . '?lead=' . $leadId . '&saved=1');
            exit;
        }
        $error = 'The lead could not be updated.';
    }
}

if ($adminCount === 0 || !adminAuthenticated()):
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $adminCount === 0 ? 'Create administrator' : 'Admin sign in' ?> | nDimensions.ai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
</head>
<body class="admin-page bg-body-tertiary">
    <main class="container d-flex align-items-center justify-content-center min-vh-100 py-5">
        <div class="card border-0 shadow-sm w-100" style="max-width:460px">
            <div class="card-body p-4 p-md-5">
                <a class="d-inline-block" href="<?= url() ?>"><img class="admin-login-logo" src="<?= asset('images/nds-logo.png') ?>" alt="nDimensions"></a>
                <p class="font-mono small text-uppercase text-secondary mt-4 mb-2"><?= $adminCount === 0 ? 'First-time setup' : 'Lead management' ?></p>
                <h1 class="h2 fw-bold mb-4"><?= $adminCount === 0 ? 'Create administrator' : 'Welcome back' ?></h1>
                <?php if ($error): ?><div class="alert alert-danger"><?= adminEscape($error) ?></div><?php endif; ?>
                <form method="post" class="d-grid gap-3">
                    <input type="hidden" name="admin_csrf" value="<?= adminEscape(adminCsrfToken()) ?>">
                    <input type="hidden" name="action" value="<?= $adminCount === 0 ? 'setup' : 'login' ?>">
                    <div>
                        <label class="form-label fw-semibold" for="username">Username</label>
                        <input class="form-control form-control-lg" id="username" name="username" autocomplete="username" required autofocus>
                    </div>
                    <div>
                        <label class="form-label fw-semibold" for="password">Password</label>
                        <input class="form-control form-control-lg" id="password" name="password" type="password" autocomplete="<?= $adminCount === 0 ? 'new-password' : 'current-password' ?>" minlength="<?= $adminCount === 0 ? '10' : '1' ?>" required>
                    </div>
                    <?php if ($adminCount === 0): ?>
                        <div>
                            <label class="form-label fw-semibold" for="password_confirmation">Confirm password</label>
                            <input class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="10" required>
                        </div>
                    <?php endif; ?>
                    <button class="btn btn-dark btn-lg rounded-pill mt-2" type="submit"><?= $adminCount === 0 ? 'Create admin' : 'Sign in' ?> <i class="bi bi-arrow-right ms-2"></i></button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
<?php
exit;
endif;

$search = trim((string) ($_GET['q'] ?? ''));
$statusFilter = (string) ($_GET['status'] ?? '');
$sourceFilter = trim((string) ($_GET['source'] ?? ''));
$where = [];
$params = [];

if ($search !== '') {
    $where[] = '(name LIKE :search_name OR email LIKE :search_email OR company LIKE :search_company OR challenge LIKE :search_challenge)';
    $searchValue = '%' . $search . '%';
    $params['search_name'] = $searchValue;
    $params['search_email'] = $searchValue;
    $params['search_company'] = $searchValue;
    $params['search_challenge'] = $searchValue;
}
if (in_array($statusFilter, $statuses, true)) {
    $where[] = 'status = :status';
    $params['status'] = $statusFilter;
}
if ($sourceFilter !== '') {
    $where[] = 'COALESCE(first_utm_source, last_utm_source) = :source';
    $params['source'] = $sourceFilter;
}
$whereSql = $where ? ' WHERE ' . implode(' AND ', $where) : '';

if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    $statement = $pdo->prepare('SELECT * FROM leads' . $whereSql . ' ORDER BY created_at DESC');
    $statement->execute($params);
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="ndimensions-leads-' . date('Y-m-d') . '.csv"');
    $output = fopen('php://output', 'w');
    $firstRow = $statement->fetch();
    if ($firstRow) {
        fputcsv($output, array_keys($firstRow));
        fputcsv($output, array_values($firstRow));
        while ($row = $statement->fetch()) {
            fputcsv($output, array_values($row));
        }
    }
    fclose($output);
    exit;
}

$page = max(1, (int) ($_GET['page'] ?? 1));
$perPage = 25;
$countStatement = $pdo->prepare('SELECT COUNT(*) FROM leads' . $whereSql);
$countStatement->execute($params);
$filteredTotal = (int) $countStatement->fetchColumn();
$pageCount = max(1, (int) ceil($filteredTotal / $perPage));
$page = min($page, $pageCount);
$offset = ($page - 1) * $perPage;

$statement = $pdo->prepare('SELECT * FROM leads' . $whereSql . ' ORDER BY created_at DESC LIMIT ' . $perPage . ' OFFSET ' . $offset);
$statement->execute($params);
$leads = $statement->fetchAll();
$sources = $pdo->query("SELECT DISTINCT COALESCE(first_utm_source, last_utm_source) AS utm_source FROM leads WHERE COALESCE(first_utm_source, last_utm_source) IS NOT NULL AND COALESCE(first_utm_source, last_utm_source) <> '' ORDER BY utm_source")->fetchAll(PDO::FETCH_COLUMN);
$stats = $pdo->query("SELECT COUNT(*) total, SUM(status = 'new') new_count, SUM(status = 'qualified') qualified_count, SUM(status = 'won') won_count FROM leads")->fetch();
$selectedLead = null;
if (!empty($_GET['lead'])) {
    $detailStatement = $pdo->prepare('SELECT * FROM leads WHERE id = :id');
    $detailStatement->execute(['id' => (int) $_GET['lead']]);
    $selectedLead = $detailStatement->fetch();
}
$queryForExport = $_GET;
unset($queryForExport['page'], $queryForExport['lead'], $queryForExport['saved']);
$queryForExport['export'] = 'csv';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leads | nDimensions.ai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
</head>
<body class="admin-page bg-body-tertiary">
    <header class="admin-topbar text-white">
        <div class="container-fluid px-3 px-md-4 py-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3"><a href="<?= url('admin/') ?>"><img class="admin-header-logo" src="<?= asset('images/nds-logo.png') ?>" alt="nDimensions"></a><span class="badge admin-section-badge">Leads</span></div>
            <div class="d-flex align-items-center gap-3">
                <span class="small text-white-50 d-none d-md-inline"><?= adminEscape($_SESSION['admin_username']) ?></span>
                <button class="btn btn-outline-light btn-sm rounded-pill px-3" type="button" data-bs-toggle="modal" data-bs-target="#change-password-modal"><i class="bi bi-key me-1"></i><span class="d-none d-md-inline">Change password</span></button>
                <form method="post" class="m-0">
                    <input type="hidden" name="admin_csrf" value="<?= adminEscape(adminCsrfToken()) ?>">
                    <input type="hidden" name="action" value="logout">
                    <button class="btn btn-outline-light btn-sm rounded-pill px-3" type="submit"><i class="bi bi-box-arrow-right me-1"></i> Sign out</button>
                </form>
            </div>
        </div>
    </header>

    <main class="container-fluid px-3 px-md-4 py-4 py-md-5">
        <?php if (isset($_GET['deleted'])): ?><div class="alert alert-success alert-dismissible fade show" role="alert">Lead deleted successfully.<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div><?php endif; ?>
        <?php if (isset($_GET['password_changed'])): ?><div class="alert alert-success alert-dismissible fade show" role="alert">Password changed successfully.<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div><?php endif; ?>
        <?php if ($error): ?><div class="alert alert-danger alert-dismissible fade show" role="alert"><?= adminEscape($error) ?><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div><?php endif; ?>
        <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 mb-4">
            <div><p class="font-mono small text-uppercase text-secondary mb-2">Lead management</p><h1 class="h2 fw-bold mb-0">Contact enquiries</h1></div>
            <a class="btn btn-outline-dark rounded-pill px-4" href="?<?= adminEscape(http_build_query($queryForExport)) ?>"><i class="bi bi-download me-2"></i>Export CSV</a>
        </div>

        <div class="row g-3 mb-4">
            <?php foreach ([['Total leads', $stats['total'] ?? 0], ['New', $stats['new_count'] ?? 0], ['Qualified', $stats['qualified_count'] ?? 0], ['Won', $stats['won_count'] ?? 0]] as $stat): ?>
                <div class="col-6 col-lg-3"><div class="card border-0 shadow-sm h-100"><div class="card-body"><div class="small text-secondary mb-2"><?= adminEscape($stat[0]) ?></div><div class="h2 fw-bold mb-0"><?= (int) $stat[1] ?></div></div></div></div>
            <?php endforeach; ?>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="get" class="row g-3 align-items-end">
                    <div class="col-md-5"><label class="form-label small fw-semibold" for="q">Search</label><input class="form-control" id="q" name="q" value="<?= adminEscape($search) ?>" placeholder="Name, email, company or challenge"></div>
                    <div class="col-md-3"><label class="form-label small fw-semibold" for="status">Status</label><select class="form-select" id="status" name="status"><option value="">All statuses</option><?php foreach ($statuses as $status): ?><option value="<?= $status ?>" <?= $statusFilter === $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-2"><label class="form-label small fw-semibold" for="source">UTM source</label><select class="form-select" id="source" name="source"><option value="">All sources</option><?php foreach ($sources as $source): ?><option value="<?= adminEscape($source) ?>" <?= $sourceFilter === $source ? 'selected' : '' ?>><?= adminEscape($source) ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-2 d-flex gap-2"><button class="btn btn-dark flex-grow-1" type="submit">Filter</button><a class="btn btn-outline-secondary" href="<?= url('admin/') ?>" title="Clear filters"><i class="bi bi-x-lg"></i></a></div>
                </form>
            </div>
        </div>

        <div class="row g-4 align-items-start">
            <div class="col-12">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light"><tr><th class="ps-4">Lead</th><th>Challenge</th><th>Attribution</th><th>Status</th><th>Date</th><th class="pe-4"></th></tr></thead>
                            <tbody>
                            <?php if (!$leads): ?><tr><td class="text-center text-secondary py-5" colspan="6">No leads match these filters.</td></tr><?php endif; ?>
                            <?php foreach ($leads as $lead): ?>
                                <tr>
                                    <td class="ps-4"><strong class="d-block"><?= adminEscape($lead['name']) ?></strong><a class="small text-secondary" href="mailto:<?= adminEscape($lead['email']) ?>"><?= adminEscape($lead['email']) ?></a><?php if ($lead['company']): ?><span class="small d-block text-secondary"><?= adminEscape($lead['company']) ?></span><?php endif; ?></td>
                                    <td><span class="d-inline-block text-truncate" style="max-width:260px"><?= adminEscape($lead['challenge']) ?></span></td>
                                    <td>
                                        <span class="d-inline-flex align-items-center gap-2" tabindex="0" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<?= leadUtmTooltip($lead) ?>">
                                            <span><span class="small d-block"><?= adminEscape($lead['first_utm_source'] ?: ($lead['last_utm_source'] ?: 'Direct')) ?></span><span class="small text-secondary"><?= adminEscape($lead['first_utm_campaign'] ?: ($lead['last_utm_campaign'] ?: 'No campaign')) ?></span></span>
                                            <i class="bi bi-info-circle text-secondary" aria-hidden="true"></i>
                                        </span>
                                    </td>
                                    <td><span class="badge rounded-pill <?= leadStatusClass($lead['status']) ?>"><?= ucfirst(adminEscape($lead['status'])) ?></span></td>
                                    <td class="small text-secondary text-nowrap"><?= adminEscape(date('d M Y', strtotime($lead['created_at']))) ?></td>
                                    <td class="pe-4"><a class="btn btn-sm btn-outline-dark admin-icon-btn" href="?lead=<?= (int) $lead['id'] ?>" aria-label="View <?= adminEscape($lead['name']) ?>"><i class="bi bi-arrow-up-right"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if ($pageCount > 1): ?><nav class="mt-4"><ul class="pagination"><?php for ($number = 1; $number <= $pageCount; $number++): $pageQuery = $_GET; $pageQuery['page'] = $number; unset($pageQuery['lead']); ?><li class="page-item <?= $number === $page ? 'active' : '' ?>"><a class="page-link" href="?<?= adminEscape(http_build_query($pageQuery)) ?>"><?= $number ?></a></li><?php endfor; ?></ul></nav><?php endif; ?>
            </div>

            <?php if ($selectedLead): ?>
                <div class="modal fade" id="lead-detail-modal" tabindex="-1" aria-labelledby="lead-detail-title" aria-hidden="true" data-close-url="<?= url('admin/') ?>">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content border-0">
                            <div class="modal-header px-4 px-md-5 py-4">
                                <div><span class="font-mono small text-uppercase text-secondary">Lead #<?= (int) $selectedLead['id'] ?></span><h2 class="modal-title h3 fw-bold mt-1 mb-0" id="lead-detail-title"><?= adminEscape($selectedLead['name']) ?></h2></div>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-4 px-md-5 py-4">
                                <?php if (isset($_GET['saved'])): ?><div class="alert alert-success py-2">Lead updated successfully.</div><?php endif; ?>
                                <div class="row g-4 g-lg-5">
                                    <div class="col-lg-7">
                                        <div class="row g-3 mb-4">
                                            <?php foreach ([
                                                ['Email', $selectedLead['email'], 'mailto:' . $selectedLead['email']],
                                                ['Phone', $selectedLead['phone'] ?: 'Not provided', $selectedLead['phone'] ? 'tel:' . $selectedLead['phone'] : ''],
                                                ['Company', $selectedLead['company'] ?: 'Not provided', ''],
                                                ['Timeline', $selectedLead['timeline'] ?: 'Not provided', ''],
                                            ] as $detail): ?>
                                                <div class="col-md-6"><div class="admin-detail-box h-100"><div class="small text-secondary mb-1"><?= adminEscape($detail[0]) ?></div><?php if ($detail[2]): ?><a class="fw-semibold text-dark text-decoration-none text-break" href="<?= adminEscape($detail[2]) ?>"><?= adminEscape($detail[1]) ?></a><?php else: ?><div class="fw-semibold"><?= adminEscape($detail[1]) ?></div><?php endif; ?></div></div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="admin-detail-box mb-4"><div class="small text-secondary mb-2">Biggest challenge</div><div><?= nl2br(adminEscape($selectedLead['challenge'])) ?></div></div>
                                        <div class="accordion" id="lead-attribution">
                                            <?php foreach (['first' => 'First-touch attribution', 'last' => 'Latest-touch attribution'] as $touchKey => $touchLabel): ?>
                                                <div class="accordion-item">
                                                    <h3 class="accordion-header"><button class="accordion-button <?= $touchKey === 'last' ? 'collapsed' : '' ?> py-3 small fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $touchKey ?>-touch" aria-expanded="<?= $touchKey === 'first' ? 'true' : 'false' ?>"><?= $touchLabel ?></button></h3>
                                                    <div class="accordion-collapse collapse <?= $touchKey === 'first' ? 'show' : '' ?>" id="<?= $touchKey ?>-touch" data-bs-parent="#lead-attribution">
                                                        <div class="accordion-body"><div class="row g-3">
                                                            <?php foreach (['Source' => 'utm_source', 'Medium' => 'utm_medium', 'Campaign' => 'utm_campaign', 'Term' => 'utm_term', 'Content' => 'utm_content', 'Google click ID' => 'gclid', 'Meta click ID' => 'fbclid', 'Landing page' => 'landing_page', 'Referrer' => 'referrer'] as $label => $field): ?>
                                                                <div class="col-md-6"><div class="small text-secondary"><?= $label ?></div><div class="small text-break"><?= adminEscape($selectedLead[$touchKey . '_' . $field] ?: ($field === 'utm_source' ? 'Direct' : 'Not captured')) ?></div></div>
                                                            <?php endforeach; ?>
                                                        </div></div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="admin-lead-actions p-4">
                                            <div class="d-flex justify-content-between align-items-center mb-4"><span class="fw-bold">Manage lead</span><span class="badge rounded-pill <?= leadStatusClass($selectedLead['status']) ?>"><?= ucfirst(adminEscape($selectedLead['status'])) ?></span></div>
                                            <form method="post" class="d-grid gap-3">
                                                <input type="hidden" name="admin_csrf" value="<?= adminEscape(adminCsrfToken()) ?>"><input type="hidden" name="action" value="update_lead"><input type="hidden" name="lead_id" value="<?= (int) $selectedLead['id'] ?>">
                                                <div><label class="form-label small fw-semibold" for="lead-status">Status</label><select class="form-select" id="lead-status" name="status"><?php foreach ($statuses as $status): ?><option value="<?= $status ?>" <?= $selectedLead['status'] === $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option><?php endforeach; ?></select></div>
                                                <div><label class="form-label small fw-semibold" for="lead-notes">Internal notes</label><textarea class="form-control" id="lead-notes" name="notes" rows="7"><?= adminEscape($selectedLead['notes']) ?></textarea></div>
                                                <button class="btn btn-dark rounded-pill" type="submit">Save changes</button>
                                            </form>
                                            <hr class="my-4">
                                            <div class="small text-secondary mb-3">Submitted <?= adminEscape(date('d M Y, g:i a', strtotime($selectedLead['created_at']))) ?> · Email alert <?= $selectedLead['email_sent'] ? 'sent' : 'not sent' ?></div>
                                            <button class="btn btn-outline-danger rounded-pill w-100" id="delete-lead-trigger" type="button"><i class="bi bi-trash3 me-2"></i>Delete lead</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="delete-lead-modal" tabindex="-1" aria-labelledby="delete-lead-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0"><h2 class="modal-title h5 fw-bold" id="delete-lead-title">Delete this lead?</h2><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                            <div class="modal-body pt-0">This permanently removes <?= adminEscape($selectedLead['name']) ?> and their attribution data. This action cannot be undone.</div>
                            <div class="modal-footer border-0">
                                <button class="btn btn-outline-secondary rounded-pill" type="button" data-bs-dismiss="modal">Cancel</button>
                                <form method="post" class="m-0">
                                    <input type="hidden" name="admin_csrf" value="<?= adminEscape(adminCsrfToken()) ?>">
                                    <input type="hidden" name="action" value="delete_lead">
                                    <input type="hidden" name="lead_id" value="<?= (int) $selectedLead['id'] ?>">
                                    <button class="btn btn-danger rounded-pill" type="submit">Delete permanently</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <div class="modal fade" id="change-password-modal" tabindex="-1" aria-labelledby="change-password-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 px-4 pt-4"><div><p class="font-mono small text-uppercase text-secondary mb-1">Account security</p><h2 class="modal-title h4 fw-bold" id="change-password-title">Change password</h2></div><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <form method="post">
                    <div class="modal-body px-4 d-grid gap-3">
                        <?php if ($openPasswordModal && $error): ?><div class="alert alert-danger py-2 mb-0"><?= adminEscape($error) ?></div><?php endif; ?>
                        <input type="hidden" name="admin_csrf" value="<?= adminEscape(adminCsrfToken()) ?>">
                        <input type="hidden" name="action" value="change_password">
                        <div><label class="form-label small fw-semibold" for="current-password">Current password</label><input class="form-control" id="current-password" name="current_password" type="password" autocomplete="current-password" required></div>
                        <div><label class="form-label small fw-semibold" for="new-password">New password</label><input class="form-control" id="new-password" name="new_password" type="password" autocomplete="new-password" minlength="10" required><div class="form-text">Use at least 10 characters.</div></div>
                        <div><label class="form-label small fw-semibold" for="new-password-confirmation">Confirm new password</label><input class="form-control" id="new-password-confirmation" name="new_password_confirmation" type="password" autocomplete="new-password" minlength="10" required></div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4"><button class="btn btn-outline-secondary rounded-pill" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-dark rounded-pill" type="submit">Update password</button></div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (element) {
            new bootstrap.Tooltip(element);
        });

        <?php if ($openPasswordModal): ?>
            new bootstrap.Modal(document.getElementById('change-password-modal')).show();
        <?php endif; ?>

        <?php if ($selectedLead): ?>
            var leadModalElement = document.getElementById('lead-detail-modal');
            var leadModal = new bootstrap.Modal(leadModalElement);
            var switchingToDelete = false;
            leadModal.show();

            leadModalElement.addEventListener('hidden.bs.modal', function () {
                if (switchingToDelete) {
                    switchingToDelete = false;
                    new bootstrap.Modal(document.getElementById('delete-lead-modal')).show();
                    return;
                }
                window.location.href = leadModalElement.dataset.closeUrl;
            });

            document.getElementById('delete-lead-trigger').addEventListener('click', function () {
                switchingToDelete = true;
                leadModal.hide();
            });
        <?php endif; ?>
    </script>
</body>
</html>
