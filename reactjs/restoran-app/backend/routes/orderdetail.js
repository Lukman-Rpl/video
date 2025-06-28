// routes/orderdetail.js
const express = require('express');
const { Sequelize, DataTypes } = require('sequelize');
const router = express.Router();

const sequelize = new Sequelize('dbrestoran', 'root', '', {
  host: 'localhost',
  dialect: 'mysql',
});

// Model OrderDetail
const OrderDetail = sequelize.define('tblorderdetail', {
  idorderdetail: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true,
  },
  idorder: {
    type: DataTypes.INTEGER,
  },
  idmenu: {
    type: DataTypes.INTEGER,
  },
  jumlah: {
    type: DataTypes.INTEGER,
  },
  hargajual: {
    type: DataTypes.DECIMAL(10, 2),
  },
  created_at: {
    type: DataTypes.DATE,
    defaultValue: Sequelize.literal('CURRENT_TIMESTAMP'),
  },
}, {
  tableName: 'tblorderdetail',
  timestamps: false,
});

// Endpoint ambil semua detail order
router.get('/', async (req, res) => {
  try {
    const details = await OrderDetail.findAll();
    res.json(details);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

module.exports = router;
