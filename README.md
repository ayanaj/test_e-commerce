# test_e-commerce
 

symfony application that synchronizes an e-commerce store with its logistics center and export data into a csv file

## API Reference

#### Get all orders

```http
  GET /orders

```

#### Get all contacts

```http
  GET /contacts
```

 

## Color Reference

| Color             | Hex                                                                |
| ----------------- | ------------------------------------------------------------------ |
| primary color| ![#14C38E](https://colorhunt.co/palette/00ffab14c38eb8f1b0e3fcbf) #14C38E |
| secondary color  | ![#B8F1B0](https://colorhunt.co/palette/00ffab14c38eb8f1b0e3fcbf) #B8F1B0 |
 
## Contributing

- Creation of the login interface 
- Creation of the interface List of orders
- Create interface List of contacts who have placed orders
- Integration api get orders
- Integration api get contacts
- authentication formLogin
- Creation a javascript function that provide the data export into a csv file.

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file (on my local I use mariadb)DATABASE_URL="mysql://root:@127.0.0.1:3306/ecommerce?serverVersion=mariadb-xx.x.xx"

symfony version that i used : 5.4
PHP version that i used  : 7.3.12

html5 + css3 + bootstrap 4 et javascript for the frontEnd
## Screenshots

![login](https://github.com/ayanaj/test_e-commerce/blob/13-08-2022/screenshot/loginpage.JPG) ==> the route : /
![orders list](https://github.com/ayanaj/test_e-commerce/blob/13-08-2022/screenshot/listOrders.JPG)==>  the route : /orders-to-csv
![contact's order list](https://github.com/ayanaj/test_e-commerce/blob/13-08-2022/screenshot/Capture.JPG) ==> the route : /contacts

the user i connect with :
username user@ecommerce.com
password ecommercepwd

or there is a function in the LoginController named createUserTest that allows you to create a user in the database.

the Hostapi variable that i used in the  service "ListService" is defined in the yaml files "twig.yml under global" and "service.yml under parameters" it contains the host .
