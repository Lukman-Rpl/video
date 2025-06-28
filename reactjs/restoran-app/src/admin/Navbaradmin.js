import React, { useEffect, useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';

const NavbarAdmin = () => {
  const [admin, setAdmin] = useState(null);
  const navigate = useNavigate();

  // Ambil admin dari localStorage
  useEffect(() => {
    const storedAdmin = localStorage.getItem('adminUser');
    if (storedAdmin) {
      const parsed = JSON.parse(storedAdmin);
      if (parsed.level === 'admin') {
        setAdmin(parsed);
      }
    }
  }, []);

  const handleLogout = () => {
    localStorage.removeItem('adminUser');
    setAdmin(null);
    navigate('/admin/login');
  };

  if (!admin) return null; // Tidak render navbar kalau bukan admin

  return (
    <nav style={{ backgroundColor: '#333', padding: '10px' }}>
      <ul style={{ listStyle: 'none', display: 'flex', gap: '20px', margin: 0, padding: 0 }}>
        <li><Link to="/admin/crudmenu" style={linkStyle}>CRUD Menu</Link></li>
        <li><Link to="/admin/crudkategori" style={linkStyle}>CRUD Kategori</Link></li>
        <li><Link to="/admin/crudpelanggan" style={linkStyle}>CRUD Pelanggan</Link></li>
        <li><Link to="/admin/cruduser" style={linkStyle}>CRUD User</Link></li>
        <li><Link to="/admin/orderdetail" style={linkStyle}>Order Detail</Link></li>
        <li style={{ marginLeft: 'auto', color: '#fff' }}>
          {admin.user} (<em>{admin.email}</em>)
        </li>
        <li>
          <button onClick={handleLogout} style={buttonStyle}>Logout</button>
        </li>
      </ul>
    </nav>
  );
};

const linkStyle = {
  color: '#fff',
  textDecoration: 'none'
};

const buttonStyle = {
  padding: '5px 10px',
  backgroundColor: '#f00',
  color: '#fff',
  border: 'none',
  cursor: 'pointer'
};

export default NavbarAdmin;
