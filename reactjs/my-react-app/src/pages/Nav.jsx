import { Link } from "react-router-dom";

function Nav() {
    return (
      
        <div className="App">
          <ul>
            <Link to="/">
            <li>Home</li>
            </Link>
            <Link to="/sejarah">
            <li>Sejarah</li>
            </Link>
            <Link to="/tentang">
            <li>Tentang</li>
            </Link>
            <Link to="/kontak">
            <li>Kontak</li> 
            </Link>
            <Link to="/siswa">
            <li>Siswa</li>
            </Link>
            <Link to="/menu">
            <li>Menu</li>
            </Link>
          </ul>
        </div>
    )
  }
  
  export default Nav
  