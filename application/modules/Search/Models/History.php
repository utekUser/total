<?php
class Search_Models_History extends Engine_Model_Abstract
{
    protected $_dbTableName = 'Search_Models_DbTable_History';

    public function saveRequest($datetime, $search, $type, $count = 0, $user = 0)
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
 
        $data = array(
            'datetime'   => $datetime,
            'search' => $search,
            'type' => $type,
            'count' => ($count ? $count : 0),
            'user' => ($user ? $user : 0),
            'IP' => $ip
        );
//print_r($data);
        $this->getDbTable()->insert($data);
    }
}