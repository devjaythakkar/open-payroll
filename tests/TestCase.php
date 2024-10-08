<?php

namespace JayThakkar\OpenPayroll\Tests;

use JayThakkar\OpenPayroll\Traits\ReferenceTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use Traits\SeedTrait, ReferenceTrait, RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->artisan('open-payroll:install');

        $this->loadLaravelMigrations(['--database' => 'testbench']);
        $this->artisan('migrate', ['--database' => 'testbench']);
        $this->artisan('open-payroll:seed');
    }

    public function tearDown()
    {
        $this->removeIfExist(config_path('open-payroll.php'));
        collect()
            ->concat(glob(database_path('migrations/*.php')))
            ->concat(glob(database_path('seeds/*.php')))
            ->concat(glob(database_path('factories/*.php')))
            ->concat(glob(app_path('Models/OpenPayroll/*.php')))
            ->concat(glob(app_path('Http/Controllers/OpenPayroll/*.php')))
            ->each(function($path) {
                $this->removeIfExist($path);
            });
        parent::tearDown();
    }

    /**
     * Truncate table.
     */
    public function truncateTable($table)
    {
        \DB::table($table)->truncate();
    }

    /**
     * Remove file if exists.
     *
     * @param string $path
     */
    public function removeIfExist($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }

    /**
     * Load Package Service Provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array List of Service Provider
     */
    protected function getPackageProviders($app)
    {
        return [
            \JayThakkar\OpenPayroll\OpenPayrollServiceProvider::class,
            \JayThakkar\LaravelObservers\LaravelObserversServiceProvider::class,
            \JayThakkar\LaravelHelper\LaravelHelperServiceProvider::class,
            \JayThakkar\Blueprint\Macro\BlueprintMacroServiceProvider::class,
            \JayThakkar\OpenPayroll\Tests\Stubs\Providers\TestServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Assert the current database has table.
     *
     * @param string $table table name
     */
    protected function assertHasTable($table)
    {
        $this->assertTrue(Schema::hasTable($table));
    }

    /**
     * Assert the table has columns defined.
     *
     * @param string $table   table name
     * @param array  $columns list of columns
     */
    protected function assertTableHasColumns($table, $columns)
    {
        collect($columns)->each(function($column) use ($table) {
            $this->assertTrue(Schema::hasColumn($table, $column));
        });
    }

    /**
     * Assert has helper.
     *
     * @param string $helper helper name
     */
    protected function assertHasHelper($helper)
    {
        $this->assertTrue(function_exists($helper));
    }

    /**
     * Assert has config.
     *
     * @param string $config config name
     */
    protected function assertHasConfig($config)
    {
        $this->assertFileExists(config_path($config . '.php'));
        $this->assertNotNull(config($config));
    }

    /**
     * Assert has migration.
     *
     * @param string $migration migration name
     */
    protected function assertHasMigration($migration)
    {
        $this->assertHasClass($migration);
    }

    /**
     * Assert has class.
     *
     * @param string $class class name
     */
    protected function assertHasClass($class)
    {
        $this->assertTrue(class_exists($class));
    }

    /**
     * Assert has class method exist.
     *
     * @param string $object object
     * @param string $method method
     */
    protected function assertHasClassMethod($object, $method)
    {
        $this->assertTrue(method_exists($object, $method));
    }
}
