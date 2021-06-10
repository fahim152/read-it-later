<?php

namespace App\Http\Controllers\Api;

use App\Pocket;
use App\PocketContent;
use Illuminate\Http\Request;
use App\Events\WebUrlCrawled;
use App\Services\CrawlerService;
use App\Http\Controllers\Controller;
use App\Services\UrlValidationTrait;
use Symfony\Component\DomCrawler\Crawler;

class PocketController extends Controller
{
    use UrlValidationTrait, CrawlerService;

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);

        $pocket = Pocket::updateOrCreate([
            'user_id' => auth()->user()->id,
            'title'   => $request->title
        ]);

        return response()->json([$pocket]);
    }

    public function storeContents(Request $request, $id)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $urlValidation = self::validateUrl($request->url);
        if ($urlValidation['success'] == false) {
            return $urlValidation;
        }

        $pocket = Pocket::where('user_id', auth()->user()->id)->where('id', $request->id)->first();

        if (!$pocket) {
            return response()->json(['success' => false, 'error_code' => 'JXTNL3', 'message' => 'No pocket found with this ID or you may not authenticate to use others pocket']);
        }

        $pocketContent = PocketContent::updateOrCreate([
            'pocket_id'  => $pocket->id,
            'url'        => $request->url
        ]);
        event(new WebUrlCrawled($pocketContent, self::getCrawledData($pocketContent->url)));
        return response()->json([$pocketContent]);
    }


    public function viewContents($id)
    {
        $pocket = Pocket::with('contents')->where('user_id', auth()->user()->id)->where('id', $id)->first();
        if (! $pocket) {
            return response()->json(['success' => false, 'error_code' => 'KTTNS1', 'message' => 'No pocket found with this ID']);
        }

        if(count($pocket->contents) == 0) {
            return response()->json(['success' => false, 'error_code' => 'ZUNS1', 'message' => 'No contents found on this pocket']);
        }

        return response()->json([$pocket]);
    }

    public function deleteContent($id) {

        $content = PocketContent::whereHas('pocket', function($query) {
            $query->where('user_id', auth()->user()->id);
        })->where('id', $id)->first();

        if(! $content) {
            return response()->json(['success' => false, 'error_code' => 'E3V3B5', 'message' => 'No contents found on this pocket']);
        }

        if($content->delete()) {
            return response()->json(['success' => true,  'message' => 'Content deleted Successfully']);
        }

    }

    public  function test()
    {
        $html = file_get_contents('https://www.prothomalo.com/bangladesh/coronavirus/%E0%A6%95%E0%A6%B0%E0%A7%8B%E0%A6%A8%E0%A6%BE%E0%A7%9F-%E0%A6%AE%E0%A7%83%E0%A6%A4%E0%A7%8D%E0%A6%AF%E0%A7%81-%E0%A6%B6%E0%A6%A8%E0%A6%BE%E0%A6%95%E0%A7%8D%E0%A6%A4-%E0%A6%B9%E0%A6%BE%E0%A6%B0-%E0%A6%B8%E0%A6%AC%E0%A6%87-%E0%A6%AC%E0%A7%87%E0%A7%9C%E0%A7%87%E0%A6%9B%E0%A7%87');
        $crawler = new Crawler($html);
        $title = $crawler->filterXPath('//title')->text();
        $image =  $crawler->filterXPath("//meta[@property='og:image']")->attr('content');
        $desc =  $crawler->filterXPath("//meta[@property='og:description']")->attr('content');



    }
}
