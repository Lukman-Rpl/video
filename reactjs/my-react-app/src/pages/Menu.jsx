import { useState } from 'react';
import Tabel from "./Tabel";

function Menu() {
    const titel="daftar menu andalan";
    const [menu, setMenu] = useState([
        {
            idmenu: 1,
            idkategori: 2,
            menu: "Pisang",
            gambar: "pisang.jpg",
            harga: 1000,
        },
        {
            idmenu: 2,
            idkategori: 1,
            menu: "Apel",
            gambar: "apel.jpg",
            harga: 1010,
        },
    ]);

    return (
        <div className="Kontak">
             <Tabel menu={menu} titel={titel}/>
             <Tabel menu={menu.filter((data)=>(data.idkategori===2))} titel={"Menu buah"}/>
        </div>
    );
}

export default Menu;
