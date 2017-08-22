<?php


class UATEnvironmentForOSCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->comment("Cloning project into /var/www/html");
        $I->runShellCommand("docker exec phantom_web git clone https://github.com/orangehrm/orangehrm.git /var/www/html/php-simple");
        $I->runShellCommand('docker exec phantom_web mkdir -p symfony/web');
        $I->runShellCommand('docker exec phantom_web ls');
        $I->runShellCommand('docker exec phantom_web mv orangehrm symfony/web');
        $I->runShellCommand('docker exec phantom_web cd symfony/web/orangehrm && mv * ../');
        $I->runShellCommand('docker exec phantom_web chmod 777 -R /var/www/html');
    }

    public function _after(AcceptanceTester $I)
    {
        $I->comment("remove the project directory from /var/www/html");
        $I->runShellCommand('docker exec phantom_web rm -rf /var/www/html/orangehrm');
    }

    public function checkOrangeHRMOSApp(AcceptanceTester $I){
        $I->wantTo("verify uat environment is working properly with orangehrm opensource app");
        $I->amOnPage('https://localhost:6767');
        $I->cantSeeInShellOutput("anything");
    }


}
