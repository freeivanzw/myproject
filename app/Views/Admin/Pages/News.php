<?= $this->extend('Admin/Default'); ?>

<?= $this->section('content'); ?>
<section class="d-flex flex-column">
    <span class="h2">Новини</span>
    <form method="post" action="<?= base_url('admin/news'); ?>">
        <button type="submit">Додати новину</button>
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
            <?php foreach ($news as $newsItem): ?>
                <tr>
                    <th style="width:100px;"><?=$newsItem['news_id'];?></th>
                    <td><?=$newsItem['title'];?></td>
                    <td style="width:130px;">
                        <a href="<?=base_url('admin/news/' . $newsItem['news_id']);?>">edit</a>
                    </td>
                    <td style="width:130px;">
                        <a href="<?=base_url('admin/news/remove/' . $newsItem['news_id']);?>">[X]</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<?= $this->endSection(); ?>