<?php
namespace Fernando\AccessLogger\Logger;

use Monolog\Logger;
use Magento\Framework\Logger\Handler\Base;
class Handler extends Base
{
    protected $loggerType = Logger::INFO;

    protected $fileName = '/var/log/page-view.log';
}
