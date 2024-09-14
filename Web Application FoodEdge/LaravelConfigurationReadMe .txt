Complete guide if using Laravel on another pc

1. Clone the repository:
git clone <repository-url>
cd <repository-directory>

2. Install PHP Dependencies:
composer install

3. Open the .envelope file and configure environment variable 
4. Generate Application Key:
php artisan key:generate

5. Run Database Migration: 
php artisan migrate

6. Install dependencies:
npm install
npm run dev

7. Start Laravel Development server:
php artisan serve 


GitHub URL -> The complete code is in Final-Code Branch: https://github.com/GokulK1999/FoodEdge-CMS-Project.git 


Video Demonstration of how to clone and start it on your pc (Watch till the very end):
https://youtu.be/Vm0M75Tl84E




Laravel Installation:
Local machine should have PHP and Composer installed before installing Laravel
https://getcomposer.org/




After Installing PHP and Composer, you can install Laravel in created project terminal.


Command: composer global require laravel/installer
Once the project has been installed with laravel, start Laravel’s local development server using Laravel Artisan’s serve command


Command: php artisan serve


Once you have started the Artisan development server, your application will be accessible in your web browser at http://localhost:8000.


Command for Installing Breeze Package: 


Step 1: composer require laravel/breeze
Step 2: php artisan breeze:install
Step 3: (It gives option which stack we want to Install, we used Livewire for this project) Choose livewire-functional
Step 4: (It ask do we need dark mode support) We choose yes
Step 5: (It ask which testing framework prefer) We choose PHPUnit


How we create Middleware?:


For middleware creating we directly use command 
-> php artisan make:middleware Management 
Same way we created for Operation and User as well.



The command for installing chart js libraries for Business Sales Report purposes:

Make sure to use the Vscode terminal for this command:

        Step 1: npm i chart.js
        Step 2: npm install chart.js –save


Management mail: gokul@gmail.com
Password: 123456789

Operation mail: operation@gmail.com
Password: 123456789

For Migration use command: php artisan migrate



