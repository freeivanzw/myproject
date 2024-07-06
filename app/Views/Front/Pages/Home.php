<?= $this->extend('Front/Default'); ?>

<?= $this->section('content'); ?>
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
      <h1 class="display-3 fw-bold">Designed for engineers</h1>
      <h3 class="fw-normal text-muted mb-3">Build anything you want with Aperture</h3>
      <div class="d-flex gap-3 justify-content-center lead fw-normal">
        <a class="icon-link" href="#">
          Learn more
          <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
        </a>
        <a class="icon-link" href="#">
          Buy
          <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
        </a>
      </div>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>
<section class="py-5 border-bottom" id="features">
    <div class="container my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
                <h2 class="h4 fw-bolder">Featured title</h2>
                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                <h2 class="h4 fw-bolder">Featured title</h2>
                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
            </div>
            <div class="col-lg-4">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                <h2 class="h4 fw-bolder">Featured title</h2>
                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>