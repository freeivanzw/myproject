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
                <td>
                    <span><?=$category['name'];?></span>
                    <form method="put" action="<?=base_url('admin/categories/' . $category['category_id']);?>">
                        <input type="text" value="<?=$category['name'];?>">
                        <button>Зберегти</button>
                    </form>
                </td>
                <td style="width:130px;">
                    <a href="<?=base_url('admin/categories/' . $category['category_id']);?>">edit</a>
                </td>
                <td style="width:130px;">
                    <a href="<?=base_url('admin/categories/remove/' . $category['category_id']);?>">[X]</a>
                </td>
            </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>
</section>
<?= $this->endSection();?>