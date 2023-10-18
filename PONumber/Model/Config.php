<?php

declare(strict_types=1);

namespace Pixafy\PONumber\Model;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

/**
 * Helper to get the configurations values for checkout fields
 */
class Config extends AbstractHelper
{
    const ENABLE = 'pixafy_po_number/general/enable';
    const REQUIRED = 'pixafy_po_number/general/required';

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return (bool)$this->getConfigValue(self::ENABLE);
    }

    /**
     * @param $configPath
     * @return mixed
     */
    public function getConfigValue($configPath)
    {
        return $this->scopeConfig->getValue($configPath, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return (bool)$this->getConfigValue(self::REQUIRED);
    }

}
