# 🔗 URL Shortener

A modern, feature-rich URL shortener built with Laravel. Create short, memorable links that are easy to share and track.

## ✨ Features

- **URL Shortening**: Convert long URLs into short, memorable links
- **Click Tracking**: Monitor how many times each shortened URL is accessed
- **Modern UI**: Beautiful, responsive design with custom CSS
- **Statistics Dashboard**: View detailed analytics and performance metrics
- **Copy to Clipboard**: One-click copying of shortened URLs
- **Recent URLs**: View your recently created shortened URLs
- **Database Storage**: Persistent storage using SQLite (easily configurable for other databases)

## 🚀 Quick Start

### Option 1: Using Docker (Recommended)

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd ioss-pro1
   ```

2. **Start the application**
   ```bash
   # Using the deployment script (recommended)
   chmod +x deploy.sh
   ./deploy.sh
   
   # Or manually
   docker-compose up -d --build
   ```

3. **Access the application**
   Open your browser and navigate to: `http://localhost:8000`

### Option 2: Local Development

1. **Install dependencies**
   ```bash
   composer install
   ```

2. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Run migrations**
   ```bash
   php artisan migrate
   ```

4. **Start the development server**
   ```bash
   php artisan serve
   ```

5. **Access the application**
   Open your browser and navigate to: `http://localhost:8000`

## 📊 Usage

### Creating Shortened URLs

1. Visit the home page
2. Enter a long URL in the input field
3. Click "Shorten URL"
4. Copy the generated short URL

### Viewing Statistics

1. Click "Statistics" in the navigation
2. View overall metrics (total URLs, total clicks, average clicks)
3. Browse all shortened URLs sorted by popularity

### Using Shortened URLs

- Simply visit the shortened URL (e.g., `http://localhost:8000/abc123`)
- You'll be automatically redirected to the original URL
- Click tracking is updated automatically

## 🛠️ Technical Details

### Database Schema

The application uses a simple database structure:

```sql
shortened_urls
├── id (Primary Key)
├── original_url (Text)
├── short_code (String, Unique)
├── clicks (Integer, Default: 0)
├── created_at (Timestamp)
└── updated_at (Timestamp)
```

### API Endpoints

- `GET /` - Home page with URL shortening form
- `POST /shorten` - Create a new shortened URL
- `GET /stats` - Statistics dashboard
- `GET /{shortCode}` - Redirect to original URL

### Features Implemented

✅ **Core Functionality**
- URL shortening with unique 6-character codes
- Automatic redirection to original URLs
- Click tracking and analytics

✅ **User Experience**
- Modern, responsive design
- Form validation with error messages
- Success notifications
- Copy-to-clipboard functionality
- Recent URLs display

✅ **Statistics & Analytics**
- Total URLs created
- Total clicks across all URLs
- Average clicks per URL
- Individual URL performance tracking

✅ **Deployment Ready**
- Docker configuration
- Nginx web server
- PHP-FPM setup
- One-command deployment

## 🐳 Docker Commands

```bash
# Build and start containers
docker-compose up -d --build

# View logs
docker-compose logs -f

# Stop containers
docker-compose down

# Rebuild containers
docker-compose up -d --build

# Check container status
docker-compose ps
```

## 🔧 Configuration

### Environment Variables

The application uses Laravel's standard environment configuration. Key variables:

- `APP_URL` - Your application's base URL
- `DB_CONNECTION` - Database connection (default: sqlite)
- `DB_DATABASE` - Database file path (for SQLite)

### Database Configuration

By default, the application uses SQLite for simplicity. To use other databases:

1. Update `.env` file with your database credentials
2. Update `config/database.php` if needed
3. Run migrations: `php artisan migrate`

## 🚨 Troubleshooting

### Docker Build Issues

If you encounter build errors:

1. **Clear Docker cache:**
   ```bash
   docker system prune -a
   ```

2. **Rebuild without cache:**
   ```bash
   docker-compose build --no-cache
   ```

3. **Check logs:**
   ```bash
   docker-compose logs
   ```

### Permission Issues

If you encounter permission errors:

```bash
# Fix file permissions
sudo chown -R $USER:$USER .
chmod -R 755 storage bootstrap/cache
```

### Database Issues

If the database isn't working:

```bash
# Recreate the database
rm database/database.sqlite
touch database/database.sqlite
php artisan migrate
```

## 📱 Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Support

If you encounter any issues or have questions:

1. Check the documentation above
2. Review the Laravel logs
3. Open an issue on GitHub

---

**Built with ❤️ using Laravel**
