<?php

class DBConfigCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }

    public function checkContainerIsRunning(UnitTester $I){
        sleep(60);
        $I->wantTo("verify MariaDB 10.2 container is up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} jade_mysql");
        $I->seeInShellOutput("true");
    }

    public function testEnvironmentVariable_max_allowed_packet(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - max_allowed_packet");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'max_allowed_packet'\"");
        $I->seeInShellOutput("67108864");
    }

    public function testEnvironmentVariable_event_scheduler(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - event_scheduler");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'event_scheduler'\"");
        $I->seeInShellOutput("ON");
    }

    public function testEnvironmentVariable_connect_timeout(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - connect_timeout");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'connect_timeout'\"");
        $I->seeInShellOutput("10");
    }

    public function testEnvironmentVariable_innodb_buffer_pool_size(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - innodb_buffer_pool_size");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'innodb_buffer_pool_size'\"");
        $I->seeInShellOutput("2147483648");
    }

    public function testEnvironmentVariable_innodb_log_buffer_size(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - innodb_log_buffer_size");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'innodb_log_buffer_size'\"");
        $I->seeInShellOutput("8388608");
    }

    public function testEnvironmentVariable_innodb_log_file_size(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - innodb_log_file_size");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'innodb_log_file_size'\"");
        $I->seeInShellOutput("1073741824");
    }

    public function testEnvironmentVariable_innodb_lock_wait_timeout(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - innodb_lock_wait_timeout");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'innodb_lock_wait_timeout'\"");
        $I->seeInShellOutput("30");
    }

    public function testEnvironmentVariable_delayed_insert_timeout(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - delayed_insert_timeout");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'delayed_insert_timeout'\"");
        $I->seeInShellOutput("300");
    }

    public function testEnvironmentVariable_net_read_timeout(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - net_read_timeout");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'net_read_timeout'\"");
        $I->seeInShellOutput("30");
    }

    public function testEnvironmentVariable_net_write_timeout(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - net_write_timeout");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'net_write_timeout'\"");
        $I->seeInShellOutput("60");
    }

    public function testEnvironmentVariable_slave_net_timeout(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - slave_net_timeout");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'slave_net_timeout'\"");
        $I->seeInShellOutput("600");
    }

    public function testEnvironmentVariable_wait_timeout(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - wait_timeout");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'wait_timeout'\"");
        $I->seeInShellOutput("600");
    }

    public function testEnvironmentVariable_interactive_timeout(UnitTester $I){
        $I->wantTo("MariaDB 10.2 environment variable test - interactive_timeout");
        $I->runShellCommand("docker exec jade_mysql mysql -uroot -p1234 -e \"show variables like 'interactive_timeout'\"");
        $I->seeInShellOutput("600");
    }
}