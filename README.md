# PHP Developer Technical Task

## Setup Instructions

1. Clone repository:
git clone https://github.com/gohar-niazi/php-task.git

2. Navigate to project:
cd php-task

3. Install dependencies:
composer install

4. Setup environment:
cp .env.example .env  
php artisan key:generate

5. Configure database in `.env`:
DB_DATABASE=php-task  
DB_USERNAME=root  
DB_PASSWORD=

6. Run migrations:
php artisan migrate

7. Start server:
php artisan serve

---

## API Endpoints

### Products
GET /api/products  
POST /api/products  
DELETE /api/products/{id}

### External API
GET /api/external-posts

### Web Scraping
GET /api/scrape-quotes

### Custom Request
GET /api/custom-request