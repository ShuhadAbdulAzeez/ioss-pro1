@extends('layouts.app')

@section('title', 'URL Shortener - Home')

@section('content')
<div class="main-content">
    <h1 style="text-align: center; margin-bottom: 2rem; color: #495057; font-size: 2.5rem; font-weight: 700;">
        Shorten Your URLs
    </h1>
    
    <p style="text-align: center; margin-bottom: 3rem; color: #6c757d; font-size: 1.1rem;">
        Create short, memorable links that are easy to share and track
    </p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <ul style="margin: 0; padding-left: 1rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('shortenedUrl'))
        <div class="url-card" style="background: #d4edda; border-color: #c3e6cb;">
            <h3 style="margin-bottom: 1rem; color: #155724;">✅ URL Shortened Successfully!</h3>
            <div class="url-original">
                <strong>Original URL:</strong><br>
                {{ session('shortenedUrl')->original_url }}
            </div>
            <div class="url-short">
                <strong>Shortened URL:</strong><br>
                <a href="{{ session('shortenedUrl')->short_url }}" target="_blank" style="color: #155724;">
                    {{ session('shortenedUrl')->short_url }}
                </a>
            </div>
            
            <div style="margin-top: 1rem;">
                <button class="copy-btn" onclick="copyToClipboard('{{ session('shortenedUrl')->short_url }}')">
                    📋 Copy URL
                </button>
            </div>
        </div>
    @endif

    <form action="{{ route('shorten') }}" method="POST" style="margin-bottom: 3rem;">
        @csrf
        <div class="form-group">
            <label for="original_url" class="form-label">Enter your long URL:</label>
            <input 
                type="url" 
                id="original_url" 
                name="original_url" 
                class="form-input" 
                placeholder="https://example.com/very-long-url-that-needs-to-be-shortened"
                value="{{ old('original_url') }}"
                required
            >
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%;">
            🔗 Shorten URL
        </button>
    </form>

    @if($recentUrls->count() > 0)
        <div style="border-top: 1px solid #e9ecef; padding-top: 2rem;">
            <h2 style="margin-bottom: 1.5rem; color: #495057; font-size: 1.5rem;">Recent URLs</h2>
            
            @foreach($recentUrls as $url)
                <div class="url-card">
                    <div class="url-original">
                        <strong>Original:</strong> {{ Str::limit($url->original_url, 80) }}
                    </div>
                    <div class="url-short">
                        <strong>Short:</strong> 
                        <a href="{{ $url->short_url }}" target="_blank">
                            {{ $url->short_url }}
                        </a>
                    </div>
                    <div class="url-stats">
                        <span>📅 {{ $url->created_at->diffForHumans() }}</span>
                        <span>👆 {{ $url->clicks }} clicks</span>
                    </div>
                    
                    <div style="margin-top: 1rem;">
                        <button class="copy-btn" onclick="copyToClipboard('{{ $url->short_url }}')">
                            📋 Copy
                        </button>
                    </div>
                </div>
            @endforeach

            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('stats') }}" class="btn btn-secondary">
                    📊 View All Statistics
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
