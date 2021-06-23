<?php
class Shop_controllers_IndexController extends Core_Controller_Action_User {
    public function init()
    {
        $this->pageId = $this->_getParam('urlToInt');
        if ($this->pageId) {
            Core_Controller_Action_User::setViewMain('view');
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        }

    }
    
    public function indexAction()
    {
//        echo 123; exit;
    }

    public function desiredAction()
    {
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] != 'xmlhttprequest')) {
            exit;
        }

        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case 'POST': // Create -> Post
                // /catalog/desired/
                $request = $this->getRequest();

                $name = $request->getPost('name');

                $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
                $user = $auth->getIdentity();

                $shop = new Shop_Models_DesiredProduct();
                $shop->addProduct($name, $user);

                header('Content-type: application/json');

                echo json_encode(array('status' => 'ok', 'data' => $shop->getProductForJson($user)));
                break;
            case 'GET': // Read   -> Get
                break;
            case 'PUT': // Update -> Put
                break;
            case 'DELETE': // Delete -> Delete
                $url = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                $desired = $url[3];

                $shop = new Shop_Models_DesiredProduct();
                $shop->deleteProduct($desired);

                header('Content-type: application/json');
                echo json_encode(array('status' => 'ok'));

                break;
        }

        exit;
    }
}