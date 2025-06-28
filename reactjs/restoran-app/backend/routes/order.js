// routes/order.js
const express = require('express');
const { Sequelize, DataTypes } = require('sequelize');
const router = express.Router();

const sequelize = new Sequelize('dbrestoran', 'root', '', {
  host: 'localhost',
  dialect: 'mysql',
});

// Definisikan model Order
const Order = sequelize.define('tblorder', {
  idorder: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true,
  },
  idpelanggan: {
    type: DataTypes.INTEGER,
    allowNull: true,
  },
  tglorder: {
    type: DataTypes.DATEONLY,
    allowNull: true,
  },
  total: {
    type: DataTypes.DECIMAL(10, 2),
    allowNull: true,
  },
  bayar: {
    type: DataTypes.DECIMAL(10, 2),
    allowNull: true,
  },
  kembali: {
    type: DataTypes.DECIMAL(10, 2),
    allowNull: true,
  },
  status: {
    type: DataTypes.TINYINT,
    allowNull: true,
    defaultValue: 0,
  },
  created_at: {
    type: DataTypes.DATE,
    allowNull: false,
    defaultValue: Sequelize.literal('CURRENT_TIMESTAMP'),
  },
}, {
  tableName: 'tblorder',
  timestamps: false,
});

// GET semua order
router.get('/', async (req, res) => {
  try {
    const orders = await Order.findAll();
    res.json(orders);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});



module.exports = router;
