<?php

namespace Fernando\OrderCount\Service;

use Magento\Sales\Model\ResourceModel\Order\Collection;

class GetCustomerOrderCountService
{

    private $orderCollection;

    public function __construct(
        Collection $orderCollection
    )
    {
        $this->orderCollection = $orderCollection;
    }

    public function execute(int $customerId): int
    {
        $customerOrders = $this->orderCollection
            ->addAttributeToFilter('customer_id', $customerId)->load();
        return $customerOrders->count();
    }
}
