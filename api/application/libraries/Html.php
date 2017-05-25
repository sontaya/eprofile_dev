<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/html2pdf/vendor/autoload.php');
require_once(dirname(__FILE__) . '/html2pdf/html2pdf.class.php');

class Html extends HTML2PDF {

	protected function ci(){
		return get_instance();
	}

	public function load_view($view, $data = array()){
		$html = $this->ci()->load->view($view, $data, TRUE);

		$this->load_html($html);
	}



}



