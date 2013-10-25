<?

defined('C5_EXECUTE') or die("Access Denied.");
abstract class Concrete5_Library_Controller_Abstract {

	protected $helpers = array();
	protected $sets = array();
	protected $action;
	protected $parameters;

	public function requireAsset() {
		$args = func_get_args();
		$r = ResponseAssetGroup::get();
		call_user_func_array(array($r, 'requireAsset'), $args);
	}

	/** 
	 * Adds an item to the view's header. This item will then be automatically printed out before the <body> section of the page
	 * @param string $item
	 * @return void
	 */

	public function addHeaderItem($item) { 
		$v = View::getInstance();
		$v->addHeaderItem($item);
	}

	/** 
	 * Adds an item to the view's footer. This item will then be automatically printed out before the </body> section of the page
	 * @param string $item
	 * @return void
	 */
	public function addFooterItem($item) { 
		$v = View::getInstance();
		$v->addFooterItem($item);
	}

	public function set($key, $val) {
		$this->sets[$key] = $val;
	}

	public function getSets() {
		return $this->sets;
	}

	public function getHelperObjects() {
		$helpers = array();
		foreach($this->helpers as $handle) {
			$h = Loader::helper($handle);
			$helpers[(str_replace('/','_',$handle))] = $h;
		}		
		return $helpers;
	}

	public function get($key = null, $defaultValue = null) {
		if ($key == null) {
			return $_GET;
		}
		if (isset($this->sets[$key])) {
			return $this->sets[$key];
		}
		return Request::get($key, $defaultValue);
	}

	public function getTask() {
		return $this->getAction();
	}

	public function getAction() {
		return $this->action;
	}

	public function runAction($action, $parameters = array()) {
		$this->action = $action;
		$this->parameters = $parameters;
		if (is_callable(array($this, $action))) {
			return call_user_func_array(array($this, $action), $parameters);
		}
	}

	public function on_start() {}
	public function on_before_render() {}

	/** 
	 * @deprecated
	 */
	public function isPost() {
		return Request::isPost();
	}
	public function post($key = null, $defaultValue = null) {
		return Request::post($key, $defaultValue);
	}
	public function redirect() {
		$args = func_get_args();
		$url = call_user_func_array(array('URL', 'to'), $args);
		Redirect::send(BASE_URL . $url);
	}
	public function runTask($action, $parameters) {
		$this->runAction($action, $parameters);
	}
	public function request($key = null, $defaultValue = null) {
		return Request::request($key, $defaultValue);
	}

}