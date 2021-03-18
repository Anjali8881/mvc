<?php
namespace Block\Core;
class Template{

    protected $template = null;
    protected $controller;
    protected $children = [];
    protected $url = null;
    protected $request = null;

    public function __construct()
    {
        $this->setUrl();
        $this->setRequest();
    }

    public function setTemplate($template){
        $this->template = $template;
        return $this;
    }

    public function getTemplate(){
        return $this->template;
    }

    public function toHtml()
	{
		ob_start();
		require_once $this->getTemplate();
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

    // public function setController(Controller_Core_Admin $controller){
    //     $this->controller = $controller;
    //     return $this;
    // }

    // public function getController(){
    //     return $this->controller;
    // }

    public function setUrl($url = null){
        if(!$url){
            $url = \Mage::getModel('Model\Core\Url');
        }
        $this->url = $url;
        return $this;
    }

    public function getUrl(){
        if(!$this->url){
            $this->setUrl();
        }
        return $this->url;
    }

    public function setRequest(){
		$this->request = \Mage::getModel('Model\Core\Request');
		return $this;
	}

	public function getRequest(){
        
		return $this->request;
	}

    public function setChildren(array $children = []){
        $this->children = $children;
        return $this;
    }

    public function getChildren(){
        return $this->children;
    }

    public function addChild(\Block\Core\Template $child,$key = null){
        if(!$key){
            $key = get_class($child);
        }
        $this->children[$key] = $child;
        return $this;
    }

    public function getChild($key){
        if(!array_key_exists($key,$this->children)){
            return null;
        }
        return $this->children[$key];
    }

    public function removeChild($key){
        if(array_key_exists($key,$this->children)){
            unset($this->children[$key]);
        }
    }

    public function createBlock($className){
        return \Mage::getBlock($className);
    }

	public function getAdminMessage(){
		return \Mage::getModel('Model\Admin\Message');
	}

    public function baseUrl($subPath = null){
        return $this->getUrl()->baseUrl($subPath);
    }
    
}

?>