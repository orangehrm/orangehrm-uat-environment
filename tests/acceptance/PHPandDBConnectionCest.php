<?php

class PHPandDBConnectionCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->comment("Cloning project into /var/www/html");
        $I->runShellCommand("docker exec jade_web git clone -b db-creation-drop https://github.com/orangehrm/environment-test-helpers.git db-creation-drop");
        $I->runShellCommand('docker exec jade_web chmod 777 -R /var/www/html');
    }

    public function _after(AcceptanceTester $I)
    {
        $I->comment("remove the project directory from /var/www/html");
        $I->runShellCommand('docker exec jade_web rm -rf /var/www/html/db-creation-drop');
    }

    public function checkSampleApp(AcceptanceTester $I){
        $I->wantTo("verify uat environment is working properly with a php application");
        $I->runShellCommand("docker exec jade_web php /var/www/html/db-creation-drop/app.php");
        $I->cantSeeInShellOutput("false");
    }
}