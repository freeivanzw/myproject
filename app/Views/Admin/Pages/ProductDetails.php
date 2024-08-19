<?= $this->extend('Admin/Default'); ?>

<?= $this->section('content'); ?>
<section>
    <a href="<?=base_url('admin/products');?>">Назад</a>
    <div class="h3">ID: <?=$product['product_id'];?></div>
    <form action="<?= base_url('admin/products/' . $product['product_id']) ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$product['product_id'];?>">

        <div class="form-group mb-3">
            <label for="name">Назва</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= esc($product['name']) ?>">
        </div>

        <div class="form-group mb-3">
            <label for="description">Опис</label>
            <textarea class="form-control" id="description" name="description"><?= esc($product['description']) ?></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="price">Ціна грн.</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= esc($product['price']) ?>">
        </div>

        <div class="form-group mb-3">
            <?php if ($product['main_photo']): ?>
                <div class="selected_photo">
                    <img src="<?= base_url('uploads/products-photo/' . $product['product_id'] . '/' . $product['main_photo']) ?>" alt="Product Image" class="img-thumbnail mt-2" width="150">
                    <a href="<?= base_url('admin/products/remove/mainPhoto/' . $product['product_id']) ?>"><?=lang('App.delete');?></a>
                </div>
            <?php else: ?>
                <label for="image">Зображення</label>
                <input type="file" class="form-control-file" id="image" name="image">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</section>
<?= $this->endSection(); ?>