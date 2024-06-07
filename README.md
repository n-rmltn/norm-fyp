## About This FYP

This project centres on developing a specialised web-based computer component inventory
management system. The main objective is to create a customised solution that can efficiently
manage inventory for individual hardware components that collectively form a computer system.
This wide-ranging inventory category includes processors (CPUs), graphics cards (GPUs),
memory modules (RAM), storage devices (HDDs, SSDs), motherboards, and other accessories
and peripherals.

## Objective

i. Implementation of Robust Categorization Mechanism
Introduce a detailed categorization system within the IMS to facilitate efficient organisation and
retrieval of computer parts. This feature will enhance the user experience by allowing for quick
and accurate identification of components, minimising the risk of errors in inventory records.

ii. Automated Notifications and Alerts for Low Stock Levels
Integrate a proactive notification system that alerts users about low stock levels in real-time. This
feature aims to empower businesses to make informed decisions regarding inventory
replenishment, preventing stockouts, minimising order fulfilment delays, and optimising overall
operational efficiency.

iii. Integrate Compatibility Checker
Implement a comprehensive compatibility check feature within the system to prevent errors in
component assembly. The IMS will analyse and alert users about potential incompatibilities,
such as pairing incompatible processors and motherboards, thereby reducing the likelihood of
costly errors and streamlining the assembly process.

## Running the code

1. Clone the repository

```
git clone https://github.com/n-rmltn/norm-fyp.git
```

2. Open the folder

```
cd norm-fyp
```

3. Install and run composer

```
composer install
```

4. Create a new env by copying the example

```
cp .env.example .env
```

5. Create an application key, migrate the database and you're ready to serve

```
php artisan key:generate
php artisan migrate
php artisan serve
```

## Credit

This repository is for the purpose of a final project in Management & Science University
