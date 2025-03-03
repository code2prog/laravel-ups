<?php

declare(strict_types=1);

namespace Rawilk\Ups\Tests;

use Dotenv\Dotenv;
use Orchestra\Testbench\TestCase as Orchestra;
use Rawilk\Ups\UpsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        $this->loadEnvironmentVariables();

        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            UpsServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        // Ustawienie domyślnej konfiguracji UPS dla testów
        $app['config']->set('ups.access_key', 'test_access_key');
        $app['config']->set('ups.user_id', 'test_user_id');
        $app['config']->set('ups.password', 'test_password');
        $app['config']->set('ups.shipper_number', 'test_shipper_number');
        $app['config']->set('ups.sandbox', true);
    }

    protected function loadEnvironmentVariables(): void
    {
        /*
         * File won't exist when running tests on GitHub actions.
         * .env variables are loaded in through workflow file instead
         * utilizing GitHub secrets.
         */
        if (! file_exists(__DIR__ . '/../.env')) {
            return;
        }

        $dotEnv = Dotenv::createImmutable(__DIR__ . '/..');

        $dotEnv->load();
    }
}
