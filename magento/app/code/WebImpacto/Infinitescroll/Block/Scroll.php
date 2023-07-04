<?php
namespace WebImpacto\Infinitescroll\Block;

use Magento\Theme\Block\Html\Pager;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\ScopeInterface;

class Scroll extends Pager 
{
    const CONFIG_PREFIX = "webimpacto_infinitescroll/general/";

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Init constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
    }

    public function getConfigValue($config) : ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PREFIX . $config, ScopeInterface::SCOPE_STORE);
    }
}