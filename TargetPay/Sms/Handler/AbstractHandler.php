<?php 
/**
 * Receiver class for TargetPay SMS.
 * 
 * Documentation can be found @ http://www.targetsms.nl/docs/TS001-NonSubscription.pdf.
 * Documentation can be found @ http://www.targetsms.nl/docs/TS002-Subscription.pdf.
 * 
 * The SMS gateway expects a responsecode of 45000.
 * 
 * @author Michal Skrzypecki
 */

namespace TargetPay\Sms\Handler;

class AbstractHandler
{
    
/******************** VARIABLES ********************/
    
    /**
     * Unique message ID.
     * The ID of the incoming SMS message.
     * @var number
     */
    protected $_moMessageId;
    
    /**
     * Shortcode.
     * The shortcode the message was sent to.
     * @var number
     */
    protected $_shortCode;
    
    /**
     * Keyword.
     * The keyword of the service.
     * @var varchar
     */
    protected $_moShortKey;
    
    /**
     * Complete message.
     * The full message text. Do not rely on this value to determine the keyword.
     * Use $_moShortKey instead.
     * @var varchar
     */
    protected $_message;
    
    /**
     * End-user phone number.
     * End-users phone number in international format. 
     * @var number
     */
    protected $_sendTo;
    
    /**
     * Operator ID.
     * ID of the mobile operator. See http://www.targetsms.nl/operators for a list.
     * @var varchar
     */
    protected $_operator;
    
    /**
     * Switch the subscription on or off.
     * Possible values on, ok, off, rejoin.
     * @var varchar
     */    
    protected $_onoff;
    
/******************** METHODS ********************/
    
    /**
     * Set moMessageId.
     * @param number $int
     * @return \TargetPay\Sms\Reciever
     */
    public function setMoMessageId($int = 0)
    {
        $this->_moMessageId = $int;
        return $this;
    }
    
    /**
     * Get moMessageId.
     * @return number
     */
    public function getMoMessageId()
    {
        return $this->_moMessageId;
    }
    
    /**
     * Set shortCode.
     * @param number $int
     * @return \TargetPay\Sms\Reciever
     */
    public function setShortCode($int = 0)
    {
        $this->_shortCode = $int;
        return $this;
    }
    
    /**
     * Get shortCode.
     * @return number
     */
    public function getShortCode()
    {
        return $this->_shortCode;
    }
    
    /**
     * Set shortKey.
     * @param number $int
     * @return \TargetPay\Sms\Reciever
     */
    public function setMoShortKey($int = 0)
    {
        $this->_moShortKey = $int;
        return $this;
    }
    
    /**
     * Get shortKey.
     * @return number
     */
    public function getMoShortKey()
    {
        return $this->_moShortKey;
    }
    
    /**
     * Set message.
     * @param string $msg
     * @return \TargetPay\Sms\Reciever
     */
    public function setMessage($msg = '')
    {
        $this->_message = $msg;
        return $this;
    }
    
    /**
     * Get the message.
     * Option to remove the shortkey from the message. TargetSMS api sends the complete
     * message with the shortkey in it.
     * @param string $removeShortKey
     * @return \TargetPay\Sms\varchar
     */
    public function getMessage($removeShortKey = true)
    {
        $msg = $this->_message;
        
        if ($removeShortKey) {
            $msg = preg_replace('|' . $this->_moShortKey . '|i', '', $msg);
        }
        
        return $msg;
    }
    
    /**
     * Set sendTo.
     * @param number $int
     * @return \TargetPay\Sms\Reciever
     */
    public function setSendTo($int)
    {
        $this->_sendTo = $int;
        return $this;
    }
    
    /**
     * Get sendTo.
     * @return number
     */
    public function getSendTo()
    {
        return $this->_sendTo;
    }
    
    /**
     * Set operator.
     * @param number $int
     * @return number
     */
    public function setOperator($int)
    {
        $this->_operator = $int;
        return $this;
    }
    
    /**
     * Get operator.
     * @return number
     */
    public function getOperator()
    {
        return $this->_operator;
    }
    
    /**
     * Object to string.
     * Alle the object variables will be send to string.
     * @return string
     */
    public function __toString()
    {
        $vars = get_object_vars($this);
        $str  = '';
        
        foreach ($vars as $var => $val) {
            $str .= $var .' : '. $val . PHP_EOL;
        }
        
        return $str;
    }
}