# Widget Maker Project with Docker

Welcome to the Widget Maker project! This PHP application runs with Apache2 inside a Docker container. The project exposes endpoints to manage products and handle basket operations with optional offers.

## Prerequisites

- **Docker**: Install Docker to containerize your application.
- **Docker Compose**: Install Docker Compose to manage multi-container applications.

## Setup

Follow these steps to get your Widget Maker project up and running:

### 1. Clone the Repository

clone the repository:

git clone https://github.com/n0uman0/widget-maker.git
cd repository-directory

### 2. Build and Run the Docker Containers 

docker-compose up --build -d

# API Documentation

The Widget Maker application provides the following API endpoints:
1. GET /products

Retrieve a list of available products.

    URL: http://localhost:8080/products
    Method: GET

Example Request:

sh

curl -X GET http://localhost:8080/products

Example Response:

json

{
    "success": true,
    "response_code": 200,
    "message": "Products found",
    "data": [
        {
            "id": "R01",
            "code": "R01",
            "name": "Red Widget",
            "price": 32.95
        },
        {
            "id": "G01",
            "code": "G01",
            "name": "Green Widget",
            "price": 24.95
        },
        {
            "id": "B01",
            "code": "B01",
            "name": "Blue Widget",
            "price": 7.95
        }
    ]
}

2. POST /basket

Add products to the basket and optionally apply offers.

    URL: http://localhost:8080/basket
    Method: POST
    Request Body:
        Content-Type: application/json
        Body: A JSON object with:
            product_codes (array of strings): Product codes to add to the basket.
            offer (optional string): Offer code to apply.

Example Request:

sh

curl -X POST http://localhost:8080/basket \
     -H "Content-Type: application/json" \
     -d '{"product_codes": [ "R01", "B01" ], "offer": "buy_one_get_second_half_price"}'

Example Response:

json

{
    "success": true,
    "response_code": 200,
    "message": "success",
    "data": {
        "products": [
            "R01",
            "B01"
        ],
        "total": 45.85,
        "promotion": "buy_one_get_second_half_price",
        "delivery_charges": 4.95,
        "currency": "$"
    }
}

