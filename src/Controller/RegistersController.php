<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Registers Controller
 *
 * @property \App\Model\Table\RegistersTable $Registers
 *
 * @method \App\Model\Entity\Register[] paginate($object = null, array $settings = [])
 */
class RegistersController extends AppController
{
	public $helpers = ['Cewi/Excel.Excel'];
	
	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|void
	 */
	public function index()
	{
		$this->paginate = [
			'contain' => ['Clients']
		];
		$where = [];
		if ($this->request->is('post')){
			if(!empty($this->request->data['inicio']))
				$where['Fecha >='] = $this->request->data['inicio'];
			if(!empty($this->request->data['fin']))
			 	$where['Fecha <='] = $this->request->data['fin'];
		}
		$registers = $this->paginate($this->Registers->find()->where($where));

		$this->set(compact('registers'));
		$this->set('_serialize', ['registers']);
	}

}
