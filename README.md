# Overview
## Purpose of module

Nh\Example module is responsible for following task.
1) Create your custom end Point using Rest API and show compare product data in it according to customer wise
2) Store custom fllowing data in database table 
  rule Id, rule Name, frequency, created date

## Install
### Add repository
Repositry : composer config repositories.rajtech-nh-example git https://github.com/pawarrajendra200/customer-rule.git

### Install the Extension using Composer
composer require nh/example=dev-master

### Enable the Extension

php bin/magento module:enable Nh_Example

### Last execute magento commanads
1) php bin/magento setup:upgrade
2) php bin/magento setup:di:compile
3) php bin/magento setup:static-content:deploy
4) php bin/magento setup:cache:flush


### Customer compare product rest API details
URL : {base url}/rest/V1/customer/compare-product 
Type : POST
Header : (key:Authorization,value:Bearer {customer token} )
