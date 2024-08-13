<?= $this->extend('Front/Default'); ?>

<?= $this->section('content'); ?>

<div class="container contact-container py-5">
    <h1 class="text-center mb-5"><?=lang('App.contacts');?></h1>
    <?php foreach($stores as $v): ?>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-card">
                    <h4><?=lang('App.store-address');?> <?=$v['name'];?></h4>
                    <div class="contact-info">
                        <div class="info-item">
                            <p><?=$v['address'];?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-card">
                    <h4><?=lang('App.house-work');?></h4>
                    <div class="contact-info">
                        <div class="info-item">
                            <p><?=$v['working_hours'];?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-card">
                    <h4><?=lang('App.phone-numbers');?></h4>
                    <div class="contact-info">
                        <?php foreach ($v['phones'] as $phone): ?>
                            <div class="info-item">
                                <p><?=$phone;?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-card">
                    <h4>Email</h4>
                    <div class="contact-info">
                        <div class="info-item">
                            <p><?=$v['email'];?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=html_entity_decode($v['map']);?>
    <?php endforeach; ?>
    
</div>

<?= $this->endSection(); ?>