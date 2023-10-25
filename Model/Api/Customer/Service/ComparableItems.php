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

 namespace Nh\Example\Model\Api\Customer\Service;

use Magento\Catalog\Block\Product\Compare\ListCompare;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ProductRepository;
use Nh\Example\Model\Api\Customer\Service\Collection\ComparableItemsCollection;;
use Magento\Framework\Exception\LocalizedException;

/**
 * Get comparable products
 */
class ComparableItems
{
    /**
     * @var ListCompare
     */
    private $blockListCompare;

    /**
     * @var ComparableItemsCollection
     */
    private $comparableItemsCollection;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @param ListCompare $listCompare
     * @param ComparableItemsCollection $comparableItemsCollection
     * @param ProductRepository $productRepository
     */
    public function __construct(
        ListCompare $listCompare,
        ComparableItemsCollection $comparableItemsCollection,
        ProductRepository $productRepository
    ) {
        $this->blockListCompare = $listCompare;
        $this->comparableItemsCollection = $comparableItemsCollection;
        $this->productRepository = $productRepository;
    }

    /**
     * Get comparable items
     *
     * @param int $customerId
     * @param int $storeId
     *
     * @return array
     * @throws Exception
     */
    public function execute(int $customerId, int $storeId)
    {
        $items = [];
        foreach ($this->comparableItemsCollection->execute($customerId, $storeId) as $item) {
            /** @var Product $item */
            $items[] = [
                'uid' => $item->getId(),
                'product' => $this->getProductData((int)$item->getId()),
                'attributes' => $this->getProductComparableAttributes($customerId, $item, $storeId)
            ];
        }

        return $items;
    }

    /**
     * Get product data
     *
     * @param int $productId
     *
     * @return array
     *
     * @throws Exception
     */
    private function getProductData(int $productId): array
    {
        $productData = [];
        try {
            $item = $this->productRepository->getById($productId);
            $productData = $item->getData();
            $productData['model'] = $item;
        } catch (LocalizedException $e) {
            throw new \Exception(__($e->getMessage()));
        }

        return $productData;
    }

    /**
     * Get comparable attributes for product
     *
     * @param int $customerId
     * @param Product $product
     * @param int $storeId
     *
     * @return array
     */
    private function getProductComparableAttributes(int $customerId, Product $product, int $storeId): array
    {
        $attributes = [];
        $itemsCollection = $this->comparableItemsCollection->execute($customerId, $storeId);
        foreach ($itemsCollection->getComparableAttributes() as $item) {
            $attributes[] = [
                'code' =>  $item->getAttributeCode(),
                'value' => $this->blockListCompare->getProductAttributeValue($product, $item)
            ];
        }

        return $attributes;
    }
}