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
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Nh\Example\Model\RuleFactory;

class Ruleaction extends Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Page
     */
    protected $resultPage;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var RuleFactory
     */
    protected $ruleFactory;

    /**
     * Addrule context
     * 
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $coreRegistry,
     * @param RuleFactory $ruleFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $coreRegistry,
        RuleFactory $ruleFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $coreRegistry;
        $this->ruleFactory = $ruleFactory;
    }


    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->ruleFactory->create();
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            if (!$rowData->getRuleId()) {
                $this->messageManager->addError(__('Rule no longer exist.'));
                $this->_redirect('customerrule/index/index');
                return;
            }
        }
        
        $this->coreRegistry->register('rule', $rowData);
        $this->resultPage = $this->resultPageFactory->create();  
		$this->resultPage->setActiveMenu('Nh_Example::customer_rule');
        $title = $rowId ? __('Edit rule') : __('Add rule');
       $this->resultPage->getConfig()->getTitle()->prepend($title);
		return $this->resultPage;
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
