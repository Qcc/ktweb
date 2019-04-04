<?php

namespace App\Services;

use App;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Log;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Column;
use App\Models\News;
use App\Models\Productcol;
use App\Models\Product;
use App\Models\Solutioncol;
use App\Models\Solution;
use App\Models\Customercol;
use App\Models\Customer;

use App\Models\User;
use Roumen\Sitemap\Sitemap;

class SitemapService
{
    public function buildTopics()
    {
        $sitemap = App::make("sitemap");

        $sitemapName = '';
        $articlesData = [];

        Topic::select(['id', 'slug', 'created_at', 'updated_at'])->chunk(100, function ($topics) use (&$topicsData, &$sitemapName) {
            foreach ($topics as $topic) {
                $sitemapName = date('Y-m', strtotime($topic->created_at));
                $topicsData[$sitemapName][] = [
                    'url' => $topic->link(),
                    'lastmod' => strtotime($topic->updated_at)
                ];
            }
        });

        $lastModTimes = [];
        foreach ($topicsData as $name => $data) {
            $lastModTime = 0;
            foreach ($data as $_data) {
                if ($_data['lastmod'] > $lastModTime) {
                    $lastModTime = $_data['lastmod'];
                }
                $sitemap->add($_data['url'], date("Y-m-d H:i:s", $_data['lastmod']), '0.8', 'daily');
            }
            $info = $sitemap->store('xml','topics-' . $name, storage_path('app/public/sitemap'));
            $lastModTimes[$name] = $lastModTime;
            $sitemap->model->resetItems();
        }
        Log::info($lastModTimes);
        return $lastModTimes;
    }

    public function buildCategorys()
    {
        $sitemap = App::make("sitemap");
        $lastModTime = 0;

        $categorys = Category::all(['id','updated_at']);
        foreach ($categorys as $category) {
            $categoryLastModTime = strtotime($category->updated_at);
            if ($categoryLastModTime > $lastModTime) {
                $lastModTime = $categoryLastModTime;
            }
            $url = route('categories.show', $category->id);
            $sitemap->add($url, date("Y-m-d H:i:s", strtotime($category->updated_at)), '0.6', 'weekly');
        }

        $info = $sitemap->store('xml','categorys', storage_path('app/public/sitemap'));
        Log::info("buildCategorys");
        Log::info($lastModTime);
        return $lastModTime;
    }

    public function buildColumns()
    {
        $sitemap = App::make("sitemap");
        $lastModTime = 0;

        $columns = Column::all(['id','updated_at']);
        foreach ($columns as $column) {
            $columnLastModTime = strtotime($column->updated_at);
            if ($columnLastModTime > $lastModTime) {
                $lastModTime = $columnLastModTime;
            }
            $url = route('columns.show', $column->id);
            $sitemap->add($url, date("Y-m-d H:i:s", strtotime($column->updated_at)), '0.6', 'weekly');
        }

        $info = $sitemap->store('xml','columns', storage_path('app/public/sitemap'));
        Log::info("buildColumns");
        Log::info($lastModTime);
        return $lastModTime;
    }
    public function buildProductcols()
    {
        $sitemap = App::make("sitemap");
        $lastModTime = 0;

        $productcols = Productcol::all(['id', 'slug','updated_at']);
        foreach ($productcols as $productcol) {
            $productcolLastModTime = strtotime($productcol->updated_at);
            if ($productcolLastModTime > $lastModTime) {
                $lastModTime = $productcolLastModTime;
            }
            $url = $productcol->link();
            $sitemap->add($url, date("Y-m-d H:i:s", strtotime($productcol->updated_at)), '0.6', 'weekly');
        }

        $info = $sitemap->store('xml','productcols', storage_path('app/public/sitemap'));
        return $lastModTime;
    }
    public function buildProducts()
    {
        $sitemap = App::make("sitemap");
        $lastModTime = 0;

        $products = Product::all(['id', 'slug','updated_at']);
        foreach ($products as $product) {
            $productLastModTime = strtotime($product->updated_at);
            if ($productLastModTime > $lastModTime) {
                $lastModTime = $productLastModTime;
            }
            $url = $product->link();
            $sitemap->add($url, date("Y-m-d H:i:s", strtotime($product->updated_at)), '0.6', 'weekly');
        }

        $info = $sitemap->store('xml','products', storage_path('app/public/sitemap'));
        return $lastModTime;
    }
    public function buildSolutioncols()
    {
        $sitemap = App::make("sitemap");
        $lastModTime = 0;

        $solutioncols = Solutioncol::all(['id', 'slug','updated_at']);
        foreach ($solutioncols as $solutioncol) {
            $solutioncolLastModTime = strtotime($solutioncol->updated_at);
            if ($solutioncolLastModTime > $lastModTime) {
                $lastModTime = $solutioncolLastModTime;
            }
            $url = $solutioncol->link();
            $sitemap->add($url, date("Y-m-d H:i:s", strtotime($solutioncol->updated_at)), '0.6', 'weekly');
        }

        $info = $sitemap->store('xml','solutioncols', storage_path('app/public/sitemap'));
        return $lastModTime;
    }
    public function buildSolutions()
    {
        $sitemap = App::make("sitemap");
        $lastModTime = 0;

        $solutions = Solution::all(['id', 'slug','updated_at']);
        foreach ($solutions as $solution) {
            $solutionLastModTime = strtotime($solution->updated_at);
            if ($solutionLastModTime > $lastModTime) {
                $lastModTime = $solutionLastModTime;
            }
            $url = $solution->link();
            $sitemap->add($url, date("Y-m-d H:i:s", strtotime($solution->updated_at)), '0.6', 'weekly');
        }

        $info = $sitemap->store('xml','solutions', storage_path('app/public/sitemap'));
        return $lastModTime;
    }
    // public function buildCustomercols()
    // {
    //     $sitemap = App::make("sitemap");
    //     $lastModTime = 0;

    //     $customercols = Customercol::all(['id','updated_at']);
    //     foreach ($customercols as $customercol) {
    //         $customercolLastModTime = strtotime($customercol->updated_at);
    //         if ($customercolLastModTime > $lastModTime) {
    //             $lastModTime = $customercolLastModTime;
    //         }
    //         $url = route("customercols.show",$customercol->id);
    //         $sitemap->add($url, date("Y-m-d H:i:s", strtotime($customercol->updated_at)), '0.6', 'weekly');
    //     }

    //     $info = $sitemap->store('xml','customercols', storage_path('app/public/sitemap'));
    //     return $lastModTime;
    // }
    public function buildCustomers()
    {
        $sitemap = App::make("sitemap");
        $lastModTime = 0;

        $customers = Customer::all(['id', 'slug','updated_at']);
        foreach ($customers as $customer) {
            $customerLastModTime = strtotime($customer->updated_at);
            if ($customerLastModTime > $lastModTime) {
                $lastModTime = $customerLastModTime;
            }
            $url = $customer->link();
            $sitemap->add($url, date("Y-m-d H:i:s", strtotime($customer->updated_at)), '0.6', 'weekly');
        }

        $info = $sitemap->store('xml','customers', storage_path('app/public/sitemap'));
        return $lastModTime;
    }
    public function buildUsers()
    {
        $sitemap = App::make("sitemap");
        $lastModTime = 0;

        $users = User::all(['id','updated_at']);
        foreach ($users as $user) {
            $userLastModTime = strtotime($user->updated_at);
            if ($userLastModTime > $lastModTime) {
                $lastModTime = $userLastModTime;
            }
            $url = route('users.show', $user->id);
            $sitemap->add($url, date("Y-m-d H:i:s", strtotime($user->updated_at)), '0.6', 'weekly');
        }

        $info = $sitemap->store('xml','users', storage_path('app/public/sitemap'));
        return $lastModTime;
    }

    public function buildNewss()
    {
        $sitemap = App::make("sitemap");

        $sitemapName = '';
        $articlesData = [];

        News::select(['id', 'slug', 'created_at', 'updated_at'])->chunk(100, function ($newss) use (&$newssData, &$sitemapName) {
            foreach ($newss as $news) {
                $sitemapName = date('Y-m', strtotime($news->created_at));
                $newssData[$sitemapName][] = [
                    'url' => $news->link(),
                    'lastmod' => strtotime($news->updated_at)
                ];
            }
        });

        $lastModTimes = [];
        foreach ($newssData as $name => $data) {
            $lastModTime = 0;
            foreach ($data as $_data) {
                if ($_data['lastmod'] > $lastModTime) {
                    $lastModTime = $_data['lastmod'];
                }
                $sitemap->add($_data['url'], date("Y-m-d H:i:s", $_data['lastmod']), '0.8', 'daily');
            }
            $info = $sitemap->store('xml','newss-' . $name, storage_path('app/public/sitemap'));
            $lastModTimes[$name] = $lastModTime;
            $sitemap->model->resetItems();
        }
        return $lastModTimes;
    }

     

     

    public function buildHome()
    {
        $sitemap = App::make("sitemap");
        $sitemap->add(config('app.url'), date("Y-m-d H:i:s", time()), '1.0', 'daily');
        $info = $sitemap->store('xml', 'home', storage_path('app/public/sitemap'));
        Log::info($info);
        return true;
    }

    public function buildIndex()
    {
        // create sitemap index
        $sitemap = App::make ("sitemap");

        // add sitemaps (loc, lastmod (optional))
        if ($this->buildHome()) {    
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/home.xml', date("Y-m-d H:i:s", time()));
            // 老版本网站sitemap
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/kouton.xml', date("Y-m-d H:i:s", time()));
        }
        if ($lastModTimes = $this->buildTopics()) {
            foreach ($lastModTimes as $name => $time) {
                $sitemap->addSitemap(config("app.url") . "/storage/sitemap/topics-".$name.".xml", date("Y-m-d H:i:s", $time));
            }
        }
        if ($lastModTimes = $this->buildNewss()) {
            foreach ($lastModTimes as $name => $time) {
                $sitemap->addSitemap(config("app.url") . "/storage/sitemap/newss-".$name.".xml", date("Y-m-d H:i:s", $time));
            }
        }
        if ($lastModTime = $this->buildCategorys()) {
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/categorys.xml', date("Y-m-d H:i:s", $lastModTime));
        }

        if ($lastModTime = $this->buildColumns()) {
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/columns.xml', date("Y-m-d H:i:s", $lastModTime));
        }

        if ($lastModTime = $this->buildProductcols()) {
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/productcols.xml', date("Y-m-d H:i:s", $lastModTime));
        }
        if ($lastModTime = $this->buildProducts()) {
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/products.xml', date("Y-m-d H:i:s", $lastModTime));
        }

        if ($lastModTime = $this->buildSolutioncols()) {
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/solutioncols.xml', date("Y-m-d H:i:s", $lastModTime));
        }
        if ($lastModTime = $this->buildSolutions()) {
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/solutions.xml', date("Y-m-d H:i:s", $lastModTime));
        }

        // if ($lastModTime = $this->buildCustomercols()) {
        //     $sitemap->addSitemap(config('app.url') . '/storage/sitemap/sustomercols.xml', date("Y-m-d H:i:s", $lastModTime));
        // }
        if ($lastModTime = $this->buildCustomers()) {
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/customers.xml', date("Y-m-d H:i:s", $lastModTime));
        }

        if ($lastModTime = $this->buildUsers()) {
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/users.xml', date("Y-m-d H:i:s", $lastModTime));
        }
        // if ($lastModTime = $this->buildPages()) {
        //     $sitemap->addSitemap(config('app.url') . '/storage/sitemap/pages.xml', date("Y-m-d H:i:s", $lastModTime));
        // }
        // if ($lastModTimes = $this->buildArticles()) {
        //     foreach ($lastModTimes as $name => $time) {
        //         $sitemap->addSitemap(config('app.url') . '/storage/sitemap/articles-' . $name . '.xml', date("Y-m-d H:i:s", $time));
        //     }
        // }
        // if ($lastModTimes = $this->buildDiscussions()) {
        //     foreach ($lastModTimes as $name => $time) {
        //         $sitemap->addSitemap(config('app.url') . '/storage/sitemap/discussions-' . $name . '.xml', date("Y-m-d H:i:s", $time));
        //     }
        // }

        // create file sitemap.xml in your public folder (format, filename)
        $sitemap->store('sitemapindex', 'sitemap');
    }

}