# Symfony NextJs

![Symfony NextJs](https://i.ibb.co/hBgv0X8/symfony-project.png)

## Project Information

This project is designed as a decoupled application, showcasing the separation of concerns between the **Frontend** and **Backend** components.

### Backend

The backend is developed using **Symfony**, following a hexagonal architecture that utilizes bounded contexts. This design allows for better organization and separation of different aspects of the application. The backend implements the **CQRS** (Command Query Responsibility Segregation) pattern, utilizing both command and query buses for efficient management of information. This approach facilitates smooth registration, modification, and access to data within the system.

### Frontend

The frontend operates independently from the backend and is built using **Next.js** with **React**. It leverages **TypeScript** for improved type safety and developer experience. For styling and layout, the project integrates **Tailwind CSS**, allowing for a responsive and modern design without compromising performance. The decoupling of the frontend from the backend enables independent development, deployment, and scaling of both components.



## Installation

To install this project, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/venturaproject/symfony-nextjs.git
   cd symfony-nextjs
   make run


## Architecture
   ```
❯ api/src
├── Products
│   ├── Application
│   │   ├── Commands
│   │   │   ├── Create
│   │   │   │   ├── CreateProduct.php
│   │   │   │   ├── CreateProductDTO.php
│   │   │   │   └── CreateProductHandler.php
│   │   │   ├── Delete
│   │   │   │   ├── DeleteProduct.php
│   │   │   │   └── DeleteProductHandler.php
│   │   │   └── Update
│   │   │       ├── UpdateProduct.php
│   │   │       ├── UpdateProductDTO.php
│   │   │       └── UpdateProductHandler.php
│   │   ├── Console
│   │   │   └── ExportProductsCommand.php
│   │   ├── Event
│   │   │   └── ProductAddedEvent.php
│   │   ├── EventListener
│   │   │   └── ProductAddedListener.php
│   │   ├── Queries
│   │   │   ├── GetAll
│   │   │   │   ├── GetAllProducts.php
│   │   │   │   ├── GetAllProductsDTO.php
│   │   │   │   └── GetAllProductsHandler.php
│   │   │   └── GetById
│   │   │       ├── GetByIdProductsDTO.php
│   │   │       ├── GetProductById.php
│   │   │       └── GetProductByIdHandler.php
│   │   └── Services
│   ├── Domain
│   │   ├── Entity
│   │   │   └── Product.php
│   │   └── Repository
│   │       └── ProductRepositoryInterface.php
│   └── Infrastructure
│       ├── Database
│       │   └── ORM
│       │       └── Product.orm.xml
│       └── Repository
│           └── ProductRepository.php
├── Shared
│   ├── Application
│   │   ├── Bus
│   │   │   ├── Command
│   │   │   │   ├── CommandBus.php
│   │   │   │   └── CommandBusInterface.php
│   │   │   └── Query
│   │   │       ├── QueryBus.php
│   │   │       └── QueryBusInterface.php
│   │   ├── Console
│   │   │   └── Commands
│   │   └── Services
│   │       ├── EmailService.php
│   │       ├── ExcelExportService.php
│   │       └── NotFoundRedirectService.php
│   ├── Domain
│   │   └── Service
│   └── Infrastructure
│       ├── Controller
│       │   ├── Api
│       │   │   ├── ApiCheckController.php
│       │   │   ├── ProductController.php
│       │   │   └── UserController.php
│       │   └── Web
│       │       ├── DefaultController.php
│       │       ├── HealthCheckAction.php
│       │       ├── HomepageController.php
│       │       ├── NotFoundRedirectController.php
│       │       └── PhpinfoController.php
│       ├── Database
│       │   ├── Fixtures
│       │   │   ├── AppFixtures.php
│       │   │   └── ProductFixtures.php
│       │   ├── Migrations
│       │   │   ├── Version20241028072140.php
│       │   │   └── Version20241028074836.php
│       │   └── data
│       │       └── products.json
│       ├── Kernel.php
│       └── Service
│           └── PhpInfoService.php
└── Users
    ├── Application
    │   ├── Commands
    │   │   ├── Create
    │   │   │   ├── CreateUser.php
    │   │   │   ├── CreateUserDTO.php
    │   │   │   └── CreateUserHandler.php
    │   │   ├── ChangePassword
    │   │   │   ├── ChangeUserPassword.php
    │   │   │   ├── ChangeUserPasswordDTO.php
    │   │   │   └── ChangeUserPasswordHandler.php
    │   │   ├── Delete
    │   │   │   ├── DeleteUser.php
    │   │   │   └── DeleteUserHandler.php
    │   │   └── Update
    │   │       ├── UpdateUser.php
    │   │       ├── UpdateUserDTO.php
    │   │       └── UpdateUserHandler.php
    │   ├── Console
    │   │   └── CreateUserConsole.php
    │   ├── Event
    │   │   └── ChangePasswordEvent.php
    │   ├── EventListener
    │   │   └── ChangePasswordEventListener.php
    │   └── Queries
    │       ├── GetAll
    │       │   ├── GetAllUsers.php
    │       │   ├── GetAllUsersDTO.php
    │       │   └── GetAllUsersHandler.php
    │       ├── GetById
    │       │   ├── GetUserById.php
    │       │   ├── GetUserByIdDTO.php
    │       │   └── GetUserByIdHandler.php
    │       └── GetUser
    │           ├── GetUserDTO.php
    │           ├── GetUserHandler.php
    │           └── GetUserQuery.php
    ├── Domain
    │   ├── Entity
    │   │   └── User.php
    │   └── Repository
    │       └── UserRepositoryInterface.php
    └── Infrastructure
        ├── Database
        │   └── ORM
        │       └── User.orm.xml
        └── Repository
            └── UserRepository.php