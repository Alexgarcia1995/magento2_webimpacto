<?php
namespace  WebImpacto\Successtotalmessage\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use WebImpacto\Successtotalmessage\Helper\Data as CustomHelper;

class Email extends AbstractHelper
{

    const CONFIG_EMAIL_TEMPLATE = "webimpacto_successtotalmessage/email/email_template";

    /**
     * @var StateInterface
     */
    protected $inlineTranslation;

    /**
     * @var Escaper
     */
    protected $escaper;

    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    protected $logger;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
    * @var CustomHelper
    */
   protected $helper;

    /**
     * Init Constructor
     * @param Context $context
     * @param StateInterface $inlineTranslation
     * @param Escaper $escaper
     * @param TransportBuilder $transportBuilder
     * @param CollectionFactory $orderCollectionFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param CustomHelper $helper
     * @param array $data
     */

    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        CustomHelper $helper,
    ) {
        parent::__construct($context);
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $context->getLogger();
        $this->scopeConfig = $scopeConfig;
        $this->helper = $helper;
        $this->storeManager = $storeManager;
    }

    public function sendEmail($order)
    {
        $customerEmail = $order->getCustomerEmail();
        $customerName = $order->getCustomerName();
        $customerTotalSpent = $this->helper->getTotalOfCustomerSpent($customerEmail);        
        $emailTemplate = $this->scopeConfig->getValue(self::CONFIG_EMAIL_TEMPLATE, ScopeInterface::SCOPE_STORE);
        $storeId = $this->storeManager->getStore()->getId();

        try {
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->scopeConfig->getValue('trans_email/ident_support/name', ScopeInterface::SCOPE_STORE),
                'email' => $this->scopeConfig->getValue('trans_email/ident_support/email', ScopeInterface::SCOPE_STORE),
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier($emailTemplate)
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => $storeId,
                    ]
                )
                ->setTemplateVars([
                    'totalSpent'  => $customerTotalSpent,
                    'customerName' => $customerName
                ])
                ->setFrom($sender)
                ->addTo($customerEmail)
                ->getTransport();

            $transport->sendMessage();
            $this->inlineTranslation->resume();

        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }
}