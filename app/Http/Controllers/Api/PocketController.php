<?php

namespace App\Http\Controllers\Api;

use App\Pocket;
use App\PocketContent;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UrlValidationTrait;

class PocketController extends Controller
{
    use UrlValidationTrait;

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);

        $pocket = Pocket::create([
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
            return response()->json(['success' => false, 'error_code' => 'JXTNL3', 'message' => 'No pocket found with this ID']);
        }

        $pocketContent = PocketContent::updateOrCreate([
            'pocket_id'  => $pocket->id,
            'url'        => $request->url
        ]);

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
}
