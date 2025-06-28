import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

const AdminLogin = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();

    try {
      const res = await fetch('http://localhost:3001/admin/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password }),
      });

      const data = await res.json();

      if (res.ok) {
        if (data.user.level === 'admin') {
          localStorage.setItem('adminUser', JSON.stringify(data.user));
          alert('Login admin berhasil!');
          navigate('/admin/crudmenu'); // arahkan ke halaman CRUD
        } else {
          alert('Anda bukan admin!');
        }
      } else {
        alert(data.message || 'Email atau password salah!');
      }
    } catch (err) {
      console.error(err);
      alert('Terjadi kesalahan saat login.');
    }
  };

  return (
    <div style={{ padding: '20px', maxWidth: '400px', margin: 'auto' }}>
      <h2>Login Admin</h2>
      <form onSubmit={handleLogin}>
        <input
          type="email"
          placeholder="Email admin"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          required
          autoComplete="email"
          style={{ width: '100%', marginBottom: '10px', padding: '8px' }}
        />
        <input
          type="password"
          placeholder="Password admin"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          required
          autoComplete="current-password"
          style={{ width: '100%', marginBottom: '10px', padding: '8px' }}
        />
        <button type="submit" style={{ padding: '8px 16px' }}>
          Login
        </button>
      </form>
    </div>
  );
};

export default AdminLogin;
