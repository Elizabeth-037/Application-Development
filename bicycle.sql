CREATE DATABASE IF NOT EXISTS bicycle;

USE bicycle;

CREATE TABLE IF NOT EXISTS bicycle (
    id INTEGER PRIMARY KEY,
    customized BOOLEAN NOT NULL DEFAULT false, -- false, true
    category INTEGER NOT NULL DEFAULT 0, -- 0 for road, 1 for mountain
    imgUrl VARCHAR(255),
    series VARCHAR(255),
    color INTEGER NOT NULL DEFAULT 0, -- 0 for default, 1 for red, 2 for black
    hub INTEGER NOT NULL DEFAULT 0, -- 0 for default, 1 for spoke, 2 for solid
    description TEXT,
    price INTEGER
);

INSERT INTO bicycle (id, customized, category, imgUrl, series, color, hub, description, price) VALUES
(1, true, 0, 'images/1.png', 'Breeze', 2, 1, '', 1888),
(2, true, 0, 'images/2.png', 'Breeze', 2, 2, '', 2688),
(3, true, 0, 'images/3.png', 'Breeze', 1, 1, '', 2000),
(4, true, 0, 'images/4.png', 'Breeze', 1, 2, '', 2788),
(5, true, 0, 'images/5.png', 'Lightning', 2, 1, '', 1999),
(6, true, 0, 'images/6.png', 'Lightning', 2, 2, '', 2300),
(7, true, 0, 'images/7.png', 'Lightning', 1, 1, '', 2789),
(8, true, 0, 'images/8.png', 'Lightning', 1, 2, '', 2200),
(9, true, 1, 'images/9.png', 'Flash', 2, 1, '', 2678),
(10, true, 1, 'images/10.png', 'Flash', 2, 2, '', 2573),
(11, true, 1, 'images/11.png', 'Flash', 1, 1, '', 2331),
(12, true, 1, 'images/12.png', 'Flash', 1, 2, '', 2876),
(13, true, 1, 'images/13.png', 'Spark', 2, 1, '', 1900),
(14, true, 1, 'images/14.png', 'Spark', 2, 2, '', 2017),
(15, true, 1, 'images/15.png', 'Spark', 1, 1, '', 2705),
(16, true, 1, 'images/16.png', 'Spark', 1, 2, '', 1980),
(17, false, 0, 'images/17.png', 'Clear Water', 0, 0, '', 2095),
(18, false, 0, 'images/18.png', 'Stars', 0, 0, '', 2447),
(19, false, 0, 'images/19.png', 'Green Forest', 0, 0, '', 2685),
(20, false, 0, 'images/20.png', 'Ice and Snow', 0, 0, '', 2266),
(21, false, 0, 'images/21.png', 'Flame', 0, 0, '', 2888),
(22, false, 0, 'images/22.png', 'Purple Clouds', 0, 0, '', 2153),
(23, false, 0, 'images/23.png', 'Snowflake', 0, 0, '', 2024),
(24, false, 0, 'images/24.png', 'Gold Stone', 0, 0, '', 2781),
(25, false, 0, 'images/25.png', 'Smoke Cloud', 0, 0, '', 2972),
(26, false, 0, 'images/26.png', 'Blue Sea', 0, 0, '', 2038),
(27, false, 0, 'images/27.png', 'Soaring', 0, 0, '', 2219),
(28, false, 0, 'images/28.png', 'Brilliant', 0, 0, '', 2566),
(29, false, 0, 'images/29.png', 'Thunder', 0, 0, '', 2750),
(30, false, 0, 'images/30.png', 'Bright Moon', 0, 0, '', 1976),
(31, false, 1, 'images/31.png', 'Gentle Breeze', 0, 0, '', 2315),
(32, false, 1, 'images/32.png', 'Enchanting Meadow', 0, 0, '', 2901),
(33, false, 1, 'images/33.png', 'Dazzling Glacier', 0, 0, '', 2507),
(34, false, 1, 'images/34.png', 'Radiant Fire', 0, 0, '', 1932),
(35, false, 1, 'images/35.png', 'Violet Sky', 0, 0, '', 2837),
(36, false, 1, 'images/36.png', 'Ivory Frost', 0, 0, '', 2954),
(37, false, 1, 'images/37.png', 'Golden Nugget', 0, 0, '', 2219),
(38, false, 1, 'images/38.png', 'Misty Haze', 0, 0, '', 2566),
(39, false, 1, 'images/39.png', 'Azure Waves', 0, 0, '', 2750),
(40, false, 1, 'images/40.png', 'Ethereal Flight', 0, 0, '', 1976),
(41, false, 1, 'images/41.png', 'Sparkling Jewel', 0, 0, '', 2315),
(42, false, 1, 'images/42.png', 'Roaring Storm', 0, 0, '', 2901),
(43, false, 1, 'images/43.png', 'Luminous Night', 0, 0, '', 2507),
(44, false, 1, 'images/44.png', 'Bright Sun', 0, 0, '', 1932);

