## Installation Steps
1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/YOUR_USERNAME/YOUR_REPOSITORY_NAME.git](https://github.com/YOUR_USERNAME/YOUR_REPOSITORY_NAME.git)
    cd YOUR_REPOSITORY_NAME
    ```
2.  **Create your environment file:**
    ```bash
    cp .env.example .env
    ```
3.  **Generate an application key:**
    ```bash
    php artisan key:generate
    ```
4.  **Run the database migrations:**
    This will create all the necessary tables (authors, books, book_categories, ratings).
    ```bash
    php artisan migrate
    ```

5.  **Seed the database (IMPORTANT):**
    This command will generate the large fake dataset as required by the test (1k authors, 3k categories, 100k books, 500k ratings).

    **This step will take several minutes to complete.**

    ```bash
    php artisan db:seed
    ```

6.  **Start the local server:**
    ```bash
    php artisan serve
    ```    
