Edusoft Cloud-Based School Management System
=======================

Introduction
------------
This is the base of edusoft school management system, a cloud-based school software.

Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies using the `create-project` command:

 

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

    <VirtualHost *:80>
        ServerName edusoft.localhost
        DocumentRoot /path/to/edusoft/public
        SetEnv APPLICATION_ENV "development"
        <Directory /path/to/edusoft/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>
