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

namespace Nh\Example\Model;

use Magento\Framework\Model\AbstractModel;
use Nh\Example\Api\Data\RuleInterface;

class Rule extends AbstractModel implements RuleInterface
{
    /**
     * Rule page cache tag.
     */
    const CACHE_TAG = 'nh_rule_records';

    /**
     * @var string
     */
    protected $_cacheTag = 'nh_rule_records';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'nh_rule_records';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Nh\Example\Model\ResourceModel\Rule');
    }
 
    /**
     * Get rule id.
     *
     * @return int
     */
    public function getRuleId()
    {
        return $this->getData(self::RULE_ID);
    }

    /**
     * Set rule id.
     */
    public function setRuleId($ruleId)
    {
        return $this->setData(self::RULE_ID, $ruleId);
    }
   /**
     * Get customer id.
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Set customer id.
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Get rule name.
     *
     * @return varchar
     */
    public function getRuleName()
    {
        return $this->getData(self::RULE_NAME);
    }

    /**
     * Set rule name.
     */
    public function setRuleName($ruleName)
    {
        return $this->setData(self::RULE_NAME, $ruleName);
    }

    /**
     * Get frequency.
     *
     * @return varchar
     */
    public function getFrequency()
    {
        return $this->getData(self::FREQUENCY);
    }

    /**
     * Set frequency.
     */
    public function setFrequency($frequency)
    {
        return $this->setData(self::FREQUENCY, $frequency);
    }
   
}
