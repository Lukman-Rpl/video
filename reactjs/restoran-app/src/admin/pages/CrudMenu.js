import React, { useEffect, useState } from 'react';

const CrudMenu = () => {
  const [menus, setMenus] = useState([]);
  const [loading, setLoading] = useState(true);
  const [form, setForm] = useState({ idmenu: null, idkategori: '', menu: '', harga: '', gambar: '' });
  const [editing, setEditing] = useState(false);

  // Fetch semua menu
  const fetchMenus = async () => {
    setLoading(true);
    try {
      const res = await fetch('http://localhost:3001/menu');
      const data = await res.json();
      setMenus(data);
    } catch (err) {
      alert('Gagal ambil data menu');
      console.error(err);
    }
    setLoading(false);
  };

  useEffect(() => {
    fetchMenus();
  }, []);

  // Handle form input
  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm(prev => ({ ...prev, [name]: value }));
  };

  // Submit tambah / edit menu
  const handleSubmit = async (e) => {
    e.preventDefault();

    // Validasi sederhana
    if (!form.idkategori || !form.menu || !form.harga) {
      alert('Kategori, menu, dan harga wajib diisi!');
      return;
    }

    try {
      const method = editing ? 'PUT' : 'POST';
      const url = editing ? `http://localhost:3001/menu/${form.idmenu}` : 'http://localhost:3001/menu';

      const res = await fetch(url, {
        method,
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          idkategori: form.idkategori,
          menu: form.menu,
          harga: parseInt(form.harga),
          gambar: form.gambar || null,
        }),
      });

      if (!res.ok) {
        const errData = await res.json();
        throw new Error(errData.message || 'Gagal menyimpan data');
      }

      alert(editing ? 'Data berhasil diupdate' : 'Data berhasil ditambah');
      setForm({ idmenu: null, idkategori: '', menu: '', harga: '', gambar: '' });
      setEditing(false);
      fetchMenus();
    } catch (err) {
      alert(err.message);
    }
  };

  // Edit menu: isi form dengan data yg dipilih
  const handleEdit = (menu) => {
    setForm({
      idmenu: menu.idmenu,
      idkategori: menu.idkategori,
      menu: menu.menu,
      harga: menu.harga,
      gambar: menu.gambar || '',
    });
    setEditing(true);
  };

  // Hapus menu
  const handleDelete = async (idmenu) => {
    if (!window.confirm('Yakin ingin menghapus menu ini?')) return;

    try {
      const res = await fetch(`http://localhost:3001/menu/${idmenu}`, { method: 'DELETE' });
      if (!res.ok) throw new Error('Gagal menghapus data');

      alert('Data berhasil dihapus');
      fetchMenus();
    } catch (err) {
      alert(err.message);
    }
  };

  return (
    <div>
      <h2>Halaman CRUD Menu</h2>

      <form onSubmit={handleSubmit} style={{ marginBottom: '1rem' }}>
        <input
          type="number"
          name="idkategori"
          placeholder="ID Kategori"
          value={form.idkategori}
          onChange={handleChange}
          required
        />
        <input
          type="text"
          name="menu"
          placeholder="Nama Menu"
          value={form.menu}
          onChange={handleChange}
          required
        />
        <input
          type="number"
          name="harga"
          placeholder="Harga"
          value={form.harga}
          onChange={handleChange}
          required
        />
        <input
          type="text"
          name="gambar"
          placeholder="URL Gambar (optional)"
          value={form.gambar}
          onChange={handleChange}
        />
        <button type="submit">{editing ? 'Update' : 'Tambah'}</button>
        {editing && <button type="button" onClick={() => { setEditing(false); setForm({ idmenu: null, idkategori: '', menu: '', harga: '', gambar: '' }); }}>Batal</button>}
      </form>

      {loading ? (
        <p>Loading data...</p>
      ) : (
        <table border="1" cellPadding="8" style={{ borderCollapse: 'collapse', width: '100%' }}>
          <thead>
            <tr>
              <th>ID Menu</th>
              <th>ID Kategori</th>
              <th>Menu</th>
              <th>Harga</th>
              <th>Gambar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            {menus.length === 0 && (
              <tr>
                <td colSpan="6" style={{ textAlign: 'center' }}>Data kosong</td>
              </tr>
            )}
            {menus.map((menu) => (
              <tr key={menu.idmenu}>
                <td>{menu.idmenu}</td>
                <td>{menu.idkategori}</td>
                <td>{menu.menu}</td>
                <td>Rp {menu.harga}</td>
                <td>{menu.gambar && <img src={`http://localhost:3001/images/${menu.gambar}`} alt={menu.menu} style={{ width: 80 }} />}</td>
                <td>
                  <button onClick={() => handleEdit(menu)}>Edit</button>
                  <button onClick={() => handleDelete(menu.idmenu)}>Hapus</button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      )}
    </div>
  );
};

export default CrudMenu;
