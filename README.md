# Product Management System

## Description

This Product Management System allows administrators to manage products in an e-commerce platform. It includes features like adding, editing, deleting, viewing, and searching for products.

## Features

- Add new products
- Edit existing products
- Delete products
- View detailed product information

## Prerequisites

Before you begin, make sure you have the following installed:

- [PHP](https://www.php.net/) (version 8.1 or higher)
- [Composer](https://getcomposer.org/) (version 2.x)
- [Node.js](https://nodejs.org/) (version 16 or higher)
- [MySQL](https://www.mysql.com/) (or another supported database)

## Installation

Follow these steps to set up the project on your local machine.

### Step 1: Clone the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/mohabzalat22/product_management_task.git
```

### Step 2: Using vite

Use node.js to run vite:

```bash
npm i
```

### Step 3: Making migrations

Making migrations

```bash
php artisan migrate
```

### Step 4: Serving the project

Serving the project

```bash
php artisan serve
```

# Product API Documentation

## Endpoints

### 1. Get All Products
- **Endpoint**: `GET /api/products`
- **Description**: Returns a paginated list of all products.
- **Request**:
    - **Method**: GET
    - **Headers**: 
        - Authorization: `Bearer <token>` (if authentication is required)
- **Response**:
    - **Success** (200 OK):
    ```json
    {
        "success": true,
        "message": "Fetched Products Successfully.",
        "data": {
            "current_page": 1,
            "data": [
                {
                    "id": 1,
                    "user_id": 1,
                    "name": "Product 1",
                    "description": "Product 1 description",
                    "price": 100,
                    "quantity": 10,
                    "created_at": "2024-12-05T10:00:00.000000Z",
                    "updated_at": "2024-12-05T10:00:00.000000Z"
                }
            ],
            "per_page": 10,
            "total": 1
        },
        "status_code": 200
    }
    ```

### 2. Create a Product
- **Endpoint**: `POST /api/products`
- **Description**: Allows the creation of a new product.
- **Request**:
    - **Method**: POST
    - **Headers**: 
        - Authorization: `Bearer <token>`
    - **Body (JSON)**:
    ```json
    {
        "name": "Product Name",
        "description": "Product description",
        "price": 100,
        "quantity": 20
    }
    ```
    - **Validation Rules**:
        - `name`: required, string
        - `description`: required, string
        - `price`: required, numeric
        - `quantity`: required, integer
- **Response**:
    - **Success** (201 Created):
    ```json
    {
        "success": true,
        "message": "Product Created Successfully.",
        "data": {
            "id": 1,
            "user_id": 1,
            "name": "Product Name",
            "description": "Product description",
            "price": 100,
            "quantity": 20,
            "created_at": "2024-12-05T10:00:00.000000Z",
            "updated_at": "2024-12-05T10:00:00.000000Z"
        },
        "status_code": 201
    }
    ```

### 3. Get Product by ID
- **Endpoint**: `GET /api/products/{id}`
- **Description**: Retrieves a product by its ID.
- **Request**:
    - **Method**: GET
    - **Headers**: 
        - Authorization: `Bearer <token>`
    - **URL Parameters**:
        - `id`: The ID of the product.
- **Response**:
    - **Success** (200 OK):
    ```json
    {
        "success": true,
        "message": "Fetched Specific Product Successfully.",
        "data": {
            "id": 1,
            "user_id": 1,
            "name": "Product Name",
            "description": "Product description",
            "price": 100,
            "quantity": 20,
            "created_at": "2024-12-05T10:00:00.000000Z",
            "updated_at": "2024-12-05T10:00:00.000000Z"
        },
        "status_code": 200
    }
    ```

### 4. Update a Product
- **Endpoint**: `PUT /api/products/{id}`
- **Description**: Allows you to update the details of a specific product.
- **Request**:
    - **Method**: PUT
    - **Headers**: 
        - Authorization: `Bearer <token>`
    - **Body (JSON)**:
    ```json
    {
        "name": "Updated Product Name",
        "description": "Updated description",
        "price": 120,
        "quantity": 30
    }
    ```
    - **Validation Rules**:
        - `name`: required, string
        - `description`: required, string
        - `price`: required, numeric
        - `quantity`: required, integer
- **Response**:
    - **Success** (200 OK):
    ```json
    {
        "success": true,
        "message": "Product Updated Successfully.",
        "data": {
            "id": 1,
            "user_id": 1,
            "name": "Updated Product Name",
            "description": "Updated description",
            "price": 120,
            "quantity": 30,
            "created_at": "2024-12-05T10:00:00.000000Z",
            "updated_at": "2024-12-05T10:05:00.000000Z"
        },
        "status_code": 200
    }
    ```

### 5. Delete a Product
- **Endpoint**: `DELETE /api/products/{id}`
- **Description**: Allows you to delete a product by its ID.
- **Request**:
    - **Method**: DELETE
    - **Headers**: 
        - Authorization: `Bearer <token>`
    - **URL Parameters**:
        - `id`: The ID of the product to be deleted.
- **Response**:
    - **Success** (200 OK):
    ```json
    {
        "success": true,
        "message": "Product Deleted Successfully.",
        "data": {
            "id": 1,
            "user_id": 1,
            "name": "Product Name",
            "description": "Product description",
            "price": 100,
            "quantity": 20,
            "created_at": "2024-12-05T10:00:00.000000Z",
            "updated_at": "2024-12-05T10:00:00.000000Z"
        },
        "status_code": 200
    }
    ```
    - **Error** (422 Unprocessable Entity):
    ```json
    {
        "success": false,
        "message": "Unable To Delete Product",
        "data": [],
        "errors": []
    }
    ```
