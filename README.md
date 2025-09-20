# Laravel Discount Cart API

This is a Laravel-based API for managing a shopping cart with smart discount logic. It allows users to add products to their cart, apply discounts based on product groups, and view their cart with calculated prices and discounts.

---

## What This Project Does

- Add, remove, and update products in a user's cart
- Apply discounts only when specific product combinations are present
- Calculate discounts based on the lowest quantity among grouped products
- Return cart details including product info and per-item discount

---

## Authentication

- Users log in using email and password
- Login returns an access token
- All cart routes are protected with `auth:sanctum` middleware

### Login Endpoint

| Method | Endpoint     | Description         |
|--------|--------------|---------------------|
| POST   | `/login`     | Returns access token |

## Features

### Cart Endpoints

| Method | Endpoint          | Description                          |
|--------|-------------------|--------------------------------------|
| POST   | `/add-product`    | Add a product to the cart            |
| POST   | `/remove-product` | Remove a product from the cart       |
| POST   | `/set-product`    | Change quantity of a product in cart |
| GET    | `/cart`           | Get all products in the cart with prices and discounts |

---

## How Discounts Work

- Discounts are defined in **user-specific groups**
- A discount only applies if **all products in the group** are in the cart
- The discount is applied only to the **minimum quantity** shared across those products
- Only products in the group get discounted

### Example

If a group includes Product #2 and Product #5 with a 15% discount:
- If both are in the cart → discount applies
- If one is missing → no discount
- If you have 3 of Product #2 and 2 of Product #5 → discount applies to 2 of each

---

## Tech Stack

- Laravel 12
- MySQL
- Laravel Resources for API formatting
- Form Requests for validation
- Eloquent relationships and accessors
- Service class for discount logic

---

## Seeder Setup

A seeder is included to:
- Pick a random user
- Select 2 random products from the database
- Create a discount group with 15% off
- Assign those products to the group

### Run Seeder

```bash
php artisan db:seed
