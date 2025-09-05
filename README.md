## Design decisions

### Models and relationships:

Basic — many-to-many: ServiceProvider relation Category.

### Database schema:

Categories: id, name, slug (unique, indexed), timestamps.

ServiceProviders: id, name, slug (unique, indexed), short_description (text), timestamps.

Files: id, attachable_type, attachable_id, collection (string), path (string), original_name (string), mime_type (string), size (integer), width (integer), height (integer), timestamps.

### Eloquent relationships:

Category hasMany ServiceProvider.

ServiceProvider belongsToMany Category.

ServiceProvider morphOne File (for logo, collection='logo').

### Controllers:

ServiceProviderController with index() and show() methods.

### Routes:

GET /providers — listing with optional category filter (e.g., /providers?category=web-design).

GET /providers/{provider:slug} — detail page.

### Views:

Blade templates with Bootstrap 5 for responsive design.

### Seeding and tests:

Factory для Category, ServiceProvider, File; seed DemoSeeder for initial data.

Feature tests for filtering, list display, and absence of N+1 queries (counting queries via DB::listen).

### Infrastructure:

Docker Compose (PHP-FPM/Nginx inside SAIL container), MySQL 8, Redis, Mailpit.

APP_URL and storage:link configured for local dev.

### Performance optimizations

#### TTFB / Backend

Eager loading + indexes on categories.slug, service_providers.slug, and category_id.

Caching in Redis: lists (keys include filters and pagination), reference data (categories), and profiles.

HTTP caching for pages: Cache-Control: public, s-maxage=120 + ETag (conditional responses).

Optimization Laravel: config:cache, route:cache, view:cache, dump-autoload.
