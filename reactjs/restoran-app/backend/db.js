const { Sequelize } = require('sequelize');

// Buat koneksi ke database MySQL
const db = new Sequelize('dbrestoran', 'root', '', {
  host: 'localhost',
  dialect: 'mysql',
  logging: false, // set true jika ingin lihat query di terminal
});

// Coba koneksi
db.authenticate()
  .then(() => {
    console.log('✅ Koneksi ke database berhasil.');
  })
  .catch((err) => {
    console.error('❌ Gagal koneksi ke database:', err);
  });

module.exports = db;
