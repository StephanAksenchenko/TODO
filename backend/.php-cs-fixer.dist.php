<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['var', 'vendor']);

return (new \Mygento\Symfony\Config\Symfony())
    ->setFinder($finder);
