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
        $I->runShellCommand("docker inspect -f {{.State.Running}} guardian_web");
        $I->seeInShellOutput("true");
    }


    public function checkPHPVersion(UnitTester $I){
        $I->wantTo("verify php 7.4 is installed in the container");
        $I->runShellCommand("docker exec guardian_web php --version");
        $I->seeInShellOutput('PHP 7.4');
    }

    public function checkForNologinFile(UnitTester $I){
        $I->wantTo("verify nologin file is not there");
        $I->runShellCommand("docker exec guardian_web ls /var/run/");
        $I->dontSeeInShellOutput("nologin");
    }

//    public function checkApacheServiceIsRunning(UnitTester $I){
//        $I->wantTo("verify apache is up and running in the container");
//        $I->runShellCommand("ping -c 10 localhost");
//        $I->runShellCommand("docker exec infinity_web service httpd status");
//        $I->seeInShellOutput('active (running)');
//    }

    public function checkCronServiceIsRunning(UnitTester $I){
        $I->wantTo("verify cron is up and running in the container");
        $I->runShellCommand("docker exec guardian_web systemctl status crond");
        $I->seeInShellOutput('active (running)');
    }

    // public function checkMemcacheServiceIsRunning(UnitTester $I){
    //     $I->wantTo("verify apache is up and running in the container");
    //     $I->runShellCommand("docker exec guardian_web systemctl status memcached");
    //     $I->seeInShellOutput('active (running)');
    // }

    public function checkSSHInstallation(UnitTester $I){
            $I->wantTo("verify OpenSSH is installed in the container");
            $I->runShellCommand("docker exec guardian_web rpm -qa | grep openssh-server");
            $I->seeInShellOutput("openssh-server-7");
    }

    public function checkSSHServiceRunning(UnitTester $I){
            $I->wantTo("verify ssh is up and running in the container");
            $I->runShellCommand("docker exec guardian_web systemctl status sshd");
            $I->seeInShellOutput('active (running)');
    }

    public function checkNSSPAMLDAPInstallation(UnitTester $I){
            $I->wantTo("verify nss-pam-ldapd is installed in the container");
            $I->runShellCommand("docker exec guardian_web rpm -qa | grep nss-pam-ldapd");
            $I->seeInShellOutput("nss-pam-ldapd-0.8");
    }

    public function checkOpenldapInstallation(UnitTester $I){
            $I->wantTo("verify open-ldap is installed in the container");
            $I->runShellCommand("docker exec guardian_web rpm -qa | grep openldap");
            $I->seeInShellOutput("openldap-clients-2");
    }

    public function checkNSCDInstallation(UnitTester $I){
            $I->wantTo("verify nscd is installed in the container");
            $I->runShellCommand("docker exec guardian_web rpm -qa | grep nscd");
            $I->seeInShellOutput("nscd-2");
    }

    public function checkJavaVersion(UnitTester $I){
            $I->wantTo("verify java is installed in the container");
            $I->runShellCommand("docker exec guardian_web rpm -qa | grep java-1.8.0-openjdk");
            $I->seeInShellOutput("java-1.8.0");
    }

    public function checkWgetVersion(UnitTester $I){
            $I->wantTo("verify wget is installed in the container");
            $I->runShellCommand("docker exec guardian_web rpm -qa | grep wget");
            $I->seeInShellOutput("wget-1");
    }
//    public function checkVHostConfig(UnitTester $I){
//        $I->wantTo("verify test vhost is configured in the container");
//        $I->runShellCommand("docker exec infinity_web httpd -S");
//        $I->seeInShellOutput("*-test-infinity.orangehrm.com");
//        $I->seeInShellOutput("*-uat-infinity.orangehrm.com");
//        $I->seeInShellOutput("*-prod-infinity.orangehrm.com");
//        $I->seeInShellOutput("*-os-infinity.orangehrm.com");
//        $I->seeInShellOutput("*-freehost-infinity.orangehrm.com");
//    }


    public function checkSendMailNoArch(UnitTester $I){
        $I->wantTo("verify wether sendmail noarch is installed");
        $I->runShellCommand("docker exec guardian_web yum list installed | grep sendmail");
        $I->seeInShellOutput("sendmail-cf.noarch");
    }

}
