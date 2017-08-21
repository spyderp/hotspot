<?= $this->Html->script(['jquery', 'bootstrap.min'],['block' => 'script']); ?>
<?= $this->Form->create($client,['class'=>'form-signin']) ?>
	<?php
		echo $this->Form->control('nombre', ['label'=>false, 'placeholder'=>'Nombre y Apellido / Name', 'autofocus', 'required', 'autocomplete'=>'off']);
		echo $this->Form->control('email', ['type'=>'email','label'=>false, 'placeholder'=>'E-Mail','required', 'autocomplete'=>'off']);
		echo $this->Form->control('telefono', ['label'=>false, 'placeholder'=>'Teléfono / Telephone', 'required', 'autocomplete'=>'off']);
		echo $this->Form->control('cliente',['label'=>'¿Es usted un cliente del banco?', 'value'=>true]);
		echo $this->Form->input('control', ['type'=>'checkbox', 'required', 'label'=>[
			'text'=>'He Leido y acepto los <a href="#" data-toggle="modal" data-target="#myModal">Términos y Servicios</a>',
			'escape' => false]
			]);
	?>
<?= $this->Form->button(__('CONECTARSE / SUBMIT'), ['class'=>'btn btn-primary btn-lg btn-block']) ?>
<?= $this->Form->end() ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Termino y Condiciones</h4>
      </div>
      <div class="modal-body">
<strong>Condiciones de uso de la Red Wi-Fi Banesco_Clientes.</strong>
<ul>
	<li>Al acceder y utilizar la red Wi-Fi de Banesco, usted declara que ha leído, entendido y acepta los términos y condiciones para su utilización. Si usted no está de acuerdo con esta norma, no podrá acceder a este servicio.</li>
	<li>La red Wi-Fi está destinada únicamente para el uso exclusivo de los clientes que se encuentren en Banesco.</li>
	<li>Usted acepta y reconoce que hay riesgos potenciales a través de un servicio Wi-Fi. Debe tener cuidado al transmitir datos como: número de tarjeta de crédito, contraseñas u otra información personal sensible a través de redes Wi-Fi. Banesco no puede y no garantiza la privacidad y seguridad de sus datos y de las comunicaciones al utilizar este servicio.</li>
	<li>Banesco no garantiza el nivel de funcionamiento de la red Wi-Fi. El servicio puede no estar disponible o ser limitado en cualquier momento y por cualquier motivo, incluyendo emergencias, sobre carga de conexiones, fallo del enlace, problemas en equipos de red, interferencias o fuerza de la señal. Banesco, no se responsabiliza por datos, mensajes o páginas perdidas, no guardadas o retrasos por interrupciones o problemas de rendimiento con el servicio.</li>
	<li>Banesco puede establecer límites de uso, suspender el servicio o bloquear ciertos comportamientos, acceso a ciertos servicios o dominios para proteger la red del cliente de fraudes o actividades que atenten contra las leyes nacionales o internacionales.</li>
</ul>
<strong>NO se podrá utilizar la red Wi-Fi Banesco_Clientes con los siguientes fines:</strong>
<ul>
<li>Transmisión de contenido fraudulento, difamatorio, obsceno, ofensivo o de vandalismo, insultante o acosador, sea éste material o mensajes.</li>
<li>Interceptar, recopilar o almacenar datos sobre terceros sin su conocimiento o consentimiento. Escanear o probar la vulnerabilidad de equipos, sistemas o segmentos de red. Enviar mensajes no solicitados (spam), virus, o ataques internos o externos a la red de Banesco.
</li>
<li>Obtener acceso no autorizado a equipos, sistemas o programas tanto al interior de la red de Banesco como fuera de ella. Tampoco podrá utilizar la red WI-FI para obtener, manipular y compartir cualquier archivo sin tener los derechos de propiedad intelectual.
</li>
<li>Transmitir, copiar y/o descargar cualquier material que viole cualquier ley. Esto incluye entre otros: material con derecho de autor, pornografía infantil, material amenazante u obsceno, o material protegido por secreto comercial o patentes.
</li>
<li>Dañar equipos, sistemas informáticos o redes y/o perturbar el normal funcionamiento de la red. Ser usada con fines de lucro, actividades comerciales o ilegales, por ejemplo hacking. Ser utilizada para crear y/o la infectar con virus informático o malware en la red.
</li>
<li>He leído y entendido estas condiciones de uso de red Wi-Fi Banesco_Clientes y declaro conocer las políticas y normas establecidas por Banesco. Estoy de acuerdo en cumplir las directrices anteriores y entender que el incumplimiento de éstas, pueden resultar el bloqueo de mis derechos para usar la red WI-FI y asumir las sanciones legales si corresponde.
</li>
</ul>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>