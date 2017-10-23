# TODO: try/catch here
import arrow
import config
import json
import logging
import pymysql
import requests
import sys

logging.basicConfig(format='%(asctime)s - %(levelname)s - %(message)s', level=config.LOGGING_LEVEL)
logging.info('Starting database import script')

# Create a database object for us to use
db_conn = pymysql.connect(host=config.DATABASE_HOST,
    user=config.DATABASE_USER, password=config.DATABASE_PW, db=config.DATABASE_NAME,
    cursorclass=pymysql.cursors.DictCursor)

# Get rooms from the ROOM table
rooms = []
try:
    with db_conn.cursor() as cursor:
        statement = 'SELECT * FROM ROOM;'
        cursor.execute(statement)
        queryResult = cursor.fetchall()

        # Add each room to the room array
        for room in queryResult:
            rooms.append(room['roomNumber'])

        logging.info("Retrieved list of rooms from database")
except Exception as e:
    logging.critical('Unable to get rooms from ROOM table ' + str(e))

# Log error and exit if rooms is empty
if len(rooms) == 0:
    logging.critical("It seems that we didn't get any rooms back")
    sys.exit()

# Build a list of dates to iterate over
## First get the week floor (i.e. Monday)
utc  = arrow.utcnow()
local = utc.to('US/Eastern')
week_floor = local.floor('week')

## Then construct an array with all of the dates that we care about (i.e. M - Sun)
dates = [week_floor.shift(days=-1).format('YYYY-MM-DD')] # Add Sunday
for i in range(0,7): # Add remaining days
    dates.append(week_floor.shift(days=+i).format('YYYY-MM-DD'))

# For each room from the ROOM table, make an API calls to get events and create some SQL statements
sql_statements = [] # list of sql statements that we will later execute
for room in rooms:

    # Iterate over each date to retrieve events
    for date in dates:
        # Build an API string of format https://api.rit.edu/v1/rooms/70-2520/meetings?date=2017-08-09&RITAuthorization=<KEY>
        api_string = "https://api.rit.edu/v1/rooms/" + room + "/meetings?date="
        api_string += date + "&RITAuthorization="
        api_string_secure = api_string + config.RIT_API_KEY

        # Make a request and store the data in json_data
        try:
            r = requests.get(api_string_secure)
            if(r.status_code == 200):
                logging.info('Successful request (status 200) to ' + api_string)
                json_data = r.json()
            else:
                logging.critical('Non-200 status code of ' + str(r.status_code) + ' received for (sanitized) request ' + api_string)
        except requests.exceptions.RequestException as e:
            logging.critical('Request exception for (sanitized) request ' + api_string)
            sys.exit()
                
        # Build a list of sql statements
        try:
            for item in json_data['data']:
                # Get the event/meeting name. We use a split because meeting names commonly come with extra spaces (i.e. ISTE   612  01)
                # We also truncate it if it's longer than the allowed 45 chars
                meeting_name = ' '.join(item['meeting'].split())
                meeting_name = meeting_name[:45]

                date = item['date']
                room_number = item['room']['building'] + '-' + item['room']['room']
                start_time = item['start']
                end_time = item['end']

                statement = 'INSERT INTO EVENT (date, eventName, roomNumber, startTime, endTime) VALUES("%s","%s", "%s", "%s", "%s")' % (date, meeting_name, room_number, start_time, end_time)
                sql_statements.append(statement)
                logging.debug('Created SQL statement: ' + statement)
        except KeyError as e:
            logging.critical('Key error for key ' + str(e))
            continue

        # Make sure we actually have SQL statements. If not, we will log an error and continue to next room
        if len(sql_statements) == 0:
            logging.critical('No SQL statements available to put into the database for date %s!' % date)

        
        try:
            with db_conn.cursor() as cursor:
                # We truncate the DB table, as long as we know that we received a response back from API.
                statement = 'TRUNCATE TABLE EVENT'
                cursor.execute(statement)

                for statement in sql_statements:
                    cursor.execute(statement)
            db_conn.commit()
        except Exception as e:
            logging.critical('Error updating EVENT table ' + str(e))


        # We aren't interested in tracking historical events, so this is acceptable.

        # Iterate over SQL statements and insert into DB

# TODO: We should be closing this connection earlier, especially if we catch an exception
db_conn.close()
logging.info('Database import script complete')
