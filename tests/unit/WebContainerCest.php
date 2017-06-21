<?php


class UbuntuContainerCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }


    public function ContainerTest(UnitTester $I){
        $I->wantTo("verify ubuntu container up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} uat_web");
        $I->seeInShellOutput("true");
    }

    public function apacheInstalledTest(UnitTester $I){
        $I->wantTo("verify apache is installed in the container");
        $I->runShellCommand("docker exec uat_web apache2 -v");
        $I->seeInShellOutput('Server version: Apache/2.4.10');
    }

    public function cronTest(UnitTester $I){
        $I->wantTo("verify cron is installed in the container");
        $I->runShellCommand("docker exec uat_web apt list --installed | grep cron");
        $I->seeInShellOutput('cron/now 3.0');
    }

    public function mysqlClientTest(UnitTester $I){
        $I->wantTo("verify mysql-client is installed in the container");
        $I->runShellCommand("docker exec uat_web apt list --installed | grep mysql-client");
        $I->seeInShellOutput('mysql-client/now 5.5');
    }

    public function libreOfficeTest(UnitTester $I){
        $I->wantTo("verify LibreOffice is installed in the container");
        $I->runShellCommand("docker exec uat_web libreoffice --version");
        $I->seeInShellOutput('LibreOffice 4.3.3.2');
    }



    public function propplerUtilTest(UnitTester $I){
        $I->wantTo("verify poppler-util is installed in the container");
        $I->runShellCommand("docker exec uat_web apt list --installed | grep poppler-util");
        $I->seeInShellOutput('poppler-util');
    }

    public function zipTest(UnitTester $I){
        $I->wantTo("verify zip library is installed in the container");
        $I->runShellCommand("docker exec uat_web zip -v");
        $I->seeInShellOutput('Zip 3');
    }

    public function unzipTest(UnitTester $I){
        $I->wantTo("verify UnZip library is installed in the container");
        $I->runShellCommand("docker exec uat_web unzip -v");
        $I->seeInShellOutput('UnZip 6');
    }

    public function phpunitTest(UnitTester $I){
        $I->wantTo("verify phpunit library is installed in the container");
        $I->runShellCommand("docker exec uat_web phpunit --version");
        $I->seeInShellOutput('PHPUnit 3.7.28');
    }

    public function gitTest(UnitTester $I){
        $I->wantTo("verify git is installed in the container");
        $I->runShellCommand("docker exec uat_web git --version");
        $I->seeInShellOutput('git version 2.1.4');
    }

    public function curlTest(UnitTester $I){
        $I->wantTo("verify curl is installed in the container");
        $I->runShellCommand("docker exec uat_web curl --version");
        $I->seeInShellOutput('curl 7.38');
    }

    public function phpTest(UnitTester $I){
        $I->wantTo("verify php 5.6 is installed in the container");
        $I->runShellCommand("docker exec uat_web php --version");
        $I->seeInShellOutput('PHP 5.6');
    }

    public function nodeTest(UnitTester $I){
        $I->wantTo("verify node v4 is installed in the container");
        $I->runShellCommand("docker exec uat_web node -v");
        $I->seeInShellOutput('v4');
    }

    public function npmTest(UnitTester $I){
        $I->wantTo("verify npm is installed in the container");
        $I->runShellCommand("docker exec uat_web npm --version");
        $I->seeInShellOutput("2");
    }

    public function nodemonTest(UnitTester $I){
        $I->wantTo("verify nodemon is installed in the container");
        $I->runShellCommand("docker exec uat_web nodemon");
        $I->seeInShellOutput('Usage: nodemon');
    }

    public function bowerTest(UnitTester $I){
        $I->wantTo("verify bower is installed in the container");
        $I->runShellCommand("docker exec uat_web bower --version");
        $I->seeInShellOutput('1');
    }

    public function phpModuleTest(UnitTester $I){
            $I->wantTo("verify required php modules are available");
            $I->runShellCommand("docker exec uat_web php -m");
            $I->seeInShellOutput('bcmath');
            $I->seeInShellOutput('calendar');
            $I->seeInShellOutput('Core');
            $I->seeInShellOutput('ctype');
            $I->seeInShellOutput('curl');
            $I->seeInShellOutput('date');
            $I->seeInShellOutput('dom');
            $I->seeInShellOutput('ereg');
            $I->seeInShellOutput('exif');
            $I->seeInShellOutput('fileinfo');
            $I->seeInShellOutput('filter');
            $I->seeInShellOutput('gd');
            $I->seeInShellOutput('gettext');
            $I->seeInShellOutput('hash');
            $I->seeInShellOutput('iconv');
            $I->seeInShellOutput('json');
            $I->seeInShellOutput('ldap');
            $I->seeInShellOutput('libxml');
            $I->seeInShellOutput('mbstring');
            $I->seeInShellOutput('mcrypt');
            $I->seeInShellOutput('memcache');
            $I->seeInShellOutput('mysql');
            $I->seeInShellOutput('mysqli');
            $I->seeInShellOutput('mysqlnd');
            $I->seeInShellOutput('PDO');
            $I->seeInShellOutput('pdo_mysql');
            $I->seeInShellOutput('pdo_sqlite');
            $I->seeInShellOutput('Phar');
            $I->seeInShellOutput('posix');
            $I->seeInShellOutput('readline');
            $I->seeInShellOutput('Reflection');
            $I->seeInShellOutput('session');
            $I->seeInShellOutput('SimpleXML');
            $I->seeInShellOutput('ssh2');
            $I->seeInShellOutput('stats');
            $I->seeInShellOutput('xml');
            $I->seeInShellOutput('zip');
            $I->seeInShellOutput('zlib');
    }

    public function bzip2Test(UnitTester $I){
            $I->wantTo("verify bzip2 is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s bzip2");
            $I->seeInShellOutput("Version: 1.0.6-7+b3");
    }

    public function sshTest(UnitTester $I){
            $I->wantTo("verify OpenSSH is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s openssh-server");
            $I->seeInShellOutput("Version: 1:6.7p1-5+deb8u3");
    }

    public function libpamldapTest(UnitTester $I){
            $I->wantTo("verify libpam-ldap is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s libpam-ldap");
            $I->seeInShellOutput("Version: 184-8.7+b1");
    }

    public function libnssldapTest(UnitTester $I){
            $I->wantTo("verify libnss-ldap is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s libnss-ldap");
            $I->seeInShellOutput("Version: 265-3+b1");
    }

    public function nscdTest(UnitTester $I){
            $I->wantTo("verify nscd is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s nscd");
            $I->seeInShellOutput("Version: 2.19-18+deb8u9");
    }

    public function javaTest(UnitTester $I){
            $I->wantTo("verify java is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s openjdk-7-jre");
            $I->seeInShellOutput("Version: 7u131");
    }

    public function wgetTest(UnitTester $I){
            $I->wantTo("verify wget is installed in the container");
            $I->runShellCommand("docker exec uat_web dpkg -s wget");
            $I->seeInShellOutput("Version: 1.16-1+deb8u2");
    }

    public function sshRunningTest(UnitTester $I){
            $I->wantTo("verify ssh is up and running in the container");
            $I->runShellCommand("docker exec uat_web service ssh status");
            $I->seeInShellOutput('sshd is running');
    }


    public function apacheRunningTest(UnitTester $I){
            $I->wantTo("verify apache is up and running in the container");
            $I->runShellCommand("docker exec uat_web service apache2 status");
            $I->seeInShellOutput('apache2 is running');
    }




}
