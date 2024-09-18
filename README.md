
<p align="center">
    <img width="300px" src="resources/img/OpenPayroll.png" alt="OpenPayroll"/>
</p>

## About Open Payroll

[Open Payroll](https://github.com/devjaythakkar/open-payroll/) is an Open Source Initiative for Payroll System - which means you can grab the code to be use in your exisitng Laravel application.

Following are the features provided:

- Multiple Earning and Deductions, based on organisation or employee
- Automated Payroll Calculation using Payroll Scheduler
- Each payroll will require at least a reviewer and an approver 
- Customisable Payslip Design
- E-mail / Export the payslip to the employee
- Payroll Report for Administrator
- Payroll Report for Employee
- Custom Earnings and Deductions 
- Customisable earnings and deductions calculation process

## Installation

1. In order to install `devjaythakkar/open-payroll` in your Laravel project, just run the *composer require* command from your terminal:

```
$ composer require devjaythakkar/open-payroll
```

2. You can skip this step if your running Laravel 5.6 and above. Then in your `config/app.php` add the following to the providers array:

```php
JayThakkar\OpenPayroll\OpenPayrollServiceProvider::class,
```

3. You can skip this step if your running Laravel 5.6 and above. In the same `config/app.php` add the following to the aliases array:

```php
'OpenPayroll' => JayThakkar\OpenPayroll\OpenPayrollFacade::class,
```

4. If you're running Laravel 5.8 or above you need to alter the users table migration.

```php
// Change:
$table->bigIncrements('id');

// To:
$table->increments('id');
```

5. Next, you need to install Open Payroll assets:

```
$ php artisan open-payroll:install
$ php artisan migrate
```

6. Open Payroll use [Laravel Observer](https://github.com/cleaniquecoders/laravel-observers), so you need to publish Laravel Observers config file.

```
$ php artisan vendor:publish --tag=laravel-observers
```

Then add the Open Payroll models to the `config/observers.php` in `\JayThakkar\LaravelObservers\Observers\HashidsObserver::class` key. This will allow the observer to create hashed slug for each record automatically.

```php
return [
    \JayThakkar\LaravelObservers\Observers\ReferenceObserver::class => [],
    \JayThakkar\LaravelObservers\Observers\HashidsObserver::class   => [
    	\App\Models\OpenPayroll\Employee::class,
    	\App\Models\OpenPayroll\Position::class,
    	\App\Models\OpenPayroll\Salary::class,
    	\App\Models\OpenPayroll\Admin::class,
    	\App\Models\OpenPayroll\Payroll::class,
    	\App\Models\OpenPayroll\Payslip::class,
    	\App\Models\OpenPayroll\Earning::class,
    	\App\Models\OpenPayroll\Deduction::class,
    ],
];
```

> You may use the observer for the other model as well.

Then seed references data for Open Payroll:

```
$ php artisan open-payroll:seed
```

## Usage

When you are done the installation process, then you may login to your application.

## Test

To run the test, type `vendor/bin/phpunit` in your terminal.

To have codes coverage, please ensure to install PHP XDebug then run the following command:

```
$ vendor/bin/phpunit -v --coverage-text --colors=never --stderr
```

## Contributing

Thank you for considering contributing to the `devjaythakkar/open-payroll`!

### Bug Reports

To encourage active collaboration, it is strongly encourages pull requests, not just bug reports. "Bug reports" may also be sent in the form of a pull request containing a failing test.

However, if you file a bug report, your issue should contain a title and a clear description of the issue. You should also include as much relevant information as possible and a code sample that demonstrates the issue. The goal of a bug report is to make it easy for yourself - and others - to replicate the bug and develop a fix.

Remember, bug reports are created in the hope that others with the same problem will be able to collaborate with you on solving it. Do not expect that the bug report will automatically see any activity or that others will jump to fix it. Creating a bug report serves to help yourself and others start on the path of fixing the problem.

## Coding Style

`devjaythakkar/open-payroll` follows the PSR-2 coding standard and the PSR-4 autoloading standard. 

You may use PHP CS Fixer in order to keep things standardised. PHP CS Fixer configuration can be found in `.php_cs`.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
