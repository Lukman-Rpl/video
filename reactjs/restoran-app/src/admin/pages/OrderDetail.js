// admin/pages/OrderDetail.js
import React, { useEffect, useState } from 'react';

const OrderDetail = () => {
  const [details, setDetails] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://localhost:3001/orderdetail')
      .then(res => res.json())
      .then(data => {
        setDetails(data);
        setLoading(false);
      })
      .catch(err => {
        console.error('Gagal ambil data order detail:', err);
        setLoading(false);
      });
  }, []);

  return (
    <div className="container mt-4">
      <h2>Halaman Order Detail</h2>
      {loading ? (
        <p>Memuat data...</p>
      ) : (
        <table className="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>ID Order</th>
              <th>ID Menu</th>
              <th>Jumlah</th>
              <th>Harga Jual</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            {details.map(detail => (
              <tr key={detail.idorderdetail}>
                <td>{detail.idorderdetail}</td>
                <td>{detail.idorder}</td>
                <td>{detail.idmenu}</td>
                <td>{detail.jumlah}</td>
                <td>{detail.hargajual}</td>
                <td>{new Date(detail.created_at).toLocaleString()}</td>
              </tr>
            ))}
          </tbody>
        </table>
      )}
    </div>
  );
};

export default OrderDetail;
