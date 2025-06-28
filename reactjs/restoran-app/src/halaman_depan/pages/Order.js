import React, { useEffect, useState } from 'react';

const Order = () => {
  const [orders, setOrders] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://localhost:3001/order')
      .then(res => res.json())
      .then(data => {
        setOrders(data);
        setLoading(false);
      })
      .catch(err => {
        console.error('Error fetching orders:', err);
        setLoading(false);
      });
  }, []);

  if (loading) return <p>Loading data pesanan...</p>;

  return (
    <div style={{ padding: '20px' }}>
      <h2>Halaman Pemesanan</h2>
      {orders.length === 0 ? (
        <p>Tidak ada data pesanan.</p>
      ) : (
        <table border="1" cellPadding="8" cellSpacing="0" style={{ width: '100%', borderCollapse: 'collapse' }}>
          <thead>
            <tr>
              <th>ID Order</th>
              <th>ID Pelanggan</th>
              <th>Tanggal Order</th>
              <th>Total</th>
              <th>Bayar</th>
              <th>Kembali</th>
              <th>Status</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            {orders.map(order => (
              <tr key={order.idorder}>
                <td>{order.idorder}</td>
                <td>{order.idpelanggan}</td>
                <td>{order.tglorder}</td>
                <td>{order.total}</td>
                <td>{order.bayar}</td>
                <td>{order.kembali}</td>
                <td>{order.status === 1 ? 'Selesai' : 'Proses'}</td>
                <td>{new Date(order.created_at).toLocaleString()}</td>
              </tr>
            ))}
          </tbody>
        </table>
      )}
    </div>
  );
};

export default Order;
