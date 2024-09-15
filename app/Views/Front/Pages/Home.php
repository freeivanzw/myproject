<?= $this->extend('Front/Default'); ?>

<?= $this->section('content'); ?>
<div class="position-relative overflow-hidden p-3 p-md-5 text-center">
    <img src="<?=base_url('uploads/banner-photo/' . $banner['banner_id'] . '/' . $banner['image']);?>" class="w-100 h-100 position-absolute top-0 start-0" alt="background image" style="z-index: -1; object-fit: cover;">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
        <h1 class="display-3 fw-bold"><?= $banner['title']; ?></h1>
        <h3 class="fw-normal text-muted mb-3"><?= $banner['subtitle']; ?></h3>
        <div class="d-flex gap-3 justify-content-center lead fw-normal">
            <a class="icon-link" href="<?= base_url('products'); ?>">Перегляньте наші товари</a>
        </div>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>
<section class="py-5 border-bottom" id="features">
    <div class="container my-5">
        <div class="h2 text-center mb-5">Категорії товарів</div>
        <div class="row gx-5">
            <?php foreach ($categories as $categoryItem): ?>
                <div class="col-lg-3 mb-5 mb-lg-0 d-flex flex-column justify-content-center align-items-center">
                    <?php if (empty($categoryItem['image'])): ?>
                        <img src="<?= base_url('images/no-photo.jpg'); ?>" class="img-fluid mb-2" style="width: 100px; height: 100px; object-fit: cover;" alt="<?= $categoryItem['name']; ?>">
                    <?php else: ?>
                        <img src="<?= base_url('uploads/category-photo/' . $categoryItem['category_id'] . '/' . $categoryItem['image']); ?>" class="img-fluid mb-2" style="width: 100px; height: 100px; object-fit: cover;" alt="<?= $categoryItem['name']; ?>">
                    <?php endif; ?>
                    <h2 class="h4 fw-bolder"><?= $categoryItem['name']; ?></h2>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="py-5 border-bottom" id="features">
    <div class="container my-5">
        <div class="h2 text-center mb-5">Наші переваги</div>
        <div class="row gx-5">
            <?php foreach ($advantages as $advantageItem): ?>
                <div class="col-lg-4 mb-5 mb-lg-0 d-flex flex-column justify-content-center align-items-center">
                    <img src="<?= base_url('uploads/advantage-photo/' . $advantageItem['advantage_id'] . '/' . $advantageItem['image']); ?>" class="img-fluid mb-2" style="width: 200px; height: 200px; object-fit: cover;" alt="<?= $advantageItem['title']; ?>">
                    <h2 class="h4 fw-bolder"><?= $advantageItem['title']; ?></h2>
                    <p><?= $advantageItem['description']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>