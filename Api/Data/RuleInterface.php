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

namespace Nh\Example\Api\Data;

interface RuleInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const RULE_ID = 'rule_id';
    const CUSTOMER_ID = 'customer_id';
    const RULE_NAME = 'rule_name';
    const FREQUENCY = 'frequency';

   /**
    * Get rule id.
    *
    * @return int
    */
    public function getRuleId();

   /**
    * Set rule id.
    */
    public function setRuleId($ruleId);

   /**
    * Get customer id.
    *
    * @return int
    */
    public function getCustomerId();

   /**
    * Set customer id.
    */
    public function setCustomerId($customerId);

   /**
    * Get rule name.
    *
    * @return varchar
    */
    public function getRuleName();

   /**
    * Set rule name.
    */
    public function setRuleName($ruleName);


   /**
    * Get frequency.
    *
    * @return varchar
    */
    public function getFrequency();

   /**
    * Set frequency.
    */
    public function setFrequency($frequency);
}
