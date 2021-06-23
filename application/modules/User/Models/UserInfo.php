<?php
class User_Models_UserInfo extends Engine_Model_Abstract {
    protected $_dbTableName = 'User_Models_DbTable_UserInfo';
    
    protected $_formTableName = 'User_Form_UserInfo';
    
    /**
     * Регистрация физического лица
     *
     * @param unknown_type $texts
     * @param unknown_type $id
     */
    public function saveInfoFiz($texts, $id = null) {
        $data = array(
            'user_id'      => $texts['user_id']->getValue(),
            'name'         => $texts['name']->getValue(),
            'address'      => $texts['address']->getValue(),
            'phone'        => $texts['phone']->getValue(),
            'info'         => $texts['info']->getValue(),
            'price_type'   => 0
        );
        $this->getDbTable()->insert($data);
    }
    
    /**
     * Регистрация юридического лица
     *
     * @param unknown_type $texts
     * @param unknown_type $id
     */
    public function saveInfoUr($texts, $id = null) {
        $data = array(
            'user_id'      => $texts['user_id']->getValue(),
            'name'         => $texts['name']->getValue(),
            'phone'         => $texts['phone']->getValue(),
            'info'         => $texts['info']->getValue(),
            'title'        => $texts['title']->getValue(),
            'ur_address'   => $texts['ur_address']->getValue(),
            'fact_address' => $texts['fact_address']->getValue(),
            'ogrn'         => $texts['ogrn']->getValue(),
            'inn'          => $texts['inn']->getValue(),
            'bank'         => $texts['bank']->getValue(),
            'kpp'          => $texts['kpp']->getValue(),
            'rs'           => $texts['rs']->getValue(),
            'ks'           => $texts['ks']->getValue(),
            'bik'          => $texts['bik']->getValue(),
            'okpo'         => $texts['okpo']->getValue(),
            'price_type'   => 1
        );
        $this->getDbTable()->insert($data);
    }
    
    /**
     * Получить информацию из аккаунта пользователя по id
     *
     * @param int $id
     * @return unknown
     */
    public function getUserInfo($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`user_id` = ?', $id);
        $result = $table->fetchRow($select);
        return $result;    
    }
    
    /**
     * Обновить информацию в профиле пользователя
     *
     * @param int $user_id
     * @param array $texts
     */
    public function updateProfile($user_id, $texts, $user_type) {
//        echo "<pre>";
//        print_r($texts);
//        exit;
//        echo $user_type; exit;
        if ($user_type) {
            $this->updateProfileUr($user_id, $texts);
        } else {
            $this->updateProfileFiz($user_id, $texts);
        }
//        $table  = $this->getDbTable();
//        
//        $date = array(
//            'name'    => $texts['name']->getValue(),
//            'address' => $texts['address']->getValue(),
//            'phone'   => $texts['phone']->getValue(),
//            'info'    => $texts['info']->getValue()
//        );
//        echo 'id=' . $user_id;
//        echo '<pre>'; print_r($date); echo '</pre>'; exit;
//        $select = $table->update($date, array('user_id = ?' => $user_id));
//        echo $select; exit;
    }
    
    public function updateProfileFiz($user_id, $texts) {
        $table  = $this->getDbTable();
        
        $date = array(
            'name'    => $texts['name']->getValue(),
            'address' => $texts['address']->getValue(),
            'phone'   => $texts['phone']->getValue(),
            'info'    => $texts['info']->getValue()
        );
        $select = $table->update($date, array('user_id = ?' => $user_id));
    }
    
    public function updateProfileUr($user_id, $texts) {
        $table  = $this->getDbTable();
        
        $date = array(
            'name'         => $texts['name']->getValue(),
            'phone'        => $texts['phone']->getValue(),
            'info'         => $texts['info']->getValue(),
            'title'        => $texts['title']->getValue(),
            'ur_address'   => $texts['ur_address']->getValue(),
            'fact_address' => $texts['fact_address']->getValue(),
            'ogrn'         => $texts['ogrn']->getValue(),
            'inn'          => $texts['inn']->getValue(),
            'bank'         => $texts['bank']->getValue(),
            'kpp'          => $texts['kpp']->getValue(),
            'rs'           => $texts['rs']->getValue(),
            'ks'           => $texts['ks']->getValue(),
            'bik'          => $texts['bik']->getValue(),
            'okpo'         => $texts['okpo']->getValue(),
//            'price_type'   => 3
        );
        $select = $table->update($date, array('user_id = ?' => $user_id));
    }

    public function setPriceType($userID, $accountType) {
        $table  = $this->getDbTable();

        $set = array (
            'price_type' => $accountType,
        );
        $select = $table->update($set, array('id = ?' => $userID));
    }

    public function deleteUserInfo($id)
    {
        $table  = $this->getDbTable();
        $where = $table->getAdapter()->quoteInto('user_id = ?', $id);


        $table->delete($where);
    }
}