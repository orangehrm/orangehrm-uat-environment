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
        $I->runShellCommand("docker exec uat_web ping db -c 2");
        $I->seeInShellOutput('2 packets transmitted, 2 packets received');
    }



}
