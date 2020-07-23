# Virtual Wallet System

## Project Description

The project is a virtual wallet system built with [Laravel 6](https://laravel.com) and [Flutterwave's Rave Payment Gateway](https://flutterwave.com). The features of this project include

1. Registration and Authentication of users.
2. Deposit of funds into an online wallet
3. Transfer of funds via the online wallet to other users.
4. Withdrawal of funds to accounts with banks supported by rave.
5. Email notification after registration

## Project Setup(Web Portal)

### Cloning the GitHub Repository.

Clone the repository to your local machine by running the terminal command below.

```bash
git clone https://github.com/Ojsholly/virtual-wallet
```

### Setup Database

Create your a MySQL database and note down the required connection parameters. (DB Host, Username, Password, Name)

### Install Composer Dependencies

Navigate to the project root directory via terminal and run the following command.

```bash
composer install
```

### Install NPM Dependencies

While still in the project root directory via terminal, run the following command.

```bash
npm install
```

or if you use yarn instead

```bash
yarn
```

### Create a copy of your .env file

Run the following command

```bash
cp .env.example .env
```

This should create an exact copy of the .env.example file. Name the newly created file .env and update it with your local environment variables (database connection info and others).

### Generate an app encryption key

```bash
php artisan key:generate
```

### Migrate the database

```bash
php artisan migrate
```

### Add the required environment varaiables.

RAVE_TEST_PUBLIC_KEY
RAVE_TEST_SECRET_KEY

RAVE_SECRET_KEY
RAVE_PUBLIC_KEY

Kindly note that as long as the test keys are used in the project, the debit cards and bank accounts to be used are to be gotten from the (rave documentation)[https://developer.flutterwave.com/docs].

### Future Possible Updates

The following features are to be added in the next available upgrade of the system.

1. Addition of functionality to request funds from other users.
2. Addition of support for multiple user bank accounts.

### License

[MIT](https://choosealicense.com/licenses/mit/)
