<?php

namespace Spatie\ViewModels\Tests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Spatie\ViewModels\Providers\ViewModelsServiceProvider;

class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        View::addLocation(__DIR__.'/resources/views');
    }

    protected function createRequest(array $headers = []): Request
    {
        $request = Request::create('/', 'GET', [], [], [], [], []);

        foreach ($headers as $header => $value) {
            $request->headers->set($header, $value);
        }

        return $request;
    }

    protected function getResponseBody(Response $response): array
    {
        return json_decode($response->getContent(), true);
    }

    protected function getPackageProviders($app)
    {
        return [ViewModelsServiceProvider::class];
    }
}
