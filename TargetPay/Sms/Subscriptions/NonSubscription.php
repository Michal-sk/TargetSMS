<?php
/**
 * Non subscription class for TargetPay SMS.
 * 
 * @author Michal Skrzypecki
 */

namespace TargetPay\Sms\Subscriptions;

use TargetPay\Sms\Subscriptions\AbstractSubscription;

class NonSubscription extends AbstractSubscription
{
    /**
     * Set the tariff.
     * @see \TargetPay\Sms\AbstractSubscription::setTariff()
     */
    public function setTariff($int = 0)
    {
        $this->_tariff = $int;
        return $this;
    }
    
    /**
     * Set data for the TargetSMS api.
     * @return \TargetPay\Sms\Subscriptions\NonSubscription
     */
    public function setQuery()
    {
        $this->_query = array(
            'username'      => $this->_username,
            'handle'        => $this->_handle,
            'shortkey'      => $this->_shortKey,
            'shortcode'     => $this->_shortCode,
            'sendto'        => $this->_sendTo,
            'mo_messageid'  => $this->_moMessageId,
            'message'       => $this->_text,
            'tariff'        => $this->_tariff,
            'test'          => $this->test,
        );
    
        return $this;
    }
}