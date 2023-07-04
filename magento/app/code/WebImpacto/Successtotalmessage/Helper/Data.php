<?php
namespace  WebImpacto\Successtotalmessage\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Pricing\Helper\Data as PricingHelper;

class Data extends AbstractHelper
{

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var PricingHelper
     */
    protected $pricingHelper;

    /**
     * @var Collection
     */
    protected $orderCollectionFactory;

    /**
     * Init Constructor
     * @param Context $context
     * @param CollectionFactory $orderCollectionFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param PricingHelper $pricingHelper
     * @param array $data
     */

    public function __construct(
        Context $context,
        CollectionFactory $orderCollectionFactory,
        ScopeConfigInterface $scopeConfig,
        PricingHelper $pricingHelper
    ) {
        parent::__construct($context);
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->scopeConfig = $scopeConfig;
        $this->pricingHelper = $pricingHelper;
    }

    public function getTotalOfCustomerSpent($email)
    {
        $customerOrders = $this->orderCollectionFactory->create()->addAttributeToFilter('customer_email', $email)->addAttributeToFilter('status',['neq'=>'canceled'])->load();
        $orderList = $customerOrders->getData();

        $customerTotal = 0;

        foreach($orderList as $orderItem) {
            $customerTotal += $orderItem['grand_total'];
        }

        return $this->pricingHelper->currency($customerTotal, true, false);
    }
}