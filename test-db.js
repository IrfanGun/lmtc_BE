import { createConnection } from 'mysql2';

// Ganti dengan data yang sesuai dari `.env` Laravel kamu
const connection = createConnection({
  host: 'hopkinsfoundation-members.com',         // atau IP server DB
  user: 'hopkins_dev',       // username
  password: '92S7,X24XWSz',    // password
  database: 'hopkins_db',    // nama database
  port: 3306
});

connection.connect((err) => {
  if (err) {
    console.error('❌ Gagal konek ke database:', err.message);
    return;
  }
  console.log('✅ Berhasil konek ke database MySQL Laravel');

  // Optional: uji query
  connection.query('SHOW TABLES', (err, results) => {
    if (err) throw err;
    console.log('📦 Daftar tabel:', results);
    connection.end();
  });
});
