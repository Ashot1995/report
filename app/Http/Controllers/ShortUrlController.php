<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortLinkRequest;
use App\Models\ShortLink;
use App\Models\User;
use App\Services\DownloadCsvService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ShortUrlController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function indexAction()
    {
        $shortLinks = ShortLink::latest()->with('user')->where('user_id', Auth::id())->get();

        return view('shortLink.shortenLink', compact('shortLinks'));
    }

    /**
     * @param ShortLinkRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function storeAction(ShortLinkRequest $request)
    {
        $input['link'] = $request->link;
        $input['code'] = substr(md5(mt_rand()), 0, 5);
        $input['user_id'] = Auth::id();

        ShortLink::create($input);

        return redirect('generate-shorten-link')
            ->with('success', 'Shorten link generated successfully!');
    }

    /**
     * @param string $code
     * @return Application|RedirectResponse|Redirector
     */
    public function shortenLinkAction(string $code)
    {
        $find = ShortLink::getByCode($code)->first();

        return redirect($find->link);
    }

    public function downloadCsvAction(DownloadCsvService $downloadCsvService)
    {
        dd(33);
        $userInfo = User::with('links')->get();
        $downloadCsvService->download($userInfo,'test.csv');
    }
}
