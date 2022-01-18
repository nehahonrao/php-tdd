# php-tdd
## Date:17-01-2022

### Day 1:
- install symfony with following command: 
- composer create-project symfony/skeleton tdd
- cd tdd
- composer require webapp
- install doctrine for database: composer require symfony/orm-pack
- composer require --dev symfony/maker-bundle
- then for creating database to use mariadb make changes in .env file: -DATABASE_URL="mysql://root:@127.0.0.1:3306/userbooking?serverVersion=mariadb-10.4.11"
- where root=db-username and userbooking =db-name.
- run command:symfony console doctrine:database:create
- this command create database then create entities: symfony console make:entity
- enter table name and properties with its type and length.
- I have created three entities User,Room,Booking
- Booking entity contain reltionship betweeon User ans Room so created properties user,room and in type I have write "relation"->enter and "ManyToOne".this established relation between Booking,User and Room.
 - Done with database creation.
 - then created UserController:symfony console make:controller UserController
 - in index.html.twig file created a navbar containing name ,home and book a room

 ### Day 2:
 - Working on date picker functionality
 
 
