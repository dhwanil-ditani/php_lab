drop database if exists practical6b;

create database practical6b;

use practical6b;

create table student (
    `rollNo` varchar(8),
    `Name` varchar(20),
    `emailID` varchar(30),
    `phoneNo` varchar(10),
    `subject1` int,
    `subject2` int,
    `subject3` int,
    `total` int
);
