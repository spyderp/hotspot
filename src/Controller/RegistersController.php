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
		$r = $this->request->session()->read('where');
		$where = !is_null($r)?$this->request->session()->read('where'):[];
		if ($this->request->is('post')){
			if(!empty($this->request->data['inicio']))
				$where['Fecha >='] = $this->request->data['inicio'];
			if(!empty($this->request->data['fin']))
			 	$where['Fecha <='] = $this->request->data['fin'];
			 if(!empty($this->request->data['inicio']) || !empty($this->request->data['fin'])):
			 	$this->request->session()->write(['where'=>$where]);
			 else:
			 	$this->request->session()->delete('where');
			 	$where = [];
			 endif;
		}
		$registers = $this->paginate($this->Registers->find()->where($where));

		$this->set(compact('registers'));
		$this->set('_serialize', ['registers']);
	}
	public function export(){
 		
		$r = $this->request->session()->read('where');
		$where = !is_null($r)?$this->request->session()->read('where'):[];
		$registers =$this->Registers->find()->contain(['Clients'])->where($where)->toArray();
		$_serialize = 'registers';
		$_header = ['ID', 'Nombre', 'Teléfono', 'E-MAIL','¿Cliente?', 'Fecha'];
		$_extract = [
				        'id',
				        'client.nombre',
				        'client.telefono',
				        'client.email',
				        function($row){
				        	return $row['client']['cliente']?'Sí':'No';
				        },
				        'fecha'
				    ];
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('registers', '_serialize', '_header', '_extract'));
	}

	public function pdf(){
		$r = $this->request->session()->read('where');
		$where = !is_null($r)?$this->request->session()->read('where'):[];
		$registers =$this->Registers->find()->contain(['Clients'])->where($where)->toArray();
		$this->viewBuilder()->options([
                'pdfConfig' => [
                    'orientation' => 'portrait',
                    'filename' => 'export_' .date('ymshi')
                ]
            ]);
            $this->set(compact('registers'));
		$this->set('_serialize', ['registers']);

	}

}
