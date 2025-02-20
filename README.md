This project used as test task for "Task Management" tool
-

For start BE application you should run:
-

(We use SQLite as database so it is not needed to use database configuration)
- cd be-task-manager
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan serve

(You should remain on what URL server was started. Usually it is server running on http://127.0.0.1:8000)


For start FE application you should run:
- 

- cd fe-task-manager
- npm install
- In case if your BE application was run not on the default url:
  - open the file "fe-task-manager/src/main.js" 
  - update "axios.defaults.baseURL" from 'http://127.0.0.1:8000/api' to the actual one
- npm run dev

After all this steps you can open in browser url that was shown in the Local variable. 
F.E. "Local: http://localhost:5173/"

