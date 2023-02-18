# LAMP with Docker

##　 Directory Structure

```shell
.
├── README.md
├── config
│   ├── mysql
│   │   ├── data
│   │   └── my.cnf
│   └── web
│       └── Dockerfile
├── docker-compose.yml
└── html
    └── index.php
```

## Main Procedure

```shell
# Create images
$ docker build -t lamp:8.0.13-apache ./config/web

# Start up containers
$ docker compose up -d

# Run bash in the mysql container
$ docker exec -it mysql bash

# Log in MySQL
$ mysql -u root -p

# Quit MySQL
mysql> quit

# Stop containers
$ docker-compose stop
```
