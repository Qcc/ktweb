<?php

namespace App\Services;

use App;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\Column;
use App\Models\News;
use App\Models\Product;
use App\Models\Productcol;
use App\Models\Solution;
use App\Models\Solutioncol;
use App\Models\Topic;
use App\Models\User;
use App\Models\Customer;
use App\Models\Customercol;
use Roumen\Sitemap\Sitemap;

class SitemapService
{
    public function buildTopics()
    {
        $sitemap = App::make("sitemap");

        $sitemapName = '';
        $topicsData = [];

        Topic::public()->select(['id', 'created_at', 'updated_at'])->chunk(100, function ($topic) use (&$topicsData, &$sitemapName) {
            foreach ($categorys as $category) {
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
                $sitemap->add($_data['url'], date(DATE_RFC3339, $_data['lastmod']), '0.8', 'daily');
            }
            $info = $sitemap->store('xml','topics-' . $name, storage_path('app/public/sitemap'));
            $lastModTimes[$name] = $lastModTime;
            Log::info($info);
            $sitemap->model->resetItems();
        }
        return $lastModTimes;
    }

    public function buildDiscussions()
    {
        $sitemap = App::make("sitemap");

        $sitemapName = '';
        $discussionsData = [];

        Discussion::public()->select(['id', 'created_at', 'updated_at'])->chunk(100, function ($discussions) use (&$discussionsData, &$sitemapName) {
            foreach ($discussions as $discussion) {
                $sitemapName = date('Y-m', strtotime($discussion->created_at));
                $discussionsData[$sitemapName][] = [
                    'url' => route('discussion.show', ['id' => $discussion->id]),
                    'lastmod' => strtotime($discussion->updated_at)
                ];
            }
        });

        $lastModTimes = [];
        foreach ($discussionsData as $name => $data) {
            $lastModTime = 0;
            foreach ($data as $_data) {
                if ($_data['lastmod'] > $lastModTime) {
                    $lastModTime = $_data['lastmod'];
                }
                $sitemap->add($_data['url'], date(DATE_RFC3339, $_data['lastmod']), '0.8', 'daily');
            }
            $info = $sitemap->store('xml','discussions-' . $name, storage_path('app/public/sitemap'));
            $lastModTimes[$name] = $lastModTime;
            Log::info($info);
            $sitemap->model->resetItems();
        }
        return $lastModTimes;
    }

    public function buildPages()
    {
        $sitemap = App::make("sitemap");
        $lastModTime = 0;

        $pages = Page::public()->get(['id','slug','updated_at']);
        foreach ($pages as $page) {
            $pageLastModTime = strtotime($page->updated_at);
            if ($pageLastModTime > $lastModTime) {
                $lastModTime = $pageLastModTime;
            }
            $url = route('page.show', ['slug' => $page->slug]);
            $sitemap->add($url, date(DATE_RFC3339, strtotime($page->updated_at)), '0.6', 'weekly');
        }

        $info = $sitemap->store('xml','pages', storage_path('app/public/sitemap'));
        Log::info($info);
        return $lastModTime;
    }

    public function buildCategories()
    {
        $sitemap = App::make("sitemap");
        $lastModTime = 0;

        Category::with('parent')->public()->chunk(100, function ($categories) use ($sitemap, &$lastModTime) {
            foreach ($categories as $category) {
                $catLastModTime = strtotime($category->updated_at);
                if ($catLastModTime > $lastModTime) {
                    $lastModTime = $catLastModTime;
                }
                if ($category->parent_id == 0) {
                    $url = route('article.root.category', ['name' => $category->slug]);
                } else {
                    $url = route('article.category', ['name' => $category->parent->slug, 'subName' => $category->slug]);
                }
                $sitemap->add($url, date(DATE_RFC3339, strtotime($category->updated_at)), '0.5', 'weekly');
            }
        });

        $info = $sitemap->store('xml','categories', storage_path('app/public/sitemap'));
        Log::info($info);
        return $lastModTime;
    }

    public function buildTags()
    {
        $sitemap = App::make("sitemap");
        $lastModTime = 0;

        Tag::chunk(100, function ($tags) use ($sitemap, &$lastModTime) {
            foreach ($tags as $tag) {
                $tagLastModTime = strtotime($tag->updated_at);
                if ($tagLastModTime > $lastModTime) {
                    $lastModTime = $tagLastModTime;
                }
                $url = route('article.tags', ['name' => $tag->slug]);
                $sitemap->add($url, date(DATE_RFC3339, strtotime($tag->updated_at)), '0.5', 'weekly');
            }
        });

        $info = $sitemap->store('xml','tags', storage_path('app/public/sitemap'));
        Log::info($info);
        return $lastModTime;
    }

    public function buildHome()
    {
        $sitemap = App::make("sitemap");
        $sitemap->add(config('app.url'), date(DATE_RFC3339, time()), '1.0', 'daily');
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
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/home.xml', date(DATE_RFC3339, time()));
        }
        if ($lastModTime = $this->buildTags()) {
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/tags.xml', date(DATE_RFC3339, $lastModTime));
        }
        if ($lastModTime = $this->buildCategories()) {
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/categories.xml', date(DATE_RFC3339, $lastModTime));
        }
        if ($lastModTime = $this->buildPages()) {
            $sitemap->addSitemap(config('app.url') . '/storage/sitemap/pages.xml', date(DATE_RFC3339, $lastModTime));
        }
        if ($lastModTimes = $this->buildArticles()) {
            foreach ($lastModTimes as $name => $time) {
                $sitemap->addSitemap(config('app.url') . '/storage/sitemap/articles-' . $name . '.xml', date(DATE_RFC3339, $time));
            }
        }
        if ($lastModTimes = $this->buildDiscussions()) {
            foreach ($lastModTimes as $name => $time) {
                $sitemap->addSitemap(config('app.url') . '/storage/sitemap/discussions-' . $name . '.xml', date(DATE_RFC3339, $time));
            }
        }

        // create file sitemap.xml in your public folder (format, filename)
        $sitemap->store('sitemapindex', 'sitemap');
    }

}