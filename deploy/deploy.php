<?php
namespace Deployer;

require 'recipe/common.php';
require 'deploy-test.php';

// Config

set('repository', 'git@github.com:aryxs3m/jobtraq.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', [
    'laravel-backend/storage'
]);

// Hosts

host('nekobox.pvga.hu')
    ->set('remote_user', 'jobtraq')
    ->set('deploy_path', '/var/www/jobtraq/test.jobtraq.hu')
    ->set('keep_releases', 2);

task('be-copy-env', function () {
    run('cp "{{deploy_path}}/.env" "{{release_path}}/laravel-backend/.env"');
});

task('be-composer-install', function () {
    cd('{{release_path}}/laravel-backend');
    run("composer install --no-dev --optimize-autoloader --ignore-platform-reqs");
});

task('be-npm-install', function () {
    cd('{{release_path}}/laravel-backend');
    run("npm i");
});

task('be-npm-build', function () {
    cd('{{release_path}}/laravel-backend');
    run("npm run build");
});

task('be-migrate', function () {
    run("php {{release_path}}/laravel-backend/artisan migrate");
});

task('fe-npm-install', function () {
    cd("{{release_path}}/angular-frontend");
    run("npm i");
});

task('fe-npm-build', function () {
    // Legyen a szerveren fent az Angular CLI!
    // npm install -g @angular/cli

    cd("{{release_path}}/angular-frontend");
    run("ng build --configuration=test");
    run("ng run angular-frontend:server:test");
});

task('fe-pm2-reload', function () {
    cd("{{release_path}}/angular-frontend");
    run("pm2 delete ecosystem.test.config.js");
    run("pm2 reload ecosystem.test.config.js");
    run("pm2 startOrRestart ecosystem.test.config.js");
});

task('be-reparse', function () {
    run("php {{deploy_path}}/current/laravel-backend/artisan jtq:reparse");
});

// Hooks

after('deploy:failed', 'deploy:unlock');
