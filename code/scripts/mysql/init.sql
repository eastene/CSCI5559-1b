# Stene, Evan
# 830387196

# Initialize the database and tables

CREATE DATABASE dba;
USE dba;

CREATE TABLE Restaurant (
	address VARCHAR(250),
	city VARCHAR(128),
	zipCode INTEGER,
	phone VARCHAR(20),

	PRIMARY KEY (address)
);

CREATE TABLE Employee (
	empId INTEGER,
	name VARCHAR(150),
	address VARCHAR(250),
	zipCode INTEGER,
	DoB DATE,
	phone VARCHAR(20),
	dateOfJoin DATE,
	SSN VARCHAR(11),
	workisInAddress VARCHAR(250),	

	PRIMARY KEY (empId),
	FOREIGN KEY (workisInAddress) 
		REFERENCES Restaurant(address)
		ON DELETE CASCADE
);

CREATE TABLE Cashier (
	empId INTEGER,
	password VARCHAR(128),
	
	PRIMARY KEY (empId),
	FOREIGN KEY (empId)
		REFERENCES Employee(empId)
		ON DELETE CASCADE
);

CREATE TABLE KitchenStaff (
	empId INTEGER,
	position VARCHAR(250),
	
	PRIMARY KEY (empId),
	FOREIGN KEY (empId)
		REFERENCES Employee(empId)
		ON DELETE CASCADE
);

CREATE TABLE Waiter (
	empId INTEGER,
	manager INTEGER,
	
	PRIMARY KEY (empId),
	FOREIGN KEY (empId)
		REFERENCES Employee(empId)
		ON DELETE CASCADE,

	FOREIGN KEY (manager)
		REFERENCES Waiter(empId)
);

CREATE TABLE DinnerTable (
	address VARCHAR(250),
	tableNumber INTEGER,
	state VARCHAR(50),
	chairs INTEGER,
	waiter INTEGER,

	PRIMARY KEY (address, tableNumber),
	FOREIGN KEY (address)
		REFERENCES Restaurant(address),

	FOREIGN KEY (waiter)
		REFERENCES Waiter(empId)
);

CREATE TABLE Customer (
	name VARCHAR(150),
	phone VARCHAR(20),

	PRIMARY KEY (phone)
);

CREATE TABLE Reservation (
	reservationDateTime TIMESTAMP,
	reservationId INTEGER,
	phone VARCHAR(20),
	address VARCHAR(250),
	tableNumber INTEGER,
	arrivalTime TIME,

	PRIMARY KEY (reservationId),
	FOREIGN KEY (phone)
		REFERENCES Customer(phone)
		ON UPDATE NO ACTION
		ON DELETE NO ACTION,
	FOREIGN KEY (address, tableNumber)
		REFERENCES DinnerTable(address, tableNumber)
);

CREATE TABLE Terminal (
	brand VARCHAR(128),
	model VARCHAR(128),
	serialNo VARCHAR(128),
	lastInvoiceNo INTEGER,

	PRIMARY KEY (brand, model, serialNo)
);

CREATE TABLE DailyOperation (
	empId INTEGER,
	brand VARCHAR(128),
	model VARCHAR(128),
	serialNo VARCHAR(128),
	operation VARCHAR(1),
	operDate DATE,
	cash DECIMAL(5,2),
	
	PRIMARY KEY (empId, brand, model, serialNo, operation, operDate),
	FOREIGN KEY (empId)
		REFERENCES Cashier(empId),
	FOREIGN KEY (brand, model, serialNo)
		REFERENCES Terminal(brand, model, serialNo)
);

CREATE TABLE Invoice (
	invNumber INTEGER,
	discount DECIMAL(5,2),
	totalTax DECIMAL(5,2),
	invoiceDateTime TIMESTAMP,
	empId INTEGER,
	brand VARCHAR(128),
	model VARCHAR(128),
	serialNo VARCHAR(128),
	operation VARCHAR(1),
	operDate DATE,
	address VARCHAR(250),
	tableNumber INTEGER,
	customerPhone VARCHAR(20),

	PRIMARY KEY (invNumber),
	FOREIGN KEY (empId, brand, model, serialNo, operation, operDate)
		REFERENCES DailyOperation(empId, brand, model, serialNo, operation, operDate),
	FOREIGN KEY (address, tableNumber)
		REFERENCES DinnerTable(address, tableNumber),
	FOREIGN KEY (customerPhone)
		REFERENCES Customer(phone)

);

CREATE TABLE MenuItem (
	code VARCHAR(5),
	description VARCHAR(250),
	price DECIMAL(5,2),

	PRIMARY KEY (code)
);

CREATE TABLE Items (
	invNumber INTEGER,
	code VARCHAR(5),
	qty INTEGER,
	
	PRIMARY KEY (invNumber, code),
	FOREIGN KEY (invNumber)
		REFERENCES Invoice(invNumber),
	FOREIGN KEY (code)
		REFERENCES MenuItem(code)
);

# Grant PHP access to the database using the new user dbApp@localhost
CREATE USER 'dbApp'@'localhost' IDENTIFIED BY 'dbAppPassword';
GRANT ALL ON dba.* TO 'dbApp'@'localhost';