<?php

namespace Fernando\OrderCount\Block\Customer;

use Fernando\OrderCount\Service\GetCustomerOrderCountService;
use Magento\Customer\Block\Account\SortLinkInterface;
use Magento\Framework\View\Element\Html\Link\Current;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\DefaultPathInterface;
use Magento\Customer\Model\Session;

class Link extends Current implements SortLinkInterface
{
    private $_customerSession;
    private $getCustomerOrderCountService;

    public function __construct(
        Context $context,
        DefaultPathInterface $defaultPath,
        Session $customerSession,
        array $data = [],
        GetCustomerOrderCountService $getCustomerOrderCountService
    ) {
        $this->_customerSession = $customerSession;
        $this->getCustomerOrderCountService = $getCustomerOrderCountService;
        parent::__construct($context, $defaultPath, $data);
    }

    protected function _toHtml()
    {
        $responseHtml = parent::_toHtml();
        $customerId = $this->_customerSession->getId();
        $customerOrderCount = $this->getCustomerOrderCountService->execute($customerId);
        $responseHtml = str_replace("#", $customerOrderCount, $responseHtml);
        return $responseHtml;
    }

    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }
}
