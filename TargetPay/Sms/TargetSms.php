<?php
/**
 * TargetSMS object with TargetSMS related methods.
 */

namespace TargetPay\Sms;

class TargetSms
{
    /**
     * The allowed IP of TargetSms.
     * @var array
     */
    protected $_targetSmsIp = array('89.184.168.65');
    
    /**
     * The ok response code for TargetSMS.
     * @var number
     */
    protected $_responseCode = 45000;
    
    /**
     * Check if the request is comming from TargetSMS.
     * @param string $ip
     * @return boolean
     */
    public function isAllowedIp($ip = '')
    {
        if (in_array($ip, $this->_targetSmsIp)) {
            return true;
        }
        return false;
    }
    
    /**
     * Get the TargetSMS required responsecode.
     * @return number
     */
    public function getResponseCode()
    {
        return $this->_responseCode;
    }
    
    /**
     * Add a new allowed ip address to the array with allowed ip addresses.
     * @param string $ip
     */
    public function addAllowedIp($ip = '')
    {
        $this->_targetSmsIp[] = $ip;
    }
}