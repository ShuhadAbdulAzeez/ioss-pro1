#!/bin/bash

echo "🚀 Starting URL Shortener Deployment..."

# Build the Docker image
echo "📦 Building Docker image..."
docker build -t url-shortener .

# Stop existing containers
echo "🛑 Stopping existing containers..."
docker-compose down

# Start the application
echo "▶️ Starting application..."
docker-compose up -d

# Wait for the application to be ready
echo "⏳ Waiting for application to start..."
sleep 10

# Check if the application is running
if curl -f http://localhost:8000 > /dev/null 2>&1; then
    echo "✅ Application deployed successfully!"
    echo "🌐 Access your URL Shortener at: http://localhost:8000"
else
    echo "❌ Application failed to start. Check logs with: docker-compose logs"
fi
