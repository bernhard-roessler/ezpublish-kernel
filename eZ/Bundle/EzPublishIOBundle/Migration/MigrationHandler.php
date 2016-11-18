<?php

/**
 * File containing the MigrationHandler class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace eZ\Bundle\EzPublishIOBundle\Migration;

use eZ\Bundle\EzPublishIOBundle\ApiLoader\HandlerFactory;
use Psr\Log\LoggerInterface;

abstract class MigrationHandler implements MigrationHandlerInterface
{
    /** @var \eZ\Bundle\EzPublishIOBundle\ApiLoader\HandlerFactory */
    protected $metadataHandlerFactory;

    /** @var \eZ\Bundle\EzPublishIOBundle\ApiLoader\HandlerFactory */
    protected $binarydataHandlerFactory;

    /** @var \Psr\Log\LoggerInterface */
    protected $logger;

    /** @var \eZ\Publish\Core\IO\IOMetadataHandler */
    protected $fromMetadataHandler;

    /** @var \eZ\Publish\Core\IO\IOBinarydataHandler */
    protected $fromBinarydataHandler;

    /** @var \eZ\Publish\Core\IO\IOMetadataHandler */
    protected $toMetadataHandler;

    /** @var \eZ\Publish\Core\IO\IOBinarydataHandler */
    protected $toBinarydataHandler;

    public function __construct(
        HandlerFactory $metadataHandlerFactory,
        HandlerFactory $binarydataHandlerFactory,
        LoggerInterface $logger = null
    ) {
        $this->metadataHandlerFactory = $metadataHandlerFactory;
        $this->binarydataHandlerFactory = $binarydataHandlerFactory;
        $this->logger = $logger;
    }

    public function setIODataHandlersByIdentifiers(
        $fromMetadataHandlerIdentifier,
        $fromBinarydataHandlerIdentifier,
        $toMetadataHandlerIdentifier,
        $toBinarydataHandlerIdentifier
    ) {
        $this->fromMetadataHandler = $this->metadataHandlerFactory->getConfiguredHandler($fromMetadataHandlerIdentifier);
        $this->fromBinarydataHandler = $this->binarydataHandlerFactory->getConfiguredHandler($fromBinarydataHandlerIdentifier);
        $this->toMetadataHandler = $this->metadataHandlerFactory->getConfiguredHandler($toMetadataHandlerIdentifier);
        $this->toBinarydataHandler = $this->binarydataHandlerFactory->getConfiguredHandler($toBinarydataHandlerIdentifier);

        return $this;
    }

    protected function logError($message)
    {
        if (isset($this->logger)) {
            $this->logger->error($message);
        }
    }

    protected function logInfo($message)
    {
        if (isset($this->logger)) {
            $this->logger->info($message);
        }
    }

    protected function logMissingFile($id)
    {
        $this->logInfo("File with id $id not found");
    }
}
