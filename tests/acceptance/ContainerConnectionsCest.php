<?php

class ContainerConnectionsCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->comment("Cloning project into /var/www/html");
        $I->runShellCommand("docker exec jade_web git clone -b db-creation https://github.com/orangehrm/environment-test-helpers.git db-creation");
        $I->runShellCommand('docker exec jade_web chmod 777 -R /var/www/html');
    }

    public function _after(AcceptanceTester $I)
    {
        $I->comment("remove the project directory from /var/www/html");
        $I->runShellCommand('docker exec jade_web rm -rf /var/www/html/db-creation');
        $I->runShellCommand('docker exec jade_web mysql -hdb -uroot -p1234 -e "drop database php_simple"');
    }

    public function checkLoginToDBFromPhpmyadmin(AcceptanceTester $I){
        $I->wantTo("log into mysql 10.2 server through phpmyadmin");
        $I->runShellCommand("docker exec jade_web php /var/www/html/db-creation/app.php");
        $I->cantSeeInShellOutput("false");
        $I->amOnPage('http://localhost:6869');
        $I->fillField('Username:', 'root');
        $I->fillField('Password:', '1234');
        $I->click('Go');
        $I->see('Server: db');
        $I->see('php_simple');
    }
}