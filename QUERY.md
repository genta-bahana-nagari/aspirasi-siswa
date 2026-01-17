
# Query List

Berikut adalah daftar perintah query untuk membuat tabel:
- Pengguna (untuk admin dan siswa)
- Aspirasi
- Kategori Aspirasi
- Feedback

```
 CREATE DATABASE <nama_db>;
```

```
 CREATE TABLE users (
   id INT AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(100),
   name VARCHAR(100),
   email VARCHAR(100) UNIQUE,
   password VARCHAR(255),
   role ENUM('student','admin'),
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

```
CREATE TABLE categories (
   id INT AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(100) NOT NULL,
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
```

```
CREATE TABLE aspirations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    category_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM(
        'Terkirim',
        'Diproses',
        'Dalam Perbaikan',
        'Selesai'
    ) DEFAULT 'Terkirim',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    CONSTRAINT fk_aspirations_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_aspirations_category
        FOREIGN KEY (category_id) REFERENCES categories(id)
        ON DELETE RESTRICT
) ENGINE=InnoDB;
```

```
CREATE TABLE aspiration_feedbacks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aspiration_id INT NOT NULL,
    admin_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    feedback TEXT NOT NULL,
    status ENUM(
        'Diproses',
        'Dalam Perbaikan',
        'Selesai'
    ) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_aspirations_feedback
        FOREIGN KEY (aspiration_id) REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_feedback_admin
        FOREIGN KEY (admin_id) REFERENCES users(id)
        ON DELETE RESTRICT
) ENGINE=InnoDB;
```