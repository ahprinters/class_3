<?php
require_once __DIR__ . '/config/app.php';
require_guest();

$pageTitle = 'Login / Register';
$activeTab = ($_GET['tab'] ?? 'login') === 'register' ? 'register' : 'login';

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
            </ol>
        </div>
    </nav>

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('assets/images/backgrounds/login-bg.jpg')">
        <div class="container">
            <div class="form-box">
                <?php include __DIR__ . '/includes/alerts.php'; ?>

                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link <?= $activeTab === 'login' ? 'active' : '' ?>" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $activeTab === 'register' ? 'active' : '' ?>" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab">Register</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade <?= $activeTab === 'login' ? 'show active' : '' ?>" id="signin-2" role="tabpanel">
                            <form action="actions/login.php" method="post">
                                <?= csrf_input() ?>
                                <div class="form-group">
                                    <label for="signin-email-2">Email address *</label>
                                    <input type="email" class="form-control" id="signin-email-2" name="email" value="<?= e($_SESSION['old']['email'] ?? '') ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="signin-password-2">Password *</label>
                                    <input type="password" class="form-control" id="signin-password-2" name="password" required>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>LOG IN</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="signin-remember-2" name="remember" value="1">
                                        <label class="custom-control-label" for="signin-remember-2">Remember Me</label>
                                    </div>

                                    <a href="#" class="forgot-link">Forgot Your Password?</a>
                                </div>
                            </form>

                            <div class="form-choice">
                                <p class="text-center">or sign in with</p>
                                <div class="row">
                                    <div class="col-sm-6"><a href="#" class="btn btn-login btn-g"><i class="icon-google"></i>Login With Google</a></div>
                                    <div class="col-sm-6"><a href="#" class="btn btn-login btn-f"><i class="icon-facebook-f"></i>Login With Facebook</a></div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade <?= $activeTab === 'register' ? 'show active' : '' ?>" id="register-2" role="tabpanel">
                            <form action="actions/register.php" method="post">
                                <?= csrf_input() ?>
                                <div class="form-group">
                                    <label for="register-name-2">Full name *</label>
                                    <input type="text" class="form-control" id="register-name-2" name="name" value="<?= e($_SESSION['old']['name'] ?? '') ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="register-email-2">Your email address *</label>
                                    <input type="email" class="form-control" id="register-email-2" name="email" value="<?= e($_SESSION['old']['email'] ?? '') ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="register-password-2">Password *</label>
                                    <input type="password" class="form-control" id="register-password-2" name="password" minlength="6" required>
                                </div>

                                <div class="form-group">
                                    <label for="register-password-confirmation-2">Confirm Password *</label>
                                    <input type="password" class="form-control" id="register-password-confirmation-2" name="password_confirmation" minlength="6" required>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SIGN UP</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="register-policy-2" name="policy" value="1" required>
                                        <label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
                                    </div>
                                </div>
                            </form>

                            <div class="form-choice">
                                <p class="text-center">or sign in with</p>
                                <div class="row">
                                    <div class="col-sm-6"><a href="#" class="btn btn-login btn-g"><i class="icon-google"></i>Login With Google</a></div>
                                    <div class="col-sm-6"><a href="#" class="btn btn-login btn-f"><i class="icon-facebook-f"></i>Login With Facebook</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php unset($_SESSION['old']); ?>
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
