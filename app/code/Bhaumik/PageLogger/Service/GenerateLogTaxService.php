<?php
namespace Bhaumik\PageLogger\Service;

use Magento\Framework\UrlInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\View\Page\Title;

class GenerateLogTaxService
{
    private $urlInterface;
    private $remoteAddress;
    private $pageTitle;

    public function __construct(
        UrlInterface $urlInterface,
        RemoteAddress $remoteAddress,
        Title $pageTitle
    ) {
        $this->urlInterface = $urlInterface;
        $this->remoteAddress = $remoteAddress;
        $this->pageTitle = $pageTitle;
    }

    public function execute()
    {
        $pageUrl = $this->urlInterface->getCurrentUrl();
        $pageTitle = $this->pageTitle->getShort();
        $clientIp = $this->remoteAddress->getRemoteAddress();
        return "{$pageTitle}: {$pageUrl} - {$clientIp}";
    }
}