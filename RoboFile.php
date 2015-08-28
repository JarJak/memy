<?php

// RoboFile.php

class RoboFile extends \Robo\Tasks
{
    public function npm()
    {
        $this->taskExec('npm')->arg('install')->run();
    }

    public function behat()
    {
        $this->stopOnFail(true);

        $this->npm();

        $this->taskExec('./node_modules/.bin/phantomjs --webdriver=4444 --webdriver-loglevel=ALL')
            ->background()
            ->run();

        $this->taskExec('php app/console server:run localhost:8000')
            ->background()
            ->run();

        $microSecondsToWait = (2 / 10) * 1000000; // 2/10 of second (200ms)
        $this->say(sprintf('Waiting for %dms for phantomjs and php server to start.', $microSecondsToWait / 1000));
        usleep($microSecondsToWait);

        $this->taskExec('./bin/behat')
            ->run();

        $this->taskExec('killall node')
            ->run();

        $this->taskExec('killall php')
            ->run();
    }
}
