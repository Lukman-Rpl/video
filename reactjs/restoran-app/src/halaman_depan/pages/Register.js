import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

const Register = () => {
  const [form, setForm] = useState({
    pelanggan: '',
    alamat: '',
    telp: '',
    email: '',
    password: ''
  });
  const navigate = useNavigate();

  const handleChange = (e) => {
    setForm({...form, [e.target.name]: e.target.value});
  };

  const handleRegister = async (e) => {
    e.preventDefault();

    try {
      const res = await fetch('http://localhost:3001/pelanggan', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(form)
      });

      if (res.ok) {
        alert('Registrasi berhasil!');
        navigate('/login');
      } else {
        const data = await res.json();
        alert('Gagal mendaftar: ' + (data.error || 'Unknown error'));
      }
    } catch (err) {
      console.error(err);
      alert('Terjadi kesalahan.');
    }
  };

  return (
    <div>
      <h2>Register</h2>
      <form onSubmit={handleRegister}>
        <input name="pelanggan" placeholder="Nama Pelanggan" onChange={handleChange} required /><br />
        <input name="alamat" placeholder="Alamat" onChange={handleChange} /><br />
        <input name="telp" placeholder="Telepon" onChange={handleChange} /><br />
        <input type="email" name="email" placeholder="Email" onChange={handleChange} required /><br />
        <input type="password" name="password" placeholder="Password" onChange={handleChange} required /><br />
        <button type="submit">Daftar</button>
      </form>
    </div>
  );
};

export default Register;
