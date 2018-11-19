<?php


class WebContainerCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }


    public function mysqlServerConnectionTest(FunctionalTester $I){
        $I->wantTo("verify mysql container is linked with ubuntu container properly");
        $I->runShellCommand("docker exec jade_web ping db -c 2");
        $I->seeInShellOutput('2 packets transmitted, 2 received');
    }

    public function checkTelnetInstallation(FunctionalTester $I){
        $I->wantTo("verify the telnet installation");
        $I->runShellCommand("docker exec jade_web bash -c 'rpm -qa | grep telnet'");
        $I->seeInShellOutput('telnet-0.17');
    }

}
