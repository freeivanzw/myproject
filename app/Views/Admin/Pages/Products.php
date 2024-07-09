<?= $this->extend('Admin/Default'); ?>

<?= $this->section('content'); ?>
<section class="d-flex flex-column">
    <span class="h2">Продукти</span>
    <form method="post" action="<?= base_url('admin/products'); ?>">
        <button type="submit">Додати товар</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="width:100px;">Id</th>
                <th scope="col">Назва</th>
                <th scope="col">Ціна</th>
                <th scope="col" style="width:130px;">Редагувати</th>
                <th scope="col" style="width:130px;">Видалити</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <th style="width:100px;"><?=$product['product_id'];?></th>
                <td><?=$product['name'];?></td>
                <td><?=$product['price'];?></td>
                <td style="width:130px;">
                    <a href="<?=base_url('admin/products/' . $product['product_id']);?>">edit</a>
                </td>
                <td style="width:130px;">
                    <a href="<?=base_url('admin/products/remove/' . $product['product_id']);?>">[X]</a>
                </td>
            </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>
</section>
<?= $this->endSection(); ?>