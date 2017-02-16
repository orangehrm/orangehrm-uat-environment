<?php


class UATEnvironmentCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->comment("Cloning project into /var/www/html");
        $I->runShellCommand("docker exec uat_web git clone https://github.com/ChanakaR/php-simple.git /var/www/html/php-simple");
        $I->runShellCommand('docker exec uat_web chmod 777 -R /var/www/html');
    }

    public function _after(AcceptanceTester $I)
    {
        $I->comment("remove the project directory from /var/www/html");
        $I->runShellCommand('docker exec uat_web rm -rf /var/www/html/php-simple');
    }

    public function UATWebTest(AcceptanceTester $I){
        $I->wantTo("verify uat environment is working properly with a php application");
        $I->runShellCommand("docker exec uat_web php /var/www/html/php-simple/app.php");
        $I->cantSeeInShellOutput("false");
    }
}
