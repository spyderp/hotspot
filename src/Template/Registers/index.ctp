<?= $this->Html->css('jquery-ui.min',['block' => 'css']); ?>
<?= $this->Html->script(['jquery', 'jquery-ui.min'],['block' => 'script']); ?>
<?= $this->Html->scriptBlock('$( function() {
    $( ".datepicker" ).datepicker({dateFormat:"yy-mm-dd"});
  } );', ['block' => true]); ?>
<h3 class="page-header"><?= __('Registro de usuario del wifi') ?></h3>
<?= $this->Form->create(null,['id'=>'myForm']) ?>
<div class="row">
	<div class="col-xs-3">
		<?= $this->Form->control('inicio', ['label'=>false, 'placeholder'=>'Desde', 'class'=>'datepicker']);?>
	</div>
	<div class="col-xs-3">
		<?= $this->Form->control('fin', ['label'=>false, 'placeholder'=>'Hasta', 'class'=>'datepicker']);?>
	</div>
	<div class="col-xs-3">
		<?= $this->Form->button(__('Buscar'), ['class'=>'btn btn-primary']) ?>
		<?= $this->Form->button(__('Restablecer'), ['type'=>'reset','class'=>'btn btn-primary', 'onClick'=>'document.getElementById("inicio").value =""; document.getElementById("fin").value ="";']) ?>
	</div>
	<div class="col-xs-3">
			
	</div>
</div>
	
		
<div class="text-right">
	 <?= $this->Html->link(__('Excel'), ['controller' => 'Registers', 'action' => 'export','_ext' => 'csv'], ['class'=>'btn btn-success']); ?>
	  <?= $this->Html->link(__('PDF'), ['controller' => 'Registers', 'action' => 'pdf','_ext' => 'pdf'], ['class'=>'btn btn-success', 'target'=>'_blank']); ?>
	 <br> <br>
</div>
<?= $this->Form->end() ?>
<table class="table table-bordered table-striped table-hover table-responsive"  width="100%">
	<thead>
		<tr>
			<th scope="col"><?= $this->Paginator->sort('id') ?></th>
			
			<th scope="col"><?= $this->Paginator->sort('Client.nombre',['label'=>'Nombre']) ?></th>
			<th scope="col"><?= $this->Paginator->sort('client.email', ['label'=>'E-mail']) ?></th>
			<th scope="col"><?= $this->Paginator->sort('client.telefono', ['Teléfono']) ?></th>
			<th scope="col"><?= $this->Paginator->sort('client.client', '¿Es cliente?') ?></th>
			<th scope="col"><?= $this->Paginator->sort('fecha') ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($registers as $register): ?>
		<tr>
			<td><?= $this->Number->format($register->id) ?></td>
			<td><?= h($register->client->nombre) ?></td>
			<td><?= h($register->client->email) ?></td>
			<td><?= h($register->client->telefono) ?></td>
			<td><?= $register->client->cliente ?></td>
			<td><?= h($register->fecha) ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div class="paginator row">
	<div class="col-xs-12 col-md-6">
		<?= $this->Paginator->numbers(['first' => 'First page']) ?>
	</div>
	<div class="col-xs-12 col-md-6 text-right">
		<p>
			<?= $this->Paginator->counter(['format' => __('Pagina {{page}} de {{pages}}, viendo {{current}} registros de {{count}} en total')]) ?>
		</p>
	</div>
</div>
