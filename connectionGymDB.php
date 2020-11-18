<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
        
        $servername = 'localhost';
		$username = 'root';
		$password = '';
		$db_name = 'fitness_gym';

		$conn = new mysqli($servername, $username, $password, '');

		$select = $conn->select_db($db_name);
        
        if(!$select){
            $conn->query("CREATE DATABASE $db_name");
            $conn->select_db($db_name);
            $conn->query("CREATE TABLE person(
                    personID INT(10) AUTO_INCREMENT,
                    fName VARCHAR(20) NOT NULL,
                    lName VARCHAR(20) NOT NULL,
                    birthday DATE NOT NULL,
                    streetAddress VARCHAR(100) NOT NULL,
                    city VARCHAR(50) NOT NULL,
                    emailAdress VARCHAR(20) NOT NULL,
                    phoneNumber VARCHAR (11) NOT NULL,
                    username VARCHAR(20) NOT NULL,
                    password VARCHAR(20) NOT NULL,
                    userType ENUM('customer','employee') NOT NULL,
                    photo VARCHAR(50) NOT NULL,
                    PRIMARY KEY(personID)
                    )");

            $conn->query("CREATE TABLE customer(
                    customerID INT(10) AUTO_INCREMENT,	-- customerID = personID with userType customer
                    emergencyContactName VARCHAR(50) NOT NULL,
                    emergencyContactNumber VARCHAR(11) NOT NULL,
                	height INT(3) NOT NULL,
                	weight INT (3) NOT NULL,
                	preExistingConditions VARCHAR(100) NOT NULL,
                	memberTypeID ENUM('1','2','3') NOT NULL,
                	assignedEmployeeID INT(10) NOT NULL,
                	personID INT(10) NOT NULL,	-- personID = employeeID ????
                    PRIMARY KEY(customerID)
                    )");

            $conn->query("CREATE TABLE employee(
                    employeeID INT(10) AUTO_INCREMENT,	-- employeeID = personID with userType employee ??? AUTO_INCREMENT???
                    dateHired DATE NOT NULL,
                    dateSeparated DATE NOT NULL,
                    monthlySalary INT(10) NOT NULL, 
                    noOfTrainees INT(5) NOT NULL,
                    personID INT(10) NOT NULL,
                    PRIMARY KEY(employeeID)
                    )");

            $conn->query("CREATE TABLE entry_log(
                    logID INT(10) AUTO_INCREMENT,	
                    entryTime DATETIME NOT NULL,
                    exitTime DATETIME NOT NULL,
                    personID INT (10) NOT NULL,	-- personID with userType employee that logged in the customer who entered the gym
                    PRIMARY KEY(logID)
                    )");  
            
            $conn->query("CREATE TABLE membership_history(
                    membershipHistoryID INT(10) AUTO_INCREMENT,	
                    startDate DATETIME NOT NULL,
                    expiryDate DATETIME NOT NULL,
                    customerID INT(10) NOT NULL,
                    PRIMARY KEY(membershipHistoryID)
                    )");

            $conn->query("CREATE TABLE member_type(
                    memberTypeID ENUM('1','2','3') NOT NULL,
                    memberTypeName ENUM('Walk-In','Monthly','Premium') NOT NULL,
                    price INT(5) NOT NULL,
                    PRIMARY KEY(memberTypeID)
                    )");

            $conn->query("CREATE TABLE membership(  
                    membershipID INT(10) AUTO_INCREMENT,
                    memberTypeID INT(10) NOT NULL,
                    membershipHistoryID INT(10) NOT NULL,
                    orderID INT(10) NOT NULL,
                    PRIMARY KEY(membershipID)
                    )");

            $conn->query("CREATE TABLE remark(
                    remarkID INT(10) AUTO_INCREMENT,
                    remarkContent VARCHAR(100),
                    remarkDate DATETIME,
                    employeeID INT(10) NOT NULL,
                    customerID INT(10) NOT NULL,
                    PRIMARY KEY(remarkID)
                    )");

            $conn->query("CREATE TABLE orders(
                    orderID INT(10) AUTO_INCREMENT,
                    amountReceived INT(5) NOT NULL,
                    customerChange INT(5) NOT NULL,
                    orderDate DATETIME NOT NULL,
                    customerID INT(10) NOT NULL,
                    employeeID INT(10) NOT NULL,
                    PRIMARY KEY(orderID)
                    )");

            $conn->query("CREATE TABLE basket(
                    basketID INT(10) AUTO_INCREMENT,
                    quantity INT(5) NOT NULL,
                    orderID INT(10) NOT NULL,
                    itemID INT(10) NOT NULL,
                    customizeID INT(3) NOT NULL,
                    membershipID INT(10) NOT NULL,
                    PRIMARY KEY(basketID)
                    )");
            $conn->query("CREATE TABLE inventory_log(
                    inventoryLogID INT(10) AUTO_INCREMENT,
                    checkingDate DATETIME,
                    amountLeft INT(3) NOT NULL,
                    amountSold INT(3) NOT NULL,
                    itemID INT(10) NOT NULL,
                    PRIMARY KEY(inventoryLogID)
                    )");
            $conn->query("CREATE TABLE item(
                    itemID INT(10) AUTO_INCREMENT,
                    itemName VARCHAR(100),
                    itemPrice INT(5) NOT NULL,
                    description VARCHAR(100),
                    image VARCHAR(50) NOT NULL,
                    PRIMARY KEY(itemID)
                    )");
            $conn->query("CREATE TABLE batch(
                    batchID INT(10) AUTO_INCREMENT,
                    batchAmount INT(5) NOT NULL,
                    expiryDate DATETIME,
                    dateReceived DATETIME,
                    itemID INT(10) NOT NULL,
                    employeeID INT(10) NOT NULL,
                    PRIMARY KEY(batchID)
                    )");
            
        }    
    ?>

    <p></p>

</body>
</html>