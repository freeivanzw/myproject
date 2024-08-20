<?= $this->extend('Admin/Default'); ?>

<?= $this->section('content'); ?>
<section class="d-flex flex-column">
    <span class="h2">Головна сторінка</span>

    <span class="h3">Баннер</span>
    
    <form action="<?=base_url('admin/banner/1');?>" method="post" enctype="multipart/form-data" class="mb-4">
        <input type="hidden" name="banner_id" value="<?=$banner['banner_id'];?>">
        <div class="form-group mb-3">
            <label for="name">Назва</label>
            <input type="text" class="form-control" id="name" name="title" value="<?=$banner['title'];?>">
        </div>
        <div class="form-group mb-3">
            <label for="name">Підзаголовок</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?=$banner['subtitle'];?>">
        </div>
        <div class="form-group mb-3">
            <?php if ($banner['image']): ?>
                <div class="selected_photo">
                    <img src="<?=base_url('uploads/banner-photo/' .  $banner['banner_id'] . '/' . $banner['image']);?>" alt="banner Image" class="img-thumbnail mt-2" width="150">
                    <a href="<?=base_url('admin/banner/remove/image/' . $banner['banner_id'] );?>">Видалити</a>
                </div>
            <?php else: ?>
                <label for="advantage-img">Зображення</label>
                <input type="file" class="form-control-file" id="banner-img-<?=$banner['banner_id'];?>" name="image">
            <?php endif;?>
        </div>
        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
    <span class="h3">Наші переваги</span>
    <form action="<?=base_url('admin/advantages');?>" method="post">
        <button type="submit">Додати перевагу</button>
    </form>
    <ul>
        <?php foreach ($advantages as $advantageItem): ?>
            <li>
                <form action="<?=base_url('admin/advantages/' . $advantageItem['advantage_id'] );?>" enctype="multipart/form-data" method="post" class="mb-3">
                    <div class="form-group mb-3">
                        <label for="title-<?=$advantageItem['advantage_id'];?>">Назва</label>
                        <input type="text" class="form-control" id="title-<?=$advantageItem['advantage_id'];?>" name="title" value="<?=$advantageItem['title'];?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Текст</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?=$advantageItem['description'];?>">
                    </div>
                    <div class="form-group mb-3">
                        <?php if ($advantageItem['image']): ?>
                            <div class="selected_photo">
                                <img src="<?=base_url('uploads/advantage-photo/' .  $advantageItem['advantage_id'] . '/' . $advantageItem['image']);?>" alt="Product Image" class="img-thumbnail mt-2" width="150">
                                <a href="<?=base_url('admin/advantages/remove-photo/' . $advantageItem['advantage_id'] );?>">Видалити</a>
                            </div>
                        <?php else: ?>
                            <label for="advantage-img">Зображення</label>
                            <input type="file" class="form-control-file" id="advantage-img-<?=$advantageItem['advantage_id'];?>" name="image">
                        <?php endif;?>
                    </div>
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                    <a href="<?=base_url('admin/advantages/remove/' . $advantageItem['advantage_id'] );?>" class="btn btn-danger px-3">Видалити перевагу</a>
                </form>
            </li>
        <?php endforeach;?>
    </ul>
</section>

<?= $this->endSection(); ?>
