<?= $this->Form->create($client,['class'=>'form-signin']) ?>
	<?php
		echo $this->Form->control('nombre', ['label'=>false, 'placeholder'=>'Nombre y Apellido / Name', 'autofocus', 'required']);
		echo $this->Form->control('email', ['type'=>'email','label'=>false, 'placeholder'=>'E-Mail','required']);
		echo $this->Form->control('telefono', ['label'=>false, 'placeholder'=>'Teléfono / Telephone', 'required']);
		echo $this->Form->control('cliente',['label'=>'¿Es usted un cliente del banco?', 'value'=>true]);
		echo $this->Form->input('control', ['type'=>'checkbox', 'required', 'label'=>[
			'text'=>'He Leido y acepto los <a href="#">Términos y Servicios</a>',
			'escape' => false]
			]);
	?>
<?= $this->Form->button(__('CONECTARSE / SUBMIT'), ['class'=>'btn btn-primary btn-lg btn-block']) ?>
<?= $this->Form->end() ?>