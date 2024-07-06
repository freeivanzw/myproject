<?= $this->extend('Front/Default'); ?>

<?= $this->section('content'); ?>

<div class="container contact-container py-5">
    <h1 class="text-center mb-5">Контакти</h1>
    <div class="row">
        <!-- Адреса магазину -->
        <div class="col-md-6">
            <div class="contact-card">
                <h4>Адреса магазину</h4>
                <div class="contact-info">
                    <div class="info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                            <path d="M12.166 8.94C13.404 7.228 14 5.63 14 4a6 6 0 1 0-12 0c0 1.63.596 3.228 1.834 4.94C5.07 11.055 7.5 15 8 15c.5 0 2.93-3.945 4.166-6.06ZM8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4Z" />
                        </svg>
                        <p>вул. Прикладна, 123, Київ, Україна</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Години роботи -->
        <div class="col-md-6">
            <div class="contact-card">
                <h4>Години роботи</h4>
                <div class="contact-info">
                    <div class="info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 1 .5.5v4h3a.5.5 0 0 1 0 1H8a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5ZM8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1Z" />
                        </svg>
                        <p>Понеділок - П'ятниця: 9:00 - 18:00</p>
                    </div>
                    <div class="info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 1 .5.5v4h3a.5.5 0 0 1 0 1H8a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5ZM8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1Z" />
                        </svg>
                        <p>Субота - Неділя: 10:00 - 16:00</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Номери телефонів -->
        <div class="col-md-6">
            <div class="contact-card">
                <h4>Номери телефонів</h4>
                <div class="contact-info">
                    <div class="info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a1.733 1.733 0 0 1 2.28.342L7.408 3.175c.329.329.445.78.342 1.199-.4 1.576-.625 2.357-1.5 3.232-.874.874-1.656 1.1-3.232 1.5-.42.103-.87-.013-1.2-.342l-1.505-1.505a1.733 1.733 0 0 1 .342-2.28l2.452-2.451Zm3.215 7.16a.5.5 0 0 1 .57.57c-.094.379-.288.725-.57 1.005-.281.282-.626.475-1.005.57a.5.5 0 0 1-.57-.57c.094-.379.288-.725.57-1.005.281-.282.626-.475 1.005-.57Z" />
                        </svg>
                        <p>+380 (99) 123-45-67</p>
                    </div>
                    <div class="info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a1.733 1.733 0 0 1 2.28.342L7.408 3.175c.329.329.445.78.342 1.199-.4 1.576-.625 2.357-1.5 3.232-.874.874-1.656 1.1-3.232 1.5-.42.103-.87-.013-1.2-.342l-1.505-1.505a1.733 1.733 0 0 1 .342-2.28l2.452-2.451Zm3.215 7.16a.5.5 0 0 1 .57.57c-.094.379-.288.725-.57 1.005-.281.282-.626.475-1.005.57a.5.5 0 0 1-.57-.57c.094-.379.288-.725.57-1.005.281-.282.626-.475 1.005-.57Z" />
                        </svg>
                        <p>+380 (44) 123-45-67</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Email -->
        <div class="col-md-6">
            <div class="contact-card">
                <h4>Email</h4>
                <div class="contact-info">
                    <div class="info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-5.993 3.596a1 1 0 0 1-1.014 0L2 5.383V12a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5.383Z" />
                        </svg>
                        <p>info@yourshop.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>