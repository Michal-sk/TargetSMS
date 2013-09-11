<?php
/**
 * NonSubscription handler for TargetSMS
 */

namespace TargetPay\Sms\Handler;

class NonSubscription extends AbstractHandler
{
    public function __construct($data)
    {
        $this->_moMessageId = $data['moMessageId'];
        $this->_message     = $data['message'];
        $this->_shortCode   = $data['shortCode'];
        $this->_moShortKey  = $data['moShortKey'];
        $this->_sendTo      = $data['sendTo'];
        $this->_operator    = $data['operator'];
    }
}