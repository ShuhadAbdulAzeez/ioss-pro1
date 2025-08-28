<?php

namespace App\Http\Controllers;

use App\Models\ShortenedUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlShortenerController extends Controller
{
    /**
     * Show the URL shortener form
     */
    public function index()
    {
        $recentUrls = ShortenedUrl::orderBy('created_at', 'desc')->take(10)->get();
        return view('url-shortener.index', compact('recentUrls'));
    }

    /**
     * Create a new shortened URL
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'original_url' => 'required|url'
        ], [
            'original_url.required' => 'Please enter a URL to shorten.',
            'original_url.url' => 'Please enter a valid URL.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $shortenedUrl = ShortenedUrl::create([
            'original_url' => $request->original_url,
            'short_code' => ShortenedUrl::generateShortCode(),
        ]);

        return redirect()->back()
            ->with('success', 'URL shortened successfully!')
            ->with('shortenedUrl', $shortenedUrl);
    }

    /**
     * Redirect to the original URL
     */
    public function redirect($shortCode)
    {
        $shortenedUrl = ShortenedUrl::where('short_code', $shortCode)->first();

        if (!$shortenedUrl) {
            abort(404, 'Shortened URL not found.');
        }

        $shortenedUrl->incrementClicks();

        return redirect($shortenedUrl->original_url);
    }

    /**
     * Show URL statistics
     */
    public function stats()
    {
        $urls = ShortenedUrl::orderBy('clicks', 'desc')->get();
        $totalUrls = ShortenedUrl::count();
        $totalClicks = ShortenedUrl::sum('clicks');

        return view('url-shortener.stats', compact('urls', 'totalUrls', 'totalClicks'));
    }

    /**
     * API: Get recent URLs
     */
    public function apiRecent()
    {
        $recentUrls = ShortenedUrl::orderBy('created_at', 'desc')->take(10)->get();
        
        return response()->json([
            'success' => true,
            'data' => $recentUrls
        ]);
    }

    /**
     * API: Get URL shortener index data
     */
    public function apiIndex()
    {
        $recentUrls = ShortenedUrl::orderBy('created_at', 'desc')->take(10)->get();
        
        return response()->json([
            'success' => true,
            'data' => [
                'recent_urls' => $recentUrls
            ]
        ]);
    }

    /**
     * API: Create a new shortened URL
     */
    public function apiStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'original_url' => 'required|url'
        ], [
            'original_url.required' => 'Please enter a URL to shorten.',
            'original_url.url' => 'Please enter a valid URL.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $shortenedUrl = ShortenedUrl::create([
            'original_url' => $request->original_url,
            'short_code' => ShortenedUrl::generateShortCode(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'URL shortened successfully!',
            'data' => $shortenedUrl
        ], 201);
    }

    /**
     * API: Get URL statistics
     */
    public function apiStats()
    {
        $urls = ShortenedUrl::orderBy('clicks', 'desc')->get();
        $totalUrls = ShortenedUrl::count();
        $totalClicks = ShortenedUrl::sum('clicks');

        return response()->json([
            'success' => true,
            'data' => [
                'urls' => $urls,
                'total_urls' => $totalUrls,
                'total_clicks' => $totalClicks
            ]
        ]);
    }
}
