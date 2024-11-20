# User Management CRUD App (Commission-Based Project) 👨‍💻👩‍💻

A **User Management CRUD** application developed as part of a commission-based project. Built with **Laravel 11**, **Tailwind CSS**, **Flowbite**, **Vite**, **Alpine.js**, and **Docker**. This app allows efficient user management with a modern, responsive interface and a clean architecture.

---

## Features ✨

- **Full User CRUD Operations**:  
  - Create, read, update, and delete users.
  - View user details in a modal.
  - Search and filter users dynamically.
  
- **Responsive Design**:  
  - Fully responsive UI using **Tailwind CSS** and **Flowbite**.
  - Modern components with **Flowbite**'s pre-built UI components.
  
- **Real-time Interactivity**:  
  - Interactivity powered by **Alpine.js** for dynamic user experience without the need for complex JavaScript.

- **Fast Development with Vite**:  
  - Optimized build process and fast hot module replacement using **Vite**.

- **Dockerized Development Environment**:  
  - Docker containers for both development and production environments, ensuring consistency and easy setup.

---

## Tech Stack 🛠️

- **Laravel 11**: Backend framework.
- **Tailwind CSS**: Utility-first CSS framework for modern design.
- **Flowbite**: Component library built on top of Tailwind CSS.
- **Vite**: Build tool for frontend assets, providing fast build times and HMR.
- **Alpine.js**: Lightweight JavaScript framework for handling frontend interactivity.
- **Docker**: Containerization tool for a streamlined development and production setup.

---

## Installation and Setup 🚀

### Prerequisites
- Docker and Docker Compose installed on your machine.
- PHP 8.1 or higher (if running without Docker).
- Node.js (for Vite) and Composer (for Laravel).

### Steps to Run Locally with Docker

1. **Clone the Repository**  
   Clone this repository to your local machine.
   ```bash
   git clone https://github.com/your-username/user-management-crud.git
   cd user-management-crud

1. **Build Docker Containers**  
   ```bash
   docker-compose up -d --build

1. **Access the Application**  
   ```bash
   http://127.0.0.1:8000/

1. **Run Migrations**  
   ```bash
   docker-compose exec app php artisan migrate

### Running Without Docker (For Development)
1. **Clone the Repository**  
   ```bash
    git clone https://github.com/your-username/user-management-crud.git
    cd user-management-crud

1. **Install Dependencies**  
   ```bash
   composer install
   npm install

1. **Set Up .env File**  
   ```bash
   cp .env.example .env

1. **Run Migration**  
   ```bash
   php artisan migrate

1. **Run the Development Server**  
   ```bash
   php artisan serve

1. **Build Frontend Assets**  
   ```bash
   npm run dev

1. **Access the Application**  
   ```bash
   http://127.0.0.1:8000/