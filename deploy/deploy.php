<?php
namespace Deployer;

require 'recipe/common.php';
require 'deploy-test.php';
require 'deploy-prod.php';
require 'utilities.php';

// Windows fixes
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    set('git_tty', false);
    set('ssh_multiplexing', false);
}

// Config

set('repository', 'git@github.com:aryxs3m/jobtraq.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', [
    'laravel-backend/storage'
]);

// Hosts

host('test.jobtraq.hu')
    ->setHostname('nekobox.pvga.hu')
    ->set('remote_user', 'jobtraq')
    ->set('deploy_path', '/var/www/jobtraq/test.jobtraq.hu')
    ->set('keep_releases', 2)
    ->setLabels(['environment' => 'test'])
    ->set('fe_env', 'test');

host('jobtraq.hu')
    ->setHostname('nekobox.pvga.hu')
    ->set('remote_user', 'jobtraq')
    ->set('deploy_path', '/var/www/jobtraq/jobtraq.hu')
    ->set('keep_releases', 3)
    ->setLabels(['environment' => 'prod'])
    ->set('fe_env', 'production');

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

task('be-storage-link', function () {
    run("rm -rf {{release_path}}/laravel-backend/storage/app/public");
    run("ln -s {{deploy_path}}/public {{release_path}}/laravel-backend/storage/app/public");
    run("php {{release_path}}/laravel-backend/artisan storage:link");
});

task('be-migrate', function () {
    run("php {{release_path}}/laravel-backend/artisan migrate");
});

task('be-optimize', function () {
    run("php {{release_path}}/laravel-backend/artisan config:cache");
    run("php {{release_path}}/laravel-backend/artisan route:cache");
    run("php {{release_path}}/laravel-backend/artisan view:cache");
    run("php {{release_path}}/laravel-backend/artisan optimize");
});

task('fe-npm-install', function () {
    cd("{{release_path}}/angular-frontend");
    run("npm i");
});

task('fe-npm-build', function () {
    // Legyen a szerveren fent az Angular CLI!
    // npm install -g @angular/cli

    $feEnv = currentHost()->get('fe_env');

    cd("{{release_path}}/angular-frontend");

    run("ng build --configuration={$feEnv}");
    run("ng run angular-frontend:server:{$feEnv}");
});

task('fe-pm2-reload', function () {
    $feEnv = currentHost()->get('fe_env');

    cd("{{release_path}}/angular-frontend");

    run("pm2 delete ecosystem.{$feEnv}.config.js");
    run("pm2 reload ecosystem.{$feEnv}.config.js");
    run("pm2 startOrRestart ecosystem.{$feEnv}.config.js");
});

task('be-reparse', function () {
    run("php {{deploy_path}}/current/laravel-backend/artisan jtq:reparse");
});

// Hooks

after('deploy:failed', 'deploy:unlock');
