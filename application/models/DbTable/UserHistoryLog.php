<?php

/**
 * Classe de controle da tabela users_history_log no banco de dados
 */
class Application_Model_DbTable_UserHistoryLog extends Zend_Db_Table_Abstract
{
    protected $_name = 'users_history_log';


    public function save( $data )
    {
        $this->insert( $data );
    }
    
   
}