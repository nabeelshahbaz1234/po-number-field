<?php

declare(strict_types=1);

namespace Pixafy\PONumber\Observer;

use Magento\Framework\Event\ObserverInterface;
use Pixafy\PONumber\Model\Constants;

/**
 * class QuoteToOrder
 */
class QuoteToOrder implements ObserverInterface
{

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /* @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getOrder();
        /* @var \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getQuote();
        if ($quote->hasData(Constants::PO_NUMBER)) {
            $order->setData(Constants::PO_NUMBER, $quote->getData(Constants::PO_NUMBER));
        }
        return $this;
    }
}
