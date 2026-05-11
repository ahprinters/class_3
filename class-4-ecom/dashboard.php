<?php
require_once __DIR__ . '/config/app.php';
require_auth();

$user = current_user();
$pageTitle = 'Dashboard';

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Account<span>Dashboard</span></h1>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <?php include __DIR__ . '/includes/alerts.php'; ?>

                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        </ul>
                    </aside>

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active">
                                <p>Hello <span class="font-weight-normal text-dark"><?= e($user['name'] ?: $user['email']) ?></span>.</p>

                                <div class="card clean-card">
                                    <div class="card-body">
                                        <h4>Account Information</h4>
                                        <p><strong>Name:</strong> <?= e($user['name'] ?? '') ?></p>
                                        <p><strong>Email:</strong> <?= e($user['email']) ?></p>
                                        <p><strong>Joined:</strong> <?= e($user['created_at']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include __DIR__ . '/includes/footer.php';
include __DIR__ . '/includes/mobile-menu.php';
include __DIR__ . '/includes/signin-modal.php';
include __DIR__ . '/includes/scripts.php';
?>
