<?php
require_once 'config.php';
require_once 'resources.php';
require_once 'objects.php';

class Main {
    private $text;
    private $console;
    private $web;
    private $args;

    public function __construct($argv) {
        $this->text = new Text;
        $this->console = new Console;
        $this->web = new Web;
        $this->args = $argv;
        $this->main();
    }

    public function main() {
        $this->console->output("\n");
        if (is_array($this->args)) {
            foreach ($this->args as $key => $value) {
                if ($value == '--version' || $value == '-v') {
                    $this->console->output(VERSION);
                    $this->console->output("\n");
                    exit;
                } elseif ($value == '--search' || $value == '-s') {
                    $username = $this->args[$key + 1];

                    foreach (RESOURCES as $name => $pattern) {
                        $url = str_replace('{{username}}', $username, $pattern);

                        $this->run($name, $url);
                    }
                    $this->console->output("\n");
                    exit;
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