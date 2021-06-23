<?php
/**
 * Оптимизация  
 *
 */
class Cms_Controllers_AdminCmsOptimizationController extends Core_Controller_Action_Admin {
    public function indexAction() {
        $request = $this->getRequest();
        
        $model = new Cms_Models_CmsOptimization();
        $data = $model->getOptimization();
        
        $form = new Cms_Form_CmsOptimization();
        
        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($data->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $data = $form->getValues();
                
                
                $model->saveOptimization($data);

                $this->_redirector->gotoUrl('/admin/cms/optimization/?form=edit');   
            }
        }
        
        $this->view->elements = $form->getElements();
        
        $this->view->form = $form;
        
        return true;
        
        $array = array('globaltitle');
        $form = new Cms_Form_CmsOptimization();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Cms_Models_CmsOptimization();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        
        $ttt = new Cms_Models_CmsOptimization();
        $this->view->add = $pageId = $this->_getParam('module');
        $this->view->paginator = $ttt->getAll();
    }
}