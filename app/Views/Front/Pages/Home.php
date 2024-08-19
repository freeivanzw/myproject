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
        <div class="h2 text-center mb-5">Наші переваги</div>
        <div class="row gx-5">
            <?php foreach ($advantages as $advantageItem): ?>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <img src="<?=base_url('uploads/advantage-photo/' . $advantageItem['advantage_id'] . '/' . $advantageItem['image']);?>" class="img-fluid mb-2" style="width: 100px; height: 100px; object-fit: cover;" alt="<?=$advantageItem['title'];?>">
                    <h2 class="h4 fw-bolder"><?=$advantageItem['title'];?></h2>
                    <p><?=$advantageItem['description'];?></p>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>