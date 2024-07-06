<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyProject</title>
    <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('css/icons/font/bootstrap-icons.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('css/base.css');?>">
</head>
<body>
    <?= $this->render('Front/Components/Header');?>
    
    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>
    
    <?= $this->render('Front/Components/Footer');?>

    <script src="<?=base_url('js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?=base_url('js/scripts.js');?>"></script>
</body>
</html>