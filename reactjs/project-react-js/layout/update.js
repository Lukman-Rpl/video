import {show} from "./link.js";


export function ubah() {
    let id=5;
    let data={
        pelanggan:'update  axios',
        alamat: 'update  axios',
        telp : 178787878,
    };
    link.put('/pelanggan/'+id,data).then(res=>{
        console.log(res);
         let tampil = `<h1>${res.data.pesan || 'Sukses'}</h1>`;
    document.querySelector("#out").innerHTML = tampil;
    
    });
    
}