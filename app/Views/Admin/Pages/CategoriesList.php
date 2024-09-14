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
                <th scope="col">Назва</th>
                <th scope="col" style="width:130px;">Редагувати</th>
                <th scope="col" style="width:130px;">Видалити</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <th style="width:100px;"><?=$category['category_id'];?></th>
                    <td class="coategory_name-wrap">
                        <span><?=$category['name'];?></span>
                        <form method="post" action="<?=base_url('admin/categories/edit');?>">
                            <input type="hidden" name="id" value="<?=$category['category_id'];?>">
                            <input type="text" name="name" value="<?=$category['name'];?>">
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