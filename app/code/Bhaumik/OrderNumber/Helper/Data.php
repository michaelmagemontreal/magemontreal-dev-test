<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bhaumik\OrderNumber\Helper;

use Magento\Framework\App\Action\Action;

/**
 * CMS Page Helper
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Customer\Model\Session $session,
        \Magento\Sales\Model\OrderFactory $orderFactory
    ) {
        $this->_session = $session;
        $this->_orderFactory = $orderFactory;
        parent::__construct($context);
    }

    public function getLabel()
    {
        $count = count($this->getOrders());
        return "My Order(".$count.")";
    }

    public function getOrders()
    {
        $customerId = $this->_session->getCustomer()->getId();
        $this->orders = $this->_orderFactory->create()->getCollection()->addFieldToSelect(
            '*'
        )->addFieldToFilter(
            'customer_id',
            $customerId
        )->setOrder(
            'created_at',
            'desc'
        );
        return $this->orders;
    }
}