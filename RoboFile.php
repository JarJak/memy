<?php

// RoboFile.php

class RoboFile extends \Robo\Tasks
{

    public $basedir = __DIR__;

    public function build()
    {
        $this->prepare();
        $this->behat();
    }

    public function prepare()
    {
        $this->taskComposerInstall()
            ->optimizeAutoloader()
            ->run();

        $this->npm();

        $this->taskExec('app/console assets:install')->run();
        $this->taskExec('app/console assetic:dump')->run();

    }

    public function npm()
    {
        $this->taskExec('npm')->arg('install')->run();
    }

    public function behat()
    {
        $this->taskExec('./node_modules/.bin/phantomjs --webdriver=4444 --webdriver-loglevel=WARNING')
            ->background()
            ->run();

        $this->taskExec('app/console server:run localhost:8000')
            ->background()
            ->run();

        $microSecondsToWait = (1/10) * 1000000; // 1/10 of second (100ms)
        $this->say(sprintf('Waiting for %dms for phantomjs and php server to start.', $microSecondsToWait / 1000));
        usleep($microSecondsToWait);

        $this->taskExec('./bin/behat')
            ->run();
    }
}