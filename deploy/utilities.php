<?php

use function Deployer\before;
use function Deployer\task;

task('reparse', [
    'be-reparse',
])->desc('Reparse all listings.');
