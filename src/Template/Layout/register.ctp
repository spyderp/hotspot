<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('bootstrap-theme.min.css') ?>
     <?= $this->Html->css('register.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <?= $this->Html->image('0001.jpg', ['class'=>'logo']); ?>
        </div>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</body>
</html>
