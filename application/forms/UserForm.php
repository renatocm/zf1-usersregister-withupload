<?php

/**
 * Classe para criação do formulário
 */
class Application_Form_UserForm extends Zend_Form {
 
    public function init() {
        $this->addElement('hidden', 'id');
        $this->addElement
        (
            'text', 
            'name', 
            array(
                'class' => 'form-control',
                'label' => 'Nome:',
                'required' => true
            )
        );

        $this->addElement
        (
            'text', 
            'lastname', 
            array(
                'class' => 'form-control',
                'label' => 'Sobrenome:',
                'required' => true
            )
        );

        $this->addElement
        (
            'text', 
            'email', 
            array(
                'class' => 'form-control',
                'label' => 'E-mail:',
            )
        );

        $this->addElement
        (
            'text', 
            'address_street', 
            array(
                'class' => 'form-control',
                'label' => 'Rua/Av.:',
            )
        );

        $this->addElement
        (
            'text', 
            'address_number', 
            array(
                'class' => 'form-control',
                'label' => 'Número:',
            )
        );

        $this->addElement
        (
            'text', 
            'address_complement', 
            array(
                'class' => 'form-control',
                'label' => 'Complemento:',
            )
        );

        $this->addElement
        (
            'text', 
            'address_district', 
            array(
                'class' => 'form-control',
                'label' => 'Bairro:',
            )
        );

        $this->addElement
        (
            'text', 
            'address_city', 
            array(
                'class' => 'form-control',
                'label' => 'Cidade:',
            )
        );

        $this->addElement
        (
            'text', 
            'address_state', 
            array(
                'class' => 'form-control',
                'label' => 'Estado:',
            )
        );

        $this->addElement
        (
            'checkbox', 
            'status', 
            array(
                'label' => 'Status:',
            )
        );

        $this->addElement
        (
            'textarea', 
            'observations', 
            array(
                'class' => 'form-control',
                'label' => 'Observações:',
                'rows'   => '5'
            )
        );

        $files = new Zend_Form_Element_File('files');                      
        $files->setDestination(UPLOAD_PATH);     
        $files->setMultiFile(1);
        
        // set this flag for manual reception of uploaded files
        $files->setValueDisabled(true);
        
        $this->addElements(array($files));

        $this->addElement('submit','submit',array('label' => 'Salvar'));
        
    }
 
}