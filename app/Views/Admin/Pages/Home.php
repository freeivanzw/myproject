<?= $this->extend('Admin/Default'); ?>

<?= $this->section('content'); ?>
<section class="d-flex flex-column">
    <span class="h2">Головна сторінка</span>

    <span class="h3">Баннер</span>
    <form action="#" class="mb-4">
        <div class="form-group mb-3">
            <label for="name">Назва</label>
            <input type="text" class="form-control" id="name" name="name" value="">
        </div>
        <div class="form-group mb-3">
            <label for="name">Підзаголовок</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle" value="">
        </div>
        <div class="form-group mb-3">
            <div class="selected_photo">
                <img src="#" alt="Product Image" class="img-thumbnail mt-2" width="150">
                <a href="#">Видалити</a>
            </div>

            <label for="image">Зображення</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
    </form>
    <span class="h3">Наші переваги</span>
    <ul>
        <li>
        <form action="#" class="mb-3">
            <div class="form-group mb-3">
                <label for="name">Назва</label>
                <input type="text" class="form-control" id="name" name="name" value="">
            </div>
            <div class="form-group mb-3">
                <label for="name">Текст</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle" value="">
            </div>
            <div class="form-group mb-3">
                <div class="selected_photo">
                    <img src="#" alt="Product Image" class="img-thumbnail mt-2" width="150">
                    <a href="#">Видалити</a>
                </div>

                <label for="image">Зображення</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
        </form>
        </li>
    </ul>
</section>

<?= $this->endSection(); ?>
