CREATE DATABASE perpus2;
USE perpus2;

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','siswa') NOT NULL
);

INSERT INTO user (username, password, role)
VALUES ('admin', 'admin', 'admin');

CREATE TABLE buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul_buku VARCHAR(255) NOT NULL,
    penulis VARCHAR(255) NOT NULL,
    status ENUM('tersedia','tidak') NOT NULL DEFAULT 'tersedia'
);

CREATE TABLE peminjaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_buku INT NOT NULL,
    id_user INT NOT NULL,
    tgl_pinjam DATE NOT NULL,
    tgl_kembali DATE NULL,
    FOREIGN KEY (id_buku) REFERENCES buku(id) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE
);
