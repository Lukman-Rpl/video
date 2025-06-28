import React, { useEffect, useState } from 'react';

const CrudUser = () => {
  const [users, setUsers] = useState([]);
  const [formData, setFormData] = useState({
    user: '',
    email: '',
    password: '',
    level: '',
    aktif: 1,
  });
  const [editingId, setEditingId] = useState(null);

  const fetchUsers = async () => {
    try {
      const res = await fetch('http://localhost:3001/admin/user'); // Pastikan endpoint benar
      const data = await res.json();
      setUsers(data);
    } catch (err) {
      console.error('Gagal ambil data user:', err);
    }
  };

  useEffect(() => {
    fetchUsers();
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
      ? `http://localhost:3001/admin/user/${editingId}`
      : 'http://localhost:3001/admin/user';

    const method = editingId ? 'PUT' : 'POST';

    try {
      const res = await fetch(url, {
        method,
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      });

      const result = await res.json();
      alert(result.message || 'Berhasil disimpan');
      setFormData({ user: '', email: '', password: '', level: '', aktif: 1 });
      setEditingId(null);
      fetchUsers();
    } catch (err) {
      alert('Gagal menyimpan user');
    }
  };

  const handleEdit = (user) => {
    setFormData({
      user: user.user,
      email: user.email,
      password: user.password,
      level: user.level,
      aktif: user.aktif,
    });
    setEditingId(user.iduser);
  };

  const handleDelete = async (id) => {
    if (window.confirm('Yakin ingin menghapus user ini?')) {
      try {
        const res = await fetch(`http://localhost:3001/admin/user/${id}`, {
          method: 'DELETE',
        });
        const result = await res.json();
        alert(result.message || 'Berhasil dihapus');
        fetchUsers();
      } catch (err) {
        alert('Gagal menghapus user');
      }
    }
  };

  return (
    <div style={{ padding: '20px' }}>
      <h2>CRUD User</h2>

      <form onSubmit={handleSubmit}>
        <input name="user" placeholder="Nama" value={formData.user} onChange={handleChange} required />
        <input name="email" type="email" placeholder="Email" value={formData.email} onChange={handleChange} required />
        <input name="password" type="text" placeholder="Password" value={formData.password} onChange={handleChange} required />
        <select name="level" value={formData.level} onChange={handleChange} required>
          <option value="">Pilih Level</option>
          <option value="admin">Admin</option>
          <option value="kasir">Kasir</option>
        </select>
        <select name="aktif" value={formData.aktif} onChange={handleChange} required>
          <option value={1}>Aktif</option>
          <option value={0}>Non-aktif</option>
        </select>
        <button type="submit">{editingId ? 'Update' : 'Tambah'}</button>
        {editingId && <button type="button" onClick={() => {
          setEditingId(null);
          setFormData({ user: '', email: '', password: '', level: '', aktif: 1 });
        }}>Batal</button>}
      </form>

      <table border="1" cellPadding="10" style={{ marginTop: '20px', borderCollapse: 'collapse' }}>
        <thead>
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Level</th>
            <th>Aktif</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          {users.map((u) => (
            <tr key={u.iduser}>
              <td>{u.user}</td>
              <td>{u.email}</td>
              <td>{u.level}</td>
              <td>{u.aktif === 1 ? 'Ya' : 'Tidak'}</td>
              <td>
                <button onClick={() => handleEdit(u)}>Edit</button>
                <button onClick={() => handleDelete(u.iduser)}>Hapus</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default CrudUser;
