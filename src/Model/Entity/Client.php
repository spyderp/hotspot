<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $telefono
 * @property bool $cliente
 *
 * @property \App\Model\Entity\Register[] $registers
 */
class Client extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
     protected function _getFull()
    {
        return $this->_properties['cliente']?'Sí':'No';
    }
}
