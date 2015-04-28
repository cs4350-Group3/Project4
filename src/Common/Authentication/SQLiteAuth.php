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
		
		$q = $db->querySingle("SELECT count(*) FROM user WHERE username='$username' AND password='$password'");
		if ($q > 0) {
			$result = $db->querySingle("SELECT fName, lName FROM user WHERE username='$username' AND password='$password'", SQLITE_ASSOC);
			$this->status = ACTIVE;
			$this->lastLogin = time();
			$returnVal = array("boolVal" => TRUE, "body" => $result);
			return json_encode($returnVal);
		}
		$this->status = NON_ACTIVE;
		return  '{"boolVal":FALSE}';
	}
}