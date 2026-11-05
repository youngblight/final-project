Digital Connection for Skilled Craftsmen with Customer
A web-based system that connects skilled craftsmen (such as carpenters, welders, plumbers, electricians, and tailors) with customers who need their services. The system makes it easier for customers to find the right craftsman, and for craftsmen to reach more customers, without depending on word of mouth alone.
This project was developed as my final-year academic project for the Bachelor of Science in Information Communication and Technology with Business at Mzumbe University.
Problem Statement
Skilled craftsmen often depend on personal contacts to find work, while customers struggle to find reliable craftsmen quickly. This leads to lost income for craftsmen and wasted time for customers. This system provides a digital platform that connects both sides in one place.
Objectives
•	Provide a platform where craftsmen can present their skills and services.
•	Help customers find and contact craftsmen easily.
•	Improve how craftsmen and customers communicate and organize work requests.
•	Support skilled craftsmen in reaching a wider market.
Main Features
•	User registration and login (authentication)
•	Separate roles for craftsmen and customers
•	Craftsman profiles showing skills and services
•	Search and browsing of craftsmen by skill
•	Customer requests for services
•	Management of data through a MySQL database
Technologies Used
Area	Technology
Backend framework	Laravel 12 (PHP 8.2+)
Database	MySQL
Frontend	HTML, CSS, JavaScript, Tailwind CSS
Build tool	Vite
Authentication	Laravel Breeze
Testing	Pest
Installation Guide
Requirements
•	PHP 8.2 or higher
•	Composer
•	Node.js and npm
•	MySQL (for example through XAMPP or WAMP)
Steps
1.	Clone the repository
 	git clone https://github.com/youngblight/final-project.git
cd final-project
2.	Install PHP dependencies
 	composer install
3.	Create the environment file
 	cp .env.example .env
php artisan key:generate
4.	Set up the database
 	Create an empty MySQL database, then open the .env file and update these values:
 	DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
5.	Run the migrations
 	php artisan migrate
6.	Install and build frontend assets
 	npm install
npm run build
7.	Start the application
 	php artisan serve
 	Open http://127.0.0.1:8000 in your browser.
Project Structure
app/          Application logic (models, controllers)
database/     Migrations, factories, and seeders
resources/    Views, CSS, and JavaScript
routes/       Web routes
public/       Public entry point and assets
tests/        Automated tests
Running Tests
php artisan test
Author
Siraju Mshamu Kikula Software Developer Email: sirajukikula435@gmail.com GitHub: youngblight
License
This project is open-sourced under the MIT license
<img width="626" height="468" alt="image" src="https://github.com/user-attachments/assets/a0195ee5-ffbb-4585-9c7e-f34dd0353310" />
<img width="583" height="643" alt="image" src="https://github.com/user-attachments/assets/69792072-ddd0-40d3-a805-32f53c9353f3" />
<img width="763" height="462" alt="image" src="https://github.com/user-attachments/assets/fbcae578-a233-4856-86b7-1b6560de22b4" />
<img width="514" height="617" alt="image" src="https://github.com/user-attachments/assets/73625d9c-fdb2-4d78-842e-020daad80d91" />
<img width="696" height="271" alt="image" src="https://github.com/user-attachments/assets/685181f9-7f92-4d41-9f20-638ebd32996f" />
<img width="642" height="357" alt="image" src="https://github.com/user-attachments/assets/feab973f-c23d-4423-bdb3-960da301819e" />
