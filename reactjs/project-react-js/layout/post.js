import {link} from "./link.js";


export function post() {
    let data = {
        pelanggan: 'pelanggan axios',
        alamat: 'alamat axios',
        telp: '089818918',
    };
    link.post('/pelanggan', data)
        .then(res => {
            let tampil = `<h1>${res.data.pesan || 'Sukses'}</h1>`;
            document.querySelector("#out").innerHTML = tampil;
        })
        .catch(err => {
            console.error(err);
            document.querySelector("#out").innerHTML = `<div class="alert alert-danger">Gagal mengirim data</div>`;
        });
}
