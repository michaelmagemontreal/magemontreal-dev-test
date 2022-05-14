<?php
namespace Bhaumik\PageLogger\Observer;

use Bhaumik\PageLogger\Logger\PageViewLogger;
use Bhaumik\PageLogger\Service\GenerateLogTaxService;
use Magento\Framework\Event\ObserverInterface;

class RequestPageLoggerObserve implements ObserverInterface
{
    private $logger;
    private $generateLogTaxService;

    public function __construct(
        PageViewLogger $logger,
        GenerateLogTaxService $generateLogTaxService
    ) {
        $this->logger = $logger;
        $this->generateLogTaxService = $generateLogTaxService;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $accessLogText = $this->generateLogTaxService->execute();
        $this->logger->info($accessLogText);
    }
}
