<?php

use function Deployer\before;
use function Deployer\task;

task('setup-test', [
    'be-copy-env',
    'be-composer-install',
    'be-npm-install',
    'be-npm-build',
    'fe-npm-install',
    'fe-npm-build',
    'be-migrate',
    'fe-pm2-reload',
])->desc('Deploy project to test machine');

task('reparse', [
    'be-reparse',
])->desc('Reparse all listings.');

before('deploy:symlink', 'setup-test');
