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

        <hr>
        <span>В розробці: </span>
        <hr>

        <div id="photo_list" class="d-flex flex-wrap mb-3">
            <?php foreach($photos as $photoItem): ?>
                <div class="image-tile position-relative">
                    <img src="<?=$photoItem['image_url'];?>" data-photo-id="<?=$photoItem['photo_id'];?>" class="img-fluid">
                    <button class="delete-btn">×</button>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form-group d-flex flex-column mb-3">
            <label for="image">Завантажити зображення</label>
            <input type="file" class="form-control-file" id="upload_image">
        </div>

        <div id="uploaded_box" class="image-tile position-relative hidden">
            <img src="#" id="selected_image" width="100" height="100">
            <button id="remove_image-btn" type="button" class="delete-btn">×</button>
        </div>
        <input type="text" id="image_alt">
        <button id="upload_image-btn" type="button" class="btn btn-primary hidden">Завантажити зображення</button>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</section>
<script>
    const $photoList = document.querySelector('#photo_list');
    const $photoLoader = document.querySelector('#upload_image');
    const $imageAlt = document.querySelector('#image_alt');
    const $selectedImage = document.querySelector('#selected_image');
    const $uploadImageBtn = document.querySelector('#upload_image-btn');

    $photoLoader.addEventListener('change', function (e) {
        var selectedFile = event.target.files[0];

        const reader = new FileReader();

        reader.onload = function (event) {
            $selectedImage.setAttribute('src', event.target.result);
        }

        reader.readAsDataURL(selectedFile);

        document.querySelector('#uploaded_box').classList.remove('hidden');
        $uploadImageBtn.classList.remove('hidden')
    })

    document.querySelector('#uploaded_box').addEventListener('click', function () {
        document.querySelector('#uploaded_box').classList.add('hidden');
        $uploadImageBtn.classList.add('hidden');

        $photoLoader.value = '';
        $selectedImage.setAttribute('src', '#');
    })

    $uploadImageBtn.addEventListener('click', function () {
        let formData = new FormData();

        formData.append('image', $photoLoader.files[0]);
        formData.set('alt', $imageAlt.value);
        formData.set('product_id', <?=$product['product_id'];?>);

        fetch('<?=base_url('admin/products/photo');?>', {
            method: "POST", 
            body: formData,
        }).then(response => response.json()).then(function (data) {
            if (data.status !== 'success') {
                return false;
            }     

            document.querySelector('#uploaded_box').classList.add('hidden');
            $uploadImageBtn.classList.add('hidden');

            $photoLoader.value = '';
            $selectedImage.setAttribute('src', '#');

            const $photoItem = document.createElement('div');

            $photoItem.classList.add('image-tile', 'position-relative')

            let HTML = `
                <img src="${data.filePath}" data-photo-id="${data.productId}" class="img-fluid">
                <button class="delete-btn">×</button>
            `;
            $photoItem.innerHTML = HTML

            $photoList.append($photoItem);
        });
    })

</script>
<?= $this->endSection(); ?>