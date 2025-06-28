import React, { useEffect, useState } from 'react';

const styles = {
  container: {
    maxWidth: 900,
    margin: '20px auto',
    fontFamily: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif",
  },
  title: {
    textAlign: 'center',
    marginBottom: 20,
    color: '#2c3e50',
  },
  table: {
    borderCollapse: 'collapse',
    width: '60%',
    margin: '0 auto 30px',
    boxShadow: '0 0 10px rgba(0,0,0,0.1)',
  },
  th: {
    border: '1px solid #ddd',
    padding: '10px 15px',
    backgroundColor: '#2980b9',
    color: 'white',
  },
  td: {
    border: '1px solid #ddd',
    padding: '10px 15px',
    textAlign: 'center',
  },
  tr: {
    cursor: 'pointer',
    transition: 'background-color 0.3s ease',
  },
  trHover: {
    backgroundColor: '#ecf0f1',
  },
  trSelected: {
    backgroundColor: '#3498db',
    color: 'white',
  },
  menuList: {
    maxWidth: 700,
    margin: '0 auto',
    paddingLeft: 0,
    listStyleType: 'none',
  },
  menuItem: {
    boxShadow: '0 0 8px rgba(0,0,0,0.1)',
    borderRadius: 5,
    marginBottom: 15,
    padding: 15,
    display: 'flex',
    alignItems: 'center',
    gap: 15,
  },
  menuImage: {
    width: 100,
    borderRadius: 5,
  },
  menuText: {
    flexGrow: 1,
  },
  loading: {
    textAlign: 'center',
    fontStyle: 'italic',
    color: '#7f8c8d',
  },
  noData: {
    textAlign: 'center',
    color: '#7f8c8d',
    fontWeight: 'bold',
  },
  buttonAdd: {
    padding: '8px 12px',
    backgroundColor: '#27ae60',
    color: 'white',
    border: 'none',
    borderRadius: 5,
    cursor: 'pointer',
  },
  orderStatus: {
    textAlign: 'center',
    marginBottom: 15,
    fontWeight: 'bold',
  },
};

const MenuKategori = () => {
  const [kategori, setKategori] = useState([]);
  const [selectedKategoriId, setSelectedKategoriId] = useState(null);
  const [menus, setMenus] = useState([]);
  const [loadingKategori, setLoadingKategori] = useState(true);
  const [loadingMenu, setLoadingMenu] = useState(true);
  const [hoveredRow, setHoveredRow] = useState(null);
  const [orderStatus, setOrderStatus] = useState('');

  useEffect(() => {
    fetch('http://localhost:3001/kategori/kategori')
      .then(res => res.json())
      .then(data => {
        setKategori(data);
        setLoadingKategori(false);
      })
      .catch(err => {
        console.error(err);
        setLoadingKategori(false);
      });
  }, []);

  useEffect(() => {
    setLoadingMenu(true);
    const url =
      selectedKategoriId === null
        ? 'http://localhost:3001/menu'
        : `http://localhost:3001/kategori/menu?idkategori=${selectedKategoriId}`;

    fetch(url)
      .then(res => res.json())
      .then(data => {
        setMenus(data);
        setLoadingMenu(false);
      })
      .catch(err => {
        console.error(err);
        setLoadingMenu(false);
      });
  }, [selectedKategoriId]);

  const tambahPesanan = async (menu) => {
    setOrderStatus(''); // reset status
    const orderData = {
      idmenu: menu.idmenu,
      jumlah: 1,
    };

    try {
      const response = await fetch('http://localhost:3001/order', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(orderData),
      });
      if (!response.ok) throw new Error('Gagal tambah pesanan');
      const data = await response.json();
      setOrderStatus(`Pesanan untuk "${menu.menu}" berhasil ditambahkan!`);
    } catch (error) {
      console.error(error);
      setOrderStatus('Gagal menambah pesanan.');
    }
  };

  return (
    <div style={styles.container}>
      <h2 style={styles.title}>Daftar Kategori</h2>
      {loadingKategori ? (
        <p style={styles.loading}>Loading kategori...</p>
      ) : (
        <table style={styles.table}>
          <thead>
            <tr>
              <th style={styles.th}>ID Kategori</th>
              <th style={styles.th}>Nama Kategori</th>
            </tr>
          </thead>
          <tbody>
            <tr
              onClick={() => setSelectedKategoriId(null)}
              onMouseEnter={() => setHoveredRow('semua')}
              onMouseLeave={() => setHoveredRow(null)}
              style={{
                ...styles.tr,
                ...(selectedKategoriId === null ? styles.trSelected : {}),
                ...(selectedKategoriId !== null && hoveredRow === 'semua' ? styles.trHover : {}),
              }}
            >
              <td style={styles.td} colSpan={2}>
                Semua
              </td>
            </tr>
            {kategori.map((kat) => {
              const isSelected = kat.idkategori === selectedKategoriId;
              const isHovered = kat.idkategori === hoveredRow;
              return (
                <tr
                  key={kat.idkategori}
                  onClick={() => setSelectedKategoriId(kat.idkategori)}
                  onMouseEnter={() => setHoveredRow(kat.idkategori)}
                  onMouseLeave={() => setHoveredRow(null)}
                  style={{
                    ...styles.tr,
                    ...(isSelected ? styles.trSelected : {}),
                    ...(!isSelected && isHovered ? styles.trHover : {}),
                  }}
                >
                  <td style={styles.td}>{kat.idkategori}</td>
                  <td style={styles.td}>{kat.kategori}</td>
                </tr>
              );
            })}
          </tbody>
        </table>
      )}

      <h2 style={styles.title}>Daftar Menu</h2>
      {orderStatus && (
        <p style={{ ...styles.orderStatus, color: orderStatus.includes('Gagal') ? 'red' : 'green' }}>
          {orderStatus}
        </p>
      )}
      {loadingMenu ? (
        <p style={styles.loading}>Loading menu...</p>
      ) : menus.length > 0 ? (
        <ul style={styles.menuList}>
          {menus.map((menu) => (
            <li key={menu.idmenu} style={styles.menuItem}>
              {menu.gambar && (
                <img
                  src={`http://localhost:3001/images/${menu.gambar}`}
                  alt={menu.menu}
                  style={styles.menuImage}
                />
              )}
              <div style={styles.menuText}>
                <strong>{menu.menu}</strong> — Rp {menu.harga.toLocaleString()}
              </div>
              <button style={styles.buttonAdd} onClick={() => tambahPesanan(menu)}>
                Tambah Pesanan
              </button>
            </li>
          ))}
        </ul>
      ) : (
        <p style={styles.noData}>Tidak ada menu untuk kategori ini.</p>
      )}
    </div>
  );
};

export default MenuKategori;
