<?php
require_once 'config.php';
require_once 'resources.php';
require_once 'objects.php';

class Main {
    private $text;
    private $console;
    private $web;
    private $args;
    public $mode = 'help';

    public function __construct($argv) {
        $this->text = new Text;
        $this->console = new Console;
        $this->web = new Web;
        $this->args = $argv;
        $this->configure();
    }

    public function configure() {
        if (is_array($this->args)) {
            unset($this->args[0]);
            if (in_array('-v', $this->args) || in_array('--version', $this->args)) {
                $this->mode = 'version';
            }

            if (in_array('-s', $this->args) || in_array('--search', $this->args)) {
                $this->mode = 'search';
            }

            if (in_array('-h', $this->args) || in_array('--help', $this->args)) {
                $this->mode = 'help';
            }
        }
        $this->console->output("\n" . $this->text->color($this->mode, 'blue'));
        $this->main();
    }

    private function main() {
        switch ($this->mode) {
            case 'version':
                $this->version();
                break;
            case 'search':
                $this->findUser();
                break;
            case 'help':
                $this->help();
                break;
        }
    }

    private function help() {
        $this->console->output("Usage: <path>/<to>/accscan --search <username>\n");
    }

    private function version() {
        $this->console->output(VERSION);
        $this->console->output("\n");
    }

    private function findUser() {
        foreach ($this->args as $key => $value) {
            if ($value == '--search' || $value == '-s') {
                $username = isset($this->args[$key + 1]) ? $this->args[$key + 1] : false;

                if ($username) {
                    foreach (RESOURCES as $name => $pattern) {
                        $url = str_replace('{{username}}', $username, $pattern);
                        $this->run($name, $url);
                    }

                    $this->console->output("\n");
                } else {
                    $this->help();
                    exit(1);
                }
            }
        }
    }

    private function run($name, $url) {
        $result = $this->web->check($url);

        if ($result <> 'none') {
            $prefix = $this->text->color('✓', 'green');
            $output = $this->text->color($result, 'blue');
        } else {
            $prefix = $this->text->color('x', 'red');
            $output = $this->text->color($result, 'red');
        }

        $this->console->output("$prefix $name: " . $output);
    }
}

$main = new Main($argv);