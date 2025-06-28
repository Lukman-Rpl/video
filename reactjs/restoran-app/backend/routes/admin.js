// routes/admin.js
const express = require('express');
const { Sequelize, DataTypes } = require('sequelize');
const router = express.Router();

const sequelize = new Sequelize('dbrestoran', 'root', '', {
  host: 'localhost',
  dialect: 'mysql',
});

const User = sequelize.define('tbluser', {
  iduser: { type: DataTypes.INTEGER, primaryKey: true, autoIncrement: true },
  user: { type: DataTypes.STRING(100), allowNull: false },
  email: { type: DataTypes.STRING(100) },
  password: { type: DataTypes.STRING(255) },
  level: { type: DataTypes.STRING(50) },
  aktif: { type: DataTypes.TINYINT, defaultValue: 1 },
  created_at: { type: DataTypes.DATE, defaultValue: Sequelize.literal('CURRENT_TIMESTAMP') },
}, {
  tableName: 'tbluser',
  timestamps: false,
});

router.post('/login', async (req, res) => {
  const { email, password } = req.body;

  try {
    const user = await User.findOne({ where: { email, password, aktif: 1 } });
    if (!user) return res.status(401).json({ message: 'Email atau password salah atau user tidak aktif' });

    res.json({ message: 'Login berhasil', user });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// GET semua user
router.get('/user', async (req, res) => {
    try {
      const users = await User.findAll();
      res.json(users);
    } catch (err) {
      res.status(500).json({ error: err.message });
    }
  });
  
  // GET user berdasarkan ID
  router.get('/user/:id', async (req, res) => {
    try {
      const user = await User.findByPk(req.params.id);
      if (!user) return res.status(404).json({ message: 'User tidak ditemukan' });
      res.json(user);
    } catch (err) {
      res.status(500).json({ error: err.message });
    }
  });
  
  // POST user baru
  router.post('/user', async (req, res) => {
    try {
      const newUser = await User.create(req.body);
      res.status(201).json({ message: 'User berhasil ditambahkan', data: newUser });
    } catch (err) {
      res.status(400).json({ error: err.message });
    }
  });
  
  // PUT (update) user
  router.put('/user/:id', async (req, res) => {
    try {
      const { id } = req.params;
      await User.update(req.body, { where: { iduser: id } });
      res.json({ message: 'User berhasil diperbarui' });
    } catch (err) {
      res.status(400).json({ error: err.message });
    }
  });
  
  // DELETE user
  router.delete('/user/:id', async (req, res) => {
    try {
      const { id } = req.params;
      await User.destroy({ where: { iduser: id } });
      res.json({ message: 'User berhasil dihapus' });
    } catch (err) {
      res.status(400).json({ error: err.message });
    }
  });
  

module.exports = router;
