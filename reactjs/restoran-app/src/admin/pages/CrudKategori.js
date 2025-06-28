import React, { useEffect, useState } from 'react';

const CrudKategori = () => {
  const [kategori, setKategori] = useState([]);
  const [namaKategori, setNamaKategori] = useState('');
  const [editingId, setEditingId] = useState(null);

  const fetchKategori = async () => {
    try {
      const res = await fetch('http://localhost:3001/kategori/kategori');
      const data = await res.json();
      setKategori(data);
    } catch (err) {
      console.error('Gagal mengambil data kategori:', err);
    }
  };

  useEffect(() => {
    fetchKategori();
  }, []);

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const url = editingId
        ? `http://localhost:3001/kategori/${editingId}`
        : 'http://localhost:3001/kategori';

      const method = editingId ? 'PUT' : 'POST';

      const res = await fetch(url, {
        method,
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ kategori: namaKategori }),
      });

      const result = await res.json();
      alert(result.message || 'Berhasil');
      setNamaKategori('');
      setEditingId(null);
      fetchKategori();
    } catch (err) {
      alert('Gagal menyimpan data');
    }
  };

  const handleEdit = (id, nama) => {
    setNamaKategori(nama);
    setEditingId(id);
  };

  const handleDelete = async (id) => {
    if (window.confirm('Yakin ingin hapus kategori ini?')) {
      try {
        const res = await fetch(`http://localhost:3001/kategori/${id}`, {
          method: 'DELETE',
        });
        const result = await res.json();
        alert(result.message || 'Berhasil dihapus');
        fetchKategori();
      } catch (err) {
        alert('Gagal menghapus');
      }
    }
  };

  return (
    <div style={{ padding: '20px' }}>
      <h2>CRUD Kategori</h2>

      <form onSubmit={handleSubmit}>
        <input
          type="text"
          value={namaKategori}
          onChange={(e) => setNamaKategori(e.target.value)}
          placeholder="Nama Kategori"
          required
        />
        <button type="submit">{editingId ? 'Update' : 'Tambah'}</button>
        {editingId && (
          <button type="button" onClick={() => {
            setEditingId(null);
            setNamaKategori('');
          }}>
            Batal
          </button>
        )}
      </form>

      <table border="1" cellPadding="10" style={{ marginTop: '20px', borderCollapse: 'collapse' }}>
        <thead>
          <tr>
            <th>ID</th>
            <th>Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          {kategori.map(kat => (
            <tr key={kat.idkategori}>
              <td>{kat.idkategori}</td>
              <td>{kat.kategori}</td>
              <td>
                <button onClick={() => handleEdit(kat.idkategori, kat.kategori)}>Edit</button>
                <button onClick={() => handleDelete(kat.idkategori)}>Hapus</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default CrudKategori;
