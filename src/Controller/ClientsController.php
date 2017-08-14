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
				if($this->Clients->save($client)):
					$this->_sendAuthorization($id, $ap, $minutes, $url);
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
					if($this->Clients->Registers->save($register)):
						$this->_sendAuthorization($id, $ap, $minutes, $url);
					endif;
				else:
					$client = $this->Clients->get($result[0]['id']);
					$client->cliente = $this->request->data['cliente'];
					if($this->Clients->save($client)):
						$this->_sendAuthorization($id, $ap, $minutes, $url);
					endif;
				endif;
			endif;
			$this->Flash->error(__('The client could not be saved. Please, try again.'));
		}
		$this->set(compact('client'));
		$this->set('_serialize', ['client']);
	}

	private function _sendAuthorization($id, $ap, $minutes, $url) {
		$this->_login();
        $this->_authorize_guest($id, $minutes);
        $this->_logout();
		echo "Login successful, I should redirect to: " . $url; //$_SESSION['url'];
		sleep(8); // Small sleep to allow controller time to authorize
		header('Location: ' . $url);//$_SESSION['url']);
	}
    private function _login(){
      $unifiServer = Configure::read('unifi.unifiServer');
	$unifiUser = Configure::read('unifi.unifiUser');
	$unifiPass = Configure::read('unifi.unifiPass');
        $ch = $this->_get_curl_obj();
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_REFERER,  $unifiServer.'/login');
        curl_setopt($ch, CURLOPT_URL,  $unifiServer.'/api/login');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['username' => $unifiUser, 'password' => $unifiPass]));
        if (($content = curl_exec($ch)) === false) {
            trigger_error('cURL error: '.curl_error($ch));
        }
        curl_close ($ch);                                                 
    }
    private function logout(){
        $unifiServer = Configure::read('unifi.unifiServer');
         $ch = $this->_get_curl_obj();
         curl_setopt($ch, CURLOPT_URL, $unifiServer.'/logout');
        if (($content = curl_exec($ch)) === false) {
            trigger_error('cURL error: '.curl_error($ch));
        }
		curl_close ($ch);
    }
    private function _authorize_guest($mac, $minutes){
        $unifiServer = Configure::read('unifi.unifiServer');
        $json = ['cmd' => 'authorize-guest', 'mac' => $mac, 'minutes' => $minutes];
        $json = json_encode($json);
         $ch = $this->_get_curl_obj();
        curl_setopt($ch, CURLOPT_URL, $unifiServer.'/api/s/default/cmd/stamgr');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'json='.$json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        if (($content = curl_exec($ch)) === false) {
            trigger_error('cURL error: '.curl_error($ch));
        }
        curl_close ($ch);
    }
    private function  _get_curl_obj()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_COOKIE, "/tmp/unifi_cookie");
        
        return $ch;
    }
}
