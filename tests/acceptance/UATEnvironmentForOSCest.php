<?php


class UATEnvironmentForOSCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->comment("Cloning project into /var/www/html");

        $I->runShellCommand('docker exec phantom_web bash -c "git clone https://github.com/orangehrm/orangehrm.git "');
       // $I->runShellCommand('docker exec phantom_web bash -c "cd OHRMStandalone/TEST/symfony/web && mv * ../"');
        $I->runShellCommand('docker exec phantom_web chmod 777 -R /var/www/html');
    }

    public function _after(AcceptanceTester $I)
    {
        $I->comment("remove the project directory from /var/www/html");
        $I->runShellCommand('docker exec phantom_web rm -rf orangehrm');
    }

    public function checkOrangeHRMOSApp(AcceptanceTester $I){
        $I->wantTo("verify uat environment is working properly with orangehrm opensource app");
        $I->amOnPage('https://localhost:6767');
        $I->see("anything");
    }


}
