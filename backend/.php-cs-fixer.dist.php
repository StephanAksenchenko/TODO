<?php

$finder = PhpCsFixer\Finder::create()
    ->in(['src', 'tests']);

return (new \Mygento\Symfony\Config\Symfony())
    ->setFinder($finder);
