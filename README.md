# Read Me Later
> Copy link and put in your pocket, read it later. Thank me now ! 😉 

### Table of Contents

- [Description](#description)
- [How to install](#how-to-install)
- [Api Documentation](#api-documentation)
- [References](#references)

---

## Description
This is a simple Restful API backend project for creating a pocket like space where users' can put their links, fetch their saved pockets and delete contents as well. Also the landing of the project shows pockets saved by other users as well. When saving a pocket the system will try to crawl and get title, image, and description from the site and save it to the database. which will be shown on the landing afterwords.

---
## How to install
Clone the project, make sure you gave composer install on your machine. Go to the project directory, and use cli tool to run following commands.

```
composer install
```

make a copy of .env.example and rename it to .env . Make sure to edit the database name, username and password. Also change,
```
QUEUE_CONNECTION=database
```

After that, run, 
```
php artisan migrate
```

```
php artisan passport:install
```
```
php artisan serve
```
last command will run your http://localhost:8000 by default ( if the port is empty). Then keep running queue command, 
```
php artisan queue:work
```
Or, If you have pm2 install in your machine simply use,

```
pm2 start ecosystem.queue.config.js 
```

Landing will redirect directly to /pockets url which will show all the pockets saved by users. But at first check the api documentation below to create pockets

---
## API documentation

At first register/login an user to get api access_token, Must set  **Accept: application/json** in header

### Register/Login
```
POST /api/v1/register 
```

Example:
```
{
    "name": "Fahim Ahmed",
    "email": "fahim152@gmail.com",
    "password" : "123456"
}
```


```
POST /api/v1/login 
```

Example:
```
{
    "email": "fahim152@gmail.com",
    "password" : "123456"
}
```

You will get an access_token, which you will be using for future api references. **You must pass access_token as Bearer Token in header of your request**


### Create a pocket

```
POST api/v1/pockets
```
Example:
```
{"title": "My Pocket"}
```

### Store a content in the pocket

```
POST api/v1/pockets/{id}/contents
```
Example:
```
{"url": "https://www.bbc.com/news/world-asia-57395693"}
```

### View All content(s) in one pocket

```
GET api/v1/pockets/{id}/contents
```
### Delete one stored content url

```
DELETE api/v1/contents/{id}
```

## Error Response Codes
Only Http response is not enough to handle error at client's end. So, to make apis **developer friendly**, I always pass 6 digit alpha numeric **error_code** in response if any error occurs. In this way you can specifically handle the response in your end, at your perspactive. Also, it makes bug / error finding more easier for the backend guy I guess. **You are welcome bro!** 😉

| Code  | Meaning |
| ------------- | ------------- |
| JXTNL3  | Pocket ID does not exist or you may simply not authorized to use others pocket id.  |
| ZUNS1  | No Contents found on this pocket  |
| 7SVLGO  | Invalid Url for pocket  |


