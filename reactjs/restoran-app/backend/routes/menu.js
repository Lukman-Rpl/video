const express = require('express');
const { Sequelize, DataTypes } = require('sequelize');
const router = express.Router();

// Koneksi database
const sequelize = new Sequelize('dbrestoran', 'root', '', {
  host: 'localhost',
  dialect: 'mysql',
  logging: false,
});

// Definisikan model Menu
const Menu = sequelize.define('tblmenu', {
  idmenu: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true
  },
  idkategori: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  menu: {
    type: DataTypes.STRING,
    allowNull: false
  },
  harga: {
    type: DataTypes.INTEGER,
    allowNull: false
  },
  gambar: {
    type: DataTypes.STRING,
    allowNull: true
  }
}, {
  timestamps: false,
  freezeTableName: true
});

// Route GET untuk ambil semua menu
router.get('/', async (req, res) => {
  try {
    await sequelize.authenticate();
    const menus = await Menu.findAll();
    res.json(menus);
  } catch (error) {
    console.error('Gagal ambil data menu:', error);
    res.status(500).json({ error: 'Gagal mengambil data menu' });
  }
});

// POST /menu - tambah menu
router.post('/', async (req, res) => {
  try {
    const newMenu = await Menu.create(req.body);
    res.status(201).json(newMenu);
  } catch (err) {
    res.status(400).json({ message: err.message });
  }
});

// PUT /menu/:id - update menu
router.put('/:id', async (req, res) => {
  try {
    const { id } = req.params;
    await Menu.update(req.body, { where: { idmenu: id } });
    res.json({ message: 'Data berhasil diperbarui' });
  } catch (err) {
    res.status(400).json({ message: err.message });
  }
});

// DELETE /menu/:id - hapus menu
router.delete('/:id', async (req, res) => {
  try {
    const { id } = req.params;
    await Menu.destroy({ where: { idmenu: id } });
    res.json({ message: 'Data berhasil dihapus' });
  } catch (err) {
    res.status(400).json({ message: err.message });
  }
});

module.exports = router;
