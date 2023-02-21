# Server Side Development

## Requirement

- Docker Desktop

## Directory Structure

```bash
.
├── README.md
├── api
├── config
│   ├── mysql
│   │   ├── data
│   │   └── my.cnf
│   └── web
│       └── Dockerfile
├── docker-compose.yml
```

## Installation

```bash
# Create images
$ docker build -t lamp:8.0.13-apache ./config/web
```

## Development

```bash
# Start up containers
$ docker compose up -d

# Stop containers
$ docker compose stop
```

## Create a database in MySQL

```bash
# Run bash in the mysql container
$ docker exec -it mysql bash

# Log in MySQL
$ mysql -u root -p

# Create customers table
CREATE TABLE customers(
  customer_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  customer_name VARCHAR(50) NOT NULL,
  customer_email VARCHAR(256) NOT NULL
);

INSERT INTO customers VALUES (NULL, 'Your Name', 'you@example.com');

# Create bookings table
CREATE TABLE bookings(
  booking_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  customer_id INT NOT NULL,
  booking_date DATE NOT NULL,
  FOREIGN KEY (customer_id) REFERENCES customers (customer_id)
);

INSERT INTO bookings VALUES (NULL, 1, '2023-03-01');

# Quit MySQL
mysql> quit
```
