<?php

/**
 * Classe de controle da tabela users no banco de dados
 */
class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'users';

    public function get( $id )
    {
    	$id = (int)$id;
    	$row = $this->fetchRow('id = ' . $id);
    	if(!$row){
    		throw new Exception("Não foi possível encontrar a linha $id");
    	}
    	return $row->toArray();
    }


    /**
     * Seleciona usuário por id que esteja ativo
     * @param int $id
     */
    public function getActive( $id )
    {
        $row = $this->fetchRow(
            "id = {$id} and status = '1'"
        );
    	
    	return $row;
    }

   /**
    * Salva/atualiza usuário
    * @return int $id
    */
    public function save($filePath = null)
    {
    	$front = Zend_Controller_Front::getInstance();
        $request = $front->getRequest();
        $data = array(
            'name'                  => $request->getPost('name'),
            'lastname'	            => $request->getPost('lastname'),	
            'email'		            => $request->getPost('email'),
            'address_street'        => $request->getPost('address_street'),			
            'address_number'		=> $request->getPost('address_number'),	
            'address_complement'    => $request->getPost('address_complement'),			
            'address_district'      => $request->getPost('address_district'),			
            'address_city'          => $request->getPost('address_city'),		
            'address_state'         => $request->getPost('address_state'),			
            'status'                => $request->getPost('status'),			
            'observations'          => $request->getPost('observations'),			
            'file_address'          => $filePath,
        );
        if(!$request->getParam("id")){
            $id = $this->insert($data);
            return $id;
        }else{
            $where = array('id = ?' => $request->getParam("id"));
            $this->update($data, $where);
        }
    }
    
    /**
     * Deleta usuário
     */
    public function deleteUser()
    {
    	$front = Zend_Controller_Front::getInstance();
        $request = $front->getRequest();
        $where = array('id = ?' => $request->getParam("id"));
        $this->delete($where);
    }
}