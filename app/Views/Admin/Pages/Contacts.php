<?= $this->extend('Admin/Default'); ?>

<?= $this->section('content');?>
<section>
    <span class="h2">Контакти</span>
    <a href="<?=base_url('admin/contacts/create-store');?>" class="btn btn-secondary px-3 mb-2">Додати магазин</a>
    <ul class="list-group">
        <?php foreach($stores as $storeItem): ?>
            <li class="list-group-item">
                <form action="" method="post">
                    <input type="hidden" name="store_id" value="<?=$storeItem['store_id'];?>">
                    <span class="h2 mb-4"><?=$storeItem['name'];?></span> 
                    <div class="form-group mb-3">
                        <label for="name-<?=$storeItem['store_id'];?>">Назва</label>
                        <input type="text" class="form-control" id="name-<?=$storeItem['store_id'];?>" name="name" value="<?=$storeItem['name'];?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="address-<?=$storeItem['store_id'];?>">Адреса</label>
                        <input type="text" class="form-control" id="address-<?=$storeItem['store_id'];?>" name="address" value="<?=$storeItem['address'];?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email-<?=$storeItem['store_id'];?>">Email</label>
                        <input type="email" class="form-control" id="email-<?=$storeItem['store_id'];?>" name="email" value="<?=$storeItem['email'];?>">
                    </div>
                    <div class="form-group mb-3">
                        <label>Телефони</label>
                        <button type="button" data-store-id="<?=$storeItem['store_id'];?>" class="create_phone btn btn-secondary px-3 mb-2">Додати телефон</button>
                        <ul class="list-group">
                            <?php foreach($storeItem['phones'] as $phoneId => $phone):?>
                                <li class="list-group-item">
                                    <input type="tel" class="form-control" name="phones[]" data-phone-id="<?=$phoneId;?>" value="<?=$phone;?>">
                                    <button type="button" class="remove_phone">[X]</button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="#" class="btn btn-danger px-3">Видалити магазин</a>
                </form>
            </li>
        <?php endforeach; ?>
        
    </ul>
</section>
<script>
    const base_url = '<?=base_url('');?>';

    const $createPhoneBtns = document.querySelectorAll('.create_phone');

    $createPhoneBtns.forEach(function ($btn) {
        $btn.addEventListener('click',async function () {
            const storeId = this.getAttribute('data-store-id');

            try {
                const req = await fetch(base_url + 'admin/contacts/create-phone', {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        storeId: storeId,
                    })
                })

                const data = await req.json();
                
                if (!data.success) {
                    throw new Error('phones not created');
                }

                const HTML = `
                    <li class="list-group-item">
                        <input type="tel" class="form-control" name="phones[]" data-phone-id="${data.phoneId}" value="">
                        <button type="button" class="remove_phone">[X]</button>
                    </li>
                `;

                $phonesList = $btn.nextElementSibling;
                $phonesList.innerHTML += HTML;
            } catch (err) {
                console.log(err.message);
            }
           
        })
    });

    const $removePhoneBtns = document.querySelectorAll('.remove_phone');

    $removePhoneBtns.forEach(function (btn) {
        btn.addEventListener('click', async function () {
            const $phoneGroup = this.closest('.list-group-item');
            const $phoneInput = this.closest('.list-group-item').querySelector('input');
            const phoneId = $phoneInput.getAttribute('data-phone-id');

            if (!phoneId) {
                return false;
            }

            try {
                const req = await fetch(base_url + 'admin/contacts/remove-phone/' + phoneId, {
                    method: 'GET',
                });

                const body = await req.json();

                if (!body.success) {
                    return false;
                }

                $phoneGroup.remove();
            } catch (err) {
                console.log(err.message);
            }
        })
    });
</script>
<?= $this->endSection();?>