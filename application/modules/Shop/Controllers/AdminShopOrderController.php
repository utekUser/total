<?php
class Shop_Controllers_AdminShopOrderController extends Core_Controller_Action_Admin {
    /**
     * Редиректор - определен для полноты кода
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;
    
    protected $_form = array(
        'Shop_Form_ShopOrder'
    ); 
    
    /**
     * �?нициализация
     *
     */
    public function init() {
        $this->_redirector = $this->_helper->getHelper('Redirector');
        
        if (isset($_GET['order']) && intval($_GET['order'])) {
            Engine_Controller_Action::setViewMain('view');
            Engine_Controller_Action::setDefaultParseUrlAction('view');
        }
    }
   
    /**
     * Главная, листинг
     *
     */
    public function indexAction() {
        $ttt = new Shop_Models_OrderOrder();
        
        if (isset($_GET['deactive']) && intval($_GET['deactive'])) {
            $ttt->deactivateOrder(intval($_GET['deactive']));
            $this->_redirect('/admin/shop/order/');
        }
        
        $ttt = new Shop_Models_OrderOrder();
        $this->view->paginator = $ttt->getOrder();
        
        $status = array();
        $table = new Shop_Models_OrderStatus();
        $select = $table->getStatus();
        foreach ($select as $value){
            $status[$value->id]['name'] = $value->name;
            $status[$value->id]['code'] = $value->code;
        }
        $this->view->statusList = $status;
        
        $form = new Shop_Form_Order();
        $this->view->delivery = $form->delivery_type->getMultiOptions();
        $this->view->payment  = $form->payment_type->getMultiOptions();
    }
    
        
    public function viewAction() {
        $request = $this->getRequest();
        
        if ($request->getQuery('order') && intval($request->getQuery('order'))) {
            $orderId = $request->getQuery('order');
            $model = new Shop_Models_OrderOrder();
            
            if ($request->getQuery('action') == 'change_status') {
                $status_id = $request->getQuery('status_list');
                $date = date('Y-m-d H:i:s');
                $model->updateStatus($orderId, $status_id, $date);
                $this->_redirect('/admin/shop/order/?order=' . $orderId);
            }
            if ($request->getQuery('action') == 'change_cancel') {
                $rejected = $request->getQuery('rejected');
                $rejection_reason = $request->getQuery('rejection_reason');
                $date = date('Y-m-d H:i:s');
                $model->changeCancel($orderId, $rejection_reason, $date, $rejected);
                $this->_redirect('/admin/shop/order/?order=' . $orderId);
            }
            if ($request->getQuery('action') == 'change_pay') {
                $payment      = $request->getQuery('payment');
                
                $payment_doc  = $request->getQuery('payment_doc');
                $payment_doc_date  = $request->getQuery('payment_doc_date');
                
                $total_sum    = $request->getQuery('total_sum');
                $date         = date('Y-m-d H:i:s');
                
                $modelTransaction = new Shop_Models_OrderTransaction();
                $modelTransaction->addTransaction($orderId, $date, $total_sum, $payment);
                
                $model->changePayment($orderId, $date, $payment_doc, $payment_doc_date, $payment);
                $this->_redirect('/admin/shop/order/?order=' . $orderId);
            }

            
            $rrr = $model->getRecord($orderId);
    
            $form = new Shop_Form_Order();
    
            foreach ($form->getElements() as $value) {
                $nnn = $value->getName();
                $value->setValue($rrr->$nnn);
            }
            
            $this->view->orderId = $orderId;
            $this->view->elements = $form->getElements();
            $orderItems = new Shop_Models_OrderComposition();
            $this->view->items = $orderItems->getOrderComposition($orderId);
            
            $status = array();
            $table = new Shop_Models_OrderStatus();
            $select = $table->getStatus();
            foreach ($select as $value){
                $status[$value->id]['name'] = $value->name;
                $status[$value->id]['code'] = $value->code;
            }
            $this->view->statusList = $status;
            
            
            $transaction = new Shop_Models_OrderTransaction();
            $this->view->transactions = $transaction->getOrderTransactions($orderId);

            $user = new User_Models_UserUser();
            $user = $user->getUserByLogin($rrr->customer_login);
            $desired = new Shop_Models_DesiredProduct();
            $this->view->desired = $desired->getProductOrder($user['id'], $orderId);
        }
    }
}