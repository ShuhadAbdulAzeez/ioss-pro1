@extends('layouts.app')

@section('title', 'URL Shortener - Statistics')

@section('content')
<div class="main-content">
    <h1 style="text-align: center; margin-bottom: 2rem; color: #495057; font-size: 2.5rem; font-weight: 700;">
        📊 URL Statistics
    </h1>
    
    <p style="text-align: center; margin-bottom: 3rem; color: #6c757d; font-size: 1.1rem;">
        Track your shortened URLs and their performance
    </p>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $totalUrls }}</div>
            <div class="stat-label">Total URLs Created</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalClicks }}</div>
            <div class="stat-label">Total Clicks</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalUrls > 0 ? round($totalClicks / $totalUrls, 1) : 0 }}</div>
            <div class="stat-label">Average Clicks per URL</div>
        </div>
    </div>

    @if($urls->count() > 0)
        <h2 style="margin-bottom: 1.5rem; color: #495057; font-size: 1.5rem;">All URLs (Sorted by Clicks)</h2>
        
        @foreach($urls as $url)
            <div class="url-card">
                <div class="url-original">
                    <strong>Original URL:</strong><br>
                    {{ $url->original_url }}
                </div>
                <div class="url-short">
                    <strong>Shortened URL:</strong><br>
                    <a href="{{ $url->short_url }}" target="_blank">
                        {{ $url->short_url }}
                    </a>
                </div>
                <div class="url-stats">
                    <span>📅 Created: {{ $url->created_at->format('M j, Y g:i A') }}</span>
                    <span>👆 {{ $url->clicks }} clicks</span>
                    <span>🆔 Code: {{ $url->short_code }}</span>
                </div>
                
                <div style="margin-top: 1rem;">
                    <button class="copy-btn" onclick="copyToClipboard('{{ $url->short_url }}')">
                        📋 Copy
                    </button>
                </div>
            </div>
        @endforeach
    @else
        <div style="text-align: center; padding: 3rem; color: #6c757d;">
            <h3 style="margin-bottom: 1rem;">No URLs created yet</h3>
            <p>Start by creating your first shortened URL!</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: 1rem;">
                🔗 Create First URL
            </a>
        </div>
    @endif

    <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ route('home') }}" class="btn btn-secondary">
            🏠 Back to Home
        </a>
    </div>
</div>
@endsection
