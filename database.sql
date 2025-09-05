DROP DATABASE IF EXISTS project;

CREATE DATABASE project;

USE project;

-- ========================
-- Hoofdtabel per categorie
-- ========================
CREATE TABLE
    laptops (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        image_url VARCHAR(255),
        description TEXT
    );

CREATE TABLE
    smartphones (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        image_url VARCHAR(255),
        description TEXT
    );

CREATE TABLE
    televisies (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        image_url VARCHAR(255),
        description TEXT
    );

CREATE TABLE
    tablets (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        image_url VARCHAR(255),
        description TEXT
    );

-- ========================
-- Detailtabellen per categorie
-- ========================
CREATE TABLE
    laptop_details (
        product_id INT,
        attribute VARCHAR(100),
        value TEXT,
        PRIMARY KEY (product_id, attribute),
        FOREIGN KEY (product_id) REFERENCES laptops (id) ON DELETE CASCADE
    );

CREATE TABLE
    smartphone_details (
        product_id INT,
        attribute VARCHAR(100),
        value TEXT,
        PRIMARY KEY (product_id, attribute),
        FOREIGN KEY (product_id) REFERENCES smartphones (id) ON DELETE CASCADE
    );

CREATE TABLE
    televisie_details (
        product_id INT,
        attribute VARCHAR(100),
        value TEXT,
        PRIMARY KEY (product_id, attribute),
        FOREIGN KEY (product_id) REFERENCES televisies (id) ON DELETE CASCADE
    );

CREATE TABLE
    tablet_details (
        product_id INT,
        attribute VARCHAR(100),
        value TEXT,
        PRIMARY KEY (product_id, attribute),
        FOREIGN KEY (product_id) REFERENCES tablets (id) ON DELETE CASCADE
    );

CREATE TABLE
    product_images (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        category VARCHAR(50) NOT NULL,
        image_url VARCHAR(255) NOT NULL
    );

INSERT INTO
    laptops (name, price, image_url, description)
VALUES
    (
        'Lenovo IdeaPad 3 15ALC6',
        499.00,
        'https://p2-ofp.static.pub//fes/cms/2023/09/01/2bvq999080vgli314b2nr5vvr8jkht467596.png',
        '15.6" FHD, AMD Ryzen 5 5500U, 8GB RAM, 512GB SSD.'
    ),
    (
        'Dell XPS 13 9310',
        999.00,
        'https://m.media-amazon.com/images/I/91MXLpouhoL._UF894,1000_QL80_.jpg',
        '13.4" 4K UHD+, Intel i7-1165G7, 16GB RAM, 512GB SSD.'
    ),
    (
        'MacBook Air M1 2020',
        1199.00,
        'https://files.refurbed.com/ii/apple-macbook-air-m1-2020-1626677621.jpg',
        '13.3" Retina, Apple M1, 8GB RAM, 256GB SSD.'
    ),
    (
        'HP Spectre x360 14',
        1099.00,
        'https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_135660643?x=536&y=402&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=536&ey=402&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=536&cdy=402',
        '14" OLED, Intel i7-1165G7, 16GB RAM, 512GB SSD.'
    ),
    (
        'Asus ROG Zephyrus G14',
        1499.00,
        'https://dlcdnwebimgs.asus.com/gain/DBB47F70-325D-4510-9E3E-0548FEF67FB1',
        '14" QHD, Ryzen 9 6900HS, RTX 3060, 16GB RAM.'
    ),
    (
        'Acer Swift 3 SF314',
        699.00,
        'https://files.refurbed.com/ii/acer-swift-3-sf314-511-1115g4-14-1680858575.jpg',
        '14" FHD, Ryzen 7 5700U, 8GB RAM, 512GB SSD.'
    ),
    (
        'Microsoft Surface Laptop 4',
        1299.00,
        'https://m.media-amazon.com/images/I/711jgF2LHPL.jpg',
        '13.5" Touch, Intel i5, 16GB RAM, 512GB SSD.'
    ),
    (
        'Razer Blade 15 Advanced',
        1799.00,
        'https://images-eu.ssl-images-amazon.com/images/I/81w-fj6Bo2L._AC_UL210_SR210,210_.jpg',
        '15.6" QHD, i7-11800H, RTX 3070, 16GB RAM.'
    ),
    (
        'LG Gram 17 (2022)',
        1399.00,
        'https://www.notebookcheck.nl/uploads/tx_nbc2/LGGram17Z90Q-2022__1_.JPG',
        '17" WQXGA, i7-1260P, 16GB RAM, 1TB SSD.'
    ),
    (
        'Samsung Galaxy Book Pro 360',
        999.00,
        'https://m.media-amazon.com/images/I/51MGrRJGndL.jpg',
        '15.6" AMOLED, i5-1135G7, 8GB RAM, 512GB SSD.'
    );

-- Laptop details
INSERT INTO
    laptop_details (product_id, attribute, value)
VALUES
    -- Lenovo IdeaPad 3 15ALC6
    (1, 'Schermgrootte', '15.6 inch'),
    (1, 'Resolutie', '1920x1080 (Full HD)'),
    (1, 'Processor', 'AMD Ryzen 5 5500U'),
    (1, 'RAM', '8 GB'),
    (1, 'SSD', '512 GB'),
    (1, 'WiFi', 'Wi-Fi 6'),
    (1, 'OS', 'Windows 11'),
    -- Dell XPS 13 9310
    (2, 'Schermgrootte', '13.4 inch'),
    (2, 'Resolutie', '3840x2400 (4K UHD+)'),
    (2, 'Processor', 'Intel Core i7-1165G7'),
    (2, 'RAM', '16 GB'),
    (2, 'SSD', '512 GB'),
    (2, 'WiFi', 'Wi-Fi 6'),
    (2, 'OS', 'Windows 11'),
    -- MacBook Air M1 2020
    (3, 'Schermgrootte', '13.3 inch'),
    (3, 'Resolutie', '2560x1600 (Retina)'),
    (3, 'Processor', 'Apple M1'),
    (3, 'RAM', '8 GB'),
    (3, 'SSD', '256 GB'),
    (3, 'WiFi', 'Wi-Fi 6'),
    (3, 'OS', 'macOS'),
    -- HP Spectre x360 14
    (4, 'Schermgrootte', '14 inch'),
    (4, 'Resolutie', '3000x2000 (OLED)'),
    (4, 'Processor', 'Intel Core i7-1165G7'),
    (4, 'RAM', '16 GB'),
    (4, 'SSD', '512 GB'),
    (4, 'GPU', 'Intel Iris Xe Graphics'),
    (4, 'WiFi', 'Wi-Fi 6'),
    (4, 'OS', 'Windows 11'),
    -- Asus ROG Zephyrus G14
    (5, 'Schermgrootte', '14 inch'),
    (5, 'Resolutie', '2560x1440 (QHD)'),
    (5, 'Processor', 'AMD Ryzen 9 6900HS'),
    (5, 'RAM', '16 GB'),
    (5, 'SSD', '1 TB'),
    (5, 'GPU', 'NVIDIA RTX 3060'),
    (5, 'WiFi', 'Wi-Fi 6'),
    (5, 'OS', 'Windows 11'),
    -- Acer Swift 3 SF314
    (6, 'Schermgrootte', '14 inch'),
    (6, 'Resolutie', '1920x1080 (Full HD)'),
    (6, 'Processor', 'AMD Ryzen 7 5700U'),
    (6, 'RAM', '8 GB'),
    (6, 'SSD', '512 GB'),
    (6, 'WiFi', 'Wi-Fi 6'),
    (6, 'OS', 'Windows 11'),
    -- Microsoft Surface Laptop 4
    (7, 'Schermgrootte', '13.5 inch'),
    (7, 'Resolutie', '2256x1504 (PixelSense)'),
    (7, 'Processor', 'Intel Core i5-1135G7'),
    (7, 'RAM', '16 GB'),
    (7, 'SSD', '512 GB'),
    (7, 'WiFi', 'Wi-Fi 6'),
    (7, 'OS', 'Windows 11'),
    -- Razer Blade 15 Advanced
    (8, 'Schermgrootte', '15.6 inch'),
    (8, 'Resolutie', '2560x1440 (QHD)'),
    (8, 'Processor', 'Intel Core i7-11800H'),
    (8, 'RAM', '16 GB'),
    (8, 'SSD', '1 TB'),
    (8, 'GPU', 'NVIDIA RTX 3070'),
    (8, 'WiFi', 'Wi-Fi 6'),
    (8, 'OS', 'Windows 11'),
    -- LG Gram 17 (2022)
    (9, 'Schermgrootte', '17 inch'),
    (9, 'Resolutie', '2560x1600 (WQXGA)'),
    (9, 'Processor', 'Intel Core i7-1260P'),
    (9, 'RAM', '16 GB'),
    (9, 'SSD', '1 TB'),
    (9, 'WiFi', 'Wi-Fi 6'),
    (9, 'OS', 'Windows 11'),
    -- Samsung Galaxy Book Pro 360
    (10, 'Schermgrootte', '15.6 inch'),
    (10, 'Resolutie', '1920x1080 (AMOLED)'),
    (10, 'Processor', 'Intel Core i5-1135G7'),
    (10, 'RAM', '8 GB'),
    (10, 'SSD', '512 GB'),
    (10, 'WiFi', 'Wi-Fi 6'),
    (10, 'OS', 'Windows 11');

-- ========================
-- Smartphones
-- ========================
INSERT INTO
    smartphones (name, price, image_url, description)
VALUES
    (
        'Samsung Galaxy S21 5G',
        699.00,
        'https://m.media-amazon.com/images/I/81IWsqrVMTL._UF1000,1000_QL80_.jpg',
        '6.2" AMOLED, Exynos 2100, 8GB RAM, 128GB opslag.'
    ),
    (
        'iPhone 13 128GB',
        899.00,
        'https://m.media-amazon.com/images/I/61dmg9dKY5L._UF1000,1000_QL80_.jpg',
        '6.1" Super Retina XDR, A15 Bionic chip.'
    ),
    (
        'Google Pixel 6',
        599.00,
        'https://m.media-amazon.com/images/I/61ruKkvVIxL._UF894,1000_QL80_.jpg',
        '6.4" OLED, Google Tensor, 8GB RAM.'
    ),
    (
        'OnePlus 9',
        729.00,
        'https://m.media-amazon.com/images/I/61w33ZxcHfS._UF1000,1000_QL80_.jpg',
        '6.55" AMOLED, Snapdragon 888, 12GB RAM.'
    ),
    (
        'Xiaomi Mi 11',
        649.00,
        'https://i02.appmifile.com/398_updatepdf_in/08/02/2021/06cdb2c3ab4322ead34553df3de7a349.png',
        '6.81" AMOLED, Snapdragon 888, 8GB RAM.'
    ),
    (
        'Samsung Galaxy S22',
        799.00,
        'https://m.media-amazon.com/images/I/71dhExJEEWL._UF1000,1000_QL80_.jpg',
        '6.1" AMOLED, Exynos 2200, 8GB RAM.'
    ),
    (
        'iPhone 13 Pro 256GB',
        1099.00,
        'https://m.media-amazon.com/images/I/51tFyA6q6eL.jpg',
        '6.1" ProMotion display, A15 Bionic chip.'
    ),
    (
        'Google Pixel 5a 5G',
        449.00,
        'https://static.androidplanet.nl/orca/products/20613/google-pixel-5a.png',
        '6.34" OLED, Snapdragon 765G, 6GB RAM.'
    ),
    (
        'OnePlus Nord 2 5G',
        399.00,
        'https://oasis.opstatics.com/content/dam/oasis/page/2021/ebba/spec/nord2_Gray_Sierra.png',
        '6.43" AMOLED, Dimensity 1200-AI, 8GB RAM.'
    ),
    (
        'Xiaomi Redmi Note 10',
        299.00,
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSEsd0SUJJZOIXJ_6F4hbfJ5UiUEGCaFN8eDQ&s',
        '6.43" AMOLED, Snapdragon 678, 4GB RAM.'
    );

-- Smartphone details
INSERT INTO
    smartphone_details (product_id, attribute, value)
VALUES
    (1, 'Schermgrootte', '6.2 inch'),
    (1, 'Processor', 'Exynos 2100'),
    (1, 'RAM', '8 GB'),
    (1, 'Opslag', '128 GB'),
    (2, 'Schermgrootte', '6.1 inch'),
    (2, 'Processor', 'A15 Bionic'),
    (2, 'Opslag', '128 GB'),
    (3, 'Schermgrootte', '6.4 inch'),
    (3, 'Processor', 'Google Tensor'),
    (3, 'RAM', '8 GB'),
    (4, 'Schermgrootte', '6.55 inch'),
    (4, 'Processor', 'Snapdragon 888'),
    (4, 'RAM', '12 GB'),
    (5, 'Schermgrootte', '6.81 inch'),
    (5, 'Processor', 'Snapdragon 888'),
    (5, 'RAM', '8 GB'),
    (6, 'Schermgrootte', '6.1 inch'),
    (6, 'Processor', 'Exynos 2200'),
    (6, 'RAM', '8 GB'),
    (7, 'Schermgrootte', '6.1 inch'),
    (7, 'Processor', 'A15 Bionic'),
    (7, 'Opslag', '256 GB'),
    (8, 'Schermgrootte', '6.34 inch'),
    (8, 'Processor', 'Snapdragon 765G'),
    (8, 'RAM', '6 GB'),
    (9, 'Schermgrootte', '6.43 inch'),
    (9, 'Processor', 'Dimensity 1200-AI'),
    (9, 'RAM', '8 GB'),
    (10, 'Schermgrootte', '6.43 inch'),
    (10, 'Processor', 'Snapdragon 678'),
    (10, 'RAM', '4 GB');

-- ========================
-- Televisies
-- ========================
INSERT INTO
    televisies (name, price, image_url, description)
VALUES
    (
        'LG OLED55C1',
        1199.00,
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRnAQScfN3eilrHdmYNRGiwzHCkwsGekwbPbg&s',
        '55" OLED 4K, webOS, Dolby Vision IQ.'
    ),
    (
        'Samsung QLED Q80A 65"',
        1399.00,
        'https://i0.wp.com/mrspeazy.nl/wp-content/uploads/2022/02/mrspeazy.nl-samsung-qe65q80a-65-inch-4k-qled-2021-2.jpg?fit=543%2C408&ssl=1',
        '65" QLED 4K, Quantum HDR, Tizen OS.'
    ),
    (
        'Sony Bravia XR-55X90J',
        999.00,
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuSZA6RK5U3KYmgufdO4ddCEVoOPwyJk7ChQ&s',
        '55" Full Array LED, 4K HDR, Google TV.'
    ),
    (
        'Philips 50PUS7906/12',
        799.00,
        'https://images.philips.com/is/image/philipsconsumer/5f675838b6eb4bfc9f31afb700cbaeb8?$pnglarge$&wid=1250',
        '50" 4K LED met driezijdig Ambilight.'
    ),
    (
        'TCL 55C735',
        599.00,
        'https://m.media-amazon.com/images/I/811Guo58JKL.jpg',
        '55" QLED 4K, Dolby Vision/Atmos, Android TV.'
    ),
    (
        'Panasonic TX-65HZ2000E',
        2499.00,
        'https://tweakers.net/ext/i/2004021338.jpeg',
        '65" OLED Master HDR, Dolby Vision/Atmos.'
    ),
    (
        'Hisense 50U8QF',
        699.00,
        'https://imgsrv.toppreise.ch/img/616927/200-ed4c3a',
        '50" ULED 4K, Dolby Vision, Smart TV.'
    ),
    (
        'Samsung The Frame QE55LS03A',
        1299.00,
        'https://quickgoods.nl/cdn/shop/products/SamsungTheFrameQE55LS03A_2021__2_1024x.png?v=1642954955',
        '55" QLED 4K, Art Mode, Slim Fit Wall Mount.'
    ),
    (
        'Sony A90J OLED 65"',
        2499.00,
        'https://www.sony.nl/image/ded064d5e0d54aa1db7666326421fec1?fmt=pjpeg&wid=330&bgcolor=FFFFFF&bgc=FFFFFF',
        '65" 4K OLED, Google TV, XR Contrast Pro.'
    ),
    (
        'LG NanoCell 75NANO966PA',
        1799.00,
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsKl6g-TzxP1Sqpoc6MNV6lFAxDEWWtEIm0w&s',
        '75" 8K NanoCell, α9 Gen4 AI-processor.'
    );

-- Televisie details
INSERT INTO
    televisie_details (product_id, attribute, value)
VALUES
    (1, 'Schermgrootte', '55 inch'),
    (1, 'Resolutie', '3840x2160'),
    (1, 'Paneeltype', 'OLED'),
    (1, 'Smart OS', 'webOS'),
    (2, 'Schermgrootte', '65 inch'),
    (2, 'Resolutie', '3840x2160'),
    (2, 'Paneeltype', 'QLED'),
    (2, 'Smart OS', 'Tizen OS'),
    (3, 'Schermgrootte', '55 inch'),
    (3, 'Resolutie', '3840x2160'),
    (3, 'Paneeltype', 'LED'),
    (3, 'Smart OS', 'Google TV'),
    (4, 'Schermgrootte', '50 inch'),
    (4, 'Resolutie', '3840x2160'),
    (4, 'Paneeltype', 'LED'),
    (4, 'Smart OS', 'Philips Ambilight'),
    (5, 'Schermgrootte', '55 inch'),
    (5, 'Resolutie', '3840x2160'),
    (5, 'Paneeltype', 'QLED'),
    (5, 'Smart OS', 'Android TV'),
    (6, 'Schermgrootte', '65 inch'),
    (6, 'Resolutie', '3840x2160'),
    (6, 'Paneeltype', 'OLED'),
    (6, 'Smart OS', 'Dolby Vision/Atmos'),
    (7, 'Schermgrootte', '50 inch'),
    (7, 'Resolutie', '3840x2160'),
    (7, 'Paneeltype', 'ULED'),
    (7, 'Smart OS', 'Smart TV'),
    (8, 'Schermgrootte', '55 inch'),
    (8, 'Resolutie', '3840x2160'),
    (8, 'Paneeltype', 'QLED'),
    (8, 'Smart OS', 'Art Mode'),
    (9, 'Schermgrootte', '65 inch'),
    (9, 'Resolutie', '3840x2160'),
    (9, 'Paneeltype', 'OLED'),
    (9, 'Smart OS', 'Google TV'),
    (10, 'Schermgrootte', '75 inch'),
    (10, 'Resolutie', '7680x4320'),
    (10, 'Paneeltype', 'NanoCell'),
    (10, 'Smart OS', 'α9 Gen4 AI-processor');

-- ========================
-- Tablets
-- ========================
INSERT INTO
    tablets (name, price, image_url, description)
VALUES
    (
        'Apple iPad Pro 12.9" (M1)',
        1099.00,
        'https://m.media-amazon.com/images/I/81+N4PFF7jS._UF894,1000_QL80_.jpg',
        '12.9" Mini-LED, M1 chip, 128GB opslag.'
    ),
    (
        'Samsung Galaxy Tab S7+',
        649.00,
        'https://m.media-amazon.com/images/I/81X3d7t9qGS.jpg',
        '12.4" AMOLED, Snapdragon 865+, 6GB RAM.'
    ),
    (
        'Microsoft Surface Pro 7',
        899.00,
        'https://files.refurbed.com/ii/microsoft-surface-pro-7-1065g7-1663078872.jpg',
        '12.3" PixelSense, i5, 8GB RAM, 128GB SSD.'
    ),
    (
        'Amazon Fire HD 10 (2021)',
        149.00,
        'https://m.media-amazon.com/images/G/01/kindle/journeys/WTN3CxScwzgi6KWIbtm8Xorm6sx50imat82FEiOH0xK83D/M2JiMjU1ZTYt._CB670552974_.jpg',
        '10.1" Full HD, octa-core, 3GB RAM.'
    ),
    (
        'Lenovo Tab P11 Pro',
        499.00,
        'https://p1-ofp.static.pub//fes/cms/2023/09/26/k12v23mlm68hhowhswpctd2l5onil1639804.png',
        '11.5" OLED, Snapdragon 730G, 6GB RAM.'
    ),
    (
        'Apple iPad Air (5e gen)',
        599.00,
        'https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/refurb-ipad-air-5th-gen-wifi-spacegray-202409?wid=4000&hei=4000&fmt=jpeg&qlt=90&.v=1721699935882',
        '10.9" Liquid Retina, M1 chip, 64GB opslag.'
    ),
    (
        'Samsung Galaxy Tab A7',
        229.00,
        'https://m.media-amazon.com/images/I/71z9fCHuv3L.jpg',
        '10.4" TFT, Snapdragon 662, 3GB RAM.'
    ),
    (
        'Huawei MatePad Pro 10.8"',
        549.00,
        'https://m.media-amazon.com/images/I/51HxLMWrFML._UF894,1000_QL80_.jpg',
        '10.8" IPS, Kirin 990, 6GB RAM.'
    ),
    (
        'Microsoft Surface Go 2',
        399.00,
        'https://www.estunt.nl/wp-content/uploads/2020/09/Estunt-Microsoft-Surface-Go-2.jpg',
        '10.5" Touch, Pentium Gold, 4GB RAM.'
    ),
    (
        'Apple iPad Mini (6e gen)',
        499.00,
        'https://ipaddy.nl/wp-content/uploads/2023/10/2.jpg',
        '8.3" Liquid Retina, A15 chip, 64GB opslag.'
    );

-- Tablet details
INSERT INTO
    tablet_details (product_id, attribute, value)
VALUES
    -- Apple iPad Pro 12.9" (M1)
    (1, 'Schermgrootte', '12.9 inch'),
    (1, 'Resolutie', '2732x2048'),
    (1, 'Processor', 'Apple M1'),
    (1, 'Opslag', '128 GB'),
    (1, 'RAM', '8 GB'),
    -- Samsung Galaxy Tab S7+
    (2, 'Schermgrootte', '12.4 inch'),
    (2, 'Resolutie', '2800x1752'),
    (2, 'Processor', 'Snapdragon 865+'),
    (2, 'RAM', '6 GB'),
    (2, 'Opslag', '128 GB'),
    -- Microsoft Surface Pro 7
    (3, 'Schermgrootte', '12.3 inch'),
    (3, 'Resolutie', '2736x1824'),
    (3, 'Processor', 'Intel i5'),
    (3, 'RAM', '8 GB'),
    (3, 'Opslag', '128 GB'),
    -- Amazon Fire HD 10 (2021)
    (4, 'Schermgrootte', '10.1 inch'),
    (4, 'Resolutie', '1920x1200'),
    (4, 'Processor', 'Octa-core'),
    (4, 'RAM', '3 GB'),
    (4, 'Opslag', '32 GB'),
    -- Lenovo Tab P11 Pro
    (5, 'Schermgrootte', '11.5 inch'),
    (5, 'Resolutie', '2560x1600'),
    (5, 'Processor', 'Snapdragon 730G'),
    (5, 'RAM', '6 GB'),
    (5, 'Opslag', '128 GB'),
    -- Apple iPad Air (5e gen)
    (6, 'Schermgrootte', '10.9 inch'),
    (6, 'Resolutie', '2360x1640'),
    (6, 'Processor', 'Apple M1'),
    (6, 'RAM', '4 GB'),
    (6, 'Opslag', '64 GB'),
    -- Samsung Galaxy Tab A7
    (7, 'Schermgrootte', '10.4 inch'),
    (7, 'Resolutie', '2000x1200'),
    (7, 'Processor', 'Snapdragon 662'),
    (7, 'RAM', '3 GB'),
    (7, 'Opslag', '32 GB'),
    -- Huawei MatePad Pro 10.8"
    (8, 'Schermgrootte', '10.8 inch'),
    (8, 'Resolutie', '2560x1600'),
    (8, 'Processor', 'Kirin 990'),
    (8, 'RAM', '6 GB'),
    (8, 'Opslag', '128 GB'),
    -- Microsoft Surface Go 2
    (9, 'Schermgrootte', '10.5 inch'),
    (9, 'Resolutie', '1920x1280'),
    (9, 'Processor', 'Pentium Gold'),
    (9, 'RAM', '4 GB'),
    (9, 'Opslag', '64 GB'),
    -- Apple iPad Mini (6e gen)
    (10, 'Schermgrootte', '8.3 inch'),
    (10, 'Resolutie', '2266x1488'),
    (10, 'Processor', 'Apple A15'),
    (10, 'RAM', '4 GB'),
    (10, 'Opslag', '64 GB');

-- ========================
-- Users tabel
-- ========================
CREATE TABLE
    IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

INSERT INTO
    users (username, password)
VALUES
    ('admin', 'admin123');
