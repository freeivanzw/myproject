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

        <span>Категорії</span>
        <br>

        <select name="category">
            <?php if(!$product['category_id']): ?>
                <option value="" selected disabled>Вибрати категорію</option>
            <?php endif; ?>
            <?php foreach($categories as $category): ?>
                <option value="<?=$category['category_id'];?>" <?=$product['category_id'] === $category['category_id'] ? 'selected' : '' ; ?>><?=$category['name'];?></option>
            <?php endforeach; ?>
        </select>

        <div id="photo_list" class="d-flex flex-wrap mb-3">
            <?php foreach($photos as $photoItem): ?>
                <div class="image-tile position-relative">
                    <img src="<?=$photoItem['image_url'];?>"class="img-fluid">
                    <button type="button" class="delete-btn" data-photo-id="<?=$photoItem['photo_id'];?>" >×</button>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="form-group d-flex flex-column mb-3">
            <label for="image">Завантажити зображення</label>
            <input type="file" class="form-control-file" id="upload_image">
        </div>

        <div class="upload_image-box hidden">
            <div id="uploaded_box" class="image-tile position-relative">
                <img src="#" id="selected_image" width="100" height="100">
                <button id="remove_image-btn" type="button" class="delete-btn">×</button>
            </div>
            <input type="text" id="image_alt" placeholder="alt">
            <button id="upload_image-btn" type="button" class="btn btn-primary">Завантажити зображення</button>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</section>
<script>
    const $productId = <?=$product['product_id'];?>;
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

        document.querySelector('.upload_image-box').classList.remove('hidden');
    })

    document.querySelector('#uploaded_box').addEventListener('click', function () {
        document.querySelector('.upload_image-box').classList.remove('hidden');

        $photoLoader.value = '';
        $selectedImage.setAttribute('src', '#');
    })

    $uploadImageBtn.addEventListener('click', function () {
        let formData = new FormData();

        formData.append('image', $photoLoader.files[0]);
        formData.set('alt', $imageAlt.value);
        formData.set('product_id', $productId);

        fetch('<?=base_url('admin/products/photo');?>', {
            method: "POST", 
            body: formData,
        }).then(response => response.json()).then(function (data) {
            if (data.status !== 'success') {
                return false;
            }     

            document.querySelector('.upload_image-box').classList.add('hidden');

            $photoLoader.value = '';
            $imageAlt.value = '';
            $selectedImage.setAttribute('src', '#');

            const $photoItem = document.createElement('div');

            $photoItem.classList.add('image-tile', 'position-relative')

            let HTML = `
                <img src="${data.filePath}" class="img-fluid">
                <button class="delete-btn" data-photo-id="${data.productId}">×</button>
            `;
            $photoItem.innerHTML = HTML

            $photoList.append($photoItem);
        });
    })

    const $deleteBtns = document.querySelectorAll('.delete-btn');

    $deleteBtns.forEach(function ($btn) {
        
        $btn.addEventListener('click', function () {
            const formData = {
                productId: $productId,
                photoId: $btn.getAttribute('data-photo-id'),
            };

            fetch(`<?=base_url('admin/products/photo');?>/${$productId}/${$btn.getAttribute('data-photo-id')}`, {
                method: "DELETE", 
            }).then(response => response.json()).then(function (data) {
                if (!data.success) {
                    return false;
                }

                $btn.parentElement.remove();

            });

        })
    })

</script>
<?= $this->endSection(); ?>