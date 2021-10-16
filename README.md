# Zeelo
## Instructions
Get Api Status
    - Obtaine api status
    - Path /status
    - HTTP Method: GET
    
    Request Params None
    Response Body
        Attribute name | Description                        |Type   |Example value
        Message        | "Used for obtain the api status"   |string | "Status OK, you are good to go"
    
Create Item 
    - Create a new item in the catalog
    - Path /api/v1/items
    - HTTP Method: POST
    
    Request Body
        Name    | Description                          | Type  | Comment                                                | Example value
        id      | UUID unique identifier of the item   | string| in order to create de Item this value must be passed   | 7d07c4cf-5798-46a3-a72d-b72729920059
        Title   | Title of the item                    | string|-                                                       |  -

    Response 
        Body details
            Attribute name | Description                                                            |Type   |Example value
            Message        | Used for human confirmation, depending on the team is accepted or not  |string |'Item created successfully'
        Headers
            Content-Type| application/json
            User-Agent  |  ZEELO_CATALOG
            
Create Item details (for reference purposes only not implemented)
    - Create a new item details in the catalog
    - Path /api/v1/items/{id}/details
    - HTTP Method: POST
    
    Request Body
        Name    | Description                          | Type  | Comment    | Example value
        image   | The URL to the item cover-art        | string| -          | https://example.com/img/img.png
        author  | The author of the item               | string|    -       |  Herman Hesse
        price   | Title of the item                    | string|-           |  5,99

    Response 
        Body details
            Attribute name | Description                                                            |Type   |Example value
            Message        | Used for human confirmation, depending on the team is accepted or not  |string |'Item created successfully'
        Headers
            Content-Type| application/json
            User-Agent  |ZEELO_CATALOG
            
               
##
# How to deploy the solution
        Option 1 
            - git clone https://github.com/david-espinosa-fari/Zeelo.git
            - cd Zeelo/
            - docker-compose up -d --build
            - this proces will solve everithing the app need, this is a good time to go and drink some coffe
            - docker exec -t zeelo composer install
            - go to http://localhost:8181/status
            - docker exec -t zeelo php bin/phpunit
    
        Option 2
            - git clone https://github.com/david-espinosa-fari/Zeelo.git
            - cd Zeelo/webServer/
            - cp App/* /to/you/server/web/root/path
            - cd /to/you/server/web/root/path
            - composer install
            - go to http://you.server.address/status
            - php bin/phpunit --testdox
            
## FAQS
  [How to install Docker](https://docs.docker.com/install/)
  
  [How to install docker-compose](https://docs.docker.com/compose/install/) 
  
  [How to install Postman](https://learning.postman.com/docs/getting-started/installation-and-updates/)
 
 Notes:
  - Exist a postman collection under folder doc, with 2 *simple samples* of integration test
    the id to create items must be uniq.
  - The code commented in docker-compose is for developer purpose, (its slow)
  - The first the process of download the docker images its slow, after that cache its made
  - For stop the container docker-compose down 
    