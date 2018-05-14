# Events Import Script

## Overview
This script is used to import the list of events for a week (Monday through Sunday) from api.rit.edu and insert these events into the lab website database.

# Dependencies
The script requires Python 3 and uses a number of packages that can be installed via pip (pip install -r requirements.txt)
* Arrow: used for simplifying date manipulation
* Requests: used to make HTTP requests to the RIT API
* PyMySQL: used to connect to database
arrow: pip install arrow
makes working with dates easier

# Deployment
The script is pretty easy to install. The installation instructions below assume CentOS

1. Install Python 3 and pip
    * `yum install -y python34 python34-pip`
2. *Optional* Create a virtual environment and activate it. If you don't do this, be sure to use Python 3 and pip 3 when using subsequent commands.
    * `pip install virtualenv`
    * `virtualenv -p python3 venv`
    * `venv/bin/activate`
3. Install the dependencies via pip
    * `pip install -r requirements.txt`
4. Move config.py.sample to config.py and set the relevant variables
    * `mv config.py.sample config.py`
    * `vim config.py`
5. *Optional* Set up a cron job to execute the script at desired intervals so that data is continually refreshed.

# Configuration
The config.py file takes a few configuration variables:

| Variable      | Description                                         |
|:------------- |:--------------------------------------------------- |
| RIT_API_KEY   | API key for api.rit.edu                             |
| LOGGING_LEVEL | Sets the desired logging level. Default is critical |
| DATABASE_HOST | Database hostname                                   |
| DATABASE_NAME | Database name                                       |
| DATABASE_USER | Username for database                               |
| DATABASE_PW   | Password for database                               |
