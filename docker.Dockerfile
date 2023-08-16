FROM laravelphp/vapor:php82

# Add the `mysql` client...
RUN apk --update add mysql-client

COPY . /var/task