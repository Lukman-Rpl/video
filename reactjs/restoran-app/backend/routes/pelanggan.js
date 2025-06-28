// routes/pelanggan.js
const express = require('express');
const { Sequelize, DataTypes } = require('sequelize');
const router = express.Router();

// Koneksi ke database
const sequelize = new Sequelize('dbrestoran', 'root', '', {
  host: 'localhost',
  dialect: 'mysql'
});

// Definisi model langsung di sini
const Pelanggan = sequelize.define('tblpelanggan', {
  idpelanggan: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true
  },
  pelanggan: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  alamat: {
    type: DataTypes.STRING(200)
  },
  telp: {
    type: DataTypes.STRING(20)
  },
  email: {
    type: DataTypes.STRING(100)
  },
  password: {
    type: DataTypes.STRING(255)
  },
  aktif: {
    type: DataTypes.TINYINT,
    defaultValue: 1
  },
  created_at: {
    type: DataTypes.DATE,
    defaultValue: Sequelize.literal('CURRENT_TIMESTAMP')
  }
}, {
  tableName: 'tblpelanggan',
  timestamps: false
});

router.post('/login', async (req, res) => {
  const { email, password } = req.body;

  try {
    const user = await Pelanggan.findOne({ where: { email, password } });

    if (!user) {
      return res.status(401).json({ message: 'Email atau password salah' });
    }

    res.json({ message: 'Login berhasil', user });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// GET semua pelanggan
router.get('/', async (req, res) => {
  try {
    const data = await Pelanggan.findAll();
    res.json(data);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// GET pelanggan berdasarkan ID
router.get('/:id', async (req, res) => {
  try {
    const data = await Pelanggan.findByPk(req.params.id);
    if (!data) return res.status(404).json({ message: 'Not found' });
    res.json(data);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// POST pelanggan baru
router.post('/', async (req, res) => {
  try {
    const result = await Pelanggan.create(req.body);
    res.status(201).json(result);
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
});

// PUT update pelanggan
router.put('/:id', async (req, res) => {
  try {
    await Pelanggan.update(req.body, {
      where: { idpelanggan: req.params.id }
    });
    res.json({ message: 'Updated' });
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
});

// DELETE pelanggan
router.delete('/:id', async (req, res) => {
  try {
    await Pelanggan.destroy({
      where: { idpelanggan: req.params.id }
    });
    res.json({ message: 'Deleted' });
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
});

router.post('/logout', (req, res) => {
  // Logout biasanya dilakukan di frontend (hapus localStorage/token)
  res.json({ message: 'Logout berhasil (client-side)' });
});

module.exports = router;
