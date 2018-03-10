<?php


class UATEnvironmentCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->comment("Cloning project into /var/www/html");
        $I->runShellCommand("docker exec infinity_web git clone https://github.com/ChanakaR/php-simple.git /var/www/html/php-simple");
        $I->runShellCommand('docker exec infinity_web chmod 777 -R /var/www/html');
    }

    public function _after(AcceptanceTester $I)
    {
        $I->comment("remove the project directory from /var/www/html");
        $I->runShellCommand('docker exec infinity_web rm -rf /var/www/html/php-simple');
    }

    public function checkSampleApp(AcceptanceTester $I){
        $I->wantTo("verify uat environment is working properly with a php application");
        $I->runShellCommand("docker exec infinity_web php /var/www/html/php-simple/app.php");
        $I->cantSeeInShellOutput("false");
    }

    public function checkLoginToDBFromPhpmyadmin(AcceptanceTester $I){
        $I->wantTo("log into maria db 10.2 server through phpmyadmin");
        $I->amOnPage('http://localhost:7879');
        $I->fillField('Username:', 'root');
        $I->fillField('Password:', '1234');
        $I->click('Go');
        $I->see('Server: db via TCP/IP');
        $I->see("Server version: 10.2.13-MariaDB-10.2.13+maria~jessie - mariadb.org binary distribution");
    }

}
