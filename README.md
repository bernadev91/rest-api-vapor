## API documentation

Note: it's important to include the `Accept: application/json` header to all API requests to make sure that Laravel's validation will return the errors in JSON format.

### `GET /users` ###

Returns a list of all users.

### `GET /users/{id}` ###

Returns a specific user by ID.

### `POST /users` ###

Input format: JSON payload.

Required fields: `email`, `name`, `password`, `password_confirmation`. The email must be unique, the name must be between 3 and 255 characters in length. Both passwords must be the same and be 8 characters long or more.

### `PUT /users/{id}` ###

Updates an existing user by ID.

Input format: JSON payload.

Available fields: `email`, `name`. If one field is not present, it won't update that value. If the email changes, it must be unique.

### `DELETE /users/{id}` ###

Deletes a user by ID.

## Setting up the project to work locally

Make sure the .env file is pointing to the right database and the queue is connected to the Redis cache server.