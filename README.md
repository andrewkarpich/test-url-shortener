

http://localhost:8080/



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
docker exec -it t_backend php vendor/bin/phinx create <NewMigrationName>
`

Migrate:

`
docker exec -it t_backend php vendor/bin/phinx migrate -e default
`

-----------

**Phalcon dev tools**

`
docker exec -it t_backend php vendor/phalcon/devtools/phalcon.php <Commands>
`

Example

`
docker exec -it t_backend php vendor/phalcon/devtools/phalcon.php info
`

-----------
