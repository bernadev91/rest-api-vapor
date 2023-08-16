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

Make sure the .env file is pointing to the right database and the queue is connected to the Redis cache server, or use the "sync" driver if you don't need to test the Queue locally.

## Explanation of what has been done

A free sandbox account has been created for this project, with an Amazon RDS database attached to it, and a Redis cache server. The build environment has been set up to use Docker instead of the native runtime to follow the task requirements.

For the users table, the Laravel Sanctum structure has been used.

The endpoints are very simple, and no extra complexity has been added to them because it hasn't been requested. The input is validated using Laravel Form Requests. The API calls need to attach the `Accept: application/json` header so that the error messages are returned in JSON format, otherwise Laravel will think they're being sent from a web form and will try to redirect back, creating an infinite redirection with no output as a result.

The requirements specified that a Queue worker should be implemented to handle background jobs. Redis is used for that, and the only background task is sending a fictional Welcome email when a new user is created. Setting up Amazon SES with a domain was considered out of the scope of the task, so the code that actually sends the email is commented out. A field called `sent_welcome_at` has been added to the `users` table to verify when the email would have been sent. The email is sent 1 minute after the user is created, to test that the Queue is actually running in the background, and not running synchronously.