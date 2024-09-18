<?= $this->extend('Admin/Default'); ?>

<?= $this->section('content'); ?>
<section>
    <a href="<?=base_url('admin/news');?>">Назад</a>
    <div class="h3">ID: <?=$news['news_id'];?></div>
    <form action="<?= base_url('admin/news/' . $news['news_id']) ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$news['news_id'];?>">

        <div class="form-group mb-3">
            <label for="name">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= esc($news['title']) ?>">
        </div>

        <div class="form-group mb-3">
            <label for="description">Короткий опис статті</label>
            <textarea class="form-control" id="description" name="description"><?= esc($news['description']) ?></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="price">Текст</label>
            <textarea class="form-control" id="editor1" name="news_text"><?= esc($news['news_text']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</section>
<script src="<?=base_url('js/plugins/ckeditor/ckeditor.js');?>"></script>
<script>
    CKEDITOR.replace('editor1', {
        filebrowserImageUploadUrl: '<?= base_url('admin/news/' . $news['news_id'] . '/image?type=Images') ?>',
    });
</script>
<?= $this->endSection(); ?>