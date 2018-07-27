<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Request;
use App\Categories;
use App\Items;
use App\ItemsEvents;

class Sitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sitemap generation';

    protected $path;
    protected $siteName;
    protected $categories;
    protected $items;
    protected $itemsEvents;
    protected $mainPages;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->path = public_path();
        $this->siteName = Request::url();
        $this->mainPages = [
            ['loc' => $this->siteName, 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '1.0',],
            ['loc' => $this->siteName . '/' . 'trainer', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.9',],
//            ['loc' => $this->siteName . '/' . 'learner', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.9',],
//            ['loc' => $this->siteName . '/' . 'learner/about', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.8',],
//            ['loc' => $this->siteName . '/' . 'learner/training', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.8',],
//            ['loc' => $this->siteName . '/' . 'learner/questions', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.8',],
//            ['loc' => $this->siteName . '/' . 'learner/events', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.8',],
//            ['loc' => $this->siteName . '/' . 'learner/events/current', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Daily', 'priority' => '0.7',],
//            ['loc' => $this->siteName . '/' . 'learner/events/future', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Daily', 'priority' => '0.7',],
//            ['loc' => $this->siteName . '/' . 'learner/events/past', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Daily', 'priority' => '0.7',],
//            ['loc' => $this->siteName . '/' . 'learner/video/trenirovky', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
//            ['loc' => $this->siteName . '/' . 'learner/video/pitaniye', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
//            ['loc' => $this->siteName . '/' . 'learner/video/psikhologiya', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
//            ['loc' => $this->siteName . '/' . 'learner/experts/nutritionist', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
//            ['loc' => $this->siteName . '/' . 'learner/experts/fitness', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
//            ['loc' => $this->siteName . '/' . 'learner/experts/psychologist', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
//            ['loc' => $this->siteName . '/' . 'learner/experts/physical-therapist', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
            ['loc' => $this->siteName . '/' . 'trainer/about', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.9',],
            ['loc' => $this->siteName . '/' . 'trainer/training', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.9',],
            ['loc' => $this->siteName . '/' . 'trainer/events', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.9',],
            ['loc' => $this->siteName . '/' . 'trainer/questions', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.8',],
            ['loc' => $this->siteName . '/' . 'trainer/events/current', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Daily', 'priority' => '0.7',],
            ['loc' => $this->siteName . '/' . 'trainer/events/future', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Daily', 'priority' => '0.7',],
            ['loc' => $this->siteName . '/' . 'trainer/events/past', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Daily', 'priority' => '0.7',],
            ['loc' => $this->siteName . '/' . 'trainer/video', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.8',],
            ['loc' => $this->siteName . '/' . 'trainer/video/trenirovky', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
            ['loc' => $this->siteName . '/' . 'trainer/video/pitaniye', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
            ['loc' => $this->siteName . '/' . 'trainer/video/psikhologiya', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
            ['loc' => $this->siteName . '/' . 'trainer/experts/nutritionist', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
            ['loc' => $this->siteName . '/' . 'trainer/experts/fitness', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
            ['loc' => $this->siteName . '/' . 'trainer/experts/physical-therapist', 'lastmod' => date('Y-m-d', time()), 'changefreq' => 'Always', 'priority' => '0.7',],
        ];

        $this->categories = Categories::all();
        $categories = $this->categories->toArray();

        foreach ($categories as $key){
            $this->mainPages[] = [
                'loc' => $this->siteName . '/trainer/training/' . $key['alias'],
                'lastmod' => date('Y-m-d', time()),
                'changefreq' => 'Always',
                'priority' => '0.8'
            ];
            // $this->mainPages[] = [
            //     'loc' => $this->siteName . '/learner/training/' . $key['alias'],
            //     'lastmod' => date('Y-m-d', time()),
            //     'changefreq' => 'Always',
            //     'priority' => '0.8'
            // ];
        }


        $this->items = Items::with('category')->where('published', 1)->whereNotNull('alias')->get();

        $items = $this->items->toArray();
        foreach ($items as $key){
            if($key['role_id'] == 4){
                $pre = 'trainer';
            }else{
                $pre = 'learner';continue;
            }

            if($key['category']['alias'] === 'biblioteka'){
                continue;
            }
            $this->mainPages[] = [
                'loc' => $this->siteName . '/' . $pre . '/training/' . $key['category']['alias'] . '/' . $key['alias'],
                'lastmod' => date('Y-m-d', time()),
                'changefreq' => 'Weekly',
                'priority' => '0.6'
            ];
        }

        $this->itemsEvents = ItemsEvents::whereNotNull('alias')->get();
        $itemsEvents = $this->itemsEvents->toArray();

        foreach ($itemsEvents as $key){
            if($key['role_id'] == 4){
                $pre = 'trainer';
            }else{
                $pre = 'learner';continue;
            }
            $this->mainPages[] = [
                'loc' => $this->siteName . '/' . $pre . '/events/' . $key['alias'],
                'lastmod' => date('Y-m-d', time()),
                'changefreq' => 'Weekly',
                'priority' => '0.6'
            ];
        }

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sitemap = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($this->mainPages as $key){
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . $key['loc'] . '</loc>';
            $sitemap .= '<lastmod>' . $key['lastmod'] . '</lastmod>';
            $sitemap .= '<changefreq>' . $key['changefreq'] . '</changefreq>';
            $sitemap .= '<priority>' . $key['priority'] . '</priority>';
            $sitemap .= '</url>';

        }
        $sitemap .= '</urlset>';
        $this->setFile($sitemap);
    }

    private function setFile($sitemap)
    {
        if(file_exists($this->path . '/sitemap.xml'))
            @unlink($this->path . '/sitemap.xml');

        $fp = fopen($this->path . "/sitemap.xml", "w");
        fwrite($fp, $sitemap);
        fclose($fp);
    }
}
