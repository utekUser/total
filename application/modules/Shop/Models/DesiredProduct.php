<?php
class Shop_Models_DesiredProduct extends Engine_Model_Abstract
{
    protected $_dbTableName = 'Shop_Models_DbTable_DesiredProduct';

    public function addProduct($name, $user, $datetime = null)
    {
        $table = $this->getDbTable()->insert(array(
            'name' => $name,
            'user_id' => $user,
            'datetime' => ($datetime ? $datetime : date('Y-m-d H:i:s'))
        ));
    }

    public function getProduct($user)
    {
        $table = $this->getDbTable();

        $select = $table->select()
                        ->where('order_id = 0')
                        ->where('user_id = ?', $user);

        return $table->fetchAll($select);
    }

    public function getProductOrder($user, $order)
    {
        $table = $this->getDbTable();

        $select = $table->select()
            ->where('order_id = ?', $order)
            ->where('user_id = ?', $user);

        return $table->fetchAll($select);
    }

    public function getProductForJson($user)
    {
        $table = $this->getDbTable();

        $select = $table->select()
                        ->from($table, array('id', 'name'))
                        ->where('order_id = 0')
                        ->where('user_id', $user);
        $result = $table->fetchAll($select)->toArray();
        foreach ($result as $key => $val) {
            $result[$key]['name'] = htmlspecialchars($result[$key]['name']);
        }
        return $result;
    }

    public function isOrder($user, $order)
    {
        $this->getDbTable()->update(array('order_id' => $order), array('user_id' => $user, 'order_id = ?' => 0));
    }

    public function deleteProduct($id)
    {
        $table = $this->getDbTable();

        $where = $table->getAdapter()->quoteInto('id = ?', $id);

        $table->delete($where);
    }
}