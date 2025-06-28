import React, { useEffect, useState } from 'react';
import { Routes, Route, useLocation } from 'react-router-dom';

import Navbar from './halaman_depan/components/Navbar';
import NavbarAdmin from './admin/Navbaradmin';

import Home from './halaman_depan/pages/Home';
import MenuKategori from './halaman_depan/pages/MenuKategori';
import Login from './halaman_depan/pages/Login';
import Logout from './halaman_depan/pages/Logout';
import Register from './halaman_depan/pages/Register';
import Order from './halaman_depan/pages/Order';

import AdminLogin from './admin/Login';
import CrudMenu from './admin/pages/CrudMenu';
import CrudUser from './admin/pages/CrudUser';
import CrudKategori from './admin/pages/CrudKategori';
import CrudPelanggan from './admin/pages/CrudPelanggan';
import OrderDetail from './admin/pages/OrderDetail';

import 'bootstrap/dist/css/bootstrap.min.css';

function App() {
  const location = useLocation();
  const [adminUser, setAdminUser] = useState(null);

  useEffect(() => {
    const storedAdmin = localStorage.getItem('adminUser');
    if (storedAdmin) {
      setAdminUser(JSON.parse(storedAdmin));
    } else {
      setAdminUser(null);
    }
  }, [location]); // setiap route berubah, cek localStorage lagi

  const isAdminPath = location.pathname.startsWith('/admin');

  return (
    <>
      {isAdminPath && adminUser && adminUser.level === 'admin' ? (
        <NavbarAdmin />
      ) : (
        <Navbar />
      )}

      <Routes>
        {/* User Routes */}
        <Route path="/" element={<Home />} />
        <Route path="/menu" element={<MenuKategori />} />
        <Route path="/login" element={<Login />} />
        <Route path="/logout" element={<Logout />} />
        <Route path="/register" element={<Register />} />
        <Route path="/order" element={<Order />} />

        {/* Admin Routes */}
        <Route path="/admin/login" element={<AdminLogin />} />
        <Route path="/admin/crudmenu" element={<CrudMenu />} />
        <Route path="/admin/cruduser" element={<CrudUser />} />
        <Route path="/admin/crudkategori" element={<CrudKategori />} />
        <Route path="/admin/crudpelanggan" element={<CrudPelanggan />} />
        <Route path="/admin/orderdetail" element={<OrderDetail />} />
      </Routes>
    </>
  );
}

export default App;
