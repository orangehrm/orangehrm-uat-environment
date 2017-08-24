<?php


class UATEnvironmentForOSCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->comment("Cloning project into /var/www/html");

        $I->runShellCommand('docker exec phantom_web bash -c "git clone https://github.com/orangehrm/orangehrm.git "');
        $I->runShellCommand('docker exec phantom_web bash -c "cd orangehrm && bash fix_permissions.sh"');
        $I->runShellCommand('docker exec phantom_web bash -c "yes | cp -rf config.ini orangehrm/installer/config.ini"');
        $I->runShellCommand('docker exec phantom_web bash -c "cd orangehrm; composer install -d symfony/lib"');
        $I->runShellCommand('docker exec phantom_web bash -c "cd orangehrm/symfony; php symfony cc"');
        $I->runShellCommand('docker exec phantom_web bash -c "cd orangehrm; php installer/cli_install.php 0"');
        $I->runShellCommand('docker exec phantom_web bash -c "cd orangehrm/symfony; php symfony o:publish-assets"');
        $I->runShellCommand('docker exec phantom_web bash -c "cd orangehrm/symfony; php symfony d:build-model"');
        $I->runShellCommand('docker exec phantom_web chmod 777 -R /var/www/html');
    }

    public function _after(AcceptanceTester $I)
    {
        $I->comment("remove the project directory from /var/www/html");
        $I->runShellCommand('docker exec phantom_web rm -rf orangehrm');
        $I->runShellCommand('docker exec phantom_web rm config.ini');
    }

    public function testValidCredentials(AcceptanceTester $I)
    {
        $I->am('ohrm user');
        $I->wantTo('Login to application as admin');
        $I->lookForwardTo('access to orangehrm application');
        $I->amOnPage('https://localhost:6767/orangehrm');
        $I->fillField('txtUsername','Admin');
        $I->fillField('txtPassword','admin');
        $I->click('Submit');
        $I->see('Dashboard');
    }
//    public function checkOrangeHRMOSApp(AcceptanceTester $I){
//        $I->wantTo("verify uat environment is working properly with orangehrm opensource app");
//        $I->amOnPage('https://localhost:6767/orangehrm');
//        $I->see("internal error");
//    }


}
