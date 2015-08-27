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
        $this->stopOnFail(true);

        $buildDir = __DIR__.'/build';
        $composerPharPath = __DIR__.'/build/composer.phar';

        if (!file_exists($buildDir)) {
            $this->say('Creating build directory...');
            mkdir($buildDir, 0755);
        }

        if (!file_exists($composerPharPath)) {
            $handle = fopen($composerPharPath, 'w');
            $this->say('Downloading composer.phar...');
            $options = [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_FILE           => $handle,
                CURLOPT_TIMEOUT        => 360,
                CURLOPT_URL            => 'https://getcomposer.org/composer.phar'
            ];

            $ch = curl_init();
            curl_setopt_array($ch, $options);
            curl_exec($ch);
            curl_close($ch);

            fclose($handle);

            chmod($composerPharPath, 0755);
        }

        $this->taskComposerInstall($composerPharPath)
            ->optimizeAutoloader()
            ->run();

        $this->npm();

        $this->taskExec('php app/console assets:install')->run();
        $this->taskExec('php app/console assetic:dump')->run();

    }

    public function npm()
    {
        $this->taskExec('npm')->arg('install')->run();
    }

    public function behat()
    {
        $this->stopOnFail(true);

        $this->taskExec('./node_modules/.bin/phantomjs --webdriver=4444 --webdriver-loglevel=WARNING')
            ->background()
            ->run();

        $this->taskExec('php app/console server:run localhost:8000')
            ->background()
            ->run();

        $microSecondsToWait = (1 / 10) * 1000000; // 1/10 of second (100ms)
        $this->say(sprintf('Waiting for %dms for phantomjs and php server to start.', $microSecondsToWait / 1000));
        usleep($microSecondsToWait);

        $this->taskExec('./bin/behat')
            ->run();
    }
}
