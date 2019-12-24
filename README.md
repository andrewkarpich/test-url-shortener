

http://localhost:8080/ - frontend

http://localhost:8081/ - backend



Development
-----------

**Local docker**

Start: `docker-compose up`

Stop: `docker-compose stop`

Restart container: `docker-compose restart <CONTAINER_NAME>`

Exec in container: `docker exec -it <CONTAINER_ID> bash`


-----------

**Phinx**

Create migration (see in `apps/backend/database/migrations`):

`
docker exec -it bc_backend php vendor/bin/phinx create <NewMigrationName>
`

Migrate:

`
docker exec -it bc_backend php vendor/bin/phinx migrate -e default
`

-----------

**Phalcon dev tools**

`
docker exec -it bc_backend php vendor/phalcon/devtools/phalcon.php <Commands>
`

Example

`
docker exec -it bc_backend php vendor/phalcon/devtools/phalcon.php info
`

-----------

**Php Unit**

`
docker exec -it bc_backend php vendor/phpunit/phpunit/phpunit <Commands>
`

-----------
