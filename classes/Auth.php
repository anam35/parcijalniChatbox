<?php
namespace Auth;

class Auth {
	public function UserIsAuthentic(){
		if(isset($_SESSION["authenticated"])){
			return $_SESSION["authenticated"];
		}else{
			return false;
		}
	}

	public function getInputs(){
		return "<form method='post'>Username: <input type='text' name='username'><br /><input type='submit' name='posalji_username' value='Login!'></form>";
	}
}
