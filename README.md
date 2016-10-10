test-job
========

A Symfony project created on October 10, 2016, 9:58 am.


To init the project:

-> download the dependencies with composer :
composer install

-> update your parameters.yml with you DB logins

-> set the right permission on the /var folder

-> update the DB:
php bin/console doctrine:schema:update --force


To use the command line utility :

php bin/console import:order <filepath> <offer>

the parameters offer is optionnal:
put 1 for the 'offer' : "3 for the price of 2"
put 2 for the 'offer' : "Buy Shampoo & get Conditioner for 50% off"


To run the test : 
bin/behat
