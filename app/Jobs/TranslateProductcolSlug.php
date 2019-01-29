<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Productcol;
use App\Handlers\SlugTranslateHandler;

class TranslateProductcolSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $productcol;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Productcol $productcol)
    {
        $this->productcol = $productcol;
    }

    /**
     * 执行队列任务.
     *
     * @return void
     */
    public function handle()
    {
        // 请求百度 API 接口进行翻译
        $slug = app(SlugTranslateHandler::class)->translate($this->productcol->name);

        //未来避免模型监控器死循环调用，使用DB类直接对数据库进行操作
        //任务中要避免使用 Eloquent 模型接口调用，如：create(), update(), save() 等操作。
        //否则会陷入调用死循环 —— 模型监控器分发任务，任务触发模型监控器，模型监控器再次分发任务，
        //任务再次触发模型监控器.... 死循环。在这种情况下，使用 DB 类直接对数据库进行操作即可。
        \DB::table('productcols')->where('id',$this->productcol->id)->update(['slug' => $slug]);
    }
}
