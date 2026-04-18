<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

it('compiles the @user directive', function () {
    $compiled = Blade::compileString('@user hello @enduser');

    expect($compiled)->toContain("check('user'");
});

it('renders content for a regular browser user agent', function () {
    $this->app['request'] = Request::create('/', 'GET', [], [], [], [
        'HTTP_USER_AGENT' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Safari/605.1.15',
    ]);

    $rendered = Blade::render('@user human @enduser');

    expect(trim($rendered))->toBe('human');
});

it('hides content from a Googlebot user agent', function () {
    $this->app['request'] = Request::create('/', 'GET', [], [], [], [
        'HTTP_USER_AGENT' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
    ]);

    $rendered = Blade::render('@user human @enduser');

    expect(trim($rendered))->toBe('');
});

it('hides content from Chrome-Lighthouse', function () {
    $this->app['request'] = Request::create('/', 'GET', [], [], [], [
        'HTTP_USER_AGENT' => 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko) Chrome-Lighthouse',
    ]);

    $rendered = Blade::render('@user human @enduser');

    expect(trim($rendered))->toBe('');
});

it('clamps oversized user agents to prevent ReDoS', function () {
    $this->app['request'] = Request::create('/', 'GET', [], [], [], [
        'HTTP_USER_AGENT' => str_repeat('a', 100_000),
    ]);

    $start = microtime(true);
    $rendered = Blade::render('@user human @enduser');
    $elapsed = microtime(true) - $start;

    expect(trim($rendered))->toBe('human');
    expect($elapsed)->toBeLessThan(1.0);
});
