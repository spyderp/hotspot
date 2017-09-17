<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\Mailer\Email;
use Cake\Core\Configure;

class ReporteShell extends Shell
{
    
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Registers');
        $this->loadModel('Clients');

    }
    public function main()
    {
    	$ultimasemana = time()-(7 * 24 * 60 * 60);
        $where = [
        	'fecha >='=>date('Y-m-d', $ultimasemana),
        	'fecha <='=>date('Y-m-d')
        ];
		$result =$this->Registers->find()->contain(['Clients'])->where($where);
		$fecha=date('dmY');
		$nombre = 'reporte'.$fecha.'.csv';
		$fp = fopen('webroot/img/'.$nombre, 'w');
		$data = [
				'nombre',
				'correo',
				'telefono',
				'cliente',
				'fecha',
			];
		fputcsv($fp, $data);
		foreach ($result as $key => $value) {
			$data = [
				'nombre' => $value->client->nombre,
				'correo' => $value->client->email,
				'telefono' => $value->client->telefono,
				'cliente' => $value->client->cliente?'si':'no',
				'fecha' => $value->fecha->i18nFormat(),
			];
			fputcsv($fp, $data);
		}
		fclose($fp);
		$path=Configure::read('App.wwwRoot');
		$email = new Email('default');
		$email->from(['reporte@banesco.com' => 'Wifi Banesco reporte'])
	    ->to('spyderp@gmail.com')
	    ->subject('Reporte de '.$fecha)
	    ->attachments($path.'img/'.$nombre)
	    ->send('Se adjunta el reporte');
        $this->out('Envio');
    }
}