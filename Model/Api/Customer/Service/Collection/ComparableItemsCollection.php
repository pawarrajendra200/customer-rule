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
 
 namespace Nh\Example\Model\Api\Customer\Service\Collection;

use Magento\Catalog\Helper\Product\Compare;
use Magento\Catalog\Model\Config as CatalogConfig;
use Magento\Catalog\Model\Product\Visibility as CatalogProductVisibility;
use Magento\Catalog\Model\ResourceModel\Product\Compare\Item\Collection;
use Magento\Catalog\Model\ResourceModel\Product\Compare\Item\CollectionFactory as CompareItemsCollectionFactory;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;

/**
 * Get collection with comparable items
 */
class ComparableItemsCollection
{
    /**
     * @var Collection
     */
    private $items;

    /**
     * @var CompareItemsCollectionFactory
     */
    private $itemCollectionFactory;

    /**
     * @var CatalogProductVisibility
     */
    private $catalogProductVisibility;

    /**
     * @var CatalogConfig
     */
    private $catalogConfig;

    /**
     * @var Compare
     */
    private $compareProduct;

    /**
     * @param CompareItemsCollectionFactory $itemCollectionFactory
     * @param CatalogProductVisibility $catalogProductVisibility
     * @param CatalogConfig $catalogConfig
     * @param Compare $compareHelper
     */
    public function __construct(
        CompareItemsCollectionFactory $itemCollectionFactory,
        CatalogProductVisibility $catalogProductVisibility,
        CatalogConfig $catalogConfig,
        Compare $compareHelper
    ) {
        $this->itemCollectionFactory = $itemCollectionFactory;
        $this->catalogProductVisibility = $catalogProductVisibility;
        $this->catalogConfig = $catalogConfig;
        $this->compareProduct = $compareHelper;
    }

    /**
     * Get collection of comparable items
     *
     * @param int $customerId
     * @param int $storeId
     *
     * @return Collection
     */
    public function execute(int $customerId, int $storeId): Collection
    {
        $this->compareProduct->setAllowUsedFlat(false);
        $this->items = $this->itemCollectionFactory->create();
        $this->items->setCustomerId($customerId);
        $this->items->useProductItem()->setStoreId($storeId);
        $this->items->addAttributeToSelect(
            $this->catalogConfig->getProductAttributes()
        )->loadComparableAttributes()->addMinimalPrice()->addTaxPercents();

        return $this->items;
    }
}