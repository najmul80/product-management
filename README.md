# Product Management API (Laravel)

This is a simple Product CRUD API built using **Laravel 10** and **Eloquent ORM**. It supports basic operations such as creating, reading, updating, and deleting products via API endpoints.

## 🚀 API Endpoints

| Method | Endpoint              | Description                   |
|--------|------------------------|-------------------------------|
| GET    | /api/products          | Get all products              |
| GET    | /api/products/{id}     | Get single product            |
| POST   | /api/products          | Create a new product          |
| PUT    | /api/products/{id}     | Update a product              |
| DELETE | /api/products/{id}     | Delete a product              |

## 🗃️ Products Table Structure

- `id` (Primary key, auto-increment)
- `name` (String, max 100)
- `description` (Text, nullable)
- `price` (Decimal 10,2)
- `stock` (Integer, default 0)
- `created_at` / `updated_at` (Timestamps)

## 📁 Folder Structure

This project follows the recommended Laravel folder structure.

[Watch Video Demo]
https://drive.google.com/file/d/1Gj2OQm6Nc22AU9R0vuSQKTeMyhhfy-7-/view?usp=drive_link

