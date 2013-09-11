TargetSMS
=========

Communicate with the TargetSMS api
 * http://www.targetsms.com
 * http://www.targetpay.com
 
Usage
=========
Start with including all the required classes. Basic concept of this is:
```php
require_once 'TargetPay/Sms/TargetSms.php';
require_once 'TargetPay/Sms/User.php';
require_once 'TargetPay/Sms/Handler/AbstractHandler.php';
require_once 'TargetPay/Sms/Handler/NonSubscription.php';
require_once 'TargetPay/Sms/Subscriptions/AbstractSubscription.php';
require_once 'TargetPay/Sms/Subscriptions/NonSubscription.php';
```
If you use an autloader this would be not neccesary.

Declare the namespaces
```php
use TargetPay\Sms;
use TargetPay\Sms\Subscriptions;
use TargetPay\Sms\Handler;
```

Initiate a new TargetSms object. This allowes you to check if the request is
comming from TargetSMS. You can also add custom ip-addresses to the Allowed ip's.
Print the 45000 response code so that TargetSMS knows that everything is ok.
```php
$targetSms = new Sms\TargetSms();
$targetSms->addAllowedIp($_SERVER['REMOTE_ADDR']);

if (! $targetSms->isAllowedIp($_SERVER['REMOTE_ADDR'])) {
    //Only trust TargetSMS.
    die;
}
//Print response code 45000 so TargetPay knows everything is ok.
print $targetSms->getResponseCode();
```

Iniate a Receiver. This should be data from the $_GET. Always clean the data before it's passed
to the object. This has been omitted in the example.
```php
/**
* $_GET['MO_MessageId'],
* $_GET['ShortCode'],
* $_GET['MO_ShortKey'],
* $_GET['Message'],
* $_GET['SendTo'],
* $_GET['operator']
*/
$handler = new Handler\NonSubscription($_GET);
```

Iniate a User. Set your username and your handle key. The key can be found at:
http://www.targetsms.nl/handle. You must be loggedin to get it.
```php
$user = new Sms\User('USERNAME', 'HANDLE KEY');
```

Initiate Subscription. The Subscription object needs the following to instances:
* Handler   instance of TargetPay\Sms\Handler\AbstractHandler
* User      instance of TargetPay\Sms\User

The Subscription object needs to have:
* Tariff, the amount which is going to be billed in cents in your currency.
* Text, the text message which will be send to the customer.

```php
$nonSubscription = new Subscriptions\NonSubscription(
    $handler,
    $user
    25,
    'Thank you message'
);

$nonSubscription
    ->setQuery()
    ->setApiUrl()
    ->init();

$nonSubscriptionResponse = $nonSubscription->getResponse();

if (isset($nonSubscriptionResponse)
    && $errorMessage = $nonSubscription->getErrorMessage($nonSubscriptionResponse)
) {
    print '<hr>';
    print $nonSubscriptionResponse . ' : ' . $errorMessage;
    die;
}
```