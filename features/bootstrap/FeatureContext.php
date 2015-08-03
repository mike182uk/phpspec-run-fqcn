<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class FeatureContext implements Context, SnippetAcceptingContext
{
    const PHPSPEC_CONFIG_TEST = 'phpspec-test.yml';
    const TEST_DIR = '_test';

    /**
     * @var string
     */
    private $projectDir;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $lastOutput;

    public function __construct()
    {
        $this->projectDir = realpath('./');
        $this->filesystem = new Filesystem();
    }

    /**
     * @Given :class exists
     */
    public function exists($class)
    {
        $descCmd = $this->buildCmd(sprintf('desc %s', $class));
        $runCmd = $this->buildCmd('run');
        $cmd = sprintf('%s && %s', $descCmd, $runCmd);

        $process = new Process($cmd);

        $process->setEnv(['SHELL_INTERACTIVE' => true]);
        $process->setInput('Y');
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
    }

    /**
     * @When I run the spec for :fqcn
     */
    public function iRunTheSpecFor($fqcn)
    {
        $cmd = $this->buildCmd(sprintf('run %s', $fqcn));
        $cmd .= ' --format pretty';

        $process = new Process($cmd);

        $process->setEnv(['SHELL_INTERACTIVE' => true]);
        $process->setInput('Y');
        $process->run();

        $this->lastOutput = $process->getOutput();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
    }

    /**
     * @Then the spec for :_class should be successfully run
     */
    public function theSpecForShouldBeSuccessfullyRun($class)
    {
        expect($this->lastOutput)->toMatch('/'.preg_quote($class, '#').'/');
        expect($this->lastOutput)->toMatch('/1 specs/');
        expect($this->lastOutput)->toMatch('/1 specs/');
    }

    /**
     * @param string $cmd
     *
     * @return string
     */
    private function buildCmd($cmd)
    {
        $cmdPrefix = sprintf('%s/bin/phpspec', $this->projectDir);
        $cmdSuffix = sprintf('--config %s/%s', $this->projectDir, self::PHPSPEC_CONFIG_TEST);

        return sprintf('%s %s %s', $cmdPrefix, $cmd, $cmdSuffix);
    }

    /**
     * @Transform :class
     * @Transform :fqcn
     */
    public function normalizeClass($class)
    {
        return str_replace('\\', '/', $class);
    }

    /**
     * @beforeScenario
     */
    public function removeTestDir()
    {
        $this->filesystem->remove(self::TEST_DIR);
    }
}
