<?php


class UATEnvironmentForOSCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->comment("Cloning project into /var/www/html");
        $I->runShellCommand("docker exec phantom_web wget -c http://downloads.sourceforge.net/project/orangehrm/stable/3.3.2/orangehrm-3.3.2.zip -O /var/www/html/orangehrm-3.3.2.zip &&\
                    unzip -o /var/www/html/orangehrm-3.3.2.zip /var/www/html && \
                    rm /var/www/html/orangehrm-3.3.2.zip");
        $I->runShellCommand('docker exec phantom_web chmod 777 -R /var/www/html');
    }

    public function _after(AcceptanceTester $I)
    {
        $I->comment("remove the project directory from /var/www/html");
        $I->runShellCommand('docker exec phantom_web rm -rf /var/www/html/orangehrm-3.3.2');
    }

    public function checkOrangeHRMOSApp(AcceptanceTester $I){
        $I->wantTo("verify uat environment is working properly with orangehrm opensource app");
        $I->amOnPage('https://localhost:6767');
        $I->cantSeeInShellOutput("anything");
    }


}
