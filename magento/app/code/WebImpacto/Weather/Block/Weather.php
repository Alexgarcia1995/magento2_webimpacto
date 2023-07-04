<?php

namespace WebImpacto\Weather\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

class Weather extends Template
{
    const CONFIG_PREFIX = "webimpacto_weather/general/";
    
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Init Constructor
     * @param Context $context
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