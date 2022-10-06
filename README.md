# About

This project is done with TDD accordingly to the task description located in [ExternalDependencies/TestTaskDescription](ExternalDependencies/TestTaskDescription).

Clean Architecture structure is taken from https://docs.microsoft.com/en-us/dotnet/architecture/modern-web-apps-azure/common-web-application-architectures article.

API rules are taken from https://docs.microsoft.com/en-us/azure/architecture/best-practices/api-design article. By the way, I didn't change the output of API to follow the rule from the task description.

# Installation

Place the files on __PHP 8.1__ web server.

File [__example.php__](example.php) is an entry point. I think you know how to make it to handle web root requests like __/address__.

A database is set in [UserInterface/Startup/__.env__](UserInterface/Startup/.env) file. It accepts files existing in [ExternalDependencies/Database](ExternalDependencies/Database).

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

Old __GET /address?id=1__ is preserved.

There is my Postman collection for API testing in [ExternalDependencies/TestBladeInsight.postman_collection.json](ExternalDependencies/TestBladeInsight.postman_collection.json) file.

# Contacts

Feel free to contact me at [spolanyev@gmail.com](mailto:spolanyev@gmail.com?subject=PHP%3A%20BladeInsight%20project)
