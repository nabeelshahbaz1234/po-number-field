<?php

declare(strict_types=1);

namespace Pixafy\PONumber\Plugin;

use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Pixafy\PONumber\Model\Constants;

/**
 * Class OrderRepositoryPlugin for adding extension attributes in order(s) get api
 */
class OrderRepositoryPlugin
{
    /**
     * @var OrderExtensionFactory
     */
    protected OrderExtensionFactory $extensionFactory;

    /**
     * @param OrderExtensionFactory $extensionFactory
     */
    public function __construct(
        OrderExtensionFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $order
     * @return OrderInterface
     */
    public function afterGet(
        OrderRepositoryInterface $subject,
        OrderInterface           $order
    )
    {
        $this->loadExtensionAttributes($order);
        return $order;
    }

    /**
     * @param $order
     * @return void
     */
    private function loadExtensionAttributes($order)
    {
        $po_number = $order->getData(Constants::PO_NUMBER);

        $extensionAttributes = $order->getExtensionAttributes();
        $extensionAttributes = $extensionAttributes ?: $this->extensionFactory->create();

        $extensionAttributes->setPoNumber($po_number);
        $order->setExtensionAttributes($extensionAttributes);
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param OrderSearchResultInterface $searchResult
     * @return OrderSearchResultInterface
     */
    public function afterGetList(
        OrderRepositoryInterface   $subject,
        OrderSearchResultInterface $searchResult
    )
    {
        $orders = $searchResult->getItems();
        foreach ($orders as $order) {
            $this->loadExtensionAttributes($order);
        }
        return $searchResult;
    }
}
