# HRIS (Human Resource Information System)

## Overview
HRIS is a comprehensive web application designed to manage various human resource functions such as employee management, leave requests, payroll processing, and departmental organization. The system offers role-based access to ensure secure handling of sensitive information and operations.

## Features

- **Authentication**: User registration and login with role-based access control (Admin, Employee, Guest).
- **Dashboard**: Separate dashboards for admin and employee views.
- **Employee Management**: CRUD operations for employee records.
- **Department Management**: CRUD operations for department records.
- **Leave Management**: Employees can apply for leaves with a monthly limit, and requests are validated against the current month's leave balance.
- **Payroll Management**: Manage payrolls with CRUD operations and individual employee payroll details.

## Technologies Used

- **Laravel**: PHP framework used for building the application.
- **MySQL**: Database for storing application data.
- **Blade**: Templating engine provided by Laravel.
- **Bootstrap**: Frontend framework for responsive design.

## Usage

- **Admin**:
  - Can manage all resources including employees, departments, leaves, and payrolls.
  - Can view dashboards and generate reports.

- **Employee**:
  - Can view their dashboard, apply for leaves, and check payroll details.

- **Guest**:
  - Limited access, mainly for registration and information pages.

## Policies and Gates

- The application uses Laravel's policies and gates for fine-grained authorization.
- Policies are defined for models like Employee, Department, Leave, and Payroll to ensure users perform only authorized actions.
