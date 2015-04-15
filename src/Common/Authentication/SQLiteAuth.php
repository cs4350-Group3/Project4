<?php
namespace Common\Authentication;
use sqlite3;
class SQLiteAuth implements IAuthentication
{
	public function authenticate($username = '', $password = '')
	{
		if ($this->username == '') {
			$this->username = $username;
		}
		if ($this->password == '') {
			$this->password = $password;
		}
		$db = new SQLite3('../src/Common/login.db');
		$q = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='user';");
		if ($q === 0){
			$db->exec("CREATE TABLE user (username VARCHAR, password VARCHAR); INSERT INTO user (username, password) VALUES ('joshuakimble','pass');");
        }
		$q = $db->querySingle("SELECT count(*) FROM user WHERE username='$username' AND password='$password'");
		if ($q > 0) {
			$this->status = ACTIVE;
			$this->lastLogin = time();
			return TRUE;
		}
		$this->status = NON_ACTIVE;
		return FALSE;
	}
}