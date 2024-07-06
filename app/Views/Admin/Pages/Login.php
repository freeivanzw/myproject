<?= $this->extend('Admin/Simple'); ?>

<?= $this->section('content'); ?>
<section class="bg-light py-5">
    <div class="container my-5 px-5">
        <div class="text-center mb-5">
            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
            <h2 class="fw-bolder">Вхід в адмін панель</h2>
        </div>
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <form id="contactForm">
                    <div class="form-floating mb-3">
                        <input id="login" type="text" name="login" class="form-control" placeholder="Enter your login...">
                        <label for="login">Login</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="password" type="password" name="password" class="form-control" placeholder="*********">
                        <label for="password">Password</label>
                    </div>
                    <div class="d-grid"><button class="btn btn-primary btn-lg" id="submitButton" type="submit">Увійти</button></div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>