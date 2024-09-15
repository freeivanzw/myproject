<?= $this->extend('Admin/Default'); ?>

<?= $this->section('content');?>
<section>
    <span class="h2">Категорії</span>
    <form method="post" action="<?= base_url('admin/categories'); ?>">
        <button type="submit">Додати категорію</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="width:100px;">Id</th>
                <th scope="col" style="width:200px;">Зображення</th>
                <th scope="col">Назва</th>
                <th scope="col" style="width:130px;">Редагувати</th>
                <th scope="col" style="width:130px;">Видалити</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <th style="width:100px;"><?=$category['category_id'];?></th>
                    <th style="width:200px;">
                        <?php if (!$category['image']): ?>
                            <img src="<?=base_url('images/no-photo.jpg');?>" width="100" height="100" alt="not found">
                        <?php else: ?>
                            <img src="<?=base_url('uploads/category-photo/' . $category['category_id'] . '/' . $category['image']);?>" width="100" height="100" alt="category photo">
                            <a href="<?=base_url('admin/categories/remove-photo/' . $category['category_id']);?>">[X]</a>
                        <?php endif; ?>
                    </th>
                    <td class="coategory_name-wrap">
                        <span><?=$category['name'];?></span>
                        <form method="post" action="<?=base_url('admin/categories/edit');?>" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$category['category_id'];?>">
                            <span>Назва</span>
                            <br>
                            <input type="text" name="name" value="<?=$category['name'];?>">
                            <br>
                            <span>Зображення</span>
                            <br>
                            <input type="file" name="image">
                            <br>
                            <button>Зберегти</button>
                        </form>
                    </td>
                    <td style="width:130px;">
                        <button class="edit_category">edit</button>
                    </td>
                    <td style="width:130px;">
                        <button class="remove_category" data-category-id="<?=$category['category_id'];?>">[X]</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>
</section>
<script>
    const removeBtns = document.querySelectorAll('.remove_category');

    removeBtns.forEach(function (elem) {
        elem.addEventListener('click', function () {
            const categoryTableRow = this.closest('tr');
            const productId = this.getAttribute('data-category-id');

            fetch('<?=base_url('admin/categories');?>/' + productId, {
                method: "DELETE", 
            }).then(response => response.json()).then(function (data) {
                if (!data.success) {
                    return false;
                }     
                
                categoryTableRow.remove();
            });
        });
    })

    const editBtns = document.querySelectorAll('.edit_category');
    editBtns.forEach(function (elem) {
        elem.addEventListener('click', function () {
            const categoryTableRow = this.closest('tr');
            categoryTableRow.classList.toggle('editing');
        })

    })
</script>
<?= $this->endSection();?>