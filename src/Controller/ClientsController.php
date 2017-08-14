<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
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
	public function add($id=null, $ap=null, $minutes=null, $url=null)
	{
		$this->viewBuilder()->setLayout('register'); 
		$client = $this->Clients->newEntity();
		if ($this->request->is('post')) {
			$result = $this->Clients->find()->where([
				'nombre'=>$this->request->data['nombre'],
				'telefono'=>$this->request->data['telefono'],
				'email'=>$this->request->data['email'],
			]);
			if($result->count()==0):
				$client = $this->Clients->patchEntity($client, $this->request->getData());
				if($this->Clients->save($client))
					$this->_sendAuthorization($id, $ap, $minutes, $url);
			else:
				$result = $result->toArray();
				if($this->request->data['cliente']==$result[0]['cliente']):
					$data=[
						'fecha'=>date('Y-m-d H:i:s'),
						'client_id'=>$result[0]['id'],
					];
					$register = $this->Clients->Registers->newEntity();
					$register  = $this->Clients->Registers->patchEntity($register, $data);
					if($this->Clients->Registers->save($register))
						$this->_sendAuthorization($id, $ap, $minutes, $url);
				else:
					$client = $this->Clients->get($result[0]['id']);
					$client->cliente = $this->request->data['cliente'];
					if($this->Clients->save($client))
						$this->_sendAuthorization($id, $ap, $minutes, $url);
				endif;
			endif;
			$this->Flash->error(__('The client could not be saved. Please, try again.'));
		}
		$this->set(compact('client'));
		$this->set('_serialize', ['client']);
	}

	private function _sendAuthorization($id, $ap, $minutes, $url) {
		$unifiServer = Configure::read('unifi.unifiServer');
		$unifiUser = Configure::read('unifi.unifiUser')
		$unifiPass = Configure::read('unifi.unifiUser')

		// Start Curl for login
		$ch = curl_init();
		// We are posting data
		curl_setopt($ch, CURLOPT_POST, TRUE);
		// Set up cookies
		$cookie_file = "/tmp/unifi_cookie";
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
		// Allow Self Signed Certs
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		// Force SSL3 only
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		// Login to the UniFi controller
		curl_setopt($ch, CURLOPT_URL, "$unifiServer/login");
		curl_setopt($ch, CURLOPT_POSTFIELDS,"login=login&username=$unifiUser&password=$unifiPass");
		curl_exec ($ch);
		curl_close ($ch);

		// Send user to authorize and the time allowed
		$data = json_encode(array(
			'cmd'=>'authorize-guest',
	        'mac'=>$id,
			'ap'=>$ap,
	        'minutes'=>$minutes));
		$ch = curl_init();
		// We are posting data
		curl_setopt($ch, CURLOPT_POST, TRUE);
		// Set up cookies
		$cookie_file = "/tmp/unifi_cookie";
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
		// Allow Self Signed Certs
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		// Force SSL3 only
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		// Make the API Call
		curl_setopt($ch, CURLOPT_URL, $unifiServer.'/api/cmd/stamgr');
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'json='.$data);
		curl_exec ($ch);
		curl_close ($ch);
	  
		// Logout of the connection
		$ch = curl_init();
		// We are posting data
		curl_setopt($ch, CURLOPT_POST, TRUE);
		// Set up cookies
		$cookie_file = "/tmp/unifi_cookie";
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
		// Allow Self Signed Certs
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		// Force SSL3 only
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		// Make the API Call
		curl_setopt($ch, CURLOPT_URL, $unifiServer.'/logout');
		curl_exec ($ch);
		curl_close ($ch);
		echo "Login successful, I should redirect to: " . $url; //$_SESSION['url'];
		sleep(8); // Small sleep to allow controller time to authorize
		header('Location: ' . $url);//$_SESSION['url']);
	}
}
