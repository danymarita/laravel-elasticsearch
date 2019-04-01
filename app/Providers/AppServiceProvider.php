<?php

namespace App\Providers;

use App\Articles\ArticlesRepository;
use App\Articles\DatabaseArticlesRepository;
use App\Articles\ElasticsearchArticlesRepository;
use App\Problems\ProblemRepository;
use App\Problems\DatabaseProblemRepository;
use App\Problems\ElasticsearchProblemRepository;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArticlesRepository::class, ElasticsearchArticlesRepository::class);
        $this->app->bind(ProblemRepository::class, ElasticsearchProblemRepository::class);
        $this->app->bind(Client::class, function () {
            return ClientBuilder::create()
                ->setHosts(config('services.search.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
