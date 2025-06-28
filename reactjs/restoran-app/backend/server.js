const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const db = require('./db');

const app = express();
const PORT = 3001;  // <-- ubah ke 3001

app.use(cors());
app.use(bodyParser.json());

const path = require('path');  // <-- harus 'path' bukan './images'
app.use('/images', express.static(path.join(__dirname, 'images')));

const menuRoutes = require('./routes/menu');
app.use('/menu', menuRoutes);

const kategoriRoutes = require('./routes/kategori');
app.use('/kategori', kategoriRoutes);

const pelangganRoutes = require('./routes/pelanggan');
app.use('/pelanggan', pelangganRoutes);

const orderRoutes = require('./routes/order');
app.use('/order', orderRoutes);

const userRoutes = require('./routes/admin');
app.use('/admin', userRoutes);

const orderDetailRoutes = require('./routes/orderdetail');
app.use('/orderdetail', orderDetailRoutes);

app.get('/', (req, res) => {
  res.send('API restoran aktif!');
});

db.sync().then(() => {
  console.log('✅ Database siap.');
  app.listen(PORT, () => {
    console.log(`🚀 Backend jalan di http://localhost:${PORT}`);
  });
}).catch((err) => {
  console.error('❌ Gagal koneksi DB:', err);
});
