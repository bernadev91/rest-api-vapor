## API documentation

`GET /users: Returns a list of all users.`
`GET /users/{id}: Returns a specific user by ID.`
`POST /users: Creates a new user.`

Required fields: `email`, `name`, `password`, `password_confirmation`. The email must be unique, the name must be between 3 and 255 characters in length. Both passwords must be the same and be 8 characters long or more.

`PUT /users/{id}: Updates an existing user by ID.`

Available fields: `email`, `name`. If one field is not present, it won't update that value. If the email changes, it must be unique.

`DELETE /users/{id}: Deletes a user by ID.`

## Setting up the project to work locally

Make sure the .env file is pointing to the right database and the queue is connected to the Redis cache server.