<?php


class MysqlContainerCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }

    // tests
    public function mySqlContainerTest(UnitTester $I){
        $I->wantTo("verify mysql container is up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} uat_mysql");
        $I->seeInShellOutput("true");
    }

    public function checkMySQLServiceIsRunning(AcceptanceTester $I){
        $I->wantTo("verify mysql 5.5 service is up and running");
        $I->runShellCommand("ping -c 30 localhost");
        $I->runShellCommand("docker exec uat_mysql mysqladmin -uroot -p1234 status");
        $I->seeInShellOutput("Uptime");
    }

    public function checkMySQLConfigurations(AcceptanceTester $I){
        $I->wantTo("verify my.cnf configuration is loaded");
        $I->runShellCommand("docker exec uat_mysql mysql -uroot -p1234 -se 'show variables'");
        $I->seeInShellOutput("event_scheduler	ON");
        $I->seeInShellOutput("innodb_log_buffer_size	8388608");
        $I->seeInShellOutput("innodb_buffer_pool_size	2147483648");
        $I->seeInShellOutput("max_allowed_packet	100663296");
    }
}
