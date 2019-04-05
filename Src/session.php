<?php

class Session extends Controller {
    
    public static $authentificate = [];

    public function __construct($params = NULL) {
        session_start();
        self::init($params);
        self::$authentificate = array ('id' =>  $this->getValue('id', $_SESSION),
                                'userGroup' => $this->getValue('userGroup', $_SESSION),
                                'status' => $this->getValue('status', $_SESSION),
                                'username' =>  $this->getValue('name', $_SESSION),
                                'email' =>  $this->getValue('email', $_SESSION));
    }
    
    private function getValue($value, $sess_or_cookie){
      if (isset($sess_or_cookie[$value]))
        return $sess_or_cookie[$value];
      return NULL;
    }
    public static function init($params) {
        if (isset($_COOKIE["user"])) {
          $_SESSION['id'] = $_COOKIE['id'];
          $_SESSION["userGroup"] = $params['userGroup'];
          $_SESSION["status"] = $params['status'];
          $_SESSION['name'] = $_COOKIE['name'];
          $_SESSION['email'] = $_COOKIE['email'];
        }
        else if ($params != NULL){
          $_SESSION["id"] = $params['id'];
          $_SESSION["userGroup"] = $params['userGroup'];
          $_SESSION["status"] = $params['status'];
          $_SESSION["username"] = $params['username'];
          $_SESSION["email"] = $params['email'];
        }
    }
    public static function set_cookie($params) {
      setcookie('id', $params['id'], time()+3600);
      setcookie('userGroup', $params['userGroup'], time()+3600);
      setcookie('status', $params['status'], time()+3600);
      setcookie('username', $params['username'], time()+3600);
      setcookie('email', $params['email'], time()+3600);
    }
    public static function destroy() {
      if (isset($_COOKIE)) {
    		unset($_COOKIE["id"]);
        unset($_COOKIE["userGroup"]);
        unset($_COOKIE["username"]);
        unset($_COOKIE["email"]);
        setcookie('id', NULL, time()-3600);
        setcookie('userGroup', NULL, time()-3600);
        setcookie('username', NULL, time()-3600);
        setcookie('email', NULL, time()-3600);
      }
        session_start();
        session_unset();
        session_destroy();
        Controller::redirect(['login','index']);
    }
}