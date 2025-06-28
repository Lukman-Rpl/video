import React, { useEffect, useState } from 'react';
import { Link, useLocation } from 'react-router-dom';

const Navbar = () => {
  const location = useLocation();
  const [user, setUser] = useState(null);

  useEffect(() => {
    const storedUser = JSON.parse(localStorage.getItem('user'));
    setUser(storedUser);
  }, [location]); // re-run setiap route berubah

  return (
    <nav style={{ padding: '10px', background: '#eee' }}>
      <ul style={{ listStyle: 'none', display: 'flex', gap: '15px', margin: 0, padding: 0 }}>
        <li><Link to="/">Home</Link></li>

        {!user && (
          <>
            <li><Link to="/register">Register</Link></li>
            <li><Link to="/login">Login</Link></li>
          </>
        )}

        {user && (
          <>
            <li><Link to="/menu">Menu</Link></li>
            <li><Link to="/order">Order</Link></li>
            <li><strong>{user.pelanggan}</strong></li>
            <li><Link to="/logout">Logout</Link></li>
          </>
        )}
      </ul>
    </nav>
  );
};

export default Navbar;
