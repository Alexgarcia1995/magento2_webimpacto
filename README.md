# Magento 2 Webimpacto
Technical test for Webimpacto. This test creates a Magento environment with docker and the technical modules asked on the task.

In order to install and make it work properly, you need to follow this steps:

1. Install Docker in your working environment.
2. Download the repository and run `docker compose up -d` in order to install all the docker environment.
3. Access to phpmyadmin page(http://localhost:8080/) and import the database file inside mysql-dump directory. Also important, check if "magento2" user is created, if is not, create it with password "magento2" and all the privileges.
4. Access to "webimpacto_es-container" and run `composer install` in order to generate vendor elements.
5. Run http://localhost:80/ and check if everything works properly in Magento.

Each module is added in magento/app/code/WebImpacto.

For enable them, run `php bin/magento module:enable WebImpacto_Customproducttext WebImpacto_Infinitescroll WebImpacto_Successtotalmessage WebImpacto_Weather`

Each of this modules has the README.md to explain how the module works.
