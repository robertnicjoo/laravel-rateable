<?php

namespace nicxonsolutions\Rateable\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use nicxonsolutions\Rateable\RateableServiceProvider;
use nicxonsolutions\Rateable\Tests\Database\migrations\PostMigrator;
use nicxonsolutions\Rateable\Tests\Database\migrations\RatingMigrator;
use nicxonsolutions\Rateable\Tests\Database\migrations\UserMigrator;
use nicxonsolutions\Rateable\Tests\Database\seeders\PostSeeder;
use nicxonsolutions\Rateable\Tests\Database\seeders\RatingsSeeder;
use nicxonsolutions\Rateable\Tests\Database\seeders\UserSeeder;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        (new UserSeeder())->run();
        (new PostSeeder())->run();
        // (new RatingsSeeder())->run();
    }

    protected function getPackageProviders($app)
    {
        return [
            RateableServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        (new UserMigrator())->up();
        (new PostMigrator())->up();
        (new RatingMigrator())->up();
    }
}
