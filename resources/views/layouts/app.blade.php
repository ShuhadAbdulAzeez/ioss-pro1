<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'URL Shortener')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #2d3748;
            line-height: 1.6;
            font-size: 16px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 1.25rem 0;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2d3748;
            text-decoration: none;
            letter-spacing: -0.025em;
        }

        .logo:hover {
            color: #4a5568;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
        }

        .nav-links a {
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            padding: 0.5rem 0;
            border-bottom: 2px solid transparent;
        }

        .nav-links a:hover {
            color: #2d3748;
            border-bottom-color: #3182ce;
        }

        .main-content {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            padding: 3rem;
            margin-bottom: 2.5rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 600;
            color: #2d3748;
            font-size: 0.95rem;
            letter-spacing: 0.025em;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.2s ease;
            background: #fafafa;
        }

        .form-input:focus {
            outline: none;
            border-color: #3182ce;
            background: white;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        }

        .form-input::placeholder {
            color: #a0aec0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            font-family: inherit;
            letter-spacing: 0.025em;
            min-height: 48px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3182ce 0%, #2c5aa0 100%);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(49, 130, 206, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2c5aa0 0%, #1a365d 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px -1px rgba(49, 130, 206, 0.4);
        }

        .btn-secondary {
            background: #4a5568;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(74, 85, 104, 0.3);
        }

        .btn-secondary:hover {
            background: #2d3748;
            transform: translateY(-1px);
            box-shadow: 0 6px 12px -1px rgba(74, 85, 104, 0.4);
        }

        .alert {
            padding: 1.25rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            border: 1px solid;
            font-weight: 500;
        }

        .alert-success {
            background: #f0fff4;
            color: #22543d;
            border-color: #9ae6b4;
        }

        .alert-error {
            background: #fed7d7;
            color: #742a2a;
            border-color: #feb2b2;
        }

        .url-card {
            background: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            transition: all 0.2s ease;
            position: relative;
        }

        .url-card:hover {
            box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 10px -5px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
            border-color: #cbd5e0;
        }

        .url-original {
            color: #4a5568;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            word-break: break-all;
            line-height: 1.5;
            background: #edf2f7;
            padding: 0.75rem;
            border-radius: 6px;
            border-left: 4px solid #e2e8f0;
        }

        .url-short {
            color: #2d3748;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .url-short a {
            color: #3182ce;
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            background: rgba(49, 130, 206, 0.1);
            display: inline-block;
            transition: all 0.2s ease;
            border: 1px solid rgba(49, 130, 206, 0.2);
        }

        .url-short a:hover {
            background: rgba(49, 130, 206, 0.15);
            border-color: rgba(49, 130, 206, 0.3);
            transform: translateY(-1px);
        }

        .url-stats {
            display: flex;
            gap: 1.5rem;
            font-size: 0.875rem;
            color: #4a5568;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .url-stats span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .copy-btn {
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(56, 161, 105, 0.3);
        }

        .copy-btn:hover {
            background: linear-gradient(135deg, #2f855a 0%, #276749 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px -1px rgba(56, 161, 105, 0.4);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: linear-gradient(135deg, #3182ce 0%, #2c5aa0 100%);
            color: white;
            padding: 1.5rem 1rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 8px 20px -5px rgba(49, 130, 206, 0.3);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            pointer-events: none;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        .footer {
            text-align: center;
            padding: 3rem 0;
            color: #4a5568;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            margin-top: 3rem;
        }

        h1, h2, h3 {
            color: #2d3748;
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        h2 {
            font-size: 1.875rem;
            margin-bottom: 1.5rem;
        }

        h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        a {
            color: #3182ce;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        a:hover {
            color: #2c5aa0;
            text-decoration: underline;
        }

        p {
            color: #4a5568;
            line-height: 1.7;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }

            .main-content {
                padding: 2rem 1.5rem;
            }

            .nav {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                gap: 1.5rem;
            }

            .url-stats {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 1.5rem 1rem;
            }

            .url-card {
                padding: 1.5rem;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href="{{ route('home') }}" class="logo">🔗 URL Shortener</a>
                <div class="nav-links">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('stats') }}">Statistics</a>
                </div>
            </nav>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} URL Shortener. Built with Laravel.</p>
        </div>
    </footer>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Create a temporary notification instead of alert
                const notification = document.createElement('div');
                notification.textContent = 'URL copied to clipboard!';
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: #38a169;
                    color: white;
                    padding: 1rem 1.5rem;
                    border-radius: 8px;
                    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
                    z-index: 1000;
                    font-weight: 500;
                    animation: slideIn 0.3s ease;
                `;
                
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 2000);
            }, function(err) {
                console.error('Could not copy text: ', err);
                alert('Failed to copy URL. Please try again.');
            });
        }

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
