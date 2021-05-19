<?php
/**
 * Controller tela de usuários
 */
class UserController extends Zend_Controller_Action
{
    public function init()
    {

    }

    public function indexAction()
    {
        $userModel = new Application_Model_DbTable_User(); 
        $this->view->users = $userModel->fetchAll();
    }

    public function addAction()
    {
        $userForm = new Application_Form_UserForm();
        $request = $this->getRequest();
        if ( $request->isPost() ) {
            if ($userForm->isValid($request->getPost())) {
                //upload de arquivo
                if (!$userForm->files->receive()) {
                    throw new Zend_File_Transfer_Exception('Reciving files failed');
                }               

                if(!empty($uploadedFilesPaths)) {
                    $filePath = 'uploads/' . $form->files->getFileInfo()['files']['name'];
                }              

                //Salva formulário
                $userModel = new Application_Model_DbTable_User();
                $idUser = $userModel->save($filePath);

                //RegistraLog
                $data = array( 
                    'action'        => 'Inserção no cadastro',
                    'date_action'   => date('Y-m-d H:i:s'),
                    'id_user'       => $idUser
                );

                $userHistoryLogModel =  new Application_Model_DbTable_UserHistoryLog();
                $userHistoryLogModel->save($data);

                $this->_helper->redirector('index');
            }
        }
        $this->view->form = $userForm;
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $userModel = new Application_Model_DbTable_User();
        $userHistoryLogModel =  new Application_Model_DbTable_UserHistoryLog();
        $user = $userModel->fetchRow('id = '.$id);
        $userHistoryLog = $userHistoryLogModel->fetchAll('id_user = '.$id);
        $form = new Application_Form_UserForm();
        if ($request->isPost()) {
            //upload de arquivo
            if (!$form->files->receive()) {
                throw new Zend_File_Transfer_Exception('Reciving files failed');
            }
            
            if(!empty($uploadedFilesPaths)) {
                $filePath = 'uploads/' . $form->files->getFileInfo()['files']['name'];
            }              

            //Atualiza Cadastro
            $userModel->save($filePath);
            
            //RegistraLog
            $data = array( 
                'action'        => 'Atualização de cadastro',
                'date_action'   => date('Y-m-d H:i:s'),
                'id_user'       => $id
            );
            
            $userHistoryLogModel->save($data);
            
            $this->redirect('user');
        }else{
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $user = new Application_Model_DbTable_User();
                $form->populate( $user->get($id) );
                $this->view->history = $userHistoryLog;
                $this->view->form = $form;
            }
        }
    }

    public function deleteAction()
    {
        $userModel = new Application_Model_DbTable_User();
        $userModel->deleteUser();
        $this->redirect('user');
    }

    public function restAction()
    {
		$server = new Zend_Rest_Server();
		$server->setClass('UsersRestAPI');
		$server->handle();
	
		exit;
    }
}

class UsersRestAPI
{
	/**
	* Write to a file
	*
	* @param string $string
	* @return string Some return message
	*/
 
	public function getUser($id)
	{
		$userModel = new Application_Model_DbTable_User();
        $user = $userModel->getActive($id);;

        $message['name']                 = $user->name;
        $message['lastname']             = $user->lastname;
        $message['email']                = $user->email;
        $message['address_street']       = $user->address_street;
        $message['address_number']       = $user->address_number;
        $message['address_complement']   = $user->address_complement;
        $message['address_district']     = $user->address_district;
        $message['address_city']         = $user->address_city;
        $message['address_state']        = $user->address_state;
        $message['status']               = !$user->status ? 'Inativo' : 'Ativo';
        $message['observation']          = $user->address_state;
        $message['file_address']         = !$user->file_address ? 'Imagem não enviada' : '';

        return $message;
	}

    public function listUsers()
	{
        $usersModel = new Application_Model_DbTable_User();
        $users = $usersModel->fetchAll("status = true");

        foreach($users as $user){
            $message[$user->id]['id']                   = $user->id;
            $message[$user->id]['name']                 = $user->name;
            $message[$user->id]['lastname']             = $user->lastname;
            $message[$user->id]['email']                = $user->email;
            $message[$user->id]['address_street']       = $user->address_street;
            $message[$user->id]['address_number']       = $user->address_number;
            $message[$user->id]['address_complement']   = $user->address_complement;
            $message[$user->id]['address_district']     = $user->address_district;
            $message[$user->id]['address_city']         = $user->address_city;
            $message[$user->id]['address_state']        = $user->address_state;
            $message[$user->id]['status']               = !$user->status ? 'Inativo' : 'Ativo';
            $message[$user->id]['observation']          = $user->address_state;
            $message[$user->id]['file_address']         = !$user->file_address ? 'Imagem não enviada' : '';
        }

		return $message;
	}
}