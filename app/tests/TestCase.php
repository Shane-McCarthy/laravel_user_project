<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	    public function setUp() {
        parent::setUp(); // Don't forget this!
        $this->prepareForTests();

        // We have modified our filters.php file to enable roles.
        // We want to test them so add this code.
        Route::enableFilters();
    }
    public function createApplication() {
        $unitTesting     = true;
        $testEnvironment = 'testing';

        // I couldn't read the CSRF token while testing which led to
        // errors from my filters.php file.  I decided
        // to bypass the CSRF token check while testing and set this session
        // variable which I use later in filters.php to skip the CSRF check.
       $_SESSION['test'] = 'testing';
        return require __DIR__.'/../../bootstrap/start.php';
    }
    private function prepareForTests() {
        Artisan::call('migrate');
        Mail::pretend(true);
    }


}
