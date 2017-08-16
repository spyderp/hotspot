<table class="table table-bordered table-striped table-hover table-responsive"  width="100%">
	<thead>
		<tr>
			<th scope="col">Id ?></th>
			
			<th scope="col">Nombre</th>
			<th scope="col">E-mail</th>
			<th scope="col">Teléfono</th>
			<th scope="col">¿Es cliente?</th>
			<th scope="col">Fecha</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($registers as $register): ?>
		<tr>
			<td><?= $this->Number->format($register->id) ?></td>
			<td><?= h($register->client->nombre) ?></td>
			<td><?= h($register->client->email) ?></td>
			<td><?= h($register->client->telefono) ?></td>
			<td><?= $register->client->full ?></td>
			<td><?= h($register->fecha) ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
