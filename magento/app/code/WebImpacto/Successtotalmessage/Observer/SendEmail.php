<?php 
namespace WebImpacto\Successtotalmessage\Observer; 

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use WebImpacto\Successtotalmessage\Helper\Email as EmailHelper;

class SendEmail implements ObserverInterface {

    const CONFIG_EMAIL_ENABLED = "webimpacto_successtotalmessage/email/email_enabled";
    
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var EmailHelper
     */
    protected $helper;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        EmailHelper $helper,
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->helper = $helper;
    }

    public function execute(Observer $observer)
    {
        $enabled = $this->scopeConfig->getValue(self::CONFIG_EMAIL_ENABLED, ScopeInterface::SCOPE_STORE);

        $order = $observer->getEvent()->getOrder();
        if ($order && $enabled) {
            $this->helper->sendEmail($order);
        }
    }
}