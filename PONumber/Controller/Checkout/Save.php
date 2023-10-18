<?php

namespace Pixafy\PONumber\Controller\Checkout;

use Exception;
use Magento\Checkout\Model\Cart;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\View\LayoutFactory;
use Magento\Quote\Model\QuoteRepository;

/**
 * class Save
 */
class Save extends Action
{
    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var LayoutFactory
     */
    protected $layoutFactory;

    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @param Context $context
     * @param ForwardFactory $resultForwardFactory
     * @param LayoutFactory $layoutFactory
     * @param Cart $cart
     * @param Session $checkoutSession
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        Context         $context,
        ForwardFactory  $resultForwardFactory,
        LayoutFactory   $layoutFactory,
        Cart            $cart,
        Session         $checkoutSession,
        QuoteRepository $quoteRepository
    )
    {
        $this->resultForwardFactory = $resultForwardFactory;
        $this->layoutFactory = $layoutFactory;
        $this->cart = $cart;
        $this->checkoutSession = $checkoutSession;
        $this->quoteRepository = $quoteRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws Exception
     */
    public function execute()
    {
        try {
            $po_number = $this->getRequest()->getParam('po_number');
            if($po_number !=="undefined") {
                $quoteId = $this->checkoutSession->getQuoteId();
                $quote = $this->quoteRepository->get($quoteId);
                $quote->setPoNumber($po_number);
                $quote->save();
            }
        } catch (Exception $e) {
            throw new Exception(__($e->getMessage()));
        }
    }
}
