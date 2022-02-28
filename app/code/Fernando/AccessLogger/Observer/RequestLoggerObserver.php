<?php
namespace Fernando\AccessLogger\Observer;

use Fernando\AccessLogger\Logger\AccessLogger;
use Fernando\AccessLogger\Service\GenerateAccessLogTextService;
use Magento\Framework\Event\ObserverInterface;

class RequestLoggerObserver implements ObserverInterface
{
    private $logger;
    private $generateAccessLogTextService;

    public function __construct(
        AccessLogger $logger,
        GenerateAccessLogTextService $generateAccessLogTextService
    ) {
        $this->logger = $logger;
        $this->generateAccessLogTextService = $generateAccessLogTextService;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $accessLogText = $this->generateAccessLogTextService->execute();
        $this->logger->info($accessLogText);
    }
}
