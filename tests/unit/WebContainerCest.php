<?php


class WebContainerCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }

  public function checkContainerIsRunning(UnitTester $I){
        $I->wantTo("verify ubuntu container up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} uat_web");
        $I->seeInShellOutput("true");
    }


    public function checkPHPVersion(UnitTester $I){
        $I->wantTo("verify php 5.6 is installed in the container");
        $I->runShellCommand("docker exec uat_web php --version");
        $I->seeInShellOutput('PHP 5.6');
    }

    public function checkSupervisorServiceIsRunning(UnitTester $I){
        $I->wantTo("verify apache is up and running in the container");
        $I->runShellCommand("docker exec uat_web service supervisor status");
        $I->seeInShellOutput('supervisord is running');
    }

    public function checkApacheServiceIsRunning(UnitTester $I){
        $I->wantTo("verify apache is up and running in the container");
        $I->runShellCommand("ping -c 10 localhost");
        $I->runShellCommand("docker exec uat_web service apache2 status");
        $I->seeInShellOutput('apache2 is running');
    }

    public function checkCronServiceIsRunning(UnitTester $I){
        $I->wantTo("verify cron is up and running in the container");
        $I->runShellCommand("docker exec uat_web service cron status");
        $I->seeInShellOutput('cron is running');
    }

    public function checkMemcacheServiceIsRunning(UnitTester $I){
        $I->wantTo("verify apache is up and running in the container");
        $I->runShellCommand("docker exec uat_web service supervisor status");
        $I->seeInShellOutput('supervisord is running');
    }

    public function checkSSHInstallation(UnitTester $I){
            $I->wantTo("verify OpenSSH is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s openssh-server");
            $I->seeInShellOutput("Version: 1:6.7p1-5+deb8u3");
    }

    public function checkSSHServiceRunning(UnitTester $I){
            $I->wantTo("verify ssh is up and running in the container");
            $I->runShellCommand("docker exec uat_web service ssh status");
            $I->seeInShellOutput('sshd is running');
    }

    public function checkLibPAMLDAPInstallation(UnitTester $I){
            $I->wantTo("verify libpam-ldap is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s libpam-ldap");
            $I->seeInShellOutput("Version: 184-8.7+b1");
    }

    public function checkLibNSSLDAPInstallation(UnitTester $I){
            $I->wantTo("verify libnss-ldap is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s libnss-ldap");
            $I->seeInShellOutput("Version: 265-3+b1");
    }

    public function checkNSCDInstallation(UnitTester $I){
            $I->wantTo("verify nscd is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s nscd");
            $I->seeInShellOutput("Version: 2.19");
    }

    public function checkJavaVersion(UnitTester $I){
            $I->wantTo("verify java is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s openjdk-7-jre");
            $I->seeInShellOutput("Version: 7u131");
    }

    public function checkWgetVersion(UnitTester $I){
            $I->wantTo("verify wget is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s wget");
            $I->seeInShellOutput("Version: 1.16-1+deb8u2");
    }

}
