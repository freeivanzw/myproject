<?= $this->extend('Front/Default'); ?>

<?= $this->section('content'); ?>

<section class="py-5">
    <div class="container px-4 px-lg-5 ">
        <div class="h1 text-center mb-5">Каталог товарів</div>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
            <?php foreach($products as $id => $product): ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <a href="<?=base_url('products/' . $product['product_id']);?>">
                            <?php if ($product['image']): ?>
                                <img class="card-img-top" src="<?=$product['image'];?>" style="aspect-ratio: 1 / 1; object-fit: cover;" alt="<?=$product['name'];?>">
                            <?php else: ?>
                                <img class="card-img-top" src="<?=base_url('images/no-photo.jpg');?>" style="aspect-ratio: 1 / 1; object-fit: cover;" alt="<?=$product['name'];?>">
                            <?php endif;?>
                        </a>
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <a href="<?=base_url('products/' . $product['product_id']);?>" class="h5 d-flex center justify-content-center text-center fw-bolder"><?=$product['name'];?></a>
                                <!-- Product price-->
                                <?php if ((int)$product['price'] !== 0): ?>
                                    <span><?=$product['price'];?> <?=lang('App.uah');?></span>
                                <?php else:?>
                                    <span><?=lang('App.price-processing');?></span>
                                <?php endif;?>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a href="<?=base_url('products/' . $product['product_id']);?>" class="btn btn-outline-dark mt-auto">
                                    <?=lang('App.show-product');?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?=$pager->links('default', 'custom_pager');?>
</section>
<?= $this->endSection(); ?>