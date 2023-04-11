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
