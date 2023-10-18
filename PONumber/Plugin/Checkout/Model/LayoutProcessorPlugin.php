<?php

namespace Pixafy\PONumber\Plugin\Checkout\Model;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

/**
 *  added purchase order field before place order button
 */
class LayoutProcessorPlugin
{
    /**
     * @var \Pixafy\PONumber\Model\Config
     */
    protected $config;

    /**
     * @param \Pixafy\PONumber\Model\Config $config
     */
    public function __construct(
        \Pixafy\PONumber\Model\Config $config
    )
    {
        $this->config = $config;
    }

    /**
     * @param LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        LayoutProcessor $subject,
        array           $jsLayout
    )
    {
        $isEnabled = $this->config->isEnabled();
        $isRequired = $this->config->isRequired();
        if ($isEnabled) {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
            ['payment']['children']['payments-list']['children']['before-place-order']['children']['po'] = [
                'component' => 'Pixafy_PONumber/js/view/number',
                'dataScope' => 'checkoutcomment',
                'provider' => 'checkoutProvider',
                'visible' => true,
                'sortOrder' => 0,
                'validation' => ['required-entry' => $isRequired ,  'min_text_length' => 1]
            ];
        }

        return $jsLayout;
    }
}
