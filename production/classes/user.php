<?php

require_once '../production/core/init.php';

class User {
    private $_db,
	        $_data,
            $_sessionName;


    public function __construct($user=null) {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('utente', $fields)) {
			            throw new Exception('Sorry, there was a problem creating your account;');
        }
    }

    public function update($fields = array(), $id = null) {

        if(!$id && $this->isLoggedIn()) {
            $id = $this->data->id;
        }

        if(!$this->_db->update('utente', $id, $fields)) {
            throw new Exception('There was a problem updating');
        }
    }

    public function find($email = null) {
        if($email) {
            $data = $this->_db->get('utente', array('email_utente', '=', $email));

            if($this->_db->count()) {
                $this->_data = $this->_db->first();
                return true;
            }
        }
        return false;
    }

    public function login($email = null, $password = null) {
            $user = $this->find($email);
            if ($user) {

                if ($this->_data->password_utente === $password) {
                 session_start();
	             $_SESSION['email']=$email;
				 $_SESSION['nome']=$this->_data->nome_utente;
				 $_SESSION['cognome']=$this->_data->cognome_utente;
	             $_SESSION['psw']=$psw;
               $_SESSION['id_utente']=$this->_data->id_utente;
                 return true;
            }
        }
        return false;
    }


    public function isLoggedIn() {
        return $this->isLoggedIn;
    }
}
