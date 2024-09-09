<?= $this->extend('Front/Default'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="row d-flex flex-wrap">
                <?php foreach($photos as $photo): ?>
                    <div class="col-6 mb-4 product_details-image">
                        <div class="card">
                            <img src="<?=$photo['image_url'];?>" alt="<?=$photo['alt'];?>" class="img-fluid card-img-top" style="height: 200px; object-fit: contain;">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-6">
            <h2 class="mb-3"><?= $product['name']; ?></h2>
            <p class="text-muted"><?=lang('App.product-code');?>: <?= $product['product_id']; ?></p>
            <p class="lead"><?=lang('App.price');?>: <strong><?= $product['price']; ?> грн</strong></p>
            <p>
                <?=lang('App.description');?>: <br>
                <?= $product['description']; ?>
            </p>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>