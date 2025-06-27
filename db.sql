create database myproject;
USE myproject;

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- ID único del cliente
    client_name VARCHAR(255) NOT NULL,          -- Nombre del cliente
    email VARCHAR(255) NOT NULL UNIQUE,         -- Correo electrónico del cliente
    phone VARCHAR(20) NOT NULL                 -- Teléfono del cliente
);

INSERT INTO clients (client_name, email, phone) VALUES
('Pedro', 'pedro@example.com', '123456789'),
('Juan', 'juan@example.com', '987654321'),
('Maria', 'maria@example.com', '111223344');

CREATE TABLE barbers (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- ID único del barbero
    barber_name VARCHAR(255) NOT NULL          -- Nombre del barbero
);
INSERT INTO barbers (barber_name) VALUES
('Juan'),
('Pedro'),
('María');

CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- ID único para el servicio
    service_name VARCHAR(255) NOT NULL,         -- Nombre del servicio (por ejemplo, "Corte de Cabello")
    base_price DECIMAL(10, 2) NOT NULL         -- Precio base del servicio
);
INSERT INTO services (service_name, base_price) VALUES
('Corte de Cabello', 20.00),
('Afeitado', 15.00),
('Tratamiento Capilar', 25.00);

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- ID único de la cita
    client_id INT NOT NULL,                    -- ID del cliente (relación con la tabla clients)
    barber_id INT NOT NULL,                    -- ID del barbero (relación con la tabla barbers)
    date DATE NOT NULL,                        -- Fecha de la cita
    time TIME NOT NULL,                        -- Hora de la cita
    total_price DECIMAL(10, 2) DEFAULT 0.00,   -- Precio total de la cita, que se calculará más tarde
    status VARCHAR(50) DEFAULT 'Pendiente',    -- Estado de la cita (Pendiente, Confirmada, Completada)
    FOREIGN KEY (client_id) REFERENCES clients(id), -- Relación con clients
    FOREIGN KEY (barber_id) REFERENCES barbers(id)  -- Relación con barbers
);

INSERT INTO appointments (client_id, barber_id, date, time) VALUES
(1, 1, '2025-06-28', '10:00:00'),
(2, 2, '2025-06-28', '11:00:00'),
(3, 3, '2025-06-28', '12:00:00');

CREATE TABLE appointment_services (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- ID único
    appointment_id INT NOT NULL,                -- ID de la cita (relación con appointments)
    service_id INT NOT NULL,                    -- ID del servicio (relación con services)
    barber_id INT NOT NULL,                     -- ID del barbero que realizó el servicio
    service_price DECIMAL(10, 2) NOT NULL,      -- Precio del servicio dependiendo del barbero
    FOREIGN KEY (appointment_id) REFERENCES appointments(id),  -- Relación con appointments
    FOREIGN KEY (service_id) REFERENCES services(id),          -- Relación con services
    FOREIGN KEY (barber_id) REFERENCES barbers(id)             -- Relación con barbers
);
-- Pedro (cita 1) reservó "Corte de Cabello" y "Afeitado" con barbero Juan
INSERT INTO appointment_services (appointment_id, service_id, barber_id, service_price) VALUES
(1, 1, 1, 20.00),  -- Corte de Cabello con Juan
(1, 2, 1, 15.00);  -- Afeitado con Juan

-- Juan (cita 2) reservó "Corte de Cabello" con barbero Pedro
INSERT INTO appointment_services (appointment_id, service_id, barber_id, service_price) VALUES
(2, 1, 2, 25.00);  -- Corte de Cabello con Pedro

-- María (cita 3) reservó "Tratamiento Capilar" con barbero María
INSERT INTO appointment_services (appointment_id, service_id, barber_id, service_price) VALUES
(3, 3, 3, 25.00);  -- Tratamiento Capilar con María

DESCRIBE clients;
DESCRIBE barbers;
DESCRIBE services;
DESCRIBE appointments;
DESCRIBE appointment_services;

