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

 use Magento\Customer\Api\CustomerRepositoryInterface;
 use Magento\Framework\Exception\LocalizedException;


 /**
 * Get customer
 */
class Customer
{

    /**
     * Customer construct
     * 
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }


    /**
     * Get Customer by id
     *
     * @param int $customerId
     *
     * @return array
     * @throws Exception
     */
    public function execute(int $customerId)
    {
        try {
            $customer = $this->customerRepository->getById($customerId);
            
            return ['id' => $customer->getId(),
                    'email' => $customer->getEmail(),
                    'firstname' => $customer->getFirstname(),
                    'lastname' => $customer->getLastname(),
                    'group' => $customer->getGroupId()
                  ];
        } catch (LocalizedException $e) {
            throw new \Exception(__($e->getMessage()));
        }
    }
}