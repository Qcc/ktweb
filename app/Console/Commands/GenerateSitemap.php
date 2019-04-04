<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SitemapService;
use Illuminate\Support\Facades\Log;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成网站地图sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('[' . date('Y-m-d H:i:s', time()) .'] 开始生成sitemap网站地图!');
        try {
            $sitemapService = new SitemapService();
            $sitemapService->buildIndex();
        } catch (\Exception $exception) {
            Log::error('生成sitemap失败：' . $exception->getMessage());
            return;
        }
        Log::info('[' . date('Y-m-d H:i:s', time()) .'] 生成sitemap网站地图成功!');
    }
}
