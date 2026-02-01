# 🚀 Real-time Chat API (Laravel & Pusher)

A robust, secure, and real-time Chat API built with Laravel 12. This project features full authentication, conversation
management, real-time messaging using WebSockets (Pusher), and automated email notifications.

## 🛠 Features   

* **Real-time Messaging:** Integrated with Laravel Broadcasting and Pusher.
* **Authentication:** Secure API auth using Laravel Sanctum.
* **Conversations:** Support for 1-on-1 and group chat logic.
* **Email Notifications:** Mailers for password resets and verification.
* **Live Documentation:** Built-in API documentation page.

---

## 📥 Installation Guide

Follow these steps to get the project running on your local machine.

### 1. Clone the Repository

```bash
git clone https://github.com/yuldoshewuz/real-time-chat-api.git
cd real-time-chat-api
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

Copy the example environment file and generate your application key:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup

Open your `.env` file and configure your database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=real_time_chat_api
DB_USERNAME=root
DB_PASSWORD=password
```

Run the migrations to create the tables:

```bash
php artisan migrate --seed
```

### 5. Broadcasting Setup (Pusher)

Create an account at [Pusher.com](https://pusher.com), create a "Channels" app, and add your credentials to `.env`:

```env
BROADCAST_CONNECTION=pusher

PUSHER_APP_ID=your_id
PUSHER_APP_KEY=your_key
PUSHER_APP_SECRET=your_secret
PUSHER_APP_CLUSTER=your_cluster
```

### 6. Mail Configuration

Configure your mail server (e.g., Mailtrap or Gmail) for notifications:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
```

---

## 🚀 Running the Application

Start the local development server:

```bash
php artisan serve
```

The API will be available at: `http://127.0.0.1:8000/api`

### 📖 API Documentation

Once the server is running, you can view the interactive API & Broadcasting documentation directly in your browser:
👉 **`http://127.0.0.1:8000`** (or view documentation here: [chat.yuldoshew.uz](https://chat.yuldoshew.uz))

---

## 📡 WebSocket Events

This API broadcasts several events that your frontend should listen for using **Laravel Echo**:

| Channel             | Event                  | Description                    |
|---------------------|------------------------|--------------------------------|
| `private-chat.{id}` | `MessageSent`          | New message received           |
| `private-chat.{id}` | `MessageRead`          | Message status updated to read |
| `private-user.{id}` | `ConversationCreated`  | Notification for a new chat    |
| `presence-online`   | `here/joining/leaving` | Real-time user online status   |

---

## ⚙️ Queue Management (Broadcasting)

This project uses Laravel Queues to handle real-time broadcasting via Pusher. Without a running queue worker, messages will be stored in the database but **not** sent to Pusher.

### 1. Local Development

To process real-time events on your local machine, open a new terminal and run:

```bash
php artisan queue:work
```

> **Note:** Keep this terminal open while testing the chat.

### 2. Production (VPS with Supervisor)

On a live server, you should use **Supervisor** to ensure the queue worker runs continuously in the background and restarts automatically if it fails.

**1. Create a configuration file:**

```bash
sudo nano /etc/supervisor/conf.d/laravel-worker.conf
```

**2. Paste the following configuration:** (Adjust the path to match your project)

```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /your_project_directory_link/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/your_project_directory_link/storage/logs/worker.log
```

**3. Apply changes:**

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
```

### 3. Monitoring Queues

To check if your worker is running correctly on the server:

```bash
sudo supervisorctl status
```

---

## 🧪 Testing with Postman

1. Exported collection: `real-time-chat-api.postman_collection.json` is included in the root folder.
2. Import it into Postman.
3. Set your `base_url` variable to `http://127.0.0.1:8000/api`.

---

## 🤝 Contributing

Feel free to fork this project, create a feature branch, and send a Pull Request!

---

## 👨‍💻 Developed By

**Fozilbek Yuldoshev**

* GitHub: [@yuldoshewuz](https://github.com/yuldoshewuz)
* Portfolio: [yuldoshew.uz](https://yuldoshew.uz)
