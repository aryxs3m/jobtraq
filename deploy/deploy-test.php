<?php

use function Deployer\before;
use function Deployer\task;

task('setup-test', [
    'be-copy-env',
    'be-composer-install',
    'be-npm-install',
    'be-npm-build',
    'be-migrate',
    'fe-npm-install',
    'fe-npm-build',
])->desc('Deploy project to test machine');

before('deploy:symlink', 'setup-test');
