const express = require('express');
const { Sequelize, DataTypes } = require('sequelize');
const router = express.Router();

const sequelize = new Sequelize('dbrestoran', 'root', '', {
  host: 'localhost',
  dialect: 'mysql',
  logging: false,
});

// Model Kategori
const Kategori = sequelize.define('tblkategori', {
  idkategori: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true,
  },
  kategori: {
    type: DataTypes.STRING,
    allowNull: false,
  },
  created_at: {
    type: DataTypes.DATE,
  },
}, {
  timestamps: false,
  freezeTableName: true,
});

// Model Menu
const Menu = sequelize.define('tblmenu', {
  idmenu: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true,
  },
  idkategori: {
    type: DataTypes.INTEGER,
    allowNull: false,
  },
  menu: {
    type: DataTypes.STRING,
    allowNull: false,
  },
  harga: {
    type: DataTypes.INTEGER,
    allowNull: false,
  },
  gambar: {
    type: DataTypes.STRING,
  },
}, {
  timestamps: false,
  freezeTableName: true,
});

// Route untuk ambil semua kategori
router.get('/kategori', async (req, res) => {
  try {
    const kategori = await Kategori.findAll();
    res.json(kategori);
  } catch (error) {
    res.status(500).json({ error: 'Gagal mengambil data kategori' });
  }
});

// Route untuk ambil menu berdasarkan kategori (opsional)
router.get('/menu', async (req, res) => {
  const { idkategori } = req.query;

  try {
    let menus;
    if (idkategori) {
      menus = await Menu.findAll({ where: { idkategori } });
    } else {
      menus = await Menu.findAll();
    }
    res.json(menus);
  } catch (error) {
    res.status(500).json({ error: 'Gagal mengambil data menu' });
  }
});

module.exports = router;
