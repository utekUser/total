<?php
class User_Models_UserUser extends Engine_Model_Abstract {
    protected $_dbTableName = 'User_Models_DbTable_UserUser';
    
    protected $_formTableName = 'User_Form_UserUser';
    
    protected $_orderBy = 'creation_date DESC';
    
    //Получить пользователя по id
    public function getUser($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`id` = ?', $id)
						->where('`isdeleted` = ?', 0);
        $result = $table->fetchRow($select);
        return $result;    
    }
    
    //Получить пользователя по login (должен быть уникальным)
    public function getUserByLogin($login) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`login` = ?', $login)
						->where('`isdeleted` = ?', 0);
        $result = $table->fetchRow($select);
        return $result;    
    }
    
    //Получить пользователя по email (должен быть уникальным)
    public function getUserByEmail($email) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`email` = ?', $email)
						->where('`isdeleted` = ?', 0);
        $result = $table->fetchRow($select);
        return $result;    
    }
    
    //Проверка - менеджер или нет
    public function isManager($user_id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`id` = ?', $user_id)
						->where('`isdeleted` = ?', 0);
//                        echo $select;
        $result = $table->fetchRow($select);
        if ($result['manager']) {
            return true;
        } else {
            return false;
        }
    }
    
    //Выборка менеджера (пока менеджер один)
    public function getManager() {
        $table  = $this->getDbTable();
        $select = $table->select()
                        ->where('manager = ?', 1)
						->where('`isdeleted` = ?', 0)
                        ->limit(1);
        $result = $table->fetchRow($select);
        return $result;
    }
    
    public function getUsers() {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->from($table, array('*', "login"))
						->where('`isdeleted` = ?', 0)
                        ->order('login');
        $result = $table->fetchAll($select);
        return $result; 
    }
	
	public function getUsersByType($type) {
        $table = $this->getDbTable();        
        $select = $table->select()
						->where('`type` = ?', $type)
						->where('`isdeleted` = ?', 0);
        $result = $table->fetchAll($select);
        return $result; 
    }
    
    public function updateProfile($user_id, $email) {
        $table  = $this->getDbTable();
        
        $set = array (
            'email' => $email,
        );
        $select = $table->update($set, array('id = ?' => $user_id));
    }
    
    
    public function saveUser($texts, $id = null) {
        $data = array(
            'login'         => $texts['login']->getValue(),
            'email'         => $texts['email']->getValue(),
            'password'      => $texts['password']->getValue(),
            'salt'          => $texts['salt']->getValue(),
            'type'          => $texts['type']->getValue(),
            'active'        => $texts['active']->getValue(),
            'access'        => $texts['access']->getValue(),
            'creation_date' => date('Y-m-d H:i:s'),
            'timestamp'     => time()
        );
        $this->getDbTable()->insert($data);
    }
    
    //Удалить пользователя
    public function deleteUser($id) {
        /*$registry = Engine_Api::getInstance();
        $db = $registry->getContainer()->db;
        $this->_tablePrefix = $registry->getContainer()->tablePrefix;
        
        $where = $db->quoteInto('`id` = ?', $id);
        $delete = $db->delete($this->_tablePrefix.'user', $where);*/
		$table  = $this->getDbTable();        
        $set = array (
            'isdeleted' => 1,
        );
        $select = $table->update($set, array('id = ?' => $id));
    }
    
    //Активация аккаунта после регистрации
    public function setUserActive($id) {
        $table  = $this->getDbTable();
        
        $set = array (
            'active' => 1,
        );
        $select = $table->update($set, array('id = ?' => $id));
    }
    
    //Установление права доступа для пользователя
    public function setUserAccess($id) {
        $table  = $this->getDbTable();
        $set = array (
            'access' => 1,
        );
        $select = $table->update($set, array('id = ?' => $id));
    }
    
    //Удаление права доступа для пользователя
    public function deleteUserAccess($id) {
        $table  = $this->getDbTable();
        $set = array (
            'access' => 0,
        );
        $select = $table->update($set, array('id = ?' => $id));
    }
    
    
    /**
     * Изменение пароля пользователя
     *
     * @param int $id
     * @param string $password
     * @param string $salt
     */
    public function changePassword($id, $password, $salt) {
        $table  = $this->getDbTable();
        
        $set = array (
            'password' => $password,
            'salt'     => $salt
        );
        $select = $table->update($set, array('id = ?' => $id));
    }
    
    public function getUserWithInfo($user_id) {
        $registry = Engine_Api::getInstance();
        $db = $registry->getContainer()->db;
        $this->_tablePrefix = $registry->getContainer()->tablePrefix;
        
        $select = $db->select()
                    ->from(
                        array('a' => $this->_tablePrefix . 'user'),
                        array('*')
                    )
                    ->joinRight(
                        array('b' => $this->_tablePrefix . 'user_info'),
                        'a.id = b.user_id',
                        array('name')
                    )
                    ->where('a.id = ?', $user_id)
					->where('a.isdeleted = 0')
                    ->limit('1');
        $result = $db->fetchRow($select);
        return $result;
    }
    
    
    
    
  /**
   * Gets an instance of a user
   *
   * @param mixed $identity An id, username, or email
   * @return User_Model_User
   */
  public function getUserNew($identity)
  {
      exit;
    // Identity is already a user!
    if( $identity instanceof User_Model_User ) {
      return $identity;
    }

    // Lookup in index
//    $user = $this->_lookupUser($identity);
//    if( $user instanceof User_Model_User ) {
//      return $user;
//    }
    
    // Create new instance
    $user = $this->_getUser($identity);
    if( null === $user ) {
      $user = new User_Model_User(array());
    } else {
      $this->_indexUser($user);
    }

    return $user;
  }
  
  protected function _getUser($identity)
  {
    if( !$identity ) {
      $user = new User_Model_User(array(
        'table' => Engine_Api::_()->getItemTable('user'),
      ));
    } else if( $identity instanceof User_Model_User ) {
      $user = $identity;
    } else if( is_numeric($identity) ) {
      $user = Engine_Api::_()->getItemTable('user')->find($identity)->current();
    } else if( is_string($identity) && strpos($identity, '@') !== false ) {
      $user = Engine_Api::_()->getItemTable('user')->fetchRow(array(
        'email = ?' => $identity,
      ));
    } else /* if( is_string($identity) ) */ {
      $user = Engine_Api::_()->getItemTable('user')->fetchRow(array(
        'username = ?' => $identity,
      ));
    }

    // Empty user?
    if( null === $user ) {
      return new User_Model_User(array());
    }
    
    return $user;
  }
  
    /**
     * Вернуть список
     *
     * @return unknown
     */
    public function getAll($page = null, $account = null) {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        $account = $http->getParam('account');
        
        
//        $table  = $this->getDbTable();
//        $select = $table->select();
        
        //
        $registry = Engine_Api::getInstance();
        $db = $registry->getContainer()->db;
        $select = $db->select()
                    ->from(
                        array('a' => 'total_user'),
                        array('*')
                      )
                    ->joinLeft(
                        array('b' => 'total_user_info'),
                        'a.id = b.user_id',
                        array('title', 'name')
                      );
		$select->joinLeft(
			array(
				'sm' => 'total_shop_manager'
			),
			'a.manager_id = sm.id',
			array('manager_name')
		);
		$select->where('a.isdeleted = 0');
        if ($account != null) {
			$select->where('type = ?', $account);
		}
        if ($this->_orderBy) {
            $select->order($this->_orderBy);
        }
        
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        
        $paginator = new Engine_Paginator($adapter);
        if ($page != 'all') {
            $paginator->setItemCountPerPage(10);
        } else {
            $paginator->setItemCountPerPage(-1);    
        }
        $paginator->setCurrentPageNumber($page);
        return $paginator;
    }
  
  
    public function getActiveUsers($type = 0) {
        $table  = $this->getDbTable();
        $select = $table->select()
                        ->where('active = 1')
                        ->where('access = 1')
						->where('isdeleted = 0');
                        
        if ($type == 1 || $type == 2) {
            $type = $type - 1;
            $select->where('type = ?', $type);
        }
                        
        $result = $table->fetchAll($select);
        return $result; 
    }

    public function setType($userID, $accountType) {
        $table  = $this->getDbTable();

        $set = array (
            'type' => $accountType,
        );
        $select = $table->update($set, array('id = ?' => $userID));
    }
}