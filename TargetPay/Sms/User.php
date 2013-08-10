<?php 
/**
 * TargetSMS user.
 * 
 * @author Michal Skrzypecki
 */

namespace TargetPay\Sms;

class User
{
    /**
     * Users username.
     * @var unknown
     */
    protected $_username;
    
    /**
     * TargetSMS hash. Not password.
     * See: http://www.targetsms.nl/handle (after log in).
     * @var unknown
     */
    protected $_handle;
    
    /**
     * Set the username.
     * @param string $username
     */
    public function setUsername($username = '')
    {
        $this->_username = $username;
        return $this;
    }
    
    /**
     * Get the username;
     * @return \TargetPay\Sms\unknown
     */
    public function getUsername()
    {
        return $this->_username;
    }
    
    /**
     * Set the users hash.
     * @param string $hash
     */
    public function setHandle($var = '')
    {
        $this->_handle = $var;
        return $this;
    }
    
    /**
     * Get the Handle key.
     * @return \TargetPay\Sms\unknown
     */
    public function getHandle()
    {
        return $this->_handle;
    }
}