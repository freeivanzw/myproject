<?= $this->extend('Front/Default'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?=base_url('uploads/products-photo/' . $product['product_id'] . '/' . $product['main_photo']);?>" alt="<?= $product['name']; ?>" class="img-fluid">
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