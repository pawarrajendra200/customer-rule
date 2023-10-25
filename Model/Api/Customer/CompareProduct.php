<?php

/**
 * Ninehertz India Pvt. Ltd. 
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the theninehertz.com license
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Ninehertz India Pvt. Ltd.
 * @package     Nh_Example
 * @copyright   Copyright (c) Ninehertz India Pvt. Ltd. (https://theninehertz.com/)
 * @license     -  
 */

declare(strict_types=1);

namespace Nh\Example\Model\Api\Customer;
 
use Magento\Authorization\Model\CompositeUserContext;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\Serializer\Json;
use Nh\Example\Api\Customer\CompareProductInterface;
use Nh\Example\Model\Api\Customer\Service\ComparableItems;
use Nh\Example\Model\Api\Customer\Service\Customer;

class CompareProduct implements CompareProductInterface
{

    /*
     * @var CompositeUserContext
     */
    protected $userContext;

     /*
     * @var StoreManagerInterface
     */
    protected $StoreManagerInterface;

   /**
    * @var Json
    */
    protected $json;

     /*
     * @var ComparableItems
     */
    protected $comparableItemsService;  

    /*
     * @var Customer
     */
    protected $customerService;       

    /**
     * Compare product construct
     * 
     * @param CompositeUserContext $userContext
     * @param StoreManagerInterface $storeManager
     * @param Json $json
     * @param ComparableItems $comparableItemsService
     * @param Customer $customerService
     */
    public function __construct(
        CompositeUserContext $userContext,
        StoreManagerInterface $storeManager,
        Json $json,
        ComparableItems $comparableItemsService,
        Customer $customerService
    ) {
        $this->userContext = $userContext;
        $this->storeManager = $storeManager;
        $this->json = $json;
        $this->comparableItemsService = $comparableItemsService;
        $this->customerService = $customerService;
        
    }


    /**
     * @inheritdoc
     */
    public function getList()
    {
        try {
            
            $customerId = $this->getCustomerId();
            $storeId = $this->getStoreId();
            $comparableItems = $this->comparableItemsService->execute($customerId, $storeId);
            
            $response = [
                'customer' => $this->customerService->execute($customerId),
                'items' => $comparableItems,
                'item_count' => count($comparableItems)
            ];

            return $this->json->serialize($response);

        } catch (LocalizedException $exception) {
            throw new \Exception(__($exception->getMessage()));
        }

    }

    /**
     * Get customer id 
     * @return int
     */
    public function getCustomerId()
    {
        return $customerId = $this->userContext->getUserId();
    }

     /**
     * Get store id 
     * @return int
     */
    public function getStoreId()
    {
        return (int)$this->storeManager->getStore()->getId();
    }   
    
}












 