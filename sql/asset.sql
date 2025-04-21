-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 10:28 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS asset;
USE asset;

CREATE TABLE asset (
    id int(10) NOT NULL AUTO_INCREMENT,
    code varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    type varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    description varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    serial varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO asset (id, code, type, description, serial) VALUES
(1, 'AC001', 'Computer', 'Desktop PC', 'SN001'),
(2, 'AC002', 'Monitor', '24-inch LCD', 'SN002'),
(3, 'AC003', 'Printer', 'Laser Printer', 'SN003'),
(4, 'AC004', 'Desk', 'Wooden Desk', 'SN004'),
(5, 'AC005', 'Chair', 'Ergonomic Chair', 'SN005'),
(6, 'AC006', 'Laptop', '15-inch Laptop', 'SN006'),
(7, 'AC007', 'Projector', 'HD Projector', 'SN007'),
(8, 'AC008', 'Scanner', 'Flatbed Scanner', 'SN008'),
(9, 'AC009', 'Keyboard', 'Mechanical Keyboard', 'SN009'),
(10, 'AC010', 'Mouse', 'Wireless Mouse', 'SN010');

ALTER TABLE asset MODIFY id int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;