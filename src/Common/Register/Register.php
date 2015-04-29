<?php
namespace Common\Register;
use sqlite3;
class Register implements IRegister
{
	public function registerUser($username = '', $email = '', $fName = '', $lName = '', $password = '', $twitter_username = '')
	{
		if ($this->username == '') {
			$this->username = $username;
		}
		if ($this->email == '') {
			$this->email = $email;
		}
		if ($this->fName == '') {
			$this->fName = $fName;
		}
		if ($this->lName == '') {
			$this->lName = $lName;
		}
		if ($this->password == '') {
			$this->password = $password;
		}
		if ($this->twitter_username == '') {
			$this->twitter_username = $twitter_username;
		}
		$db = new SQLite3('../src/Common/login.db');
		$q = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='user';");
		if ($q === 0){
			$db->exec("CREATE TABLE user (username VARCHAR, email VARCHAR, fName VARCHAR, lName VARCHAR, password VARCHAR, twitter_username VARCHAR);");
        }
		$q = $db->querySingle("SELECT count(*) FROM user WHERE username='$username' AND password='$password';");
		if ($q === 0){
			$db->exec("INSERT INTO user (username, email, fName, lName, password, twitter_username) VALUES ('$username', '$email', '$fName', '$lName', '$password', '$twitter_username');");
			return TRUE;
        }
		return FALSE;
	}
}