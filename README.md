# Overview
This is a site where you can conveniently access applications made and used by [Living goods](https://livinggoods.org/)

# Instalation
## 1. Clone the repository.
```
git clone https://github.com/livinggoods/landing-page.git
```

## 2. Checkout master.
```
git checkout master
```

# Deploying.
## 1. Create a database and its tables.

### Create database.
In MySql run the command.
```
CREATE DATABASE landingpage;
```

Use the landing page Database.
```
USE landingpage;
```

### Create tables
Create the links table with the following columns.
* id
* url
* name
```
CREATE TABLE links (id INT, url VARCHAR(50), name VARCHAR(20));
```

Create the categories table, with the following columns.
* id
* name
* priority
```
CREATE TABLE categories (id INT NOT NULL, name VARCHAR(20), priority INT NOT NULL);
```

Create the application table, with the following columns.
* name
* image
* description
* category
* id
* priority
```
CREATE TABLE application (name VARCHAR(20), image VARCHAR(20), description TEXT, category INT, id INT, priority INT);
```

## Access to the database
First rename
```
sqlConnection.tmp.php
```
to
```
sqlConnection.php
```

In the `sqlConnection.php` file, add the neccessary details that will give you access to the landing page database.

The details needed are:
* Username
* Password
* Servername or ip address
* Database name

## Images
Create an images folder at the root of the project and name it "img".
```
mkdir img
```

put all your images in this folder.

## npm modules
You will need to install node js and npm first

1. First install nodejs
```
$ sudo apt-get update
$ sudo apt-get install nodejs
```

2. Next install npm
```
$ sudo apt-get install npm
```

### Install bootstrap with npm
```
$ npm install bootstrap@4.0.0-alpha.6
```

### Install font-awesome with npm
```
$ npm install font-awesome
```

### Install optiscroll for custom scroll bars
```
$ npm install optiscroll
```