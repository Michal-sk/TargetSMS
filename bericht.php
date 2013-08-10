<?php
/**
 * This file needs a lot of cleaning up, not required a.t.m tough.
 */

require_once 'TargetPay/Sms/Receiver.php';
require_once 'TargetPay/Sms/User.php';
require_once 'TargetPay/Sms/Subscriptions/AbstractSubscription.php';
require_once 'TargetPay/Sms/Subscriptions/NonSubscription.php';

use TargetPay\Sms;
use TargetPay\Sms\Subscriptions;

function doLog($filename, $str) {
    $fd = fopen($filename, 'a');
    // write string
    fwrite($fd, $str . "\n");
    // close file
    fclose($fd);
}

/**
 * Receiver instance.
 */
$receiver = new Sms\Receiver();

if (! $receiver->isTargetSmsIp()) {
    //Only trust TargetSMS.
    die;
}

/**
 * Return the receiver response code, so TargetSMS knows everything is ok.
 */
print $receiver->getResponseCode();

$receiver->setMoMessageId($_GET['MO_MessageId'])
         ->setShortCode($_GET['ShortCode'])
         ->setMoShortKey($_GET['MO_ShortKey'])
         ->setMessage($_GET['Message'])
         ->setSendTo($_GET['SendTo'])
         ->setOperator($_GET['operator']);

/**
 * User instance.
 * Set the username and your handle key.
 */
$user = new Sms\User();
$user->setUsername('your username')
     ->setHandle('your hash');

/**
 * NonSubscription instance.
 * Set the tariff in cents in your currency.
 */
$nonSubscription = new Subscriptions\NonSubscription($receiver, $user);

$nonSubscription->setTariff(25)
                ->setText('Uw inzending is ontvangen.')
                ->setQuery()
                ->init();

$nonSubscriptionResponse = $nonSubscription->getResponse();

if (isset($nonSubscriptionResponse)
    && $errorMessage = $nonSubscription->getErrorMessage($nonSubscriptionResponse)
) {
    print '<br>' . $nonSubscriptionResponse . ' ' . $errorMessage;

    doLog('nonSubscripionStatus.txt', $nonSubscriptionResponse . ' ' . $errorMessage);
    die;
}