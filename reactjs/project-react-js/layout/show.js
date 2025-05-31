import { link } from './link.js';

export function show() {
    let id = 4;

    link.get('/pelanggan/' + id)
        .then(res => {
            let el = res.data;
            if (!el || !el.idpelanggan) {
                throw new Error("Data tidak ditemukan");
            }

            let tampil = `<table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                </tr>
                <tr>
                    <td>${el.idpelanggan}</td>
                    <td>${el.pelanggan}</td>
                    <td>${el.alamat}</td>
                    <td>${el.telp}</td>
                </tr>
            </table>`;

            document.getElementById("out").innerHTML = tampil;
        })
        .catch(err => {
            console.error(err);
            document.getElementById("out").innerHTML = `<div class="alert alert-danger">Gagal menampilkan data</div>`;
        });
}
