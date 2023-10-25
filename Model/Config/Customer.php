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

namespace Nh\Example\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Customer\Model\Customer as CustomerCollection;

class Customer implements OptionSourceInterface
{
    
    /**
     * CustomerCollection
     *
     * @var CustomerCollection
     */
    protected $customerCollection;
 
    public function __construct(CustomerCollection $customerCollection)
    {
        $this->customerCollection = $customerCollection;
    }
 
    public function getCustomerCollection() {
        return $this->customerCollection->getCollection()
               ->addAttributeToSelect("*")
               ->load();
    }

    /**
     * Get frequency type labels array.
     * @return array
     */
    public function getOptionArray()
    {
        $options = [];
        foreach ($this->getCustomerCollection() as $customer) {
            $options[$customer->getId()] = $customer->getEmail();
        }

          return $options;
    }

    /**
     * Get Grid row frequency labels array with empty value for option element.
     *
     * @return array
     */
    public function getAllOptions()
    {
        $res = $this->getOptions();
        array_unshift($res, ['value' => '', 'label' => '']);
        return $res;
    }

    /**
     * Get Grid row frequency array for option element.
     * @return array
     */
    public function getOptions()
    {
        $res = [];
        foreach ($this->getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }
        return $res;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return $this->getOptions();
    }
}