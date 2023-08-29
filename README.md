
## Test task API

### Initial project:
>composer install

>cp .env.example .env

>php artisan key:generate

>php artisan migrate

Fill in database test data

>php artisan db:seed

Generate token for POST API methods

>php artisan token:generate

## Testing

> cp .env.testing.example .env.testing
 
> php artisan key:generate --env=testing

> php artisan migrate --env=testing

>php artisan test 

### Web Interface

>After seeding login with e-mail "test@example.com" and password "password"

## Route list

### Create Collection
Protect by token, for generating token use "php artisan token:generate"
> POST /api/v1/collection/create/

### Create Contributor
Protect by token, for generating token use "php artisan token:generate"
> POST /api/v1/{collection_id}/collection/create/

### Get all Collections
> GET /api/v1/collections/

### Get detail Collection (with Contributors)
> GET /api/v1/collection/{id}/

### Get all Collections with remainder
> GET /api/v1/collections-with-remainder/

### Get all Collections with remainder where remainder less than {sum}
> GET /api/v1/collections-with-remainder/less/{sum}/

### Get list of Collection with filter by sum and order by sum
> GET /api/v1/collections/filter/{filter}/

We can filter collection (target_amount <=> x and order by sum desc or asc)

For example: /api/v1/collections/filter/target_amount=>10000&order=desc

or

/api/v1/collections/filter/order=desc

or

/api/v1/collections/filter/target_amount=<10000
