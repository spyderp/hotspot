<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Client $client
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Client'), ['action' => 'edit', $client->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Client'), ['action' => 'delete', $client->id], ['confirm' => __('Are you sure you want to delete # {0}?', $client->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Registers'), ['controller' => 'Registers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Register'), ['controller' => 'Registers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clients view large-9 medium-8 columns content">
    <h3><?= h($client->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($client->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellido') ?></th>
            <td><?= h($client->apellido) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($client->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telefono') ?></th>
            <td><?= h($client->telefono) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($client->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cliente') ?></th>
            <td><?= $client->cliente ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Registers') ?></h4>
        <?php if (!empty($client->registers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('Client Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($client->registers as $registers): ?>
            <tr>
                <td><?= h($registers->id) ?></td>
                <td><?= h($registers->fecha) ?></td>
                <td><?= h($registers->client_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Registers', 'action' => 'view', $registers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Registers', 'action' => 'edit', $registers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Registers', 'action' => 'delete', $registers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
