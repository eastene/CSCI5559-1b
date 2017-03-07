# Stene, Evan
# 830387196

INSERT INTO Restaurant (address, city, zipCode, phone)
    VALUES ('1380 Larimer St', 'Denver', 80204, '303-555-5552'),
        ('1380 Lawrence St', 'Denver', 80204, '303-555-5551');

INSERT INTO Employee (empId, name, address, zipCode, DoB, phone, dateOfJoin, SSN, workisInAddress)
    VALUES (1, 'John Smith', '1230 1st Street', 80202, '1990-04-05', '303-555-5001', '2010-05-02', '123-04-1234', '1380 Lawrence St'),
    (2, 'Susan', '1230 2nd Street', 80013, '1995-03-15', '303-555-5002', '2015-05-01', '123-04-1235', '1380 Lawrence St'),
    (3, 'Alice', '1230 3rd Street', 80013, '1986-07-05', '303-555-5003', '2010-01-02', '123-04-1236', '1380 Lawrence St'),
    (4, 'William', '1230 4th Street', 80014, '1999-10-20', '303-555-5004', '2016-05-06', '123-04-1237', '1380 Lawrence St'),
    (5, 'Sam', '1230 5th Street', 80015, '1990-10-05', '303-555-5005', '2012-05-10', '123-04-1238', '1380 Lawrence St'),
    (6, 'Paul', '1230 6th Street', 80016, '1992-11-30', '303-555-5006', '2012-10-10', '123-04-1239', '1380 Lawrence St'),
    (7, 'Margaret', '1230 7th Street', 80017, '1994-11-14', '303-555-5006', '2011-08-19', '123-04-1240', '1380 Larimer St'),
    (8, 'Mike', '1230 8th Street', 80245, '1991-10-05', '303-555-4005', '2016-05-10', '123-04-1241', '1380 Larimer St'),
    (9, 'Wes', '1230 8th Street', 80245, '1991-10-05', '303-555-4005', '2016-10-10', '123-04-1242',	'1380 Larimer St'),
    (10, 'Tom', '1230 8th Street', 80245, '1991-11-26', '303-555-4008', '2016-11-20', '123-04-1245', '1380 Lawrence St');

INSERT INTO Cashier (empId, password)
    VALUES (3, 'emp3'),
    (4, 'emp4'),
    (9, 'emp9');

INSERT INTO KitchenStaff (empId, position)
    VALUES (6, 'Cheff'),
    (7, 'Asst. Cheff'),
    (8, 'Cheff'),
    (10, 'Asst. Cheff');

INSERT INTO Waiter (empId, manager)
    VALUES (1, 1),
    (2, 1),
    (5, 1),
    (9, 9);

INSERT INTO DinnerTable (address, tableNumber, state, chairs, waiter)
    VALUES ('1380 Larimer St', 1, 'FREE', 2, 9),
    ('1380 Larimer St', 2, 'FREE', 2, 9),
    ('1380 Larimer St', 3, 'RESERVED', 4, 9),
    ('1380 Larimer St', 4, 'FREE', 2, 9),
    ('1380 Lawrence St', 1, 'RESERVED', 2, 1),
    ('1380 Lawrence St', 2, 'RESERVED', 4, 2),
    ('1380 Lawrence St', 3, 'CLOSED', 6, 2),
    ('1380 Lawrence St', 4, 'FREE', 2, 1),
    ('1380 Lawrence St', 5, 'FREE', 6, 5),
    ('1380 Lawrence St', 6, 'CLOSED', 4, 5),
    ('1380 Lawrence St', 7, 'RESERVED', 4, 2),
    ('1380 Lawrence St', 8, 'RESERVED', 4, 2),
    ('1380 Lawrence St', 9, 'RESERVED', 4, 2);

INSERT INTO Customer (name, phone)
    VALUES ('Charlie', '702-555-5001'),
    ('Sam', '702-555-5002'),
    ('Alice', '702-555-5003'),
    ('Barbara', '702-555-5004'),
    ('John', '702-555-5005'),
    ('Mike', '702-555-5006'),
    ('Leonard', '702-555-5007'),
    ('Wes', '702-555-5008'),
    ('Vicky', '702-555-5009'),
    ('Michael', '702-555-5010');

INSERT INTO Reservation (reservationDateTime, reservationId, phone, address, tableNumber, arrivalTime)
    VALUES ('2017-02-07 19:00:00', 1, '702-555-5004', '1380 Lawrence St', 1, '18:53:00'),
    ('2017-02-9 19:00:00', 2, '702-555-5004', '1380 Lawrence St', 5, '19:15:00'),
    ('2017-02-09 19:00:00', 3, '702-555-5005', '1380 Lawrence St', 4, '19:15:00'),
    ('2017-02-07 19:00:00', 4, '702-555-5005', '1380 Lawrence St', 4, '18:55:00');

INSERT INTO Terminal (brand, model, serialNo, lastInvoideNo)
    VALUES ('Panasonic', 'AZ10', '12345Z01', 0),
    ('Panasonic', 'AZ10', '12345Z02', 0),
    ('Panasonic', 'AZ10', '12345Z03', 0),
    ('Panasonic', 'AZ10', '12345Z04', 0),
    ('Panasonic', 'AZ11', '12345ZA1', 0),
    ('Panasonic', 'AZ11', '12345ZA2', 0),
    ('Panasonic', 'AZ11', '12345ZA3', 0);

INSERT INTO DailyOperation (empId, brand, model, serialNo, operation, operDate, cash)
    VALUES (3, 'Panasonic', 'AZ10', '12345Z01', 'C', '2017-02-09', 540),
    (3, 'Panasonic', 'AZ10', '12345Z01', 'O', '2017-02-09', 230),
    (3, 'Panasonic', 'AZ10', '12345Z04', 'C', '2017-02-07', 458.9),
    (3, 'Panasonic', 'AZ10', '12345Z04', 'O', '2017-02-07', 300),
    (3, 'Panasonic', 'AZ11', '12345ZA1', 'C', '2017-02-08', 195),
    (3, 'Panasonic', 'AZ11', '12345ZA1', 'O', '2017-02-08', 180);

INSERT INTO Invoice (invNumber, discount, totalTax, invoiceDateTime, empId, brand, model, serialNo, operation, operDate, address, tableNumber, customerPhone)
    VALUES (1, 0, 2, '2017-02-07 16:00:00', 3, 'Panasonic', 'AZ10', '12345Z04', 'O', '2017-02-07', '1380 Lawrence St', 1, '702-555-5001'),
    (2, 0, 2, '2017-02-08 18:00:00', 3, 'Panasonic', 'AZ11', '12345ZA1', 'O', '2017-02-08', '1380 Lawrence St', 1, '702-555-5002'),
    (3, 0, 5, '2017-02-08 18:00:00', 3, 'Panasonic', 'AZ11', '12345ZA1', 'O', '2017-02-08', '1380 Lawrence St', 1, '702-555-5003'),
    (4, 0, 5, '2017-02-08 18:00:00', 3, 'Panasonic', 'AZ11', '12345ZA1', 'O', '2017-02-08', '1380 Lawrence St', 2, '702-555-5003');

INSERT INTO MenuItem (code, description, price)
    VALUES ('A1', 'Scrambled Eggs', 7.45),
    ('A2', 'Avocado Salad', 9.67),
    ('A3', 'Coffee', 3.45),
    ('B5', 'Orange Juice', 3.89),
    ('B6', 'Veggies Juice', 4.3),
    ('B7', 'Apple Juice', 3),
    ('B8', 'Choice Juice', 4.5),
    ('C10', 'Italian Lassagna', 9.89),
    ('C9', 'Turkey and Avocado Sandwich', 8.99);

INSERT INTO Items (invNumber, code, qty)
    VALUES (1, 'A1', 20),
    (1, 'A2', 20),
    (1, 'C10', 20),
    (2, 'C10', 20),
    (2, 'C9', 15),
    (3, 'A1', 2),
    (3, 'A3', 2);    
