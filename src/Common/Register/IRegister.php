<?php
/**
 * File name: IAuthentication.php
 *
 * Project: Project1
 *
 * PHP version 5
 *
 * $LastChangedDate$
 * $LastChangedBy$
 */
namespace Common\Register;
interface IRegister
{
    /**
     * Function authenticate
     *
     * @param string $username
     * @param string $password
     * @return mixed
     *
     * @access public
     */
    public function registerUser($username, $email, $fName, $lName, $password, $twitter_username);
}