<?php

namespace WebImpacto\Successtotalmessage\Block;

use Magento\Checkout\Block\Onepage\Success;
use Magento\Framework\View\Element\Template\Context;
use Magento\Checkout\Model\Session; 
use Magento\Sales\Model\Order\Config; 
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use WebImpacto\Successtotalmessage\Helper\Data as CustomHelper;

class Message extends Success
{

    const CONFIG_SUCCESS_MESSAGE = "webimpacto_successtotalmessage/general/success_text";
    
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var CustomHelper
     */
    protected $helper;

    /**
     * Init Constructor
     * @param Context $context
     * @param Session $checkoutSession
     * @param Config $orderConfig
     * @param HttpContext $httpContext
     * @param ScopeConfigInterface $scopeConfig
     * @param CustomHelper $helper
     * @param array $data
     */

    public function __construct(
        Context $context,
        Session $checkoutSession,
        Config $orderConfig,
        HttpContext $httpContext,
        ScopeConfigInterface $scopeConfig,
        CustomHelper $helper,
        array $data = []
    ) {
        parent::__construct($context, $checkoutSession,$orderConfig, $httpContext, $data);
        $this->helper = $helper;
        $this->scopeConfig = $scopeConfig;
    }

    public function getTotalOfCustomerOrders()
    {
        $lastOrder = $this->_checkoutSession->getLastRealOrder();
        $email = $lastOrder->getCustomerEmail();

        return $this->helper->getTotalOfCustomerSpent($email);
    }

    public function getConfigSuccessMessage() : ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_SUCCESS_MESSAGE, ScopeInterface::SCOPE_STORE);
    }
}