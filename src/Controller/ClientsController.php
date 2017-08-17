<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
 use UnifiApi;
/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 *
 * @method \App\Model\Entity\Client[] paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{

	public function beforeFilter(Event $event)
  {
      parent::beforeFilter($event);
      $this->Auth->allow(['add']);
  }
	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|void
	 */
	public function index()
	{
		$clients = $this->paginate($this->Clients);

		$this->set(compact('clients'));
		$this->set('_serialize', ['clients']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Client id.
	 * @return \Cake\Http\Response|void
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$client = $this->Clients->get($id, [
			'contain' => ['Registers']
		]);

		$this->set('client', $client);
		$this->set('_serialize', ['client']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$id= isset($_GET['id'])?$_GET['id']:null;
		$ap=isset($_GET['ap'])?$_GET['ap']:null;
		$minutes=120;
		$url=isset($_GET['url'])?$_GET['url']:null;
		$url = strpos($url, 'http')===false?$url:'http://'.$url;
		$this->viewBuilder()->setLayout('register'); 
		$client = $this->Clients->newEntity();
		if ($this->request->is('post')) {
			$result = $this->Clients->find()->where([
				'nombre'=>$this->request->data['nombre'],
				'telefono'=>$this->request->data['telefono'],
				'email'=>$this->request->data['email'],
			]);
			if($this->_sendAuthorization($id, $ap, $minutes, $url)):
				if($result->count()==0):
					$client = $this->Clients->patchEntity($client, $this->request->getData());
					if(!$this->Clients->save($client)):
						$this->Flash->set('error acceso 1');
					else:
						return $this->redirect($url);
					endif;
				else:
					$result = $result->toArray();
					if($this->request->data['cliente']==$result[0]['cliente']):
						$data=[
							'fecha'=>date('Y-m-d H:i:s'),
							'client_id'=>$result[0]['id'],
						];
						$register = $this->Clients->Registers->newEntity();
						$register  = $this->Clients->Registers->patchEntity($register, $data);
						if(!$this->Clients->Registers->save($register)):
							$this->Flash->set('error acceso 2');
						else:
							return $this->redirect($url);
						endif;
					else:
						$client = $this->Clients->get($result[0]['id']);
						$client->cliente = $this->request->data['cliente'];
						if(!$this->Clients->save($client)):
							$this->Flash->set('error acceso 3');
						else:
							return $this->redirect($url);
						endif;
					endif;
				endif;
			endif;
		}
		$this->set(compact('client'));
		$this->set('_serialize', ['client']);
	}

	private function _sendAuthorization($id, $ap, $minutes, $url) {
		$unifiServer = Configure::read('unifi.unifiServer');
		$unifiUser = Configure::read('unifi.unifiUser');
		$unifiPass = Configure::read('unifi.unifiPass');
		$unifi = new UnifiApi($unifiUser,$unifiPass,$unifiServer);
		$unifi->set_debug(false);
		if($unifi->login()):
			if($unifi->authorize_guest($id,  $minutes)):
				$unifi->logout();
				 return true;
			else:
				$this->Flash->set('error en la autorización');
			endif;
		else:
			$this->Flash->set('Error en el acceso a unifi');
		endif;
		return false;
		
	}
	 
    
}
