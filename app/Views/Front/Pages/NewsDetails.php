<?= $this->extend('Front/Default'); ?>

<?= $this->section('content'); ?>
<article class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1 text-center mb-5"><?=$news['title'];?></h1>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <?=$news['news_text'];?>
        </div>
    </div>

</article>
<?= $this->endSection(); ?>