<?= $this->Form->create(null,['class'=>'form-signin']) ?>
    <fieldset>
        <legend><?= __('Por favor introduzca su usuario y contraseña') ?></legend>
        <?= $this->Form->control('username',['label'=>false,'placeholder'=>'Usuario']) ?>
        <?= $this->Form->control('password',['label'=>false,'placeholder'=>'Contraseña','type'=>'password']) ?>
    </fieldset>
<?= $this->Form->button(__('Acceso'), ['class'=>'btn btn-primary btn-lg btn-block']) ?>
<?= $this->Form->end() ?>
</div>
