
## Test task API

### Command:
>php artisan migrate

>php artisan db:seed

## Route list

### Create Collection
> POST /api/v1/collection/create/

### Create Contributor
> POST /api/v1/{collection_id}/collection/create/

### Get all Collections
> GET /api/v1/collections/

### Get detail Collection (with Contributors)
> GET /api/v1/collection/{id}/

### Get list of Collection
> GET /api/v1/collection/filter/{filter}/

We can filter collection (target_amount <=> x and order by sum desc or asc)

For example: /api/v1/collections/filter/target_amount=>10000&order=desc

or

/api/v1/collections/filter/order=desc

or

/api/v1/collections/filter/target_amount=<10000
