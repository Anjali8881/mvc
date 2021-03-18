<?php
namespace Controller\Core;

class Admin{

	protected $request = Null;
	protected $layout = null;
	protected $message = null;
	protected $session = null;

	public function __construct(){
		$this->setRequest();
		$this->setLayout();
		$this->setMessage();
		$this->setSession();
	}

	public function setRequest(){
		$this->request = \Mage::getModel('Model\Core\Request');
		return $this;
	}

	public function getRequest(){
		return $this->request;
	}

    public function redirect($actionName = NULL, $controllerName = Null,$params=[],$resetParams=false){
        header("Location: ".$this->getUrl($actionName,$controllerName,$params,$resetParams));
		exit(0);
    }

    public function getUrl($actionName = null,$controllerName=null,$params=[],$resetParams=false) {

		$urls = $this->getRequest()->getGet();
		if($resetParams){
			$urls=[];
		}
		if ($actionName == NULL) {
			$actionName = $_GET['a'];
		}

		if ($controllerName == NULL) {
			$controllerName = $_GET['c'];
		}
		$urls['c'] = $controllerName;
		$urls['a'] = $actionName;

		if(is_array($params)){
			$urls = array_merge($urls,$params);
		}
		
		$query_String = http_build_query($urls);
		unset($urls);
		return "http://localhost/questecom/index.php?$query_String";
	}

	public function getLayout(){
		return $this->layout;
	}

	public function setLayout($layout = null){
		if(!$layout){
			$layout  = \Mage::getBlock('Block\Core\Layout');
		}
		$this->layout = $layout;
		return $this;

	}

	public function renderLayout(){
		echo $this->getLayout()->toHtml();
	}

	public function setMessage(){
		$this->message = \Mage::getModel('Model\Admin\Message');
		return $this->message;
	}

	public function getMessage(){
		return $this->message;
	}

	public function setSession(){
		$this->session = \Mage::getModel('Model\Admin\Session');
		return $this->session;
	}

	public function getSession(){
		return $this->session;
	}

}
?>