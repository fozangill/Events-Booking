# Events-Booking
An external event booking system

Info regarding the Database;
DB name : all_events
DB username : root
password : ""

It is an external event booking system that exports a simple plain json export file of the newest bookings to the database mysql by reading all the information
from json file. If new info comes it saves otherwise it ignores to prevent duplication in database tables. 
Tables are normalized into 3 different tables for optimal storage and taking care of large accumulated data in future.
Filters are set according to the requirements and total price is also being shown in the end.
