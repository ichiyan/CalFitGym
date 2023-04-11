## Set Up Laravel Project

1. Clone the repository.

   ```
   git clone https://github.com/ichiyan/CalFitGym.git
   ```
2. cd into project.
3. Install composer dependencies.

    ```
    composer install
    ```
4. Install npm dependencies.

    ```
    npm install
    ```
5. Create a copy of .env file.

    ```
    cp .env.example .env
    ```
6. Generate an app encryption key.

    ```
    php artisan key:generate
    ```

7. Create an empty database for the application.

8. In the .env file, add database information. Fill in the ```DB_HOST```, ```DB_PORT```, ```DB_DATABASE```, ```DB_USERNAME```, and ```DB_PASSWORD``` options to match the credentials of the database you    just created.

9. Publish schema to database.

    ```
    php artisan migrate
    ```
9. Seed the database.

    ```
    php artisan db:seed
    ```
    
10. Optional: Add dummy data found in ```root > DummyData``` to database. 

11. Link storage.

    ```
    php artisan storage:link
    ```
    
12. Run the application. 
  
    ```
    php artisan serve
    ```
    
## Screenshots

<!-- <p float="left">
<img src="https://user-images.githubusercontent.com/74673566/231273258-91e85e04-3eab-49e5-ab05-2622d279b075.png" height="1000"> 
<img src="https://user-images.githubusercontent.com/74673566/231272376-94dde005-ad0f-40a4-b64f-d37a1fa2dce2.png" height="1000"> 
<img src="https://user-images.githubusercontent.com/74673566/231272396-8c8ad4f9-62e4-4349-ad41-d1d38afefb80.png" height="1000"> 
</p>

<p float="left">
<img src="https://user-images.githubusercontent.com/74673566/231272430-d94325bc-9c79-4d2e-a9dc-efcab4bbb917.png" height="400"> 
</p>

<p float="left">
<img src="https://user-images.githubusercontent.com/74673566/231274586-2e8812c2-1133-42d3-b465-eeeaccba91fa.png" height="500"> 
<img src="https://user-images.githubusercontent.com/74673566/231274756-446db4a7-634d-4ffb-9460-12b78ecf5fd2.png" height="500">
<img src="https://user-images.githubusercontent.com/74673566/231274770-6f86f692-2ab4-4077-a406-9872b19a67b7.png" height="500">
</p> -->

| | | 
|:-------------------------:|:-------------------------:|
|<img width="1604" alt="landing page" src="https://user-images.githubusercontent.com/74673566/231273258-91e85e04-3eab-49e5-ab05-2622d279b075.png"><img width="1604" alt="login" src="https://user-images.githubusercontent.com/74673566/231272430-d94325bc-9c79-4d2e-a9dc-efcab4bbb917.png"> |  <img width="1604" alt="facility" src="https://user-images.githubusercontent.com/74673566/231272376-94dde005-ad0f-40a4-b64f-d37a1fa2dce2.png"><img width="1604" alt="products" src="https://user-images.githubusercontent.com/74673566/231272396-8c8ad4f9-62e4-4349-ad41-d1d38afefb80.png">|
|<img width="1604" alt="dashboard" src="https://user-images.githubusercontent.com/74673566/231274586-2e8812c2-1133-42d3-b465-eeeaccba91fa.png"><img width="1604" alt="employees" src="https://user-images.githubusercontent.com/74673566/231274770-6f86f692-2ab4-4077-a406-9872b19a67b7.png"> |  <img width="1604" alt="customers" src="https://user-images.githubusercontent.com/74673566/231274756-446db4a7-634d-4ffb-9460-12b78ecf5fd2.png"><img width="1604" alt="new customer" src="https://user-images.githubusercontent.com/74673566/231286763-892697ad-9326-4b3b-b081-769610d3f454.png">|
|<img width="1604" alt="customer about" src="https://user-images.githubusercontent.com/74673566/231287172-70121ed4-b84a-43c5-afa9-97e22a57fda7.png"> | <img width="1604" alt="customer details" src="https://user-images.githubusercontent.com/74673566/231286907-c4a0249c-c64a-4878-98db-cca535c73a82.png"> |
|<img width="1604" alt="inventory" src="https://user-images.githubusercontent.com/74673566/231284816-3eecc20e-c072-4b46-b610-afb7818709d7.png"><img width="1604" alt="products" src="https://user-images.githubusercontent.com/74673566/231284902-8dd66c72-4975-4d98-a20e-bf98c8dad77c.png"> |  <img width="1604" alt="order" src="https://user-images.githubusercontent.com/74673566/231284978-dff2df59-e2d1-46cc-9691-fcc2cd177f2f.png"><img width="1604" alt="orders" src="https://user-images.githubusercontent.com/74673566/231285098-ca0159fe-177c-4fe9-aaed-1418c718212c.png">|





