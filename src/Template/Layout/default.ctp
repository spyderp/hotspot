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
	<?= $this->Html->css('style.css') ?>
	<?= $this->Html->css('default.css') ?>
	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">Banesco::Registro de acceso WiFi de cortesia</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
		  <ul class="nav navbar-nav navbar-right">
			<li><?= $this->Html->link('Salir', ['controller'=>'users', 'action'=>'logout']) ?></li>
		  </ul>
		</div>
	  </div>
	</nav>
	<div class="container-fluid">
		<?= $this->Flash->render() ?>
		<?= $this->fetch('content') ?>
	</div>
	<?= $this->fetch('script') ?>
</body>
</html>
