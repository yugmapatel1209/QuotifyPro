######################################## Stripe Payment Gateway ############################
######################################## Local Credentials ########################################
http://localhost/quotation/
email id : admin@gmail.com
password : 123456

http://localhost/QuotifyPro/
yugma@yopmail.com
Admin@123
####################################################################

Artisane commands:
Run
Php artisan serve
auth
php artisan make:auth
check
AuthenticatesUsers controller for the AUTH functions

Model
php artisan make:model QuotationsDetail
php artisan make:model QuotationsMaster
php artisan make:model TermsConditions

Controller
php artisan make:controller QuotationController
#php artisan make:controller Admin\ScenariosController

routelist
php artisan route:list
php artisan route:list --name=account

======================================================================================================
php artisan make:migration create_quotation_master_table
php artisan make:migration create_quotation_detail_table

php artisan make:migration create_terms_conditions_table
php artisan make:migration create_units_table
php artisan make:migration create_app_settings_table

======================================================================================================

####################################################################################
create model:(api)
php artisan infyom:api Languages

####################################################################################
Create Only model (sample)

php artisan infyom:model $MODEL_NAME
php artisan infyom:model Certifications --fromTable --tableName=certifications
####################################################################################
Create api from table: (sample)
php artisan infyom:api Cards --fromTable --tableName=cards
php artisan migrate
#################################### YP at date 28-03-2019 ############
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:cache
php artisan config:clear
####################################### Query upgrade history #############################################

ALTER TABLE `quotations_detail` ADD `delivery` VARCHAR(100) NULL DEFAULT NULL AFTER `is_active`;
ALTER TABLE `quotations_detail` ADD `benefit` VARCHAR(30) NULL DEFAULT NULL AFTER `total_amount`;

ALTER TABLE `quotations_master` ADD `need_extra_price_comparison` TINYINT NOT NULL DEFAULT '0' AFTER `is_laterpad_image`;
ALTER TABLE `quotations_master` ADD `buyers_name` VARCHAR(100) NULL DEFAULT NULL AFTER `need_extra_price_comparison`;

###########################################################################################################
