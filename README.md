# About

This project is done with TDD according to the task description located in [ExternalDependencies/TestTaskDescription](ExternalDependencies/TestTaskDescription).

The Clean Architecture structure is taken from https://docs.microsoft.com/en-us/dotnet/architecture/modern-web-apps-azure/common-web-application-architectures.

The API rules are from https://docs.microsoft.com/en-us/azure/architecture/best-practices/api-design. By the way, I didn't change the output of the API to follow the rule from the task description.

# Installation

Place the files on a PHP `8.1` web server.

The `example.php` file is your starting point. I think you know how to get it to handle web root requests like `/address`.

The [UserInterface/Startup/__.env__](UserInterface/Startup/.env) file sets up a database. It accepts files that exist in [ExternalDependencies/Database](ExternalDependencies/Database).

You can run tests if you have PHPUnit installed with the command `phpunit --bootstrap Tests/bootstrap.php Tests/`.

# Usage

| Method   | Path         | Action         | Argument                             | Response code |
|:---------|:-------------|:---------------|:-------------------------------------|:-------------:|
| GET      | /addresses   | View records   | -                                    |      200      |
| GET      | /addresses/1 | View record    | -                                    |      200      |
| POST     | /addresses   | Add record     | data line                            |      201      |
| POST     | /addresses   | Add records    | data lines                           |      201      |
| PUT      | /addresses/1 | Update record  | data line                            |      204      |
| PUT      | /addresses   | Update records | data lines (equal to base quantity)  |      204      |
| DELETE   | /addresses   | Delete records | -                                    |      204      |
| DELETE   | /addresses/1 | Delete record  | -                                    |      204      |

Old `/address?id=1` is preserved.

There is my Postman collection for API testing in [ExternalDependencies/TestBladeInsight.postman_collection.json](ExternalDependencies/TestBladeInsight.postman_collection.json).

# Contacts

If you are hiring, feel free to contact me at [spolanyev@gmail.com](mailto:spolanyev@gmail.com?subject=PHP)
