import React, { useEffect, useState } from 'react';

const CrudPelanggan = () => {
  const [pelangganList, setPelangganList] = useState([]);
  const [formData, setFormData] = useState({
    pelanggan: '',
    alamat: '',
    telp: '',
    email: '',
    password: ''
  });
  const [editingId, setEditingId] = useState(null);

  const fetchPelanggan = async () => {
    try {
      const res = await fetch('http://localhost:3001/pelanggan');
      const data = await res.json();
      setPelangganList(data);
    } catch (err) {
      console.error('Gagal mengambil data:', err);
    }
  };

  useEffect(() => {
    fetchPelanggan();
  }, []);

  const handleChange = (e) => {
    setFormData(prev => ({
      ...prev,
      [e.target.name]: e.target.value
    }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    const url = editingId
      ? `http://localhost:3001/pelanggan/${editingId}`
      : 'http://localhost:3001/pelanggan';

    const method = editingId ? 'PUT' : 'POST';

    try {
      const res = await fetch(url, {
        method,
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      });

      const result = await res.json();
      alert(result.message || 'Berhasil');
      setFormData({ pelanggan: '', alamat: '', telp: '', email: '', password: '' });
      setEditingId(null);
      fetchPelanggan();
    } catch (err) {
      alert('Gagal menyimpan data');
    }
  };

  const handleEdit = (pelanggan) => {
    setFormData({
      pelanggan: pelanggan.pelanggan,
      alamat: pelanggan.alamat,
      telp: pelanggan.telp,
      email: pelanggan.email,
      password: pelanggan.password
    });
    setEditingId(pelanggan.idpelanggan);
  };

  const handleDelete = async (id) => {
    if (window.confirm('Yakin ingin menghapus pelanggan ini?')) {
      try {
        const res = await fetch(`http://localhost:3001/pelanggan/${id}`, {
          method: 'DELETE',
        });
        const result = await res.json();
        alert(result.message || 'Berhasil dihapus');
        fetchPelanggan();
      } catch (err) {
        alert('Gagal menghapus');
      }
    }
  };

  return (
    <div style={{ padding: '20px' }}>
      <h2>CRUD Pelanggan</h2>

      <form onSubmit={handleSubmit}>
        <input name="pelanggan" placeholder="Nama" value={formData.pelanggan} onChange={handleChange} required />
        <input name="alamat" placeholder="Alamat" value={formData.alamat} onChange={handleChange} required />
        <input name="telp" placeholder="Telepon" value={formData.telp} onChange={handleChange} required />
        <input name="email" placeholder="Email" type="email" value={formData.email} onChange={handleChange} required />
        <input name="password" placeholder="Password" type="password" value={formData.password} onChange={handleChange} required />
        <button type="submit">{editingId ? 'Update' : 'Tambah'}</button>
        {editingId && <button onClick={() => { setEditingId(null); setFormData({ pelanggan: '', alamat: '', telp: '', email: '', password: '' }); }} type="button">Batal</button>}
      </form>

      <table border="1" cellPadding="10" style={{ marginTop: '20px', borderCollapse: 'collapse' }}>
        <thead>
          <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          {pelangganList.map((p) => (
            <tr key={p.idpelanggan}>
              <td>{p.pelanggan}</td>
              <td>{p.alamat}</td>
              <td>{p.telp}</td>
              <td>{p.email}</td>
              <td>
                <button onClick={() => handleEdit(p)}>Edit</button>
                <button onClick={() => handleDelete(p.idpelanggan)}>Hapus</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default CrudPelanggan;
