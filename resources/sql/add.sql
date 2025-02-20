INSERT INTO brands (name, enabled) VALUES ('Audi', 1);
INSERT INTO brands (name, enabled) VALUES ('BMW', 1);
INSERT INTO brands (name, enabled) VALUES ('Seat', 1);

INSERT INTO colors (name, hex, enabled) VALUES ('Azul', '#4287f5', 1);
INSERT INTO colors (name, hex, enabled) VALUES ('Amarillo', '#f5e642', 1);
INSERT INTO colors (name, hex, enabled) VALUES ('Rojo', '#f54242', 1);

INSERT INTO types (name, enabled) VALUES ('SUV', 1);
INSERT INTO types (name, enabled) VALUES ('Deportivo', 1);
INSERT INTO types (name, enabled) VALUES ('Pick Up', 1);
INSERT INTO types (name, enabled) VALUES ('Caravana', 1);

INSERT INTO cars (name, brand_id, color_id, type_id, year, main_img, horsepower, sale, enabled) VALUES ('A1', 1, 1, 1, 2019, 'audi_a1.jpg', 150, 1, 1);
INSERT INTO cars (name, brand_id, color_id, type_id, year, main_img, horsepower, sale, enabled) VALUES ('A3', 1, 2, 2, 2018, 'audi_a3.jpg', 200, 1, 1);
INSERT INTO cars (name, brand_id, color_id, type_id, year, main_img, horsepower, sale, enabled) VALUES ('A4', 1, 3, 3, 2017, 'audi_a4.jpg', 250, 0, 1);
INSERT INTO cars (name, brand_id, color_id, type_id, year, main_img, horsepower, sale, enabled) VALUES ('Cordoba', 3, 2, 2, 2002, 'cordoba.jpg', 93, 0, 1);