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

namespace Nh\Example\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Nh\Example\Model\RuleFactory;

class Save extends Action
{

    /**
     * @var RuleFactory
     */
    private $ruleFactory;    
    

    /**
     * Save construct
     * 
     * @param Context $context
     * @param RuleFactory $ruleFactory
     */
      public function __construct(
        Context $context,
        RuleFactory $ruleFactory
        ) {
         parent::__construct($context);
        $this->ruleFactory = $ruleFactory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('customerrule/index/ruleaction');
            return;
        }

        try {
            $model = $this->ruleFactory->create();
            $model->setData($data);
            $model->save();

            if (isset($data['rule_id'])) {
               $this->messageManager->addSuccess(__('Rule has been successfully updated.'));
            } else{
             $this->messageManager->addSuccess(__('Rule has been successfully saved.'));   
            }
            
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('customerrule/index/index');
    }

    /**
     * Page Permission.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Nh_Example::customer_rule');
    }
}
