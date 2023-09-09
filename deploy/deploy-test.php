<?php

use function Deployer\before;
use function Deployer\task;

task('setup-test', [
        'be-copy-env',
        'be-composer-install',
        'be-npm-install',
        'be-npm-build',
        'be-optimize',
        'fe-npm-install',
        'fe-npm-build',
        'be-migrate',
        'be-storage-link',
        'be-queue-restart',
        'fe-pm2-reload',
    ])
    ->select('environment=test')
    ->desc('Deploy project to test machine');

before('deploy:symlink', 'setup-test');
