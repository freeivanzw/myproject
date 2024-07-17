<?= $this->extend('Front/Default'); ?>

<?= $this->section('content'); ?>

<section class="py-5">
    <div class="container">
        <div class="h1 text-center mb-5"><?=lang('App.news');?></div>
        <div class="row gx-4 gx-lg-5">
            <?php foreach ($news as $newsItem): ?>
                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title"><?=$newsItem['title'];?></h2>
                            <p class="card-text"><?=$newsItem['description'];?></p>
                        </div>
                        <div class="card-footer"><a class="btn btn-primary btn-sm" href="<?=base_url('news/' . $newsItem['news_id']);?>"><?=lang('App.details');?></a></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>